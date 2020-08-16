<?php
if(!function_exists('ajzaa_progressbar')){
	function ajzaa_progressbar($atts) {
		extract( shortcode_atts( array(
			'ajzaa_progress_style' => 'progress_bar',
			'title' => '',
			'values' => '',
			'units' => '%',
			'css' => '',
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


		$values = (array) vc_param_group_parse_atts( $values );

		$max_value = 0.0;
		$graph_lines_data = array();
		foreach ( $values as $data ) {
			$new_line = $data;
			$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
			$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';

			if ( $max_value < (float) $new_line['value'] ) {
				$max_value = $new_line['value'];
			}
			
			$graph_lines_data[] = $new_line;
		}
?>
<?php if ($ajzaa_progress_style == "progress_bar"){ ?>
	<div class="wd-progress-bar-container <?php echo esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
		<ul class="wd-progress-bar">
			<?php
			foreach ( $graph_lines_data as $line ) {
				$line_value =  $line['value'];
				$line_label =  $line['label'];
			?>
			<li>
			<span class="label-bar text-left"><?php echo esc_attr($line_label); ?></span>
			<span class="value right"><?php echo $line_value . esc_attr($units);  ?></span>
			<div class="progress large-12  round">
			  <span class="meter" style="width: <?php echo $line_value . esc_attr($units) ?>"></span>
			</div>
			</li>
			<?php
			} ?>
		</ul>
	</div>
<?php } ?>
<?php if ($ajzaa_progress_style == "pie_chart"){ ?>
	<div class="team-member-skills">
		<div class="pie-chart-container">
		<?php
			foreach ( $graph_lines_data as $line ) {
				$line_value =  $line['value'];
				$line_label =  $line['label'];
			?>
				<div class="easyPieChart-item">
		      <div class="circular-item-style-team left">
		            <div class="circular-pie-style-team easyPieChart" data-percent="<?php echo esc_attr($line_value) ?>" data-color="#cc9900">
		                <span class="percent" style="font-weight:400;font-size:32px;color:#333;text-transform:None;letter-spacing:1px;font-style:normal;"></span>
		                <canvas width="100" height="100"></canvas>
		            		<canvas></canvas></div>
		            <?php if($line_label != '') { ?>
		              <div class="skill-name" style=""><?php echo esc_attr($line_label); ?></div>
		            <?php } ?>
		        </div>
		    </div>
	    <?php
			} ?>
		</div>
	</div>
<?php } ?>

		<?php return ob_get_clean();
	}
	add_shortcode( 'ajzaa_progressbar', 'ajzaa_progressbar' );
}
?>