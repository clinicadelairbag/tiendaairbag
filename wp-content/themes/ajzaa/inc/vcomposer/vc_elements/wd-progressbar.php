<?php
global $vc_add_css_animation;

vc_map(array(
  'name' => esc_html__('Wd Progress Bar', 'ajzaa'),
  'base' => 'ajzaa_progressbar',
  "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
  "content_element" => true,
  "is_container" => false,
  "category" => 'Webdevia Shortcodes',
  'params' => array(
    array(
      "heading" => esc_html__("Style", 'ajzaa'),
      "type" => "dropdown",
      "param_name" => "ajzaa_progress_style",
      'value' => array('Progress bar' => 'progress_bar',
        'Pie chart' => 'pie_chart',
      ),
    ),
    array(
      'type' => 'textfield',
      'heading' => esc_html__('Widget title', 'ajzaa'),
      'param_name' => 'title',
      'description' => esc_html__('Enter text used as widget title (Note: located above content element).', 'ajzaa'),
    ),
    array(
      'type' => 'param_group',
      'heading' => esc_html__('Values', 'ajzaa'),
      'param_name' => 'values',
      'description' => esc_html__('Enter values for graph - value, title.', 'ajzaa'),
      'value' => urlencode(json_encode(array(
        array(
          'label' => esc_html__('Development', 'ajzaa'),
          'value' => '90',
        ),
        array(
          'label' => esc_html__('Design', 'ajzaa'),
          'value' => '80',
        ),
        array(
          'label' => esc_html__('Marketing', 'ajzaa'),
          'value' => '70',
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
          'type' => 'textfield',
          'heading' => esc_html__('Value', 'ajzaa'),
          'param_name' => 'value',
          'description' => esc_html__('Enter value of bar.', 'ajzaa'),
          'admin_label' => true,
        ),
      ),
    ),
    array(
      'type' => 'textfield',
      'heading' => esc_html__('Units', 'ajzaa'),
      'param_name' => 'units',
      'description' => esc_html__('Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'ajzaa'),
    ),
    array(
      'type' => 'css_editor',
      'heading' => esc_html__('CSS box', 'ajzaa'),
      'param_name' => 'css',
      'group' => esc_html__('Design Options', 'ajzaa'),
    ),
    $vc_add_css_animation,
  ),
));