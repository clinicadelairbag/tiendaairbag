<?php
global $vc_add_css_animation;
global $ajzaa_fonts_array;

vc_map(array(
  'name' => esc_html__('Wd List', 'ajzaa'),
  'base' => 'ajzaa_list',
  "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
  "content_element" => true,
  "is_container" => false,
  "category" => 'Webdevia Shortcodes',
  'params' => array(

    array(
      'type' => 'param_group',
      'heading' => esc_html__('Values', 'ajzaa'),
      'param_name' => 'values',
      'description' => esc_html__('Enter values for graph - value, title and color.', 'ajzaa'),
      'value' => urlencode(json_encode(array(
        array(
          'label' => esc_html__('Put some text here ...', 'ajzaa'),
          'value' => 'fa fa-adjust',
        ),
        array(
          'label' => esc_html__('Put some text here ...', 'ajzaa'),
          'value' => 'fa fa-adjust',
        ),
      ))),
      'params' => array(
        array(
          'type' => 'textfield',
          'heading' => esc_html__('Label', 'ajzaa'),
          'param_name' => 'label',
          'description' => esc_html__('Enter text used as title of bar.', 'ajzaa'),
          'admin_label' => true,
        ),
        array(
          'type' => 'iconpicker',
          'heading' => esc_html__('Value', 'ajzaa'),
          'param_name' => 'value',
          'description' => esc_html__('Select icon from library.', 'ajzaa'),
          'admin_label' => true,
        ),
        array(
          'type' => 'colorpicker',
          'heading' => esc_html__('Icon color', 'ajzaa'),
          'param_name' => 'icon_color',
          'description' => esc_html__('Select the icon color.', 'ajzaa'),
        ),
        array(
          'type' => 'colorpicker',
          'heading' => esc_html__('Text color', 'ajzaa'),
          'param_name' => 'text_color',
          'description' => esc_html__('Select the text color.', 'ajzaa'),
        ),
      ),
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("List Style", 'ajzaa'),
      "param_name" => "ajzaa_list_style",
      'value' => array(
        esc_html__('Default', 'ajzaa') => 'style-1',
        'Style 2' => 'style-2',
        'Style 2 light' => 'style-2-2',
        'Style 3' => 'style-3',
        'Style 3 light' => 'style-3-3',
        'Style 4' => 'style-4',
        'Style 4 light' => 'style-4-4',
      ),
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Icon Padding", 'ajzaa'),
      "param_name" => "ajzaa_icon_padding",
      "suffix" => "px"
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Icon Margin", 'ajzaa'),
      "param_name" => "ajzaa_icon_margin",
      "suffix" => "px"
    ),
    // ------------------ Typography
    array(
      "type" => "dropdown",
      'value' => $ajzaa_fonts_array,
      "heading" => esc_html__("Font Family", 'ajzaa'),
      "param_name" => "ajzaa_font_family",
      "group" => "Typography"
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Font Size", 'ajzaa'),
      "param_name" => "ajzaa_font_size",
      "suffix" => "px",
      "group" => "Typography"
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Icon Size", 'ajzaa'),
      "param_name" => "ajzaa_icon_size",
      "suffix" => "px",
      "group" => "Typography"
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Font Weight", 'ajzaa'),
      "param_name" => "ajzaa_font_weight",
      'value' => array(
        esc_html__('Default', 'ajzaa') => '400',
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '500' => '500',
        '600' => '600',
        '700' => '700',
        '800' => '800',
        '900' => '900',
      ),
      "group" => "Typography"
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Text Transform", 'ajzaa'),
      "param_name" => "ajzaa_text_transform",
      'value' => array(
        esc_html__('Default', 'ajzaa') => 'none',
        'Lowercase' => 'lowercase',
        'Uppercase' => 'uppercase',
        'Capitalize' => 'capitalize',
        'Inherit' => 'inherit',
      ),
      "group" => "Typography"
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Line Height", 'ajzaa'),
      "param_name" => "ajzaa_line_height",
      "value" => "30",
      "suffix" => "px",
      "group" => "Typography"
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Letter spacing", 'ajzaa'),
      "param_name" => "ajzaa_letter_spacing",
      "value" => "",
      "suffix" => "px",
      "group" => "Typography"
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Font Style", 'ajzaa'),
      "param_name" => "ajzaa_font_style",
      'value' => array(
        esc_html__('Normal', 'ajzaa') => 'normal',
        esc_html__('Italic', 'ajzaa') => 'italic',
        esc_html__('Inherit', 'ajzaa') => 'inherit',
        esc_html__('Initial', 'ajzaa') => 'initial',
      ),
      "group" => "Typography"
    ),
    $vc_add_css_animation,
  ),
));