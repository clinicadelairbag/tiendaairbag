<?php
/**
 * Multicheck Control
 *
 * @since Jobify 2.1.0
 */
class Jobify_Customize_Mulitcheck_Control extends WP_Customize_Control {
	public $type = 'multicheck';

	public function render_content() {
		$values = $this->value();

		if ( ! is_array( $values ) ) {
			$values = explode( ',', $values );
		}
?>
	<script>
		jQuery(document).ready(function($) {
			"use strict";
			$('input.multicheck').change(function(event) {
				event.preventDefault();
				var csv = '';
				$(this).parents('li:eq(0)').find('input[type=checkbox]').each(function() {
					if ($(this).is(':checked')) {
						csv += $(this).attr('value') + ',';
					}
				});
				csv = csv.replace(/,+$/, "");
				$(this).parents('li:eq(0)').find('input[type=hidden]').val(csv)
				// we need to trigger the field afterwards to enable the save button
				.trigger('change');
				return true;
			});
		});
	</script>

	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	
	<p>
	<?php foreach ( $this->choices as $key => $value ) : ?>
		<label for="<?php echo esc_attr($this->id); ?>-<?php echo esc_attr($key); ?>">
			<input type="checkbox" class="multicheck" id="<?php echo esc_attr($this->id); ?>-<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($key); ?>" <?php checked( in_array( $key, $values ), true ); ?> />
			<?php echo esc_attr( $value ); ?> 
		</label><br />
	<?php endforeach; ?>
	</p>
		
	<?php if ( ! empty( $this->description ) ) : ?>
		<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
	<?php endif; ?>

	<input type="hidden" value="<?php echo esc_attr( implode( ',', $values ) ); ?>" <?php $this->link(); ?> />

<?php
	}
}
