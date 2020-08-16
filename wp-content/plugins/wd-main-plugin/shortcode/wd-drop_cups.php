<?php
if(!function_exists('ajzaa_drop_cups')){
  function ajzaa_drop_cups($atts) {
		global $ajzaa_fonts_to_enqueue_array;
    extract( shortcode_atts( array(

    
   
    
      'ajzaa_drop_cups_first_lettre'  => '',
      'ajzaa_drop_cups_paragraph' => '',
      'ajzaa_drop_cups_alignment' => '',
      'ajzaa_drop_cups_first_lettre_padding' => '20px',
      'ajzaa_drop_cups_first_lettre_background_color' => '#cd9a00',
      'ajzaa_drop_cups_first_lettre_margin' => '0 12px 0 0',
      'ajzaa_drop_cups_first_lettre_border_width' => '',
      'ajzaa_drop_cups_first_lettre_border_color' => '',
      'ajzaa_drop_cups_first_lettre_border_style' => '',
      'ajzaa_drop_cups_first_lettre_border_radius' => '',

      'ajzaa_drop_cups_first_lettre_font_familly' => 'Playfair Display',
      'ajzaa_drop_cups_first_lettre_font_size' => '33',
      'ajzaa_drop_cups_first_lettre_color' => '#fff',
      'ajzaa_drop_cups_first_lettre_font_weight' => '700',
      'ajzaa_drop_cups_first_lettre_text_transform' => 'uppercase',
      'ajzaa_drop_cups_first_lettre_line_height' => '',
      'ajzaa_drop_cups_first_lettre_font_style' => 'normal',

      'ajzaa_drop_cups_paragraph_font_familly' => '',
      'ajzaa_drop_cups_paragraph_font_size' => '',
      'ajzaa_drop_cups_paragraph_color' => '',
      'ajzaa_drop_cups_paragraph_font_weight' => '',
      'ajzaa_drop_cups_paragraph_text_transform' => '',
      'ajzaa_drop_cups_paragraph_line_height' => '',
      'ajzaa_drop_cups_paragraph_font_style' => '',
      'ajzaa_drop_cups_paragraph_letter_spacing' => '',



      
      'css_animation' => 'no'
    ), $atts ) );


    $animation_classes =  "";
    $data_animated = "";
    
    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
}
	  //___________________ Title font Style _______________

	$ajzaa_font_family_drop_cups_to_enqueue = "";

	$custom_drop_cups_first_lettre_inline_style = '';
		if($ajzaa_drop_cups_first_lettre_font_familly != '' && $ajzaa_drop_cups_first_lettre_font_familly != 'Default') {
			$custom_drop_cups_first_lettre_inline_style .= 'font-family:'.esc_attr($ajzaa_drop_cups_first_lettre_font_familly).';';
			$ajzaa_font_family_drop_cups_to_enqueue .= esc_attr($ajzaa_drop_cups_first_lettre_font_familly) . ":";
		}
		if($ajzaa_drop_cups_first_lettre_padding != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'padding:'.esc_attr($ajzaa_drop_cups_first_lettre_padding).';';
		}

		if($ajzaa_drop_cups_alignment == 'right') {
			$custom_drop_cups_first_lettre_inline_style .= 'float: right;';
		}
		if($ajzaa_drop_cups_first_lettre_background_color != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'background-color:'.esc_attr($ajzaa_drop_cups_first_lettre_background_color).';';
		}
		if($ajzaa_drop_cups_first_lettre_margin != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'margin:'.esc_attr($ajzaa_drop_cups_first_lettre_margin).';';
		}
		if($ajzaa_drop_cups_first_lettre_border_width != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'border-width:'.esc_attr($ajzaa_drop_cups_first_lettre_border_width).'px;';
		}
		if($ajzaa_drop_cups_first_lettre_border_color != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'border-color:'.esc_attr($ajzaa_drop_cups_first_lettre_border_color).';';
		}
		if($ajzaa_drop_cups_first_lettre_border_style != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'border-style:'.esc_attr($ajzaa_drop_cups_first_lettre_border_style).';';
		}
		if($ajzaa_drop_cups_first_lettre_border_radius != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'border-radius:'.esc_attr($ajzaa_drop_cups_first_lettre_border_radius).';';
		}

		if($ajzaa_drop_cups_first_lettre_color != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'color:'.esc_attr($ajzaa_drop_cups_first_lettre_color).';';
		}
		if($ajzaa_drop_cups_first_lettre_font_weight != '' && $ajzaa_drop_cups_first_lettre_font_familly != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'font-weight:'.esc_attr($ajzaa_drop_cups_first_lettre_font_weight) . ';';
			$ajzaa_font_family_drop_cups_to_enqueue .= esc_attr($ajzaa_drop_cups_first_lettre_font_weight) . "%7C";
		}
		if($ajzaa_drop_cups_first_lettre_font_size != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'font-size:'.esc_attr($ajzaa_drop_cups_first_lettre_font_size).'px;';
		}
		if($ajzaa_drop_cups_first_lettre_text_transform != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'text-transform:'.esc_attr($ajzaa_drop_cups_first_lettre_text_transform).';';
		}
		if($ajzaa_drop_cups_first_lettre_line_height != '') {
			$custom_drop_cups_first_lettre_inline_style .= 'line-height:'.esc_attr($ajzaa_drop_cups_first_lettre_line_height).'px;';
		}

		$ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_drop_cups_to_enqueue);



		//___________________ Title font Style _______________

		$ajzaa_font_family_drop_cups_to_enqueue = "";

		$custom_drop_cups_paragraph_inline_style = '';
		if($ajzaa_drop_cups_paragraph_font_familly != '' && $ajzaa_drop_cups_paragraph_font_familly != 'Default') {
			$custom_drop_cups_paragraph_inline_style .= 'font-family:'.esc_attr($ajzaa_drop_cups_paragraph_font_familly).';';
			$ajzaa_font_family_drop_cups_to_enqueue .= esc_attr($ajzaa_drop_cups_paragraph_font_familly) . ":";
		}
		if($ajzaa_drop_cups_paragraph_color != '') {
			$custom_drop_cups_paragraph_inline_style .= 'color:'.esc_attr($ajzaa_drop_cups_paragraph_color).';';
		}
		if($ajzaa_drop_cups_paragraph_font_weight != '' && $ajzaa_drop_cups_paragraph_font_familly != '') {
			$custom_drop_cups_paragraph_inline_style .= 'font-weight:'.esc_attr($ajzaa_drop_cups_paragraph_font_weight) . ';';
			$ajzaa_font_family_drop_cups_to_enqueue .= esc_attr($ajzaa_drop_cups_paragraph_font_weight) . "%7C";
		}
		if($ajzaa_drop_cups_paragraph_font_size != '') {
			$custom_drop_cups_paragraph_inline_style .= 'font-size:'.esc_attr($ajzaa_drop_cups_paragraph_font_size).'px;';
		}
		if($ajzaa_drop_cups_paragraph_text_transform != '') {
			$custom_drop_cups_paragraph_inline_style .= 'text-transform:'.esc_attr($ajzaa_drop_cups_paragraph_text_transform).';';
		}
		if($ajzaa_drop_cups_paragraph_line_height != '') {
			$custom_drop_cups_paragraph_inline_style .= 'line-height:'.esc_attr($ajzaa_drop_cups_paragraph_line_height).'px;';
		}
		if($ajzaa_drop_cups_paragraph_letter_spacing != '') {
			$custom_drop_cups_paragraph_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_drop_cups_paragraph_letter_spacing).'px;';
		}

		$ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_drop_cups_to_enqueue);
	  
	  
		$ajzaa_drop_cups_paragraph = rawurldecode( base64_decode( strip_tags( $ajzaa_drop_cups_paragraph ) ) );

    ob_start(); ?>
    
	<div class="<?php echo  esc_attr($animation_classes); ?> clearfix" style="text-align:<?php echo esc_attr($ajzaa_drop_cups_alignment) ?>" <?php echo esc_attr($data_animated); ?>>
		<p style="<?php echo esc_attr($custom_drop_cups_paragraph_inline_style); ?>">
			<span class="wd_firstcharacter" style="<?php echo esc_attr($custom_drop_cups_first_lettre_inline_style); ?>">L</span> <?php echo esc_attr($ajzaa_drop_cups_paragraph); ?>
		</p>
  </div>

    <?php return ob_get_clean();
  }
  add_shortcode( 'ajzaa_drop_cups', 'ajzaa_drop_cups' );
}  
?>