<?php

$ajzaa_class_name = ajzaa_get_post_category();
$ajzaa_class_name .= " ajzaa_multi_post_isotop_item all";
?>
<li id="post-<?php the_ID(); ?>" <?php post_class($ajzaa_class_name); ?>>
  <div class="ajzaa_one_post_quote">
    <div>
      <blockquote><?php the_content() ?></blockquote>
      <div class="ajzaa_author">
        <?php the_author() ?>
      </div>
      <i class="fa fa-quote-right"></i>
    </div>

  </div>
</li>
