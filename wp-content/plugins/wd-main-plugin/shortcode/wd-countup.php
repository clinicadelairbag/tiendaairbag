<?php
if(!function_exists('ajzaa_count_up')){
  function ajzaa_count_up($atts) {
		global $ajzaa_fonts_to_enqueue_array;
    extract( shortcode_atts( array(
    //___________general_________
    
   
    
      'ajzaa_countup_alignment'  => 'left',
      "ajzaa_countup_layout"=> 'style1',
      //___________Title_________
     'ajzaa_countup_title'  => '',
     'ajzaa_countup_title_color'  => '',
     'ajzaa_countup_title_padding'  => '',
     'ajzaa_countup_title_font_family'  => '',
     'ajzaa_countup_title_font_weight'  => '',
     'ajzaa_countup_title_font_size'  => '',
     'ajzaa_countup_title_text_transform'  => '',
     'ajzaa_countup_title_line_height'  => '',
     'ajzaa_countup_title_letter_spacing'  => '',
      //___________Number_________
     'ajzaa_countup_number'  => '',
     'ajzaa_countup_number_padding'  => '',
     'ajzaa_countup_number_color'  => '',
     'ajzaa_countup_number_font_family'  => '',
     'ajzaa_countup_number_font_weight'  => '',
     'ajzaa_countup_number_font_size'  => '',
     'ajzaa_countup_number_text_transform'  => '',
     'ajzaa_countup_number_line_height'  => '',
     'ajzaa_countup_number_letter_spacing'  => '',
     //___________icon_________
     'ajzaa_countup_switch'  => '',
     'ajzaa_countup_image'  => '',
     'ajzaa_coundup_fontawesome'  => '',
     'ajzaa_countup_icon_padding'  => '',
     'ajzaa_countup_icon_color'  => '',
     'ajzaa_countup_icon_font_size'  => '',
      'css_animation' => 'no'
    ), $atts ) );


    $animation_classes =  "";
    $data_animated = "";
    
    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
}
	  //___________________ Title font Style _______________

	$ajzaa_font_family_countup_to_enqueue = "";

	$custom_title_inline_style = '';
		if($ajzaa_countup_title_font_family != '' && $ajzaa_countup_title_font_family != 'Default') {
			$custom_title_inline_style .= 'font-family:'.esc_attr($ajzaa_countup_title_font_family).';';
			$ajzaa_font_family_countup_to_enqueue .= esc_attr($ajzaa_countup_title_font_family) . ":";
		}
		if($ajzaa_countup_title_padding != '') {
			$custom_title_inline_style .= 'padding:'.esc_attr($ajzaa_countup_title_padding).';';
		}
		if($ajzaa_countup_title_color != '') {
			$custom_title_inline_style .= 'color:'.esc_attr($ajzaa_countup_title_color).';';
		}
		if($ajzaa_countup_title_font_weight != '' && $ajzaa_countup_title_font_family != '') {
			$custom_title_inline_style .= 'font-weight:'.esc_attr($ajzaa_countup_title_font_weight) . ';';
			$ajzaa_font_family_countup_to_enqueue .= esc_attr($ajzaa_countup_title_font_weight) . "%7C";
		}
		if($ajzaa_countup_title_font_size != '') {
			$custom_title_inline_style .= 'font-size:'.esc_attr($ajzaa_countup_title_font_size).'px;';
		}
		if($ajzaa_countup_title_text_transform != '') {
			$custom_title_inline_style .= 'text-transform:'.esc_attr($ajzaa_countup_title_text_transform).';';
		}
		if($ajzaa_countup_title_line_height != '') {
			$custom_title_inline_style .= 'line-height:'.esc_attr($ajzaa_countup_title_line_height).'px;';
		}
		if($ajzaa_countup_title_letter_spacing != '') {
			$custom_title_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_countup_title_letter_spacing).'px;';
		}

		$ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_countup_to_enqueue);


		$ajzaa_font_family_countup_to_enqueue = "";
	  //___________Number style_________
	  $custom_number_inline_style ='';
		if($ajzaa_countup_number_color != '') {
			$custom_number_inline_style .= 'color:'.esc_attr($ajzaa_countup_number_color).';';
		}
		if($ajzaa_countup_number_font_family != '' && $ajzaa_countup_number_font_family != 'Default') {
			$custom_number_inline_style .= 'font-family:'.esc_attr($ajzaa_countup_number_font_family).';';
			$ajzaa_font_family_countup_to_enqueue .= esc_attr($ajzaa_countup_number_font_family) . ":";
		}
		if($ajzaa_countup_number_font_weight != '' && $ajzaa_countup_number_font_family != '') {
			$custom_number_inline_style .= 'font-weight:'.esc_attr($ajzaa_countup_number_font_weight).';';
			$ajzaa_font_family_countup_to_enqueue .= esc_attr($ajzaa_countup_number_font_weight) . "%7C";
		}
		if($ajzaa_countup_number_font_size != '') {
			$custom_number_inline_style .= 'font-size:'.esc_attr($ajzaa_countup_number_font_size).'px;';
		}
		if($ajzaa_countup_number_text_transform != '') {
			$custom_number_inline_style .= 'text-transform:'.esc_attr($ajzaa_countup_number_text_transform).';';
		}
		if($ajzaa_countup_number_line_height != '') {
			$custom_number_inline_style .= 'line-height:'.esc_attr($ajzaa_countup_number_line_height).'px;';
		}
		if($ajzaa_countup_number_letter_spacing != '') {
			$custom_number_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_countup_number_letter_spacing).'px;';
		}
		if($ajzaa_countup_number_padding != '') {
			$custom_number_inline_style .= 'padding:'.esc_attr($ajzaa_countup_number_padding).';';
		}

		$ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_countup_to_enqueue);

    //_________________________Icon style ___________________________
		$custom_icon_inline_style ='';
		if($ajzaa_countup_icon_color != '') {
			$custom_icon_inline_style .= 'color:'.esc_attr($ajzaa_countup_icon_color).';';
		}
		if($ajzaa_countup_icon_font_size != '') {
			$custom_icon_inline_style .= 'font-size:'.esc_attr($ajzaa_countup_icon_font_size).'px;';
		}
		if($ajzaa_countup_icon_padding != '') {
			$custom_icon_inline_style .= 'padding:'.esc_attr($ajzaa_countup_icon_padding).';';
		}

    ob_start(); ?>
    
	<div class="<?php echo  esc_attr($animation_classes); ?> clearfix" style="text-align:<?php echo esc_attr($ajzaa_countup_alignment) ?>" <?php echo esc_attr($data_animated); ?>>
		
		<?php if($ajzaa_countup_layout == 'style1') {  ?>
			<?php if($ajzaa_countup_switch == 'ajzaa_countup_icon') { ?>
	    	<i class="fa fa-<?php echo esc_attr($ajzaa_coundup_fontawesome) ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>"></i>
	    	<?php }elseif($ajzaa_countup_switch == 'ajzaa_countup_image'){
	    		$ajzaa_image = wp_get_attachment_image_src( $ajzaa_countup_image, '150X150');
					?>
					<img src="<?php echo esc_url($ajzaa_image[0]) ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>" alt="icon">
					<?php
	    	} ?>
	    	<h5 style="<?php echo esc_attr($custom_number_inline_style) ?>" class="counter" data-file="<?php echo esc_attr($ajzaa_countup_number) ?>"><?php echo esc_attr($ajzaa_countup_number) ?> </h5>
	    	<h2 style="<?php echo esc_attr($custom_title_inline_style) ?>"><?php echo esc_attr($ajzaa_countup_title) ?></h2>
	    
    	<?php }elseif($ajzaa_countup_layout == 'style2'){ ?>
    		<h2 style="<?php echo esc_attr($custom_title_inline_style) ?>"><?php echo esc_attr($ajzaa_countup_title) ?></h2>
    		<?php if($ajzaa_countup_switch == 'ajzaa_countup_icon') { ?>
	    	<i class="fa fa-<?php echo esc_attr($ajzaa_coundup_fontawesome) ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>"></i>
	    	<?php }elseif($ajzaa_countup_switch == 'ajzaa_countup_image'){
	    		$ajzaa_image = wp_get_attachment_image_src( $ajzaa_countup_image, '150X150');
					?>
					<img src="<?php echo esc_url($ajzaa_image[0]) ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>" alt="icon">
					<?php
	    	} ?>
	    	<h5 style="<?php echo esc_attr($custom_number_inline_style) ?>" class="counter" data-file="<?php echo esc_attr($ajzaa_countup_number) ?>"><?php echo esc_attr($ajzaa_countup_number) ?> </h5>
	    	
		
    	<?php }else{ ?>
    		<h5 style="<?php echo esc_attr($custom_number_inline_style) ?>" class="counter" data-file="<?php echo esc_attr($ajzaa_countup_number) ?>"><?php echo esc_attr($ajzaa_countup_number) ?> </h5>
    		<?php if($ajzaa_countup_switch == 'ajzaa_countup_icon') { ?>
	    	<i class="fa fa-<?php echo esc_attr($ajzaa_coundup_fontawesome) ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>"></i>
	    	<?php }elseif($ajzaa_countup_switch == 'ajzaa_countup_image'){
	    		$ajzaa_image = wp_get_attachment_image_src( $ajzaa_countup_image, '150X150');
					?>
					<img src="<?php echo esc_url($ajzaa_image[0]) ?>" style="<?php echo esc_attr($custom_icon_inline_style) ?>" alt="icon">
					<?php
	    	} ?>
	    	
	    	<h2 style="<?php echo esc_attr($custom_title_inline_style) ?>"><?php echo esc_attr($ajzaa_countup_title) ?></h2>
			
    	<?php } ?>
    	
    </div>

    <?php return ob_get_clean();
  }
  add_shortcode( 'ajzaa_count_up', 'ajzaa_count_up' );
}  
?>