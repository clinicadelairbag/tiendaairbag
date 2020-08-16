<?php

$ajzaa_class_name = ajzaa_get_post_category();
$ajzaa_class_name .= " ajzaa_multi_post_isotop_item all";
?>
<li id="post-<?php the_ID(); ?>" <?php post_class($ajzaa_class_name); ?>>
  <div class="ajzaa_multi_post_video_masonry">
    <?php
    $ajzaa_post_cloudsound = get_post_meta(get_the_ID(), 'ajzaa_cloudsound', true);
     echo ajzaa_get_embedded_media( array('audio','iframe') ); ?>
    <div class="ajzaa_multi_post_video_masonry_info">
      <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
      <div>
        <span><?php the_author() ?></span>
        <span>  <?php echo get_the_date() ?>  </span>
        <?php the_category() ?>
        <p><?php the_excerpt(); ?></p>
      </div>
      <a href="<?php the_permalink() ?>"><?php echo esc_html__("Continue", 'ajzaa') ?></a>
    </div>
  </div>
</li>
