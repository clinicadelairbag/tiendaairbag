jQuery(function($) {

	"use strict";

	var ajaxurl = afrfq_php_vars.admin_url;
	var nonce   = afrfq_php_vars.nonce;

	$('.afrfq_hide_products').select2({

		ajax: {
			url: ajaxurl, // AJAX URL is predefined in WordPress admin
			dataType: 'json',
			type: 'POST',
			delay: 250, // delay in ms while typing when to perform a AJAX search
			data: function (params) {
				return {
					q: params.term, // search query
					action: 'afrfqsearchProducts', // AJAX action for admin-ajax.php
					nonce: nonce // AJAX nonce for admin-ajax.php
				};
			},
			processResults: function( data ) {
				var options = [];
				if ( data ) {
   
					// data is the array of arrays, and each of them contains ID and the Label of the option
					$.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
						options.push( { id: text[0], text: text[1]  } );
					});
   
				}
				return {
					results: options
				};
			},
			cache: true
		},
		multiple: true,
		placeholder: 'Choose Products',
		minimumInputLength: 3 // the minimum of symbols to input before perform a search
		
	});

	$(".namediv").click(function(){
		$(".fieldsdiv").toggle();
	});


	$(".emaildiv").click(function(){
		$(".emailfieldsdiv").toggle();
	});

	$(".companydiv").click(function(){
		$(".companyfieldsdiv").toggle();
	});

	$(".phonediv").click(function(){
		$(".phonefieldsdiv").toggle();
	});

	$(".filediv").click(function(){
		$(".filefieldsdiv").toggle();
	});

	$(".messagediv").click(function(){
		$(".messagefieldsdiv").toggle();
	});

	$(".field1div").click(function(){
		$(".field1fieldsdiv").toggle();
	});

	$(".field2div").click(function(){
		$(".field2fieldsdiv").toggle();
	});

	$(".field3div").click(function(){
		$(".field3fieldsdiv").toggle();
	});

	$('.afrfq_hide_urole').select2();

	$('#afrfq_apply_on_all_products').change(function () {
		if (this.checked) { 
			//  ^
			$('.hide_all_pro').fadeOut('fast');
		} else {
			$('.hide_all_pro').fadeIn('fast');
		}
	});

	if ($("#afrfq_apply_on_all_products").is(':checked')) {
		$(".hide_all_pro").hide();  // checked
	} else {
		$(".hide_all_pro").show();
	}

	$(".child").on("click",function() {
		$parent = $(this).prevAll(".parent");
		if ($(this).is(":checked")) {
			$parent.prop("checked",true);
		} else {
			var len = $(this).parent().find(".child:checked").length;
			$parent.prop("checked",len>0);
		}
	});
	$(".parent").on("click",function() {
		$(this).parent().find(".child").prop("checked",this.checked);
	});

	var value = $("#afrfq_rule_type option:selected").val();
	if (value == 'afrfq_for_registered_users') {
		$('#quteurr').show();
	} else {
		$('#quteurr').hide();
	}

	var value1 = $("#afrfq_is_hide_price option:selected").val();
	if (value1 == 'yes') {
		$('#hpircetext').show();
	} else {
		$('#hpircetext').hide();
	}

	var value2 = $("#afrfq_is_hide_addtocart option:selected").val();
	if (value2 == 'replace_custom' || value2 == 'addnewbutton_custom') {
		jQuery('#afcustom_link').show();
	} else {
		jQuery('#afcustom_link').hide();
	}


});

function afrfq_getUserRole(value) {

	"use strict";
	if (value == 'afrfq_for_registered_users') {
		jQuery('#quteurr').show();
	} else {
		jQuery('#quteurr').hide();
	}
}

function afrfq_HidePrice(value) {

	"use strict";
	if (value == 'yes') {
		jQuery('#hpircetext').show();
	} else {
		jQuery('#hpircetext').hide();
	}
}

function getCustomURL(value) {

	"use strict";
	if (value == 'replace_custom' || value == 'addnewbutton_custom') {
		jQuery('#afcustom_link').show();
	} else {
		jQuery('#afcustom_link').hide();
	}

}

jQuery( function() {
	"use strict";
	jQuery( "#addify_settings_tabs" ).tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
});

