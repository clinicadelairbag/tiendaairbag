<?php
if(!function_exists('ajzaa_models_code')) {
	function ajzaa_models_code ($atts) {
		global $ajzaa_fonts_to_enqueue_array;
		$ajzaa_fonts_to_enqueue_array = array();
		extract(shortcode_atts(array(
			'headings_title' => '',
			'headings_alignment' => 'center',
			'ajzaa_heading_font_family' => '',
			'ajzaa_heading_font_style' => 'normal',
			'ajzaa_heading_font_weight' => '400',
			'ajzaa_heading_font_size' => '',
			'ajzaa_heading_color' => '#fff',
			'ajzaa_heading_text_transform' => '',
			'ajzaa_heading_line_height' => '',
			'ajzaa_heading_letter_spacing' => '',
			'ajzaa_button_text' => 'Search',
		), $atts));
		$headings_alignment = "text-" . $headings_alignment;
		$custom_header_inline_style = "margin:0;";
		$ajzaa_font_family_heading_to_enqueue = "";
		if($ajzaa_heading_font_family != '' && $ajzaa_heading_font_family != 'Default') {
			$custom_header_inline_style .= 'font-family:' . esc_attr($ajzaa_heading_font_family) . ';';
			$ajzaa_font_family_heading_to_enqueue .= esc_attr($ajzaa_heading_font_family) . ":";
		}
		if($ajzaa_heading_font_weight != '') {
			$custom_header_inline_style .= 'font-weight:' . esc_attr($ajzaa_heading_font_weight) . ';';
			$ajzaa_font_family_heading_to_enqueue .= esc_attr($ajzaa_heading_font_weight) . "%7C";
		}
		if($ajzaa_heading_font_size != '') {
			$custom_header_inline_style .= 'font-size:' . esc_attr($ajzaa_heading_font_size) . 'px;';
		}
		if($ajzaa_heading_color != '') {
			$custom_header_inline_style .= 'color:' . esc_attr($ajzaa_heading_color) . ';';
		}
		if($ajzaa_heading_text_transform != '') {
			$custom_header_inline_style .= 'text-transform:' . esc_attr($ajzaa_heading_text_transform) . ';';
		}
		if($ajzaa_heading_line_height != '') {
			$custom_header_inline_style .= 'line-height:' . esc_attr($ajzaa_heading_line_height) . 'px;';
		}
		if($ajzaa_heading_letter_spacing != '') {
			$custom_header_inline_style .= 'letter-spacing:' . esc_attr($ajzaa_heading_letter_spacing) . 'px;';
		}
		ob_start();
		$product_tax_parents = get_terms(array(
			'taxonomy' => 'product_tax',
			'hide_empty' => false,
			'parent' => 0
		));
		?>
		<script>
    jQuery(document).ready(function ($) {

	    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	    $('.brands_form #marques').on('select2:select', function (e) {
		    $('.brands_form .keyword').append("<span style='color: black' class='fa fa-spinner fa-spin'></span>");
		    $('.brands_form .brands .select2-selection__arrow').hide();
		    var brands = $('.brands_form #marques').find(':selected').data('id');
		    $.ajax({
			    type: "POST",
			    url: ajaxurl,
			    data: {
				    action: "ajzaa_products_model",
				    brands: brands
			    },
			    success: function (data) {
				    $('.brands_form #models').html(data);
				    $(".keyword .fa-spinner").remove();
				    $('.brands_form .brands .select2-selection__arrow').show();
				    $('#models').select2('open');
			    },
			    error: function (errorThrown) {
				    alert(errorThrown);
			    }
		    });
	    });
	    $('.brands_form #models').on('select2:select', function (e) {
		    $('.brands_form .year').append("<span style='color: black' class='fa fa-spinner fa-spin'></span>");
		    $('.brands_form .keyword .select2-selection__arrow').hide();
		    var years = $('.brands_form #models').find(':selected').data('id');
		    $.ajax({
			    type: "POST",
			    url: ajaxurl,
			    data: {
				    action: "ajzaa_products_years",
				    years: years
			    },
			    success: function (data) {
				    $('.brands_form #year').html(data);
				    $(".year .fa-spinner").remove();
				    $('.brands_form .keyword .select2-selection__arrow').show();
				    $('#year').select2('open');
			    },
			    error: function (errorThrown) {
				    alert(errorThrown);
			    }
		    });
	    });

    });
  </script>
		<div class="brands_header <?php echo $headings_alignment ?>">
    <h2 style="<?php echo esc_attr($custom_header_inline_style) ?>"><?php echo $headings_title ?></h2>
  </div>
		<div class="brands_form">
    <form method="post">
      <ul class="inline-list">
        <li class="brands">
          <select name="marques" id="marques">
            <option value='-1' disabled selected><span>1</span> |<?php echo esc_html__('Select Brand...', 'ajzaa') ?></option>
	          <?php
	          foreach($product_tax_parents as $parent) {
		          ?>
		          <option value="<?php echo $parent->slug ?>" data-id="<?php echo $parent->term_id ?>">
              <?php
              echo $parent->name;
              /*if ($parent->count > 0){
								echo "(" . $parent->count .")";
							}*/ ?>
              </option>
		          <?php
	          }
	          ?>
          </select>

        </li>
        <li class="keyword">
          <select id="models">
              <option value='-1' disabled selected>2 <span>|</span><?php echo esc_html__('Select Model...', 'ajzaa') ?></option>
          </select>
        </li>
        <li class="year">
          <select id="year">
            <option value='-1' disabled selected>3 <span>|</span><?php echo esc_html__('Select Year...', 'ajzaa') ?></option>
          </select>
        </li>
        <li class="search">
          <input type="button" class="button models-btn-submit" value="<?php echo esc_attr__("Search", 'ajzaa') ?>">
        </li>
      </ul>
    </form>
  </div>
		<a style="text-align: center; color: #fff; padding-top: 18px; display: flow-root; font-size: 15px;" href="#search-by-brand"><?php echo esc_html__('Or Search By Brand', 'ajzaa') ?></a>
		<?php
		return ob_get_clean();
	}

	add_shortcode('ajzaa_models', 'ajzaa_models_code');
}
