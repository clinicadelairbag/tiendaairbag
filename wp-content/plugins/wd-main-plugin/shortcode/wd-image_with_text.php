<?php
if(!function_exists('ajzaa_image_with_text')){
  function ajzaa_image_with_text($atts) {
              
    extract( shortcode_atts( array(
      'title' => 'Block title',
      'text'  => 'Some text should be hrre...',
      'layout' => '1',
      'extra_classes' => '',
      'url' => '',
      'image_checkbox' => '',
      'image' => '',
      'css_animation' => 'no',
    ), $atts ) );
    

    $img_size="";
    $thumb_size="thumbnail";
    $post_thumbnail="";

    $animation_classes =  "";
    $data_animated = "";

    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
    }


    ob_start(); ?>



<?php if (isset($layout) && $layout== 1){ ?>

<section class="wd-section-blog text-center style2">
  <div class="wd-blog-post <?php echo esc_attr($animation_classes) . ' ' . esc_attr($extra_classes); ?>" <?php echo esc_attr($data_animated); ?>>
    <?php 
            $img_id = preg_replace( '/[^\d]/', '', $image );
            $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'full_size' => $img_size,'thumb_size' => 'thumbnail') );
             ?>
            <?php
            $img_path=$img['p_img_large'][0];
             ?>
             <img src="<?php echo esc_url($img_path)  ?>" alt="icon"/>
    <h4 class="wd-title-element">Solar Energy</h4>
    <p>
      <?php echo esc_attr($text); ?>
    </p>
  </div>
</section>
<?php } else { ?>

<div class="wd-section-blog-services text-center style-3 anim-on">
  <article class="layout-<?php echo esc_attr($layout) . ' ' . esc_attr($animation_classes) . ' ' . esc_attr($extra_classes); ?>" <?php echo esc_attr($data_animated); ?>>
      <div class="wd-blog-post nohover">
        <div class="svg-wrapper">
          <svg width="172" height="172" xmlns="http://www.w3.org/2000/svg">
            <rect height="166" width="166" class="shape"></rect>
          </svg>
          <div class="img-wrapper">

          <?php 
            $img_id = preg_replace( '/[^\d]/', '', $image );
            $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'full_size' => $img_size,'thumb_size' => 'thumbnail') );
             ?>
            <?php
            $img_path=$img['p_img_large'][0];
             ?>
             <img src="<?php echo esc_url($img_path)  ?>" alt="icon"/>
          </div>
        </div>
        <h4 class="wd-title-element"><?php echo esc_attr($title); ?></h4>
        <p>
          <?php echo esc_attr($text); ?>
        </p>
      </div>
  </article>
  </div>
<?php } ?>
    <?php return ob_get_clean();
  }
  add_shortcode( 'ajzaa_image_with_text', 'ajzaa_image_with_text' );
}  
?>