<?php

global $vc_add_css_animation;
global $ajzaa_fonts_array;
/*********---------team--------------------------*/
vc_map(array(
  "name" => esc_html__("Wd Team Member", 'ajzaa'), // add a name
  "base" => "ajzaa_team_members", // bind with our shortcode
  "icon" => get_template_directory_uri() . "/images/icon/meknes.png",
  "content_element" => true, // set this parameter when element will has a content
  "is_container" => FALSE, // set this param when you need to add a content element in this element
  "category" => 'Webdevia Shortcodes',
  // Here starts the definition of array with parameters of our compnent
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Layout Style", 'ajzaa'),
      "param_name" => "layout_style",
      "value" => array('Slider' => 'slider',
        'Carousel' => 'carousel',
        'Grid' => 'grid')
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
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Picture Position", 'ajzaa'),
      "param_name" => "picture_position",
      "value" => array('Left' => 'image_left',
        'Right' => 'image_right'),
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Slider Layout Style", 'ajzaa'),
      "param_name" => "slider_layout_style",
      "value" => array('Team Member name > Job Title > Bibliography' => 'name_jobtitle_biblio',
        'Job Title > Team Member name > Bibliography' => 'jobtitle_name_biblio'),
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Show Website", 'ajzaa'),
      "param_name" => "show_website",
      "value" => array('Yes' => 'yes',
        'No' => 'no'),
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid')),
      "group" => "Website Style"
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Navigation style", 'ajzaa'),
      "param_name" => "navigation_style",
      "value" => array('Dots' => 'dotts',
        'Arrows' => 'arrows'),
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Dots position", 'ajzaa'),
      "param_name" => "dots_position",
      "value" => array('In' => 'in',
        'Out' => 'out'),
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'), "element" => "navigation_style", "value" => array('dotts'),)
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Elements To Show In Mobile", 'ajzaa'),
      "param_name" => "elements_to_show_mobile",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'))
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Elements To Show In Tablet", 'ajzaa'),
      "param_name" => "elements_to_show_tablet",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'))
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Elements To Show In Desktop", 'ajzaa'),
      "param_name" => "elements_to_show_desktop",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'))
    ),

    array(
      "type" => "dropdown",
      "heading" => esc_html__("Show Skills", 'ajzaa'),
      "param_name" => "show_skills",
      "value" => array('Yes' => 'yes',
        'No' => 'no'),
      "dependency" => Array("element" => "layout_style", "value" => array('slider')),
      "group" => "Skills Style",
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Skills Layout", 'ajzaa'),
      "param_name" => "skills_layout",
      "value" => array('Pie Chart' => 'pie_chart',
        'Progress Bar' => 'progress_bar'),
      "dependency" => Array("element" => "layout_style", "value" => array('slider')),
      "group" => "Skills Style",
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Show Bibliography", 'ajzaa'),
      "param_name" => "show_description",
      "value" => array('Yes' => 'yes',
        'No' => 'no'),
      "dependency" => Array("element" => "layout_style", "value" => array('grid', 'grid')),
    ),
    array(
      "type" => "textarea_html",
      "heading" => esc_html__("Static HTML Item", 'ajzaa'),
      "description" => esc_html__("Used for add description item", 'ajzaa'),
      "param_name" => "static_html_item",
      "dependency" => Array("element" => "layout_style", "value" => array('grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Static Html Item Description Position", 'ajzaa'),
      "param_name" => "static_html_item_position",
      "value" => array(
        'None' => 'none',
        'Before' => 'before',
        'After' => 'after'),
      "dependency" => Array("element" => "layout_style", "value" => array('grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Static HTML Item Link To", 'ajzaa'),
      "param_name" => "static_html_item_link",
      "dependency" => Array("element" => "layout_style", "value" => array('grid'))
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_html__("Static HTML Item Background Color", 'ajzaa'),
      "param_name" => "static_html_item_bg_color",
      "value" => "",
      "dependency" => Array("element" => "layout_style", "value" => array('grid'))
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_html__("Static HTML Item text Color", 'ajzaa'),
      "param_name" => "static_html_item_text_color",
      "value" => "",
      "dependency" => Array("element" => "layout_style", "value" => array('grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Elements To Swipe", 'ajzaa'),
      "param_name" => "elements_to_swipe",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel'))
    ),
    // Team Member Name typography
    array(
      "heading" => esc_html__("Team Member Name Tag", 'ajzaa'),
      "type" => "dropdown",
      "param_name" => "team_member_name_tag",
      "value" => array('H2 (Default)' => 'h2',
        'H1' => 'h1',
        'H3' => 'h3',
        'H4' => 'h4',
        'H5' => 'h5',
        'H6' => 'h6'),
      "group" => "Typography",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid')),
      "group" => "Name Style",
    ),
    array(
      "type" => "dropdown",
      'value' => $ajzaa_fonts_array,
      "heading" => esc_html__("Team Member Name Font Family", 'ajzaa'),
      "param_name" => "team_member_name_font_family",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid')),
      "group" => "Name Style",
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Team Member Name Font Size", 'ajzaa'),
      "param_name" => "team_member_name_font_size",
      "min" => 14,
      "suffix" => "px",
      "group" => "Name Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_html__("Team Member Name Font Color", 'ajzaa'),
      "param_name" => "team_member_name_color",
      "value" => "",
      "group" => "Name Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Team Member Name Font Weight", 'ajzaa'),
      "param_name" => "team_member_name_font_weight",
      'value' => array(
        esc_html__('Default', 'ajzaa') => '900',
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '500' => '500',
        '600' => '600',
        '700' => '700',
        '800' => '800',
        '400' => '400',
      ),
      "group" => "Name Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Team Member Name Text Transform", 'ajzaa'),
      "param_name" => "team_member_name_text_transform",
      'value' => array(
        esc_html__('Default', 'ajzaa') => 'none',
        'Lowercase' => 'lowercase',
        'Uppercase' => 'uppercase',
        'Capitalize' => 'capitalize',
        'Inherit' => 'inherit',
      ),
      "group" => "Name Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Team Member Name Line Height", 'ajzaa'),
      "param_name" => "team_member_name_line_height",
      "value" => "",
      "suffix" => "px",
      "group" => "Name Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Team Member Name Letter spacing", 'ajzaa'),
      "param_name" => "team_member_name_letter_spacing",
      "value" => "",
      "suffix" => "px",
      "group" => "Name Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Team Member Name Font Style", 'ajzaa'),
      "param_name" => "team_member_name_font_style",
      'value' => array(
        esc_html__('Normal', 'ajzaa') => 'normal',
        esc_html__('Italic', 'ajzaa') => 'italic',
        esc_html__('Inherit', 'ajzaa') => 'inherit',
        esc_html__('Initial', 'ajzaa') => 'initial',
      ),
      "group" => "Name Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),

    // Job Title Tepography
    array(
      "heading" => esc_html__("Job Title Tag", 'ajzaa'),
      "type" => "dropdown",
      "param_name" => "job_title_tag",
      "value" => array('H4 (Default)' => 'h4',
        'H1' => 'h1',
        'H2' => 'h2',
        'H3' => 'h3',
        'H5' => 'h5',
        'H6' => 'h6'),
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid')),
      "group" => "Job Title Style",
    ),
    array(
      "type" => "dropdown",
      'value' => $ajzaa_fonts_array,
      "heading" => esc_html__("Job Title Font Family", 'ajzaa'),
      "param_name" => "job_title_font_family",
      "group" => "Job Title Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Job Title Font Size", 'ajzaa'),
      "param_name" => "job_title_font_size",
      "min" => 14,
      "suffix" => "px",
      "group" => "Job Title Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_html__("Job Title Font Color", 'ajzaa'),
      "param_name" => "job_title_color",
      "value" => "",
      "group" => "Job Title Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Job Title Font Weight", 'ajzaa'),
      "param_name" => "job_title_font_weight",
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
      "group" => "Job Title Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Job Title Text Transform", 'ajzaa'),
      "param_name" => "job_title_text_transform",
      'value' => array(
        esc_html__('Default', 'ajzaa') => 'none',
        'Lowercase' => 'lowercase',
        'Uppercase' => 'uppercase',
        'Capitalize' => 'capitalize',
        'Inherit' => 'inherit',
      ),
      "group" => "Job Title Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Job Title Line Height", 'ajzaa'),
      "param_name" => "job_title_line_height",
      "value" => "",
      "suffix" => "px",
      "group" => "Job Title Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Job Title Letter spacing", 'ajzaa'),
      "param_name" => "job_title_letter_spacing",
      "value" => "",
      "suffix" => "px",
      "group" => "Job Title Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Job Title Font Style", 'ajzaa'),
      "param_name" => "job_title_font_style",
      'value' => array(
        esc_html__('Normal', 'ajzaa') => 'normal',
        esc_html__('Italic', 'ajzaa') => 'italic',
        esc_html__('Inherit', 'ajzaa') => 'inherit',
        esc_html__('Initial', 'ajzaa') => 'initial',
      ),
      "group" => "Job Title Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),

    // About Team member Typography
    array(
      "type" => "dropdown",
      'value' => $ajzaa_fonts_array,
      "heading" => esc_html__("About Font Family", 'ajzaa'),
      "param_name" => "about_font_family",
      "group" => "Bibliography Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("About Font Size", 'ajzaa'),
      "param_name" => "about_font_size",
      "min" => 14,
      "suffix" => "px",
      "group" => "Bibliography Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_html__("About Font Color", 'ajzaa'),
      "param_name" => "about_color",
      "value" => "",
      "group" => "Bibliography Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("About Font Weight", 'ajzaa'),
      "param_name" => "about_font_weight",
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
      "group" => "Bibliography Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("About Text Transform", 'ajzaa'),
      "param_name" => "about_text_transform",
      'value' => array(
        esc_html__('Default', 'ajzaa') => 'none',
        'Lowercase' => 'lowercase',
        'Uppercase' => 'uppercase',
        'Capitalize' => 'capitalize',
        'Inherit' => 'inherit',
      ),
      "group" => "Bibliography Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("About Line Height", 'ajzaa'),
      "param_name" => "about_line_height",
      "value" => "",
      "suffix" => "px",
      "group" => "Bibliography Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("About Letter spacing", 'ajzaa'),
      "param_name" => "about_letter_spacing",
      "value" => "",
      "suffix" => "px",
      "group" => "Bibliography Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("About Font Style", 'ajzaa'),
      "param_name" => "about_font_style",
      'value' => array(
        esc_html__('Normal', 'ajzaa') => 'normal',
        esc_html__('Italic', 'ajzaa') => 'italic',
        esc_html__('Inherit', 'ajzaa') => 'inherit',
        esc_html__('Initial', 'ajzaa') => 'initial',
      ),
      "group" => "Bibliography Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    // Skills Typography
    array(
      "type" => "dropdown",
      'value' => $ajzaa_fonts_array,
      "heading" => esc_html__("Skill Name Font Family", 'ajzaa'),
      "param_name" => "skill_name_font_family",
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "dropdown",
      'value' => $ajzaa_fonts_array,
      "heading" => esc_html__("Skill Value Font Family", 'ajzaa'),
      "param_name" => "skill_value_font_family",
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Skill Name Font Size", 'ajzaa'),
      "param_name" => "skill_name_font_size",
      "min" => 14,
      "suffix" => "px",
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Skill Value Font Size", 'ajzaa'),
      "param_name" => "skill_value_font_size",
      "min" => 14,
      "suffix" => "px",
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_html__("Skill Name Font Color", 'ajzaa'),
      "param_name" => "skill_name_color",
      "value" => "",
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_html__("Skill Value Font Color", 'ajzaa'),
      "param_name" => "skill_value_name_color",
      "value" => "",
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Skill Name Font Weight", 'ajzaa'),
      "param_name" => "skill_name_font_weight",
      'value' => array(
        esc_html__('Default', 'ajzaa') => '900',
        '100' => '100',
        '200' => '200',
        '300' => '300',
        '500' => '500',
        '600' => '600',
        '700' => '700',
        '800' => '800',
        '900' => '400',
      ),
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Skill Value Font Weight", 'ajzaa'),
      "param_name" => "skill_value_font_weight",
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
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Skill Name Text Transform", 'ajzaa'),
      "param_name" => "skill_name_text_transform",
      'value' => array(
        esc_html__('Default', 'ajzaa') => 'none',
        'Lowercase' => 'lowercase',
        'Uppercase' => 'uppercase',
        'Capitalize' => 'capitalize',
        'Inherit' => 'inherit',
      ),
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Skill Value Text Transform", 'ajzaa'),
      "param_name" => "skill_value_text_transform",
      'value' => array(
        esc_html__('Default', 'ajzaa') => 'none',
        'Lowercase' => 'lowercase',
        'Uppercase' => 'uppercase',
        'Capitalize' => 'capitalize',
        'Inherit' => 'inherit',
      ),
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Skill Name Letter spacing", 'ajzaa'),
      "param_name" => "skill_name_letter_spacing",
      "value" => "",
      "suffix" => "px",
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Skill Value Letter spacing", 'ajzaa'),
      "param_name" => "skill_value_letter_spacing",
      "value" => "",
      "suffix" => "px",
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Skill Name Font Style", 'ajzaa'),
      "param_name" => "skill_name_font_style",
      'value' => array(
        esc_html__('Normal', 'ajzaa') => 'normal',
        esc_html__('Italic', 'ajzaa') => 'italic',
        esc_html__('Inherit', 'ajzaa') => 'inherit',
        esc_html__('Initial', 'ajzaa') => 'initial',
      ),
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Skill Value Font Style", 'ajzaa'),
      "param_name" => "skill_value_font_style",
      'value' => array(
        esc_html__('Normal', 'ajzaa') => 'normal',
        esc_html__('Italic', 'ajzaa') => 'italic',
        esc_html__('Inherit', 'ajzaa') => 'inherit',
        esc_html__('Initial', 'ajzaa') => 'initial',
      ),
      "group" => "Skills Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider'))
    ),
    // Team member Website Typography
    array(
      "type" => "dropdown",
      'value' => $ajzaa_fonts_array,
      "heading" => esc_html__("Website Font Family", 'ajzaa'),
      "param_name" => "website_font_family",
      "group" => "Website Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Website Font Size", 'ajzaa'),
      "param_name" => "website_font_size",
      "min" => 14,
      "suffix" => "px",
      "group" => "Website Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_html__("Website Font Color", 'ajzaa'),
      "param_name" => "website_color",
      "value" => "",
      "group" => "Website Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Website Font Weight", 'ajzaa'),
      "param_name" => "website_font_weight",
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
      "group" => "Website Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Website Text Transform", 'ajzaa'),
      "param_name" => "website_text_transform",
      'value' => array(
        esc_html__('Default', 'ajzaa') => 'none',
        'Lowercase' => 'lowercase',
        'Uppercase' => 'uppercase',
        'Capitalize' => 'capitalize',
        'Inherit' => 'inherit',
      ),
      "group" => "Website Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("Website Letter spacing", 'ajzaa'),
      "param_name" => "website_letter_spacing",
      "value" => "",
      "suffix" => "px",
      "group" => "Website Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Website Font Style", 'ajzaa'),
      "param_name" => "website_font_style",
      'value' => array(
        esc_html__('Normal', 'ajzaa') => 'normal',
        esc_html__('Italic', 'ajzaa') => 'italic',
        esc_html__('Inherit', 'ajzaa') => 'inherit',
        esc_html__('Initial', 'ajzaa') => 'initial',
      ),
      "group" => "Website Style",
      "dependency" => Array("element" => "layout_style", "value" => array('slider', 'carousel', 'grid'))
    ),
    // Social Medias Typo
    array(
      "type" => "dropdown",
      "heading" => esc_html__("Show Social Medias", 'ajzaa'),
      "param_name" => "show_social_media",
      'value' => array(
        esc_html__('Yes', 'ajzaa') => 'yes',
        esc_html__('No', 'ajzaa') => 'no'
      ),
      "dependency" => Array("element" => "layout_style", "value" => array('carousel', 'grid'))
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => esc_html__("social Icons Size", 'ajzaa'),
      "param_name" => "social_icons_size",
      "min" => 14,
      "suffix" => "px",
      "group" => "Social Medias",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel', 'grid'))
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_html__("Social Icons Color", 'ajzaa'),
      "param_name" => "social_icons_color",
      "value" => "",
      "group" => "Social Medias",
      "dependency" => Array("element" => "layout_style", "value" => array('carousel', 'grid'))
    ),


    $vc_add_css_animation
  )
));