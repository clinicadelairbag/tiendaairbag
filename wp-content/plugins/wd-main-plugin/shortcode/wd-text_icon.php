<?php
if(!function_exists('ajzaa_text_icon')){
  function ajzaa_text_icon($atts) {
    global $ajzaa_fonts_to_enqueue_array;
    extract( shortcode_atts( array(
    //__________General___________
      'box_alignment' => 'left',
      'box_style' => '',
      'box_contenttitle_padding' => '',
      'box_link_apply' => '',
      'box_extra_class_name' => '',
      'box_show_subtitle' => '',
      'box_hover_style' => 'none',
      'ajzaa_switch_title_subtitle' => 'true',
      'box_background_image' => '',
      'box_background_color' => '',
      'box_hover_background_color' => '',
    //__________Title___________  
      'box_title' => 'Block title',
      'box_title_balises' => 'h2',
      'box_title_padding' => '0px',
      'box_title_color' => '#eee',
      'ajzaa_title_letter_spacing' => '',
      'ajzaa_title_font_family' => '',
      'ajzaa_title_font_weight' => '',
      'ajzaa_title_font_size' => '',
      'ajzaa_title_text_transform' => '',
      'ajzaa_title_line_height' => '',
      'ajzaa_title_letter_spacing' => '',
      //_______separator___________
      'box_title_separator_color' => '',
      'box_title_separator_height' => '',
      'box_title_separator_width' => '',
    //__________SubTitle___________  
      'box_subtitle' => '',
      'box_subtitle_padding' => '0px',
      'box_subtitle_color' => '#eee',
      'ajzaa_subtitle_font_family' => '',
      'ajzaa_subtitle_font_weight' => '',
      'ajzaa_subtitle_font_size' => '',
      'ajzaa_subtitle_text_transform' => '',
      'ajzaa_subtitle_line_height' => '',
      'ajzaa_subtitle_letter_spacing' => '',
     //__________Content___________  
      'box_content' => 'Block title',
      'box_content_padding' => '0px',
      'box_content_color' => '#eee',
      'ajzaa_content_font_family' => '',
      'ajzaa_content_font_weight' => '',
      'ajzaa_content_font_size' => '',
      'ajzaa_content_text_transform' => '',
      'ajzaa_content_line_height' => '',
      'ajzaa_content_letter_spacing' => '',
      //__________Icon___________
      'ajzaa_icon_fontawesome' => '',
      'box_icon_color' => '#eee',
      'ajzaa_switch' => '',
      'ajzaa_source_image' => '',
      'ajzaa_size_image' => '',
      'box_icon_padding' => '0px',
      'ajzaa_icon_font_size' => '',
      'box_icon_margin' => '',
      'box_icon_border_style' => '',
      'box_icon_background_color' => '',
      'box_icon_border_color' => '',
      'box_icon_border_width' => '',
      'box_icon_border_radius' => '',
      	
      //__________Link___________
      	'box_link_apply' => '',
      	'box_link' => '',
      	'box_read_more' => 'Block title',
      	'box_read_more_class' => 'button',
      	//___________animation___________
      	'css_animation' => 'no'
     
    ), $atts ) );


	$box_title = str_replace("{","<span>", $box_title);
	$box_title = str_replace("}","</span>", $box_title);

	$box_title = str_replace("/n","<br/>", $box_title);
	//$box_content =str_replace("/n","<br/>", $box_content);

	$ajzaa_custom_box_icon_background_inline_style = '';
	if($box_background_image != '') {
		$box_background_image = wp_get_attachment_image_src($box_background_image , 'full');
		$ajzaa_custom_box_icon_background_inline_style .= 'background : url('. $box_background_image[0] .');';
	}
	if($box_background_color != ''){
		$ajzaa_custom_box_icon_background_inline_style .= 'background : '.esc_attr($box_background_color).';';
	}
	
	//______________ block alignment ______________
	$ajzaa_custom_box_icon_position_inline_style = '';
	$ajzaa_custom_box_icon_position_padding_inline_style =  ($box_contenttitle_padding != "") ? 'padding:'. $box_contenttitle_padding  : "";
	if($box_style == 'style2') {
		$ajzaa_custom_box_icon_position_inline_style .= 'position:absolute;left:15px;';
	}elseif($box_style == 'style3'){
		$ajzaa_custom_box_icon_position_inline_style .= 'position:absolute;right:15px;';
	}
		$ajzaa_custom_box_hover = '';
	if($box_hover_style != 'none') {
			$ajzaa_custom_box_hover = esc_attr($box_hover_style);
		}
	//______________ block alignment ______________
	$ajzaa_custom_box_inline_style='';
		if($box_alignment != '') {
			$ajzaa_custom_box_inline_style .= 'text-align:'.esc_attr($box_alignment).';';
		}
	//___________________ Title font Style _______________
	$ajzaa_custom_title_inline_style = '';
	if($box_title_balises != '') {
			$ajzaa_custom_title_balise = esc_attr($box_title_balises);
		}
		
		$ajzaa_font_family_text_icon_to_enqueue = "";

		if($ajzaa_title_font_family != '') {
			$ajzaa_custom_title_inline_style .= 'font-family:'.esc_attr($ajzaa_title_font_family).';';
			$ajzaa_font_family_text_icon_to_enqueue .= esc_attr($ajzaa_title_font_family) . ":";
		}
		if($box_title_padding != '') {
			$ajzaa_custom_title_inline_style .= 'padding:'.esc_attr($box_title_padding).';';
		}
		if($box_title_color != '') {
			$ajzaa_custom_title_inline_style .= 'color:'.esc_attr($box_title_color).';';
		}
		if($ajzaa_title_font_weight != '') {
			$ajzaa_custom_title_inline_style .= 'font-weight:'.esc_attr($ajzaa_title_font_weight).';';
			$ajzaa_font_family_text_icon_to_enqueue .= esc_attr($ajzaa_title_font_weight) . "%7C";
		}
		if($ajzaa_title_font_size != '') {
			$ajzaa_custom_title_inline_style .= 'font-size:'.esc_attr($ajzaa_title_font_size).'px;';
		}
		if($ajzaa_title_text_transform != '') {
			$ajzaa_custom_title_inline_style .= 'text-transform:'.esc_attr($ajzaa_title_text_transform).';';
		}
		if($ajzaa_title_line_height != '') {
			$ajzaa_custom_title_inline_style .= 'line-height:'.esc_attr($ajzaa_title_line_height).'px;';
		}
		if($ajzaa_title_letter_spacing != '') {
			$ajzaa_custom_title_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_title_letter_spacing).'px;';
		}


		$ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_text_icon_to_enqueue);
		
	//___________________separator____________________________________
		$ajzaa_custom_title_separator_inline_style = '';
		if($box_title_separator_color != '') {
			$ajzaa_custom_title_separator_inline_style .= 'background:'.esc_attr($box_title_separator_color).';';
		}
		if($box_title_separator_width != '') {
			$ajzaa_custom_title_separator_inline_style .= 'width:'.esc_attr($box_title_separator_width).';';
		}
		if($box_title_separator_height != '') {
			$ajzaa_custom_title_separator_inline_style .= 'height:'.esc_attr($box_title_separator_height).';';
		}	
	//___________________ SubTitle font Style _______________	

	$ajzaa_font_family_text_icon_to_enqueue = "";

	$ajzaa_custom_subtitle_inline_style = '';
		if($ajzaa_subtitle_font_family != '') {
			$ajzaa_custom_subtitle_inline_style .= 'font-family:'.esc_attr($ajzaa_subtitle_font_family).';';
			$ajzaa_font_family_text_icon_to_enqueue .= esc_attr($ajzaa_subtitle_font_family) . ":";
		}
		if($box_subtitle_padding != '') {
			$ajzaa_custom_subtitle_inline_style .= 'padding:'.esc_attr($box_subtitle_padding).';';
		}
		if($box_subtitle_color != '') {
			$ajzaa_custom_subtitle_inline_style .= 'color:'.esc_attr($box_subtitle_color).';';
		}
		if($ajzaa_subtitle_font_weight != '' && $ajzaa_subtitle_font_family != '') {
			$ajzaa_custom_subtitle_inline_style .= 'font-weight:'.esc_attr($ajzaa_subtitle_font_weight).';';
			$ajzaa_font_family_text_icon_to_enqueue .= esc_attr($ajzaa_subtitle_font_weight) . "%7C";
		}
		if($ajzaa_subtitle_font_size != '') {
			$ajzaa_custom_subtitle_inline_style .= 'font-size:'.esc_attr($ajzaa_subtitle_font_size).'px;';
		}
		if($ajzaa_subtitle_text_transform != '') {
			$ajzaa_custom_subtitle_inline_style .= 'text-transform:'.esc_attr($ajzaa_subtitle_text_transform).';';
		}
		if($ajzaa_subtitle_line_height != '') {
			$ajzaa_custom_subtitle_inline_style .= 'line-height:'.esc_attr($ajzaa_subtitle_line_height).'px;';
		}
		if($ajzaa_subtitle_letter_spacing != '') {
			$ajzaa_custom_subtitle_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_subtitle_letter_spacing).'px;';
		}

		$ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_text_icon_to_enqueue);
		$ajzaa_font_family_text_icon_to_enqueue = "";
	//___________________ content font Style _______________	
	$ajzaa_custom_content_inline_style = '';

		if($ajzaa_content_font_family != '') {
			$ajzaa_custom_content_inline_style .= 'font-family:'.esc_attr($ajzaa_content_font_family).';';
			$ajzaa_font_family_text_icon_to_enqueue .= esc_attr($ajzaa_content_font_family) . ":";
		}
		if($box_content_padding != '') {
			$ajzaa_custom_content_inline_style .= 'padding:'.esc_attr($box_content_padding).';';
		}
		if($box_content_color != '') {
			$ajzaa_custom_content_inline_style .= 'color:'.esc_attr($box_content_color).';';
		}
		if($ajzaa_content_font_weight != '' && $ajzaa_content_font_family != '') {
			$ajzaa_custom_content_inline_style .= 'font-weight:'.esc_attr($ajzaa_content_font_weight).';';
			$ajzaa_font_family_text_icon_to_enqueue .= esc_attr($ajzaa_content_font_weight) . "%7C";
		}
		if($ajzaa_content_font_size != '') {
			$ajzaa_custom_content_inline_style .= 'font-size:'.esc_attr($ajzaa_content_font_size).'px;';
		}
		if($ajzaa_content_text_transform != '') {
			$ajzaa_custom_content_inline_style .= 'text-transform:'.esc_attr($ajzaa_content_text_transform).';';
		}
		if($ajzaa_content_line_height != '') {
			$ajzaa_custom_content_inline_style .= 'line-height:'.esc_attr($ajzaa_content_line_height).'px;';
		}
		if($ajzaa_content_letter_spacing != '') {
			$ajzaa_custom_content_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_content_letter_spacing).'px;';
		}

		$ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_text_icon_to_enqueue);
		$ajzaa_font_family_text_icon_to_enqueue = "";
	//_________________________Icon style ___________________________
		$ajzaa_custom_icon_inline_style ='';
		if($box_icon_color != '') {
			$ajzaa_custom_icon_inline_style .= 'color:'.esc_attr($box_icon_color).';';
		}
		if($ajzaa_icon_font_size != '') {
			$ajzaa_custom_icon_inline_style .= 'font-size:'.esc_attr($ajzaa_icon_font_size).'px;';
		}
		if($box_icon_padding != '') {
			$ajzaa_custom_icon_inline_style .= 'padding:'.esc_attr($box_icon_padding).';';
		}
		if($box_icon_margin != '') {
			$ajzaa_custom_icon_inline_style .= 'margin:'.esc_attr($box_icon_margin).';';
		}
		if($box_icon_background_color != '') {
			$ajzaa_custom_icon_inline_style .= 'background-color:'.esc_attr($box_icon_background_color).';';
		}
		if($box_icon_border_style != '') {
			$ajzaa_custom_icon_inline_style .= 'border-style:'.esc_attr($box_icon_border_style).';';
		}
		if($box_icon_border_color != '') {
			$ajzaa_custom_icon_inline_style .= 'border-color:'.esc_attr($box_icon_border_color).';';
		}
		if($box_icon_border_width != '') {
			$ajzaa_custom_icon_inline_style .= 'border-width:'.esc_attr($box_icon_border_width).'px;';
		}
		if($box_icon_border_radius != '') {
			$ajzaa_custom_icon_inline_style .= 'border-radius:'.esc_attr($box_icon_border_radius).';';
		}
		
		
    $animation_classes =  "";
    $data_animated = "";
	$box_icon_data =$data_hover_effect = '';
	
    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
    }
	if ($box_hover_background_color != '') {
		$box_icon_data = 'box-icon-data';
		$data_hover_effect = "data-box-hover-bg = '$box_hover_background_color' data-box-bg = '$box_background_color'";
	}

    ob_start();

    $sap = str_replace(array('X','x'),'X',$ajzaa_size_image);
    $ajzaa_image_size_ = explode( 'X', $sap) ;
    if(isset($ajzaa_image_size_[0])){
      $ajzaa_image_size_w = $ajzaa_image_size_[0];
    }
    if(isset($ajzaa_image_size_[1])){
      $ajzaa_image_size_h = $ajzaa_image_size_[1];
    }else{
      $ajzaa_image_size_h = '';
    }
?>
    
    <div <?php echo $data_hover_effect ?> class="<?php echo esc_attr($animation_classes), $box_icon_data  ?>box-with-icon clearfix <?php echo esc_attr($box_extra_class_name) ?>" style="<?php echo esc_attr($ajzaa_custom_box_inline_style), $ajzaa_custom_box_icon_background_inline_style; ?>"  <?php echo esc_attr($data_animated); ?>>
    	<?php if($box_link_apply == 'all_box') { echo '<a href="'.$box_link.'">'; } ?>
    		
    	<?php //__________Icon / Image_________________-->	?>
    		<div style="<?php echo esc_attr($ajzaa_custom_box_icon_position_inline_style) ?>" >
	    		<?php 
	    		
	    		if($ajzaa_icon_fontawesome !='' and $ajzaa_switch == 'ajzaa_icon') { ?>
	    		<i class="fa <?php echo esc_attr($ajzaa_icon_fontawesome) .' '.  $ajzaa_custom_box_hover ?>" style="<?php  echo esc_attr($ajzaa_custom_icon_inline_style);  ?>" ></i>
	    		<?php }elseif($ajzaa_source_image !='' and $ajzaa_switch == 'ajzaa_image'){
	    			
					$ajzaa_image_url = wp_get_attachment_url( $ajzaa_source_image, 'full');
          if($ajzaa_image_size_h != '') {
            $image = ajzaa_resize( $ajzaa_image_url, $ajzaa_image_size_w, $ajzaa_image_size_h , true );
          }else{
            $image = ajzaa_resize( $ajzaa_image_url, $ajzaa_image_size_w, true );
          }
          if ($image == false){
          	?>
						<img src="<?php echo $ajzaa_image_url ?>" style="<?php  echo esc_attr($ajzaa_custom_icon_inline_style);  ?>" alt='<?php echo $box_title ?>'>
						<?php
					}else{
						?>
						<img src="<?php echo esc_attr($image) ?>" style="<?php  echo esc_attr($ajzaa_custom_icon_inline_style);  ?>" alt='<?php echo $box_title ?>'>
						<?php
					}

	    		}
	    		?>
			</div>
		<?php //___________Title / Content / Read More_________________ ?>	
			<div style="<?php echo esc_attr($ajzaa_custom_box_icon_position_padding_inline_style) ?>" class="box-text-container">
			<?php  //-- --------------------Title SubTitle ------------------------->?>
				<?php if($ajzaa_switch_title_subtitle == 'true') { ?>
					<?php //__________Title_________________-->	 ?>
			          <<?php echo $ajzaa_custom_title_balise ?> style="<?php  echo esc_attr($ajzaa_custom_title_inline_style);  ?>">
			          	<?php if($box_link_apply == 'title_box')  {?>
			          	  <a href="<?php echo esc_attr($box_link) ?>"><?php  echo $box_title;  ?></a>
			          	<?php }else{ 
		                echo $box_title;
	                } ?>
			          </<?php echo $ajzaa_custom_title_balise ?>>
			          
			          <?php if($box_title_separator_color !='' and $box_title_separator_height !='' and $box_title_separator_width !='' ){ ?>
			          <div style='display: inline-block;<?php  echo esc_attr($ajzaa_custom_title_separator_inline_style);  ?>'></div>
			          <?php } ?>
			        <?php // _________SubTitle_________________--> ?>
			          <?php if($box_show_subtitle == 'ajzaa_show') { ?>
			          <h5 style="<?php  echo esc_attr($ajzaa_custom_subtitle_inline_style);  ?>">
			          	<?php  echo esc_attr($box_subtitle);  ?>
			          </h5>
			          <?php } ?>
		 <?php //_-------------------- SubTitle Title ------------------------- ?>
		         <?php }else{ ?>
			        <?php //__________SubTitle_________________-- ?>
			          <?php if($box_show_subtitle == 'ajzaa_show') { ?>
			          <h5 style="<?php  echo esc_attr($ajzaa_custom_subtitle_inline_style);  ?>">
			          	<?php  echo esc_attr($box_subtitle);  ?>
			          </h5>
			          <?php } ?>
			        <?php //__________Title_________________-- ?>	
			          <<?php echo $ajzaa_custom_title_balise ?> style="<?php  echo esc_attr($ajzaa_custom_title_inline_style);  ?>">
			          	<?php if($box_link_apply == 'title_box')  {?>
			          	<a href="<?php echo esc_attr($box_link) ?>"><?php  echo $box_title;  ?></a>
			          	<?php }else{ 
			          			echo $box_title;
			          		  } ?>
			          </<?php echo $ajzaa_custom_title_balise ?>>
			          
			          <?php if($box_title_separator_color !='' and $box_title_separator_height !='' and $box_title_separator_width !='' ){ ?>
			          <div class="box-separator" style='display: inline-block;<?php  echo esc_attr($ajzaa_custom_title_separator_inline_style);  ?>'></div>
			          <?php } ?>
		        <?php } ?> 
		    <?php //_ -------------------- /SubTitle Tite ------------------------- ?>      
		        <?php //___________Content_________________ ?>
		          <p style="<?php  echo esc_attr($ajzaa_custom_content_inline_style);  ?>">
		          	<?php  echo $box_content;  ?>
		          </p>
		        <?php //___________Read More Button_________________-- ?>
		          <?php
		          if($box_link_apply == 'read_more_btn'){
		          	?>
		          	<a href='<?php echo esc_attr($box_link) ?>' class='<?php echo $box_read_more_class ?>'><?php echo esc_attr($box_read_more); ?></a>
		          	<?php
		          } ?>
	        </div>
      <?php if($box_link_apply == 'all_box') { echo '</a>'; } ?> 
    </div>      
      
    <?php return ob_get_clean();
  }
  add_shortcode( 'ajzaa_text_icon', 'ajzaa_text_icon' );
}  
?>