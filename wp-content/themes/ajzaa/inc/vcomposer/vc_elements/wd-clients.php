<?php

global $vc_add_css_animation;
/* our client
---------------------------------------------------------- */
vc_map(array(
  "name" => esc_html__("Wd Clients", 'ajzaa'),
  "base" => "ajzaa_clients",
  "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
  "content_element" => true,
  "is_container" => FALSE,
  "category" => 'Webdevia Shortcodes',
  "params" => array(
    array(
      'type' => 'attach_images',
      'heading' => esc_html__('Images', 'ajzaa'),
      'param_name' => 'images',

    )
  , array(
      "type" => "dropdown", // it will bind a textfield in WP
      "heading" => esc_html__("Layout Style", 'ajzaa'),
      "param_name" => "layout_style",
      "value" => array('Carousel' => 'carousel',
        'Grid' => 'grid'),
    )
  , array(
      "type" => "dropdown", // it will bind a textfield in WP
      "heading" => esc_html__("Navigation Style", 'ajzaa'),
      "param_name" => "nav_style",
      "value" => array('Dots' => 'dots',
        'Arrows' => 'arrows'),
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'))
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Elements To Swipe", 'ajzaa'),
      "param_name" => "elements_to_swipe",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'))
    ),

    array(
      "type" => "textfield",
      "heading" => esc_html__("Items To Display in Mobile", 'ajzaa'),
      "param_name" => "item_to_display_mobile",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'))
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Items To Display in Tablet", 'ajzaa'),
      "param_name" => "item_to_display_tablet",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'))
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Items To Display in Desktop", 'ajzaa'),
      "param_name" => "item_to_display_desktop",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'))
    ),


    array(
      "type" => "textfield",
      "heading" => esc_html__("Columns number in Mobile", 'ajzaa'),
      "param_name" => "columns_number_mobile",
      "dependency" => Array("element" => "layout_style", "value" => array('grid'))
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Columns number in Tablet", 'ajzaa'),
      "param_name" => "columns_number_tablet",
      "dependency" => Array("element" => "layout_style", "value" => array('grid'))
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Columns number in Desktop", 'ajzaa'),
      "param_name" => "columns_number_desktop",
      "dependency" => Array("element" => "layout_style", "value" => array('grid'))
    ),

    $vc_add_css_animation
  )
));