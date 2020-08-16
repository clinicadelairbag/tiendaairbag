<?php 

if(!function_exists('ajzaa_team_scode')){
  function ajzaa_team_scode($atts) {
	  $show_description = $columns = $itemperpage = $team_collapse = "";
  	extract( shortcode_atts( array(
    'columns'     => 4,
    'itemperpage' => '10',
    'layout'      => 1,   // 1: masonry  2: grid  3: large
    'header' => 16,
    'css_animation' => 'no',
    'show_description' => 'yes',
    'team_collapse' => 'yes'
  ), $atts ) );

    $animation_classes =  "";
    $data_animated = "";
    if(($css_animation != 'no')){
      $animation_classes =  " animated ";
      $data_animated = "data-animated=$css_animation";
    }

    ob_start(); ?>


  <ul class="wd-section-team team-list small-block-grid-1 large-block-grid-<?php echo esc_attr($columns); ?> medium-block-grid-<?php echo esc_attr($columns); ?> <?php if($team_collapse == "") echo "collapse"; ?>">
    <?php $loop = new WP_Query( array( 'post_type' => 'team-member', 'posts_per_page' => $itemperpage, ) );
          while ( $loop->have_posts() ) : $loop->the_post();  ?> 
      <li class="wd-team-member-item">
      <div class="wd-team-member">
        <?php 
            $image_url = get_post_meta(get_the_ID(), 'picture', true);
        $image_url=image_from_url_relative($image_url);
            $image_id = ajzaa_get_image_id($image_url);
            print wp_get_attachment_image( $image_id, 'ajzaa_team' );
          ?>
          <h4 class="wd-title-element"><?php the_title(); ?></h4>
          <?php if ( $show_description == "yes" && get_post_meta(get_the_ID(), 'description', true) != ""){ ?>
          <p>
              <?php echo get_post_meta(get_the_ID(), 'description', true); ?>
          </p>
          <?php } ?>
      </div>
          
      </li>
    <?php endwhile; ?>
  </ul>
    
   <?php  
      return ob_get_clean();
      }
  add_shortcode( 'ajzaa_team', 'ajzaa_team_scode' );
}
function image_from_url_relative($image_url){
    $images=array();
    $images=explode('/',$image_url);
    $position=array_search('uploads',$images);
    $content=array();
    if($position){
        for($i=$position; $i<count($images);$i++) array_push($content,$images[$i]);
        $image_relative_link=get_site_url(). '/wp-content/'.implode('/',$content);
        if($image_url!=$image_relative_link) update_post_meta(get_the_ID(), 'pciture', $image_relative_link);
        return $image_relative_link;
    } else {
        return $image_url;
    }
}