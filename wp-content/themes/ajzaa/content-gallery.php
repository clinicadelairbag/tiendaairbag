<?php
$ajzaa_image_size_w = 924;
$ajzaa_image_size_h = 477;
$ajzaa_class_name = ajzaa_get_post_category();
$ajzaa_class_name .= " ajzaa_multi_post_isotop_item all";
?>
<li id="post-<?php the_ID(); ?>" <?php post_class($ajzaa_class_name); ?>>
  <div class="ajzaa_multi_post_gallery_masonry">
    <ul class="ajzaa_blog_post_gallery_masonry">
      <?php

      if( ajzaa_get_attachment() ):
        $attachments = ajzaa_get_attachment(7);
        $i = 0;
        foreach( $attachments as $attachment ):
          $active = ( $i == 0 ? ' active' : '' );
          ?>
          <li class="wd-gallery-image-holder <?php echo esc_attr($active); ?>"><img src="<?php echo wp_get_attachment_url( $attachment->ID ); ?>" alt="<?php echo the_title(); ?>"/></li>
          <?php $i++; endforeach; ?>

      <?php endif;

      ?>
    </ul>
    <div class="ajzaa_multi_post_gallery_masonry_info">
      <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
      <div>
        <span><?php the_author() ?></span>
        <span>  <?php echo get_the_date() ?>  </span>
        <?php the_category() ?>
        <p><?php the_excerpt(); ?></p>
      </div>
      <div class="wd-redmore"><a href="<?php the_permalink() ?>"><?php echo esc_html__("Continue", 'ajzaa') ?></a><i
          class="ion-ios-arrow-thin-right"></i></div>
    </div>
  </div>
</li>
