<?php
if(!function_exists('ajzaa_pricing_table')){
  function ajzaa_pricing_table($atts) {
    global $ajzaa_fonts_to_enqueue_array;
    $ajzaa_custom_pricing_title_inline_style = $ajzaa_custom_pricing_price_inline_style = $ajzaa_custom_pricing_per_inline_style = $ajzaa_custom_pricing_description_inline_style = $ajzaa_custom_pricing_list_inline_style = $ajzaa_custom_pricing_button_inline_style = "";
    extract( shortcode_atts( array(
      'title' => 'Standard',
      'values' => '',
      'sub_title' => 'An awesome description',
      'price' => '$99.99',
      'image' => '',
      'per' => 'Month',
      'featured' => '',
      'button_text' => 'Buy Now',
      'button_link' => '#',
      'css_animation' => 'no',


      'ajzaa_pricing_title_font_family' => 'Open Sans',
      'ajzaa_pricing_title_font_size' => '18',
      'ajzaa_pricing_title_color' => '#c90',
      'ajzaa_pricing_title_font_weight' => '700',
      'ajzaa_pricing_title_text_transform' => 'uppercase',
      'ajzaa_pricing_title_line_height' => 'initial',
      'ajzaa_pricing_title_letter_spacing' => '0',
      'ajzaa_pricing_title_font_style' => 'normal',

      'ajzaa_pricing_price_font_family' => 'Montserrat',
      'ajzaa_pricing_price_font_size' => '40',
      'ajzaa_pricing_price_color' => '#333333',
      'ajzaa_pricing_price_font_weight' => '700',
      'ajzaa_pricing_price_text_transform' => 'uppercase',
      'ajzaa_pricing_price_line_height' => '50',
      'ajzaa_pricing_price_letter_spacing' => '0',
      'ajzaa_pricing_price_font_style' => 'normal',

      'ajzaa_pricing_per_font_family' => 'Montserrat',
      'ajzaa_pricing_per_font_size' => '20',
      'ajzaa_pricing_per_color' => '#333333',
      'ajzaa_pricing_per_font_weight' => '700',
      'ajzaa_pricing_per_text_transform' => 'none',
      'ajzaa_pricing_per_line_height' => '',
      'ajzaa_pricing_per_letter_spacing' => '',
      'ajzaa_pricing_per_font_style' => 'normal',

      'ajzaa_pricing_description_font_family' => 'Open Sans',
      'ajzaa_pricing_description_font_size' => '14',
      'ajzaa_pricing_description_color' => '#999999',
      'ajzaa_pricing_description_font_weight' => '400',
      'ajzaa_pricing_description_text_transform' => '#999999',
      'ajzaa_pricing_description_line_height' => '24',
      'ajzaa_pricing_description_letter_spacing' => '',
      'ajzaa_pricing_description_font_style' => 'normal',

      'ajzaa_pricing_list_font_family' => 'Open Sans',
      'ajzaa_pricing_list_font_size' => '14',
      'ajzaa_pricing_list_color' => '#333333',
      'ajzaa_pricing_list_font_weight' => '400',
      'ajzaa_pricing_list_text_transform' => '',
      'ajzaa_pricing_list_line_height' => '',
      'ajzaa_pricing_list_letter_spacing' => '0.35',
      'ajzaa_pricing_list_font_style' => '',

      'ajzaa_pricing_button_font_family' => 'Montserrat',
      'ajzaa_pricing_button_font_size' => '14',
      'ajzaa_pricing_button_color' => '#666666',
      'ajzaa_pricing_button_font_weight' => '700',
      'ajzaa_pricing_button_text_transform' => 'uppercase',
      'ajzaa_pricing_button_line_height' => '0',
      'ajzaa_pricing_button_letter_spacing' => '0.35',
      'ajzaa_pricing_button_font_style' => '',




    ), $atts ) );

    ob_start(); ?>
    <?php
    $animation_classes =  "";
    $data_animated = "";
    
    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
    }


    $values = (array) vc_param_group_parse_atts( $values );

    $graph_lines_data = array();
    foreach ( $values as $data ) {
      $new_line = $data;
      $new_line['text'] = isset( $data['text'] ) ? $data['text'] : '1 Database';
      
      $graph_lines_data[] = $new_line;
    }





    $ajzaa_font_family_pricing_to_enqueue = "";
    // pricing Title inline style
    if($ajzaa_pricing_title_font_family != '') {
      $ajzaa_custom_pricing_title_inline_style .= 'font-family:'.esc_attr($ajzaa_pricing_title_font_family).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_title_font_family) . ":";
    }
    if($ajzaa_pricing_title_font_size != '') {
      $ajzaa_custom_pricing_title_inline_style .= 'font-size:'.esc_attr($ajzaa_pricing_title_font_size).'px;';
    }
    if($ajzaa_pricing_title_color != '') {
      $ajzaa_custom_pricing_title_inline_style .= 'color:'.esc_attr($ajzaa_pricing_title_color).';';
    }
    if($ajzaa_pricing_title_font_weight != '' && $ajzaa_pricing_title_font_family != '') {
      $ajzaa_custom_pricing_title_inline_style .= 'font-weight:'.esc_attr($ajzaa_pricing_title_font_weight).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_title_font_weight) . "%7C";
    }
    if($ajzaa_pricing_title_text_transform != '') {
      $ajzaa_custom_pricing_title_inline_style .= 'text-transform:'.esc_attr($ajzaa_pricing_title_text_transform).';';
    }
    if($ajzaa_pricing_title_line_height != '') {
      $ajzaa_custom_pricing_title_inline_style .= 'line-height:'.esc_attr($ajzaa_pricing_title_line_height).'px;';
    }
    if($ajzaa_pricing_title_letter_spacing != '') {
      $ajzaa_custom_pricing_title_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_pricing_title_letter_spacing).'px;';
    }
    if($ajzaa_pricing_title_font_style != '') {
      $ajzaa_custom_pricing_title_inline_style .= 'font-style:'.esc_attr($ajzaa_pricing_title_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_pricing_to_enqueue);



    $ajzaa_font_family_pricing_to_enqueue = "";
    // pricing price inline style
    if($ajzaa_pricing_price_font_family != '') {
      $ajzaa_custom_pricing_price_inline_style .= 'font-family:'.esc_attr($ajzaa_pricing_price_font_family).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_price_font_family) . ":";
    }
    if($ajzaa_pricing_price_font_size != '') {
      $ajzaa_custom_pricing_price_inline_style .= 'font-size:'.esc_attr($ajzaa_pricing_price_font_size).'px;';
    }
    if($ajzaa_pricing_price_color != '') {
      $ajzaa_custom_pricing_price_inline_style .= 'color:'.esc_attr($ajzaa_pricing_price_color).';';
    }
    if($ajzaa_pricing_price_font_weight != '' && $ajzaa_pricing_price_font_family != '') {
      $ajzaa_custom_pricing_price_inline_style .= 'font-weight:'.esc_attr($ajzaa_pricing_price_font_weight).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_price_font_weight) . "%7C";
    }
    if($ajzaa_pricing_price_text_transform != '') {
      $ajzaa_custom_pricing_price_inline_style .= 'text-transform:'.esc_attr($ajzaa_pricing_price_text_transform).';';
    }
    if($ajzaa_pricing_price_line_height != '') {
      $ajzaa_custom_pricing_price_inline_style .= 'line-height:'.esc_attr($ajzaa_pricing_price_line_height).'px;';
    }
    if($ajzaa_pricing_price_letter_spacing != '') {
      $ajzaa_custom_pricing_price_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_pricing_price_letter_spacing).'px;';
    }
    if($ajzaa_pricing_price_font_style != '') {
      $ajzaa_custom_pricing_price_inline_style .= 'font-style:'.esc_attr($ajzaa_pricing_price_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_pricing_to_enqueue);




    $ajzaa_font_family_pricing_to_enqueue = "";
    // pricing per inline style
    if($ajzaa_pricing_per_font_family != '') {
      $ajzaa_custom_pricing_per_inline_style .= 'font-family:'.esc_attr($ajzaa_pricing_per_font_family).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_per_font_family) . ":";
    }
    if($ajzaa_pricing_per_font_size != '') {
      $ajzaa_custom_pricing_per_inline_style .= 'font-size:'.esc_attr($ajzaa_pricing_per_font_size).'px;';
    }
    if($ajzaa_pricing_per_color != '') {
      $ajzaa_custom_pricing_per_inline_style .= 'color:'.esc_attr($ajzaa_pricing_per_color).';';
    }
    if($ajzaa_pricing_per_font_weight != '' && $ajzaa_pricing_per_font_family != '') {
      $ajzaa_custom_pricing_per_inline_style .= 'font-weight:'.esc_attr($ajzaa_pricing_per_font_weight).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_per_font_weight) . "%7C";
    }
    if($ajzaa_pricing_per_text_transform != '') {
      $ajzaa_custom_pricing_per_inline_style .= 'text-transform:'.esc_attr($ajzaa_pricing_per_text_transform).';';
    }
    if($ajzaa_pricing_per_line_height != '') {
      $ajzaa_custom_pricing_per_inline_style .= 'line-height:'.esc_attr($ajzaa_pricing_per_line_height).'px;';
    }
    if($ajzaa_pricing_per_letter_spacing != '') {
      $ajzaa_custom_pricing_per_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_pricing_per_letter_spacing).'px;';
    }
    if($ajzaa_pricing_per_font_style != '') {
      $ajzaa_custom_pricing_per_inline_style .= 'font-style:'.esc_attr($ajzaa_pricing_per_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_pricing_to_enqueue);


    $ajzaa_font_family_pricing_to_enqueue = "";
    // pricing description inline style
    if($ajzaa_pricing_description_font_family != '') {
      $ajzaa_custom_pricing_description_inline_style .= 'font-family:'.esc_attr($ajzaa_pricing_description_font_family).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_description_font_family) . ":";
    }
    if($ajzaa_pricing_description_font_size != '') {
      $ajzaa_custom_pricing_description_inline_style .= 'font-size:'.esc_attr($ajzaa_pricing_description_font_size).'px;';
    }
    if($ajzaa_pricing_description_color != '') {
      $ajzaa_custom_pricing_description_inline_style .= 'color:'.esc_attr($ajzaa_pricing_description_color).';';
    }
    if($ajzaa_pricing_description_font_weight != '' && $ajzaa_pricing_description_font_family != '') {
      $ajzaa_custom_pricing_description_inline_style .= 'font-weight:'.esc_attr($ajzaa_pricing_description_font_weight).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_description_font_weight) . "%7C";
    }
    if($ajzaa_pricing_description_text_transform != '') {
      $ajzaa_custom_pricing_description_inline_style .= 'text-transform:'.esc_attr($ajzaa_pricing_description_text_transform).';';
    }
    if($ajzaa_pricing_description_line_height != '') {
      $ajzaa_custom_pricing_description_inline_style .= 'line-height:'.esc_attr($ajzaa_pricing_description_line_height).'px;';
    }
    if($ajzaa_pricing_description_letter_spacing != '') {
      $ajzaa_custom_pricing_description_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_pricing_description_letter_spacing).'px;';
    }
    if($ajzaa_pricing_description_font_style != '') {
      $ajzaa_custom_pricing_description_inline_style .= 'font-style:'.esc_attr($ajzaa_pricing_description_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_pricing_to_enqueue);


    $ajzaa_font_family_pricing_to_enqueue = "";
    // pricing List inline style
    if($ajzaa_pricing_list_font_family != '') {
      $ajzaa_custom_pricing_list_inline_style .= 'font-family:'.esc_attr($ajzaa_pricing_list_font_family).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_list_font_family) . ":";
    }
    if($ajzaa_pricing_list_font_size != '') {
      $ajzaa_custom_pricing_list_inline_style .= 'font-size:'.esc_attr($ajzaa_pricing_list_font_size).'px;';
    }
    if($ajzaa_pricing_list_color != '') {
      $ajzaa_custom_pricing_list_inline_style .= 'color:'.esc_attr($ajzaa_pricing_list_color).';';
    }
    if($ajzaa_pricing_list_font_weight != '' && $ajzaa_pricing_list_font_family != '') {
      $ajzaa_custom_pricing_list_inline_style .= 'font-weight:'.esc_attr($ajzaa_pricing_list_font_weight).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_list_font_weight) . "%7C";
    }
    if($ajzaa_pricing_list_text_transform != '') {
      $ajzaa_custom_pricing_list_inline_style .= 'text-transform:'.esc_attr($ajzaa_pricing_list_text_transform).';';
    }
    if($ajzaa_pricing_list_line_height != '') {
      $ajzaa_custom_pricing_list_inline_style .= 'line-height:'.esc_attr($ajzaa_pricing_list_line_height).'px;';
    }
    if($ajzaa_pricing_list_letter_spacing != '') {
      $ajzaa_custom_pricing_list_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_pricing_list_letter_spacing).'px;';
    }
    if($ajzaa_pricing_list_font_style != '') {
      $ajzaa_custom_pricing_list_inline_style .= 'font-style:'.esc_attr($ajzaa_pricing_list_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_pricing_to_enqueue);


    $ajzaa_font_family_pricing_to_enqueue = "";
    // pricing Button inline style
    if($ajzaa_pricing_button_font_family != '') {
      $ajzaa_custom_pricing_button_inline_style .= 'font-family:'.esc_attr($ajzaa_pricing_button_font_family).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_button_font_family) . ":";
    }
    if($ajzaa_pricing_button_font_size != '') {
      $ajzaa_custom_pricing_button_inline_style .= 'font-size:'.esc_attr($ajzaa_pricing_button_font_size).'px;';
    }
    if($ajzaa_pricing_button_color != '') {
      $ajzaa_custom_pricing_button_inline_style .= 'color:'.esc_attr($ajzaa_pricing_button_color).';';
    }
    if($ajzaa_pricing_button_font_weight != '' && $ajzaa_pricing_button_font_family != '') {
      $ajzaa_custom_pricing_button_inline_style .= 'font-weight:'.esc_attr($ajzaa_pricing_button_font_weight).';';
      $ajzaa_font_family_pricing_to_enqueue .= esc_attr($ajzaa_pricing_button_font_weight) . "%7C";
    }
    if($ajzaa_pricing_button_text_transform != '') {
      $ajzaa_custom_pricing_button_inline_style .= 'text-transform:'.esc_attr($ajzaa_pricing_button_text_transform).';';
    }
    if($ajzaa_pricing_button_line_height != '') {
      $ajzaa_custom_pricing_button_inline_style .= 'line-height:'.esc_attr($ajzaa_pricing_button_line_height).'px;';
    }
    if($ajzaa_pricing_button_letter_spacing != '') {
      $ajzaa_custom_pricing_button_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_pricing_button_letter_spacing).'px;';
    }
    if($ajzaa_pricing_button_font_style != '') {
      $ajzaa_custom_pricing_button_inline_style .= 'font-style:'.esc_attr($ajzaa_pricing_button_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_pricing_to_enqueue);




?>

  <div class="pricing-table <?php if ($featured == true) {echo "featured";} ?> <?php echo  esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
    <?php 
    $img_id = preg_replace( '/[^\d]/', '', $image );
    $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'full_size' => 'full','thumb_size' => 'thumbnail') );

    $img_path = $img['p_img_large'][0];
    $image = ajzaa_resize( $img_path, 218, 185, true, true, true );
     ?>
     <?php if ($img_id == "") { ?>
     <?php } else { ?>
        <div class="pricing-table-img">
         <img src="<?php echo $image; ?>" alt="">
        </div>
      <?php } ?>
    <div class="title" style="<?php echo esc_attr($ajzaa_custom_pricing_title_inline_style); ?>"><?php echo esc_attr($title); ?></div>
    <div class="price" style="<?php echo esc_attr($ajzaa_custom_pricing_price_inline_style); ?>"><?php echo esc_attr($price) ?><span style="<?php echo esc_attr($ajzaa_custom_pricing_per_inline_style); ?>"><?php echo "/" . $per ?></span></div>
    <div class="description" style="<?php echo esc_attr($ajzaa_custom_pricing_description_inline_style); ?>"><?php echo $sub_title; ?></div>
    <ul>
    <?php
      foreach ( $graph_lines_data as $line ) {
        $line_value =  $line['text'];
      ?>
      <li class="bullet-item" style="<?php echo esc_attr($ajzaa_custom_pricing_list_inline_style); ?>"><i class="ion-ios-checkmark-empty"></i><?php echo esc_attr($line_value) ?></li>
    <?php
    } ?>
    </ul>
    <div class="cta-button"><a style="<?php echo esc_attr($ajzaa_custom_pricing_button_inline_style); ?>" href="<?php echo esc_attr($button_link) ?>" class="button"><?php echo esc_attr($button_text) ?><i class="ion-ios-arrow-thin-right"></i></a></div>
  </div>


    <?php return ob_get_clean();
  }
  add_shortcode( 'ajzaa_pricing_table', 'ajzaa_pricing_table' );
}
?>