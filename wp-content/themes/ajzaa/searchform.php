<?php
/**
 * The template for displaying search forms in Ajzaa
 *
 */
?>

<form action="<?php echo esc_url( home_url( '/' ) ) ?>" class="searchform" id="searchform" method="get">
				<div>
					<input type="text" id="s" placeholder="<?php echo esc_html__('Type & hit enter...','ajzaa') ?> " name="s">
				</div>
</form>