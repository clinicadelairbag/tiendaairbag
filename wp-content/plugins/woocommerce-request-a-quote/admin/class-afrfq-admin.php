<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( !class_exists( 'Addify_Request_For_Quote_Admin' ) ) {

	class Addify_Request_For_Quote_Admin extends Addify_Request_For_Quote {

		public function __construct() {

			
			add_action( 'admin_enqueue_scripts', array( $this, 'afrfq_admin_scripts' ) );
			//Custom meta boxes
			add_action( 'admin_init', array( $this, 'afrfq_register_metaboxes' ), 10 );
			add_action( 'save_post', array($this, 'afrfq_meta_box_save' ));
			add_filter( 'manage_addify_rfq_posts_columns', array( $this, 'afrfq_custom_columns' ) );
			add_action( 'manage_addify_rfq_posts_custom_column' , array($this, 'afrfq_custom_column'), 10, 2 );
			add_action( 'admin_menu', array( $this, 'afrfq_custom_menu_admin' ) );
			if (isset($_POST['afrfq_save_settings']) && '' != $_POST['afrfq_save_settings']) {
				include_once ABSPATH . 'wp-includes/pluggable.php';
				if (!empty($_REQUEST['afquote_nonce_field'])) {

						$retrieved_nonce = sanitize_text_field($_REQUEST['afquote_nonce_field']);
				} else {
						$retrieved_nonce = 0;
				}

				if (!wp_verify_nonce($retrieved_nonce, 'afquote_nonce_action')) {

					die('Failed security check');
				}
				$this->afrfq_save_data();
				add_action('admin_notices', array($this, 'afrfq_author_admin_notice'));
			}

			add_filter('manage_addify_quote_posts_columns', array($this, 'addify_quote_columns_head'));
			add_action('manage_addify_quote_posts_custom_column', array($this, 'addify_quote_columns_content'), 10, 2);
			add_filter('post_row_actions', array($this, 'addify_afrfq_action_row'), 10, 2);
			add_action('edit_form_after_title', array($this, 'addify_afrfq_post_edit_form'), 100);
			add_action('wp_ajax_afrfqsearchProducts', array($this, 'afrfqsearchProducts'));
		}

		public function afrfq_admin_scripts() {

			wp_enqueue_style( 'afrfq-adminc', plugins_url( '../assets/css/afrfq_admin.css', __FILE__ ), false, '1.0' );
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script( 'jquery-ui', plugins_url( '../assets/js/jquery-ui.js', __FILE__ ), array('jquery'), '1.0'  );
			wp_enqueue_style( 'select2', plugins_url( '../assets/css/select2.css', __FILE__ ), false, '1.0' );
			wp_enqueue_script( 'select2', plugins_url( '../assets/js/select2.js', __FILE__ ), false, '1.0' );
			wp_enqueue_script( 'afrfq-adminj', plugins_url( '../assets/js/afrfq_admin.js', __FILE__ ), false, '1.0' );
			$afrfq_data = array(
				'admin_url'  => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('afquote-ajax-nonce'),

			);
			wp_localize_script( 'afrfq-adminj', 'afrfq_php_vars', $afrfq_data );
			wp_enqueue_style('thickbox');
			wp_enqueue_script('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_media();
		}

		public function afrfq_register_metaboxes() {

			add_meta_box( 'afrfq-rule-settings', esc_html__( 'Rule Settings', 'addify_rfq' ), array( $this, 'afrfq_rule_setting_callback' ), 'addify_rfq', 'normal', 'high' );

		}

		public function afrfq_rule_setting_callback() {
			global $post;
			wp_nonce_field( 'afrfq_fields_nonce', 'afrfq_field_nonce' );
			$afrfq_rule_type          = get_post_meta( intval($post->ID), 'afrfq_rule_type', true );
			$afrfq_rule_priority      = get_post_meta( intval($post->ID), 'afrfq_rule_priority', true );
			$afrfq_hide_products      = unserialize(get_post_meta( intval($post->ID), 'afrfq_hide_products', true ));
			$afrfq_hide_categories    = unserialize(get_post_meta( intval($post->ID), 'afrfq_hide_categories', true ));
			$afrfq_hide_user_role     = unserialize(get_post_meta( intval($post->ID), 'afrfq_hide_user_role', true ));
			$afrfq_is_hide_price      = get_post_meta( intval($post->ID), 'afrfq_is_hide_price', true );
			$afrfq_hide_price_text    = get_post_meta( intval($post->ID), 'afrfq_hide_price_text', true );
			$afrfq_is_hide_addtocart  = get_post_meta( intval($post->ID), 'afrfq_is_hide_addtocart', true );
			$afrfq_custom_button_text = get_post_meta( intval($post->ID), 'afrfq_custom_button_text', true );
			$afrfq_form               = get_post_meta( intval($post->ID), 'afrfq_form', true );
			$afrfq_contact7_form      = get_post_meta( intval($post->ID), 'afrfq_contact7_form', true );
			$afrfq_custom_button_link = get_post_meta( intval($post->ID), 'afrfq_custom_button_link', true );

			?>
			<div class="afrfq_admin_main">
				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Rule Type', 'addify_rfq'); ?></strong></label></div>
				<div class="afrfq_admin_main_right">
					<select name="afrfq_rule_type" id="afrfq_rule_type" onchange="afrfq_getUserRole(this.value);">
						<option value="afrfq_for_guest_users" <?php echo selected(esc_attr($afrfq_rule_type), 'afrfq_for_guest_users'); ?>><?php echo esc_html__('Quote Rule for Guest Users', 'addify_rfq'); ?></option>
						<option value="afrfq_for_registered_users" <?php echo selected(esc_attr($afrfq_rule_type), 'afrfq_for_registered_users'); ?>><?php echo esc_html__('Quote Rule for Registered Users', 'addify_rfq'); ?></option>
					</select>
				</div>
			</div>

			<div class="afrfq_admin_main">

				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Rule Priority', 'addify_rfq'); ?></strong></label></div>

				<div class="afrfq_admin_main_right">

					<input type="number" min="1" max="10" name="afrfq_rule_priority" id="afrfq_rule_priority" value="<?php echo esc_attr($post->menu_order); ?>" class="text_box select_box_small" />
					<br><i><?php echo esc_html__('Provide value from high priority 1 to Low priority 10. If more than one rule are applied on same item rule with high priority will be applied.', 'addify_rfq'); ?></i>

				</div>

			</div>

			<div class="afrfq_admin_main" id="quteurr">

				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Quote for User Roles', 'addify_rfq'); ?></strong></label></div>

				<div class="afrfq_admin_main_right">

					<select class="select_box wc-enhanced-select afrfq_hide_urole" name="afrfq_hide_user_role[]" id="afrfq_hide_user_role"  multiple='multiple'>

						<?php

						global $wp_roles;
						$roles = $wp_roles->get_names();
						foreach ($roles as $key => $value) {
							?>
							<option value="<?php echo esc_attr($key); ?>"
								<?php
								if (!empty($afrfq_hide_user_role) && in_array($key, $afrfq_hide_user_role)) {
									echo 'selected';
								}
								?>
							>
								<?php 
								echo esc_attr($value);
								?>
									
								</option>
						<?php } ?>

					</select>

				</div>

			</div>

			<div class="afrfq_admin_main">
				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Apply on All Products', 'addify_role_price'); ?></strong></label></div>
				<div class="afrfq_admin_main_right">
					<?php
						$applied_on_all_products = get_post_meta($post->ID, 'afrfq_apply_on_all_products', true);
					?>
					<input type="checkbox" name="afrfq_apply_on_all_products" id="afrfq_apply_on_all_products" value="yes" <?php echo checked('yes', $applied_on_all_products); ?>>
					<p class="csp_msg"><?php echo esc_html__('Check this if you want to apply this rule on all products.', 'addify_role_price'); ?></p>
				</div>
			</div>

			<div class="afrfq_admin_main hide_all_pro">

				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Quote Rule for Selected Products', 'addify_rfq'); ?></strong></label></div>

				<div class="afrfq_admin_main_right">
					<select class="select_box wc-enhanced-select afrfq_hide_products" name="afrfq_hide_products[]" id="afrfq_hide_products"  multiple='multiple'>
						<?php

						if (!empty($afrfq_hide_products)) {

							foreach ( $afrfq_hide_products as $pro) {

								$prod_post = get_post($pro);

								?>

									<option value="<?php echo intval($pro); ?>" selected="selected"><?php echo esc_attr($prod_post->post_title); ?></option>

								<?php 
							}
						}
						?>
					</select>
				</div>

			</div>

			<div class="afrfq_admin_main hide_all_pro">

				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Quote Rule for Selected Categories', 'addify_rfq'); ?></strong></label></div>

				<div class="afrfq_admin_main_right">


					<div class="all_cats">
						<ul>
							<?php

							$pre_vals = $afrfq_hide_categories;

							$args = array(
								'taxonomy' => 'product_cat',
								'hide_empty' => false,
								'parent'   => 0
							);

							$product_cat = get_terms( $args );
							foreach ($product_cat as $parent_product_cat) {
								?>
								<li class="par_cat">
									<input type="checkbox" class="parent" name="afrfq_hide_categories[]" id="afrfq_hide_categories" value="<?php echo intval($parent_product_cat->term_id); ?>" 
									<?php 
									if (!empty($pre_vals) && in_array($parent_product_cat->term_id, $pre_vals)) { 
										echo 'checked';
									}
									?>
									/>
									<?php echo esc_attr($parent_product_cat->name); ?>

									<?php
									$child_args         = array(
										'taxonomy' => 'product_cat',
										'hide_empty' => false,
										'parent'   => intval($parent_product_cat->term_id)
									);
									$child_product_cats = get_terms( $child_args );
									if (!empty($child_product_cats)) {
										?>
										<ul>
											<?php foreach ($child_product_cats as $child_product_cat) { ?>
												<li class="child_cat">
													<input type="checkbox" class="child parent" name="afrfq_hide_categories[]" id="afrfq_hide_categories" value="<?php echo intval($child_product_cat->term_id); ?>" 
													<?php
													if (!empty($pre_vals) &&in_array($child_product_cat->term_id, $pre_vals)) { 
														echo 'checked';
													}
													?>
													/>
													<?php echo esc_attr($child_product_cat->name); ?>

													<?php
													//2nd level
													$child_args2 = array(
														'taxonomy' => 'product_cat',
														'hide_empty' => false,
														'parent'   => intval($child_product_cat->term_id)
													);

													$child_product_cats2 = get_terms( $child_args2 );
													if (!empty($child_product_cats2)) {
														?>

														<ul>
															<?php foreach ($child_product_cats2 as $child_product_cat2) { ?>

																<li class="child_cat">
																	<input type="checkbox" class="child parent" name="afrfq_hide_categories[]" id="afrfq_hide_categories" value="<?php echo intval($child_product_cat2->term_id); ?>" 
																	<?php
																	if (!empty($pre_vals) &&in_array($child_product_cat2->term_id, $pre_vals)) {
																		echo 'checked';
																	}
																	?>
																	/>
																	<?php echo esc_attr($child_product_cat2->name); ?>


																	<?php
																	//3rd level
																	$child_args3 = array(
																		'taxonomy' => 'product_cat',
																		'hide_empty' => false,
																		'parent'   => intval($child_product_cat2->term_id)
																	);

																	$child_product_cats3 = get_terms( $child_args3 );
																	if (!empty($child_product_cats3)) {
																		?>

																		<ul>
																			<?php foreach ($child_product_cats3 as $child_product_cat3) { ?>

																				<li class="child_cat">
																					<input type="checkbox" class="child parent" name="afrfq_hide_categories[]" id="afrfq_hide_categories" value="<?php echo intval($child_product_cat3->term_id); ?>" 
																					<?php
																					if (!empty($pre_vals) &&in_array($child_product_cat3->term_id, $pre_vals)) {
																						echo 'checked';
																					}
																					?>
																					/>
																					<?php echo esc_attr($child_product_cat3->name); ?>


																					<?php
																					//4th level
																					$child_args4 = array(
																						'taxonomy' => 'product_cat',
																						'hide_empty' => false,
																						'parent'   => intval($child_product_cat3->term_id)
																					);

																					$child_product_cats4 = get_terms( $child_args4 );
																					if (!empty($child_product_cats4)) {
																						?>

																						<ul>
																							<?php foreach ($child_product_cats4 as $child_product_cat4) { ?>

																								<li class="child_cat">
																									<input type="checkbox" class="child parent" name="afrfq_hide_categories[]" id="afrfq_hide_categories" value="<?php echo intval($child_product_cat4->term_id); ?>"
																									<?php
																									if (!empty($pre_vals) &&in_array($child_product_cat4->term_id, $pre_vals)) {
																										echo 'checked';
																									}
																									?>
																									/>
																									<?php echo esc_attr($child_product_cat4->name); ?>


																									<?php
																									//5th level
																									$child_args5 = array(
																										'taxonomy' => 'product_cat',
																										'hide_empty' => false,
																										'parent'   => intval($child_product_cat4->term_id)
																									);

																									$child_product_cats5 = get_terms( $child_args5 );
																									if (!empty($child_product_cats5)) {
																										?>

																										<ul>
																											<?php foreach ($child_product_cats5 as $child_product_cat5) { ?>

																												<li class="child_cat">
																													<input type="checkbox" class="child parent" name="afrfq_hide_categories[]" id="afrfq_hide_categories" value="<?php echo intval($child_product_cat5->term_id); ?>" 
																													<?php
																													if (!empty($pre_vals) &&in_array($child_product_cat5->term_id, $pre_vals)) {
																														echo 'checked';
																													}
																													?>
																													/>
																													<?php echo esc_attr($child_product_cat5->name); ?>


																													<?php
																													//6th level
																													$child_args6 = array(
																														'taxonomy' => 'product_cat',
																														'hide_empty' => false,
																														'parent'   => intval($child_product_cat5->term_id)
																													);

																													$child_product_cats6 = get_terms( $child_args6 );
																													if (!empty($child_product_cats6)) {
																														?>

																														<ul>
																															<?php foreach ($child_product_cats6 as $child_product_cat6) { ?>

																																<li class="child_cat">
																																	<input type="checkbox" class="child" name="afrfq_hide_categories[]" id="afrfq_hide_categories" value="<?php echo intval($child_product_cat6->term_id); ?>" 
																																	<?php
																																	if (!empty($pre_vals) &&in_array($child_product_cat6->term_id, $pre_vals)) {
																																		echo 'checked';
																																	}
																																	?>
																																	/>
																																	<?php echo esc_attr($child_product_cat6->name); ?>
																																</li>

																															<?php } ?>
																														</ul>

																													<?php } ?>

																												</li>

																											<?php } ?>
																										</ul>

																									<?php } ?>


																								</li>

																							<?php } ?>
																						</ul>

																					<?php } ?>


																				</li>

																			<?php } ?>
																		</ul>

																	<?php } ?>

																</li>

															<?php } ?>
														</ul>

													<?php } ?>

												</li>
											<?php } ?>
										</ul>
									<?php } ?>

								</li>
								<?php
							}
							?>
						</ul>
					</div>


				</div>

			</div>


			<div class="afrfq_admin_main">

				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Hide Price', 'addify_rfq'); ?></strong></label></div>

				<div class="afrfq_admin_main_right">

					<select name="afrfq_is_hide_price" class="select_box_small" id="afrfq_is_hide_price" onchange="afrfq_HidePrice(this.value)">
						<option value="no" <?php echo selected('no', esc_attr($afrfq_is_hide_price )); ?>><?php echo esc_html__('No', 'addify_rfq'); ?></option>
						<option value="yes" <?php echo selected('yes', esc_attr($afrfq_is_hide_price )); ?>><?php echo esc_html__('Yes', 'addify_rfq'); ?></option>
					</select>

				</div>

			</div>

			<div class="afrfq_admin_main" id="hpircetext">

				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Hide Price Text', 'addify_rfq'); ?></strong></label></div>

				<div class="afrfq_admin_main_right">

					<?php
					if (!empty($afrfq_hide_price_text)) { 
						$afpricetext = $afrfq_hide_price_text;
					} else {
						$afpricetext = '';
					}
					?>
					<textarea cols="50" rows="5" name="afrfq_hide_price_text" id="afrfq_hide_price_text" /><?php echo  esc_textarea( $afpricetext ); ?></textarea>
					<br><i><?php echo esc_html__('Display the above text when price is hidden, e.g "Price is hidden"', 'addify_rfq'); ?></i>

				</div>

			</div>

			<div class="afrfq_admin_main">

				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Hide Add to Cart Button', 'addify_rfq'); ?></strong></label></div>

				<div class="afrfq_admin_main_right">

					<select name="afrfq_is_hide_addtocart" class="select_box_small" id="afrfq_is_hide_addtocart" onchange="getCustomURL(this.value)">
						<option value="replace" <?php echo selected('replace', esc_attr($afrfq_is_hide_addtocart )); ?>>
						<?php echo esc_html__('Replace Add to Cart button with a Quote Button', 'addify_rfq'); ?>
							
						</option>
						<option value="addnewbutton" <?php echo selected('addnewbutton', esc_attr($afrfq_is_hide_addtocart )); ?>>
						<?php echo esc_html__('Keep Add to Cart button and add a new Quote Button', 'addify_rfq'); ?>
						</option>

						<option value="replace_custom" <?php echo selected('replace_custom', esc_attr($afrfq_is_hide_addtocart )); ?>>
						<?php echo esc_html__('Replace Add to Cart with custom button', 'addify_rfq'); ?>
							
						</option>

						<option value="addnewbutton_custom" <?php echo selected('addnewbutton_custom', esc_attr($afrfq_is_hide_addtocart )); ?>>
						<?php echo esc_html__('Keep Add to Cart and add a new custom button', 'addify_rfq'); ?>
						</option>


					</select>

				</div>

			</div>

			<div class="afrfq_admin_main" id="afcustom_link">

				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Custom Button Link', 'addify_rfq'); ?></strong></label></div>

				<div class="afrfq_admin_main_right">

					<?php
					if (!empty($afrfq_custom_button_link)) {
						$afrfq_custom_button_link =  $afrfq_custom_button_link;
					} else {
						$afrfq_custom_button_link = '';
					}
					?>
					<input type="text" class="afrfq_input_class" name="afrfq_custom_button_link" id="afrfq_custom_button_link" value="<?php echo esc_attr($afrfq_custom_button_link); ?>">
					<br><i><?php echo esc_html__('Link for custom button e.g "http://www.example.com"', 'addify_rfq'); ?></i>

				</div>

			</div>

			<div class="afrfq_admin_main">

				<div class="afrfq_admin_main_left"><label><strong><?php echo esc_html__('Custom Button Label', 'addify_rfq'); ?></strong></label></div>

				<div class="afrfq_admin_main_right">

					<?php
					if (!empty($afrfq_custom_button_text)) {
						$afcustombuttontext =  $afrfq_custom_button_text;
					} else {
						$afcustombuttontext = '';
					}
					?>
					<textarea cols="50" rows="5" name="afrfq_custom_button_text" id="afrfq_custom_button_text"><?php echo esc_textarea( $afcustombuttontext ); ?></textarea>
					<br><i><?php echo esc_html__('Display the above label on custom button, e.g "Request a Quote"', 'addify_rfq'); ?></i>

				</div>

			</div>

			<?php
		}

		public function afrfq_meta_box_save( $post_id ) {

			// return if we're doing an auto save
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			if ( get_post_status( $post_id ) === 'auto-draft' ) {
				return;
			}

			// if our nonce isn't there, or we can't verify it, return
			if ( !isset( $_POST['afrfq_field_nonce'] ) || !wp_verify_nonce( sanitize_text_field($_POST['afrfq_field_nonce']), 'afrfq_fields_nonce' ) ) {
				return;
			} 

			// if our current user can't edit this post, return
			if ( !current_user_can( 'edit_posts' ) ) {
				return;
			}

			remove_action( 'save_post', array($this, 'afrfq_meta_box_save'));

			if (isset($_POST['afrfq_rule_priority'])) {
				wp_update_post( array( 'ID' => intval($post_id), 'menu_order' => esc_attr(sanitize_text_field($_POST['afrfq_rule_priority']) ) ));
			}

			add_action( 'save_post', array($this, 'afreg_meta_box_save' ));

			if ( isset( $_POST['afrfq_rule_type'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_rule_type', esc_attr( sanitize_text_field($_POST['afrfq_rule_type']) ) );
			}

			if ( isset( $_POST['afrfq_hide_products'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_hide_products', serialize(sanitize_meta('afrfq_hide_products', $_POST['afrfq_hide_products'], '') ));
			} else {
				update_post_meta( intval($post_id), 'afrfq_hide_products', '');
			}

			if ( isset( $_POST['afrfq_hide_categories'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_hide_categories', serialize(sanitize_meta('afrfq_hide_categories', $_POST['afrfq_hide_categories'], '') ));
			} else {
				update_post_meta( intval($post_id), 'afrfq_hide_categories', '');
			}

			if ( isset( $_POST['afrfq_apply_on_all_products'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_apply_on_all_products', esc_attr( sanitize_text_field($_POST['afrfq_apply_on_all_products']) ) );
			} else {

				update_post_meta( intval($post_id), 'afrfq_apply_on_all_products', 'no' );	
			}

			

			if ( isset( $_POST['afrfq_hide_user_role'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_hide_user_role', serialize(sanitize_meta('afrfq_hide_user_role', $_POST['afrfq_hide_user_role'], '') ));
			} else {
				update_post_meta( intval($post_id), 'afrfq_hide_user_role', '');
			}

			if ( isset( $_POST['afrfq_is_hide_price'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_is_hide_price', esc_attr( sanitize_text_field($_POST['afrfq_is_hide_price']) ) );
			}

			if ( isset( $_POST['afrfq_hide_price_text'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_hide_price_text', esc_attr( sanitize_text_field($_POST['afrfq_hide_price_text']) ) );
			}

			if ( isset( $_POST['afrfq_is_hide_addtocart'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_is_hide_addtocart', esc_attr( sanitize_text_field($_POST['afrfq_is_hide_addtocart']) ) );
			}

			if ( isset( $_POST['afrfq_custom_button_text'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_custom_button_text', esc_attr( sanitize_text_field($_POST['afrfq_custom_button_text']) ) );
			}

			if ( isset( $_POST['afrfq_custom_button_link'] ) ) {
				update_post_meta( intval($post_id), 'afrfq_custom_button_link', esc_attr( sanitize_text_field($_POST['afrfq_custom_button_link']) ) );
			}

		}

		public function afrfq_custom_columns( $columns) {

			unset($columns['date']);
			$columns['afrfq_rule_type'] = esc_html__( 'Rule Type', 'addify_rfq' );
			$columns['date']            = esc_html__( 'Date Published', 'addify_rfq' );

			return $columns;
		}

		public function afrfq_custom_column( $column, $post_id ) {
			$afrfq_post = get_post($post_id);
			switch ( $column ) {
				case 'afrfq_rule_type':
					$afrfq_rule_type = get_post_meta($post_id, 'afrfq_rule_type', true);
					if ('afrfq_for_registered_users' == $afrfq_rule_type) {
						echo esc_html__('Quote Rule for Registered Users', 'addify_rfq');
					} else {
						echo esc_html__('Quote Rule for Guest Users', 'addify_rfq');
					}
					break;
			}
		}

		public function afrfq_custom_menu_admin() {

			add_submenu_page(
				'edit.php?post_type=addify_rfq',
				esc_html__( 'Settings', 'addify_rfq' ),
				esc_html__( 'Settings', 'addify_rfq' ),
				'manage_options',
				'addify-rfq-settings',
				array($this, 'afrfq_settings_page')
			);

			add_submenu_page( 'edit.php?post_type=addify_rfq', esc_html__( 'All Submitted Quotes', 'addify_rfq' ), esc_html__( 'All Submitted Quotes', 'addify_rfq' ), 'manage_options', 'edit.php?post_type=addify_quote', '' );

			
		}

		

		public function searchForId( $id, $array) {

			if (!empty($array)) {
				foreach ($array as $key => $val) {
					if ($val['field_key'] === $id) {
						return $key;
					}
				}
			}
			return null;
		}

		public function afrfq_settings_page() {
			?>

			<div id="addify_settings_tabs">
				<div class="addify_setting_tab_ulli">
					<div class="addify-logo">
						<img src="<?php echo esc_url(AFRFQ_URL . '/assets/images/addify-logo.png'); ?>" width="200">
						<h2><?php echo esc_html__('Addify Plugin Options', 'addify_rfq'); ?></h2>
					</div>

					<ul>
						<li><a href="#tabs-1"><span class="dashicons dashicons-admin-tools"></span><?php echo esc_html__('General Settings', 'addify_rfq'); ?></a></li>
						<li><a href="#tabs-2"><span class="dashicons dashicons-admin-tools"></span><?php echo esc_html__('Fields Settings', 'addify_rfq'); ?></a></li>
						<li><a href="#tabs-3"><span class="dashicons dashicons-admin-tools"></span><?php echo esc_html__('Captcha Settings', 'addify_rfq'); ?></a></li>

					</ul>
				</div>
				<div class="addify-tabs-content">
					<form id="addify_setting_form" action="" method="post">
						<?php wp_nonce_field('afquote_nonce_action', 'afquote_nonce_field'); ?>
						<div class="addify-top-content">
							<h1><?php echo esc_html__('Addify Request for Quote Module Settings', 'addify_rfq'); ?></h1>
						</div>

						<div class="addify-singletab" id="tabs-1">
							<h2><?php echo esc_html__('General Settings', 'addify_rfq'); ?></h2>
							<table class="addify-table-optoin">
								<tbody>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Quote Basket Placement', 'addify_rfq'); ?></h3>
											</div>
											<span class="description">
												<p><?php echo esc_html__('Select Menu where you want to show Mini Quote Basket. If there is no menu then you have to create menu in WordPress menus otherwise mini quote basket will not show.', 'addify_rfq'); ?></p>
											</span>
										</th>
										<td>
											<?php 
												$menus = get_terms('nav_menu');
											?>
											<select name="quote_menu">
												<option value=""><?php echo esc_html__('---Choose Menu---', 'addify_rfq'); ?></option>
												<?php
												foreach ($menus as $menu) {
													?>
													<option value="<?php echo intval($menu->term_id); ?>" <?php echo selected($menu->term_id, esc_attr(get_option('quote_menu'))); ?>><?php echo esc_attr($menu->name); ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Enable for Guest', 'addify_rfq'); ?></h3>
											</div>
											<span class="description">
												<p><?php echo esc_html__('Enable or Disable quote for guest users.', 'addify_rfq'); ?></p>
											</span>
										</th>
										<td>
											<div id="like_dislike">
												<input checked value="enabled" class="allow_guest likespermission" id="extld0" type="radio" name="allow_guest" <?php echo checked( get_option('allow_guest'), 'enabled'); ?>>
												<label class="extndc" for="extld0"><?php echo esc_html__('Enabled', 'fmearf'); ?></label>
												<input value="disabled" class="allow_guest likespermission" id="extld1" type="radio" name="allow_guest" <?php echo checked( get_option('allow_guest'), 'disabled'); ?>>
												<label class="extndc" for="extld1"><?php echo  esc_html__('Disabled', 'fmearf'); ?></label>
												<div id="like_dislikeb"></div>
											</div>
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Enable Ajax add to Quote (Shop Page)', 'addify_rfq'); ?></h3>
											</div>
											<span class="description">
												<p><?php echo esc_html__('Enable or Disable ajax add to quote on shop page.', 'addify_rfq'); ?></p>
											</span>
										</th>
										<td>
											<input type="checkbox" name="enable_ajax_shop" id="enable_ajax_shop" value="yes" <?php echo checked('yes', esc_attr(get_option('enable_ajax_shop'))); ?> >
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Enable Ajax add to Quote (Product Page)', 'addify_rfq'); ?></h3>
											</div>
											<span class="description">
												<p><?php echo esc_html__('Enable or Disable ajax add to quote on product page.', 'addify_rfq'); ?></p>
											</span>
										</th>
										<td>
											<input type="checkbox" name="enable_ajax_product" id="enable_ajax_product" value="yes" <?php echo checked('yes', esc_attr(get_option('enable_ajax_product'))); ?> >
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Success Message', 'addify_rfq'); ?></h3>
											</div>
											<span class="description">
											<p><?php echo esc_html__('This message will appear on quote submission page, when user submit quote.', 'addify_rfq'); ?></p>
										</span>
										</th>
										<td>
											<?php
											if (!empty(get_option('afrfq_success_message'))) {
												$afrfq_success_message =  get_option('afrfq_success_message');
											} else {
												$afrfq_success_message = '';
											}
											?>
											<input value="<?php echo esc_attr($afrfq_success_message); ?>" class="afrfq_input_class" type="text" name="afrfq_success_message" id="afrfq_success_message" />
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Email Subject', 'addify_rfq'); ?></h3>
											</div>
											<span class="description">
											<p><?php echo esc_html__('This subject will be used when email is sent to user when quote is submitted.', 'addify_rfq'); ?></p>
										</span>
										</th>
										<td>
											<?php
											if (!empty(get_option('afrfq_email_subject'))) {
												$afrfq_email_subject = get_option('afrfq_email_subject');
											} else {
												$afrfq_email_subject = '';
											}
											?>
											<input value="<?php echo esc_attr($afrfq_email_subject); ?>" class="afrfq_input_class" type="text" name="afrfq_email_subject" id="afrfq_email_subject" />
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Email Response Text', 'addify_rfq'); ?></h3>
											</div>
											<span class="description">
											<p><?php echo esc_html__('This text will be used when email is sent to user when quote is submitted.', 'addify_rfq'); ?></p>
										</span>
										</th>
										<td>
											<div class="afrfq_textarea">
											<?php
											$content   = get_option('afrfq_email_text');
											$editor_id = 'afrfq_email_text';
											$settings  = array(
												'tinymce' => true,
												'textarea_rows' => 10,
												'quicktags' => array('buttons' => 'em,strong,link',),
												'quicktags' => true,
												'tinymce' => true,
											);

											wp_editor($content, $editor_id, $settings);
											?>
											</div>
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Send Copy of Quote to Customer', 'addify_rfq'); ?></h3>
											</div>
											<span class="description">
												<p><?php echo esc_html__('Enable this if you want to send request a quote email copy to customer. Quote details are embad in the above email text.', 'addify_rfq'); ?></p>
											</span>
										</th>
										<td>
											<input type="checkbox" name="enable_user_mail" id="enable_user_mail" value="yes" <?php echo checked('yes', esc_attr(get_option('enable_user_mail'))); ?> >
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Admin/Shop Manager Email', 'addify_rfq'); ?></h3>
											</div>
										</th>
										<td>
											<input type="text" class="afrfq_input_class" name="afrfq_admin_email" id="afrfq_admin_email" value="<?php echo esc_attr(get_option('afrfq_admin_email')); ?>" />
											<p><?php echo esc_html__('All admin emails that are related to our module will be sent to this email address. If this email is empty then default admin email address is used. You can add more than one email addresses separated by comma (,).', 'addify_rfq'); ?></p>
										</td>
									</tr>

								</tbody>
							</table>
						</div>

						<div class="addify-singletab" id="tabs-2">
							<h2><?php echo esc_html__('Fields Settings', 'addify_rfq'); ?></h2>
							<h3><?php echo esc_html__('Standard Fields', 'addify_rfq'); ?></h3>
							<div class="namediv">
								<span class="divleft"><?php echo esc_html__('Name Field', 'addify_rfq'); ?></span>
								<span class="devright"><?php echo esc_html__('Click to Expand', 'addify_rfq'); ?></span>
							</div>
							<div class="fieldsdiv">
								<table class="addify-table-optoin">
									<tbody>

										<?php

											$name_field_array = unserialize(get_option('afrfq_fields'));
											$name_field_key   = $this->searchForId('afrfq_name_field', $name_field_array);

										if (!empty($name_field_key)) {

											$name_is_enabled  = $name_field_array[$name_field_key]['enable_field'];
											$name_is_required = $name_field_array[$name_field_key]['field_required'];
											$name_sort_order  = $name_field_array[$name_field_key]['field_sort_order'];
											$name_label       = $name_field_array[$name_field_key]['field_label'];
										} else {
												
											$name_is_enabled  = '';
											$name_is_required = '';
											$name_label       = '';
											$name_sort_order  = '';

										}
											
										?>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Enable Name Field', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[0][enable_field]" id="afrfq_enable_name_field" value="yes" <?php echo checked('yes', esc_attr($name_is_enabled)); ?> />
												<p><?php echo esc_html__('Enable Name field on the Request a Quote Form.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('is Required?', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[0][field_required]" id="afrfq_name_field_required" value="yes" <?php echo  checked('yes', esc_attr($name_is_required)); ?> />
												<p><?php echo esc_html__('Check if you want to make Name field required.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Sort Order', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="number" name="afrfq_fields[0][field_sort_order]" id="aftax_name_field_sortorder" min="0" value="<?php echo esc_attr($name_sort_order); ?>" />
												<p><?php echo esc_html__('Sort Order of the Name field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Label', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[0][field_label]" id="afrfq_name_field_label"  value="<?php echo esc_attr($name_label); ?>" />
												<p><?php echo esc_html__('Label of the Name field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<input type="hidden" name="afrfq_fields[0][field_key]" value="afrfq_name_field">

										
									</tbody>
								</table>
							</div>


							<div class="emaildiv">
								<span class="divleft"><?php echo esc_html__('Email Field', 'addify_rfq'); ?></span>
								<span class="devright"><?php echo esc_html__('Click to Expand', 'addify_rfq'); ?></span>
							</div>
							<div class="emailfieldsdiv">
								<table class="addify-table-optoin">
									<tbody>

										<?php

											$email_field_array = unserialize(get_option('afrfq_fields'));
											$email_field_key   = $this->searchForId('afrfq_email_field', $email_field_array);

										if (!empty($email_field_key)) {

											$email_is_enabled  = $email_field_array[$email_field_key]['enable_field'];
											$email_is_required = $email_field_array[$email_field_key]['field_required'];
											$email_sort_order  = $email_field_array[$email_field_key]['field_sort_order'];
											$email_label       = $email_field_array[$email_field_key]['field_label'];
										} else {
												
											$email_is_enabled  = '';
											$email_is_required = '';
											$email_label       = '';
											$email_sort_order  = '';

										}
											
										?>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Enable Email Field', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[1][enable_field]" id="afrfq_enable_email_field" value="yes" <?php echo  checked('yes', esc_attr($email_is_enabled)); ?> />
												<p><?php echo esc_html__('Enable Email field on the Request a Quote Form.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('is Required?', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[1][field_required]" id="afrfq_email_field_required" value="yes" <?php echo  checked('yes', esc_attr($email_is_required)); ?> />
												<p><?php echo esc_html__('Check if you want to make Email field required.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Sort Order', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="number" name="afrfq_fields[1][field_sort_order]" id="afrfq_email_field_sortorder" min="0" value="<?php echo esc_attr($email_sort_order); ?>" />
												<p><?php echo esc_html__('Sort Order of the Email field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Label', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[1][field_label]" id="afrfq_email_field_label"  value="<?php echo esc_attr($email_label); ?>" />
												<p><?php echo esc_html__('Label of the Email field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<input type="hidden" name="afrfq_fields[1][field_key]" value="afrfq_email_field">

										
									</tbody>
								</table>
							</div>

							<div class="companydiv">
								<span class="divleft"><?php echo esc_html__('Company Field', 'addify_rfq'); ?></span>
								<span class="devright"><?php echo esc_html__('Click to Expand', 'addify_rfq'); ?></span>
							</div>
							<div class="companyfieldsdiv">
								<table class="addify-table-optoin">
									<tbody>

										<?php

											$company_field_array = unserialize(get_option('afrfq_fields'));
											$company_field_key   = $this->searchForId('afrfq_company_field', $company_field_array);
										if (!empty($company_field_key)) {

											$company_is_enabled  = $company_field_array[$company_field_key]['enable_field'];
											$company_is_required = $company_field_array[$company_field_key]['field_required'];
											$company_sort_order  = $company_field_array[$company_field_key]['field_sort_order'];
											$company_label       = $company_field_array[$company_field_key]['field_label'];
										} else {
												
											$company_is_enabled  = '';
											$company_is_required = '';
											$company_label       = '';
											$company_sort_order  = '';

										}
											
											
										?>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Enable Company Field', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[2][enable_field]" id="afrfq_enable_company_field" value="yes" <?php echo checked('yes', esc_attr($company_is_enabled)); ?> />
												<p><?php echo esc_html__('Enable Company field on the Request a Quote Form.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('is Required?', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[2][field_required]" id="afrfq_company_field_required" value="yes" <?php echo  checked('yes', esc_attr($company_is_required)); ?> />
												<p><?php echo esc_html__('Check if you want to make Company field required.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Sort Order', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="number" name="afrfq_fields[2][field_sort_order]" id="afrfq_company_field_sortorder" min="0" value="<?php echo esc_attr($company_sort_order); ?>" />
												<p><?php echo esc_html__('Sort Order of the Company field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Label', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[2][field_label]" id="afrfq_company_field_label"  value="<?php echo esc_attr($company_label); ?>" />
												<p><?php echo esc_html__('Label of the Company field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<input type="hidden" name="afrfq_fields[2][field_key]" value="afrfq_company_field">

										
									</tbody>
								</table>
							</div>


							<div class="phonediv">
								<span class="divleft"><?php echo esc_html__('Phone Field', 'addify_rfq'); ?></span>
								<span class="devright"><?php echo esc_html__('Click to Expand', 'addify_rfq'); ?></span>
							</div>
							<div class="phonefieldsdiv">
								<table class="addify-table-optoin">
									<tbody>

										<?php

											$phone_field_array = unserialize(get_option('afrfq_fields'));
											$phone_field_key   = $this->searchForId('afrfq_phone_field', $phone_field_array);
										if (!empty($phone_field_key)) {

											$phone_is_enabled  = $phone_field_array[$phone_field_key]['enable_field'];
											$phone_is_required = $phone_field_array[$phone_field_key]['field_required'];
											$phone_sort_order  = $phone_field_array[$phone_field_key]['field_sort_order'];
											$phone_label       = $phone_field_array[$phone_field_key]['field_label'];
										} else {
												
											$phone_is_enabled  = '';
											$phone_is_required = '';
											$phone_label       = '';
											$phone_sort_order  = '';

										}
											
											
										?>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Enable Phone Field', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[3][enable_field]" id="afrfq_enable_phone_field" value="yes" <?php echo checked('yes', esc_attr($phone_is_enabled)); ?> />
												<p><?php echo esc_html__('Enable Phone field on the Request a Quote Form.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('is Required?', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[3][field_required]" id="afrfq_phone_field_required" value="yes" <?php echo  checked('yes', esc_attr($phone_is_required)); ?> />
												<p><?php echo esc_html__('Check if you want to make Phone field required.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Sort Order', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="number" name="afrfq_fields[3][field_sort_order]" id="afrfq_phone_field_sortorder" min="0" value="<?php echo esc_attr($phone_sort_order); ?>" />
												<p><?php echo esc_html__('Sort Order of the Phone field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Label', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[3][field_label]" id="afrfq_phone_field_label"  value="<?php echo esc_attr($phone_label); ?>" />
												<p><?php echo esc_html__('Label of the Phone field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<input type="hidden" name="afrfq_fields[3][field_key]" value="afrfq_phone_field">

										
									</tbody>
								</table>
							</div>


							<div class="filediv">
								<span class="divleft"><?php echo esc_html__('File/Image Upload Field', 'addify_rfq'); ?></span>
								<span class="devright"><?php echo esc_html__('Click to Expand', 'addify_rfq'); ?></span>
							</div>
							<div class="filefieldsdiv">
								<table class="addify-table-optoin">
									<tbody>

										<?php

											$file_field_array = unserialize(get_option('afrfq_fields'));
											$file_field_key   = $this->searchForId('afrfq_file_field', $file_field_array);
										if (!empty($file_field_key)) {

											$file_is_enabled    = $file_field_array[$file_field_key]['enable_field'];
											$file_is_required   = $file_field_array[$file_field_key]['field_required'];
											$file_sort_order    = $file_field_array[$file_field_key]['field_sort_order'];
											$file_label         = $file_field_array[$file_field_key]['field_label'];
											$file_allowed_types = $file_field_array[$file_field_key]['file_allowed_types'];
										} else {
												
											$file_is_enabled    = '';
											$file_is_required   = '';
											$file_label         = '';
											$file_sort_order    = '';
											$file_allowed_types = '';

										}
											
											
										?>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Enable File Upload Field', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[4][enable_field]" id="afrfq_enable_phone_field" value="yes" <?php echo checked('yes', esc_attr($file_is_enabled)); ?> />
												<p><?php echo esc_html__('Enable File/Image Upload field on the Request a Quote Form.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('is Required?', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[4][field_required]" id="afrfq_phone_field_required" value="yes" <?php echo  checked('yes', esc_attr($file_is_required)); ?> />
												<p><?php echo esc_html__('Check if you want to make File/Image Upload field required.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Sort Order', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="number" name="afrfq_fields[4][field_sort_order]" id="afrfq_phone_field_sortorder" min="0" value="<?php echo esc_attr($file_sort_order); ?>" />
												<p><?php echo esc_html__('Sort Order of the File/Image Upload field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Label', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[4][field_label]" id="afrfq_phone_field_label"  value="<?php echo esc_attr($file_label); ?>" />
												<p><?php echo esc_html__('Label of the File/Image Upload field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Allowed Types', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[4][file_allowed_types]" id="afrfq_file_allowed_types"  value="<?php echo esc_attr($file_allowed_types); ?>" />
												<p><?php echo esc_html__('Allowed file upload types. e.g (png,jpg,txt). Add comma separated, please do not use dot(.).', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<input type="hidden" name="afrfq_fields[4][field_key]" value="afrfq_file_field">

										
									</tbody>
								</table>
							</div>


							<div class="messagediv">
								<span class="divleft"><?php echo esc_html__('Message Field', 'addify_rfq'); ?></span>
								<span class="devright"><?php echo esc_html__('Click to Expand', 'addify_rfq'); ?></span>
							</div>
							<div class="messagefieldsdiv">
								<table class="addify-table-optoin">
									<tbody>

										<?php

											$message_field_array = unserialize(get_option('afrfq_fields'));
											$message_field_key   = $this->searchForId('afrfq_message_field', $message_field_array);
										if (!empty($message_field_key)) {

											$message_is_enabled  = $message_field_array[$message_field_key]['enable_field'];
											$message_is_required = $message_field_array[$message_field_key]['field_required'];
											$message_sort_order  = $message_field_array[$message_field_key]['field_sort_order'];
											$message_label       = $message_field_array[$message_field_key]['field_label'];
										} else {
												
											$message_is_enabled  = '';
											$message_is_required = '';
											$message_label       = '';
											$message_sort_order  = '';

										}
											
											
										?>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Enable Message Field', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[5][enable_field]" id="afrfq_enable_message_field" value="yes" <?php echo checked('yes', esc_attr($message_is_enabled)); ?> />
												<p><?php echo esc_html__('Enable Message field on the Request a Quote Form.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('is Required?', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[5][field_required]" id="afrfq_message_field_required" value="yes" <?php echo  checked('yes', esc_attr($message_is_required)); ?> />
												<p><?php echo esc_html__('Check if you want to make Message field required.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Sort Order', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="number" name="afrfq_fields[5][field_sort_order]" id="afrfq_message_field_sortorder" min="0" value="<?php echo esc_attr($message_sort_order); ?>" />
												<p><?php echo esc_html__('Sort Order of the Message field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Label', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[5][field_label]" id="afrfq_message_field_label"  value="<?php echo esc_attr($message_label); ?>" />
												<p><?php echo esc_html__('Label of the Message field.', 'addify_rfq'); ?></p>
											</td>
										</tr>


										<input type="hidden" name="afrfq_fields[5][field_key]" value="afrfq_message_field">

										
									</tbody>
								</table>
							</div>

							<h3 class="additional_h3"><?php echo esc_html__('Additional Fields', 'addify_rfq'); ?></h3>

							<div class="field1div">
								<span class="divleft"><?php echo esc_html__('Field 1', 'addify_rfq'); ?></span>
								<span class="devright"><?php echo esc_html__('Click to Expand', 'addify_rfq'); ?></span>
							</div>
							<div class="field1fieldsdiv">
								<table class="addify-table-optoin">
									<tbody>

										<?php

											$field1_field_array = unserialize(get_option('afrfq_fields'));
											$field1_field_key   = $this->searchForId('afrfq_field1_field', $field1_field_array);
										if (!empty($field1_field_key)) {

											$field1_is_enabled  = $field1_field_array[$field1_field_key]['enable_field'];
											$field1_is_required = $field1_field_array[$field1_field_key]['field_required'];
											$field1_sort_order  = $field1_field_array[$field1_field_key]['field_sort_order'];
											$field1_label       = $field1_field_array[$field1_field_key]['field_label'];
										} else {
												
											$field1_is_enabled  = '';
											$field1_is_required = '';
											$field1_label       = '';
											$field1_sort_order  = '';

										}
											
											
										?>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Enable Field 1', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[6][enable_field]" id="afrfq_enable_field1_field" value="yes" <?php echo checked('yes', esc_attr($field1_is_enabled)); ?> />
												<p><?php echo esc_html__('Enable Additional Field 1 on the Request a Quote Form.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('is Required?', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[6][field_required]" id="afrfq_field1_field_required" value="yes" <?php echo  checked('yes', esc_attr($field1_is_required)); ?> />
												<p><?php echo esc_html__('Check if you want to make Additional Field 1 field required.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Sort Order', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="number" name="afrfq_fields[6][field_sort_order]" id="afrfq_field1_field_sortorder" min="0" value="<?php echo esc_attr($field1_sort_order); ?>" />
												<p><?php echo esc_html__('Sort Order of the Additional Field 1 field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Label', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[6][field_label]" id="afrfq_field1_field_label"  value="<?php echo esc_attr($field1_label); ?>" />
												<p><?php echo esc_html__('Label of the Additional Field 1 field.', 'addify_rfq'); ?></p>
											</td>
										</tr>


										<input type="hidden" name="afrfq_fields[6][field_key]" value="afrfq_field1_field">

										
									</tbody>
								</table>
							</div>


							<div class="field2div">
								<span class="divleft"><?php echo esc_html__('Field 2', 'addify_rfq'); ?></span>
								<span class="devright"><?php echo esc_html__('Click to Expand', 'addify_rfq'); ?></span>
							</div>
							<div class="field2fieldsdiv">
								<table class="addify-table-optoin">
									<tbody>

										<?php

											$field2_field_array = unserialize(get_option('afrfq_fields'));
											$field2_field_key   = $this->searchForId('afrfq_field2_field', $field2_field_array);
										if (!empty($field2_field_key)) {

											$field2_is_enabled  = $field2_field_array[$field2_field_key]['enable_field'];
											$field2_is_required = $field2_field_array[$field2_field_key]['field_required'];
											$field2_sort_order  = $field2_field_array[$field2_field_key]['field_sort_order'];
											$field2_label       = $field2_field_array[$field2_field_key]['field_label'];
										} else {
												
											$field2_is_enabled  = '';
											$field2_is_required = '';
											$field2_label       = '';
											$field2_sort_order  = '';

										}
											
											
										?>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Enable Field 2', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[7][enable_field]" id="afrfq_enable_field2_field" value="yes" <?php echo checked('yes', esc_attr($field2_is_enabled)); ?> />
												<p><?php echo esc_html__('Enable Additional Field 2 on the Request a Quote Form.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('is Required?', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[7][field_required]" id="afrfq_field2_field_required" value="yes" <?php echo  checked('yes', esc_attr($field2_is_required)); ?> />
												<p><?php echo esc_html__('Check if you want to make Additional Field 2 field required.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Sort Order', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="number" name="afrfq_fields[7][field_sort_order]" id="afrfq_field2_field_sortorder" min="0" value="<?php echo esc_attr($field2_sort_order); ?>" />
												<p><?php echo esc_html__('Sort Order of the Additional Field 2 field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Label', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[7][field_label]" id="afrfq_field2_field_label"  value="<?php echo esc_attr($field2_label); ?>" />
												<p><?php echo esc_html__('Label of the Additional Field 2 field.', 'addify_rfq'); ?></p>
											</td>
										</tr>


										<input type="hidden" name="afrfq_fields[7][field_key]" value="afrfq_field2_field">

										
									</tbody>
								</table>
							</div>


							<div class="field3div">
								<span class="divleft"><?php echo esc_html__('Field 3', 'addify_rfq'); ?></span>
								<span class="devright"><?php echo esc_html__('Click to Expand', 'addify_rfq'); ?></span>
							</div>
							<div class="field3fieldsdiv">
								<table class="addify-table-optoin">
									<tbody>

										<?php

											$field3_field_array = unserialize(get_option('afrfq_fields'));
											$field3_field_key   = $this->searchForId('afrfq_field3_field', $field3_field_array);
										if (!empty($field3_field_key)) {

											$field3_is_enabled  = $field3_field_array[$field3_field_key]['enable_field'];
											$field3_is_required = $field3_field_array[$field3_field_key]['field_required'];
											$field3_sort_order  = $field3_field_array[$field3_field_key]['field_sort_order'];
											$field3_label       = $field3_field_array[$field3_field_key]['field_label'];
										} else {
												
											$field3_is_enabled  = '';
											$field3_is_required = '';
											$field3_label       = '';
											$field3_sort_order  = '';

										}
											
											
										?>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Enable Field 3', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[8][enable_field]" id="afrfq_enable_field3_field" value="yes" <?php echo checked('yes', esc_attr($field3_is_enabled)); ?> />
												<p><?php echo esc_html__('Enable Additional Field 3 on the Request a Quote Form.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('is Required?', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input type="checkbox" name="afrfq_fields[8][field_required]" id="afrfq_field3_field_required" value="yes" <?php echo  checked('yes', esc_attr($field3_is_required)); ?> />
												<p><?php echo esc_html__('Check if you want to make Additional Field 3 field required.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Sort Order', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="number" name="afrfq_fields[8][field_sort_order]" id="afrfq_field3_field_sortorder" min="0" value="<?php echo esc_attr($field3_sort_order); ?>" />
												<p><?php echo esc_html__('Sort Order of the Additional Field 3 field.', 'addify_rfq'); ?></p>
											</td>
										</tr>

										<tr class="addify-option-field">
											<th>
												<div class="option-head">
													<h3><?php echo esc_html__('Label', 'addify_rfq'); ?></h3>
												</div>
											</th>
											<td>
												<input class="afrfq_input_class" type="text" name="afrfq_fields[8][field_label]" id="afrfq_field3_field_label"  value="<?php echo esc_attr($field3_label); ?>" />
												<p><?php echo esc_html__('Label of the Additional Field 3 field.', 'addify_rfq'); ?></p>
											</td>
										</tr>


										<input type="hidden" name="afrfq_fields[8][field_key]" value="afrfq_field3_field">

										
									</tbody>
								</table>
							</div>



						</div>

						<div class="addify-singletab" id="tabs-3">
							<h2><?php echo esc_html__('Google reCaptcha Settings', 'addify_rfq'); ?></h2>
							<table class="addify-table-optoin">
								<tbody>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Enable Captcha', 'addify_rfq'); ?></h3>
											</div>
										</th>
										<td>
											<input type="checkbox" name="afrfq_enable_captcha" id="afrfq_enable_captcha" value="yes" <?php echo checked('yes', esc_attr(get_option('afrfq_enable_captcha'))); ?> />
											<p><?php echo esc_html__('Enable Google reCaptcha field on the Request a Quote Form.', 'addify_rfq'); ?></p>
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Site Key', 'addify_rfq'); ?></h3>
											</div>
										</th>
										<td>
											<input class="afrfq_input_class" type="text" name="afrfq_site_key" id="afrfq_site_key"  value="<?php echo esc_attr(get_option('afrfq_site_key')); ?>" />
											<p><?php echo esc_html__('This is Google reCaptcha site key, you can get this from google. Without this key google reCaptcha will not work.', 'addify_rfq'); ?></p>
										</td>
									</tr>

									<tr class="addify-option-field">
										<th>
											<div class="option-head">
												<h3><?php echo esc_html__('Secret Key', 'addify_rfq'); ?></h3>
											</div>
										</th>
										<td>
											<input class="afrfq_input_class" type="text" name="afrfq_secret_key" id="afrfq_secret_key"  value="<?php echo esc_attr(get_option('afrfq_secret_key')); ?>" />
											<p><?php echo esc_html__('This is Google reCaptcha secret key, you can get this from google. Without this key google reCaptcha will not work.', 'addify_rfq'); ?></p>
										</td>
									</tr>
									
								</tbody>
							</table>
						</div>

						<?php submit_button(esc_html__('Save Settings', 'addify_rfq' ), 'primary', 'afrfq_save_settings'); ?>
					</form>
				</div>

			</div>

			<?php
		}

		public function afrfq_save_data() {

			global $wp;

			if (!empty($_POST)) {

				if (!empty($_REQUEST['afquote_nonce_field'])) {

						$retrieved_nonce = sanitize_text_field($_REQUEST['afquote_nonce_field']);
				} else {
						$retrieved_nonce = 0;
				}

				if (!wp_verify_nonce($retrieved_nonce, 'afquote_nonce_action')) {

					die('Failed security check');
				}

				if (!isset($_POST['enable_ajax_shop'])) {

					update_option('enable_ajax_shop', '');
				}

				if (!isset($_POST['enable_ajax_product'])) {

					update_option('enable_ajax_product', '');
				}

				if (!isset($_POST['afrfq_enable_captcha'])) {

					update_option('afrfq_enable_captcha', '');
				}

				foreach ($_POST as $key => $value) {

					if ('afrfq_save_settings' != $key) {

						if ('afrfq_email_text' == $key) {

							if (!empty($_POST['afrfq_email_text'])) {
								update_option('afrfq_email_text', sanitize_meta('afrfq_email_text', $_POST['afrfq_email_text'], ''));
							}

						} elseif ('afrfq_fields' == $key) {

							$newval = array();
							$a      = 0;

							if (!empty($_POST['afrfq_fields'])) {

								$afrfq_fields = sanitize_meta( '', $_POST['afrfq_fields'], '');
							} else {
								$afrfq_fields = '';
							}

							if (!empty($afrfq_fields)) {
								foreach ($afrfq_fields as $vall) {

									if (!empty($vall['enable_field'])) {

										$enable_field = $vall['enable_field'];
									} else {
										$enable_field = '';
									}

									if (!empty($vall['field_required'])) {

										$field_required = $vall['field_required'];
									} else {
										$field_required = '';
									}

									if (!empty($vall['field_label'])) {

										$field_label = $vall['field_label'];
									} else {
										$field_label = '';
									}

									if (!empty($vall['field_sort_order'])) {

										$field_sort_order = $vall['field_sort_order'];
									} else {
										$field_sort_order = '';
									}

									if (!empty($vall['file_allowed_types'])) {

										$file_allowed_types = $vall['file_allowed_types'];
									} else {
										$file_allowed_types = '';
									}

									if (!empty($vall['field_key'])) {

										$field_key = $vall['field_key'];
									} else {
										$field_key = '';
									}

									$newval['field_' . $a] = array('enable_field' => $enable_field, 'field_required' => $field_required, 'field_label' => $field_label, 'field_sort_order' => $field_sort_order, 'field_key' => $field_key, 'file_allowed_types' => $file_allowed_types);

									$a++;

								}
							}

							update_option('afrfq_fields', serialize(sanitize_meta('afrfq_fields', $newval, '')));
						} else {
							update_option(esc_attr($key), esc_attr($value));
						}

						
					}
				}
			}
		}

		public function afrfq_author_admin_notice() {
			?>
			<div class="updated notice notice-success is-dismissible">
				<p><?php echo esc_html__('Settings saved successfully.', 'addify_rfq'); ?></p>
			</div>
			<?php
		}

		public function addify_quote_columns_head( $columns) {

			$new_columns          = array();
			$new_columns['cb']    = '<input type="checkbox" />';
			$new_columns['title'] = esc_html__('Quote #', 'addify_rfq');
			$new_columns['name']  = esc_html__('Customer Name', 'addify_rfq');
			$new_columns['email'] = esc_html__('Customer Email', 'addify_rfq');
			$new_columns['date']  = esc_html__('Date', 'addify_rfq');
			return $new_columns;

		}

		public function addify_quote_columns_content( $column_name, $post_ID) {

			switch ($column_name) {
				case 'email':
					echo esc_attr(get_post_meta($post_ID, 'afrfq_email_field', true));
					break;

				case 'name':
					echo esc_attr(get_post_meta($post_ID, 'afrfq_name_field', true));
					break;

				
			}

		}

		public function addify_afrfq_action_row( $actions, $post) {


			if ('addify_quote' == $post->post_type) {

				echo '<style type="text/css">
				.page-title-action { display:none; }
				</style>';

				$actions['edit'] = '<a href="' . get_edit_post_link($post->ID) . '" title="' . esc_html__('View this item', 'addify_rfq') . '">' . esc_html__('View', 'addify_rfq') . '</a>';
				unset($actions['inline hide-if-no-js']);
				unset($actions['view']);
			}
			return $actions;

		}

		public function addify_afrfq_post_edit_form( $post) {

			if ('addify_quote' != $post->post_type) {
				return;
			}
			global $wpmeta_boxes;
			// remove all meta boxes
			$wpmeta_boxes = array('addify_quote' => array(
				'advanced' => array(),
				'side' => array(),
				'normal' => array(),
			));


				echo '<style type="text/css">
				.page-title-action { display:none; }
				</style>';


			require_once AFRFQ_PLUGIN_DIR . 'admin/addify-afrfq-edit-form.php';

		}

		public function afrfqsearchProducts() {

			

			if (isset($_POST['nonce']) && '' != $_POST['nonce']) {

				$nonce = sanitize_text_field( $_POST['nonce'] );
			} else {
				$nonce = 0;
			}

			if (isset($_POST['q']) && '' != $_POST['q']) {

				if ( ! wp_verify_nonce( $nonce, 'afquote-ajax-nonce' ) ) {

					die ( 'Failed ajax security check!');
				}
				

				$pro = sanitize_text_field( $_POST['q'] );

			} else {

				$pro = '';

			}


			$data_array = array();
			$args       = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'numberposts' => -1,
				's'	=>  $pro
			);
			$pros       = get_posts($args);

			if ( !empty($pros)) {

				foreach ($pros as $proo) {

					$title        = ( mb_strlen( $proo->post_title ) > 50 ) ? mb_substr( $proo->post_title, 0, 49 ) . '...' : $proo->post_title;
					$data_array[] = array( $proo->ID, $title ); // array( Post ID, Post Title )
				}
			}
			
			echo json_encode( $data_array );

			die();
		}
	}

	new Addify_Request_For_Quote_Admin();

}
