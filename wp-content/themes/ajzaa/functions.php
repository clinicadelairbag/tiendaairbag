<?php
/**
 *----------------- include ------------------------------------------
 */


include_once(get_template_directory() . '/inc/tools.php');
include_once(get_template_directory() . '/inc/plugins/plugins.php');
include_once(get_template_directory() . '/inc/panel.php');
include_once(get_template_directory() . '/inc/meta-box.php');
include_once(get_template_directory() . '/inc/walker/wd-walker.php');
require_once(get_template_directory() . '/inc/aq_resizer.php');
include_once(get_template_directory() . '/inc/mega-menu.php');


load_theme_textdomain("ajzaa", get_template_directory() . '/languages');

/**
 *--------------------------------------------------------------------
 */
/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if(!isset($content_width))
	$content_width = 625;

/* Add post formats */

if(function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	add_theme_support('post-formats', array('gallery',
	                                        'video',
	                                        'audio'));
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-background');
	add_theme_support('title-tag');
	add_theme_support('woocommerce');
	add_theme_support('html5', array('search-form'));
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
	add_theme_support( "custom-header");
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor.css' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Primary Color', 'ajzaa' ),
			'slug'  => 'primary',
			'color'	=> '#ea1b25',
		),
		array(
			'name'  => __( 'Secondary color ', 'ajzaa' ),
			'slug'  => 'secondary ',
			'color' => '#5b9dd9',
		),
	) );
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'small', 'ajzaa' ),
			'shortName' => __( 'S', 'ajzaa' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'regular', 'ajzaa' ),
			'shortName' => __( 'M', 'ajzaa' ),
			'size'      => 16,
			'slug'      => 'regular'
		),
		array(
			'name'      => __( 'large', 'ajzaa' ),
			'shortName' => __( 'L', 'ajzaa' ),
			'size'      => 18,
			'slug'      => 'large'
		),
	) );
}

add_post_type_support('portfolio', 'post-formats', array('aside',
                                                         'image',
                                                         'quote'));

/*
 * --------------- Body Classes --------------
 */
function ajzaa_body_class ($classes = '') {

	if(ajzaa_get_option('ajzaa_smooth_scroll', 'off') == 'on') {
		$classes[] = 'wd-smooth-scroll';
	}
	return $classes;
}

add_filter('body_class', 'ajzaa_body_class');

/*
 * --------------- Title --------------
 */
function ajzaa_setup () {
	add_theme_support('title-tag');
}

add_action('after_setup_theme', 'ajzaa_setup');

function ajzaa_wp_title_for_home ($title, $sep) {
	if(is_feed())
		return $title;

	// Add the site description for the home/front page.
	$site_description = get_bloginfo('name', 'display');
	if($site_description && (is_home() || is_front_page()))
		$title = esc_html__('Home - ', 'ajzaa') . "$title $sep $site_description";

	return $title;
}

add_filter('wp_title', 'ajzaa_wp_title_for_home', 10, 2);


/**
 *--------------- Image presets-----------
 */

add_image_size('ajzaa_blog-thumb', 924, 477, true);
add_image_size('ajzaa_blog', 368, 193, true);
add_image_size('ajzaa_testimonial', 69, 69, true);
add_image_size('ajzaa_testimonial_large', 433, 574, true);
add_image_size('ajzaa_team', 270, 322, true);
add_image_size('ajzaa_team_member_slider', 744, 833, true);
add_image_size('ajzaa_team_member_carousel', 380, 370, true);
add_image_size('ajzaa_team_member_grid', 357, 357, true);
add_image_size('ajzaa_carousel_clients', 169, 111, true);
add_image_size('ajzaa_grid_clients', 125, 97, true);
add_image_size('ajzaa_portfolio_grid', 584, 484, true);
add_image_size('ajzaa_small-thumb', 100, 70, true);
add_image_size('ajzaa_related-post', 360, 290, true);


/**
 *-----------------add sidebar------------------------------------------
 */

function ajzaa_widgets_init () {
	register_sidebar(array('name' => esc_html__('Sidebar', 'ajzaa'),
	                       'id' => 'sidebar',
	                       'before_widget' => '<section id="%1$s" class="widget %2$s">',
	                       'after_widget' => '</section>',
	                       'before_title' => '<h4 class="widget-title">',
	                       'after_title' => '</h4>',));
	register_sidebar(array('name' => esc_html__('Footer 1', 'ajzaa'),
	                       'id' => 'footer-1',
	                       'before_widget' => '<li>',
	                       'after_widget' => '</li>',
	                       'before_title' => '<h4 class="widget-title">',
	                       'after_title' => '</h4>',));
	register_sidebar(array('name' => esc_html__('Footer 2', 'ajzaa'),
	                       'id' => 'footer-2',
	                       'before_widget' => '<li>',
	                       'after_widget' => '</li>',
	                       'before_title' => '<h4 class="widget-title">',
	                       'after_title' => '</h4>',));
	register_sidebar(array('name' => esc_html__('Footer 3', 'ajzaa'),
	                       'id' => 'footer-3',
	                       'before_widget' => '<li>',
	                       'after_widget' => '</li>',
	                       'before_title' => '<h4 class="widget-title">',
	                       'after_title' => '</h4>',));
	register_sidebar(array('name' => esc_html__('Footer 4', 'ajzaa'),
	                       'id' => 'footer-4',
	                       'before_widget' => '<li>',
	                       'after_widget' => '</li>',
	                       'before_title' => '<h4 class="widget-title">',
	                       'after_title' => '</h4>',));
	register_sidebar(array('name' => esc_html__('Woocommerce Sidebar', 'ajzaa'),
	                       'id' => 'shop-widgets',
	                       'description' => esc_html__('Appears on the shop page of your website.', 'ajzaa'),
	                       'before_widget' => '<div id="%1$s" class="widget %2$s shop-widgets">',
	                       'after_widget' => '</div>',
	                       'before_title' => '<h4 class="widget-title">',
	                       'after_title' => '</h4>',));
	register_sidebar(array('name' => esc_html__('OffCanvas Sidebar', 'ajzaa'),
	                       'id' => 'canvas_sidebar',
	                       'before_widget' => '<section id="%1$s" class="widget %2$s">',
	                       'after_widget' => '</section>',
	                       'before_title' => '<h4 class="widget-title">',
	                       'after_title' => '</h4>',));
	register_sidebar(array('name' => esc_html__('Homepage Sidebar', 'ajzaa'),
	                       'id' => 'homepage_sidebar',
	                       'before_widget' => '<section id="%1$s" class="widget %2$s">',
	                       'after_widget' => '</section>',
	                       'before_title' => '<h4 class="widget-title">',
	                       'after_title' => '</h4>',));
}

add_action('widgets_init', 'ajzaa_widgets_init');


//____________navigation____________

register_nav_menus(array('primary' => esc_html__('Primary Navigation', 'ajzaa'),
                         'right' => esc_html__('Right', 'ajzaa'),
                         'top-bar' => esc_html__('Topbar', 'ajzaa'),
                         'category-menu' => esc_html__('Categories Menu', 'ajzaa'),));

function ajzaa_menu () {
	register_nav_menu('footer', esc_html__('Footer', 'ajzaa'));
}

add_action('init', 'ajzaa_menu');


// Ajax Load More portfolio
function ajzaa_my_enqueue_assets () {
	wp_enqueue_script('wd-load-more', get_stylesheet_directory_uri() . '/js/load-more.js', array('jquery'), '1.0', true);
}

function ajzaa_theme_add_editor_styles () {
	$ajzaa_font_url = str_replace(',', '%2C', '//fonts.googleapis.com/css?family=Lato:300,400,700');
	add_editor_style($ajzaa_font_url);
}

add_action('after_setup_theme', 'ajzaa_theme_add_editor_styles');

//--------load css and js----------------------------


function ajzaa_fonts_url ($font_body_name, $ajzaa_font_weight_style, $ajzaa_main_text_font_subsets) {
	$ajzaa_font_url = "https://fonts.googleapis.com/css?family=" . $font_body_name . ":" . str_replace(' ', ',', $ajzaa_font_weight_style) . "&display=swap&subset=" . $ajzaa_main_text_font_subsets;
	return $ajzaa_font_url;
}


function ajzaa_load_js_css_file () {

	/*----------google -fonts ------------------*/
	$ajzaa_font_body_name = ajzaa_get_option('wd_body_font_familly');
	$ajzaa_font_weight_style = ajzaa_get_option('wd_body_font_weight_list');
	$ajzaa_main_text_font_subsets = ajzaa_get_option('wd_body_text_font_subsets');

	$font_header_name = ajzaa_get_option('wd_heading_font_familly');
	$ajzaa_heading_font_weight_style = ajzaa_get_option('wd_heading_font_weight_list');
	$ajzaa_heading_text_font_subsets = ajzaa_get_option('wd_heading_text_font_subsets');

	$ajzaa_navigation_font_familly = ajzaa_get_option('wd_navigation_font_familly');
	$ajzaa_navigation_font_weight_style = ajzaa_get_option('wd_navigation_font_weight_list');
	$ajzaa_navigation_text_font_subsets = ajzaa_get_option('wd_navigation_text_font_subsets');



	$ajzaa_font_weight_style = str_replace(" ", ",", "$ajzaa_font_weight_style");
	$ajzaa_heading_font_weight_style = str_replace(" ", ",", "$ajzaa_heading_font_weight_style");
	$ajzaa_navigation_font_weight_style = str_replace(" ", ",", "$ajzaa_navigation_font_weight_style");



	$protocol = is_ssl() ? 'https' : 'http';
	if (is_rtl()) {
		wp_enqueue_style('ajzaa_body_google_fonts', $protocol . '://fonts.googleapis.com/earlyaccess/droidarabickufi.css');
	} elseif ($ajzaa_font_body_name != "") {
		wp_enqueue_style('ajzaa_body_google_fonts', ajzaa_fonts_url($ajzaa_font_body_name, $ajzaa_font_weight_style, $ajzaa_main_text_font_subsets), array(), '1.0.0');
	} else {
		wp_enqueue_style('wd_body_google_fonts', $protocol . '://fonts.googleapis.com/css?family=Open+Sans%3A300i%2C400i%2C600i%2C700i%2C800i%2C300%2C400%2C600%2C700%2C800&display=swap&subset=latin&ver=1.0.0');
	}
	
	if ($font_header_name != "") {
		wp_enqueue_style('ajzaa_header_google_fonts', ajzaa_fonts_url($font_header_name, $ajzaa_heading_font_weight_style, $ajzaa_main_text_font_subsets), array(), '1.0.0');
	}

	if ($ajzaa_navigation_font_familly != "") {
		wp_enqueue_style('wd_navigation_google_fonts', ajzaa_fonts_url($ajzaa_navigation_font_familly, $ajzaa_navigation_font_weight_style, $ajzaa_navigation_text_font_subsets), array(), '1.0.0');
	}

	//________________________css______________________________
	wp_enqueue_style('Owl-carousel', get_template_directory_uri() . "/css/owl.carousel.css");
	wp_enqueue_style('Owl-carousel-theme', get_template_directory_uri() . "/css/owl.theme.css");
	wp_enqueue_style('lightbox', get_template_directory_uri() . "/css/lightbox.min.css");
	wp_enqueue_style('select2', get_template_directory_uri() . "/css/select2.min.css");
	wp_enqueue_style('font-awesome', get_template_directory_uri() . "/css/font-awesome.min.css");
	wp_enqueue_style('ajzaa-lightbox', get_template_directory_uri() . "/css/lightgallery.min.css");
	wp_enqueue_style('ionicons', get_template_directory_uri() . "/css/ionicons.min.css");
	wp_enqueue_style('mediaelementplayer', get_template_directory_uri() . "/css/mediaelementplayer.css");
	wp_enqueue_style('ajzaa_style', get_template_directory_uri() . "/css/app.css");

	wp_enqueue_style('wd-google-fonts-body');
	wp_enqueue_style('wd-google-fonts-heading');
	wp_enqueue_style('wd-google-fonts-navigation');

	//________________________js______________________________
	$google_map_key = ajzaa_get_option('google_map_key', '');
	wp_enqueue_script('googlemaps', "https://maps.googleapis.com/maps/api/js?key=" . $google_map_key, array('jquery'), '4.4.2', true);
	wp_enqueue_script('foundation_js', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '5', false);
	wp_enqueue_script('mediaelementjs', get_template_directory_uri() . "/js/plugins/mediaelementjs.js", array('jquery'));
	wp_enqueue_script('mediaelementplayer', get_template_directory_uri() . "/js/plugins/mediaelementplayer.js", array('jquery'));
	wp_enqueue_script('modernizer', get_template_directory_uri() . "/js/plugins/modernizer.js", array('jquery'));
	wp_enqueue_script('owlcarousel', get_template_directory_uri() . "/js/plugins/owlcarousel.js", array('jquery'));
	wp_enqueue_script('lightbox-plugin', get_template_directory_uri() . "/js/plugins/lightgallery.min.js", array('jquery'));
	wp_enqueue_script('owlcarouselthumb', get_template_directory_uri() . "/js/plugins/owl.carousel2.thumbs.js", array('jquery'));
	wp_enqueue_script('counterup', get_template_directory_uri() . "/js/plugins/counterup.js", array('jquery'));
	wp_enqueue_script('waypoints', get_template_directory_uri() . "/js/plugins/waypoints.js", array('jquery'));
	wp_enqueue_script('darsain', get_template_directory_uri() . "/js/plugins/darsain.js", array('jquery'));
	wp_enqueue_script('Sharrre', get_template_directory_uri() . "/js/plugins/Sharrre.js", array('jquery'));
	wp_enqueue_script('select2js', get_template_directory_uri() . "/js/plugins/select2.min.js", array('jquery'));
	wp_enqueue_script('isotope', get_template_directory_uri() . "/js/plugins/isotope.js", array('jquery'));
	wp_enqueue_script('wd-maps', get_template_directory_uri() . "/js/wd-maps.js", array('jquery'), '1.0', true);
	wp_enqueue_script('ismobile', get_template_directory_uri() . '/js/isMobile.min.js', array('jquery'), '4.4.2', false);
	wp_enqueue_script('ajzaa-shortcodes-js', get_template_directory_uri() . "/js/shortcode/script-shortcodes.js", array('jquery'), '4', true);
	wp_enqueue_script('ajzaa-wd-carousel', get_template_directory_uri() . "/js/wd-carousel.js", array('jquery'), '4.4.2', true);
	wp_enqueue_script('ajzaa-filter-models', get_template_directory_uri() . "/js/filter-models.js", array('jquery'), '4.4.2', true);
	wp_enqueue_script('ajzaa-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery','hoverIntent'), '4.4.2', true);


	if(is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	//________________________inline style______________________________
	wp_enqueue_style('ajzaa_custom-style', get_template_directory_uri() . '/style.css');

	include_once(get_template_directory() . '/inc/custom-style.php');


	wp_add_inline_style('ajzaa_custom-style', $ajzaa_custom_css);


	// localize the Filter Models script with new data
	$wnm_custom = array('template_url' => esc_url(home_url('/')));
	wp_localize_script('ajzaa-filter-models', 'urltheme', $wnm_custom);

}

add_action('wp_enqueue_scripts', 'ajzaa_load_js_css_file');


// retrieves the attachment ID from the file URL
function ajzaa_get_image_id ($image_url) {
	global $wpdb;
	$image_url = esc_sql($image_url);
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url));
	if(isset($attachment[0])) {
		return $attachment[0];
	}
}

// initialize options

if(!function_exists('ajzaa_initialize_options')) {
	function ajzaa_initialize_options () {

		$options_array = get_option("ajzaa_options_array");

		if(!$options_array) {
			$options_array = array(

				'ajzaa_primary_color' => "rgba(0,168,255,1)",
				'ajzaa_logo_path' => "",
				'ajzaa_favicon_icon_path' => "",
				'ajzaa_facebook' => "",
				'ajzaa_twitter' => "",
				'ajzaa_google_plus' => "",
				'ajzaa_footer_style' => "1",
				'ajzaa_body_font_familly' => "",
				'ajzaa_body_font_weight' => "",
				'ajzaa_body_font_subsets' => "",
				'ajzaa_heading_font_familly' => "",
				'ajzaa_heading_font_weight' => "",
				'ajzaa_heading_font_subsets' => "",
				'ajzaa_navigation_font_familly' => "",
				'ajzaa_navigation_font_weight' => "",
				'ajzaa_navigation_font_subsets' => "",
				'ajzaa_show_wpml_widget' => '',
				'wd_body_font_weight_list' => '200,300,400,600,700,800,900',
				'wd_heading_font_weight_list' => '200,300,400,600,700,800,900',
				'wd_navigation_font_weight_list' => '200,300,400,600,700,800,900',

				"ajzaa_theme_custom_css" => "",
				'ajzaa_theme_custom_js' => "",

				'ajzaa_footer_columns' => "",
				'ajzaa_copyright' => "",);
			update_option("ajzaa_options_array", $options_array);
		}
	}
}


// get options value
if(!function_exists('ajzaa_get_option')) {
	function ajzaa_get_option ($ajzaa_option_key, $ajzaa_option_default_value = null) {
		ajzaa_initialize_options();
		$options_array = get_option("ajzaa_options_array");
		$ajzaa_meta_value = $ajzaa_option_default_value;

		// for demo purpose
		if(function_exists("wd_custom_options")) {
			$options_array = wd_custom_options($options_array);
		}

		if(array_key_exists($ajzaa_option_key, $options_array)) {
			if(isset($options_array[$ajzaa_option_key]) && !empty($options_array[$ajzaa_option_key])) {
				$ajzaa_meta_value = esc_attr($options_array[$ajzaa_option_key]);
			}

			if($ajzaa_meta_value == "") {
				$ajzaa_meta_value = $ajzaa_option_default_value;
			}
		}

		return $ajzaa_meta_value;
	}
}

// get options value
if(!function_exists('ajzaa_save_option')) {
	function ajzaa_save_option ($ajzaa_option_key, $ajzaa_option_value) {
		$options_array = get_option("ajzaa_options_array");
		$options_array[$ajzaa_option_key] = $ajzaa_option_value;
		update_option("ajzaa_options_array", $options_array);
	}
}


wp_oembed_add_provider('#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true);
//____________ Cloud Tag
add_filter('widget_tag_cloud_args', 'ajzaa_widget_tag_cloud_args');
function ajzaa_widget_tag_cloud_args ($args) {
	$args['number'] = 13;
	$args['largest'] = 13;
	$args['smallest'] = 13;
	$args['unit'] = 'px';
	return $args;
}

//____________footer script ___________
function ajzaa_theme_custom_js () {
	$test = html_entity_decode(ajzaa_get_option('ajzaa_theme_custom_js'));
	echo esc_js($test);
	?>
	<script type="text/javascript">
		jQuery(document).foundation();
		var isMobile = {
			Android: function () {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function () {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: function () {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function () {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function () {
				return navigator.userAgent.match(/IEMobile/i);
			},
			any: function () {
				return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			}
		};


		if (!isMobile.any()) {
			jQuery('.animated').css('opacity', 0);
		} else {
			jQuery('.animated').css('opacity', 1);
		}
		<?php echo ajzaa_get_option('ajzaa_theme_custom_js', '') ?>
	</script>
	<?php

	if(ajzaa_get_option('ajzaa_theme_custom_js', '') != '') {
		echo '<script type="text/javascript">';
		echo esc_js($test);
		echo '</script>';
	}
	?>
	<?php
}

add_action('wp_footer', 'ajzaa_theme_custom_js');


if(!function_exists('ajzaa_get_categories')) {
	add_action('admin_init', 'ajzaa_get_categories');
	function ajzaa_get_categories ($taxonomy = '') {
		$args = array('type' => 'post',
		              'hide_empty' => 0);

		$output = array();

		$args['taxonomy'] = $taxonomy;
		$categories = get_categories($args);

		if(!empty($categories) && is_array($categories)) {
			foreach($categories as $category) {
				if(is_object($category)) {
					$output[$category->name] = $category->slug;
				}
			}
		}

		return $output;
	}
}

function ajzaa_removeslashes ($string) {
	$string = implode("", explode("\\", $string));
	return stripslashes(trim($string));
}



if(class_exists('WebdeviaMainPlugin')) {
// add cat model to singe_product
  if (!function_exists('ajzaa_single_product_carmodel')) {

    /**
     * Output the product taxonomy.
     *
     * @subpackage  Product
     */
    function ajzaa_single_product_carmodel()
    {
      $product_tax = get_the_terms(get_the_ID(), 'product_tax');
      if ($product_tax != false):
        ?>
        <div class="product_meta">
      <span class="posted_in">
        <?php echo esc_html__('Cars Models :', 'ajzaa');
        foreach ($product_tax as $tax) {
          $tax_link = get_term_link($tax->slug, 'product_tax');
          ?>
          <a href="<?php echo esc_url($tax_link); ?>"><?php echo esc_html($tax->name); ?></a>,
        <?php
        }
        ?>
      </span>
        </div>
      <?php
      endif;
    }
  }
  add_action('woocommerce_single_product_summary', 'ajzaa_single_product_carmodel', 40);

  /***
   *
   * function model
   * request ajax
   *
   */
  function ajzaa_products_model()
  {
    // do what you want with the variables passed through here
    if (isset($_REQUEST['brands'])):
      $model_id = $_REQUEST['brands'];
    endif;
    $product_tax_childes = get_terms(array('taxonomy' => 'product_tax',
      'hide_empty' => false,
      'parent' => $model_id));
    foreach ($product_tax_childes as $tax_childe) {
      $option .= '<option value="' . esc_attr($tax_childe->slug) . '" data-id="' . esc_attr($tax_childe->term_id) . '">';
      $option .= $tax_childe->name;
      if ($tax_childe->count > 0):
        $option .= ' (' . esc_attr($tax_childe->count) . ')';
      endif;
      $option .= '</option>';
    }
    echo '<option value="" disabled selected="selected">' . esc_html__("Models", 'ajzaa') . '</option>' . $option;
    wp_die();
  }

  add_action('wp_ajax_nopriv_ajzaa_products_model', 'ajzaa_products_model');
  add_action('wp_ajax_ajzaa_products_model', 'ajzaa_products_model');
}
/***
 *
 * function years
 * request ajax
 *
 */
function ajzaa_products_years () {
	// do what you want with the variables passed through here
	if(isset($_REQUEST['years'])):
		$keyword_id = $_REQUEST['years'];
	endif;
	$product_model_childes = get_terms(array('taxonomy' => 'product_tax',
	                                         'hide_empty' => false,
	                                         'parent' => $keyword_id));
	$option = '';
	foreach($product_model_childes as $model_childe) {
		$option .= '<option value="' . esc_attr($model_childe->slug) . '" data-id="' . esc_attr($model_childe->term_id) . '">';
		$option .= $model_childe->name;
		if($model_childe->count > 0):
			$option .= ' (' . esc_html($model_childe->count) . ')';
		endif;
		$option .= '</option>';
	}
	echo '<option value="" disabled selected="selected">'. esc_html__("Years", 'ajzaa'). '</option>' . $option;
	wp_die();
}

add_action('wp_ajax_nopriv_ajzaa_products_years', 'ajzaa_products_years');
add_action('wp_ajax_ajzaa_products_years', 'ajzaa_products_years');


function ajzaa_init () {
	return ajzaa_class::instance();
}

ajzaa_init();

class ajzaa_class {

	private static $instance;
	public $helpers;
	public $customizer;
	public $activation;
	public $integrations;
	public $widgets;
	public $template;
	public $page_settings;
	public $widgetized_pages;

	public static function instance () {
		if(!isset(self::$instance) && !(self::$instance instanceof ajzaa_class)) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct () {
		$this->base();
		$this->setup();
	}

	// Integration getter helper
	public function get ($integration) {
		return $this->integrations->get($integration);
	}

	private function base () {
		$this->files = array('customizer/class-customizer.php');

		foreach($this->files as $file) {
			require_once(get_template_directory() . '/inc/' . $file);
		}
	}

	private function setup () {

		$this->customizer = new ajzaa_Customizer();

		add_action('after_setup_theme', array($this,
		                                      'setup_theme'));
	}

	public function setup_theme () {
		load_theme_textdomain('ajzaa', get_template_directory() . '/languages');
		add_editor_style('css/editor-style.css');

		add_theme_support('custom-background', apply_filters('ajzaa_custom_background_args', array('default-color' => 'ffffff',
		                                                                                           'default-image' => '',)));

	}

}

/**
 * Detect plugin. For use on Front End only.
 */
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
// check for plugin using plugin name
if(function_exists( 'yith_wishlist_install' )) {
	function ajzaa_add_wishlist_to_shop () {
		echo do_shortcode('[yith_wcwl_add_to_wishlist label="" product_added_text="" browse_wishlist_text="" already_in_wishslist_text=""  icon="fa fa-heart"]');
	}

	add_action('woocommerce_after_shop_loop_item', 'ajzaa_add_wishlist_to_shop', 15);
}


//
add_filter('loop_shop_per_page', 'ajzaa_new_loop_shop_per_page', 20);
function ajzaa_new_loop_shop_per_page ($cols) {
	$cols = ajzaa_get_option('products_per_page', '15');
	return $cols;
}


function ajzaa_get_embedded_media( $type = array() ){
	$content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
	$embed = get_media_embedded_in_content( $content, $type );

	if( in_array( 'audio' , $type) ){
		$output = str_replace( '?visual=true', '?visual=false', $embed[0] );
	}elseif( !empty($embed)){
		$output = $embed[0];
	}else{
		$output = "";
	}

	return $output;
}

function ajzaa_get_attachment( $num = 1 ){

	$output = '';
	if( has_post_thumbnail() && $num == 1 ):
		$output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	else:
		$attachments = get_posts( array(
			'post_type' => 'attachment',
			'posts_per_page' => $num,
			'post_parent' => get_the_ID()
		) );
		if( $attachments && $num == 1 ):
			foreach ( $attachments as $attachment ):
				$output = wp_get_attachment_url( $attachment->ID );
			endforeach;
		elseif( $attachments && $num > 1 ):
			$output = $attachments;
		endif;

		wp_reset_postdata();

	endif;

	return $output;
}