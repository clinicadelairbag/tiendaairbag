<?php


function ajzaa_button($atts)
{

  extract(shortcode_atts(array(
    'ajzaa_button_text' => '',
    'ajzaa_button_text_color' => '',
    'ajzaa_button_link' => '',
    'ajzaa_button_size' => '',
    'ajzaa_button_radius' => '',
    'ajzaa_button_background_color' => '',
    'button_alignment' => 'center',

    'ajzaa_button_custom_bg_color' => '',
    'ajzaa_button_icon_position' => '',
    'ajzaa_button_icon' => '',
    'ajzaa_button_border' => 'no-border',

    'ajzaa_button_border_size' => '',
    'ajzaa_button_border_color' => '',

    'css_animation' => 'no'
  ), $atts));

  ob_start();

  $ajzaa_button_class = $ajzaa_btn_bg_color_inline_style = '';
  $ajzaa_button_class = $ajzaa_button_size;
  $ajzaa_button_class .= " " . $ajzaa_button_border;
  $ajzaa_button_class .= " " . $ajzaa_button_radius;
  if ($ajzaa_button_background_color == 'custom') {
    $ajzaa_btn_bg_color_inline_style = 'background :' . $ajzaa_button_custom_bg_color . ';';
  } else {
    $ajzaa_button_class .= " " . $ajzaa_button_background_color;
  }

  if ($ajzaa_button_border == 'border') {
    $ajzaa_btn_bg_color_inline_style .= 'border-width :' . $ajzaa_button_border_size . 'px;';
    $ajzaa_btn_bg_color_inline_style .= 'border-color :' . $ajzaa_button_border_color . ';';
  }
  $ajzaa_btn_text_color_inline_style = ' color : ' . $ajzaa_button_text_color;

  $target = '';
  if ($ajzaa_button_link != "#") {
    $href = vc_build_link($ajzaa_button_link);
    $ajzaa_button_link = $href['url'];
    $target = (isset($href['target']) && $href['target'] != '') ? ' target=' . $href['target'] : '';
  }

  if ($ajzaa_button_icon_position == 'right') {
    ?>
    <div class="text-<?php echo $button_alignment ?>">
      <a href="<?php echo esc_url($ajzaa_button_link) ?>"<?php echo $target; ?>
         style="<?php echo esc_attr($ajzaa_btn_bg_color_inline_style);
         echo esc_attr($ajzaa_btn_text_color_inline_style) ?>"
         class="button btn-icon-right <?php echo esc_attr($ajzaa_button_class) ?>"><?php echo esc_attr($ajzaa_button_text) ?>
        <i class="<?php echo esc_attr($ajzaa_button_icon) ?>"
           style="<?php echo esc_attr($ajzaa_btn_text_color_inline_style) ?>"></i></a>
    </div>
    <?php
  } elseif ($ajzaa_button_icon_position == 'left') {
    ?>
    <div class="text-<?php echo $button_alignment ?>">
      <a href="<?php echo esc_url($ajzaa_button_link) ?>"<?php echo $target; ?>
         style="<?php echo esc_attr($ajzaa_btn_bg_color_inline_style);
         echo esc_attr($ajzaa_btn_text_color_inline_style) ?>"
         class="button btn-icon-left <?php echo esc_attr($ajzaa_button_class) ?>"><i
          class="<?php echo esc_attr($ajzaa_button_icon) ?>"
          style="<?php echo esc_attr($ajzaa_btn_text_color_inline_style) ?>"></i><?php echo esc_attr($ajzaa_button_text) ?>
      </a>
    </div>
    <?php
  } else {
    ?>
    <div class="text-<?php echo $button_alignment ?>">
      <a href="<?php echo esc_attr($ajzaa_button_link) ?>"<?php echo $target; ?>
         style="<?php echo esc_attr($ajzaa_btn_bg_color_inline_style);
         echo esc_attr($ajzaa_btn_text_color_inline_style) ?>"
         class="button <?php echo esc_attr($ajzaa_button_class) ?>"><?php echo esc_attr($ajzaa_button_text) ?></a>
    </div>
    <?php
  }
  return ob_get_clean();
}

add_shortcode('ajzaa_button', 'ajzaa_button'); ?>
