<footer class="wd-copyright wd-footer-2">
  <div class="social-icon">
    <?php
    $socialmediaicon_arry = explode(' ', ajzaa_get_option('social_icon'));
    $socialmedia_arry = explode(' ', ajzaa_get_option('socialmedia_name'));
    if (!empty($socialmedia_arry[0])) {
      $i = 0;
      foreach ($socialmedia_arry as $social_data) {
        ?>
        <a href="<?php echo esc_url($social_data) ?>"><i
            class="fa <?php echo esc_attr($socialmediaicon_arry[$i]) ?>"></i></a>
        <?php
        $i++;
      }
    }
    ?>
  </div>
  <div>
    <?php
    $ajzaa_copyright = ajzaa_get_option('ajzaa_copyright', '');
    echo esc_html($ajzaa_copyright); ?>
  </div>
</footer>
