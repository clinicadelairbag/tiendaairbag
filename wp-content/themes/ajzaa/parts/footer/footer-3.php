<section class="wd-footer wd-footer-3">
	<div class="row">

		<?php
		$ajzaa_footer_columns = ajzaa_get_option('ajzaa_footer_columns','three_columns');
		switch ($ajzaa_footer_columns) {
			case "one_columns":
				$column_one = 12;
				break;
			case "tow_a_columns":
				$column_one = 4;
				$column_tow = 8;
				break;
			case "tow_b_columns":
				$column_one = 8;
				$column_tow = 4;
				break;
			case "tow_c_columns":
				$column_one = 6;
				$column_tow = 6;
				break;
			case "four_columns":
				$column_one = 3;
				$column_tow = 3;
				$column_three = 3;
				$column_four = 3;
			break;
			default:
				$column_one = 4;
				$column_tow = 4;
				$column_three = 4;
		} ?>

		<ul class="block large-<?php echo esc_attr($column_one) ?> medium-<?php echo esc_attr($column_one) ?> columns" >
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) : ?><?php endif; ?>
		</ul>

		<?php if($ajzaa_footer_columns == 'tow_a_columns' || $ajzaa_footer_columns == 'tow_b_columns' || $ajzaa_footer_columns == 'tow_c_columns' || $ajzaa_footer_columns == 'three_columns' || $ajzaa_footer_columns == 'four_columns') {  ?>
			<ul class="block large-<?php echo esc_attr($column_tow) ?> medium-<?php echo esc_attr($column_tow) ?> columns" >
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2') ) : ?><?php endif; ?>
			</ul>
		<?php }  ?>

		<?php if( $ajzaa_footer_columns == 'three_columns'  || $ajzaa_footer_columns == 'four_columns' ) {
			?>
			<ul class="block large-<?php echo esc_attr($column_three) ?> medium-<?php echo esc_attr($column_three) ?> columns" >
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-3') ) : ?><?php endif; ?>
			</ul>
		<?php }  ?>
		<?php if( $ajzaa_footer_columns == 'four_columns' ) {
			?>
			<ul class="block large-<?php echo esc_attr($column_four) ?> medium-<?php echo esc_attr($column_four) ?> columns" >
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-4') ) : ?><?php endif; ?>
			</ul>
		<?php }  ?>

	</div>


<!--.l-footer-->
<footer class="wd-copyright-3">
	<div class="row">
		<div class="large-6 columns">
			<?php
			$ajzaa_copyright = ajzaa_get_option('ajzaa_copyright','');
			?>
			<p>
				<?php echo esc_html($ajzaa_copyright); ?>
			</p>

		</div>
		<div class=" large-6 columns social-icon">
			<?php
			$socialmediaicon_arry = explode(' ', ajzaa_get_option('social_icon'));
			$socialmedia_arry = explode(' ', ajzaa_get_option('socialmedia_name'));
			if (!empty($socialmedia_arry[0])) {
				$i = 0;
				foreach ($socialmedia_arry as $social_data) {
					?>
					<a href="<?php echo esc_url($social_data) ?>"><i
							class="fa <?php echo esc_attr($socialmediaicon_arry[$i]) ?>"></i>
					</a>
					<?php
					$i++;
				}
			}
			?>
			
		</div>
	</div>
</footer>
</section>
<!--/.footer-columns-->