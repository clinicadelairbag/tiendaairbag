jQuery(document).ready(function () {
	"use strict";
	jQuery('#dropdownMenuButton').on('mouseover',function () {
		jQuery('#dropdown').show();
	});
	jQuery('#dropdown').on('mouseover',function () {
		jQuery('#dropdown').show();
	});
	jQuery('#dropdownMenuButton').on('mouseleave',function () {
		jQuery('#dropdown').hide();
	});
	jQuery('#dropdown').on('mouseleave',function () {
		jQuery('#dropdown').hide();
	});
});

jQuery(document).ready(function ($) {

	"use strict";
	var ajaxUrl = afrfq_phpvars.admin_url;
	var nonce   = afrfq_phpvars.nonce;

	$(document).on('click', '.afrfqbt', function () {

		if ($(this).is('.product_type_simple')) {

			var productId = $(this).attr('data-product_id');
			var quantity  = 1;

			$(this).addClass('loading');

			$.ajax({
				url: ajaxUrl,
				type: 'POST',
				data: {
					action: 'add_to_quote',
					product_id: productId,
					quantity: quantity,
					nonce: nonce
				},
				success: function (response) {

					if ('success' == response) {
						window.location.href = "?quote="+productId;
					} else {

						$('.afrfqbt').removeClass('loading');
						$('.quote-li').replaceWith(response);

						$('#added_quote'+productId).show();

						jQuery('#dropdownMenuButton').on('mouseover',function () {
							jQuery('#dropdown').show();
						});
						jQuery('#dropdown').on('mouseover',function () {
							jQuery('#dropdown').show();
						});
						jQuery('#dropdownMenuButton').on('mouseleave',function () {
							jQuery('#dropdown').hide();
						});
						jQuery('#dropdown').on('mouseleave',function () {
							jQuery('#dropdown').hide();
						});
					}

					
				}
			});

		}
		return false;
	});

});

function remove_quote_cart(key) {
	"use strict";
	var ajaxUrl = afrfq_phpvars.admin_url;
	var nonce   = afrfq_phpvars.nonce;
	jQuery('.'+key+'qrow .loader').show();
	jQuery.ajax({
		url: ajaxUrl,
		type: 'POST',
		data: {
			action: 'remove_quote_item',
			quote_key: key,
			nonce: nonce
		},
		success: function (response) { 
			jQuery('.loader').hide();
			var total_quote = response;
			jQuery('#total-items').html('');
			jQuery('#total-items').html(total_quote +' items in quote');
			if ((total_quote-1) == 0) {
				jQuery('.view-quote-row').before('<div class="row" id="main-q-row"> <div id="empty-message">No products in quote basket</div></div>')
			}
			jQuery('.'+key).remove();
		}
	});
}

jQuery(document).ready(function ($) {

	"use strict";
	var ajaxUrl = afrfq_phpvars.admin_url;
	var nonce   = afrfq_phpvars.nonce;
	var required = false;

	$(document).on('click', '.afrfqbt_single_page', function () {

		
		// $('#afrfqerror').remove();
		// $('form.cart input[type="checkbox"],input[type="text"],input[type="radio"],select,input[type="number"],input[type="file"]').each(function(){
		// 	if( $(this).attr( "required" ) ) { alert('yes');
		// 		if( $(this).val().length === 0 ){
		// 			required = true;
		// 			$( '<div id="afrfqerror" class="error">Select All Required Fields before submitting a Quote</p>' ).insertAfter( ".afrfqbt_single_page" );
		// 			return false;
		// 		} else {
		// 			required = false;
		// 		}
		// 	} else {

		// 		required = false;
		// 	}
		// });

		// alert(required);

		// if(required) {
		// 	return false;
		// } else {
		// 	$('#afrfqerror').remove();
		// 	return true;
		// }

		if ($(this).is('.product_type_variable')) {

			var a = $('.afrfqbt_single_page').attr('class');

			var n = a.search("disabled");

			if (n == 20) {
				return false;
			}

			

			var $variation            = {};
			var $count                = 0;
			var $product_variation_id = $('table.variations').find('tr').each(
				function() {
					var $var_value     = $(this).find('td.value').find('select').val();
					var $var_key       = $(this).find('td.value').find('select').attr('name');
					$variation[$count] = [$var_key, $var_value];
					$count++;
				}
			);

			$('.single-product').find('.form.variations_form').find('input.variations_attr').val(JSON.stringify($variation)).change();

			var $product_quantity     = $('.single-product').find('form.cart').find('.quantity').find('input[type="number"]').val();
			var $product_variation_id = $('.single-product').find('form.variations_form').find('input.variation_id').val();

			$('.single-product').find('.form.variations_form').find('input.quantity').val($product_quantity).change();
			$('.single-product').find('.form.variations_form').find('input.variation_id').val($product_variation_id).change();

			var productId  = $(this).attr('data-product_id');
			var quantity   = $('.qty').val();
			var woo_addons = "";
			$('.product-addon-totals .wc-pao-col1').each(function(){
				woo_addons += $(this).text() + "-_-";
			});

			var woo_addons1 = "";
			$('.fpf-fields label').each(function(){

				woo_addons1 += $(this).text() + "_-_" + $('.fpf-fields input').val() + "-_-";
			});

			$(this).addClass('loading');

			$.ajax({
				url: ajaxUrl,
				type: 'POST',
				data: {
					action: 'add_to_quote_single_vari',
					product_id: productId,
					vari_id:$product_variation_id,
					quantity: quantity,
					woo_addons: woo_addons,
					woo_addons1: woo_addons1,
					variation: $variation,
					nonce: nonce
				},
				success: function (response) {

					if ('success' == response) {
						window.location.href = "?quote="+productId;
					} else {

						$('.afrfqbt_single_page').removeClass('loading');
						$('.quote-li').replaceWith(response);

						$('#added_quote'+productId).show();

						jQuery('#dropdownMenuButton').on('mouseover',function () {
							jQuery('#dropdown').show();
						});
						jQuery('#dropdown').on('mouseover',function () {
							jQuery('#dropdown').show();
						});
						jQuery('#dropdownMenuButton').on('mouseleave',function () {
							jQuery('#dropdown').hide();
						});
						jQuery('#dropdown').on('mouseleave',function () {
							jQuery('#dropdown').hide();
						});
					}
				}
			});

		} else {

			var productId = $(this).attr('data-product_id');
			var quantity  = $('.qty').val();

			var woo_addons = "";
			$('.product-addon-totals .wc-pao-col1').each(function(){
				woo_addons += $(this).text() + "-_-";
			});

			var woo_addons1 = "";
			$('.fpf-fields label').each(function(){

				woo_addons1 += $(this).text() + "_-_" + $('.fpf-fields input').val() + "-_-";
			});

			$(this).addClass('loading');

			$.ajax({
				url: ajaxUrl,
				type: 'POST',
				data: {
					action: 'add_to_quote_single',
					product_id: productId,
					quantity: quantity,
					woo_addons: woo_addons,
					woo_addons1: woo_addons1,
					nonce: nonce
				},
				success: function (response) {

					if ('success' == response) {
						window.location.href = "?quote="+productId;
					} else {

						$('.afrfqbt_single_page').removeClass('loading');
						$('.quote-li').replaceWith(response);

						$('#added_quote'+productId).show();

						jQuery('#dropdownMenuButton').on('mouseover',function () {
							jQuery('#dropdown').show();
						});
						jQuery('#dropdown').on('mouseover',function () {
							jQuery('#dropdown').show();
						});
						jQuery('#dropdownMenuButton').on('mouseleave',function () {
							jQuery('#dropdown').hide();
						});
						jQuery('#dropdown').on('mouseleave',function () {
							jQuery('#dropdown').hide();
						});
					}
				}
			});

		}
		return false;
	});

});

// Remove item from quotes list
function af_remove_quote_cart(key) { 
	"use strict";
	var quoteKey = key;

	var ajaxUrl = afrfq_phpvars.admin_url;
	var nonce   = afrfq_phpvars.nonce;

	jQuery.ajax({
		url: ajaxUrl,
		type: 'POST',
		data: {
			action: 'remove_quote_item',
			quote_key: quoteKey,
			nonce: nonce
		},
		success: function (response) {
			location.reload();
		}
	});
}
