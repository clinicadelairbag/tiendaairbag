<?php

global $wp_session;

if ( ! session_id() ) {
	session_start();
}

$pageurl        = get_page_link(get_option('addify_atq_page_id', true));
$quoteItemCount = 0;
foreach ($quotes as $qouteItem) {

	$quoteItemCount += $qouteItem['quantity'];
}
?>
<li class="quote-li" id="quote-li">
				
		<div class="dropdown">
			<input type="hidden" id="total_quote" value="<?php echo intval($quoteItemCount); ?>">
			<div class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<a href="<?php echo esc_url($pageurl); ?>"><span class="dashicons dashicons-cart dashiconsc"></span><span id="total-items" class="totalitems"><?php echo esc_attr($quoteItemCount . ' items in quote'); ?></span></a>
			</div>
			<div class="dropdown-menu scrollable-menu qoute-dropdown" id="dropdown" aria-labelledby="dropdownMenuButton">
				<?php
				$quote_key  = 0;
				$quote_cart = 'quote_cart';
				if (!empty(WC()->session->get( 'quotes' ))) {
					foreach ($quotes as $quote) {

						$product_id    = $quote['pid'];
						$quantity      = $quote['quantity'];
						$product       = wc_get_product($product_id);
						$product_title = $product->get_title();

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
							$variation   = wc_get_product($quote['vari_id']);
							$p_title     = explode('(', $variation->get_formatted_name());
							$pro_title   = $p_title[0];
							$product_url = $variation->get_permalink();
							$pro_image = $variation->get_image();
						} else {
							$pro_title   = $product_title;
							$product_url = $product->get_permalink();
							$pro_image = $product->get_image();
						}
						?>

		<div class="<?php echo esc_attr( $quote_key ); ?>qrow <?php echo esc_attr($quote_key); ?>" id="main-q-row">
				 <div class="loader"></div> 
				<div class="coldel"><span class="dashicons dashicons-no " id="delete-quote" onclick="remove_quote_cart('<?php echo esc_attr($quote_key); ?>');"></span></div>
				<div class="colpro">
					  <div id="title-quote"><div class="pronam"><a href="<?php echo esc_url($product_url); ?>"><?php echo esc_attr($pro_title); ?></a></div>
					  <div class="woo_options_mini">

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

				  </div></div>
					  <div id="quantity"><?php echo esc_attr('Quantity : ' . $quantity, 'addify_rfq'); ?></div>
				 </div>   
				<div class="colimg"><?php echo wp_kses_post( $pro_image); ?></div>    
				   
					
			</div>
						<?php

								$quote_key++;
					}

					?>

	<div class="row view-quote-row" id="main-q-row">
						<div class="col-md-12 main-btn-col"><a href="<?php echo esc_url($pageurl); ?>" class="btn wc-forward" id="view-quote"><?php echo esc_html__(' View Quote', 'addify_rfq'); ?></a></div>                                            
				   <div>

					<?php

				} else {

					?>

	<div class="row" id="main-q-row"> <div id="empty-message"><?php echo esc_html__('No products in quote basket.', 'addify_rfq'); ?></div></div>
					<?php
				}
				?>
			
			</div>
			
		</div>

	</li>
