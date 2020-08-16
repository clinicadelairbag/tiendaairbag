<?php
/**
 * Plugin Name: Webdevia main plugin
 * Plugin URI: http://www.themeforest.net/user/Mymoun
 * Description: Add features to Mymoun themes.
 * Version: 2.3
 * Author: Mymoun
 * Author URI: http://www.themeforest.net/user/Mymoun
 */
$GLOBALS['ajzaa_fonts_to_enqueue_array'] = "";

class WebdeviaMainPlugin {
	function __construct () {
		require_once(plugin_dir_path(__FILE__) . 'post-types.php');
		require_once(plugin_dir_path(__FILE__) . '/import/wd-import.php');
		require_once(plugin_dir_path(__FILE__) . '/product_tax_thumbnail.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/instagram.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/projects.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/flickr.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/widget.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/adress.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/twitter-oath-widget.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/model-search.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/product-suppliers.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/widget.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/adress.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/twitter-oath-widget.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/model-search.php');
		require_once(plugin_dir_path(__FILE__) . 'widgets/product-suppliers.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/parametre_shortcode.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-image_with_text.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-blog.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-portfolio.php');
		include_once plugin_dir_path(__FILE__) . 'shortcode/wd-testimonial.php';
		include_once(plugin_dir_path(__FILE__) . 'shortcode/_wd-clients.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-separator_title.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-countup.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-call_to_action.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-pricing_table.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-hero_image.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-headings.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-clients.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-empty_spaces.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-text_icon.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-team_member.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-maps.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-models.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-progressbar.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-list.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-button.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-drop_cups.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-causes.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-models.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-car_suppliers.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-product_cat.php');
		include_once(plugin_dir_path(__FILE__) . 'shortcode/wd-banner.php');
	}
}

new WebdeviaMainPlugin;
/*============================= dropdow multiple ===========================*/
if(class_exists('Vc_Manager')) {
	vc_add_shortcode_param('dropdown_multi', 'dropdown_multi_settings_field');
	function dropdown_multi_settings_field ($param, $value) {
		$param_line = '';
		$param_line .= '<select multiple name="' . esc_attr($param['param_name']) . '" class="wpb_vc_param_value wpb-input wpb-select ' . esc_attr($param['param_name']) . ' ' . esc_attr($param['type']) . '">';
		foreach($param['value'] as $text_val => $val) {
			if(is_numeric($text_val) && (is_string($val) || is_numeric($val))) {
				$text_val = $val;
			}
			$text_val = esc_html($text_val);
			$selected = '';
			if(!is_array($value)) {
				$param_value_arr = explode(',', $value);
			}
			else {
				$param_value_arr = $value;
			}
			if($value !== '' && in_array($val, $param_value_arr)) {
				$selected = ' selected="selected"';
			}
			$param_line .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . $text_val . '</option>';
		}
		$param_line .= '</select>';
		return $param_line;
	}
}
add_action("get_footer", "ajzaa_footer_f");
function ajzaa_footer_f () {
	if(!empty($GLOBALS["ajzaa_fonts_to_enqueue_array"])) {
		$ajzaa_fonts_string = implode($GLOBALS["ajzaa_fonts_to_enqueue_array"]);
		$protocol = is_ssl() ? 'https' : 'http';
		if($ajzaa_fonts_string != "") {
			wp_enqueue_style('ajzaa_shortcodes_google_fonts', $protocol . '://fonts.googleapis.com/css?family=' . esc_attr($ajzaa_fonts_string), false, false);
		}
	}
}

function image_from_url_relatives ($image_url) {
	$images = array();
	$images = explode('/', $image_url);
	$position = array_search('uploads', $images);
	$content = array();
	if($position) {
		for($i = $position; $i < count($images); $i++)
			array_push($content, $images[$i]);
		$image_relative_link = get_site_url() . '/wp-content/' . implode('/', $content);
		if($image_url != $image_relative_link)
			update_post_meta(get_the_ID(), 'pciture', $image_relative_link);
		return $image_relative_link;
	}
	else {
		return $image_url;
	}
}
