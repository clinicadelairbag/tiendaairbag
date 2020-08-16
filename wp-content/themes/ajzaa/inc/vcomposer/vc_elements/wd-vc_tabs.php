<?php
if (!defined('ABSPATH')) {
  die('-1');
}

return array(
  'name' => __('Tabs', 'ajzaa'),
  'base' => 'wd_vc_tta_tabs',
  'icon' => 'icon-wpb-ui-tab-content',
  'is_container' => true,
  "category" => 'Webdevia Shortcodes',
  'show_settings_on_create' => false,
  'as_parent' => array(
    'only' => 'vc_tta_section',
  ),
  'category' => __('Content', 'ajzaa'),
  'description' => __('Tabbed content', 'ajzaa'),
  'params' => array(
    array(
      'type' => 'textfield',
      'param_name' => 'title',
      'heading' => __('Widget title', 'ajzaa'),
      'description' => __('Enter text used as widget title (Note: located above content element).', 'ajzaa'),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'style',
      'value' => array(
        __('Classic', 'ajzaa') => 'classic',
        __('Modern', 'ajzaa') => 'modern',
        __('Flat', 'ajzaa') => 'flat',
        __('Outline', 'ajzaa') => 'outline',
      ),
      'heading' => __('Style', 'ajzaa'),
      'description' => __('Select tabs display style.', 'ajzaa'),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'shape',
      'value' => array(
        __('Rounded', 'ajzaa') => 'rounded',
        __('Square', 'ajzaa') => 'square',
        __('Round', 'ajzaa') => 'round',
      ),
      'heading' => __('Shape', 'ajzaa'),
      'description' => __('Select tabs shape.', 'ajzaa'),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'color',
      'heading' => __('Color', 'ajzaa'),
      'description' => __('Select tabs color.', 'ajzaa'),
      'value' => getVcShared('colors-dashed'),
      'std' => 'grey',
      'param_holder_class' => 'vc_colored-dropdown',
    ),
    array(
      'type' => 'checkbox',
      'param_name' => 'no_fill_content_area',
      'heading' => __('Do not fill content area?', 'ajzaa'),
      'description' => __('Do not fill content area with color.', 'ajzaa'),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'spacing',
      'value' => array(
        __('None', 'ajzaa') => '',
        '1px' => '1',
        '2px' => '2',
        '3px' => '3',
        '4px' => '4',
        '5px' => '5',
        '10px' => '10',
        '15px' => '15',
        '20px' => '20',
        '25px' => '25',
        '30px' => '30',
        '35px' => '35',
      ),
      'heading' => __('Spacing', 'ajzaa'),
      'description' => __('Select tabs spacing.', 'ajzaa'),
      'std' => '1',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'gap',
      'value' => array(
        __('None', 'ajzaa') => '',
        '1px' => '1',
        '2px' => '2',
        '3px' => '3',
        '4px' => '4',
        '5px' => '5',
        '10px' => '10',
        '15px' => '15',
        '20px' => '20',
        '25px' => '25',
        '30px' => '30',
        '35px' => '35',
      ),
      'heading' => __('Gap', 'ajzaa'),
      'description' => __('Select tabs gap.', 'ajzaa'),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'tab_position',
      'value' => array(
        __('Top', 'ajzaa') => 'top',
        __('Bottom', 'ajzaa') => 'bottom',
      ),
      'heading' => __('Position', 'ajzaa'),
      'description' => __('Select tabs navigation position.', 'ajzaa'),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'alignment',
      'value' => array(
        __('Left', 'ajzaa') => 'left',
        __('Right', 'ajzaa') => 'right',
        __('Center', 'ajzaa') => 'center',
      ),
      'heading' => __('Alignment', 'ajzaa'),
      'description' => __('Select tabs section title alignment.', 'ajzaa'),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'autoplay',
      'value' => array(
        __('None', 'ajzaa') => 'none',
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '10' => '10',
        '20' => '20',
        '30' => '30',
        '40' => '40',
        '50' => '50',
        '60' => '60',
      ),
      'std' => 'none',
      'heading' => __('Autoplay', 'ajzaa'),
      'description' => __('Select auto rotate for tabs in seconds (Note: disabled by default).', 'ajzaa'),
    ),
    array(
      'type' => 'textfield',
      'param_name' => 'active_section',
      'heading' => __('Active section', 'ajzaa'),
      'value' => 1,
      'description' => __('Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'ajzaa'),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'pagination_style',
      'value' => array(
        __('None', 'ajzaa') => '',
        __('Square Dots', 'ajzaa') => 'outline-square',
        __('Radio Dots', 'ajzaa') => 'outline-round',
        __('Point Dots', 'ajzaa') => 'flat-round',
        __('Fill Square Dots', 'ajzaa') => 'flat-square',
        __('Rounded Fill Square Dots', 'ajzaa') => 'flat-rounded',
      ),
      'heading' => __('Pagination style', 'ajzaa'),
      'description' => __('Select pagination style.', 'ajzaa'),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'pagination_color',
      'value' => getVcShared('colors-dashed'),
      'heading' => __('Pagination color', 'ajzaa'),
      'description' => __('Select pagination color.', 'ajzaa'),
      'param_holder_class' => 'vc_colored-dropdown',
      'std' => 'grey',
      'dependency' => array(
        'element' => 'pagination_style',
        'not_empty' => true,
      ),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Extra class name', 'ajzaa'),
      'param_name' => 'el_class',
      'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ajzaa'),
    ),
    array(
      'type' => 'css_editor',
      'heading' => __('CSS box', 'ajzaa'),
      'param_name' => 'css',
      'group' => __('Design Options', 'ajzaa'),
    ),
  ),
  'js_view' => 'VcBackendTtaTabsView',
  'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
  <div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
    <div class="vc_tta-tabs-container">'
    . '<ul class="vc_tta-tabs-list">'
    . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
    . '</ul>
    </div>
    <div class="vc_tta-panels vc_clearfix {{container-class}}">
      {{ content }}
    </div>
  </div>
</div>',
  'default_content' => '
[vc_tta_section title="' . sprintf('%s %d', __('Tab', 'ajzaa'), 1) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf('%s %d', __('Tab', 'ajzaa'), 2) . '"][/vc_tta_section]
  ',
  'admin_enqueue_js' => array(
    vc_asset_url('lib/vc_tabs/vc-tabs.min.js'),
  ),
);
