<?php
if(!function_exists('ajzaa_empty_spaces')){
  function ajzaa_empty_spaces($atts) {
              
    extract( shortcode_atts( array(
      'height_mobile' => '130px',
      'height_tablet' => '130px',
      'height_desktop' => '130px',
      'extra_classes' => ''
      
    ), $atts ) );

    ob_start(); ?>


<div class="ajzaa_empty_space" data-heightmobile="<?php echo esc_attr($height_mobile) ?>" data-heighttablet="<?php echo esc_attr($height_tablet); ?>" data-heightdesktop="<?php echo esc_attr($height_desktop); ?>">

</div>
      



        
      
    <?php return ob_get_clean();
  }
  add_shortcode( 'ajzaa_empty_spaces', 'ajzaa_empty_spaces' );
}  
?>