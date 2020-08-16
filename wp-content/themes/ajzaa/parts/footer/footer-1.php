<?php if ( is_active_sidebar('footer-1')) { ?>
<section class="wd-footer">
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
			<?php dynamic_sidebar('footer-1')  ?>
		</ul>

		<?php if($ajzaa_footer_columns == 'tow_a_columns' || $ajzaa_footer_columns == 'tow_b_columns' || $ajzaa_footer_columns == 'tow_c_columns' || $ajzaa_footer_columns == 'three_columns' || $ajzaa_footer_columns == 'four_columns') {  ?>
			<ul class="block large-<?php echo esc_attr($column_tow) ?> medium-<?php echo esc_attr($column_tow) ?> columns" >
				<?php dynamic_sidebar('footer-2') ?>
			</ul>
		<?php }  ?>

		<?php if( $ajzaa_footer_columns == 'three_columns'  || $ajzaa_footer_columns == 'four_columns' ) {
			?>
			<ul class="block large-<?php echo esc_attr($column_three) ?> medium-<?php echo esc_attr($column_three) ?> columns" >
				<?php dynamic_sidebar('Footer-3') ?>
			</ul>
		<?php }  ?>
		<?php if( $ajzaa_footer_columns == 'four_columns' ) {
			?>
			<ul class="block large-<?php echo esc_attr($column_four) ?> medium-<?php echo esc_attr($column_four) ?> columns" >
				<?php dynamic_sidebar('Footer-4')  ?>
			</ul>
		<?php }  ?>

	</div>
</section>
<?php } ?>
<!--/.footer-columns-->

<!--.l-footer-->
<footer class="wd-copyright">
	<div class="row">
		<div class="large-12 columns">
			<?php wp_nav_menu( array('theme_location' => 'footer',
			                         'container_class' => 'copyright-menu',
			                         'fallback_cb' => 'ajzaa_main_menu_fallback'
      ));
      ?>

		</div>
		<div class="copyright large-12 columns">
			<?php
			$ajzaa_copyright = ajzaa_get_option('ajzaa_copyright','');
			?>
			<p>
				<?php echo esc_html($ajzaa_copyright); ?>
			</p>
		</div>
	</div>

	<?php
	if(ajzaa_get_option('ajzaa_body_border') == "on") { ?>
		<div class="border-bar body-border-bottom"></div>
	<?php } ?>
</footer>