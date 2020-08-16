<?php 

if(!function_exists('ajzaa_causes_code')){
  function ajzaa_causes_code($atts) {
	  $show_description = $columns = $itemperpage = $team_collapse = "";
  	extract( shortcode_atts( array(
    'columns'     => 4,
    'itemperpage' => '10',
    'ajzaa_causes_affichage_type'=>'',
  ), $atts ) );

    $animation_classes =  "";
    $data_animated = "";
    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
    }



    $ajzaa_image_size_w = 924;
    $ajzaa_image_size_h = 500;



    ob_start(); ?>



    <ul class="ajzaa_isotop large-block-grid-3" data-wdgrid="fitRows" style="position: relative; height: 531px;">
    <?php $loop = new WP_Query( array( 'post_type' => 'campaign', 'posts_per_page' => $itemperpage, ) );
     while ( $loop->have_posts() ) : $loop->the_post();  ?>
        <li>
         <div class="ajzaa_multi_post_top_image">
           <?php if ( has_post_thumbnail() ) {
             $thumb = get_post_thumbnail_id();
             $img_url = wp_get_attachment_url( $thumb,'full' );
             if($ajzaa_image_size_h != '') {
               $image = ajzaa_resize( $img_url, $ajzaa_image_size_w, $ajzaa_image_size_h , true );
             }else{
               $image = ajzaa_resize( $img_url, $ajzaa_image_size_w, true );
             }
             ?>
             <img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>
           <?php } ?>
             <div class="ajzaa_multi_post_top_image_info">
                 <h4>
                     <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                 </h4>
                 <div>
                   <p><?php
                     $content = get_post_meta(get_the_ID(), '_campaign_description', TRUE);
                     echo wp_trim_words($content,25);
                     ?></p>

                   <?php
                   // Check that the class exists before trying to use it
                   if (class_exists('Charitable_Campaign')) {
                     $campaign = new Charitable_Campaign(get_the_ID()); ?>
                     <div class="wd-progress-bar-container ">
                       <ul class="wd-progress-bar">
                         <li>
                           <span class="label-bar text-left">Goal: $<?php echo $campaign->get_goal(); ?></span>
                           <span class="value right"><?php echo $campaign->get_percent_donated(); ?></span>
                           <div class="progress large-12  round">
                             <span class="meter" style="width: <?php echo $campaign->get_percent_donated(); ?>"></span>
                           </div>
                         </li>
                       </ul>
                     </div>
                   <?php } ?>
                 </div>
                 <div class="wd-redmore"><a href="<?php the_permalink() ?>">Read More</a><i class="ion-ios-arrow-thin-right"></i></div>
             </div>
         </div>
        </li>
     <?php endwhile; ?>
    </ul>
    
   <?php  
      return ob_get_clean();
      }
  add_shortcode( 'ajzaa_causes', 'ajzaa_causes_code' );
}