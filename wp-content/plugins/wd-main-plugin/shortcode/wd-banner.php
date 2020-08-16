<?php
if (!function_exists('ajzaa_banner')) {
  function ajzaa_banner($atts)
  {
    extract(shortcode_atts(array(
      'box_title' => '',
      'box_read_more' => '',
      'box_link' => '',
      'title_color' => '#fff',
      'span_color' => '#333',
      'banner_content_width' => '60%',
      'box_attach_image' => '',
      'ajzaa_size_image' => '370x197',
      'ajzaa_title_font_family' => '',
      'ajzaa_title_font_weight' => '',
      'ajzaa_title_font_size' => '',
      'ajzaa_title_text_transform' => '',
      'ajzaa_title_line_height' => '',
      'ajzaa_title_letter_spacing' => '',
      'ajzaa_title_position' => '',
      'box_css' => '',

    ), $atts));
    $box_title = str_replace("{", "<span style='color: " . $span_color . "'>", $box_title);
    $box_title = str_replace("}", "</span>", $box_title);
    $box_title_inline_style = '';
    if ($ajzaa_title_font_family != '') {
      $box_title_inline_style .= 'font-family:' . esc_attr($ajzaa_title_font_family) . ';';
    }
    if ($ajzaa_title_font_weight != '') {
      $box_title_inline_style .= 'font-weight:' . esc_attr($ajzaa_title_font_weight) . ';';
    }
    if ($ajzaa_title_font_size != '') {
      $box_title_inline_style .= 'font-size:' . esc_attr($ajzaa_title_font_size) . ';';
    }
    if ($title_color != '') {
      $box_title_inline_style .= 'color:' . esc_attr($title_color) . ';';
    }
    if ($ajzaa_title_text_transform != '') {
      $box_title_inline_style .= 'text-transform:' . esc_attr($ajzaa_title_text_transform) . ';';
    }
    if ($ajzaa_title_line_height != '') {
      $box_title_inline_style .= 'line-height:' . esc_attr($ajzaa_title_line_height) . ';';
    }
    if ($ajzaa_title_letter_spacing != '') {
      $box_title_inline_style .= 'letter-spacing:' . esc_attr($ajzaa_title_letter_spacing) . ';';
    }

    ob_start();
    $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($box_css, ' '), 'ajzaa_banner', $atts);
    $img_url = wp_get_attachment_url($box_attach_image, 'full');

    if( strtolower($ajzaa_size_image) == "full") {
      $image = $img_url;
    }else{
      $sap = str_replace(array('X', 'x'), 'X', $ajzaa_size_image);
      $ajzaa_image_size_ = explode('X', $sap);
      if (isset($ajzaa_image_size_[0])) {
        $ajzaa_image_size_w = $ajzaa_image_size_[0];
      }
      if (isset($ajzaa_image_size_[1])) {
        $ajzaa_image_size_h = $ajzaa_image_size_[1];
      } else {
        $ajzaa_image_size_h = '';
      }
      if ($ajzaa_image_size_h != '') {
        $image = ajzaa_resize($img_url, $ajzaa_image_size_w, $ajzaa_image_size_h, true);
      } else {
        $image = ajzaa_resize($img_url, $ajzaa_image_size_w, true);
      }
    }


    $banner_content_style = ($banner_content_width == "60%") ?  "" : "style=' width:$banner_content_width'";

    ?>
    <div class="wd-banner <?php echo esc_attr($css_class); ?>">
      <div class="banner-img">
        <img src="<?php echo $image ?>" alt="<?php echo $box_title; ?>">
      </div>
      <?php
      $href = vc_build_link($box_link); ?>
      <?php if (isset($href['url']) && $href['url'] != "") { ?> <a
        href="<?php echo esc_url($href['url']); ?>"> <?php } ?>
        <div class="disc <?php echo $ajzaa_title_position; ?>" <?php echo $banner_content_style; ?>>
          <h3 style="<?php echo $box_title_inline_style ?>"><?php echo $box_title; ?></h3>
          <?php if($box_read_more != ""){ ?>
            <button class="btn small radius" style="margin-top: 16px; font-size: 14px; padding-top: 14px; padding-bottom: 14px;text-transform: uppercase; font-weight: 600;"><?php echo esc_html($box_read_more); ?></button>
          <?php } ?>
        </div>
        <?php if (isset($href['url']) && $href['url'] != "") { ?> </a> <?php } ?>
    </div>
    <?php
    return ob_get_clean();
  }

  add_shortcode('ajzaa_banner', 'ajzaa_banner');
}