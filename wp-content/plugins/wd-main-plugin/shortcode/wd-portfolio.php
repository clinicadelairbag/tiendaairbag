<?php
function ajzaa_portfolio($atts) {
  global $ajzaa_fonts_to_enqueue_array;
  $custom_portfolio_title_inline_style = $custom_portfolio_tags_inline_style = $custom_filters_inline_style = "";
  extract( shortcode_atts( array(
    'ajzaa_portfolio_layout' => 'grid',
    'ajzaa_portfolio_hover_style' => 'style-1',
    'ajzaa_portfolio_free_style_layout' => 'style-1',
    'overlay_color' => '',
    'ajzaa_portfolio_categories' => '',
    'ajzaa_portfolio_filters' => 'yes',
    'ajzaa_portfolio_columns_mobile' => '1',
    'ajzaa_portfolio_columns_tablet' => '2',
    'ajzaa_portfolio_columns_desktop' => '3',
    'load_more_style' => 'load_more_link',
    'navigation_style' => '',
    'ajzaa_static_html_item_position' => 'none',
    'ajzaa_static_html_item' => '',
    'ajzaa_static_html_item_width' => 'two-columns',
    'ajzaa_static_html_item_bg_color' => '#F8F8F8',
    'ajzaa_portfolio_thumbs' => '',
    'headings_title' => '',
    'itemperpage' => '',
    'number' => '',
    'padding_items' => '10',


    'portfolio_title_tag' => '',
    'portfolio_title_font_family' => '',
    'portfolio_title_font_size' => '',
    'portfolio_title_color' => '',
    'portfolio_title_font_weight' => '',
    'portfolio_title_text_transform' => '',
    'portfolio_title_line_height' => '',
    'portfolio_title_letter_spacing' => '',
    'portfolio_title_font_style' => '',
    'portfolio_items_to_show' => '9',
    'ajzaa_portfolio_link' => 'yes',
    'ajzaa_portfolio_view' => 'yes',

    'portfolio_tags_font_family' => '',
    'portfolio_tags_font_size' => '',
    'portfolio_tags_color' => '',
    'portfolio_tags_font_weight' => '',
    'portfolio_tags_text_transform' => '',
    'portfolio_tags_line_height' => '',
    'portfolio_tags_letter_spacing' => '',
    'portfolio_tags_font_style' => '',

    'filters_position' => 'center',
    'filters_font_family' => 'Montserrat',
    'filters_font_size' => '16',
    'filters_color' => '#999',
    'filters_hover_color' => '#000',
    'filters_font_weight' => '400',
    'filters_text_transform' => 'uppercase',
    'filters_line_height' => '26',
    'filters_letter_spacing' => '1',
    'filters_font_style' => 'normal',

    'css_animation' => 'no'
  ), $atts ) );

  ob_start();
  $animation_classes =  "";
      $data_animated = "";
  if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
}



  $ajzaa_static_html_item = rawurldecode( base64_decode( strip_tags( $ajzaa_static_html_item ) ) );

  
  if ($ajzaa_portfolio_layout == "carousel") {
      if ($portfolio_title_tag == ""){
        $portfolio_title_tag = "h2";
      }
      if ($portfolio_title_font_family == "") {
      $portfolio_title_font_family = 'Montserrat';
      }
      if ($portfolio_title_font_size == "") {
        $portfolio_title_font_size = '26';
      }
      if ($portfolio_title_color == "") {
        $portfolio_title_color = '#000';
      }
      if ($portfolio_title_font_weight == "") {
        $portfolio_title_font_weight = '700';
      }
  }

  if ($portfolio_title_tag == ""){
    $portfolio_title_tag = "h5";
  }
  if ($overlay_color == ""){
    $overlay_color = "#FFF";
  }
  if ($portfolio_tags_font_family == "") {
    $portfolio_tags_font_family = "Open Sans";
  }
  if ($portfolio_tags_font_size == "") {
    $portfolio_tags_font_size = "13";
  }
  if ($portfolio_tags_color == "") {
    $portfolio_tags_color = "#999999";
  }
  if ($portfolio_tags_font_weight == "") {
    $portfolio_tags_font_weight = "400";
  }
  if ($portfolio_title_font_family == "") {
    $portfolio_title_font_family = 'Montserrat';
  }
  if ($portfolio_title_font_size == "") {
    $portfolio_title_font_size = '16';
  }
  if ($portfolio_title_color == "") {
    $portfolio_title_color = '#999';
  }
  if ($ajzaa_portfolio_hover_style == "style-3") {
    $portfolio_title_color = '#fff';
  }
  if ($portfolio_title_font_weight == "") {
    $portfolio_title_font_weight = '700';
  }
  if ($portfolio_title_text_transform == "") {
    $portfolio_title_text_transform = 'uppercase';
  }
  if ($portfolio_title_line_height == "") {
    $portfolio_title_line_height = '24';
  }
  if ($portfolio_title_letter_spacing == "") {
    $portfolio_title_letter_spacing = '1';
  }
  if ($portfolio_title_font_style == "") {
    $portfolio_title_font_style = 'normal';
  }




    $ajzaa_font_family_portfolio_to_enqueue = "";
    // Portfolio Title inline style
    if($portfolio_title_font_family != '' && $portfolio_title_font_family != 'Default') {
      $custom_portfolio_title_inline_style .= 'font-family:'.esc_attr($portfolio_title_font_family).';';
      $ajzaa_font_family_portfolio_to_enqueue .= esc_attr($portfolio_title_font_family) . ":";
    }
    if($portfolio_title_font_size != '') {
      $custom_portfolio_title_inline_style .= 'font-size:'.esc_attr($portfolio_title_font_size).'px;';
    }
    if($portfolio_title_color != '') {
      $custom_portfolio_title_inline_style .= 'color:'.esc_attr($portfolio_title_color).';';
    }
    if($portfolio_title_font_weight != '' && $portfolio_title_font_family != '') {
      $custom_portfolio_title_inline_style .= 'font-weight:'.esc_attr($portfolio_title_font_weight).';';
      $ajzaa_font_family_portfolio_to_enqueue .= esc_attr($portfolio_title_font_weight) . "%7C";
    }
    if($portfolio_title_text_transform != '') {
      $custom_portfolio_title_inline_style .= 'text-transform:'.esc_attr($portfolio_title_text_transform).';';
    }
    if($portfolio_title_line_height != '') {
      $custom_portfolio_title_inline_style .= 'line-height:'.esc_attr($portfolio_title_line_height).'px;';
    }
    if($portfolio_title_letter_spacing != '') {
      $custom_portfolio_title_inline_style .= 'letter-spacing:'.esc_attr($portfolio_title_letter_spacing).'px;';
    }
    if($portfolio_title_font_style != '') {
      $custom_portfolio_title_inline_style .= 'font-style:'.esc_attr($portfolio_title_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_portfolio_to_enqueue);
    

    // Portfolio Tags inline style

    $ajzaa_font_family_portfolio_to_enqueue = "";

    if($portfolio_tags_font_family != '' && $portfolio_tags_font_family != 'Default') {
      $custom_portfolio_tags_inline_style .= 'font-family:'.esc_attr($portfolio_tags_font_family).';';
      $ajzaa_font_family_portfolio_to_enqueue .= esc_attr($portfolio_tags_font_family) . ":";
    }
    if($portfolio_tags_font_size != '') {
      $custom_portfolio_tags_inline_style .= 'font-size:'.esc_attr($portfolio_tags_font_size).'px;';
    }
    if($portfolio_tags_color != '') {
      $custom_portfolio_tags_inline_style .= 'color:'.esc_attr($portfolio_tags_color).';';
    }
    if($portfolio_tags_font_weight != '' && $portfolio_tags_font_family != '') {
      $custom_portfolio_tags_inline_style .= 'font-weight:'.esc_attr($portfolio_tags_font_weight).';';
      $ajzaa_font_family_portfolio_to_enqueue .= esc_attr($portfolio_tags_font_weight) . "%7C";
    }
    if($portfolio_tags_text_transform != '') {
      $custom_portfolio_tags_inline_style .= 'text-transform:'.esc_attr($portfolio_tags_text_transform).';';
    }
    if($portfolio_tags_line_height != '') {
      $custom_portfolio_tags_inline_style .= 'line-height:'.esc_attr($portfolio_tags_line_height).'px;';
    }
    if($portfolio_tags_letter_spacing != '') {
      $custom_portfolio_tags_inline_style .= 'letter-spacing:'.esc_attr($portfolio_tags_letter_spacing).'px;';
    }
    if($portfolio_tags_font_style != '') {
      $custom_portfolio_tags_inline_style .= 'font-style:'.esc_attr($portfolio_tags_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_portfolio_to_enqueue);

    

    // Filters Tags inline style
    $ajzaa_font_family_portfolio_to_enqueue = "";
    
    if($filters_font_family != '' && $portfolio_tags_font_family != 'Default') {
      $custom_filters_inline_style .= 'font-family:'.esc_attr($filters_font_family).';';
      $ajzaa_font_family_portfolio_to_enqueue .= esc_attr($filters_font_family) . ":";
    }
    if($filters_font_size != '') {
      $custom_filters_inline_style .= 'font-size:'.esc_attr($filters_font_size).'px;';
    }
    if($filters_color != '') {
      $custom_filters_inline_style .= 'color:'.esc_attr($filters_color).';';
    }
    if($filters_font_weight != '' && $filters_font_family != '') {
      $custom_filters_inline_style .= 'font-weight:'.esc_attr($filters_font_weight).';';
      $ajzaa_font_family_portfolio_to_enqueue .= esc_attr($filters_font_weight) . "%7C";
    }
    if($filters_text_transform != '') {
      $custom_filters_inline_style .= 'text-transform:'.esc_attr($filters_text_transform).';';
    }
    if($filters_line_height != '') {
      $custom_filters_inline_style .= 'line-height:'.esc_attr($filters_line_height).'px;';
    }
    if($filters_letter_spacing != '') {
      $custom_filters_inline_style .= 'letter-spacing:'.esc_attr($filters_letter_spacing).'px;';
    }
    if($filters_font_style != '') {
      $custom_filters_inline_style .= 'font-style:'.esc_attr($filters_font_style).';';
    }
    if ($padding_items == '') {
      $padding_items = '10';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_portfolio_to_enqueue);

    $ajzaa_category_array = explode(",", $ajzaa_portfolio_categories);

  ?>

<div class="wd-portfolio-container">
<?php if ($ajzaa_portfolio_layout != 'carousel'){ ?>
<?php if ($ajzaa_portfolio_filters == "yes"){ ?>
<?php if( count($ajzaa_category_array) > 1 ) { ?>
  <ul class="filters text-<?php echo esc_attr($filters_position);  ?>">
      <li><a href="#" class="current" data-hovercolor="<?php echo esc_attr($filters_hover_color); ?>" style="<?php echo esc_attr($custom_filters_inline_style); ?>" data-filter="*">All</a></li>
      <?php
      
      foreach ($ajzaa_category_array as $term) { ?>
        <li><a href="#" data-hovercolor="<?php echo esc_attr($filters_hover_color); ?>" class="<?php echo $term ?>" style="<?php echo esc_attr($custom_filters_inline_style); ?>" data-filter=".<?php
          $term_filter = str_replace(' ', '-', $term);
          echo $term_filter;
        ?>
        ">
        <?php echo $term; ?>
        </a></li>
      <?php } ?>
  </ul>
<?php } } } ?>


  <?php if ($ajzaa_portfolio_layout == 'grid'){
    include( plugin_dir_path( __FILE__ ).'portfolio/grid-portfolio.php' );
  } ?>


  <?php if ($ajzaa_portfolio_layout == 'masonry'){
    include( plugin_dir_path( __FILE__ ).'portfolio/masonry-portfolio.php' );
  } ?>


  <?php if ($ajzaa_portfolio_layout == 'free_style'){
    include( plugin_dir_path( __FILE__ ).'portfolio/free-style-portfolio.php' );
  } ?>
  <?php if ($ajzaa_portfolio_layout == 'carousel'){
    include( plugin_dir_path( __FILE__ ).'portfolio/carousel-portfolio.php' );
  } ?>
  <?php if ($ajzaa_portfolio_layout == 'custom_item'){ ?>

  <?php } ?>
</div>



  <?php


  return ob_get_clean();

}
add_shortcode( 'ajzaa_portfolio', 'ajzaa_portfolio' ); ?>