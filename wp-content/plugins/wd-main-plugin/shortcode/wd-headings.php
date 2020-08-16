<?php

function ajzaa_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style){
	if($headings_separator == "border"){
    echo "<hr style='$custom_separatore_style'/>"; }
	elseif($headings_separator == "image"){
    echo "<img src='$custom_separatore_img_style' style = '$custom_separatore_style' alt='separateur'/>";
  }
}


if(!function_exists('ajzaa_headings')){
	function ajzaa_headings($atts) {
		global $ajzaa_fonts_to_enqueue_array;
		$headings_alignment = $custom_header_inline_style = $custom_subheader_inline_style = $custom_separatore_style = $ajzaa_heading_spacing =$custom_separatore_img_style= $heading_extraclass = "";

		extract( shortcode_atts( array(
			'title'  => 'this is a title',
			'headings_title'  => 'The title..',
			'headings_title_tag'  => 'h2',
			'headings_subtitle'  => 'subtitle',
			'headings_subtitle_tag'  => 'h4',
			'headings_layout' => 's-under-t',
			'headings_alignment' => 'center',

			'headings_separator' => '',
			'headings_separator_position' => 'center',
			'headings_separator_border_style' => '',
			'headings_separator_border_width' => '',
			'headings_separator_border_color' => '',
			'ajzaa_separateur_image' => '',
			'heading_extraclass' => '',

			'ajzaa_heading_font_family' => '',
			'ajzaa_heading_font_weight' => '',
			'ajzaa_heading_font_size' => '',
			'ajzaa_heading_color' => '',
			'ajzaa_heading_text_transform' => '',
			'ajzaa_heading_line_height' => '',
			'ajzaa_heading_letter_spacing' => '',

			'ajzaa_heading_spacing' => '10px',

			'ajzaa_sub_heading_font_family' => '',
			'ajzaa_sub_heading_font_weight' => '100',
			'ajzaa_sub_heading_font_size' => '',
			'ajzaa_sub_heading_color' => '',
			'ajzaa_sub_heading_text_transform' => '',
			'ajzaa_sub_heading_line_height' => '',
			'ajzaa_sub_heading_letter_spacing' => '',

			'css_animation' => 'no'
		), $atts ) );

		$ajzaa_fonts_to_enqueue_array = array();

		$headings_title = str_replace("{","<span>", $headings_title);
		$headings_title = str_replace("}","</span>",$headings_title);

		$headings_title = str_replace("/n","<br/>", $headings_title);

		$headings_subtitle = str_replace("/n","<br/>", $headings_subtitle);

		$animation_classes =  "";
		$data_animated = "";

		if(($css_animation != 'no')){
			$animation_classes =  " animated ";
			$data_animated = "data-animated=$css_animation";
		}

		$headings_alignment = "text-" . $headings_alignment;

		$custom_header_inline_style = "margin:0;";
		$ajzaa_font_family_heading_to_enqueue = "";

		if($ajzaa_heading_font_family != '' && $ajzaa_heading_font_family != 'Default') {
			$custom_header_inline_style .= 'font-family:'.esc_attr($ajzaa_heading_font_family).';';
			$ajzaa_font_family_heading_to_enqueue .= esc_attr($ajzaa_heading_font_family) . ":";
		}
		if($ajzaa_heading_font_weight != '') {
			$custom_header_inline_style .= 'font-weight:'.esc_attr($ajzaa_heading_font_weight).';';
			$ajzaa_font_family_heading_to_enqueue .= esc_attr($ajzaa_heading_font_weight) . "%7C";
		}
		if($ajzaa_heading_font_size != '') {
			$custom_header_inline_style .= 'font-size:'.esc_attr($ajzaa_heading_font_size).'px;';
		}
		if($ajzaa_heading_color != '') {
			$custom_header_inline_style .= 'color:'.esc_attr($ajzaa_heading_color).';';
		}
		if($ajzaa_heading_text_transform != '') {
			$custom_header_inline_style .= 'text-transform:'.esc_attr($ajzaa_heading_text_transform).';';
		}
		if($ajzaa_heading_line_height != '') {
			$custom_header_inline_style .= 'line-height:'.esc_attr($ajzaa_heading_line_height).'px;';
		}
		if($ajzaa_heading_letter_spacing != '') {
			$custom_header_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_heading_letter_spacing).'px;';
		}

		$ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_heading_to_enqueue);

    

		
		// Separator : border
		if($headings_separator == 'border' && $headings_separator_border_style != '' ) {
			$custom_separatore_style .= 'border-bottom-style: ' . esc_attr( $headings_separator_border_style ) . ';';
		}
		if($headings_separator == 'border' && $headings_separator_border_width != '' ) {
			$custom_separatore_style .= 'border-bottom-width: ' . esc_attr( $headings_separator_border_width ) . ';';
		}
		if($headings_separator == 'border' && $headings_separator_border_color != '' ) {
			$custom_separatore_style .= 'border-color: '.esc_attr($headings_separator_border_color).';';
		}
		
		if($headings_separator == 'image' && $ajzaa_separateur_image != '' ) {
			$custom_separatore_img_style .=  wp_get_attachment_url(esc_attr( $ajzaa_separateur_image )) ;
		}

		$custom_separatore_style .= ' margin: '.esc_attr($ajzaa_heading_spacing).';';


		$ajzaa_font_family_heading_to_enqueue = "";

		if($ajzaa_sub_heading_font_family != '' && $ajzaa_sub_heading_font_family != 'Default') {
			$custom_subheader_inline_style .= 'font-family:'.esc_attr($ajzaa_sub_heading_font_family).';';
			$ajzaa_font_family_heading_to_enqueue .= esc_attr($ajzaa_sub_heading_font_family) . ":";
		}
		if($ajzaa_sub_heading_font_weight != '' && $ajzaa_sub_heading_font_family != '') {
			$custom_subheader_inline_style .= 'font-weight:'.esc_attr($ajzaa_sub_heading_font_weight).';';
			$ajzaa_font_family_heading_to_enqueue .= esc_attr($ajzaa_sub_heading_font_weight) . "%7C";
		}
		if($ajzaa_sub_heading_font_size != '') {
			$custom_subheader_inline_style .= 'font-size:'.esc_attr($ajzaa_sub_heading_font_size).'px;';
		}
		if($ajzaa_sub_heading_color != '') {
			$custom_subheader_inline_style .= 'color:'.esc_attr($ajzaa_sub_heading_color).';';
		}
		if($ajzaa_sub_heading_text_transform != '') {
			$custom_subheader_inline_style .= 'text-transform:'.esc_attr($ajzaa_sub_heading_text_transform).';';
		}
		if($ajzaa_sub_heading_line_height != '') {
			$custom_subheader_inline_style .= 'line-height:'.esc_attr($ajzaa_sub_heading_line_height).'px;';
		}
		if($ajzaa_sub_heading_letter_spacing != '') {
			$custom_subheader_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_sub_heading_letter_spacing).'px;';
		}

		$ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_heading_to_enqueue);




		ob_start(); ?>
		<div class="wd-heading <?php echo esc_attr($animation_classes .' '. $heading_extraclass .' '. $headings_alignment); ?>" <?php echo esc_attr($data_animated); ?>>
			<?php if($headings_layout == "t-under-s" ){ ?>

				<?php if( $headings_separator_position  == "top") {  ajzaa_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

        <?php if ($headings_subtitle != ""){ ?>
          <<?php echo $headings_subtitle_tag  ?> style="<?php echo esc_attr($custom_subheader_inline_style); ?>" >
              <?php echo $headings_subtitle  ?>
          </<?php echo $headings_subtitle_tag  ?>>
				<?php } ?>

        <?php
        if($headings_separator == "") {
          echo "<div style='margin-top: ".esc_attr($ajzaa_heading_spacing).";'></div>";
        } ?>

				<?php if( $headings_separator_position  == "center") {  ajzaa_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

				<<?php echo $headings_title_tag  ?> style="<?php echo esc_attr($custom_header_inline_style); ?>" >
						<?php echo $headings_title  ?>
				</<?php echo $headings_title_tag  ?>>

				<?php if( $headings_separator_position  == "bottom") {  ajzaa_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); }


			}elseif($headings_layout == "t-only"){

			  if( $headings_separator_position  == "top") {  ajzaa_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

				<<?php echo $headings_title_tag  ?> style="<?php echo esc_attr($custom_header_inline_style); ?>" >
					<?php echo $headings_title  ?>
				</<?php echo $headings_title_tag  ?>>

				<?php if( $headings_separator_position  == "center") {  ajzaa_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); }

			}else{ ?>

				<?php if( $headings_separator_position  == "top") {  ajzaa_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

				<<?php echo $headings_title_tag  ?> style="<?php echo esc_attr($custom_header_inline_style); ?>" >
					<?php echo $headings_title  ?>
				</<?php echo $headings_title_tag  ?>>

        <?php
        if($headings_separator == "") {
          echo "<div style='margin-top: ".esc_attr($ajzaa_heading_spacing).";'></div>";
        } ?>
				<?php if( $headings_separator_position  == "center") {  ajzaa_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

      <?php if ($headings_subtitle != ""){ ?>
				<<?php echo $headings_subtitle_tag  ?> style="<?php echo esc_attr($custom_subheader_inline_style); ?>" >
					<?php echo $headings_subtitle  ?>
				</<?php echo $headings_subtitle_tag  ?>>
      <?php } ?>

				<?php if( $headings_separator_position  == "bottom") {  ajzaa_get_heading_separator($headings_separator, $custom_separatore_style,$custom_separatore_img_style); } ?>

			<?php } ?>
		</div>

		<?php return ob_get_clean();
	}
	add_shortcode( 'ajzaa_headings', 'ajzaa_headings' );
}
?>