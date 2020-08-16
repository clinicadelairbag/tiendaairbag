<?php
global $vc_add_css_animation;
global $ajzaa_fonts_array;

vc_map(array(
  "name" => esc_html__("Banner", "ajzaa"),
  "base" => "ajzaa_banner",
  "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
  "content_element" => true,
  "is_container" => FALSE,
  "category" => "Webdevia Shortcodes",
  "params" => array(
    //__________________Title_______________________
    array(
      "heading" => esc_html__("Title Text", "ajzaa"),
      "type" => "textfield",
      "param_name" => "box_title",
      "value" => "I am a Title change my",
    ),
    array(
      "heading" => esc_html__("Read More Text", "ajzaa"),
      "type" => "textfield",
      "param_name" => "box_read_more",
      "value" => "I am a Title change my",
    ),
    array(
      "heading" => esc_html__("Image", "ajzaa"),
      "type" => "attach_image",
      "param_name" => "box_attach_image",
      "value" => "I am a Title change my",
    ),
    array(
      "heading" => esc_html__("Image Size", "ajzaa"),
      "type" => "textfield",
      "param_name" => "ajzaa_size_image",
      'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'ajzaa' ),
      "value" => "The image size",
    ),
    array(
      "heading" => esc_html__("Content Width", "ajzaa"),
      "type" => "textfield",
      "param_name" => "banner_content_width",
      "value" => "60%",
    ),
    array(
      "heading" => esc_html__("Banner Link", "ajzaa"),
      "type" => "vc_link",
      "param_name" => "box_link",
      "value" => "",
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Title Position", "ajzaa"),
      "param_name" => "ajzaa_title_position",
      "value" => array(
        esc_html__("Default", "ajzaa") => "400",
        "Top Left" => "top_left",
        "Top Right" => "top_right",
        "Bottom Left" => "bottom_left",
        "Bottom Right" => "bottom_right",
      ),
    ),
    array(
      "heading" => esc_html__("Title Color", "ajzaa"),
      "type" => "colorpicker",
      "param_name" => "title_color",
      "value" => "#fff",
      "group" => "Typography",
    ),
    array(
      "heading" => esc_html__("Color Title between brackets", "ajzaa"),
      "type" => "colorpicker",
      "param_name" => "span_color",
      "value" => "#333",
      "group" => "Typography",
    ),
    //////////// Typography Title
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Font Family", "ajzaa"),
      "param_name" => "ajzaa_title_font_family",
      "value" => $ajzaa_fonts_array,
      "group" => "Typography",
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Font Weight", "ajzaa"),
      "param_name" => "ajzaa_title_font_weight",
      "value" => array(
        esc_html__("Default", "ajzaa") => "400",
        "100" => "100",
        "200" => "200",
        "300" => "300",
        "500" => "500",
        "600" => "600",
        "700" => "700",
        "800" => "800",
        "900" => "900",
      ),
      "group" => "Typography",
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Font Size", "ajzaa"),
      "param_name" => "ajzaa_title_font_size",
      "min" => 14,
      "suffix" => "px",
      "group" => "Typography",
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Text Transform", "ajzaa"),
      "param_name" => "ajzaa_title_text_transform",
      "value" => array(
        esc_html__("Default", "ajzaa") => "None",
        "lowercase" => "Lowercase",
        "uppercase" => "Uppercase",
        "capitalize" => "Capitalize",
        "inherit" => "Inherit",
      ),
      "group" => "Typography",
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Line Height", "ajzaa"),
      "param_name" => "ajzaa_title_line_height",
      "value" => "",
      "suffix" => "px",
      "group" => "Typography",
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Letter spacing", "ajzaa"),
      "param_name" => "ajzaa_title_letter_spacing",
      "value" => "",
      "suffix" => "px",
      "group" => "Typography",
    ),
    array(
      "type" => "css_editor",
      "heading" => __( "Box Css", "ajzaa" ),
      "param_name" => "box_css",
      "group" => __( "Box Css", "ajzaa" ),
    ),
  )

));