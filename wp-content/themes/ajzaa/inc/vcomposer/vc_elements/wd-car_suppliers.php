<?php
vc_map(
  array(
    "name" => esc_html__("Car Suppliers", 'ajzaa'),
    "base" => "ajzaa_single_product_supplier",
    "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
    "content_element" => true,
    "is_container" => FALSE,
    "category" => 'Webdevia Shortcodes',
    "params" => array(
      array(
        "type" => "dropdown",
        "heading" => "Layout Style",
        "param_name" => "layout",
        "value" => array(
          "Grid" => "grid",
          "Carousel" => "carousel",
        )
      ),
      array(
        "type" => "dropdown",
        "heading" => "Number of columns",
        "description" => "Set How Many Columns Shown",
        "param_name" => "number_rows",
        "value" => array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
        )
      ),
      array(
        "type" => "textfield",
        "heading" => "Number of Items",
        "description" => "Set How Many Items Shown",
        "param_name" => "number_items"
      ),
      array(
        "type" => "textfield",
        "heading" => "Margin between images",
        "description" => "Set value of margin between images Default 5px",
        "param_name" => "margin"
      ),
      array(
        "type" => "textfield",
        "heading" => "Image size",
        "description" => "Set size of images => Exemple:400x300",
        "param_name" => "size"
      ),
      array(
        "type" => "checkbox",
        "heading" => "Show Title",
        "description" => "Display the title",
        "param_name" => "show_title"
      ),

    )

  )
);