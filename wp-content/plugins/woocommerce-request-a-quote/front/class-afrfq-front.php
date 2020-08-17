<?php
//error_reporting(0);

if ( ! session_id() ) {
	session_start();
}

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( !class_exists( 'Addify_Request_For_Quote_Front' ) ) {

	class Addify_Request_For_Quote_Front extends Addify_Request_For_Quote {

		public function __construct() {

			
			add_action( 'wp_enqueue_scripts', array($this, 'afrfq_front_script'));
			add_filter( 'woocommerce_get_price_html', array($this, 'afrfq_remove_woocommerce_price_html'), 10, 2 );

			add_action( 'init', array($this, 'afrfq_custom_init' ));

			add_action( 'woocommerce_archive_description', array($this,'afrfq_add_to_quote_message'), 15 );
			add_action( 'woocommerce_before_single_product', array($this,'afrfq_add_to_quote_message'), 5 );
			add_action('wp_nav_menu_items', array($this, 'afrfq_quote_basket'), 10, 2);

			add_action( 'woocommerce_single_product_summary', array($this, 'afrfq_custom_product_button'), 1, 0 );
			add_action( 'woocommerce_after_add_to_cart_button', array($this, 'afrfq_custom_button_add_replacement'), 30 );

			add_shortcode('addify-quote-request-page', array($this, 'addify_quote_request_page_shortcode_function'));

			add_action( 'init', array( $this, 'addify_add_endpoints' ) );
			add_filter( 'query_vars', array( $this, 'addify_add_query_vars' ), 0 );
			add_filter( 'the_title', array( $this, 'addify_endpoint_title' ) );
			add_filter( 'woocommerce_account_menu_items', array( $this, 'addify_new_menu_items' ) );
			add_action( 'woocommerce_account_request-quote_endpoint', array( $this, 'addify_endpoint_content' ) );

			//Star customer session for guest users.
			add_action('woocommerce_init', array($this, 'afrfq_start_customer_session'));




		}

		public function afrfq_start_customer_session() {

			if (is_user_logged_in() || is_admin()) {
				return;
			}
			if (isset(WC()->session)) {
				if (!WC()->session->has_session()) {
					WC()->session->set_customer_session_cookie(true);
				}
			}
		}

		public function afrfq_custom_init() {

			//Replace add to cart button with custom button on shop page
			add_filter( 'woocommerce_loop_add_to_cart_link', array($this, 'afrfq_replace_loop_add_to_cart_link'), 10, 2 );

			//Add Custom button along with add to cart button on shop page
			add_action( 'woocommerce_after_shop_loop_item', array($this, 'afrfq_custom_add_to_quote_button'), 5 );
		

		}

		public function afrfq_front_script() {

			wp_enqueue_style( 'afrfq-front', plugins_url( '../assets/css/afrfq_front.css', __FILE__ ), false, '1.1' );
			wp_enqueue_style( 'jquery-model', plugins_url( '../assets/css/jquery.modal.min.css', __FILE__ ), false, '1.0' );
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'jquery-model', plugins_url( '../assets/js/jquery.modal.min.js', __FILE__ ), false, '1.0' );
			wp_enqueue_script( 'afrfq-frontj', plugins_url( '../assets/js/afrfq_front.js', __FILE__ ), false, '1.3' );
			$afrfq_data = array(
				'admin_url'  => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('afquote-ajax-nonce'),

			);
			wp_localize_script( 'afrfq-frontj', 'afrfq_phpvars', $afrfq_data );
			wp_enqueue_style('dashicons');
			wp_enqueue_script( 'Google reCaptcha JS', '//www.google.com/recaptcha/api.js', false, '1.0' );
		}

		public function afrfq_remove_woocommerce_price_html( $price, $product ) {
			global $user;
			$price_txt = $price;

			$args = array(
				'post_type' => 'addify_rfq',
				'post_status' => 'publish',
				'numberposts' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'

			);
			$rules = get_posts($args);
			foreach ($rules as $rule) {

				$afrfq_rule_type          = get_post_meta( intval($rule->ID), 'afrfq_rule_type', true );
				$afrfq_hide_products      = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_products', true ));
				$afrfq_hide_categories    = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_categories', true ));
				$afrfq_hide_user_role     = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_user_role', true ));
				$afrfq_is_hide_price      = get_post_meta( intval($rule->ID), 'afrfq_is_hide_price', true );
				$afrfq_hide_price_text    = get_post_meta( intval($rule->ID), 'afrfq_hide_price_text', true );
				$afrfq_is_hide_addtocart  = get_post_meta( intval($rule->ID), 'afrfq_is_hide_addtocart', true );
				$afrfq_custom_button_text = get_post_meta( intval($rule->ID), 'afrfq_custom_button_text', true );

				$istrue = false;

				$applied_on_all_products = get_post_meta($rule->ID, 'afrfq_apply_on_all_products', true);

				if ('afrfq_for_registered_users' == $afrfq_rule_type ) {

					//Registred Users
					if ( is_user_logged_in() ) {

						// get Current User Role
						$curr_user      = wp_get_current_user();
						$user_data      = get_user_meta( $curr_user->ID );
						$curr_user_role = $curr_user->roles[0];

						if ('yes' == $applied_on_all_products) {
							$istrue = true;
						} elseif (( is_array($afrfq_hide_user_role) && in_array($curr_user_role, $afrfq_hide_user_role) ) && ( is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products) )) {
							$istrue = true;
						}

						//Products
						if ( $istrue) {

							if ('yes' == $afrfq_is_hide_price) {

								$price_txt = $afrfq_hide_price_text;
								?>
								<style>
									.woocommerce-variation-price{ display: none !important;}
								</style>
								<?php
							}
						}

						//Categories
						if (!empty($afrfq_hide_categories ) && !$istrue) {

							foreach ($afrfq_hide_categories as $cat) {

								if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {
									
									
									if (in_array($curr_user_role, $afrfq_hide_user_role)) {

										if ('yes' == $afrfq_is_hide_price) {

											$price_txt = $afrfq_hide_price_text;
											?>
											<style>
												.woocommerce-variation-price{ display: none !important;}
											</style>
											<?php
										}
									}

									
								}

							}
						}
					}


				} else {

					if ( !is_user_logged_in() ) {


						//Guest Users
						//Products

						if ('yes' == $applied_on_all_products) {
							$istrue = true;
						} elseif (is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products)) {
							$istrue = true;
						}

						if ( $istrue) {

							if ('yes' == $afrfq_is_hide_price) {

								$price_txt = $afrfq_hide_price_text;
								?>
								<style>
									.woocommerce-variation-price{ display: none !important;}
								</style>
								<?php
							}
						}


						//Categories
						if (!empty($afrfq_hide_categories ) && !$istrue) {

							foreach ($afrfq_hide_categories as $cat) {

								if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {

									if ('yes' == $afrfq_is_hide_price) {

										$price_txt = $afrfq_hide_price_text;
										?>
										<style>
											.woocommerce-variation-price{ display: none !important;}
										</style>
										<?php
									}

								}

							}
						}
					}

				}


			}

			return $price_txt;

		}

		public function check_required_addons( $product_id ) {
			// No parent add-ons, but yes to global.
			if (in_array('woocommerce-product-addons/woocommerce-product-addons.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
				$addons = WC_Product_Addons_Helper::get_product_addons( $product_id, false, false, true );

				if ( $addons && ! empty( $addons ) ) {
					foreach ( $addons as $addon ) {
						if ( isset( $addon['required'] ) && '1' == $addon['required'] ) {
							return true;
						}
					}
				}
			}

			return false;
		}

		public function afrfq_replace_loop_add_to_cart_link( $html, $product) {

			$pageurl = get_page_link(get_option('addify_atq_page_id', true));
			global $user;
			$cart_txt = $html;

			$args = array(
				'post_type' => 'addify_rfq',
				'post_status' => 'publish',
				'numberposts' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'

			);
			$rules = get_posts($args);
			foreach ($rules as $rule) {

				$afrfq_rule_type          = get_post_meta( intval($rule->ID), 'afrfq_rule_type', true );
				$afrfq_hide_products      = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_products', true ));
				$afrfq_hide_categories    = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_categories', true ));
				$afrfq_hide_user_role     = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_user_role', true ));
				$afrfq_is_hide_price      = get_post_meta( intval($rule->ID), 'afrfq_is_hide_price', true );
				$afrfq_hide_price_text    = get_post_meta( intval($rule->ID), 'afrfq_hide_price_text', true );
				$afrfq_is_hide_addtocart  = get_post_meta( intval($rule->ID), 'afrfq_is_hide_addtocart', true );
				$afrfq_custom_button_text = get_post_meta( intval($rule->ID), 'afrfq_custom_button_text', true );
				$afrfq_custom_button_link = get_post_meta( intval($rule->ID), 'afrfq_custom_button_link', true );

				$istrue = false;

				$applied_on_all_products = get_post_meta($rule->ID, 'afrfq_apply_on_all_products', true);


				if ('variable' != $product->get_type() ) {

					if ('afrfq_for_registered_users' == $afrfq_rule_type) {
						//Registered Users

						if ( is_user_logged_in() ) {


							// get Current User Role
							$curr_user      = wp_get_current_user();
							$user_data      = get_user_meta( $curr_user->ID );
							$curr_user_role = $curr_user->roles[0];

							if ('yes' == $applied_on_all_products) {
								$istrue = true;
							} elseif (( is_array($afrfq_hide_user_role) && in_array($curr_user_role, $afrfq_hide_user_role) ) && ( is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products) )) {
								$istrue = true;
							}

							//Products
							if ( $istrue) {

								if ( $this->check_required_addons( $product->get_id() ) ) {
									//WooCommerce Product Addons compatibility

									return $html;

								} else {

									if ('replace' == $afrfq_is_hide_addtocart) {

										$cart_txt = '<div class="added_quote" id="added_quote' . $product->get_id() . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div><a href="javascript:void(0)" rel="nofollow" data-product_id="' . $product->get_ID() . '" data-product_sku="' . $product->get_sku() . '" class="afrfqbt button add_to_cart_button product_type_' . $product->get_type() . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
									} elseif ('replace_custom' == $afrfq_is_hide_addtocart) {

										if (!empty($afrfq_custom_button_text)) {
											$cart_txt = '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow"  class=" button add_to_cart_button product_type_' . $product->get_type() . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
										} else {

											$cart_txt = '';
										}

									}

								}
							}


							//Categories
							if (!empty($afrfq_hide_categories ) && !$istrue) {

								foreach ($afrfq_hide_categories as $cat) {

									if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {
										
										
										if (in_array($curr_user_role, $afrfq_hide_user_role)) {

											
											if ( $this->check_required_addons( $product->get_id() ) ) {
												//WooCommerce Product Addons compatibility

												return $html;

											} else {

												if ('replace' == $afrfq_is_hide_addtocart) {

													echo '<div class="added_quote" id="added_quote' . esc_attr($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div><a href="javascript:void(0)" rel="nofollow" data-product_id="' . esc_attr($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
												} elseif ('replace_custom' == $afrfq_is_hide_addtocart) {

													if (!empty($afrfq_custom_button_text)) {
														echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow"  class=" button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
													} else {

														$cart_txt = '';
													}

												}

												return;

											}

										}

										
									}

								}
							}

						}


					} else {
						//Guest Users

						if ( !is_user_logged_in() ) {

							//Products
							if ('yes' == $applied_on_all_products) {
								$istrue = true;
							} elseif (is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products)) {
								$istrue = true;
							}

							if ( $istrue) {

								
								if ( $this->check_required_addons( $product->get_id() ) ) {
									//WooCommerce Product Addons compatibility

									return $html;

								} else {

									if ('replace' == $afrfq_is_hide_addtocart) {

										$cart_txt = '<div class="added_quote" id="added_quote' . $product->get_id() . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div><a href="javascript:void(0)" rel="nofollow" data-product_id="' . $product->get_ID() . '" data-product_sku="' . $product->get_sku() . '" class="afrfqbt button add_to_cart_button product_type_' . $product->get_type() . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
									} elseif ('replace_custom' == $afrfq_is_hide_addtocart) {

										if (!empty($afrfq_custom_button_text)) {
											$cart_txt = '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow"  class=" button add_to_cart_button product_type_' . $product->get_type() . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
										} else {

											$cart_txt = '';
										}

									}

								}

							}


							//Categories
							if (!empty($afrfq_hide_categories ) && !$istrue) {

								foreach ($afrfq_hide_categories as $cat) {

									if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {

										if ( $this->check_required_addons( $product->get_id() ) ) {
											//WooCommerce Product Addons compatibility

											return $html;

										} else {

											if ('replace' == $afrfq_is_hide_addtocart) {

												echo '<div class="added_quote" id="added_quote' . esc_attr($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div><a href="javascript:void(0)" rel="nofollow" data-product_id="' . esc_attr($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
											} elseif ('replace_custom' == $afrfq_is_hide_addtocart) {

												if (!empty($afrfq_custom_button_text)) {
													echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow"  class=" button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
												} else {

													$cart_txt = '';
												}

											}

											return;

										}

									}

								}
							}


						}


					}
					
				}

			}

			return $cart_txt;

		}

		public function afrfq_custom_add_to_quote_button() { 

			global $user, $product;

			$pageurl = get_page_link(get_option('addify_atq_page_id', true));

			$args = array(
				'post_type' => 'addify_rfq',
				'post_status' => 'publish',
				'numberposts' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'

			);
			$rules = get_posts($args);
			foreach ($rules as $rule) {

				$afrfq_rule_type          = get_post_meta( intval($rule->ID), 'afrfq_rule_type', true );
				$afrfq_hide_products      = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_products', true ));
				$afrfq_hide_categories    = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_categories', true ));
				$afrfq_hide_user_role     = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_user_role', true ));
				$afrfq_is_hide_price      = get_post_meta( intval($rule->ID), 'afrfq_is_hide_price', true );
				$afrfq_hide_price_text    = get_post_meta( intval($rule->ID), 'afrfq_hide_price_text', true );
				$afrfq_is_hide_addtocart  = get_post_meta( intval($rule->ID), 'afrfq_is_hide_addtocart', true );
				$afrfq_custom_button_text = get_post_meta( intval($rule->ID), 'afrfq_custom_button_text', true );
				$afrfq_custom_button_link = get_post_meta( intval($rule->ID), 'afrfq_custom_button_link', true );

				$istrue = false;

				$applied_on_all_products = get_post_meta($rule->ID, 'afrfq_apply_on_all_products', true);

				

				if ('variable' != $product->get_type() ) {
					
					if ('afrfq_for_registered_users' == $afrfq_rule_type) {
						//Registered Users

						if ( is_user_logged_in() ) {

							// get Current User Role
							$curr_user      = wp_get_current_user();
							$user_data      = get_user_meta( $curr_user->ID );
							$curr_user_role = $curr_user->roles[0];

							if ('yes' == $applied_on_all_products) {
								$istrue = true;
							} elseif (( is_array($afrfq_hide_user_role) && in_array($curr_user_role, $afrfq_hide_user_role) ) && ( is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products) )) {
								$istrue = true;
							}


							//Products
							if ( $istrue) {

								if ( $this->check_required_addons( $product->get_id() ) ) {

									return apply_filters( 'addons_add_to_cart_text', __( 'Select options', 'woocommerce-product-addons' ) );
								} else {

									if ('addnewbutton' == $afrfq_is_hide_addtocart && 'simple' == $product->get_type()) {

										echo '<div class="added_quote" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div><a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';

									} elseif ('addnewbutton_custom' == $afrfq_is_hide_addtocart && 'simple' == $product->get_type()) {

										if (!empty($afrfq_custom_button_text)) {
											echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow"  class=" button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
										} else {

											echo '';
										}

									}
								}
							}


							//Categories
							if (!empty($afrfq_hide_categories ) && !$istrue) {

								foreach ($afrfq_hide_categories as $cat) {

									if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {
										
										
										if (in_array($curr_user_role, $afrfq_hide_user_role)) {

											
											if ( $this->check_required_addons( $product->get_id() ) ) {

												return apply_filters( 'addons_add_to_cart_text', __( 'Select options', 'woocommerce-product-addons' ) );
											} else {

												if ('addnewbutton' == $afrfq_is_hide_addtocart && 'simple' == $product->get_type()) {

													echo '<div class="added_quote" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div><a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';

												} elseif ('addnewbutton_custom' == $afrfq_is_hide_addtocart && 'simple' == $product->get_type()) {

													if (!empty($afrfq_custom_button_text)) {
														echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow"  class=" button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
													} else {

														echo '';
													}

												}

												return;
											}

										}

										
									}

								}
							}




						}


					} else {
						//Guest Users

						if ( !is_user_logged_in() ) {

							//Products
							if ('yes' == $applied_on_all_products) {
								$istrue = true;
							} elseif (is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products)) {
								$istrue = true;
							}

							if ( $istrue) {

								
								if ( $this->check_required_addons( $product->get_id() ) ) {

									return apply_filters( 'addons_add_to_cart_text', __( 'Select options', 'woocommerce-product-addons' ) );
								} else {

									if ('addnewbutton' == $afrfq_is_hide_addtocart && 'simple' == $product->get_type()) {

										echo '<div class="added_quote" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div><a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';

									} elseif ('addnewbutton_custom' == $afrfq_is_hide_addtocart && 'simple' == $product->get_type()) {

										if (!empty($afrfq_custom_button_text)) {
											echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow"  class=" button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
										} else {

											echo '';
										}

									}
								}

							}

							//Categories
							if (!empty($afrfq_hide_categories ) && !$istrue) {

								foreach ($afrfq_hide_categories as $cat) {

									if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {

										if ( $this->check_required_addons( $product->get_id() ) ) {

											return apply_filters( 'addons_add_to_cart_text', __( 'Select options', 'woocommerce-product-addons' ) );
										} else {

											if ('addnewbutton' == $afrfq_is_hide_addtocart && 'simple' == $product->get_type()) {

												echo '<div class="added_quote" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div><a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';

											} elseif ('addnewbutton_custom' == $afrfq_is_hide_addtocart && 'simple' == $product->get_type()) {

												if (!empty($afrfq_custom_button_text)) {
													echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow"  class=" button add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
												} else {

													echo '';
												}

											}
										}

										return;

									}

								}
							}


						}



					}
				}

			}

		}

		public function afrfq_quote_basket( $items, $args) {

			global $wp_session;

			if ( ! session_id() ) {
				session_start();
			}

			$menu_id  = get_option( 'quote_menu' );
			$args_arr = get_object_vars( $args);

			if ( !empty( $menu_id) && $menu_id == $args_arr['menu']->term_id ) {

				$pageurl = get_page_link(get_option('addify_atq_page_id', true));
				if (!empty(WC()->session->get( 'quotes' ))) {
					$quotes = WC()->session->get( 'quotes' );
				} else {
					$quotes = array();
				}

				$quoteItemCount = 0;
				foreach ($quotes as $qouteItem) {

					$quoteItemCount += $qouteItem['quantity'];
				}

				$items .= '<li id="quote-li" class="quote-li">
				
					<div class="dropdown">
						<input type="hidden" id="total_quote" value="' . intval($quoteItemCount) . '">
						<div class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<a href="' . $pageurl . '"><span class="dashicons dashicons-cart dashiconsc"></span><span id="total-items" class="totalitems">' . esc_attr($quoteItemCount . ' items in quote') . ' </span></a>
						</div>
						<div class="dropdown-menu scrollable-menu qoute-dropdown" id="dropdown" aria-labelledby="dropdownMenuButton">';

							$quote_key  = 0;
							$quote_cart = 'quote_cart';
				if (!empty($quotes)) {
					foreach ($quotes as $quote) {

						$product_id    = $quote['pid'];
						$quantity      = $quote['quantity'];
						$product       = wc_get_product($product_id);
						$product_title = $product->get_title();


						$item_data = array();
						$var_data  = array();
						$str       = '?';
						if (!empty( $quote['variation'] ) ) {
							$variation = $quote['variation'];
							foreach ( $variation as $name => $value ) {
								$taxonomy1         = str_replace( 'attribute_', '', $value[0] ) ;
								$label             = wc_attribute_label( $taxonomy1 , $product );
								$item_data[$label] = $value[1];
								if ('?' != $str) {
									$str .= '&';
								}
								$str       .= $value[0] . '=' . $value[1] ;
								$var_data[] = ucfirst( $value[1] ) ;
								?>

								<?php
							}
						}

						if (!empty($quote['woo_addons'])) {

							$w_add = $quote['woo_addons'];
						} else {
							$w_add = '';
						}

						if (!empty($quote['woo_addons1'])) {

							$w_add1 = $quote['woo_addons1'];
						} else {
							$w_add1 = '';
						}

						if (!empty($quote['vari_id'])) {
							$variation = wc_get_product($quote['vari_id']);
							
							$pro_title   = $variation->get_title();
							$product_url = $variation->get_permalink();
							$pro_image = $variation->get_image();
						} else {
							$pro_title   = $product_title;
							$product_url = $product->get_permalink();
							$pro_image = $product->get_image();
						}

						$items .= '<div class="' . $quote_key . 'qrow ' . $quote_key . '" id="main-q-row">
							 <div class="loader"></div> 
							<div class="coldel"><span class="dashicons dashicons-no " id="delete-quote" onclick="remove_quote_cart(' . $quote_key . ');"></span></div>
							<div class="colpro">
								  <div id="title-quote"><div class="pronam"><a href="' . esc_url($product_url) . '">' . esc_attr($pro_title) . '</a></div>
								  <div class="woo_options_mini"><dl class="variation">';

						foreach ( $item_data as $key => $data ) {

							$items .='<dt class="' . sanitize_html_class( 'variation-' . $key ) . '">' . wp_kses_post( ucfirst($key )) . ':</dt>';
							$items .='<dd class="' . sanitize_html_class( 'variation-' . $key ) . '">' . wp_kses_post( wpautop( $data ) ) . '</dd>';
						}

								  $items .= '</dl>';


						if ('' != $w_add) {
							$wooaddons = explode('-_-', $w_add);

							if ( '' != $wooaddons) {

								for ( $a = 1; $a < count($wooaddons); $a++ ) {

									$items .= $wooaddons[$a] . '<br />';

								}
							}
						}

						if ('' != $w_add1) {
							$wooaddons1 = explode('-_-', $w_add1);

							if ( '' != $wooaddons1) {

								for ( $b = 0; $b < count($wooaddons1) - 1; $b++ ) {

									$new_a = explode('_-_', $wooaddons1[$b]);
									$new_b = explode(' (', $new_a[0]);

									if (!empty($new_b) && !empty($new_a)) {
										$items .= $new_b[0] . ' - ' . $new_a[1] . '<br />';
									}

												
								}
							}
						}

								  $items .= '</div></div>
								  <div id="quantity">' . esc_html__('Quantity : ' . $quantity, 'addify_rfq') . '</div>
							 </div>   
							<div class="colimg"> ' . $pro_image . '</div>    
							   
								
						</div>';

						$quote_key++;
					}

					$items .= '<div class="row view-quote-row" id="main-q-row">
									<div class="col-md-12 main-btn-col"><a href="' . esc_url($pageurl) . '" class="btn wc-forward" id="view-quote">' . esc_html__(' View Quote', 'addify_rfq') . '</a></div>                                            
							   <div>';



				} else {

					$items .='<div class="row" id="main-q-row"> <div id="empty-message"> ' . esc_html__('No products in quote basket.', 'addify_rfq') . ' </div></div>';
				}
						
						$items .='</div>
						
					</div>

				</li>';


			}

			return $items;

		}

		public function afrfq_add_to_quote_message() {

			if (isset($_GET['quote'])) {
				$product       = wc_get_product(intval($_GET['quote']));
				$product_title = $product->get_title();
				$pageurl       = get_page_link(get_option('addify_atq_page_id', true));
				?>
				<div class="woocommerce">
					<div class="woocommerce-message" role="alert">
						<a href="<?php echo esc_url($pageurl); ?>" class="button wc-forward"><?php echo esc_html__('View Quote', 'addify_rfq'); ?></a>
						<strong>
							<?php echo esc_attr($product_title); ?>
								
						</strong>
						<?php echo esc_html__('has been added to your quote.', 'addify_rfq'); ?>	</div>
				</div>
				<?php
			}
		}

		public function afrfq_custom_product_button() {

			global $user, $product;

			$args = array(
				'post_type' => 'addify_rfq',
				'post_status' => 'publish',
				'numberposts' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'

			);
			$rules = get_posts($args);
			foreach ($rules as $rule) {

				$afrfq_rule_type          = get_post_meta( intval($rule->ID), 'afrfq_rule_type', true );
				$afrfq_hide_products      = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_products', true ));
				$afrfq_hide_categories    = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_categories', true ));
				$afrfq_hide_user_role     = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_user_role', true ));
				$afrfq_is_hide_price      = get_post_meta( intval($rule->ID), 'afrfq_is_hide_price', true );
				$afrfq_hide_price_text    = get_post_meta( intval($rule->ID), 'afrfq_hide_price_text', true );
				$afrfq_is_hide_addtocart  = get_post_meta( intval($rule->ID), 'afrfq_is_hide_addtocart', true );
				$afrfq_custom_button_text = get_post_meta( intval($rule->ID), 'afrfq_custom_button_text', true );

				$istrue = false;

				$applied_on_all_products = get_post_meta($rule->ID, 'afrfq_apply_on_all_products', true);

				//Registered Users
				if ('afrfq_for_registered_users' == $afrfq_rule_type) {

					if ( is_user_logged_in() ) {

						// get Current User Role
						$curr_user      = wp_get_current_user();
						$user_data      = get_user_meta( $curr_user->ID );
						$curr_user_role = $curr_user->roles[0];

						if ('yes' == $applied_on_all_products) {
							$istrue = true;
						} elseif (( is_array($afrfq_hide_user_role) && in_array($curr_user_role, $afrfq_hide_user_role) ) && ( is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products) )) {
							$istrue = true;
						}

						//Products
						if ( $istrue) {
							if ('replace' == $afrfq_is_hide_addtocart || 'replace_custom' == $afrfq_is_hide_addtocart) {

								if ('variable' == $product->get_type()) {

									remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
									add_action( 'woocommerce_single_variation', array($this, 'afrfq_custom_button_replacement'), 30 );

								} else {

									remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
									add_action( 'woocommerce_simple_add_to_cart', array($this, 'afrfq_custom_button_replacement'), 30 );
								}
							}

						}

						//Categories

						if (!empty($afrfq_hide_categories ) && !$istrue) {

							foreach ($afrfq_hide_categories as $cat) {

								if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {
									
									
									if (in_array($curr_user_role, $afrfq_hide_user_role)) {

										
										if ('replace' == $afrfq_is_hide_addtocart || 'replace_custom' == $afrfq_is_hide_addtocart) {

											if ('variable' == $product->get_type()) {

												remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
												add_action( 'woocommerce_single_variation', array($this, 'afrfq_custom_button_replacement'), 30 );

											} else {

												remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
												add_action( 'woocommerce_simple_add_to_cart', array($this, 'afrfq_custom_button_replacement'), 30 );
											}
										}

									}

									
								}

							}
						}


					}


				} else {
					//Guest Users

					if ( !is_user_logged_in() ) {

						//Products
						if ('yes' == $applied_on_all_products) {
							$istrue = true;
						} elseif (is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products)) {
							$istrue = true;
						}

						if ( $istrue) {

							
							if ('replace' == $afrfq_is_hide_addtocart || 'replace_custom' == $afrfq_is_hide_addtocart) {

								if ( 'variable' == $product->get_type()) {

									remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
									add_action( 'woocommerce_single_variation', array($this, 'afrfq_custom_button_replacement'), 30 );

								} else {

									remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
									add_action( 'woocommerce_simple_add_to_cart', array($this, 'afrfq_custom_button_replacement'), 30 );
								}
							}

						}


						//Categories
						if (!empty($afrfq_hide_categories ) && !$istrue) {

							foreach ($afrfq_hide_categories as $cat) {

								if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {

									if ('replace' == $afrfq_is_hide_addtocart || 'replace_custom' == $afrfq_is_hide_addtocart) {

										if ( 'variable' == $product->get_type()) {

											remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
											add_action( 'woocommerce_single_variation', array($this, 'afrfq_custom_button_replacement'), 30 );

										} else {

											remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
											add_action( 'woocommerce_simple_add_to_cart', array($this, 'afrfq_custom_button_replacement'), 30 );
										}
									}

								}

							}
						}


					}

				}


				

			}


		}

		public function afrfq_custom_button_replacement() {

			$pageurl = get_page_link(get_option('addify_atq_page_id', true));

			global $user, $product;

			$args = array(
				'post_type' => 'addify_rfq',
				'post_status' => 'publish',
				'numberposts' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'

			);
			$rules = get_posts($args);
			foreach ($rules as $rule) {

				$afrfq_rule_type          = get_post_meta( intval($rule->ID), 'afrfq_rule_type', true );
				$afrfq_hide_products      = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_products', true ));
				$afrfq_hide_categories    = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_categories', true ));
				$afrfq_hide_user_role     = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_user_role', true ));
				$afrfq_is_hide_price      = get_post_meta( intval($rule->ID), 'afrfq_is_hide_price', true );
				$afrfq_hide_price_text    = get_post_meta( intval($rule->ID), 'afrfq_hide_price_text', true );
				$afrfq_is_hide_addtocart  = get_post_meta( intval($rule->ID), 'afrfq_is_hide_addtocart', true );
				$afrfq_custom_button_text = get_post_meta( intval($rule->ID), 'afrfq_custom_button_text', true );
				$afrfq_custom_button_link = get_post_meta( intval($rule->ID), 'afrfq_custom_button_link', true );

				$istrue = false;

				$applied_on_all_products = get_post_meta($rule->ID, 'afrfq_apply_on_all_products', true);

				
				//Registered Users
				if ('afrfq_for_registered_users' == $afrfq_rule_type) {

					if ( is_user_logged_in() ) {

						// get Current User Role
						$curr_user      = wp_get_current_user();
						$user_data      = get_user_meta( $curr_user->ID );
						$curr_user_role = $curr_user->roles[0];

						if ('yes' == $applied_on_all_products) {
							$istrue = true;
						} elseif (( is_array($afrfq_hide_user_role) && in_array($curr_user_role, $afrfq_hide_user_role) ) && ( is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products) )) {
							$istrue = true;
						}

						if ('variable' == $product->get_type()) {

							$disable_class = 'disabled wc-variation-selection-needed';
						} else {
							$disable_class = '';
						}


						//Products
						if ( $istrue) {

							if ('replace' == $afrfq_is_hide_addtocart) {
							
								echo '<input type="hidden" name="variations_attr" class="variations_attr" value="" />';
								echo '<input type="hidden" name="product_type" class="product_type" value="variation" />';
								echo '<input type="hidden" name="variation_id" class="variation_id" value="" />';

								echo '<div class="quantity"><input type="number" id="quantityfor" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" inputmode="numeric"></div>';
								echo '<a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt_single_page ' . esc_attr($disable_class) . ' button single_add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a><div class="added_quote_pro" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div>';
							} elseif ('replace_custom' == $afrfq_is_hide_addtocart) {

								if (!empty($afrfq_custom_button_text)) {
									echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow" class="button single_add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
								} else {
									echo '';
								}
								
							}

						}


						//Categories

						if (!empty($afrfq_hide_categories ) && !$istrue) {

							foreach ($afrfq_hide_categories as $cat) {

								if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {
									
									
									if (in_array($curr_user_role, $afrfq_hide_user_role)) {

										
										if ('replace' == $afrfq_is_hide_addtocart) {
							
											echo '<input type="hidden" name="variations_attr" class="variations_attr" value="" />';
											echo '<input type="hidden" name="product_type" class="product_type" value="variation" />';
											echo '<input type="hidden" name="variation_id" class="variation_id" value="" />';

											echo '<div class="quantity"><input type="number" id="quantityfor" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" inputmode="numeric"></div>';
											echo '<a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt_single_page ' . esc_attr($disable_class) . ' button single_add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a><div class="added_quote_pro" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div>';
										} elseif ('replace_custom' == $afrfq_is_hide_addtocart) {

											if (!empty($afrfq_custom_button_text)) {
												echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow" class="button single_add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
											} else {
												echo '';
											}
											
										}

										return;

									}

									
								}

							}
						}




					}

				} else {
					//Guest Users
					if ( !is_user_logged_in() ) {

						//Products
						if ('yes' == $applied_on_all_products) {
							$istrue = true;
						} elseif (is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products)) {
							$istrue = true;
						}

						if ('variable' == $product->get_type()) {

							$disable_class = 'disabled wc-variation-selection-needed';
						} else {
							$disable_class = '';
						}

						if ( $istrue) {

							
							if ('replace' == $afrfq_is_hide_addtocart) {
							
								echo '<input type="hidden" name="variations_attr" class="variations_attr" value="" />';
								echo '<input type="hidden" name="product_type" class="product_type" value="variation" />';
								echo '<input type="hidden" name="variation_id" class="variation_id" value="" />';

								echo '<div class="quantity"><input type="number" id="quantityfor" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" inputmode="numeric"></div>';
								echo '<a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt_single_page ' . esc_attr($disable_class) . ' button single_add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a><div class="added_quote_pro" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div>';
							} elseif ('replace_custom' == $afrfq_is_hide_addtocart) {

								if (!empty($afrfq_custom_button_text)) {
									echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow" class="button single_add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
								} else {
									echo '';
								}
								
							}

						}

						//Categories
						if (!empty($afrfq_hide_categories ) && !$istrue) {

							foreach ($afrfq_hide_categories as $cat) {

								if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {

									if ('replace' == $afrfq_is_hide_addtocart) {
							
										echo '<input type="hidden" name="variations_attr" class="variations_attr" value="" />';
										echo '<input type="hidden" name="product_type" class="product_type" value="variation" />';
										echo '<input type="hidden" name="variation_id" class="variation_id" value="" />';

										echo '<div class="quantity"><input type="number" id="quantityfor" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" inputmode="numeric"></div>';
										echo '<a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt_single_page ' . esc_attr($disable_class) . ' button single_add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a><div class="added_quote_pro" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div>';
									} elseif ('replace_custom' == $afrfq_is_hide_addtocart) {

										if (!empty($afrfq_custom_button_text)) {
											echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow" class="button single_add_to_cart_button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';
										} else {
											echo '';
										}
										
									}

									return;

								}

							}
						}




					}

				}

				

			}
		}

		public function afrfq_custom_button_add_replacement() {

			$pageurl = get_page_link(get_option('addify_atq_page_id', true));

			global $user, $product;

			$args = array(
				'post_type' => 'addify_rfq',
				'post_status' => 'publish',
				'numberposts' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'

			);
			$rules = get_posts($args);
			foreach ($rules as $rule) {

				$afrfq_rule_type          = get_post_meta( intval($rule->ID), 'afrfq_rule_type', true );
				$afrfq_hide_products      = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_products', true ));
				$afrfq_hide_categories    = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_categories', true ));
				$afrfq_hide_user_role     = unserialize(get_post_meta( intval($rule->ID), 'afrfq_hide_user_role', true ));
				$afrfq_is_hide_price      = get_post_meta( intval($rule->ID), 'afrfq_is_hide_price', true );
				$afrfq_hide_price_text    = get_post_meta( intval($rule->ID), 'afrfq_hide_price_text', true );
				$afrfq_is_hide_addtocart  = get_post_meta( intval($rule->ID), 'afrfq_is_hide_addtocart', true );
				$afrfq_custom_button_text = get_post_meta( intval($rule->ID), 'afrfq_custom_button_text', true );
				$afrfq_custom_button_link = get_post_meta( intval($rule->ID), 'afrfq_custom_button_link', true );

				$istrue = false;

				$applied_on_all_products = get_post_meta($rule->ID, 'afrfq_apply_on_all_products', true);

				
				//Registered Users
				if ('afrfq_for_registered_users' == $afrfq_rule_type) {

					if ( is_user_logged_in() ) {

						// get Current User Role
						$curr_user      = wp_get_current_user();
						$user_data      = get_user_meta( $curr_user->ID );
						$curr_user_role = $curr_user->roles[0];

						if ('yes' == $applied_on_all_products) {
							$istrue = true;
						} elseif (( is_array($afrfq_hide_user_role) && in_array($curr_user_role, $afrfq_hide_user_role) ) && ( is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products) )) {
							$istrue = true;
						}

						if ('variable' == $product->get_type()) {

							$disable_class = 'disabled wc-variation-selection-needed';
						} else {
							$disable_class = '';
						}

						//Products
						if ( $istrue) {
							
							if ('addnewbutton' == $afrfq_is_hide_addtocart) {

								echo '<input type="hidden" name="variations_attr" class="variations_attr" value="" />';
								echo '<input type="hidden" name="product_type" class="product_type" value="variation" />';
								echo '<input type="hidden" name="variation_id" class="variation_id" value="" />';

								echo '<a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt_single_page button  ' . esc_attr($disable_class) . '   product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a><div class="added_quote_pro" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div>';
							} elseif ('addnewbutton_custom' == $afrfq_is_hide_addtocart) {

								if (!empty($afrfq_custom_button_text)) {

									echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow" class="button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';

								} else {

									echo '';
								}

							}

						}


						//Categories

						if (!empty($afrfq_hide_categories ) && !$istrue) {

							foreach ($afrfq_hide_categories as $cat) {

								if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {
									
									
									if (in_array($curr_user_role, $afrfq_hide_user_role)) {

										
										if ('addnewbutton' == $afrfq_is_hide_addtocart) {

											echo '<input type="hidden" name="variations_attr" class="variations_attr" value="" />';
											echo '<input type="hidden" name="product_type" class="product_type" value="variation" />';
											echo '<input type="hidden" name="variation_id" class="variation_id" value="" />';

											echo '<a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt_single_page button  ' . esc_attr($disable_class) . '   product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a><div class="added_quote_pro" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div>';

											
										} elseif ('addnewbutton_custom' == $afrfq_is_hide_addtocart) {

											if (!empty($afrfq_custom_button_text)) {

												echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow" class="button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';

											} else {

												echo '';
											}

										}

										return;
										

									}

									
								}

							}
						}


					}

				} else {
					//Guest Users
					if ( !is_user_logged_in() ) {

						//Products
						if ('yes' == $applied_on_all_products) {
							$istrue = true;
						} elseif (is_array($afrfq_hide_products) && in_array($product->get_id(), $afrfq_hide_products)) {
							$istrue = true;
						}

						if ('variable' == $product->get_type()) {

							$disable_class = 'disabled wc-variation-selection-needed';
						} else {
							$disable_class = '';
						}

						if ( $istrue) {

							
							if ('addnewbutton' == $afrfq_is_hide_addtocart) {

								echo '<input type="hidden" name="variations_attr" class="variations_attr" value="" />';
								echo '<input type="hidden" name="product_type" class="product_type" value="variation" />';
								echo '<input type="hidden" name="variation_id" class="variation_id" value="" />';

								echo '<a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt_single_page button  ' . esc_attr($disable_class) . '   product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a><div class="added_quote_pro" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div>';
							} elseif ('addnewbutton_custom' == $afrfq_is_hide_addtocart) {

								if (!empty($afrfq_custom_button_text)) {

									echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow" class="button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';

								} else {

									echo '';
								}

							}

						}


						//Categories
						if (!empty($afrfq_hide_categories ) && !$istrue) {

							foreach ($afrfq_hide_categories as $cat) {

								if ( has_term( $cat , 'product_cat', $product->get_id() ) ) {

									if ('addnewbutton' == $afrfq_is_hide_addtocart) {

										echo '<input type="hidden" name="variations_attr" class="variations_attr" value="" />';
										echo '<input type="hidden" name="product_type" class="product_type" value="variation" />';
										echo '<input type="hidden" name="variation_id" class="variation_id" value="" />';

										echo '<a href="javascript:void(0)" rel="nofollow" data-product_id="' . intval($product->get_ID()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="afrfqbt_single_page button  ' . esc_attr($disable_class) . '   product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a><div class="added_quote_pro" id="added_quote' . intval($product->get_id()) . '">' . esc_html('Product added to Quote successfully!', 'addify_rfq') . '<br /><a href="' . esc_url($pageurl) . '">' . esc_html('View Quote', 'addify_rfq') . '</a></div>';

									
									} elseif ('addnewbutton_custom' == $afrfq_is_hide_addtocart) {

										if (!empty($afrfq_custom_button_text)) {

											echo '<a href="' . esc_url($afrfq_custom_button_link) . '" rel="nofollow" class="button product_type_' . esc_attr($product->get_type()) . '">' . esc_attr($afrfq_custom_button_text) . '</a>';

										} else {

											echo '';
										}

									}

									return;

								}

							}
						}


					}

				}

				

			}

		}

		public function searchForId( $id, $array) {
			foreach ($array as $key => $val) {
				if ($val['field_key'] === $id) {
					return $key;
				}
			}
			return null;
		}

		public function captcha_check( $res) {

				$secret = get_option('afrfq_secret_key');
	   
				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $res);
				
				$responseData = json_decode($verifyResponse);

			if ($responseData->success) {
				return 'success';
			} else {
				return 'error';
			}
		}

		public function addify_quote_request_page_shortcode_function() {

			ob_start();

			$err_arr = '';

			if (isset($_POST['afrfq_action']) && 'save_afrfq' == $_POST['afrfq_action']) {

				if (isset($_REQUEST['afrfq_nonce']) && !wp_verify_nonce(sanitize_text_field($_REQUEST['afrfq_nonce']), 'save_afrfq')) {

					echo '<p class="afnonece">' . esc_html__('Sorry, your nonce did not verify.', 'addify_rfq') . '</p>';
				}



				// PHP Validation
				if (isset($_POST['afrfq_name_field']) && '' == sanitize_text_field($_POST['afrfq_name_field'])) {

					$name_field_array = unserialize(get_option('afrfq_fields'));
					$name_field_key   = $this->searchForId('afrfq_name_field', $name_field_array);

					$name_is_required = $name_field_array[$name_field_key]['field_required'];
					$name_label       = $name_field_array[$name_field_key]['field_label'];

					if ( 'yes' == $name_is_required) {

						$err_arr .= '<b class="frequired">' . esc_html__($name_label . ' is a required field!', 'addify_rfq'  ) . '</b>';
					}

				}

				if (isset($_POST['afrfq_email_field']) && '' == sanitize_email($_POST['afrfq_email_field'])) {

					$email_field_array = unserialize(get_option('afrfq_fields'));
					$email_field_key   = $this->searchForId('afrfq_email_field', $email_field_array);

					$email_is_required = $email_field_array[$email_field_key]['field_required'];
					$email_label       = $email_field_array[$email_field_key]['field_label'];

					if ( 'yes' == $email_is_required) {

						$err_arr .= '<b class="frequired">' . esc_html__($email_label . ' is a required field!', 'addify_rfq'  ) . '</b>';
					}

				}

				if (isset($_POST['afrfq_email_field']) && '' != sanitize_email($_POST['afrfq_email_field'])) {

					$email_field_array = unserialize(get_option('afrfq_fields'));
					$email_field_key   = $this->searchForId('afrfq_email_field', $email_field_array);

					$email_is_required = $email_field_array[$email_field_key]['field_required'];
					$email_label       = $email_field_array[$email_field_key]['field_label'];


					if ( 'yes' == $email_is_required && !filter_var(sanitize_email($_POST['afrfq_email_field']), FILTER_SANITIZE_EMAIL)) {

						$err_arr .= '<b class="frequired">' . esc_html__($email_label . ' is invalid!', 'addify_rfq'  ) . '</b>';
					}

				}

				if (isset($_POST['afrfq_company_field']) && '' == sanitize_text_field($_POST['afrfq_company_field'])) {

					$company_field_array = unserialize(get_option('afrfq_fields'));
					$company_field_key   = $this->searchForId('afrfq_company_field', $company_field_array);

					$company_is_required = $company_field_array[$company_field_key]['field_required'];
					$company_label       = $company_field_array[$company_field_key]['field_label'];

					if ( 'yes' == $company_is_required) {

						$err_arr .= '<b class="frequired">' . esc_html__($company_label . ' is a required field!', 'addify_rfq'  ) . '</b>';
					}

				}

				if (isset($_POST['afrfq_phone_field']) && '' == sanitize_text_field($_POST['afrfq_phone_field'])) {

					$phone_field_array = unserialize(get_option('afrfq_fields'));
					$phone_field_key   = $this->searchForId('afrfq_phone_field', $phone_field_array);

					$phone_is_required = $phone_field_array[$phone_field_key]['field_required'];
					$phone_label       = $phone_field_array[$phone_field_key]['field_label'];

					if ( 'yes' == $phone_is_required) {

						$err_arr .= '<b class="frequired">' . esc_html__($phone_label . ' is a required field!', 'addify_rfq'  ) . '</b>';
					}

				}

				if (isset($_POST['afrfq_message_field']) && '' == sanitize_text_field($_POST['afrfq_message_field'])) {

					$message_field_array = unserialize(get_option('afrfq_fields'));
					$message_field_key   = $this->searchForId('afrfq_message_field', $message_field_array);

					$message_is_required = $message_field_array[$message_field_key]['field_required'];
					$message_label       = $message_field_array[$message_field_key]['field_label'];

					if ( 'yes' == $message_is_required) {

						$err_arr .= '<b class="frequired">' . esc_html__($message_label . ' is a required field!', 'addify_rfq'  ) . '</b>';
					}

				}


				if (isset($_POST['afrfq_field1_field']) && '' == sanitize_text_field($_POST['afrfq_field1_field'])) {

					$field1_field_array = unserialize(get_option('afrfq_fields'));
					$field1_field_key   = $this->searchForId('afrfq_field1_field', $field1_field_array);

					$field1_is_required = $field1_field_array[$field1_field_key]['field_required'];
					$field1_label       = $field1_field_array[$field1_field_key]['field_label'];

					if ( 'yes' == $field1_is_required) {

						$err_arr .= '<b class="frequired">' . esc_html__($field1_label . ' is a required field!', 'addify_rfq'  ) . '</b>';
					}

				}

				if (isset($_POST['afrfq_field2_field']) && '' == sanitize_text_field($_POST['afrfq_field2_field'])) {

					$field2_field_array = unserialize(get_option('afrfq_fields'));
					$field2_field_key   = $this->searchForId('afrfq_field2_field', $field2_field_array);

					$field2_is_required = $field2_field_array[$field2_field_key]['field_required'];
					$field2_label       = $field2_field_array[$field2_field_key]['field_label'];

					if ( 'yes' == $field2_is_required) {

						$err_arr .= '<b class="frequired">' . esc_html__($field2_label . ' is a required field!', 'addify_rfq'  ) . '</b>';
					}

				}

				if (isset($_POST['afrfq_field3_field']) && '' == sanitize_text_field($_POST['afrfq_field3_field'])) {

					$field3_field_array = unserialize(get_option('afrfq_fields'));
					$field3_field_key   = $this->searchForId('afrfq_field3_field', $field2_field_array);

					$field3_is_required = $field3_field_array[$field3_field_key]['field_required'];
					$field3_label       = $field3_field_array[$field3_field_key]['field_label'];

					if ( 'yes' == $field3_is_required) {

						$err_arr .= '<b class="frequired">' . esc_html__($field3_label . ' is a required field!', 'addify_rfq'  ) . '</b>';
					}

				}


				if (isset($_FILES['afrfq_file_field']) && '' == $_FILES['afrfq_file_field']) {

					$file_field_array = unserialize(get_option('afrfq_fields'));
					$file_field_key   = $this->searchForId('afrfq_file_field', $file_field_array);

					$file_is_required = $file_field_array[$file_field_key]['field_required'];
					$file_label       = $file_field_array[$file_field_key]['field_label'];

					if ( 'yes' == $file_label) {

						$err_arr .= '<b class="frequired">' . esc_html__($file_label . ' is a required field!', 'addify_rfq'  ) . '</b>';
					}

				}


				if (isset($_FILES['afrfq_file_field']) && '' != $_FILES['afrfq_file_field']) {

					$file_field_array = unserialize(get_option('afrfq_fields'));
					$file_field_key   = $this->searchForId('afrfq_file_field', $file_field_array);

					$file_is_required   = $file_field_array[$file_field_key]['field_required'];
					$file_label         = $file_field_array[$file_field_key]['field_label'];
					$file_allowed_types = $file_field_array[$file_field_key]['file_allowed_types'];

					if ( '' != $file_allowed_types) { 

						$af_allowed_types =  explode(',', $file_allowed_types);
						if (!empty($_FILES['afrfq_file_field']['name'])) {
							$af_filename = sanitize_text_field($_FILES['afrfq_file_field']['name']);
						} else {
							$af_filename = '';
						}
						
						$af_ext = pathinfo($af_filename, PATHINFO_EXTENSION);

						if ('yes' == $file_is_required && !in_array($af_ext, $af_allowed_types) ) {
							$err_arr .= '<b class="frequired">' . esc_html__('Invalid file type!', 'addify_rfq'  ) . '</b>';
						}
					}

				}


				if ('yes' == get_option('afrfq_enable_captcha')) {

					
					if (isset($_POST['g-recaptcha-response']) && '' != $_POST['g-recaptcha-response']) {
						$ccheck = $this->captcha_check(sanitize_text_field($_POST['g-recaptcha-response']));
						if ('' == $ccheck) {
							
							$err_arr .= '<b class="frequired">' . esc_html__('Invalid reCaptcha!', 'addify_rfq'  ) . '</b>';
						}
					} else {
						$err_arr .= '<b class="frequired">' . esc_html__('reCaptcha is required!', 'addify_rfq'  ) . '</b>';
					}

				}







				if (!empty($err_arr)) {

					echo wp_kses_post($err_arr);

				} else {

					$file = '';

					if (!empty($_FILES['afrfq_file_field'])) {

						$file        = time() . sanitize_text_field($_FILES['afrfq_file_field']['name']);
						$target_path = AFRFQ_PLUGIN_DIR . 'uploads/';
						$target_path = $target_path . $file;
						if ( isset( $_FILES['afrfq_file_field']['tmp_name'])) {

							$temp = move_uploaded_file(sanitize_text_field($_FILES['afrfq_file_field']['tmp_name']), $target_path);
						} else {

							$temp = '';
						}
					}

					if (!empty($_POST)) {

						unset($_POST['afrfq_action']);
						$data   = esc_sql($_POST);
						$result = $this->addify_save_quote($data, $file);

						if (!empty($data['woo_addons'])) {

							$w_add = $data['woo_addons'];
						} else {
							$w_add = '';
						}

						if (!empty($data['woo_addons1'])) {

							$w_add1 = $data['woo_addons1'];
						} else {
							$w_add1 = '';
						}

						if (!empty($data['variation'])) {

							$variation = $data['variation'];
						} else {
							$variation = '';
						}


						

						$head  = '';
						$head .= '<table width="500">';

						$head .= '<tr>';
						$head .= '<td>';
						$head .= esc_html__('You have recieved a new quote request.', 'addify_rfq');
						$head .= '</td>';
						$head .= '</tr>';


						if ( !empty($data['afrfq_name_field'])) {

							$name_field_array = unserialize(get_option('afrfq_fields'));
							$name_field_key   = $this->searchForId('afrfq_name_field', $name_field_array);

							$name_label = $name_field_array[$name_field_key]['field_label'];

							$head .= '<tr>';
							$head .= '<td>';
							$head .= '<b>' . esc_html__($name_label . ':', 'addify_rfq') . '</b>';
							$head .= '</td>';
							$head .= '<td>';
							$head .= esc_attr($data['afrfq_name_field'] );
							$head .= '</td>';
							$head .= '</tr>';

						}

						if ( !empty($data['afrfq_email_field'])) {

							$email_field_array = unserialize(get_option('afrfq_fields'));
							$email_field_key   = $this->searchForId('afrfq_email_field', $email_field_array);

							$email_label = $email_field_array[$email_field_key]['field_label'];

							$head .= '<tr>';
							$head .= '<td>';
							$head .= '<b>' . esc_html__($email_label . ':', 'addify_rfq') . '</b>';
							$head .= '</td>';
							$head .= '<td>';
							$head .= esc_attr($data['afrfq_email_field'] );
							$head .= '</td>';
							$head .= '</tr>';

						}

						if ( !empty($data['afrfq_company_field'])) {

							$company_field_array = unserialize(get_option('afrfq_fields'));
							$company_field_key   = $this->searchForId('afrfq_company_field', $company_field_array);

							$company_label = $company_field_array[$company_field_key]['field_label'];

							$head .= '<tr>';
							$head .= '<td>';
							$head .= '<b>' . esc_html__($company_label . ':', 'addify_rfq') . '</b>';
							$head .= '</td>';
							$head .= '<td>';
							$head .= esc_attr($data['afrfq_company_field'] );
							$head .= '</td>';
							$head .= '</tr>';

						}

						if (!empty($data['afrfq_phone_field'])) {

							$phone_field_array = unserialize(get_option('afrfq_fields'));
							$phone_field_key   = $this->searchForId('afrfq_phone_field', $phone_field_array);

							$phone_label = $phone_field_array[$phone_field_key]['field_label'];

							$head .= '<tr>';
							$head .= '<td>';
							$head .= '<b>' . esc_html__($phone_label . ':', 'addify_rfq') . '</b>';
							$head .= '</td>';
							$head .= '<td>';
							$head .= esc_attr($data['afrfq_phone_field'] );
							$head .= '</td>';
							$head .= '</tr>';

						}

						if (!empty($_FILES['afrfq_file_field'])) {

							$file_field_array = unserialize(get_option('afrfq_fields'));
							$file_field_key   = $this->searchForId('afrfq_file_field', $file_field_array);

							$file_label = $file_field_array[$file_field_key]['field_label'];

							$head .= '<tr>';
							$head .= '<td>';
							$head .= '<b>' . esc_html__($file_label . ':', 'addify_rfq') . '</b>';
							$head .= '</td>';
							$head .= '<td>';
							$head .= '<a href="' . AFRFQ_URL . 'uploads/' . esc_attr($file) . '">' . esc_html__('Click to View', 'addify_rfq') . '</a>';
							$head .= '</td>';
							$head .= '</tr>';

						}

						if (!empty($data['afrfq_message_field'])) {

							$message_field_array = unserialize(get_option('afrfq_fields'));
							$message_field_key   = $this->searchForId('afrfq_message_field', $message_field_array);

							$message_label = $message_field_array[$message_field_key]['field_label'];

							$head .= '<tr>';
							$head .= '<td>';
							$head .= '<b>' . esc_html__($message_label . ':', 'addify_rfq') . '</b>';
							$head .= '</td>';
							$head .= '<td>';
							$head .= esc_attr($data['afrfq_message_field'] );
							$head .= '</td>';
							$head .= '</tr>';

						}

						if (!empty($data['afrfq_field1_field'])) {

							$field1_field_array = unserialize(get_option('afrfq_fields'));
							$field1_field_key   = $this->searchForId('afrfq_field1_field', $field1_field_array);

							$field1_label = $field1_field_array[$field1_field_key]['field_label'];

							$head .= '<tr>';
							$head .= '<td>';
							$head .= '<b>' . esc_html__($field1_label . ':', 'addify_rfq') . '</b>';
							$head .= '</td>';
							$head .= '<td>';
							$head .= esc_attr($data['afrfq_field1_field'] );
							$head .= '</td>';
							$head .= '</tr>';

						}

						if (!empty($data['afrfq_field2_field'])) {

							$field2_field_array = unserialize(get_option('afrfq_fields'));
							$field2_field_key   = $this->searchForId('afrfq_field2_field', $field2_field_array);

							$field2_label = $field2_field_array[$field2_field_key]['field_label'];

							$head .= '<tr>';
							$head .= '<td>';
							$head .= '<b>' . esc_html__($field2_label . ':', 'addify_rfq') . '</b>';
							$head .= '</td>';
							$head .= '<td>';
							$head .= esc_attr($data['afrfq_field2_field'] );
							$head .= '</td>';
							$head .= '</tr>';

						}

						if (!empty($data['afrfq_field3_field'])) {

							$field3_field_array = unserialize(get_option('afrfq_fields'));
							$field3_field_key   = $this->searchForId('afrfq_field3_field', $field3_field_array);

							$field3_label = $field3_field_array[$field3_field_key]['field_label'];

							$head .= '<tr>';
							$head .= '<td>';
							$head .= '<b>' . esc_html__($field3_label . ':', 'addify_rfq') . '</b>';
							$head .= '</td>';
							$head .= '<td>';
							$head .= esc_attr($data['afrfq_field3_field'] );
							$head .= '</td>';
							$head .= '</tr>';

						}


						

						$head .= '<tr>';
						$head .= '<td>';
						$head .= '<b>' . esc_html__('Quote Info:', 'addify_rfq') . '</b>';
						$head .= '</td>';
						$head .= '</tr>';

						$head .= '</table>';

						$quote_tab  = '';
						$quote_tab .= '<table border="1" width="700">';
						$quote_tab .= '<tr>';
						$quote_tab .= '<th></th>';
						$quote_tab .= '<th><b>' . esc_html__('Product', 'addify_rfq') . '</b></th>';
						$quote_tab .= '<th><b>' . esc_html__('Product SKU', 'addify_rfq') . '</b></th>';
						$quote_tab .= '<th><b>' . esc_html__('Quantity', 'addify_rfq') . '</b></th>';
						$quote_tab .= '</tr>';

						if (count($data['qty']) < 2) {

							$product   = wc_get_product( $data['proid'][0] );
							$item_data = array();
							$var_data  = array();
							$str       = '?';
							$postvalue = unserialize(base64_decode($data['variation'][0]));
							

							if (!empty( $postvalue  ) ) {
								

								foreach ( $postvalue as $name => $value ) {
									$taxonomy1         = str_replace( 'attribute_', '', nl2br($value[0]) ) ;
									$label             = wc_attribute_label( $taxonomy1 , $product );
									$item_data[$label] = nl2br($value[1]);
									if ('?' != $str) {
										$str .= '&';
									}
									$str       .= $value[0] . '=' . nl2br($value[1]) ;
									$var_data[] = ucfirst( nl2br($value[1]) ) ;
									
								}
							}



							
							$quote_tab .= '<tr>';
							$quote_tab .= '<th><a href="' . esc_url($data['prourl'][0]) . '" target="_blank"><img src="' . esc_url($data['proimage'][0]) . '" width="80"></a></th>';
							$quote_tab .= '<th><a href="' . esc_url($data['prourl'][0]) . '" target="_blank"><b>' . esc_attr($data['proname'][0]) . '</b></a><div class="woo_options"><dl class="variation">';

							foreach ( $item_data as $key => $datas ) {

								$quote_tab .='<dt class="' . sanitize_html_class( 'variation-' . $key ) . '">' . wp_kses_post( ucfirst($key )) . ':</dt>';
								$quote_tab .='<dd class="' . sanitize_html_class( 'variation-' . $key ) . '">' . wp_kses_post( wpautop( $datas ) ) . '</dd>';
							}

								  $quote_tab .= '</dl>';
								
							if ( !empty($w_add)) {
								$wooaddons = explode('-_-', $w_add[0]);

								if ( !empty($wooaddons) ) {

									for ( $a = 1; $a < count($wooaddons); $a++ ) {

											
										$quote_tab .= $wooaddons[$a] . '<br />';
											
									}
								}
							}

							if ( !empty($w_add1)) {
								$wooaddons1 = explode('-_-', $w_add1[0]);

								if ( !empty($wooaddons1)) {

									for ( $b = 0; $b < count($wooaddons1) - 1; $b++ ) {

										$new_a = explode('_-_', $wooaddons1[$b]);
										$new_b = explode(' (', $new_a[0]);

										if (!empty($new_b) && !empty($new_a)) {
											$quote_tab .= $new_b[0] . ' - ' . $new_a[1] . '<br />';
										}

											
									}
								}
							}

							$quote_tab .='</div></th>';
							$quote_tab .= '<th><b>' . esc_attr($data['prosku'][0]) . '</b></th>';
							$quote_tab .= '<th><b>' . esc_attr($data['qty'][0]) . '</b></th>';
							$quote_tab .= '</tr>';
						} else {

							for ($i = 1; $i <= count($data['qty']); $i++) {

								$product   = wc_get_product( $data['proid'][$i - 1] );
								$item_data = array();
								$var_data  = array();
								$str       = '?';

								$postvalue = unserialize(base64_decode($data['variation'][$i - 1]));

								if (!empty( $postvalue  ) ) {
									$variations = $postvalue;
									foreach ( $variations as $name => $value ) {
										$taxonomy1         = str_replace( 'attribute_', '', nl2br($value[0]) ) ;
										$label             = wc_attribute_label( $taxonomy1 , $product );
										$item_data[$label] = nl2br($value[1]);
										if ('?' != $str) {
											$str .= '&';
										}
										$str       .= $value[0] . '=' . nl2br($value[1]);
										$var_data[] = ucfirst( nl2br($value[1]) );
										
									}
								}

								$quote_tab .= '<tr>';
								$quote_tab .= '<th><a href="' . esc_url($data['prourl'][$i - 1]) . '" target="_blank"><img src="' . esc_url($data['proimage'][$i - 1]) . '" width="80"></a></th>';
								$quote_tab .= '<th><a href="' . esc_url($data['prourl'][$i - 1]) . '" target="_blank"><b>' . esc_attr($data['proname'][$i - 1]) . '</b></a><div class="woo_options"><dl class="variation">';

								foreach ( $item_data as $key => $datas ) {

									$quote_tab .='<dt class="' . sanitize_html_class( 'variation-' . $key ) . '">' . wp_kses_post( ucfirst($key )) . ':</dt>';
									$quote_tab .='<dd class="' . sanitize_html_class( 'variation-' . $key ) . '">' . wp_kses_post( wpautop( $datas ) ) . '</dd>';
								}

								  $quote_tab .= '</dl>';

								if ( !empty($w_add)) {
									$wooaddons = explode('-_-', $w_add[$i - 1]);

									if ( !empty($wooaddons)) {

										for ( $a = 1; $a < count($wooaddons); $a++ ) {

											
											$quote_tab .= $wooaddons[$a] . '<br />';
											
										}
									}
								}

								if ( !empty($w_add1)) {
									$wooaddons1 = explode('-_-', $w_add1[$i - 1]);

									if ( !empty($wooaddons1)) {

										for ( $b = 0; $b < count($wooaddons1) - 1; $b++ ) {

											$new_a = explode('_-_', $wooaddons1[$b]);
											$new_b = explode(' (', $new_a[0]);

											if (!empty($new_b) && !empty($new_a)) {
												$quote_tab .= $new_b[0] . ' - ' . $new_a[1] . '<br />';
											}

											
										}
									}
								}

								$quote_tab .='</div></th>';
								$quote_tab .= '<th><b>' . esc_attr($data['prosku'][$i - 1]) . '</b></th>';
								$quote_tab .= '<th><b>' . esc_attr($data['qty'][$i - 1]) . '</b></th>';
								$quote_tab .= '</tr>';
							}
						}

						$quote_tab .= '</table>';

						//Send Email to admin
						$mail_options = array(
							'from_name' => $data['afrfq_name_field'],
							'from_email' => $data['afrfq_email_field'],
						);

						$headers = array(
							'Content-type: text/html',
							'From: ' . $data['afrfq_name_field'] . ' <' . $data['afrfq_email_field'] . '>'
						);
						$message = $head . ' ' . $quote_tab;

						if (!empty(get_option('afrfq_admin_email'))) {

							$admin_email = get_option('afrfq_admin_email');
							$admin_email = explode( ',' , $admin_email ) ;
						} else {
							$admin_email = get_bloginfo('admin_email');
						}

						
						$subject = esc_html__('Request a quote!', 'addify_rfq');

						if (is_array($admin_email)) {
							foreach ($admin_email as $mail) {
								if ( is_email( $mail ) ) {
									wp_mail($mail, $subject, $message, $headers);
								}
							}
						} else {
							wp_mail($admin_email, $subject, $message, $headers);
						}

						

						//Send Email to user


						$user_headers = array(
							'Content-type: text/html',
							'From: ' . get_option( 'blogname' ) . ' < ' . get_bloginfo('admin_email') . ' > '
						);

						$user_mail_subject = get_option('afrfq_email_subject');
						$user_mail_message = get_option('afrfq_email_text');

						$enable_user_mail = get_option('enable_user_mail');

						$message2 = str_replace('You have recieved a new quote request.', '', $message);

						if ('yes' == $enable_user_mail) {

							$msg = $user_mail_message . '<br /><br />' . $message2;
						} else {

							$msg = 	$user_mail_message;
						}

						wp_mail($data['afrfq_email_field'], $user_mail_subject, $msg, $user_headers);

						if ($result) {

							WC()->session->set( 'quotes', null );
							echo '<p class="successmsg">' . esc_attr(get_option('afrfq_success_message')) . '</p>';
						} else {
							echo '<p class="errormsg">' . esc_html__('Failed! Unable to process your request.', 'addify_rfq') . '</p>';
						}

					}

				}

				


			}

			require_once AFRFQ_PLUGIN_DIR . 'front/addify_quote_request_page.php';
			return ob_get_clean();
		}

		public function addify_save_quote( $data, $file) {
			$quote = WC()->session->get('quotes');

			if (!empty($data['afrfq_message_field'])) {

				$msg_field = $data['afrfq_message_field'];
			} else {
				$msg_field = '';
			}

			$new_post = array(
				'post_title' => '',
				'post_content' => esc_attr($msg_field),
				'post_status' => 'publish',
				'post_type' => 'addify_quote'
			);

			$pid = wp_insert_post($new_post);


			add_post_meta($pid, 'quote_proname', $data['proname'], true);
			add_post_meta($pid, 'variation', $data['variation'] , true);
			add_post_meta($pid, 'quote_proid', $data['proid'], true);
			add_post_meta($pid, 'qty', $data['qty'], true);
			add_post_meta($pid, 'woo_addons', $data['woo_addons'], true);
			add_post_meta($pid, 'woo_addons1', $data['woo_addons1'], true);
			add_post_meta($pid, 'products', json_encode($quote), true);
			add_post_meta($pid, '_customer_user', get_current_user_id());

			$my_post = array(

			   'ID' =>  $pid,
			   'post_title'    => $pid,
			);

			wp_update_post( $my_post );

			//Form data

			if ( !empty($data['afrfq_name_field'])) {
				add_post_meta($pid, 'afrfq_name_field', $data['afrfq_name_field'], true);
			}

			if ( !empty($data['afrfq_email_field'])) {
				add_post_meta($pid, 'afrfq_email_field', $data['afrfq_email_field'], true);
			}

			if ( !empty($data['afrfq_company_field'])) {
				add_post_meta($pid, 'afrfq_company_field', $data['afrfq_company_field'], true);
			}

			if ( !empty($data['afrfq_phone_field'])) {
				add_post_meta($pid, 'afrfq_phone_field', $data['afrfq_phone_field'], true);
			}

			if ( !empty($file)) {
				add_post_meta($pid, 'afrfq_file_field', $file, true);
			}

			if ( !empty($data['afrfq_message_field'])) {
				add_post_meta($pid, 'afrfq_message_field', $data['afrfq_message_field'], true);
			}

			if ( !empty($data['afrfq_field1_field'])) {
				add_post_meta($pid, 'afrfq_field1_field', $data['afrfq_field1_field'], true);
			}

			if ( !empty($data['afrfq_field2_field'])) {
				add_post_meta($pid, 'afrfq_field2_field', $data['afrfq_field2_field'], true);
			}

			if ( !empty($data['afrfq_field3_field'])) {
				add_post_meta($pid, 'afrfq_field3_field', $data['afrfq_field3_field'], true);
			}
			


			return true;
		}

		public function addify_add_endpoints() {

			add_rewrite_endpoint( 'request-quote', EP_ROOT | EP_PAGES );
			flush_rewrite_rules();
		}

		public function addify_add_query_vars( $vars ) {
			$vars[] = 'request-quote';
			return $vars;
		}

		public function addify_endpoint_title( $title ) {
			global $wp_query;
			$is_endpoint = isset( $wp_query->query_vars[ 'request-quote' ] );
			if ( $is_endpoint && ! is_admin() && is_main_query() && in_the_loop() && is_account_page() ) {
				// New page title.
				$title = esc_html__( 'Quotes', 'addify_rfq' );
				remove_filter( 'the_title', array( $this, 'endpoint_title' ) );
			}
			return $title;
		}

		public function addify_new_menu_items( $items ) {
			// Remove the logout menu item.
			$logout = $items['customer-logout'];
			unset( $items['customer-logout'] );
			// Insert your custom endpoint.
			$items[ 'request-quote' ] = esc_html__( 'Quotes', 'addify_rfq' );
			// Insert back the logout item.
			$items['customer-logout'] = $logout;
			return $items;
		}

		public function addify_endpoint_content() {

			//Single Quote

			$afrfq_id = get_query_var( 'request-quote');

			$quote = get_post($afrfq_id);

			if (isset($afrfq_id) && '' != $afrfq_id) {

				$quotedataname = get_post_meta($afrfq_id, 'quote_proname', true);
				$quotedataid   = get_post_meta($afrfq_id, 'quote_proid', true);
				$quotedataqty  = get_post_meta($afrfq_id, 'qty', true);
				$woo_addons    = get_post_meta($afrfq_id, 'woo_addons', true);
				$woo_addons1   = get_post_meta($afrfq_id, 'woo_addons1', true);
				$variationall  = get_post_meta($afrfq_id, 'variation', true);

				?>
				<h2 class="entry-title"><?php echo  esc_html__('Quote ', 'addify_rfq'); ?><?php echo esc_html__( '#', 'addify_rfq' ) . intval($afrfq_id); ?></h2>

				<p><?php echo  esc_html__('Quote ', 'addify_rfq'); ?> <?php echo esc_html__( '#', 'addify_rfq' ); ?><mark class="order-number"><?php echo intval($afrfq_id); ?></mark> <?php echo esc_html__(' was placed on ', 'addify_rfq'); ?> <mark class="order-date"><time datetime="<?php echo esc_attr(gmdate( 'Y-m-d', strtotime( $quote->post_date ) )); ?>" title="<?php echo esc_attr( strtotime( $quote->post_date ) ); ?>"><?php echo esc_attr(date_i18n( get_option( 'date_format' ), strtotime( $quote->post_date ) )); ?></time></mark>.</p>

				<h2><?php echo esc_html__( 'Quote Details', 'addify_rfq' ); ?></h2>

				<table class="shop_table order_details">
					<thead>
					<tr>
						<th></th>
						<th class="product-name"><?php echo esc_html__( 'Product', 'addify_rfq' ); ?></th>
						<th class="product-sku"><?php echo esc_html__( 'Product SKU', 'addify_rfq' ); ?></th>
						<th class="product-total"><?php echo esc_html__( 'Quantity', 'addify_rfq' ); ?></th>
					</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < count($quotedataid); $i++) {

							$product       = wc_get_product($quotedataid[$i]);
							$image         = get_the_post_thumbnail_url($quotedataid[$i]);
							$product_title = $product->get_title();
							$product_url   = $product->get_permalink();
							$product_sku   = $product->get_sku();

							$p_title = $product_title;



							if (!empty($woo_addons)) {

								$w_add = $woo_addons[$i];
							} else {
								$w_add = '';
							}

							if (!empty($woo_addons1)) {

								$w_add1 = $woo_addons1[$i];
							} else {
								$w_add1 = '';
							}


							if (!empty($variationall)) {

								$variation = $variationall[$i];
							} else {
								$variation = array();
							}

							$postvalue = unserialize(base64_decode($variation));



							$item_data = array();
							$var_data  = array();
							$str       = '?';
							if (!empty( $postvalue  ) ) {
								
								foreach ( $postvalue as $name => $value ) {
									$taxonomy1         = str_replace( 'attribute_', '', $value[0] ) ;
									$label             = wc_attribute_label( $taxonomy1 , $product );
									$item_data[$label] = $value[1];
									if ('?' != $str) {
										$str .= '&';
									}
									$str       .= $value[0] . '=' . $value[1] ;
									$var_data[] = ucfirst( $value[1] ) ;
									?>

									<?php
								}
							}


							?>

							<tr>
								<td><a href="<?php echo esc_url($product_url); ?>" target="_blank"><img src="<?php echo esc_url($image); ?>" width="50"></a></td>
								<td class="product-name"><a href="<?php echo esc_url($product_url); ?>" target="_blank"><b><?php echo esc_attr($p_title); ?></b></a>

									<div class="woo_options">

										<dl class="variation">
										<?php foreach ( $item_data as $key => $data ) : ?>
												<dt class="<?php echo sanitize_html_class( 'variation-' . $key ); ?>"><?php echo wp_kses_post( ucfirst($key )); ?>:</dt>
												<dd class="<?php echo sanitize_html_class( 'variation-' . $key ); ?>"><?php echo wp_kses_post( wpautop( $data ) ); ?></dd>
										<?php endforeach; ?>
										</dl>

										<?php

										if ('' != $w_add) {
											$wooaddons = explode('-_-', $w_add);

											if ( '' != $wooaddons) {

												for ( $a = 1; $a < count($wooaddons); $a++ ) {

														
													echo esc_attr($wooaddons[$a]) . '<br />';
														
												}
											}
										}

										if ('' != $w_add1) {
											$wooaddons1 = explode('-_-', $w_add1);

											if ( '' != $wooaddons1) {

												for ( $b = 0; $b < count($wooaddons1) - 1; $b++ ) {

													$new_a = explode('_-_', $wooaddons1[$b]);
													$new_b = explode(' (', $new_a[0]);

													if (!empty($new_b) && !empty($new_a)) {
														echo esc_attr($new_b[0]) . ' - ' . esc_attr($new_a[1]) . '<br />';
													}

														
												}
											}
										}

										?>
									</div>

								</td>
								<td class="product-sku"><b><?php echo esc_attr($product_sku); ?></b></td>
								<td class="product-total"><b><?php echo esc_attr($quotedataqty[$i]); ?></b></td>
							</tr>

						<?php } ?>
					</tbody>

				</table>

				<?php
			} else {

				$customer_quotes = get_posts(array(
				'numberposts' => -1,
				'meta_key'    => '_customer_user',
				'meta_value'  => get_current_user_id(),
				'post_type'   => 'addify_quote',
				'post_status' => 'publish'
				) ) ;

				if (!empty($customer_quotes)) {
					?>

				<table class="shop_table shop_table_responsive my_account_orders">
					<thead>
						<tr>
							<th><?php echo esc_html__('Quote', 'addify_rfq'); ?></th>
							<th><?php echo esc_html__('Date', 'addify_rfq'); ?></th>
							<th><?php echo esc_html__('Action', 'addify_rfq'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($customer_quotes as $quote) {
							?>
							<tr>
								<td>
									<a href="<?php echo esc_url( wc_get_endpoint_url( 'request-quote', $quote->ID ) ); ?>">
										<?php echo esc_html__( '#', 'addify_rfq' ) . intval($quote->ID); ?>
									</a>
								</td>
								<td>
									<time datetime="<?php echo esc_attr(gmdate( 'Y-m-d', strtotime( $quote->post_date ) )); ?>" title="<?php echo esc_attr( strtotime( $quote->post_date ) ); ?>"><?php echo esc_attr(date_i18n( get_option( 'date_format' ), strtotime( $quote->post_date ) )); ?></time>
								</td>
								<td>
									<a href="<?php echo esc_url( wc_get_endpoint_url( 'request-quote', $quote->ID ) ); ?>" class="woocommerce-button button view">
										<?php echo esc_html__('View', 'addify_rfq'); ?>
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

			<?php } else { ?>

				<div class="woocommerce-MyAccount-content">
					<div class="woocommerce-notices-wrapper"></div>
					<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
						<a class="woocommerce-Button button" href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"><?php echo esc_html__('Go to shop', 'addify_rfq'); ?></a><?php echo esc_html__('No quote has been made yet.', 'addify_rfq'); ?></div>
				</div>

					<?php
			} }

		}



	}

	new Addify_Request_For_Quote_Front();

}
