<?php
if(!function_exists('ajzaa_list')){
	function ajzaa_list($atts) {
		global $ajzaa_fonts_to_enqueue_array;
		$custom_list_inline_style = "";
		extract( shortcode_atts( array(
			'values' => '',
			'icon_color' => "#333",
			'text_color' => "#333",
			'ajzaa_font_family' => 'Open Sans',
			'ajzaa_font_size' => '14',
			'ajzaa_icon_size' => '14px',
			'ajzaa_font_weight' => '400',
			'ajzaa_text_transform' => 'none',
			'ajzaa_line_height' => '30',
			'ajzaa_icon_padding' => '10px',
			'ajzaa_icon_margin' => '0px',
			'ajzaa_letter_spacing' => '',
			'ajzaa_font_style' => 'normal',
			'ajzaa_list_style' => "style-1",
			'css_animation' => 'no'
		), $atts ) );

		ob_start(); ?>
		<?php
		$animation_classes =  "";
		$data_animated = "";

		if(($css_animation != 'no')){
			$animation_classes =  " animated ";
			$data_animated = "data-animated=$css_animation";
		}


		$ajzaa_font_family_list_to_enqueue = "";

		if($ajzaa_font_family != '' && $ajzaa_font_family != 'Default') {
      $custom_list_inline_style .= 'font-family:'. esc_attr($ajzaa_font_family).';';
      $ajzaa_font_family_list_to_enqueue .= esc_attr($ajzaa_font_family) . ":";
    }
    if($ajzaa_font_weight != '' && $ajzaa_font_family != '') {
      $custom_list_inline_style .= 'font-weight:'.esc_attr($ajzaa_font_weight).';';
      $ajzaa_font_family_list_to_enqueue .= esc_attr($ajzaa_font_weight) . "%7C";
    }
    if($ajzaa_font_size != '') {
      $custom_list_inline_style .= 'font-size:'.esc_attr($ajzaa_font_size).'px;';
    }
    if($ajzaa_text_transform != '') {
      $custom_list_inline_style .= 'text-transform:'.esc_attr($ajzaa_text_transform).';';
    }
    if($ajzaa_line_height != '') {
      $custom_list_inline_style .= 'line-height:'.esc_attr($ajzaa_line_height).'px;';
    }
    if($ajzaa_letter_spacing != '') {
      $custom_list_inline_style .= 'letter-spacing:'.esc_attr($ajzaa_letter_spacing).'px;';
    }
    if($ajzaa_font_style != '') {
      $custom_list_inline_style .= 'font-style:'.esc_attr($ajzaa_font_style).';';
    }

    $ajzaa_fonts_to_enqueue_array[] = esc_attr($ajzaa_font_family_list_to_enqueue);








		$values = (array) vc_param_group_parse_atts( $values );

		$graph_lines_data = array();
		foreach ( $values as $data ) {
			$new_line = $data;
			$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
			$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';
			$new_line['icon_color'] = isset( $data['icon_color'] ) ? $data['icon_color'] : '#333';
			$new_line['text_color'] = isset( $data['text_color'] ) ? $data['text_color'] : '#333';
			
			$graph_lines_data[] = $new_line;
		}
?>
	<div class="wd-list-container">
		<ul class="wd-list <?php echo esc_attr($ajzaa_list_style); ?>">
			<?php
			foreach ( $graph_lines_data as $line ) {
				$line_value =  $line['value'];
				$line_label =  $line['label'];
				$icon_color =  $line['icon_color'];
				$text_color =  $line['text_color'];
			?>
			<li style="<?php echo esc_attr($custom_list_inline_style)?>" class="<?php echo esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
			<?php 
			switch ($ajzaa_list_style) {
				case 'style-1':
					?>
					<i style="font-size: <?php echo esc_attr($ajzaa_icon_size); ?>;padding: <?php echo esc_attr($ajzaa_icon_padding) ?>;margin: <?php echo esc_attr($ajzaa_icon_margin) ?>;color:<?php echo esc_attr($icon_color) ?>" class="<?php echo esc_attr($line_value); ?>"></i>
					<?php
					break;
				case 'style-2':
					?>
					<i style="font-size: <?php echo esc_attr($ajzaa_icon_size); ?>;padding: <?php echo esc_attr($ajzaa_icon_padding) ?>;margin: <?php echo esc_attr($ajzaa_icon_margin) ?>;background-color:<?php echo esc_attr($icon_color) ?>" class="<?php echo esc_attr($line_value); ?>"></i>
					<?php
					break;
				case 'style-2-2':
					?>
					<i style="font-size: <?php echo esc_attr($ajzaa_icon_size); ?>;padding: <?php echo esc_attr($ajzaa_icon_padding) ?>;margin: <?php echo esc_attr($ajzaa_icon_margin) ?>;border-color:<?php echo esc_attr($icon_color) ?>;color:<?php echo esc_attr($icon_color) ?>" class="<?php echo esc_attr($line_value); ?>"></i>
					<?php
					break;
					case 'style-3':
					?>
					<i style="font-size: <?php echo esc_attr($ajzaa_icon_size); ?>;padding: <?php echo esc_attr($ajzaa_icon_padding) ?>;margin: <?php echo esc_attr($ajzaa_icon_margin) ?>;background-color:<?php echo esc_attr($icon_color) ?>" class="<?php echo esc_attr($line_value); ?>"></i>
					<?php
					break;
					case 'style-3-3':
					?>
					<i style="font-size: <?php echo esc_attr($ajzaa_icon_size); ?>;padding: <?php echo esc_attr($ajzaa_icon_padding) ?>;margin: <?php echo esc_attr($ajzaa_icon_margin) ?>;border-color:<?php echo esc_attr($icon_color) ?>;color:<?php echo esc_attr($icon_color) ?>" class="<?php echo esc_attr($line_value); ?>"></i>
					<?php
					break;
					case 'style-4':
					?>
					<i data-hover="<?php echo esc_attr($icon_color) ?>" class="<?php echo esc_attr($line_value); ?>"></i>
					<?php
					break;
					case 'style-4-4':
					?>
					<i style="color:<?php echo esc_attr($icon_color) ?>" data-border="<?php echo esc_attr($icon_color) ?>" class="<?php echo esc_attr($line_value); ?>"></i>
					<?php
					break;
				
				default:
					?>
					<i style="font-size: <?php echo esc_attr($ajzaa_icon_size); ?>;padding: <?php echo esc_attr($ajzaa_icon_padding) ?>;margin: <?php echo esc_attr($ajzaa_icon_margin) ?>;color:<?php echo esc_attr($icon_color) ?>" class="<?php echo esc_attr($line_value); ?>"></i>
					<?php
					break;
			}
			 ?>
			<span style="color:<?php echo esc_attr($text_color) ?>"><?php echo esc_attr($line_label); ?></span>
			</li>
			<?php
			} ?>
		</ul>
	</div>


		<?php return ob_get_clean();
	}
	add_shortcode( 'ajzaa_list', 'ajzaa_list' );
}
?>