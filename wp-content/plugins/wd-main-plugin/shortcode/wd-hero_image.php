<?php
if(!function_exists('ajzaa_hero_image')){
	function ajzaa_hero_image($atts) {
		$hero_full_screen = $classes = $image = $hero_text = "";
		extract( shortcode_atts( array(
			'image' => '',
			'hero_text' => '',
			'hero_full_screen' => '',

		), $atts ) );

		$hero_text = rawurldecode( base64_decode( strip_tags( $hero_text ) ) );

		if($hero_full_screen == 'yes') {
			$classes .=  "ajzaa_full_screen";
		}

		$img_id = preg_replace( '/[^\d]/', '', $image );
		$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'full_size' => 'full','thumb_size' => 'thumbnail') );

		$img_path = $img['p_img_large'][0];

		ob_start(); ?>
		<div class="wd-hero-image <?php echo esc_attr($classes); ?>">
			<div class="wd-overlay"></div>
			<div class="wd-image" style="background-image: url(<?php echo esc_url($img_path); ?>);"></div>
			<div class="wd-text-wrapper">
				<?php echo esc_attr($hero_text); ?>
			</div>
		</div>
		<?php return ob_get_clean();
	}
	add_shortcode( 'ajzaa_hero_image', 'ajzaa_hero_image' );
}
?>