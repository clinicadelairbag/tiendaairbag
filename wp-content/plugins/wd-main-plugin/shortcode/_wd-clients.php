<?php 
function ajzaa_client($atts) {
           
  extract( shortcode_atts( array(
  
    'images' => '',
    'title' => '',
		'onclick' => 'link_image',
		'custom_links' => '',
		'custom_links_target' => '',
		'img_size' => 'thumbnail',
		'pretty_rand' =>'',
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
  <div class="carousel_client owl-carousel <?php echo esc_attr($animation_classes); ?>" data-columns="<?php echo esc_attr($columns) ?>" <?php echo esc_attr($data_animated); ?>>
<?php foreach ( $images as $attach_id ): ?>
<?php
if ( $attach_id > 0 ) {
	$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ) );
} else {
	$post_thumbnail = array();
	$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
	$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
}
$thumbnail = $post_thumbnail['thumbnail'];
?>

<div class="hvr-outline-in">
	<?php $p_img_large = $post_thumbnail['p_img_large'];?>
	<img  class="prettyphoto" src="<?php echo esc_attr($p_img_large[0]) ?>" alt="<?php echo esc_attr($title) ?>">
</div>
<?php 

endforeach;?>
  </div>
<?php return ob_get_clean();
}
add_shortcode( 'ajzaa_client', 'ajzaa_client' );
?>