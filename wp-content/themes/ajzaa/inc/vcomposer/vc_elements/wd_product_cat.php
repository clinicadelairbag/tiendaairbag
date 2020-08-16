<?php

/* our client
---------------------------------------------------------- */
if (!function_exists('ajzaa_product_category')) {
  add_action('admin_init', 'ajzaa_product_category');

  function ajzaa_product_category()
  {
    global $vc_add_css_animation;
    global $ajzaa_fonts_array;

    $categories_array = array('default');
    $categories = get_terms('product_cat', array('parent' => 0, 'hide_empty' => false));
    if (!is_wp_error($categories)) {
      foreach ($categories as $category) {
        $categories_array[$category->name] = $category->term_id;
      }
    }
    vc_map(array(
      "name" => esc_html__("Wd Product Category", 'ajzaa'),
      "base" => "ajzaa_product_cat",
      "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
      "content_element" => true,
      "is_container" => FALSE,
      "category" => 'Webdevia Shortcodes',
      "params" => array(
        array(
          "type" => "textfield",
          "heading" => "Sub category Per Item",
          "description" => "Number of sub category to show",
          "param_name" => "items_per_cat"
        ),
        array(
          "type" => "textfield",
          "heading" => "Grid",
          "description" => "Columns Grid",
          "param_name" => "columns"
        ),
        array(
          "type" => "textfield",
          "heading" => "Thumbnail Size",
          "description" => "thumbnail size",
          "param_name" => "thumbnail_size"
        ),
        array(
          'type' => 'dropdown_multi',
          'heading' => __('Select Category', 'ajzaa'),
          'param_name' => 'my_category',
          'value' => $categories_array,
          'description' => __('Select a category', 'ajzaa'),
        ),

        $vc_add_css_animation
      )
    ));
  }
}