<?php
if(!function_exists('ajzaa_call_to_action')){
  function ajzaa_call_to_action($atts) {
              
    extract( shortcode_atts( array(
      'title' => 'Title',
      'text'  => 'Some text should be here...',
      'button_text' => 'Button',
      'button_url' => '#',
      'layout' => '',
      'extra_classes' => '',
      'css_animation' => 'no',
    ), $atts ) );
    

    $animation_classes =  "";
    $data_animated = "";

    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
    }


    ob_start(); ?>


<section class="wd-section-call-to-action<?php echo esc_attr($layout) . ' ' . esc_attr($animation_classes) . ' ' . esc_attr($extra_classes); ?>" <?php echo esc_attr($data_animated); ?>>
    <div class="row call-to-action<?php echo esc_attr($layout); ?>">
        <div class="large-8 columns">
            <h4><?php echo esc_attr($title); ?></h4>
            <p><?php echo esc_attr($text); ?></p>
        </div>
        <div class="large-4 columns">
            <div class="wd-call-to-action-btn<?php echo esc_attr($layout); ?>">
                <a href="<?php echo esc_attr($button_url); ?>"><?php echo esc_attr($button_text); ?></a>
            </div>
        </div>
    </div>
</section>

    <?php return ob_get_clean();
  }
  add_shortcode( 'ajzaa_call_to_action', 'ajzaa_call_to_action' );
}  
?>