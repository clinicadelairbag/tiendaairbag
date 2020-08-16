<?php
if(!function_exists('ajzaa_maps')){
  function ajzaa_maps($atts) {
              
    extract( shortcode_atts( array(
      'ajzaa_map_latitude'  => '-37.817612',
      'ajzaa_map_longitude'  => '144.959399',
      'ajzaa_map_height' => '500',
      'ajzaa_map_zoom' => '14',
      'ajzaa_map_style' => 'wa_map_style1',
      'ajzaa_map_company_name' => 'Envato',
      'ajzaa_map_company_description' => '2 Elizabeth St, Melbourne Victoria 3000 Australia',
      'ajzaa_map_source_image' => '',
      'ajzaa_map_extra_class_name' => '',
      'css_animation' => 'no'
    ), $atts ) );

    ob_start();
   
		$ajzaa_image = wp_get_attachment_image_src( $ajzaa_map_source_image, '50X50');
		$data_animated = '';
    $animation_classes =  "";
	  if(($css_animation != 'no')){
		  $animation_classes =  " animated ";
		  $data_animated = "data-animated=$css_animation";
	  }

    ?>
   

    <div class="map <?php echo esc_attr($animation_classes)  ?>" <?php echo esc_attr($data_animated); ?>>
      <div class="map-canvas" data-id="map-canvas" style="height: <?php echo $ajzaa_map_height ?>px;" data-latitude="<?php echo $ajzaa_map_latitude ?>"
        data-longitude="<?php echo $ajzaa_map_longitude ?>" data-zoom="<?php echo $ajzaa_map_zoom ?>" data-companyname="<?php echo $ajzaa_map_company_name ?>"
        data-decription="<?php echo $ajzaa_map_company_description ?>" data-imagepath="<?php echo $ajzaa_image[0] ?>" data-wdmapstyle="<?php echo $ajzaa_map_style ?>">
      </div>
    </div>
    

    <?php return ob_get_clean();
  }
  add_shortcode( 'ajzaa_maps', 'ajzaa_maps' );
}  
?>