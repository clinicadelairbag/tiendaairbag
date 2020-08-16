<?php
vc_map(array(
  "name" => esc_html__("Wd Empty Space", 'ajzaa'),
  "base" => "ajzaa_empty_spaces",
  "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
  "content_element" => true,
  "is_container" => FALSE,
  "category" => 'Webdevia Shortcodes',
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => esc_html__("Height in Mobile", 'ajzaa'),
      "param_name" => "height_mobile",
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Height in Tablet", 'ajzaa'),
      "param_name" => "height_tablet",
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Height in Desktop", 'ajzaa'),
      "param_name" => "height_desktop",
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Extra Classes", 'ajzaa'),
      "param_name" => "extra_classes",
    )
  )
));