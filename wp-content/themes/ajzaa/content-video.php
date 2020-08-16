<?php

$ajzaa_class_name = ajzaa_get_post_category();
$ajzaa_class_name .= " ajzaa_multi_post_isotop_item all";
?>
<li id="post-<?php the_ID(); ?>" <?php post_class($ajzaa_class_name); ?>>
  <div class="ajzaa_multi_post_video_masonry">

    <?php echo ajzaa_get_embedded_media( array('video','iframe') ); ?>

    <div class="ajzaa_multi_post_video_masonry_info">
      <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
      <div>
        <span><?php the_author() ?></span>
        <span>  <?php echo get_the_date() ?>  </span>
        <?php the_category() ?>
        <p><?php the_excerpt(); ?></p>
      </div>
      <div class="wd-redmore"><a href="<?php the_permalink() ?>"><?php esc_html__('Continue','ajzaa'); ?></a><i class="ion-ios-arrow-thin-right"></i>
      </div>
    </div>
  </div>
</li>
