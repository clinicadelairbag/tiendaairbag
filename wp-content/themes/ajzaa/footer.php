<?php
$ajzaa_footer_style = ajzaa_get_option('ajzaa_footer_style');
if($ajzaa_footer_style != 'none') {
	get_template_part('parts/footer/footer', ajzaa_get_option('ajzaa_footer_style', $ajzaa_footer_style));
}
?>
<!-- Right Sidebar -->

<div class="off-canvas-right-sidebar">
	<div class="right-sidebar-close">
		<a href="javascript:;"><span></span></a>
	</div>
	<div class="widget-group">
		<?php dynamic_sidebar('canvas_sidebar'); ?>
	</div>
</div>
<div class="opened-overlay"></div>

<!-- /Right Sidebar -->

<?php
if(ajzaa_get_option('ajzaa_footer_cookies', '') == 'yes') {
	$ajzaa_cookies_message = ajzaa_get_option('ajzaa_footer_cookies_message', '');
	?>


	<div class="main-cookies fadeInLeftBig animated">
	<div class="cookies-body">
		<p><?php echo esc_html($ajzaa_cookies_message); ?></p>
		<?php
		$ajzaa_cookies_link = ajzaa_get_option('ajzaa_footer_cookies_link', '#');
		?>
		<a href="<?php echo esc_url($ajzaa_cookies_link); ?>" target="_blank" id="more-info" class="more-info"><?php echo esc_html__('Privacy policy', 'ajzaa'); ?></a>
		<a href="javascript:void(0);" class="cookies-btn"><?php echo esc_html__('Accept', 'ajzaa'); ?></a>
	</div>
</div>

<?php }

$product_tax_parents = get_terms(array(
	'taxonomy' => 'product_tax',
	'hide_empty' => false,
	'parent' => 0
));
?>
<div id="model_Modal" class="reveal-modal model_search" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  <script>
    jQuery(document).ready(function ($) {

	    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	    $('.brands_form #modal_marques').on('select2:select', function (e) {
		    $('.brands_form .keyword').append("<span style='color: black' class='fa fa-spinner fa-spin'></span>");
		    $('.brands_form .brands .select2-selection__arrow').hide();
		    var brands = $('.brands_form #modal_marques').find(':selected').data('id');
		    $.ajax({
			    type: "POST",
			    url: ajaxurl,
			    data: {
				    action: "ajzaa_products_model",
				    brands: brands
			    },
			    success: function (data) {
				    $('.brands_form #modal_models').html(data);
				    $(".keyword .fa-spinner").remove();
				    $('.brands_form .brands .select2-selection__arrow').show();
				    $('#modal_models').select2('open');
			    },
			    error: function (errorThrown) {
				    alert(errorThrown);
			    }
		    });
	    });
	    $('.brands_form #modal_models').on('select2:select', function (e) {
		    $('.brands_form .year').append("<span style='color: black' class='fa fa-spinner fa-spin'></span>");
		    $('.brands_form .keyword .select2-selection__arrow').hide();
		    var modal_years = $('.brands_form #modal_models').find(':selected').data('id');
		    $.ajax({
			    type: "POST",
			    url: ajaxurl,
			    data: {
				    action: "ajzaa_products_years",
				    years: modal_years
			    },
			    success: function (data) {
				    $('.brands_form #modal_year').html(data);
				    $(".year .fa-spinner").remove();
				    $('.brands_form .keyword .select2-selection__arrow').show();
				    $('#modal_year').select2('open');
			    },
			    error: function (errorThrown) {
				    alert(errorThrown);
			    }
		    });
	    });

    });
  </script>
  <div class="brands_header text-left">
    <h2 style=""><?php echo esc_html__('search for part', 'ajzaa') ?></h2>
  </div>
    <?php if (function_exists( 'WC' )) { ?>
  <div class="brands_form">
    <form method="post">
      <ul class="inline-list">
        <li class="brands">
          <select name="marques" id="modal_marques">
            <option value='-1' disabled selected><span>1</span> | <?php echo esc_html__('Select Brand...','ajzaa') ?></option>
	          <?php
	          foreach ($product_tax_parents as $parent) {
		          ?>
		          <option value="<?php echo esc_attr($parent->slug) ?>" data-id="<?php echo esc_attr($parent->term_id) ?>">
              <?php
              echo esc_html($parent->name);
               ?>
              </option>
		          <?php
	          }
	          ?>
          </select>

        </li>
        <li class="keyword">
          <select id="modal_models">
              <option value='-1' disabled selected>2 <span> |</span> <?php echo esc_html__('Select Model...','ajzaa') ?></option>
          </select>
        </li>
        <li class="year">
          <select id="modal_year">
              <option value='-1' disabled selected>3 |<?php echo esc_html__('Select Year...','ajzaa') ?> </option>
          </select>
        </li>
        <li class="search">
          <input type="button" class="button models-btn-submit" value="<?php echo  esc_html__('search', 'ajzaa')  ?>">
        </li>
      </ul>
    </form>
  </div>
    <?php } ?>
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<?php
wp_footer();
?>
</body>
</html>
