<?php


/*///////////////////////////////// Register Panel Scripts and Styles /////////////////////////////////////////*/
function ajzaa_admin_register()
{

  wp_register_script('wd-admin-main', get_template_directory_uri() . '/inc/js/script.js',
    array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-tabs',
      'jquery-ui-droppable', 'jquery-ui-sortable'), false, false);

  if (class_exists('WebdeviaMainPlugin'))
        wp_register_script('wd-admin-import', get_template_directory_uri() . '/inc/js/import_js.js',
            array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-tabs',
                'jquery-ui-droppable', 'jquery-ui-sortable'), false, false);

  wp_register_style('themify-icons', get_template_directory_uri() . '/inc/themify-icons.css', array(), '20120208', 'all');
  wp_register_style('wd-style', get_template_directory_uri() . '/inc/css/style.css', array(), '20120208', 'all');

  $font_body_name = (ajzaa_get_option('wd_body_font_familly', 'Open Sans') == 'default') ? 'Open Sans' : ajzaa_get_option('wd_body_font_familly', 'Open Sans');
  $ajzaa_font_weight_list = ajzaa_get_option('wd_body_font_weight_list', '400');
  $ajzaa_body_text_font_subsets = ajzaa_get_option('wd_body_text_font_subsets', 'latin');

  $font_header_name = (ajzaa_get_option('wd_heading_font_familly', 'Open Sans') == 'default') ? 'Open Sans' : ajzaa_get_option('wd_heading_font_familly', 'Open Sans');
  $ajzaa_heading_font_weight_list = ajzaa_get_option('wd_heading_font_weight_list', '400');
  $ajzaa_heading_text_font_subsets = ajzaa_get_option('wd_heading_text_font_subsets', 'latin');

  $ajzaa_navigation_font_familly = (ajzaa_get_option('wd_navigation_font_familly', 'Open Sans') == 'default') ? 'Open Sans' : ajzaa_get_option('wd_navigation_font_familly', 'Open Sans');
  $ajzaa_navigation_font_weight_list = ajzaa_get_option('wd_navigation_font_weight_list', '400');
  $ajzaa_navigation_text_font_subsets = ajzaa_get_option('wd_navigation_text_font_subsets', 'latin');
  $protocol = is_ssl() ? 'https' : 'http';


  wp_register_style('wd-google-fonts-body', $protocol . '://fonts.googleapis.com/css?family=' . $font_body_name . ':' . $ajzaa_font_weight_list . '&subset=' . $ajzaa_body_text_font_subsets, false, NULL, 'all');
  wp_register_style('wd-google-fonts-heading', $protocol . '://fonts.googleapis.com/css?family=' . $font_header_name . ':' . $ajzaa_heading_font_weight_list . '&subset=' . $ajzaa_heading_text_font_subsets, false, NULL, 'all');
  wp_register_style('wd-google-fonts-navigation', $protocol . '://fonts.googleapis.com/css?family=' . $ajzaa_navigation_font_familly . ':' . $ajzaa_navigation_font_weight_list . '&subset=' . $ajzaa_navigation_text_font_subsets, false, NULL, 'all');


  if (isset($_GET['page']) && $_GET['page'] == 'option panel') {


  }
  wp_enqueue_script('wp-color-picker');
  wp_enqueue_script('wd-admin-main');
  wp_enqueue_script('wd-admin-import');
  wp_enqueue_style('themify-icons');
  wp_enqueue_style('wd-style');
  wp_enqueue_style('wd-google-fonts');
  wp_enqueue_style('wd-google-fonts-body');
  wp_enqueue_style('wd-google-fonts-heading');
  wp_enqueue_style('wd-google-fonts-navigation');

}

add_action('admin_enqueue_scripts', 'ajzaa_admin_register');


if (!function_exists('ajzaa_load_color_picker')) {
  add_action('load-widgets.php', 'ajzaa_load_color_picker');
  function ajzaa_load_color_picker()
  {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
  }
}


/*///////////////////////////////// Theme Options /////////////////////////////////////////*/
if (!function_exists('ajzaa_panel_option')) {
  add_action('admin_menu', 'ajzaa_panel_option');
  function ajzaa_panel_option()
  {


    add_theme_page('Ajzaa Theme Options', 'Ajzaa Theme Options', 'edit_theme_options', 'ajzaa-theme-option', 'ajzaa_theme_option');
    if (class_exists('WebdeviaMainPlugin')) {
    add_theme_page('Import Demo Content', 'Import Demo Content', 'edit_theme_options', 'ajzaa-demo-content', 'ajzaa_import_demo');
  }
    if (class_exists('RevSliderBase')) {
      add_theme_page('Import Demos Revsliders', 'Import Demos Revsliders', 'edit_theme_options', 'ajzaa-revslider', 'ajzaa_import_revslider');
    }
  }
}




if (!function_exists('ajzaa_theme_option')) {
  function ajzaa_theme_option()
  {

    wp_enqueue_media();

    global $ajzaa_tiles;

    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');


    wp_enqueue_script('colorpick', get_template_directory_uri() . "/js/bootstrap-colorpicker.min.js", array('jquery'));
    wp_enqueue_style('colorpick', get_template_directory_uri() . "/stylesheets/bootstrap-colorpicker.min.css");
    wp_enqueue_style('fontawesome', get_template_directory_uri() . "/css/font-awesome.min.css");


    if (!empty($_POST)) {
      // ajzaa_initialize_options();
      //-------------------General Setting-------------
      ajzaa_save_option('ajzaa_logo_path', esc_attr($_POST['ajzaa_logo_path']));
      ajzaa_save_option('ajzaa_header_style', esc_attr($_POST['ajzaa_header_style']));
      ajzaa_save_option('google_map_key', esc_attr($_POST['google_map_key']));


      if (isset($_POST['ajzaa_show_min_cart']))
        ajzaa_save_option('ajzaa_show_min_cart', esc_attr($_POST['ajzaa_show_min_cart']));
      else
        ajzaa_save_option('ajzaa_show_min_cart', 'off');


      if (isset($_POST['ajzaa_smooth_scroll']))
        ajzaa_save_option('ajzaa_smooth_scroll', esc_attr($_POST['ajzaa_smooth_scroll']));
      else
        ajzaa_save_option('ajzaa_smooth_scroll', 'off');

      if (isset($_POST['ajzaa_show_adress_bar']))
        ajzaa_save_option('ajzaa_show_adress_bar', esc_attr($_POST['ajzaa_show_adress_bar']));
      else
        ajzaa_save_option('ajzaa_show_adress_bar', 'off');


      ajzaa_save_option('ajzaa_footer_style', esc_attr($_POST['ajzaa_footer_style']));

      ajzaa_save_option('ajzaa_footer_cookies', esc_attr($_POST['ajzaa_footer_cookies']));

      ajzaa_save_option('ajzaa_footer_cookies_message', esc_attr($_POST['ajzaa_footer_cookies_message']));
      ajzaa_save_option('ajzaa_footer_cookies_link', esc_attr($_POST['ajzaa_footer_cookies_link']));

      ajzaa_save_option('ajzaa_bg_single_post_path', esc_attr($_POST['ajzaa_bg_single_post_path']));

      ajzaa_save_option('ajzaa_header_number', esc_attr($_POST['ajzaa_header_number']));
      ajzaa_save_option('ajzaa_header_email', esc_attr($_POST['ajzaa_header_email']));
      ajzaa_save_option('ajzaa_header_adress', esc_attr($_POST['ajzaa_header_adress']));
      //-------------------Color Setting-------------
      ajzaa_save_option('ajzaa_primary_color', esc_attr($_POST['ajzaa_primary_color']));
      ajzaa_save_option('ajzaa_secondary_color', esc_attr($_POST['ajzaa_secondary_color']));
      ajzaa_save_option('ajzaa_footer_bg_color', esc_attr($_POST['ajzaa_footer_bg_color']));

      ajzaa_save_option('ajzaa_top_bar_bg_color', esc_attr($_POST['ajzaa_top_bar_bg_color']));
      ajzaa_save_option('ajzaa_top_bar_bg_color_two', esc_attr($_POST['ajzaa_top_bar_bg_color_two']));
      ajzaa_save_option('ajzaa_nav_bar_bg_color', esc_attr($_POST['ajzaa_nav_bar_bg_color']));
      ajzaa_save_option('ajzaa_sticky_nav_bar_bg_color', esc_attr($_POST['ajzaa_sticky_nav_bar_bg_color']));
      ajzaa_save_option('ajzaa_sticky_nav_bar_color', esc_attr($_POST['ajzaa_sticky_nav_bar_color']));

      ajzaa_save_option('ajzaa_single_product_bg_color', esc_attr($_POST['ajzaa_single_product_bg_color']));

      ajzaa_save_option('ajzaa_top_bar_text_color', esc_attr($_POST['ajzaa_top_bar_text_color']));
      ajzaa_save_option('ajzaa_nav_bar_text_color', esc_attr($_POST['ajzaa_nav_bar_text_color']));
      ajzaa_save_option('ajzaa_toggle_color', esc_attr($_POST['ajzaa_toggle_color']));
      ajzaa_save_option('ajzaa_toggle_background_color', esc_attr($_POST['ajzaa_toggle_background_color']));
      //-------------------Language selector-------------


      if (do_action('icl_language_selector')) {
        ajzaa_save_option('ajzaa_show_wpml_widget', esc_attr($_POST['ajzaa_show_wpml_widget']));
      }
      //-------------------Fonts Setting ---------------

      //------------------Custom css & js ---------------
      ajzaa_save_option('ajzaa_theme_custom_js', str_replace("\\", "", $_POST['ajzaa_theme_custom_js']));
      //-------------------Footer Setting-------------
      ajzaa_save_option('ajzaa_footer_columns', esc_attr($_POST['ajzaa_footer_columns']));
      ajzaa_save_option('ajzaa_copyright', esc_attr($_POST['ajzaa_copyright']));
      ajzaa_save_option('ajzaa_footer_bg_img_path', esc_attr($_POST['ajzaa_footer_bg_img_path']));


      ajzaa_save_option('wd_body_font_familly', sanitize_text_field($_POST['wd_body_font_familly']));
      ajzaa_save_option('wd_body_font_style', sanitize_text_field($_POST['wd_body_font_style']));
      ajzaa_save_option('wd_body_font_weight', sanitize_text_field($_POST['wd_body_font_weight']));
      $wd_body_font_weight_list_content = '';
      if (is_array($_POST['wd_body_font_weight_list']) && count($_POST['wd_body_font_weight_list']) > 0) {
        foreach ($_POST['wd_body_font_weight_list'] as $lists) $wd_body_font_weight_list_content .= $lists . ',';
        $wd_body_font_weight_list_content = trim($wd_body_font_weight_list_content, ',');
      } elseif (!is_array($_POST['wd_body_font_weight_list'])) {
        $wd_body_font_weight_list_content = $_POST['wd_body_font_weight_list'];
      }
      ajzaa_save_option('wd_body_font_weight_list', sanitize_text_field($wd_body_font_weight_list_content));
      ajzaa_save_option('wd_body_font_size', sanitize_text_field($_POST['wd_body_font_size']));
      ajzaa_save_option('wd_body_text_lettre_spacing', sanitize_text_field($_POST['wd_body_text_lettre_spacing']));
      ajzaa_save_option('wd_body_text_transform', sanitize_text_field($_POST['wd_body_text_transform']));
      ajzaa_save_option('wd_body_text_font_subsets', sanitize_text_field($_POST['wd_body_text_font_subsets']));

      ajzaa_save_option('wd_heading_font_familly', sanitize_text_field($_POST['wd_heading_font_familly']));
      ajzaa_save_option('wd_heading_font_style', sanitize_text_field($_POST['wd_heading_font_style']));
      ajzaa_save_option('wd_heading_font_weight', sanitize_text_field($_POST['wd_heading_font_weight']));
      $wd_heading_font_weight_list_content = '';
      if (is_array($_POST['wd_heading_font_weight_list']) && count($_POST['wd_heading_font_weight_list']) > 0) {
        foreach ($_POST['wd_heading_font_weight_list'] as $lists) $wd_heading_font_weight_list_content .= $lists . ',';
        $wd_heading_font_weight_list_content = trim($wd_heading_font_weight_list_content, ',');
      } elseif (!is_array($_POST['wd_heading_font_weight_list'])) {
        $wd_heading_font_weight_list_content = $_POST['wd_heading_font_weight_list'];
      }
      ajzaa_save_option('wd_heading_font_weight_list', sanitize_text_field($wd_heading_font_weight_list_content));
      ajzaa_save_option('wd_heading_font_size', sanitize_text_field($_POST['wd_heading_font_size']));
      ajzaa_save_option('wd_heading_text_lettre_spacing', sanitize_text_field($_POST['wd_heading_text_lettre_spacing']));
      ajzaa_save_option('wd_heading_text_transform', sanitize_text_field($_POST['wd_heading_text_transform']));
      ajzaa_save_option('wd_heading_text_font_subsets', sanitize_text_field($_POST['wd_heading_text_font_subsets']));

      ajzaa_save_option('wd_navigation_font_familly', sanitize_text_field($_POST['wd_navigation_font_familly']));
      ajzaa_save_option('wd_navigation_font_style', sanitize_text_field($_POST['wd_navigation_font_style']));
      ajzaa_save_option('wd_navigation_font_weight', sanitize_text_field($_POST['wd_navigation_font_weight']));
      ajzaa_save_option('wd_navigation_text_transform', sanitize_text_field($_POST['wd_navigation_text_transform']));
      ajzaa_save_option('wd_navigation_text_font_subsets', sanitize_text_field($_POST['wd_navigation_text_font_subsets']));
      $wd_navigation_font_weight_list_content = '';
      if (is_array($_POST['wd_navigation_font_weight_list']) && count($_POST['wd_navigation_font_weight_list']) > 0) {
        foreach ($_POST['wd_navigation_font_weight_list'] as $lists) $wd_navigation_font_weight_list_content .= $lists . ',';
        $wd_navigation_font_weight_list_content = trim($wd_navigation_font_weight_list_content, ',');
      } elseif (!is_array($_POST['wd_navigation_font_weight_list'])) {
        $wd_navigation_font_weight_list_content = $_POST['wd_navigation_font_weight_list'];
      }
      ajzaa_save_option('wd_navigation_font_weight_list', sanitize_text_field($wd_navigation_font_weight_list_content));
      ajzaa_save_option('wd_navigation_font_size', sanitize_text_field($_POST['wd_navigation_font_size']));
      ajzaa_save_option('wd_navigation_text_lettre_spacing', sanitize_text_field($_POST['wd_navigation_text_lettre_spacing']));
      ajzaa_save_option('products_per_page', sanitize_text_field($_POST['products_per_page']));

      $socialmedia_name = '';
      if (isset($_POST['socialmedia_name'])) {
        $social_datas = $_REQUEST['socialmedia_name'];
        foreach ($social_datas as $socialdatanam) {
          $socialmedia_name .= $socialdatanam . ' ';
        }
      }
      ajzaa_save_option('socialmedia_name', sanitize_text_field($socialmedia_name));

      $socialmedia_icon = '';
      if (isset($_POST['social_icon'])) {
        $social_datasicon = $_REQUEST['social_icon'];
        foreach ($social_datasicon as $socialdataicon) {
          $socialmedia_icon .= $socialdataicon . ' ';
        }
      }
      ajzaa_save_option('social_icon', sanitize_text_field($socialmedia_icon));


    } ?>


    <?php if (!empty($_POST)): ?>
    <div id="message" class="updated fade">
      <p> <?php echo esc_html__('Configuration updated!!','ajzaa') ?> </p>
    </div>
  <?php endif; ?>
    <?php

    function ajzaa_google_fonts_array()
    {
      $google_fonts = array(array("name" => "ABeeZee", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Abel", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Abhaya Libre", "subsets" => array("latin-ext", "sinhala", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "600", "700", "800")))), array("name" => "Abril Fatface", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Aclonica", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Acme", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Actor", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Adamina", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Advent Pro", "subsets" => array("latin-ext", "latin", "greek"), "variants" => array(array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700")))), array("name" => "Aguafina Script", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Akronim", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Aladin", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Aldrich", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Alef", "subsets" => array("latin", "hebrew"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Alegreya", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700", "900")), array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Alegreya SC", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700", "900")), array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Alegreya Sans", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("100", "300", "400", "500", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "300", "400", "500", "700", "800", "900")))), array("name" => "Alegreya Sans SC", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("100", "300", "400", "500", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "300", "400", "500", "700", "800", "900")))), array("name" => "Alex Brush", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Alfa Slab One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Alice", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Alike", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Alike Angular", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Allan", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Allerta", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Allerta Stencil", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Allura", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Almendra", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Almendra Display", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Almendra SC", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Amarante", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Amaranth", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Amatic SC", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Amatica SC", "subsets" => array("latin-ext", "latin", "hebrew"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Amethysta", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Amiko", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "600", "700")))), array("name" => "Amiri", "subsets" => array("arabic", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Amita", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Anaheim", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Andada", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Andika", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Angkor", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Annie Use Your Telescope", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Anonymous Pro", "subsets" => array("latin-ext", "latin", "greek", "cyrillic"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Antic", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Antic Didone", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Antic Slab", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Anton", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Arapey", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Arbutus", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Arbutus Slab", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Architects Daughter", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Archivo Black", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Archivo Narrow", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Aref Ruqaa", "subsets" => array("arabic", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Arima Madurai", "subsets" => array("latin-ext", "latin", "vietnamese", "tamil"), "variants" => array(array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "700", "800", "900")))), array("name" => "Arimo", "subsets" => array("latin-ext", "greek-ext", "latin", "hebrew", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Arizonia", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Armata", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Artifika", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Arvo", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Arya", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Asap", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("400", "500", "700")), array("style" => "normal", "weight" => array("400", "500", "700")))), array("name" => "Asar", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Asset", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Assistant", "subsets" => array("latin", "hebrew"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "800")))), array("name" => "Astloch", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Asul", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Athiti", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "500", "600", "700")))), array("name" => "Atma", "subsets" => array("latin-ext", "latin", "bengali"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Atomic Age", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Aubrey", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Audiowide", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Autour One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Average", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Average Sans", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Averia Gruesa Libre", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Averia Libre", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "700")), array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Averia Sans Libre", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "700")), array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Averia Serif Libre", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "700")), array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Bad Script", "subsets" => array("latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Baloo", "subsets" => array("latin-ext", "latin", "vietnamese", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Baloo Bhai", "subsets" => array("latin-ext", "latin", "gujarati", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Baloo Bhaina", "subsets" => array("latin-ext", "latin", "vietnamese", "oriya"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Baloo Chettan", "subsets" => array("latin-ext", "latin", "malayalam", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Baloo Da", "subsets" => array("latin-ext", "latin", "vietnamese", "bengali"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Baloo Paaji", "subsets" => array("latin-ext", "latin", "vietnamese", "gurmukhi"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Baloo Tamma", "subsets" => array("latin-ext", "latin", "kannada", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Baloo Thambi", "subsets" => array("latin-ext", "latin", "vietnamese", "tamil"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Balthazar", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bangers", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Basic", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Battambang", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Baumans", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bayon", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Belgrano", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Belleza", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "BenchNine", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Bentham", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Berkshire Swash", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bevan", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bigelow Rules", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bigshot One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bilbo", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bilbo Swash Caps", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "BioRhyme", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "700", "800")))), array("name" => "BioRhyme Expanded", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "700", "800")))), array("name" => "Biryani", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "800", "900")))), array("name" => "Bitter", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Black Ops One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bokor", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bonbon", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Boogaloo", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bowlby One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bowlby One SC", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Brawler", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bree Serif", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bubblegum Sans", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bubbler One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Buda", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("300")))), array("name" => "Buenard", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Bungee", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bungee Hairline", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bungee Inline", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bungee Outline", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Bungee Shade", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Butcherman", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Butterfly Kids", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cabin", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("400", "500", "600", "700")), array("style" => "normal", "weight" => array("400", "500", "600", "700")))), array("name" => "Cabin Condensed", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "600", "700")))), array("name" => "Cabin Sketch", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Caesar Dressing", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cagliostro", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cairo", "subsets" => array("arabic", "latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "900")))), array("name" => "Calligraffitti", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cambay", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Cambo", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Candal", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cantarell", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Cantata One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cantora One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Capriola", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cardo", "subsets" => array("latin-ext", "greek-ext", "latin", "greek"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Carme", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Carrois Gothic", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Carrois Gothic SC", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Carter One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Catamaran", "subsets" => array("latin-ext", "latin", "tamil"), "variants" => array(array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Caudex", "subsets" => array("latin-ext", "greek-ext", "latin", "greek"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Caveat", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Caveat Brush", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cedarville Cursive", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ceviche One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Changa", "subsets" => array("arabic", "latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "500", "600", "700", "800")))), array("name" => "Changa One", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Chango", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Chathura", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("100", "300", "400", "700", "800")))), array("name" => "Chau Philomene One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Chela One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Chelsea Market", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Chenla", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cherry Cream Soda", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cherry Swash", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Chewy", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Chicle", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Chivo", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "900")), array("style" => "normal", "weight" => array("400", "900")))), array("name" => "Chonburi", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cinzel", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Cinzel Decorative", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Clicker Script", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Coda", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "800")))), array("name" => "Coda Caption", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("800")))), array("name" => "Codystar", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400")))), array("name" => "Coiny", "subsets" => array("latin-ext", "latin", "vietnamese", "tamil"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Combo", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Comfortaa", "subsets" => array("latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Coming Soon", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Concert One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Condiment", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Content", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Contrail One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Convergence", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cookie", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Copse", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Corben", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Cormorant", "subsets" => array("latin-ext", "latin", "cyrillic", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "500", "600", "700")), array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Cormorant Garamond", "subsets" => array("latin-ext", "latin", "cyrillic", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "500", "600", "700")), array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Cormorant Infant", "subsets" => array("latin-ext", "latin", "cyrillic", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "500", "600", "700")), array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Cormorant SC", "subsets" => array("latin-ext", "latin", "cyrillic", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Cormorant Unicase", "subsets" => array("latin-ext", "latin", "cyrillic", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Cormorant Upright", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Courgette", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cousine", "subsets" => array("latin-ext", "greek-ext", "latin", "hebrew", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Coustard", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "900")))), array("name" => "Covered By Your Grace", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Crafty Girls", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Creepster", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Crete Round", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Crimson Text", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "600", "700")), array("style" => "normal", "weight" => array("400", "600", "700")))), array("name" => "Croissant One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Crushed", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cuprum", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Cutive", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Cutive Mono", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Damion", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Dancing Script", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Dangrek", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "David Libre", "subsets" => array("latin-ext", "latin", "hebrew", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "700")))), array("name" => "Dawning of a New Day", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Days One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Dekko", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Delius", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Delius Swash Caps", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Delius Unicase", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Della Respira", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Denk One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Devonshire", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Dhurjati", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Didact Gothic", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Diplomata", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Diplomata SC", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Domine", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Donegal One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Doppio One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Dorsa", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Dosis", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "500", "600", "700", "800")))), array("name" => "Dr Sugiyama", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Droid Sans", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Droid Sans Mono", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Droid Serif", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Duru Sans", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Dynalight", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "EB Garamond", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Eagle Lake", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Eater", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Economica", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Eczar", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "600", "700", "800")))), array("name" => "Ek Mukta", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "500", "600", "700", "800")))), array("name" => "El Messiri", "subsets" => array("arabic", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "600", "700")))), array("name" => "Electrolize", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Elsie", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "900")))), array("name" => "Elsie Swash Caps", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "900")))), array("name" => "Emblema One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Emilys Candy", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Engagement", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Englebert", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Enriqueta", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Erica One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Esteban", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Euphoria Script", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ewert", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Exo", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Exo 2", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "italic", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Expletus Sans", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "500", "600", "700")), array("style" => "normal", "weight" => array("400", "500", "600", "700")))), array("name" => "Fanwood Text", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Farsan", "subsets" => array("latin-ext", "latin", "gujarati", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fascinate", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fascinate Inline", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Faster One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fasthand", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fauna One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Federant", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Federo", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Felipa", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fenix", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Finger Paint", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fira Mono", "subsets" => array("latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Fira Sans", "subsets" => array("latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "500", "700")), array("style" => "normal", "weight" => array("300", "400", "500", "700")))), array("name" => "Fjalla One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fjord One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Flamenco", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400")))), array("name" => "Flavors", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fondamento", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Fontdiner Swanky", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Forum", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Francois One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Frank Ruhl Libre", "subsets" => array("latin-ext", "latin", "hebrew"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "700", "900")))), array("name" => "Freckle Face", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fredericka the Great", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fredoka One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Freehand", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fresca", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Frijole", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fruktur", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Fugaz One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "GFS Didot", "subsets" => array("greek"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "GFS Neohellenic", "subsets" => array("greek"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Gabriela", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Gafata", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Galada", "subsets" => array("latin", "bengali"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Galdeano", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Galindo", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Gentium Basic", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Gentium Book Basic", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Geo", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Geostar", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Geostar Fill", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Germania One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Gidugu", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Gilda Display", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Give You Glory", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Glass Antiqua", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Glegoo", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Gloria Hallelujah", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Goblin One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Gochi Hand", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Gorditas", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Goudy Bookletter 1911", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Graduate", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Grand Hotel", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Gravitas One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Great Vibes", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Griffy", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Gruppo", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Gudea", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Gurajada", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Habibi", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Halant", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Hammersmith One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Hanalei", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Hanalei Fill", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Handlee", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Hanuman", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Happy Monkey", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Harmattan", "subsets" => array("arabic", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Headland One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Heebo", "subsets" => array("latin", "hebrew"), "variants" => array(array("style" => "normal", "weight" => array("100", "300", "400", "500", "700", "800", "900")))), array("name" => "Henny Penny", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Herr Von Muellerhoff", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Hind", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Hind Guntur", "subsets" => array("latin-ext", "telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Hind Madurai", "subsets" => array("latin-ext", "latin", "tamil"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Hind Siliguri", "subsets" => array("latin-ext", "latin", "bengali"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Hind Vadodara", "subsets" => array("latin-ext", "latin", "gujarati"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Holtwood One SC", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Homemade Apple", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Homenaje", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell DW Pica", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell DW Pica SC", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell Double Pica", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell Double Pica SC", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell English", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell English SC", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell French Canon", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell French Canon SC", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell Great Primer", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "IM Fell Great Primer SC", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Iceberg", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Iceland", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Imprima", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Inconsolata", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Inder", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Indie Flower", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Inika", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Inknut Antiqua", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700", "800", "900")))), array("name" => "Irish Grover", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Istok Web", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Italiana", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Italianno", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Itim", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Jacques Francois", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Jacques Francois Shadow", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Jaldi", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Jim Nightshade", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Jockey One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Jolly Lodger", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Jomhuria", "subsets" => array("arabic", "latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Josefin Sans", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("100", "300", "400", "600", "700")), array("style" => "normal", "weight" => array("100", "300", "400", "600", "700")))), array("name" => "Josefin Slab", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("100", "300", "400", "600", "700")), array("style" => "normal", "weight" => array("100", "300", "400", "600", "700")))), array("name" => "Joti One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Judson", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Julee", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Julius Sans One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Junge", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Jura", "subsets" => array("latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600")))), array("name" => "Just Another Hand", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Just Me Again Down Here", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kadwa", "subsets" => array("latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Kalam", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Kameron", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Kanit", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Kantumruy", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Karla", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Karma", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Katibeh", "subsets" => array("arabic", "latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kaushan Script", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kavivanar", "subsets" => array("latin-ext", "latin", "tamil"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kavoon", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kdam Thmor", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Keania One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kelly Slab", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kenia", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Khand", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Khmer", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Khula", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "600", "700", "800")))), array("name" => "Kite One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Knewave", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kotta One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Koulen", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kranky", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kreon", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Kristi", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Krona One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kumar One", "subsets" => array("latin-ext", "latin", "gujarati"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kumar One Outline", "subsets" => array("latin-ext", "latin", "gujarati"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Kurale", "subsets" => array("latin-ext", "latin", "cyrillic", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "La Belle Aurore", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Laila", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Lakki Reddy", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lalezar", "subsets" => array("arabic", "latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lancelot", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lateef", "subsets" => array("arabic", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lato", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("100", "300", "400", "700", "900")), array("style" => "normal", "weight" => array("100", "300", "400", "700", "900")))), array("name" => "League Script", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Leckerli One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ledger", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lekton", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Lemon", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lemonada", "subsets" => array("arabic", "latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "600", "700")))), array("name" => "Libre Baskerville", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Libre Franklin", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Life Savers", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Lilita One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lily Script One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Limelight", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Linden Hill", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Lobster", "subsets" => array("latin-ext", "latin", "cyrillic", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lobster Two", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Londrina Outline", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Londrina Shadow", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Londrina Sketch", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Londrina Solid", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lora", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Love Ya Like A Sister", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Loved by the King", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lovers Quarrel", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Luckiest Guy", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Lusitana", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Lustria", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Macondo", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Macondo Swash Caps", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mada", "subsets" => array("arabic", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "900")))), array("name" => "Magra", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Maiden Orange", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Maitree", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "500", "600", "700")))), array("name" => "Mako", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mallanna", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mandali", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Marcellus", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Marcellus SC", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Marck Script", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Margarine", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Marko One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Marmelad", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Martel", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "800", "900")))), array("name" => "Martel Sans", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "800", "900")))), array("name" => "Marvel", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Mate", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Mate SC", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Maven Pro", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "700", "900")))), array("name" => "McLaren", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Meddon", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "MedievalSharp", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Medula One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Meera Inimai", "subsets" => array("latin", "tamil"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Megrim", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Meie Script", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Merienda", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Merienda One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Merriweather", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "700", "900")), array("style" => "normal", "weight" => array("300", "400", "700", "900")))), array("name" => "Merriweather Sans", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "700", "800")), array("style" => "normal", "weight" => array("300", "400", "700", "800")))), array("name" => "Metal", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Metal Mania", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Metamorphous", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Metrophobic", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Michroma", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Milonga", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Miltonian", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Miltonian Tattoo", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Miniver", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Miriam Libre", "subsets" => array("latin-ext", "latin", "hebrew"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Mirza", "subsets" => array("arabic", "latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "600", "700")))), array("name" => "Miss Fajardose", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mitr", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "500", "600", "700")))), array("name" => "Modak", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Modern Antiqua", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mogra", "subsets" => array("latin-ext", "latin", "gujarati"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Molengo", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Molle", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")))), array("name" => "Monda", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Monofett", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Monoton", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Monsieur La Doulaise", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Montaga", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Montez", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Montserrat", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Montserrat Alternates", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Montserrat Subrayada", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Moul", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Moulpali", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mountains of Christmas", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Mouse Memoirs", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mr Bedfort", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mr Dafoe", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mr De Haviland", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mrs Saint Delafield", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mrs Sheppards", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Mukta Vaani", "subsets" => array("latin-ext", "latin", "gujarati"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "500", "600", "700", "800")))), array("name" => "Muli", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("200", "300", "400", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "800", "900")))), array("name" => "Mystery Quest", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "NTR", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Neucha", "subsets" => array("latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Neuton", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("200", "300", "400", "700", "800")))), array("name" => "New Rocker", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "News Cycle", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Niconne", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nixie One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nobile", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Nokora", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Norican", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nosifer", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nothing You Could Do", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Noticia Text", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Noto Sans", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese", "devanagari"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Noto Serif", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Nova Cut", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nova Flat", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nova Mono", "subsets" => array("latin", "greek"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nova Oval", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nova Round", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nova Script", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nova Slim", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nova Square", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Numans", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Nunito", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("200", "300", "400", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "800", "900")))), array("name" => "Nunito Sans", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("200", "300", "400", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "800", "900")))), array("name" => "Odor Mean Chey", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Offside", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Old Standard TT", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Oldenburg", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Oleo Script", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Oleo Script Swash Caps", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Open Sans", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "600", "700", "800")), array("style" => "normal", "weight" => array("300", "400", "600", "700", "800")))), array("name" => "Open Sans Condensed", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("300")), array("style" => "normal", "weight" => array("300", "700")))), array("name" => "Oranienbaum", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Orbitron", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "700", "900")))), array("name" => "Oregano", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Orienta", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Original Surfer", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Oswald", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Over the Rainbow", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Overlock", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700", "900")), array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Overlock SC", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ovo", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Oxygen", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Oxygen Mono", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "PT Mono", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "PT Sans", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "PT Sans Caption", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "PT Sans Narrow", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "PT Serif", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "PT Serif Caption", "subsets" => array("latin-ext", "latin", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Pacifico", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Palanquin", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700")))), array("name" => "Palanquin Dark", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "600", "700")))), array("name" => "Paprika", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Parisienne", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Passero One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Passion One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Pathway Gothic One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Patrick Hand", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Patrick Hand SC", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Pattaya", "subsets" => array("latin-ext", "latin", "thai", "cyrillic", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Patua One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Pavanam", "subsets" => array("latin-ext", "latin", "tamil"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Paytone One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Peddana", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Peralta", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Permanent Marker", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Petit Formal Script", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Petrona", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Philosopher", "subsets" => array("latin", "cyrillic"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Piedra", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Pinyon Script", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Pirata One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Plaster", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Play", "subsets" => array("latin-ext", "latin", "greek", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Playball", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Playfair Display", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "italic", "weight" => array("400", "700", "900")), array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Playfair Display SC", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "italic", "weight" => array("400", "700", "900")), array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Podkova", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Poiret One", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Poller One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Poly", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Pompiere", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Pontano Sans", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Poppins", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700", "800", "900")))), array("name" => "Port Lligat Sans", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Port Lligat Slab", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Pragati Narrow", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Prata", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Preahvihear", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Press Start 2P", "subsets" => array("latin-ext", "latin", "greek", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Pridi", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "500", "600", "700")))), array("name" => "Princess Sofia", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Prociono", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Prompt", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Prosto One", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Proza Libre", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "500", "600", "700", "800")), array("style" => "normal", "weight" => array("400", "500", "600", "700", "800")))), array("name" => "Puritan", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Purple Purse", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Quando", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Quantico", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Quattrocento", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Quattrocento Sans", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Questrial", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Quicksand", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "700")))), array("name" => "Quintessential", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Qwigley", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Racing Sans One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Radley", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Rajdhani", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Rakkas", "subsets" => array("arabic", "latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Raleway", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Raleway Dots", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ramabhadra", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ramaraja", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rambla", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Rammetto One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ranchers", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rancho", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ranga", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Rasa", "subsets" => array("latin-ext", "latin", "gujarati"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Rationale", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ravi Prakash", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Redressed", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Reem Kufi", "subsets" => array("arabic", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Reenie Beanie", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Revalia", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rhodium Libre", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ribeye", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ribeye Marrow", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Righteous", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Risque", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Roboto", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("100", "300", "400", "500", "700", "900")), array("style" => "normal", "weight" => array("100", "300", "400", "500", "700", "900")))), array("name" => "Roboto Condensed", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "700")), array("style" => "normal", "weight" => array("300", "400", "700")))), array("name" => "Roboto Mono", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("100", "300", "400", "500", "700")), array("style" => "normal", "weight" => array("100", "300", "400", "500", "700")))), array("name" => "Roboto Slab", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("100", "300", "400", "700")))), array("name" => "Rochester", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rock Salt", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rokkitt", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Romanesco", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ropa Sans", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Rosario", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Rosarivo", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Rouge Script", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rozha One", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rubik", "subsets" => array("latin-ext", "latin", "hebrew", "cyrillic"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "500", "700", "900")), array("style" => "normal", "weight" => array("300", "400", "500", "700", "900")))), array("name" => "Rubik Mono One", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rubik One", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ruda", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Rufina", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Ruge Boogie", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ruluko", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rum Raisin", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ruslan Display", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Russo One", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ruthie", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Rye", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sacramento", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sahitya", "subsets" => array("latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Sail", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Salsa", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sanchez", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Sancreek", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sansita One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sarala", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Sarina", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sarpanch", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "600", "700", "800", "900")))), array("name" => "Satisfy", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Scada", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Scheherazade", "subsets" => array("arabic", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Schoolbell", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Scope One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Seaweed Script", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Secular One", "subsets" => array("latin-ext", "latin", "hebrew"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sevillana", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Seymour One", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Shadows Into Light", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Shadows Into Light Two", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Shanti", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Share", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Share Tech", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Share Tech Mono", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Shojumaru", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Short Stack", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Shrikhand", "subsets" => array("latin-ext", "latin", "gujarati"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Siemreap", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sigmar One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Signika", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "600", "700")))), array("name" => "Signika Negative", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "600", "700")))), array("name" => "Simonetta", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "900")), array("style" => "normal", "weight" => array("400", "900")))), array("name" => "Sintony", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Sirin Stencil", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Six Caps", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Skranji", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Slabo 13px", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Slabo 27px", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Slackey", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Smokum", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Smythe", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sniglet", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "800")))), array("name" => "Snippet", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Snowburst One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sofadi One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sofia", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sonsie One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sorts Mill Goudy", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400")))), array("name" => "Source Code Pro", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "500", "600", "700", "900")))), array("name" => "Source Sans Pro", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("200", "300", "400", "600", "700", "900")), array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "900")))), array("name" => "Source Serif Pro", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "600", "700")))), array("name" => "Space Mono", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Special Elite", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Spicy Rice", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Spinnaker", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Spirax", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Squada One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sree Krushnadevaraya", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sriracha", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Stalemate", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Stalinist One", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Stardos Stencil", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Stint Ultra Condensed", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Stint Ultra Expanded", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Stoke", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400")))), array("name" => "Strait", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sue Ellen Francisco", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Suez One", "subsets" => array("latin-ext", "latin", "hebrew"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sumana", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Sunshiney", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Supermercado One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Sura", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Suranna", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Suravaram", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Suwannaphum", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Swanky and Moo Moo", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Syncopate", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Tangerine", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Taprom", "subsets" => array("khmer"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Tauri", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Taviraj", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Teko", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Telex", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Tenali Ramakrishna", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Tenor Sans", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Text Me One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "The Girl Next Door", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Tienne", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700", "900")))), array("name" => "Tillana", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "600", "700", "800")))), array("name" => "Timmana", "subsets" => array("telugu", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Tinos", "subsets" => array("latin-ext", "greek-ext", "latin", "hebrew", "greek", "cyrillic", "cyrillic-ext", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Titan One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Titillium Web", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "italic", "weight" => array("200", "300", "400", "600", "700")), array("style" => "normal", "weight" => array("200", "300", "400", "600", "700", "900")))), array("name" => "Trade Winds", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Trirong", "subsets" => array("latin-ext", "latin", "thai", "vietnamese"), "variants" => array(array("style" => "italic", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")), array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Trocchi", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Trochut", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Trykker", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Tulpen One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ubuntu", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "italic", "weight" => array("300", "400", "500", "700")), array("style" => "normal", "weight" => array("300", "400", "500", "700")))), array("name" => "Ubuntu Condensed", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Ubuntu Mono", "subsets" => array("latin-ext", "greek-ext", "latin", "greek", "cyrillic", "cyrillic-ext"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Ultra", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Uncial Antiqua", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Underdog", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Unica One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "UnifrakturCook", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("700")))), array("name" => "UnifrakturMaguntia", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Unkempt", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Unlock", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Unna", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "VT323", "subsets" => array("latin-ext", "latin", "vietnamese"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Vampiro One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Varela", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Varela Round", "subsets" => array("latin", "hebrew"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Vast Shadow", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Vesper Libre", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400", "500", "700", "900")))), array("name" => "Vibur", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Vidaloka", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Viga", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Voces", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Volkhov", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Vollkorn", "subsets" => array("latin"), "variants" => array(array("style" => "italic", "weight" => array("400", "700")), array("style" => "normal", "weight" => array("400", "700")))), array("name" => "Voltaire", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Waiting for the Sunrise", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Wallpoet", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Walter Turncoat", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Warnes", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Wellfleet", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Wendy One", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Wire One", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Work Sans", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("100", "200", "300", "400", "500", "600", "700", "800", "900")))), array("name" => "Yanone Kaffeesatz", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("200", "300", "400", "700")))), array("name" => "Yantramanav", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("100", "300", "400", "500", "700", "900")))), array("name" => "Yatra One", "subsets" => array("latin-ext", "latin", "devanagari"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Yellowtail", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Yeseva One", "subsets" => array("latin-ext", "latin", "cyrillic"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Yesteryear", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))), array("name" => "Yrsa", "subsets" => array("latin-ext", "latin"), "variants" => array(array("style" => "normal", "weight" => array("300", "400", "500", "600", "700")))), array("name" => "Zeyada", "subsets" => array("latin"), "variants" => array(array("style" => "normal", "weight" => array("400")))));
      return $google_fonts;
    }

    function ajzaa_font_weight_name($weight)
    {
      switch ($weight) {
        case "100":
          return "Thin 100";
          break;
        case "200":
          return "Extra-Light 200";
          break;
        case "300":
          return "Light 300";
          break;
        case "400":
          return "Regular 400";
          break;
        case "500":
          return "Medium 500";
          break;
        case "600":
          return "Semi-Bold 600";
          break;
        case "700":
          return "Bold 700";
          break;
        case "800":
          return "Extra-Bold 800";
          break;
        case "900":
          return "Ultra-bold 900";
          break;
        default:
          return "";

      }

    }

    ?>


    <div class="panel-logo">
      <h2><?php echo esc_html__('Webdevia theme options','ajzaa'); ?></h2>
    </div>
    <div class="wd-cpanel">
      <form id="wd-Panel" method="POST" action="">
        <div id="tabs" class="ui-tabs-vertical ui-helper-clearfix">
          <ul>
            <li><a href="#tabs-0"><i class="fa fa-home"></i> <?php echo esc_html__('General Settings', 'ajzaa'); ?></a></li>
            <li><a href="#tabs-1"><i class="fa fa-paint-brush"></i> <?php echo esc_html__('Color Settings', 'ajzaa'); ?></a></li>
            <li><a href="#tabs-2"><i class="fa fa-globe"></i> <?php echo esc_html__('Address Bar', 'ajzaa'); ?></a></li>
            <li><a href="#tabs-3"><i class="fa fa-font"></i> <?php echo esc_html__('Fonts Settings', 'ajzaa'); ?></a></li>
            <li><a href="#tabs-4"><i class="fa fa-jsfiddle"></i> <?php echo esc_html__('Custom & JS', 'ajzaa'); ?></a></li>
            <li><a href="#tabs-5"><i class="fa fa-desktop"></i> <?php echo esc_html__('Footer Settings', 'ajzaa'); ?></a></li>
          </ul>

          <!-- General Setting -->
          <div id="tabs-0">
            <table class="form-table">
              <tbody>

              <tr>
                <td>
                  <strong><?php echo esc_html__('Logo link', 'ajzaa'); ?></strong>
                </td>
                <?php
                $ajzaa_logo_path = ajzaa_get_option('ajzaa_logo_path', '');
                ?>
                <td>
                  <input type="text" name="ajzaa_logo_path" id="ajzaa_logo_path" value="<?php print $ajzaa_logo_path ?>"/>
                  <input class="button" name="_unique_name_button" id="ajzaa_upload_btn" value="<?php echo esc_html__('Upload', 'ajzaa') ?>"/></br>
                </td>
                <td>
                  <?php
                  if (!empty($ajzaa_logo_path)): ?> <img src="<?php print esc_url($ajzaa_logo_path); ?>" style="max-height: 70px;"/> <?php endif;
                  ?>
                </td>
              </tr>

              <tr>
                <td>
                  <strong><?php echo esc_html__('Background Title Bar for Single Post', 'ajzaa'); ?></strong>
                </td>
                <?php

                $ajzaa_bg_single_post_path = ajzaa_get_option('ajzaa_bg_single_post_path', '');
                ?>
                <td>
                  <input type="text" name="ajzaa_bg_single_post_path" id="ajzaa_bg_single_post_path" value="<?php print $ajzaa_bg_single_post_path ?>"/>
                  <input class="button" name="_unique_name_button_single_post" id="ajzaa_upload_single_post" value="<?php echo esc_html__('Upload', 'ajzaa') ?>"/></br>
                </td>
                <td>
                  <?php
                  if (!empty($ajzaa_bg_single_post_path)): ?> <img src="<?php print $ajzaa_bg_single_post_path; ?>" style="max-height: 40px;"/> <?php endif;
                  ?>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="ajzaa_header_style"><strong><?php esc_html__('Header Style:', 'ajzaa'); ?></strong></label>
                </td>
                <td>
                  <select name="ajzaa_header_style" id="ajzaa_header_style" class="ajzaa_header_style">
                    <option value="1" <?php if (ajzaa_get_option('ajzaa_header_style', '1') == '1') echo "selected='selected'"; ?>><?php echo esc_html__('Style 1', 'ajzaa'); ?></option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong><?php echo esc_html__('Show Min Cart', 'ajzaa'); ?></strong></td>
                <td>
                  <input type="checkbox" <?php if (ajzaa_get_option('ajzaa_show_min_cart', '') == 'on') print 'checked'; ?> name="ajzaa_show_min_cart" value="on" id="ajzaa_show_min_cart" class="cmn-toggle cmn-toggle-round"/>
                  <label for="ajzaa_show_min_cart"></label></td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Active Smooth Scroll', 'ajzaa'); ?></strong></td>
                <td>
                  <input type="checkbox" <?php if (ajzaa_get_option('ajzaa_smooth_scroll', '') == 'on') print 'checked'; ?> name="ajzaa_smooth_scroll" value="on" id="ajzaa_smooth_scroll" class="cmn-toggle cmn-toggle-round"/>
                  <label for="ajzaa_smooth_scroll"></label></td>
              </tr>
              <tr>
                <td>
                  <strong><?php echo esc_html__('Google Map Key', 'ajzaa'); ?></strong>
                </td>
                <?php

                $google_map_key = ajzaa_get_option('google_map_key', '');

                ?>
                <td>
                  <input type="text" class="large_input" name="google_map_key" id="google_map_key" value="<?php print esc_attr($google_map_key) ?>"/>
                </td>
              </tr>

              <tr>
                <td>
                  <strong><?php echo esc_html__('Products per page', 'ajzaa'); ?></strong>
                </td>
                <td>
                  <?php
                  $ajzaa_per_pages = ajzaa_get_option('products_per_page');
                  if($ajzaa_per_pages == ''){ $ajzaa_per_pages= "15";}
                  ?>
                  <select name="products_per_page" id="products_per_page" class="products_per_page">
                    <?php
                      for($i=2 ; $i<=20 ; $i++) { ?>
                        <option value="<?php echo esc_attr($i);?>" <?php if ($ajzaa_per_pages == $i) echo "selected='selected'"; ?>><?php echo esc_attr($i);?></option>
                    <?php } ?>
                  </select>
                </td>
              </tr>

              </tbody>
            </table>

          </div>

          <!-- Color Setting -->
          <div id="tabs-1">
            <table class="form-table">
              <tbody>

              <tr>
                <td><strong><?php echo esc_html__('Primary Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_primary_color = ajzaa_get_option('ajzaa_primary_color', '#CD9A00'); ?>

                  <input name="ajzaa_primary_color" type="color" value="<?php print $ajzaa_primary_color; ?>" >

                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Secondary Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_secondary_color = ajzaa_get_option('ajzaa_secondary_color', '#2098d1');

                  ?>
                  <input name="ajzaa_secondary_color" type="color" value="<?php print esc_attr($ajzaa_secondary_color); ?>" >

                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Footer Background Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_footer_bg_color = ajzaa_get_option('ajzaa_footer_bg_color', '#2098d1');
                  ?>
                  <input name="ajzaa_footer_bg_color" type="color" value="<?php print esc_attr($ajzaa_footer_bg_color); ?>" >

                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Top Bar Gradient Background Color:', 'ajzaa'); ?></strong></td>

                <td><?php $ajzaa_top_bar_bg_color = ajzaa_get_option('ajzaa_top_bar_bg_color', '#84cc00');
                  ?>
                  <div class='wd-color-picker'>
                    <input name="ajzaa_top_bar_bg_color" type="color" value="<?php print esc_attr($ajzaa_top_bar_bg_color); ?>" >

                  </div>
                  <div class='wd-color-picker'>
                    <?php $ajzaa_top_bar_bg_color_two = ajzaa_get_option('ajzaa_top_bar_bg_color_two', '#cc0084'); ?>
                    <input name="ajzaa_top_bar_bg_color_two" type="color" value="<?php print esc_attr($ajzaa_top_bar_bg_color_two); ?>" >

                  </div>
                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Top Bar Text Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_top_bar_text_color = ajzaa_get_option('ajzaa_top_bar_text_color', '#333'); ?>
                  <input name="ajzaa_top_bar_text_color" type="color" value="<?php print esc_attr($ajzaa_top_bar_text_color); ?>" >

                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Nav Bar Background Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_nav_bar_bg_color = ajzaa_get_option('ajzaa_nav_bar_bg_color', '#fff');
                  ?>
                  <input name="ajzaa_nav_bar_bg_color" type="color" value="<?php print esc_attr($ajzaa_nav_bar_bg_color); ?>" >

                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Nav Bar Text Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_nav_bar_text_color = ajzaa_get_option('ajzaa_nav_bar_text_color', '#fff'); ?>
                  <input name="ajzaa_nav_bar_text_color" type="color" value="<?php print esc_attr($ajzaa_nav_bar_text_color); ?>" >

                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Sticky Top Bar Background Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_sticky_nav_bar_bg_color = ajzaa_get_option('ajzaa_sticky_nav_bar_bg_color', '#333');
                  ?>
                  <input name="ajzaa_sticky_nav_bar_bg_color" type="color" value="<?php print esc_attr($ajzaa_sticky_nav_bar_bg_color); ?>">

                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Sticky Top Bar Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_sticky_nav_bar_color = ajzaa_get_option('ajzaa_sticky_nav_bar_color', '#333');
                  ?>
                  <input name="ajzaa_sticky_nav_bar_color" type="color" value="<?php print esc_attr($ajzaa_sticky_nav_bar_color); ?>" >

                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Single Product Image Background Color:', 'ajzaa'); ?></strong>
                </td>

                <td class='wd-color-picker'><?php $ajzaa_single_product_bg_color = ajzaa_get_option('ajzaa_single_product_bg_color', '#eaeceb');
                  ?>
                  <input name="ajzaa_single_product_bg_color" type="color" value="<?php print esc_attr($ajzaa_single_product_bg_color); ?>" >

                </td>
              </tr>

              <tr>
                <td><strong><?php echo esc_html__('Toggle Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_toggle_color = ajzaa_get_option('ajzaa_toggle_color', '#fff');
                  ?>
                  <input name="ajzaa_toggle_color" type="color" value="<?php print esc_attr($ajzaa_toggle_color); ?>" >

                </td>
              </tr>
              <tr>
                <td><strong><?php echo esc_html__('Toggle background Color:', 'ajzaa'); ?></strong></td>

                <td class='wd-color-picker'><?php $ajzaa_toggle_background_color = ajzaa_get_option('ajzaa_toggle_background_color', '#000');
                  ?>
                  <input name="ajzaa_toggle_background_color" type="color" value="<?php print esc_attr($ajzaa_toggle_background_color); ?>" >

                </td>
              </tr>

              </tbody>
            </table>
          </div>

          <!-- Social Icon -->
          <div id="tabs-2">
            <table class="form-table">
              <tbody>
              <tr>
                <td><strong><?php echo esc_html__('Show Address Bar', 'ajzaa'); ?></strong></td>
                <td>
                  <input type="checkbox" <?php if (ajzaa_get_option('ajzaa_show_adress_bar') == 'on') print 'checked'; ?> name="ajzaa_show_adress_bar" value="on" id="ajzaa_show_adress_bar" class="cmn-toggle cmn-toggle-round"/>
                  <label for="ajzaa_show_adress_bar"></label></td>
              </tr>
              <tr class="adress-bar-item" <?php if (ajzaa_get_option('ajzaa_show_adress_bar', 'on') != 'on') : ?> style="display: none" <?php endif ?>>
                <td><strong><?php echo esc_html__('Header Phone Number', 'ajzaa'); ?></strong></td>
                <td><input type="text" name="ajzaa_header_number" value="<?php echo esc_attr(ajzaa_get_option("ajzaa_header_number", "")) ?>"/></td>
              </tr>

              <?php if (do_action('icl_language_selector')) { ?>

                <tr class="adress-bar-item" <?php if (ajzaa_get_option('ajzaa_show_adress_bar', 'on') != 'on') : ?> style="display: none" <?php endif ?>>

                  <td><strong><?php echo esc_html__('Show WPML Widget', 'ajzaa'); ?></strong></td>
                  <td>
                    <input type="checkbox" <?php if (ajzaa_get_option('ajzaa_show_wpml_widget') == 'on') print 'checked'; ?> name="ajzaa_show_wpml_widget" value="on" id="ajzaa_show_wpml_widget" class="cmn-toggle cmn-toggle-round"/>
                    <label for="ajzaa_show_wpml_widget"></label>
                  </td>
                </tr>
              <?php } ?>
              <tr class="adress-bar-item" <?php if (ajzaa_get_option('ajzaa_show_adress_bar', 'on') != 'on') : ?> style="display: none" <?php endif ?>>
                <td><strong><?php echo esc_html__('Header E-mail', 'ajzaa'); ?></strong></td>
                <td><input type="text" name="ajzaa_header_email" value="<?php echo esc_attr(ajzaa_get_option("ajzaa_header_email", "")) ?>"/></td>
              </tr>
              <tr class="adress-bar-item" <?php if (ajzaa_get_option('ajzaa_show_adress_bar', 'on') != 'on') : ?> style="display: none" <?php endif ?>>
                <td><strong><?php echo esc_html__('Header Address', 'ajzaa'); ?></strong></td>
                <td><input type="text" name="ajzaa_header_adress" value="<?php echo esc_attr(ajzaa_get_option("ajzaa_header_adress", "")) ?>"/></td>
              </tr>
              <tr <?php if (ajzaa_get_option('ajzaa_show_adress_bar', 'on') != 'on') : ?> style="display: none" <?php endif ?>>
                <td>
                  <strong><?php echo esc_html__('Social Media', 'ajzaa'); ?></strong>
                </td>
                <td>
                  <div class="socialmedia_wrapper">
                    <?php
                    $socialmedia_arry = explode(' ', ajzaa_get_option('socialmedia_name'));
                    $socialmediaicon_arry = explode(' ', ajzaa_get_option('social_icon'));
                    if (!empty($socialmedia_arry[0])) {
                      ?>
                      <p class="social_label"><?php echo esc_html__('Media Icon', 'ajzaa'); ?></p>
                      <p class="social_label"><?php echo esc_html__('Media Link', 'ajzaa'); ?></p>
                      <?php
                      $i = 1;
                      foreach ($socialmedia_arry as $social_data) {
                        $i++;
                        ?>
                        <div class="social_media">
                          <select name="social_icon[icon<?php echo esc_attr($i) ?>]">
                            <option value="-1" disabled><?php echo esc_html__('Select social media icon', 'ajzaa'); ?></option>
                            <option value="fa-facebook" <?php if ($socialmediaicon_arry[$i - 2] == 'fa-facebook') {
                              echo "selected='selected'";
                            } ?> >&#xf09a; facebook
                            </option>
                            <option value="fa-flickr" <?php if ($socialmediaicon_arry[$i - 2] == 'fa-flickr') {
                              echo "selected='selected'";
                            } ?> >&#xf16e; flickr
                            </option>
                            <option
                              value="fa-google-plus" <?php if ($socialmediaicon_arry[$i - 2] == 'fa-google-plus') {
                              echo "selected='selected'";
                            } ?> >&#xf0d5; google-plus
                            </option>
                            <option value="fa-instagram" <?php if ($socialmediaicon_arry[$i - 2] == 'fa-instagram') {
                              echo "selected='selected'";
                            } ?>>&#xf16d; instagram
                            </option>
                            <option value="fa-linkedin" <?php if ($socialmediaicon_arry[$i - 2] == 'fa-linkedin') {
                              echo "selected='selected'";
                            } ?>>&#xf0e1; linkedin
                            </option>
                            <option value="fa-twitter" <?php if ($socialmediaicon_arry[$i - 2] == 'fa-twitter') {
                              echo "selected='selected'";
                            } ?>>&#xf099; twitter
                            </option>
                            <option value="fa-vimeo" <?php if ($socialmediaicon_arry[$i - 2] == 'fa-vimeo') {
                              echo "selected='selected'";
                            } ?>>&#xf27d; vimeo
                            </option>
                            <option value="fa-whatsapp" <?php if ($socialmediaicon_arry[$i - 2] == 'fa-whatsapp') {
                              echo "selected='selected'";
                            } ?>>&#xf232; whatsapp
                            </option>
                            <option value="fa-youtube" <?php if ($socialmediaicon_arry[$i - 2] == 'fa-youtube') {
                              echo "selected='selected'";
                            } ?>>&#xf167; youtube
                            </option>
                          </select>
                          <input type="text" name="socialmedia_name[media<?php echo esc_attr($i) ?>]"
                                 data-number="<?php echo esc_attr($i) ?>"
                                 placeholder="Your social media link"
                                 value="<?php echo esc_attr($social_data) ?>"/>
                          <a href="javascript:void(0);" class="remove_button" title="Remove field">
                            <button type="button" class="button bg_delete_button"><?php echo esc_html__('delete','ajzaa') ?></button>
                          </a>
                        </div>
                        <?php
                      }
                    }
                    ?>
                    <div>
                      <a href="javascript:void(0);" class="add_button" title="Add field">
                        <button type="button" class="button"><?php echo esc_html__('Add Social Media','ajzaa') ?></button>
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>

          <!-- Fonts Settings -->
          <div id="tabs-3">
            <table class="form-table">
              <tbody>
              <tr>
                <td class="first-child">
                  <strong><?php echo esc_html__('Main text font', 'ajzaa'); ?></strong>
                </td>
                <td>
                  <?php $ajzaa_body_font_familly = ajzaa_get_option('wd_body_font_familly');
                  $default_weights = array('300', '400', '600', '700', '800');
                  $ajzaa_fontArray = ajzaa_google_fonts_array();
                  $selected_font = 'default';
                  $selected_font_variants = $ajzaa_fontArray[0]['variants'];
                  $selected_font_subsets = $ajzaa_fontArray[0]['subsets'];
                  $selected_font_variants_weights = $ajzaa_fontArray[0]['variants'][0]['weight'];
                  $selected_style = $ajzaa_fontArray[0]['variants'][0]['style'];
                  $selected_weight = $ajzaa_fontArray[0]['variants'][0]['weight'][0];
                  ?>
                  <table>
                    <tbody>
                    <tr></tr>
                    <tr>
                      <ul>
                        <li>
                          <label for="wd_body_font_familly"><?php echo esc_html__('Font family', 'ajzaa'); ?> :<br>
                          </label>
                          <select name="wd_body_font_familly" id="wd_body_font_familly" class="font_familly main_fonts"
                                  data-classes="main_fonts">
                            <option value="default"><?php echo esc_html__('Default','ajzaa') ?></option>
                            <?php foreach ($ajzaa_fontArray as $pititablo) {
                              $font_name = $pititablo['name'];
                              ?>
                              <option
                                value="<?php echo esc_attr($font_name); ?>" <?php if (ajzaa_get_option('wd_body_font_familly') == $font_name) {
                                echo "selected='selected'";
                                $selected_font = $font_name;
                                $selected_font_variants = $pititablo['variants'];
                                $selected_font_variants_weights = $pititablo['variants'][0]['weight'];
                                $selected_font_subsets = $pititablo['subsets'];
                              } ?> ><?php echo esc_attr($font_name); ?></option>
                            <?php } ?>
                          </select>
                        </li>
                        <li>
                          <label for="wd_body_font_style"><?php echo esc_html__('Font style', 'ajzaa'); ?> :</label>
                          <select name="wd_body_font_style" id="wd_body_font_style" class="font_style main_fonts"
                                  data-classes="main_fonts">
                            <?php
                            if ($selected_font != 'default') {
                              foreach ($selected_font_variants as $pititablo) {
                                $font_style = $pititablo['style'];
                                ?>
                                <option
                                  value="<?php echo esc_attr($font_style); ?>" <?php if (ajzaa_get_option('wd_body_font_style') == $font_style) {
                                  echo "selected='selected'";
                                  $selected_font_variants_weights = $pititablo['weight'];
                                } ?> ><?php echo esc_attr($font_style); ?></option>
                              <?php }
                            } else { ?>
                              <option
                                value="normal" <?php if (ajzaa_get_option('wd_body_font_style') == 'normal') echo "selected='selected'"; ?> >
                                normal
                              </option>
                              <option
                                value="italic" <?php if (ajzaa_get_option('wd_body_font_style') == 'italic') echo "selected='selected'"; ?> >
                                italic
                              </option>
                            <?php } ?>

                          </select>
                        </li>
                        <li>
                          <label for="wd_body_font_weight"><?php echo esc_html__('Font weight', 'ajzaa'); ?>
                            :</label>
                          <select name="wd_body_font_weight" id="wd_body_font_weight" class="font_weight main_fonts"
                                  data-classes="main_fonts">
                            <?php
                            if ($selected_font != 'default') {
                              foreach ($selected_font_variants_weights as $pititablo) {
                                $font_weight = $pititablo;
                                ?>
                                <option
                                  value="<?php echo esc_attr($font_weight); ?>" <?php if (ajzaa_get_option('wd_body_font_weight') == $font_weight) echo "selected='selected'"; ?> ><?php echo esc_attr( ajzaa_font_weight_name($font_weight)); ?></option>
                              <?php }
                            } else {
                              for ($i = 0; $i < count($default_weights); $i++) { ?>
                                <option
                                  value="<?php echo esc_attr($default_weights[$i]); ?>" <?php if (ajzaa_get_option('wd_body_font_weight') == $default_weights[$i]) echo "selected='selected'"; ?> ><?php echo  ajzaa_font_weight_name($default_weights[$i]); ?></option>
                              <?php }
                            } ?>

                          </select>
                        </li>
                        <li>
                          <label for="wd_body_font_size"><?php echo esc_html__('Font size', 'ajzaa'); ?> :</label>
                          <input type="text" class="wd_txt_big fonts_size main_fonts" name="wd_body_font_size"
                                 placeholder="<?php echo esc_html__('example 4', 'ajzaa'); ?>"
                                 value="<?php if (null !== ajzaa_get_option('wd_body_font_size') && ajzaa_get_option('wd_body_font_size') != '') {
                                   echo esc_attr(ajzaa_get_option('wd_body_font_size'));
                                 } else {
                                   echo "14px";
                                 } ?>" data-classes="main_fonts">

                        </li>
                        <li>
                          <label
                            for="wd_body_text_lettre_spacing"><?php echo esc_html__('Lettre Spacing', 'ajzaa'); ?>
                            :</label>
                          <?php
                          $ajzaa_body_text_lettre_spacing = ajzaa_get_option('wd_body_text_lettre_spacing');
                          $ajzaa_body_text_lettre_spacing = (!empty($ajzaa_body_text_lettre_spacing)) ? ajzaa_get_option('wd_body_text_lettre_spacing') : ''; ?>
                          <input type="text" class="wd_txt_big letter_spacing" name="wd_body_text_lettre_spacing"
                                 placeholder="<?php echo esc_html__('example 1px', 'ajzaa') ?>"
                                 value="<?php echo esc_attr($ajzaa_body_text_lettre_spacing); ?>"
                                 data-classes="main_fonts">

                        </li>
                        <li>
                          <label for="wd_body_text_transform"><?php echo esc_html__('Text Transform', 'ajzaa'); ?>
                            :</label>
                          <?php
                          $ajzaa_body_text_transform = ajzaa_get_option('wd_body_text_transform', 'none'); ?>
                          <select name="wd_body_text_transform" class="text_transform" data-classes="main_fonts">
                            <option
                              value="none" <?php if ($ajzaa_body_text_transform == 'none') echo "selected='selected'"; ?> >
                              <?php echo esc_html__('normal', 'ajzaa'); ?>
                            </option>
                            <option
                              value="lowercase" <?php if ($ajzaa_body_text_transform == 'lowercase') echo "selected='selected'"; ?> >
                              <?php echo esc_html__('lowercase', 'ajzaa'); ?>
                            </option>
                            <option
                              value="uppercase" <?php if ($ajzaa_body_text_transform == 'uppercase') echo "selected='selected'"; ?> >
                              <?php echo esc_html__('UPPERCASE', 'ajzaa'); ?>
                            </option>
                          </select>
                        </li>
                        <li>
                          <label for="wd_body_text_font_subsets"><?php echo esc_html__('Font subsets', 'ajzaa'); ?>
                            :</label>
                          <select id="wd_body_text_font_subsets" name="wd_body_text_font_subsets"
                                  class="font_subsets main_fonts" data-classes="main_fonts"><?php
                            if ($selected_font != 'default') {
                              foreach ($selected_font_subsets as $pititablo) {
                                $font_subset = $pititablo;
                                ?>
                                <option
                                  value="<?php echo esc_attr($font_subset); ?>" <?php if (ajzaa_get_option('wd_body_text_font_subsets') == $font_subset) echo "selected='selected'"; ?> ><?php echo esc_attr($font_subset); ?></option>
                              <?php }
                            } else { ?>
                              <option value="latin"><?php echo esc_html__('Default', 'ajzaa'); ?></option>
                            <?php } ?>

                          </select>
                        </li>
                        <li>
                          <label
                            for="wd_body_font_weight_list"><?php echo esc_html__('Font weights to load', 'ajzaa'); ?>
                            :</label>
                          <select name="wd_body_font_weight_list[]" class="font_weight_list main_fonts"
                                  data-classes="main_fonts" multiple style="height: 100%;">
                            <?php
                            $font_weight_list = explode(',', ajzaa_get_option('wd_body_font_weight_list', '300,400'));
                            if ($selected_font != 'default') {
                              foreach ($selected_font_variants as $style) {
                                $style_flag = ($style['style'] == 'italic') ? 'i' : '';
                                $style_name = ($style['style'] == 'italic') ? ' italic' : '';
                                $weighters = $style['weight'];
                                for ($i = 0; $i < count($weighters); $i++) {
                                  $weights_touse = $weighters[$i] . $style_flag;
                                  $position = array_search($weights_touse, $font_weight_list);
                                  ?>
                                  <option
                                    value="<?php echo esc_attr($weights_touse); ?>" <?php if ($position !== false) echo "selected='selected'"; ?> ><?php echo esc_attr( ajzaa_font_weight_name($weighters[$i]) . ' ' . $style_name); ?></option>
                                  <?php
                                }
                                ?>
                              <?php }
                            } else {
                              for ($i = 0; $i < count($default_weights); $i++) {
                                $position = array_search($default_weights[$i], $font_weight_list);
                                $positioni = array_search($default_weights[$i] . 'i', $font_weight_list); ?>
                                <option
                                  value="<?php echo esc_attr($default_weights[$i]); ?>" <?php if ($position !== false) echo "selected='selected'"; ?> ><?php echo  ajzaa_font_weight_name($default_weights[$i]); ?></option>
                                <option
                                  value="<?php echo esc_attr($default_weights[$i]) . 'i'; ?>" <?php if ($positioni !== false) echo "selected='selected'"; ?> ><?php echo  ajzaa_font_weight_name($default_weights[$i]) . ' italic'; ?></option>
                              <?php }
                            } ?>

                          </select>
                        </li>
                      </ul>
                    </tr>
                    <tr>
                      <td>
                        <label><?php echo esc_html__('Preview:', 'ajzaa'); ?> :</label>
                      </td>
                      <td> <?php $font_family = (ajzaa_get_option('wd_body_font_familly') != "default") ? ajzaa_get_option('wd_body_font_familly') : 'Open Sans'; ?>
                        <p class="preview_result  main_fonts"
                           <?php echo 'style="font-family: ' . $font_family . '; font-weight: ' . ajzaa_get_option('wd_body_font_weight') . '; font-style: ' . ajzaa_get_option('wd_body_font_style') . '; letter-spacing: ' . ajzaa_get_option('wd_body_text_lettre_spacing') . '; text-transform: ' . ajzaa_get_option('wd_body_text_transform') . ';';
                           if (null !== ajzaa_get_option('wd_body_font_size') && ajzaa_get_option('wd_body_font_size') != '') {
                             echo ';font-size: ' . ajzaa_get_option('wd_body_font_size') . ';';
                           } else {
                             echo 'font-size:14px';
                           } ?>;"><?php echo esc_html__('Sphinx of black quartz, judge my vow', 'ajzaa'); ?><br>
                        <?php echo esc_html__('Sphinx of black quartz, judge my vow', 'ajzaa'); ?></p>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td class="first-child">
                  <strong><?php echo esc_html__('Head font family', 'ajzaa'); ?></strong>
                </td>
                <td>
                  <?php
                  $selected_font = 'default';
                  $selected_font_variants = $ajzaa_fontArray[0]['variants'];
                  $selected_font_subsets = $ajzaa_fontArray[0]['subsets'];
                  $selected_font_variants_weights = $ajzaa_fontArray[0]['variants'][0]['weight'];
                  $selected_style = $ajzaa_fontArray[0]['variants'][0]['style'];
                  $selected_weight = $ajzaa_fontArray[0]['variants'][0]['weight'][0];
                  ?>
                  <table>
                    <tbody>
                    <tr>
                      <ul>
                        <li>
                          <label for="wd_heading_font_familly"><?php echo esc_html__('Font family', 'ajzaa'); ?>
                            :</label>
                          <select name="wd_heading_font_familly" id="wd_heading_font_familly"
                                  class="font_familly heading_fonts" data-classes="heading_fonts">
                            <option value="400"><?php echo esc_html__('Default', 'ajzaa'); ?></option>
                            <?php foreach ($ajzaa_fontArray as $pititablo) {
                              $font_name = $pititablo['name'];
                              ?>
                              <option
                                value="<?php echo esc_attr($font_name); ?>" <?php if (ajzaa_get_option('wd_heading_font_familly') == $font_name) {
                                echo "selected='selected'";
                                $selected_font = $font_name;
                                $selected_font_variants = $pititablo['variants'];
                                $selected_font_variants_weights = $pititablo['variants'][0]['weight'];
                                $selected_font_subsets = $pititablo['subsets'];
                              } ?> ><?php echo esc_attr($font_name); ?></option>
                            <?php } ?>
                          </select>
                        </li>
                        <li>
                          <label for="wd_heading_font_style"><?php echo esc_html__('Font style', 'ajzaa'); ?>
                            :</label>
                          <select name="wd_heading_font_style" id="wd_heading_font_style"
                                  class="font_style heading_fonts" data-classes="heading_fonts">
                            <?php
                            if ($selected_font != 'default') {
                              foreach ($selected_font_variants as $pititablo) {
                                $font_style = $pititablo['style'];
                                ?>
                                <option
                                  value="<?php echo esc_attr($font_style); ?>" <?php if (ajzaa_get_option('wd_heading_font_style') == $font_style) {
                                  echo "selected='selected'";
                                  $selected_font_variants_weights = $pititablo['weight'];
                                } ?> ><?php echo esc_attr($font_style); ?></option>
                              <?php }
                            } else { ?>
                              <option
                                value="normal" <?php if (ajzaa_get_option('wd_heading_font_style') == 'normal') echo "selected='selected'"; ?> >
                                <?php echo esc_html__('normal', 'ajzaa'); ?>
                              </option>
                              <option
                                value="italic" <?php if (ajzaa_get_option('wd_heading_font_style') == 'italic') echo "selected='selected'"; ?> >
                                <?php echo esc_html__('italic', 'ajzaa'); ?>
                              </option>
                            <?php } ?>
                          </select>
                        </li>
                        <li>
                          <label for="wd_heading_font_weight"><?php echo esc_html__('Font weight', 'ajzaa'); ?>
                            :</label>
                          <select name="wd_heading_font_weight" id="wd_heading_font_weight"
                                  class="font_weight heading_fonts" data-classes="heading_fonts">
                            <?php
                            if ($selected_font != 'default') {
                              foreach ($selected_font_variants_weights as $pititablo) {
                                $font_weight = $pititablo;
                                ?>
                                <option
                                  value="<?php echo esc_attr($font_weight); ?>" <?php if (ajzaa_get_option('wd_heading_font_weight') == $font_weight) echo "selected='selected'"; ?> ><?php echo esc_attr( ajzaa_font_weight_name($font_weight)); ?></option>
                              <?php }
                            } else {
                              for ($i = 0; $i < count($default_weights); $i++) { ?>
                                <option
                                  value="<?php echo esc_attr($default_weights[$i]); ?>" <?php if (ajzaa_get_option('wd_heading_font_weight') == $default_weights[$i]) echo "selected='selected'"; ?> ><?php echo  ajzaa_font_weight_name($default_weights[$i]); ?></option>
                              <?php }
                            } ?>

                          </select>
                        </li>
                        <li>
                          <label for="wd_heading_font_size"><?php echo esc_html__('Font size', 'ajzaa'); ?> :</label>
                          <input type="text" class="wd_txt_big fonts_size heading_fonts" name="wd_heading_font_size"
                                 placeholder="<?php echo esc_html__('example 14px', 'ajzaa'); ?>"
                                 value="<?php if (null !== ajzaa_get_option('wd_heading_font_size') && ajzaa_get_option('wd_heading_font_size') != '') {
                                   echo esc_attr(ajzaa_get_option('wd_heading_font_size'));
                                 } else {
                                   echo "14px";
                                 } ?>" data-classes="heading_fonts">

                        </li>
                        <li>
                          <label
                            for="wd_heading_text_lettre_spacing"><?php echo esc_html__('Lettre Spacing', 'ajzaa'); ?>
                            :</label>
                          <?php
                          $ajzaa_heading_text_lettre_spacing = ajzaa_get_option('wd_heading_text_lettre_spacing');
                          $ajzaa_heading_text_lettre_spacing = (!empty($ajzaa_heading_text_lettre_spacing)) ? ajzaa_get_option('wd_heading_text_lettre_spacing') : ''; ?>
                          <input type="text" class="wd_txt_big letter_spacing" name="wd_heading_text_lettre_spacing"
                                 placeholder="<?php echo esc_html__('example 1px', 'ajzaa'); ?>"
                                 value="<?php echo esc_attr($ajzaa_heading_text_lettre_spacing); ?>"
                                 data-classes="heading_fonts">

                        </li>
                        <li>
                          <label for="wd_heading_text_transform"><?php echo esc_html__('Text Transform', 'ajzaa'); ?>
                            :</label>
                          <?php
                          $ajzaa_heading_text_transform = ajzaa_get_option('wd_heading_text_transform', 'none'); ?>
                          <select name="wd_heading_text_transform" class="text_transform" data-classes="heading_fonts">
                            <option
                              value="none" <?php if ($ajzaa_heading_text_transform == 'none') echo "selected='selected'"; ?> >
                              <?php echo esc_html__('normal', 'ajzaa'); ?>
                            </option>
                            <option
                              value="lowercase" <?php if ($ajzaa_heading_text_transform == 'lowercase') echo "selected='selected'"; ?> >
                              <?php echo esc_html__('lowercase', 'ajzaa'); ?>
                            </option>
                            <option
                              value="uppercase" <?php if ($ajzaa_heading_text_transform == 'uppercase') echo "selected='selected'"; ?> >
                              <?php echo esc_html__('UPPERCASE', 'ajzaa'); ?>
                            </option>
                          </select>
                        </li>
                        <li>
                          <label
                            for="wd_heading_text_font_subsets"><?php echo esc_html__('Font subsets', 'ajzaa'); ?>
                            :</label>
                          <select id="wd_heading_text_font_subsets" name="wd_heading_text_font_subsets"
                                  class="font_subsets heading_fonts" data-classes="heading_fonts"><?php
                            if ($selected_font != 'default') {
                              foreach ($selected_font_subsets as $pititablo) {
                                $font_subset = $pititablo;
                                ?>
                                <option
                                  value="<?php echo esc_attr($font_subset); ?>" <?php if (ajzaa_get_option('wd_heading_text_font_subsets') == $font_subset) echo "selected='selected'"; ?> ><?php echo esc_attr($font_subset); ?></option>
                              <?php }
                            } else { ?>
                              <option value="latin"><?php echo esc_html__('Default', 'ajzaa'); ?></option>
                            <?php } ?>
                          </select>
                        </li>
                        <li>
                          <label
                            for="wd_heading_font_weight_list"><?php echo esc_html__('Font weights to load', 'ajzaa'); ?>
                            : <?php echo esc_attr(ajzaa_get_option('wd_heading_font_weight_list')); ?></label>

                          <select name="wd_heading_font_weight_list[]" class="font_weight_list heading_fonts"
                                  data-classes="heading_fonts" multiple style='height: 100%;'>
                            <?php
                            $font_weight_list = explode(',', ajzaa_get_option('wd_heading_font_weight_list', '300,400'));
                            if ($selected_font != 'default') {
                              foreach ($selected_font_variants as $style) {
                                $style_flag = ($style['style'] == 'italic') ? 'i' : '';
                                $style_name = ($style['style'] == 'italic') ? ' italic' : '';
                                $weighters = $style['weight'];
                                for ($i = 0; $i < count($weighters); $i++) {
                                  $weights_touse = $weighters[$i] . $style_flag;
                                  $position = array_search($weights_touse, $font_weight_list);
                                  ?>
                                  <option
                                    value="<?php echo esc_attr($weights_touse); ?>" <?php if ($position !== false) echo "selected='selected'"; ?> ><?php echo esc_attr( ajzaa_font_weight_name($weighters[$i]) . ' ' . $style_name); ?></option>
                                  <?php
                                }
                                ?>
                              <?php }
                            } else {
                              for ($i = 0; $i < count($default_weights); $i++) {
                                $position = array_search($default_weights[$i], $font_weight_list);
                                $positioni = array_search($default_weights[$i] . 'i', $font_weight_list); ?>
                                <option
                                  value="<?php echo esc_attr($default_weights[$i]); ?>" <?php if ($position !== false) echo "selected='selected'"; ?> ><?php echo  ajzaa_font_weight_name($default_weights[$i]); ?></option>
                                <option
                                  value="<?php echo esc_attr($default_weights[$i]) . 'i'; ?>" <?php if ($positioni !== false) echo "selected='selected'"; ?> ><?php echo  ajzaa_font_weight_name($default_weights[$i]) . ' italic'; ?></option>
                              <?php }
                            } ?>
                          </select>
                        </li>
                      </ul>
                    </tr>
                    <tr>
                      <td>
                        <label><?php echo esc_html__('Preview:', 'ajzaa'); ?> :</label>
                      </td>
                      <td><?php $font_family = (ajzaa_get_option('wd_heading_font_familly') != "default") ? ajzaa_get_option('wd_heading_font_familly') : 'Open Sans'; ?>
                        <p class="preview_result heading_fonts"
                           <?php echo 'style="font-family: ' . $font_family . '; font-weight: ' . ajzaa_get_option('wd_heading_font_weight') . '; font-style: ' . ajzaa_get_option('wd_heading_font_style') . '; letter-spacing: ' . ajzaa_get_option('wd_heading_text_lettre_spacing') . '; text-transform: ' . ajzaa_get_option('wd_heading_text_transform') . ';';
                           if (null !== ajzaa_get_option('wd_heading_font_size') && ajzaa_get_option('wd_heading_font_size') != '') {
                             echo ';font-size: ' . ajzaa_get_option('wd_heading_font_size') . ';';
                           } else {
                             echo 'font-size:14px';
                           } ?>;"><?php echo esc_html__('Sphinx of black quartz, judge my vow', 'ajzaa'); ?><br>
                        <?php echo esc_html__('Sphinx of black quartz, judge my vow', 'ajzaa'); ?></p>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td class="first-child">
                  <strong><?php echo esc_html__('Navigation font family', 'ajzaa'); ?></strong>
                </td>
                <td>
                  <?php
                  $selected_font = 'default';
                  $selected_font_variants = $ajzaa_fontArray[0]['variants'];
                  $selected_font_subsets = $ajzaa_fontArray[0]['subsets'];
                  $selected_font_variants_weights = $ajzaa_fontArray[0]['variants'][0]['weight'];
                  $selected_style = $ajzaa_fontArray[0]['variants'][0]['style'];
                  $selected_weight = $ajzaa_fontArray[0]['variants'][0]['weight'][0];
                  ?>
                  <table>
                    <tbody>
                    <tr>
                      <ul>
                        <li>
                          <label for="wd_navigation_font_familly"><?php echo esc_html__('Font family', 'ajzaa'); ?>
                            :</label>
                          <select name="wd_navigation_font_familly" id="wd_navigation_font_familly"
                                  class="font_familly navigation_fonts" data-classes="navigation_fonts">
                            <option value="default">Default</option>
                            <?php foreach ($ajzaa_fontArray as $pititablo) {
                              $font_name = $pititablo['name'];
                              ?>
                              <option
                                value="<?php echo esc_attr($font_name); ?>" <?php if (ajzaa_get_option('wd_navigation_font_familly') == $font_name) {
                                echo "selected='selected'";
                                $selected_font = $font_name;
                                $selected_font_variants = $pititablo['variants'];
                                $selected_font_variants_weights = $pititablo['variants'][0]['weight'];
                                $selected_font_subsets = $pititablo['subsets'];
                              } ?> ><?php echo esc_attr($font_name); ?></option>
                            <?php } ?>
                          </select>
                        </li>
                        <li>
                          <label for="wd_navigation_font_style"><?php echo esc_html__('Font style', 'ajzaa'); ?>
                            :</label>
                          <select name="wd_navigation_font_style" id="wd_heading_font_style"
                                  class="font_style navigation_fonts" data-classes="navigation_fonts">
                            <?php
                            if ($selected_font != 'default') {
                              foreach ($selected_font_variants as $pititablo) {
                                $font_style = $pititablo['style'];
                                ?>
                                <option
                                  value="<?php echo esc_attr($font_style); ?>" <?php if (ajzaa_get_option('wd_navigation_font_style') == $font_style) {
                                  echo "selected='selected'";
                                  $selected_font_variants_weights = $pititablo['weight'];
                                } ?> ><?php echo esc_attr($font_style); ?></option>
                              <?php }
                            } else { ?>
                              <option
                                value="normal" <?php if (ajzaa_get_option('wd_navigation_font_style') == 'normal') echo "selected='selected'"; ?> >
                                <?php echo esc_html__('normal', 'ajzaa'); ?>
                              </option>
                              <option
                                value="italic" <?php if (ajzaa_get_option('wd_navigation_font_style') == 'italic') echo "selected='selected'"; ?> >
                                <?php echo esc_html__('italic', 'ajzaa'); ?>
                              </option>
                            <?php } ?>

                          </select>
                        </li>
                        <li>
                          <label for="wd_navigation_font_weight"><?php echo esc_html__('Font weight', 'ajzaa'); ?>
                            :</label>
                          <select name="wd_navigation_font_weight" id="wd_navigation_font_weight"
                                  class="font_weight navigation_fonts" data-classes="navigation_fonts">
                            <?php
                            if ($selected_font != 'default') {
                              foreach ($selected_font_variants_weights as $pititablo) {
                                $font_weight = $pititablo;
                                ?>
                                <option
                                  value="<?php echo esc_attr($font_weight); ?>" <?php if (ajzaa_get_option('wd_navigation_font_weight') == $font_weight) echo "selected='selected'"; ?> ><?php echo esc_attr( ajzaa_font_weight_name($font_weight)); ?></option>
                              <?php }
                            } else {
                              for ($i = 0; $i < count($default_weights); $i++) { ?>
                                <option
                                  value="<?php echo esc_attr($default_weights[$i]); ?>" <?php if (ajzaa_get_option('wd_navigation_font_weight') == $default_weights[$i]) echo "selected='selected'"; ?> ><?php echo  ajzaa_font_weight_name($default_weights[$i]); ?></option>
                              <?php }
                            } ?>

                          </select>
                        </li>
                        <li>
                          <label for="wd_navigation_font_size"><?php echo esc_html__('Font size', 'ajzaa'); ?>
                            :</label>
                          <input type="text" class="wd_txt_big fonts_size navigation_fonts"
                                 name="wd_navigation_font_size"
                                 placeholder="<?php echo esc_html__('example 14px', 'ajzaa'); ?>"
                                 value="<?php if (null !== ajzaa_get_option('wd_navigation_font_size') && ajzaa_get_option('wd_navigation_font_size') != '') {
                                   echo esc_attr(ajzaa_get_option('wd_navigation_font_size'));
                                 } else {
                                   echo "14px";
                                 } ?>" data-classes="navigation_fonts">

                        </li>
                        <li>
                          <label
                            for="wd_navigation_text_lettre_spacing"><?php echo esc_html__('Lettre Spacing', 'ajzaa'); ?>
                            :</label>
                          <?php
                          $ajzaa_navigation_text_lettre_spacing = ajzaa_get_option('wd_navigation_text_lettre_spacing');
                          $ajzaa_navigation_text_lettre_spacing = (!empty($ajzaa_navigation_text_lettre_spacing)) ? ajzaa_get_option('wd_navigation_text_lettre_spacing') : ''; ?>
                          <input type="text" class="wd_txt_big letter_spacing" name="wd_navigation_text_lettre_spacing"
                                 placeholder="<?php echo esc_html__('example 1px', 'ajzaa'); ?>"
                                 value="<?php echo esc_attr($ajzaa_navigation_text_lettre_spacing); ?>"
                                 data-classes="navigation_fonts">

                        </li>
                        <li>
                          <label
                            for="wd_navigation_text_transform"><?php echo esc_html__('Text Transform', 'ajzaa'); ?>
                            :</label>
                          <?php
                          $ajzaa_navigation_text_transform = ajzaa_get_option('wd_navigation_text_transform', 'none'); ?>
                          <select name="wd_navigation_text_transform" class="text_transform"
                                  data-classes="navigation_fonts">
                            <option
                              value="none" <?php if ($ajzaa_navigation_text_transform == 'none') echo "selected='selected'"; ?> >
                              <?php echo esc_html__('normal', 'ajzaa'); ?>
                            </option>
                            <option
                              value="lowercase" <?php if ($ajzaa_navigation_text_transform == 'lowercase') echo "selected='selected'"; ?> >
                              <?php echo esc_html__('lowercase', 'ajzaa'); ?>
                            </option>
                            <option
                              value="uppercase" <?php if ($ajzaa_navigation_text_transform == 'uppercase') echo "selected='selected'"; ?> >
                              <?php echo esc_html__('UPPERCASE', 'ajzaa'); ?>
                            </option>
                          </select>
                        </li>
                        <li>
                          <label
                            for="wd_navigation_text_font_subsets"><?php echo esc_html__('Font subsets', 'ajzaa'); ?>
                            :</label>
                          <select id="wd_navigation_text_font_subsets" name="wd_navigation_text_font_subsets"
                                  class="font_subsets navigation_fonts" data-classes="navigation_fonts"><?php
                            if ($selected_font != 'default') {
                              foreach ($selected_font_subsets as $pititablo) {
                                $font_subset = $pititablo;
                                ?>
                                <option
                                  value="<?php echo esc_attr($font_subset); ?>" <?php if (ajzaa_get_option('wd_navigation_text_font_subsets') == $font_subset) echo "selected='selected'"; ?> ><?php echo esc_attr($font_subset); ?></option>
                              <?php }
                            } else { ?>
                              <option value="latin"><?php echo esc_html__('Default', 'ajzaa'); ?></option>
                            <?php } ?>

                          </select>
                        </li>
                        <li>
                          <label
                            for="wd_navigation_font_weight_list"><?php echo esc_html__('Font weights to load', 'ajzaa'); ?>
                            :</label>
                          <select name="wd_navigation_font_weight_list[]" class="font_weight_list navigation_fonts"
                                  data-classes="navigation_fonts" multiple style='height: 100%;'>
                            <?php
                            $font_weight_list = explode(',', ajzaa_get_option('wd_navigation_font_weight_list', '300,400'));
                            if ($selected_font != 'default') {
                              foreach ($selected_font_variants as $style) {
                                $style_flag = ($style['style'] == 'italic') ? 'i' : '';
                                $style_name = ($style['style'] == 'italic') ? ' italic' : '';
                                $weighters = $style['weight'];
                                for ($i = 0; $i < count($weighters); $i++) {
                                  $weights_touse = $weighters[$i] . $style_flag;
                                  $position = array_search($weights_touse, $font_weight_list);
                                  ?>
                                  <option
                                    value="<?php echo esc_attr($weights_touse); ?>" <?php if ($position !== false) echo "selected='selected'"; ?> ><?php echo esc_attr( ajzaa_font_weight_name($weighters[$i]) . ' ' . $style_name); ?></option>
                                  <?php
                                }
                                ?>
                              <?php }
                            } else {
                              for ($i = 0; $i < count($default_weights); $i++) {
                                $position = array_search($default_weights[$i], $font_weight_list);
                                $positioni = array_search($default_weights[$i] . 'i', $font_weight_list); ?>
                                <option
                                  value="<?php echo esc_attr($default_weights[$i]); ?>" <?php if ($position !== false) echo "selected='selected'"; ?> ><?php echo  ajzaa_font_weight_name($default_weights[$i]); ?></option>
                                <option
                                  value="<?php echo esc_attr($default_weights[$i]) . 'i'; ?>" <?php if ($positioni !== false) echo "selected='selected'"; ?> ><?php echo  ajzaa_font_weight_name($default_weights[$i]) . ' italic'; ?></option>
                              <?php }
                            } ?>

                          </select>
                        </li>
                      </ul>
                    </tr>
                    <tr>
                      <td>
                        <label><?php echo esc_html__('Preview:', 'ajzaa'); ?> :</label>
                      </td>
                      <td><?php $font_family = (ajzaa_get_option('wd_navigation_font_familly') != "default") ? ajzaa_get_option('wd_navigation_font_familly') : 'Open Sans'; ?>
                        <p class="preview_result navigation_fonts"
                           <?php echo 'style="font-family: ' . $font_family . '; font-weight: ' . ajzaa_get_option('wd_navigation_font_weight') . '; font-style: ' . ajzaa_get_option('wd_navigation_font_style') . '; letter-spacing: ' . ajzaa_get_option('wd_navigation_text_lettre_spacing') . '; text-transform: ' . ajzaa_get_option('wd_navigation_text_transform') . ';';
                           if (null !== ajzaa_get_option('wd_navigation_font_size') && ajzaa_get_option('wd_navigation_font_size') != '') {
                             echo ';font-size: ' . ajzaa_get_option('wd_navigation_font_size') . ';';
                           } else {
                             echo 'font-size:14px';
                           } ?>;" ><?php echo esc_html__('Sphinx of black quartz, judge my vow', 'ajzaa'); ?><br>
                        <?php echo esc_html__('Sphinx of black quartz, judge my vow', 'ajzaa'); ?></p>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              </tbody>
            </table>
          </div>

          <!-- Custom css & js -->
          <div id="tabs-4">
            <table class="form-table">
              <tbody>
              <tr>
                <td>
                  <strong><?php echo esc_html__('Custom JavaScript', 'ajzaa') ?></strong>
                </td>

                <td>
                  <script>
                    <?php echo ajzaa_get_option('ajzaa_theme_custom_js', '') ?></script>
                  <textarea rows="10" cols="70" name="ajzaa_theme_custom_js" placeholder="Put your JavaScript here"><?php echo ajzaa_get_option('ajzaa_theme_custom_js', ''); ?></textarea>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- Footer Settings -->
          <div id="tabs-5">
            <table class="form-table">
              <tbody>
              <tr>
                <td><strong><?php echo esc_html__('Footer columns', 'ajzaa'); ?></strong></td>
                <td class="ajzaa_footer_columns">
                  <?php $ajzaa_footer_columns = ajzaa_get_option('ajzaa_footer_columns', 'three_columns');

                  ?>
                  <input type="radio" id="ajzaa_footer1" name="ajzaa_footer_columns" value="one_columns" <?php if ($ajzaa_footer_columns == 'one_columns') {
                    echo "checked";
                  } ?> />
                  <label for="ajzaa_footer1" class="ajzaa_footer_columns ajzaa_footer1 <?php if ($ajzaa_footer_columns == 'one_columns') { echo 'label_selected '; } ?>"></label>
                  <input type="radio" id="ajzaa_footer2" name="ajzaa_footer_columns" value="tow_a_columns" <?php if ($ajzaa_footer_columns == 'tow_a_columns') { echo "checked"; } ?> />
                  <label for="ajzaa_footer2" class="ajzaa_footer_columns ajzaa_footer2 <?php if ($ajzaa_footer_columns == 'tow_a_columns') { echo 'label_selected '; } ?>"></label>
                  <input type="radio" id="ajzaa_footer3" name="ajzaa_footer_columns" value="tow_b_columns" <?php if ($ajzaa_footer_columns == 'tow_b_columns') { echo "checked"; } ?> />
                  <label for="ajzaa_footer3" class="ajzaa_footer_columns ajzaa_footer3 <?php if ($ajzaa_footer_columns == 'tow_b_columns') { echo 'label_selected '; } ?>"></label>
                  <input type="radio" id="ajzaa_footer4" name="ajzaa_footer_columns" value="tow_c_columns" <?php if ($ajzaa_footer_columns == 'tow_c_columns') { echo "checked"; } ?> />
                  <label for="ajzaa_footer4" class="ajzaa_footer_columns ajzaa_footer4 <?php if ($ajzaa_footer_columns == 'tow_c_columns') { echo 'label_selected '; } ?>"></label>
                  <input type="radio" id="ajzaa_footer5" name="ajzaa_footer_columns" value="three_columns" <?php if ($ajzaa_footer_columns == 'three_columns') { echo "checked"; } ?> />
                  <label for="ajzaa_footer5" class="ajzaa_footer_columns ajzaa_footer5 <?php if ($ajzaa_footer_columns == 'three_columns') { echo 'label_selected'; } ?>"></label>
                  <input type="radio" id="ajzaa_footer6" name="ajzaa_footer_columns" value="four_columns" <?php if ($ajzaa_footer_columns == 'four_columns') { echo "checked"; } ?> />
                  <label for="ajzaa_footer6" class="ajzaa_footer_columns ajzaa_footer6 <?php if ($ajzaa_footer_columns == 'four_columns') { echo 'label_selected'; } ?>"></label>
                </td>
              </tr>

              <tr>
                <td>
                  <label for="ajzaa_footer_style"><strong><?php echo esc_html__('Footer Style', 'ajzaa'); ?>
                      :</strong></label>
                </td>
                <td>
                  <select name="ajzaa_footer_style" id="ajzaa_footer_style" class="ajzaa_footer_style">

                    <option
                      value="1" <?php if (ajzaa_get_option('ajzaa_footer_style', '1') == '1') echo "selected='selected'"; ?>>
                      <?php echo esc_html__('Style 1', 'ajzaa'); ?>
                    </option>
                    <option
                      value="2" <?php if (ajzaa_get_option('ajzaa_footer_style', '1') == '2') echo "selected='selected'"; ?>>
                      <?php echo esc_html__('Style 2', 'ajzaa'); ?>
                    </option>
                    <option
                      value="3" <?php if (ajzaa_get_option('ajzaa_footer_style', '1') == '3') echo "selected='selected'"; ?>>
                      <?php echo esc_html__('Style 3', 'ajzaa'); ?>
                    </option>
                    <option
                      value="4" <?php if (ajzaa_get_option('ajzaa_footer_style', '1') == '4') echo "selected='selected'"; ?>>
                      <?php echo esc_html__('Style 4', 'ajzaa'); ?>
                    </option>
                    <option
                      value="none" <?php if (ajzaa_get_option('ajzaa_footer_style', '1') == 'none') echo "selected='selected'"; ?>>
                      <?php echo esc_html__('None', 'ajzaa'); ?>
                    </option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <strong><?php echo esc_html__('Footer Background Image', 'ajzaa'); ?></strong>
                </td>
                <?php

                $ajzaa_footer_bg_img_path = ajzaa_get_option('ajzaa_footer_bg_img_path', '');
                ?>
                <td>
                  <input type="text" name="ajzaa_footer_bg_img_path" id="ajzaa_footer_bg_img_path"
                         value="<?php print $ajzaa_footer_bg_img_path ?>"/>
                  <input class="button" name="_unique_name_button" id="ajzaa_upload_footer_btn"
                         value="<?php echo esc_html__('Upload', 'ajzaa') ?>"/></br>
                </td>
                <td>
                  <?php
                  if (!empty($ajzaa_footer_bg_img_path)): ?> <img src="<?php print $ajzaa_footer_bg_img_path; ?>"
                                                                     style="max-height: 70px;"/> <?php endif;
                  ?>
                </td>
              </tr>

              <tr>
                <td>
                  <strong><?php echo esc_html__('Footer Copyright text', 'ajzaa'); ?></strong>
                </td>
                <td>
                  <?php
                  $ajzaa_copyright = ajzaa_get_option('ajzaa_copyright', ''); ?>
                  <input type="text" class="ajzaa_txt_big large_input" name="ajzaa_copyright"
                         placeholder="Footer Copyright text" value="<?php echo esc_attr($ajzaa_copyright); ?>"></td>
              </tr>
              <tr>
                <td>
                  <strong><?php echo esc_html__('Show Cookies Message ?', 'ajzaa'); ?></strong>
                  <?php 
                  $ajzaa_cookies_message= ajzaa_get_option('ajzaa_footer_cookies_message', '');
                  $ajzaa_cookies= ajzaa_get_option('ajzaa_footer_cookies', '');
                  $ajzaa_cookies_link= ajzaa_get_option('ajzaa_footer_cookies_link', '');
                  ?>
                </td>
                <td class="cookies-td">
                  <input type="checkbox" <?php if ($ajzaa_cookies == 'yes') print 'checked'; ?> name="ajzaa_footer_cookies" value="yes" id="ajzaa_footer_cookies" class="cmn-toggle cmn-toggle-round ajzaa_footer_cookies_input"/>
                  <label for="ajzaa_footer_cookies" class="ajzaa_footer_cookies_label"></label>
                    <input type="textarea" class="ajzaa_txt_big large_input cookies-message"  name="ajzaa_footer_cookies_message" id="ajzaa_footer_cookies_message" name="ajzaa_footer_cookies_message"  placeholder="Your Message here.." value="<?php echo esc_attr($ajzaa_cookies_message) ;?>" style="<?php if ($ajzaa_cookies == 'yes') { echo "display:inline-block";}?>">
                    <input type="text" class="ajzaa_txt_big large_input"  name="ajzaa_footer_cookies_link" id="ajzaa_footer_cookies_link" name="ajzaa_footer_cookies_link"  placeholder="Privacy policy link..." value="<?php echo esc_attr($ajzaa_cookies_link) ;?>" style="<?php if ($ajzaa_cookies == 'yes') { echo "display:inline-block";}?>">
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="eight columns wp-core-ui">
      <p>
        <button type="submit" name="search" value="Update Options" class="button success button-primary"/>
        <?php echo esc_html__('Update Options', 'ajzaa'); ?></button></p>
    </div>
    </form>
    </div>


    <div style="clear: both;">
      <br/><br/><br/><br/><br/><br/>
    </div>


    <div class="wb-item">
      <div class="icon-themes">

      </div>
    </div>
    <?php
  }
}

/*
 * ----------------------------------
 *      Wd Importer
 * ----------------------------------
 * */

if (!function_exists('ajzaa_import_demo')) {
  function ajzaa_import_demo()
  {
            ?>
            <div id="tabs-6">
              <div id="wd-metaboxes-general" class="wrap wd-page wd-page-info" style="padding: 20px;background-color: #FFF;">
                <table class="form-table">
                  <tbody>
                  <tr>
                    <td style="display: none;"></td>
                    <td class="import-demo-screenshot" style="padding-left: 250px;">

                      <em class="wd-field-description"><?php echo esc_html__('Select demo to import', 'ajzaa'); ?> : </em>
                      <select name="Demo_selector" id="Demo_selector" class="form-control wd-form-element">
                        <option value="demo-1">Demo 1</option>
                        <option value="demo-2">Demo 2</option>
                        <option value="demo-3">Demo 3</option>
                      </select><br>
                      <label class="demo-1 demos_label" for="demo-1"></label>
                      <label class="demo-2 demos_label" for="demo-2" style="display: none"></label>
                      <label class="demo-3 demos_label" for="demo-3" style="display: none"></label>



                    </td>
                  </tr>
                  <tr>
                    <td style="display:none;">

                    </td>
                    <td style="padding-left: 250px;">
                      <em class="wd-field-description"><?php echo esc_html__('Import Type', 'ajzaa'); ?> : </em>
                      <select name="import_option" id="import_option" class="form-control wd-form-element">
                        <option value=""><?php echo esc_html__('Please Select', 'ajzaa'); ?></option>
                        <option value="complete_content"><?php echo esc_html__('All', 'ajzaa'); ?></option>
                        <option value="content"><?php echo esc_html__('Content', 'ajzaa'); ?></option>
                        <option value="widgets"><?php echo esc_html__('Widgets', 'ajzaa'); ?></option>
                        <option value="options"><?php echo esc_html__('Options', 'ajzaa'); ?></option>
                        <option value="menus"><?php echo esc_html__('Menus', 'ajzaa'); ?></option>
                      </select>
                    </td>
                  </tr>
                  <tr id="tr_import_attachments" style="display:none;" >
                    <td style="display: none;">
                    </td>
                    <td style="padding-left: 250px;">
                      <p><?php echo esc_html__('Do you want to import media files?', 'ajzaa'); ?></p>
                      <input type="checkbox" value="1" class="wd-form-element" name="import_attachments" id="import_attachments"/>
                    </td>
                  </tr>
                  <tr id="tr_delete_menus" style="display:none;">
                    <td style="display: none;">
                    </td>
                    <td style="padding-left: 250px;">
                      <p><?php echo esc_html__('Do you want to delete all existing menus?', 'ajzaa'); ?></p>
                      <input type="checkbox" value="1" class="wd-form-element" name="delete_menus" id="delete_menus" />
                    </td>
                  </tr>
                  <tr>
                    <td style="display: none;">

                    </td>
                    <td style="padding-left: 250px;">
                      <input type="submit" class="button button-primary" value="<?php echo esc_html__('Import', 'ajzaa'); ?>" name="import" id="import_demo_data" />
                      <img id="loading_gif" src="<?php echo get_template_directory_uri() . '/images/loading_import.gif'; ?>" style="margin-left:20px; display:none" />
                      <img id="OK_result" src="<?php echo get_template_directory_uri() . '/images/OK_result.png'; ?>" style="margin-left:20px; display:none" />
                      <img id="NOK_result" src="<?php echo get_template_directory_uri() . '/images/NOK_result.png'; ?>" style="margin-left:20px; display:none" />
                    </td>
                  </tr>
                  <tr>
                    <td style="display: none;">
                    </td>
                    <td style="padding-left: 250px;">
                      <span><?php esc_html__('The import process may take some time. Please be patient.', 'ajzaa') ?> </span><br />
                      <div class="import_load">
                        <div class="wd-progress-bar-wrapper html5-progress-bar">
                          <div class="progress-bar-wrapper">
                            <progress id="progressbar" value="0" max="100"></progress>
                          </div>
                          <div class="progress-value">0%</div>
                          <div class="progress-bar-message"></div>
                          <div class="error-message" style="color:#990000; font-weight:bold;"></div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="display: none;"></td>
                    <td style="text-align: center;">
                      <div class="alert alert-warning">
                        <strong><?php esc_html__('Important notes:', 'ajzaa') ?></strong>
                        <ul>
                          <li><?php esc_html__('Please note that import process will take time needed to download all attachments from demo web site.', 'ajzaa'); ?></li>
                          <li> <?php esc_html__('If you plan to use shop, please install <b>WooCommerce</b> before you run import.', 'ajzaa')?></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>

            </div>
          <?php
  }
}

if (!function_exists('ajzaa_import_revslider')) {
  function ajzaa_import_revslider()
  {

    wp_enqueue_media();

    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');


    wp_enqueue_script('colorpick', get_template_directory_uri() . "/js/bootstrap-colorpicker.min.js", array('jquery'));
    wp_enqueue_style('colorpick', get_template_directory_uri() . "/css/bootstrap-colorpicker.min.css");
    ?>

    <div class="panel-logo">
      <h2><?php echo esc_html__('Carpart Revsliders Import', 'ajzaa'); ?></h2>
    </div>
    <div class="wd-cpanel">
      <div id="wd-Panel" method="POST" action="">
        <div id="tabs" class="ui-tabs-vertical ui-helper-clearfix">
          <div id="tabs-7">
            <form action="<?php echo admin_url("admin-ajax.php"); ?>" enctype="multipart/form-data" method="post">
              <div id="wd-metaboxes-general" class="wrap wd-page wd-page-info"
                   style="padding: 20px;background-color: #FFF;">
                <table class="form-table">
                  <tbody>
                  <tr>
                    <td style="display:none;">
                      <input type="hidden" name="action" value="revslider_ajax_action">
                      <input type="hidden" name="client_action" value="import_slider_slidersview">
                      <input type="hidden" name="nonce" value="<?php echo wp_create_nonce("revslider_actions"); ?>">
                    </td>
                    <td style="padding-left: 250px;">
                      <?php _e("Choose the import file : You can select the demo file \"zip file\" inside the folder \"wp-content\\themes\\ajzaa\\inc\\revslider_import_files\\\" ", 'ajzaa'); ?>
                      :
                      <br><br>
                      <input type="file" size="60" name="import_file" class="input_import_slider"
                             id="input_import_slider"><br><br>

                      <span
                        style="font-weight: 700;"><?php _e("Note: styles templates will be updated if they exist!", 'ajzaa'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td style="display: none;">
                    </td>
                    <td style="padding-left: 250px;"><?php _e("Custom Animations:", 'ajzaa'); ?><br><br>
                      <input type="radio" name="update_animations" value="true"
                             checked="checked"> <?php _e("overwrite", 'ajzaa'); ?>
                      <input type="radio" name="update_animations" value="false"
                             style="margin-left:30px;"> <?php _e("append", 'ajzaa'); ?><br><br>
                      <?php _e("Custom Navigations:", 'ajzaa'); ?><br><br>
                      <input type="radio" name="update_navigations" value="true"
                             checked="checked"> <?php _e("overwrite", 'ajzaa'); ?>
                      <input type="radio" name="update_navigations" value="false"
                             style="margin-left:30px;"> <?php _e("append", 'ajzaa'); ?><br><br>
                      <?php _e("Static Styles:", 'ajzaa'); ?><br><br>
                      <input type="radio" name="update_static_captions"
                             value="true"> <?php _e("overwrite", 'ajzaa'); ?>
                      <input type="radio" name="update_static_captions" value="false"
                             style="margin-left:30px;"> <?php _e("append", 'ajzaa'); ?>
                      <input type="radio" name="update_static_captions" value="none" checked="checked"
                             style="margin-left:30px;"> <?php _e("ignore", 'ajzaa'); ?></td>
                  </tr>
                  <td style="display: none;">
                  </td>
                  <td style="padding-left: 250px;">
                    <br> <input type="submit" class="button button-primary revblue tp-be-button"
                                value="<?php _e("Import Slider", 'ajzaa'); ?>"><br>
                  </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </form>
          </div>


          <script type="text/javascript">
            jQuery(document).ready(function () {
              jQuery(".revblue.tp-be-button").on('click', function (e) {
                if (jQuery("#input_import_slider").val() == '') {
                  alert("Please select the revslider file");
                  e.preventDefault();
                  return false;
                }
              });
            });
          </script>
        </div>
      </div>
    </div>
    </div>


    <div style="clear: both;">
      <br/><br/><br/><br/><br/><br/>
    </div>


    <div class="wb-item">
      <div class="icon-themes">

      </div>
    </div>
    <?php
  }
}