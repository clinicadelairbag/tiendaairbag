<?php
global $vc_add_css_animation;
global $ajzaa_fonts_array;

vc_map(array(
  "name" => esc_html__("Button", 'ajzaa'),
  "base" => "ajzaa_button",
  "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
  "content_element" => true,
  "is_container" => FALSE,
  "category" => 'Webdevia Shortcodes',
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => esc_html__("Button Text", 'ajzaa'),
      "param_name" => "ajzaa_button_text",
      "value" => "Click Me",
    ),
    array(
      "type" => "colorpicker",
      "heading" => esc_html__("Text Color", 'ajzaa'),
      "param_name" => "ajzaa_button_text_color",
      "value" => "#FFF"
    ),
    array(
      "type" => "colorpicker",
      "heading" => esc_html__("Hover Text Color", 'ajzaa'),
      "param_name" => "ajzaa_button_hover_text_color",
      "value" => "#000"
    ),
    array(
      "type" => "vc_link",
      "heading" => esc_html__("Button Link", 'ajzaa'),
      "param_name" => "ajzaa_button_link",
      "value" => "#",
    ),
    array(
      "heading" => esc_html__("Alignment", 'ajzaa'),
      "type" => "dropdown",
      "param_name" => "button_alignment",
      "value" => array('Center' => "center",
        'Left' => "left",
        'Right' => "right"),
    ),
    array(
      "heading" => esc_html__("Button Size", "ajzaa"),
      "param_name" => "ajzaa_button_size",
      "type" => "dropdown",
      'value' => array(
        'Default' => "",
        'Tiny' => "tiny",
        'Small' => "small",
        'large' => "large",
        'expand' => "expand",
        'disabled' => "disabled"
      ),
    ),
    array(
      "heading" => esc_html__("Button Radius", "ajzaa"),
      "param_name" => "ajzaa_button_radius",
      "type" => "dropdown",
      'value' => array(
        'None' => "",
        'Radius' => "radius",
        'Round' => "round",
      ),
    ),
    array(
      "heading" => esc_html__("Button Background Color", "ajzaa"),
      "param_name" => "ajzaa_button_background_color",
      "type" => "dropdown",
      'value' => array(
        'None' => "",
        'success' => "success",
        'secondary' => "secondary",
        'alert' => "alert",
        'info' => "info",
        'disabled' => "disabled",
        'Custom' => "custom",
      ),
      "group" => "Background",
    ),
    array(
      "type" => "colorpicker",
      "heading" => esc_html__("Button Background Color", 'ajzaa'),
      "param_name" => "ajzaa_button_custom_bg_color",
      "value" => "#000",
      "dependency" => Array("element" => "ajzaa_button_background_color", "value" => array('custom')),
      "group" => "Background",
    ),
    array(
      "type" => "colorpicker",
      "heading" => esc_html__("Hover Background Color", 'ajzaa'),
      "param_name" => "ajzaa_button_custom_hover_bg_color",
      "value" => "#AAA",
      "dependency" => Array("element" => "ajzaa_button_background_color", "value" => array('custom')),
      "group" => "Background",
    ),
    array(
      "heading" => esc_html__("Icon Position", "ajzaa"),
      "param_name" => "ajzaa_button_icon_position",
      "type" => "dropdown",
      'value' => array(
        'None' => "",
        'Left' => "left",
        'Right' => "right",
      ),
      "group" => "Icon",
    ),
    array(
      'type' => 'iconpicker',
      'heading' => esc_html__('Icon', 'ajzaa'),
      'param_name' => 'ajzaa_button_icon',
      'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'iconsPerPage' => 4000, // default 100, how many icons per/page to display
      ),
      'description' => esc_html__('Select icon from library.', 'ajzaa'),
      "dependency" => Array("element" => "ajzaa_button_icon_position", "value" => array('left', 'right')),
      "group" => "Icon",
    ),
    array(
      "heading" => esc_html__("Button Border", "ajzaa"),
      "param_name" => "ajzaa_button_border",
      "type" => "dropdown",
      'value' => array(
        'None' => "no-border",
        'Border' => "border",
      ),
      "group" => "Border",
    ),
    array(
      "heading" => esc_html__("Button Border Size", "ajzaa"),
      "param_name" => "ajzaa_button_border_size",
      "type" => "textfield",
      'value' => '',
      "dependency" => Array("element" => "ajzaa_button_border", "value" => array('border')),
      "group" => "Border",
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Button Border Color", 'ajzaa'),
      "param_name" => "ajzaa_button_border_color",
      "value" => "#000",
      "dependency" => Array("element" => "ajzaa_button_border", "value" => array('border')),
      "group" => "Border",
    ),

    $vc_add_css_animation

  )
));