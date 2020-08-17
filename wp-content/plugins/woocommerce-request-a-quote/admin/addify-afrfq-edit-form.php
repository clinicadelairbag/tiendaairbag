<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

$data          = $post;
$post_meta     = get_post_meta($data->ID, 'products', true);
$quote         = json_decode($post_meta, true);
$quotedataname = get_post_meta($data->ID, 'quote_proname', true);
$quotedataid   = get_post_meta($data->ID, 'quote_proid', true);
$quotedataqty  = get_post_meta($data->ID, 'qty', true);
$woo_addons    = get_post_meta($data->ID, 'woo_addons', true);
$woo_addons1   = get_post_meta($data->ID, 'woo_addons1', true);
$variationall  = get_post_meta($data->ID, 'variation', true);

if (!empty($data)) { ?>

	<div class="add_to_quote">
		<h1><?php echo esc_html__('View Quote', 'addify_rfq'); ?></h1>
		<div class="quote_details">
			
			<?php if (!empty($data->post_title)) { ?>

				<div class="quotedata">
					<label><b><?php echo esc_html__('Quote #:', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><?php echo esc_attr($data->post_title); ?></div>
				</div>

			<?php } ?>

			<?php 
			if (!empty($data->afrfq_name_field)) {

				$name_field_array = unserialize(get_option('afrfq_fields'));
				$name_field_key   = $this->searchForId('afrfq_name_field', $name_field_array);

				if (!empty($name_field_array[0]['field_label'])) {
					$name_label = $name_field_array[0]['field_label'];
				} else {
					$name_label = 'Your Name';
				}
				?>

				<div class="quotedata">
					<label><b><?php echo esc_html__($name_label . ':', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><?php echo esc_attr($data->afrfq_name_field); ?></div>
				</div>

			<?php } ?>

			<?php 
			if (!empty($data->afrfq_email_field)) {

				$email_field_array = unserialize(get_option('afrfq_fields'));
				$email_field_key   = $this->searchForId('afrfq_email_field', $email_field_array);

				if (!empty($email_field_array[1]['field_label'])) {

					$email_label = $email_field_array[1]['field_label'];
				} else {
					$email_label = 'Your Email';
				}
				?>

				<div class="quotedata">
					<label><b><?php echo esc_html__($email_label . ':', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><?php echo esc_attr($data->afrfq_email_field); ?></div>
				</div>

			<?php } ?>

			<?php 
			if (!empty($data->afrfq_company_field)) {

				$company_field_array = unserialize(get_option('afrfq_fields'));
				$company_field_key   = $this->searchForId('afrfq_company_field', $company_field_array);

				if (!empty($company_field_array[2]['field_label'])) {

					$company_label = $company_field_array[2]['field_label'];

				} else {

					$company_label = 'Company';

				}
				?>

				<div class="quotedata">
					<label><b><?php echo esc_html__($company_label . ':', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><?php echo esc_attr($data->afrfq_company_field); ?></div>
				</div>

			<?php } ?>

			<?php 
			if (!empty($data->afrfq_phone_field)) {

				$phone_field_array = unserialize(get_option('afrfq_fields'));
				$phone_field_key   = $this->searchForId('afrfq_phone_field', $phone_field_array);

				if (!empty($phone_field_array[3]['field_label'])) {

					$phone_label = $phone_field_array[3]['field_label'];

				} else {

					$phone_label = 'Phone';

				}
				?>

				<div class="quotedata">
					<label><b><?php echo esc_html__($phone_label . ':', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><?php echo esc_attr($data->afrfq_phone_field); ?></div>
				</div>

			<?php } ?>

			<?php 
			if (!empty($data->afrfq_file_field)) {

				$file_field_array = unserialize(get_option('afrfq_fields'));
				$file_field_key   = $this->searchForId('afrfq_file_field', $file_field_array);

				if (!empty($file_field_array[4]['field_label'])) {

					$file_label = $file_field_array[4]['field_label'];

				} else {

					$file_label = 'File Upload';

				}
				?>

				<div class="quotedata">
					<label><b><?php echo esc_html__($file_label . ':', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><a target="_blank" href="<?php echo esc_url(AFRFQ_URL) . 'uploads/' . esc_attr($data->afrfq_file_field); ?>"><?php echo esc_html__('Click to View', 'addify_rfq'); ?></a></div>
				</div>

			<?php } ?>

			<?php 
			if (!empty($data->afrfq_message_field)) {

				$message_field_array = unserialize(get_option('afrfq_fields'));
				$message_field_key   = $this->searchForId('afrfq_message_field', $message_field_array);

				if (!empty($message_field_array[5]['field_label'])) {

					$message_label = $message_field_array[5]['field_label'];

				} else {

					$message_label = 'Message';
				}
				?>

				<div class="quotedata">
					<label><b><?php echo esc_html__($message_label . ':', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><?php echo esc_attr($data->afrfq_message_field); ?></div>
				</div>

			<?php } ?>

			<?php 
			if (!empty($data->afrfq_field1_field)) {

				$field1_field_array = unserialize(get_option('afrfq_fields'));
				$field1_field_key   = $this->searchForId('afrfq_field1_field', $field1_field_array);

				if (!empty($field1_field_array[6]['field_label'])) {

					$field1_label = $field1_field_array[6]['field_label'];

				} else {

					$field1_label = 'Field 1';
				}
				?>

				<div class="quotedata">
					<label><b><?php echo esc_html__($field1_label . ':', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><?php echo esc_attr($data->afrfq_field1_field); ?></div>
				</div>

			<?php } ?>

			<?php 
			if (!empty($data->afrfq_field2_field)) {

				$field2_field_array = unserialize(get_option('afrfq_fields'));
				$field2_field_key   = $this->searchForId('afrfq_field2_field', $field2_field_array);

				if (!empty($field2_field_array[7]['field_label'])) {

					$field2_label = $field2_field_array[7]['field_label'];

				} else {

					$field2_label = 'Field 2';

				}
				?>

				<div class="quotedata">
					<label><b><?php echo esc_html__($field2_label . ':', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><?php echo esc_attr($data->afrfq_field2_field); ?></div>
				</div>

			<?php } ?>

			<?php 
			if (!empty($data->afrfq_field3_field)) {

				$field3_field_array = unserialize(get_option('afrfq_fields'));
				$field3_field_key   = $this->searchForId('afrfq_field3_field', $field3_field_array);

				if (!empty($field3_field_array[8]['field_label'])) {

					$field3_label = $field3_field_array[8]['field_label'];

				} else {

					$field3_label = 'Field 3';

				}
				?>

				<div class="quotedata">
					<label><b><?php echo esc_html__($field3_label . ':', 'addify_rfq'); ?></b></label>
					<div class="cusdetails"><?php echo esc_attr($data->afrfq_field3_field); ?></div>
				</div>

			<?php } ?>

		</div>

		<?php

		if (!empty($quotedataid)) {
			$quote_tab  = '';
			$quote_tab .= '<table border="1" width="1100" class="quotetable">';
			$quote_tab .= '<tr>';
			$quote_tab .= '<th></th>';
			$quote_tab .= '<th><h2>' . esc_html__('Product', 'addify_rfq') . '</h2></th>';
			$quote_tab .= '<th><h2>' . esc_html__('Product SKU', 'addify_rfq') . '</h2></th>';
			$quote_tab .= '<th><h2>' . esc_html__('Quantity', 'addify_rfq') . '</h2></th>';
			$quote_tab .= '</tr>';



			for ($i = 0; $i < count($quotedataid); $i++) {

				$product       = wc_get_product($quotedataid[$i]);
				$image         = get_the_post_thumbnail_url($quotedataid[$i]);
				$product_title = $product->get_title();
				$product_url   = $product->get_permalink();

				$product_sku = $product->get_sku();

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

				$p_title = $product->get_title();

				$quote_tab .= '<tr>';
				$quote_tab .= '<th><a href="' . esc_url($product_url) . '" target="_blank"><img src="' . esc_url($image) . '" width="80"></a></th>';
				$quote_tab .= '<th><a href="' . esc_url($product_url) . '" target="_blank"><b>' . esc_attr($p_title) . '</b></a><div class="woo_options"><dl class="variation">';

				foreach ( $item_data as $key => $datas ) {

					$quote_tab .='<dt class="' . sanitize_html_class( 'variation-' . $key ) . '">' . wp_kses_post( ucfirst($key )) . ':</dt>';
					$quote_tab .='<dd class="' . sanitize_html_class( 'variation-' . $key ) . '">' . wp_kses_post( wpautop( $datas ) ) . '</dd>';
				}

								  $quote_tab .= '</dl>';



				if ('' != $w_add) {
					$wooaddons = explode('-_-', $w_add);

					if ( '' != $wooaddons) {

						for ( $a = 1; $a < count($wooaddons); $a++ ) {

								
							$quote_tab .= $wooaddons[$a] . '<br />';
								
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
								$quote_tab .= $new_b[0] . ' - ' . $new_a[1] . '<br />';
							}

								
						}
					}
				}

				$quote_tab .= '</th>';
				$quote_tab .= '<th><b>' . esc_attr($product_sku) . '</b></th>';
				$quote_tab .= '<th><b>' . esc_attr($quotedataqty[$i]) . '</b></th>';
				$quote_tab .= '</tr>';
			}


			$quote_tab .= '</table>';
			echo wp_kses_post( $quote_tab, '');
		}
		?>

	</div>

	<?php 
}
