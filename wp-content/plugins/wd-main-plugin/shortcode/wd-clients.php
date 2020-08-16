<?php 
function ajzaa_clients($atts) {
           
  extract( shortcode_atts( array(
  
    'images' => '',
    'layout_style' => 'carousel',
    'nav_style' => 'dots',
    'elements_to_swipe' => '1',
    'columns_number_mobile' => '1',
    'columns_number_tablet' => '3',
    'columns_number_desktop' => '4',
    'item_to_display_mobile' => '1',
    'item_to_display_tablet' => '3',
    'item_to_display_desktop' => '5',
		'css_animation' => 'no'
  ), $atts ) );

  $animation_classes =  "";
  $data_animated = "";
  if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
}


  ob_start();
  
$images = explode( ',', $images );
 ?>
<?php if ($layout_style == 'carousel') { ?>

  <div class="wd-clients-carousel" data-swipe="<?php echo esc_attr($elements_to_swipe); ?>" data-navigation="<?php echo esc_attr($nav_style); ?>" data-displaymobile="<?php echo esc_attr($item_to_display_mobile); ?>" data-displaytablet="<?php echo esc_attr($item_to_display_tablet); ?>" data-displaydesktop="<?php echo esc_attr($item_to_display_desktop); ?>">

  	<?php foreach ( $images as $attach_id ): ?>
		<?php
		if ( $attach_id > 0 ) {
			$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => 'ajzaa_carousel_clients' ) );
		} else {
			$post_thumbnail = array();
			$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
			$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
		}
		$thumbnail = $post_thumbnail['thumbnail'];
		?>
		<div class="wd-clients-carousel-item <?php echo esc_attr($animation_classes)  ?>"  <?php echo esc_attr($data_animated); ?>>
  		<?php $p_img_large = $post_thumbnail['p_img_large'];?>
			<img  class="" src="<?php echo esc_url($p_img_large[0]) ?>" alt="">
  	</div>
		<?php 

		endforeach;?>

  </div>
  <?php } else { ?>
  <ul class="wd-clients-grid large-block-grid-<?php echo esc_attr($columns_number_desktop); ?> medium-block-grid-<?php echo esc_attr($columns_number_tablet); ?> small-block-grid-<?php echo esc_attr($columns_number_mobile); ?>">
  	<?php foreach ( $images as $attach_id ): ?>
		<?php
		if ( $attach_id > 0 ) {
			$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => 'ajzaa_grid_clients' ) );
		} else {
			$post_thumbnail = array();
			$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
			$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
		}
		$thumbnail = $post_thumbnail['thumbnail'];
		?>
		<li class="wd-clients-grid-item">
			<?php $p_img_large = $post_thumbnail['p_img_large'];?>
			<img  class="" src="<?php echo esc_url($p_img_large[0]) ?>" alt="">
		</li>
		<?php 

		endforeach;?>
  </ul>
  <?php } ?>
<?php return ob_get_clean();
}
add_shortcode( 'ajzaa_clients', 'ajzaa_clients' );
?>