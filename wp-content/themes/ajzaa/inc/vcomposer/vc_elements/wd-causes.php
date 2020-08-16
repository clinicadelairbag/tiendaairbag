<?php

global $vc_add_css_animation;
/* our client
---------------------------------------------------------- */
vc_map(array(
  "name" => esc_html__("Wd Causes", 'ajzaa'),
  "base" => "ajzaa_causes",
  "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
  "content_element" => true,
  "is_container" => FALSE,
  "category" => 'Webdevia Shortcodes',
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Display Style", 'ajzaa'),
      "param_name" => "ajzaa_causes_affichage_type",
      "value" => array(
        'Image Post in Left' => 'ajzaa_blog_image_left',
        'Image Post in Top' => 'ajzaa_blog_image_top'

      )
    )
  ,

    $vc_add_css_animation
  )
));