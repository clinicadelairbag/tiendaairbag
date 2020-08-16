<?php 
function ajzaa_separator_title($atts) {
           
  extract( shortcode_atts( array(
  
    'ajzaa_title' => 'this is a title',
    'ajzaa_subtitle'=>'this is a subtitle',
    'ajzaa_separator_style' => 'wd-title-section_c',
    'css_animation' => 'no'
    
  ), $atts ) );

  $animation_classes =  "";
    $data_animated = "";
  if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
}

  ob_start(); ?>


<div class="<?php echo esc_attr($animation_classes); ?>" <?php echo esc_attr($data_animated); ?>>
  <div class="large-12 columns <?php echo esc_attr($animation_classes) . ' ' . esc_attr($ajzaa_separator_style) ; ?>" <?php echo esc_attr($data_animated); ?>>
  <?php if ($ajzaa_title != "") { ?>
    <h2><?php echo $ajzaa_title ?></h2>
  <?php } ?>
  <?php if ($ajzaa_title != "") { ?>
    <h5><?php echo $ajzaa_subtitle ?></h5>
  <?php } ?>
  
  </div>
</div>

  
<?php return ob_get_clean();
}
add_shortcode( 'ajzaa_separator_title', 'ajzaa_separator_title' );