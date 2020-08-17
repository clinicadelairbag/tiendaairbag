<?php


global $wp_session;

if ( ! session_id() ) {
	session_start();
}


if ( ! defined( 'WPINC' ) ) {
	die;
}


$is_allowed_guest = get_option('allow_guest');
if ('disabled' == $is_allowed_guest && !is_user_logged_in()) {

	$afrfq_allowed_tags = array(
		'a' => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
		),
		'b' => array(),

		'div' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'p' => array(
			'class' => array(),
		),
		'strong' => array(),

	);

	$afrfq_woo_check = "<div class='woocommerce-error'>Please <a href='" . get_permalink(get_option('woocommerce_myaccount_page_id')) . "'>Login to submit quote.</div></div>";
	echo wp_kses( __( $afrfq_woo_check, 'addify_rfq' ), $afrfq_allowed_tags);

	return;
}

if (!empty(WC()->session->get( 'quotes' ))) {


	$quotes         = WC()->session->get( 'quotes' );
	$user           = null;
	$user_name      = '';
	$user_email_add = '';

	if (is_user_logged_in()) {
		$user = wp_get_current_user(); // object
		if ('' == $user->user_firstname && '' == $user->user_lastname) {
			$user_name = $user->nickname; // probably admin user
		} elseif ('' == $user->user_firstname || '' == $user->user_lastname) {
			$user_name = trim($user->user_firstname . ' ' . $user->user_lastname);
		} else {
			$user_name = trim($user->user_firstname . ' ' . $user->user_lastname);
		}

		$user_email_add = $user->user_email;
	}
	?>
	<div class="woocommerce">
		<form class="woocommerce-cart-form" id="addify_rfq_form" method="post" enctype="multipart/form-data">
			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<thead>
					<tr>
						<th class="product-remove">&nbsp;</th>
						<th class="product-thumbnail">&nbsp;</th>
						<th class="product-name"><?php echo esc_html__('Product', 'addify_rfq'); ?></th>
						<th class="product-sku"><?php echo esc_html__('Product SKU', 'addify_rfq'); ?></th>
						<th class="product-quantity"><?php echo esc_html__('Quantity', 'addify_rfq'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$quote_key = 0;
				if (!empty($quotes)) {
					foreach ($quotes as $quote) {

						$product_id = $quote['pid'];
						$quantity   = $quote['quantity'];

						$product   = wc_get_product( $product_id );
						$item_data = array();
						$var_data  = array();
						$str       = '?';

						if (!empty( $quote['variation']  ) ) {
							$data_var_arry = base64_encode(serialize($quote['variation']));
							$variation     = $quote['variation'];
							foreach ( $variation as $name => $value ) {
								$taxonomy1          = str_replace( 'attribute_', '', $value[0] ) ;
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
						} else {

							$data_var_arry = '';
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
							$variation     = wc_get_product($quote['vari_id']);
							$p_title       = explode('(', $variation->get_formatted_name());
							$product_title = $product->get_title();
							$product_url   = $variation->get_permalink();
							$image         = wp_get_attachment_image_src( get_post_thumbnail_id( $quote['vari_id'] ), 'single-post-thumbnail' );
							$pid           = $quote['vari_id'];
							$sku           = $variation->get_sku();
						} else {
							$product       = wc_get_product($product_id);
							$product_title = $product->get_title();
							$product_url   = $product->get_permalink();
							$image         = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );
							$pid           = $product_id;

							$sku = $product->get_sku();

						}
						?>

						<input type="hidden" id="proname" name="proname[]"
							   value="<?php echo esc_attr($product_title); ?>" />
						<input type="hidden" id="proid" name="proid[]"
							   value="<?php echo esc_attr($pid); ?>" />
						<input type="hidden" id="proimage" name="proimage[]"
							   value="<?php echo esc_url($image[0]); ?>" />
						<input type="hidden" id="prourl" name="prourl[]"
							   value="<?php echo esc_url($product_url); ?>" />
							   <input type="hidden" id="prosku" name="prosku[]"
							   value="<?php echo esc_attr($sku); ?>" />

							   <input type="hidden" id="variation" name="variation[]"value="<?php echo wp_kses_post($data_var_arry); ?>" />

						<input type="hidden" id="woo_addons" name="woo_addons[]"
							   value="<?php echo esc_attr($w_add); ?>" />

						<input type="hidden" id="woo_addons1" name="woo_addons1[]"
							   value="<?php echo esc_attr($w_add1); ?>" />

						<tr class="cart_item">
							<td class="product-remove">
								<a href="javascript:void(0)" class="remove"
								   title="<?php echo esc_html__('Remove this item', 'addify_rfq'); ?>"
								   data-quote_key="<?php echo esc_attr($quote_key); ?>" onclick="af_remove_quote_cart('<?php echo esc_attr($quote_key); ?>')">×</a>
							</td>
							<td class="product-thumbnail">
								<a href="<?php echo esc_url($product_url); ?>">
									<img src="<?php echo esc_url($image[0]); ?>" width="180">
								</a>
							</td>
							<td class="product-name">
								<a href="<?php echo esc_url($product_url); ?>"><?php echo esc_attr($product_title); ?> </a>
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

											?>
											<?php echo esc_attr($wooaddons[$a]); ?><br />
												<?php
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

											?>
												
											<?php
										}
									}
								}

								?>
								</div>
							</td>
							<td class="product-sku">
								<?php echo esc_attr($sku); ?>
							</td>
							<td class="product-quantity">
								<div class="quantity">
									<input class="input-text qty text" id='qty' step="1" min="1" max="" name="qty[]"
										   value="<?php echo esc_attr($quantity); ?>" title="Qty" size="4"
										   pattern="[0-9]*" inputmode="numeric" type="number">
								</div>
							</td>
						</tr>

						<?php
						$quote_key++;
					}
				}
				?>
				</tbody>
			</table>

			<?php

			$af_fields = unserialize(get_option('afrfq_fields'));
			
			if (!empty($af_fields)) {
				$sort_order = array_column($af_fields, 'field_sort_order');
				$new_sort   = array_multisort($sort_order, SORT_ASC, $af_fields);
			}

			?>

			<div class="af_quote_form">

				<?php
				if (!empty($af_fields)) {
					foreach ($af_fields as $rf_form_field) {

						if ('afrfq_email_field' == $rf_form_field['field_key']) {

							$f_type  = 'email';
							$f_value = $user_email_add;

							if (null != $user) {

								$f_readoly = 'readonly';
							} else {
								$f_readoly = '';
							}

							$file_allowed_types = '';

						} elseif ('afrfq_name_field' == $rf_form_field['field_key']) {

							$f_type  = 'text';
							$f_value = $user_name;

							if (null != $user) {

								$f_readoly = 'readonly';
							} else {
								$f_readoly = '';
							}
							$file_allowed_types = '';

						} elseif ('afrfq_file_field' == $rf_form_field['field_key']) {

							$f_type             = 'file';
							$f_value            = '';
							$f_readoly          = '';
							$file_allowed_types = $rf_form_field['file_allowed_types'];

						} elseif ('afrfq_phone_field' == $rf_form_field['field_key']) {

							$f_type             = 'tel';
							$f_value            = '';
							$f_readoly          = '';
							$file_allowed_types = '';

						} else {

							$f_type             = 'text';
							$f_value            = '';
							$f_readoly          = '';
							$file_allowed_types = '';
						}

						if ('yes' == $rf_form_field['field_required']) {

							$f_required      = 'required';
							$f_required_star = '*';
						} else {
							$f_required      = '';
							$f_required_star = '';
						}
						?>

						<?php if ('yes' == $rf_form_field['enable_field']) { ?>

							<?php if ('afrfq_message_field' != $rf_form_field['field_key']) { ?>

								<div class="form_row">
									<label><?php echo esc_html__(esc_attr($rf_form_field['field_label']), 'addify_rfq'); ?>
										<abbr title="required" class="required"><?php echo esc_attr($f_required_star); ?></abbr>
									</label>
									<input class="form_row_input" type="<?php echo esc_attr($f_type); ?>" id="<?php echo esc_attr($rf_form_field['field_key']); ?>" name="<?php echo esc_attr($rf_form_field['field_key']); ?>" <?php echo esc_attr($f_required); ?> value="<?php echo esc_attr( $f_value); ?>" <?php echo esc_attr($f_readoly); ?>/>

									<?php if (!empty($file_allowed_types)) { ?>
										<p class="af_allowed_types"><?php echo esc_html('Allowed Types are: ', 'addify_rfq'); ?><?php echo esc_attr($file_allowed_types); ?></p>
									<?php } ?>
								</div>

							<?php } else { ?>

								<div class="form_row">
									<label><?php echo esc_html__(esc_attr($rf_form_field['field_label']), 'addify_rfq'); ?>
										<abbr title="required" class="required"><?php echo esc_attr($f_required_star); ?></abbr>
									</label>
									
									<textarea class="form_row_input" id="<?php echo esc_attr($rf_form_field['field_key']); ?>" name="<?php echo esc_attr($rf_form_field['field_key']); ?>" rows="7" <?php echo esc_attr($f_required); ?>></textarea>
								</div>

							<?php } ?>
						<?php } ?>

					<?php } ?>

				<?php } ?>

				<?php if ('yes' == get_option('afrfq_enable_captcha')) { ?>

					<?php if (!empty(get_option('afrfq_site_key'))) { ?>

						<div class="form_row">
							<div class="g-recaptcha" data-sitekey="<?php echo esc_attr(get_option('afrfq_site_key')); ?>"></div>
						</div>
					<?php } ?>
				<?php } ?>

				<div class="form_row">
					<input name="afrfq_action" type="hidden" value="save_afrfq"/>
					<?php wp_nonce_field('save_afrfq', 'afrfq_nonce'); ?>
					<input type="submit" value="<?php echo( esc_html__( 'Submit', 'addify_rfq' ) ); ?>" class="button">
				</div>

			</div>
		</form>
	</div>

<?php } else { ?>

	<div class="woocommerce">
		<p class="cart-empty"><?php echo esc_html__('Your quote is currently empty.', 'addify_rfq'); ?></p>
		<p class="return-to-shop"><a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="button wc-backward"><?php echo esc_html__('Return To Shop', 'addify_rfq'); ?></a>
		</p>
	</div>

	<?php
}
