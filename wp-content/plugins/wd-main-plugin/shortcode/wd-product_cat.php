<?php

if (!function_exists('ajzaa_product_cat')) {
  function ajzaa_product_cat($atts)
  {
    extract(shortcode_atts(array(
      'thumbnail_size' => '300x300',
      'columns' => 3,
      'my_category' => '',
      'items_per_cat' => '5',

    ), $atts));
    ob_start();

    $product_cat = get_terms(
      'product_cat',
      array(
        'parent' => 0,
        'hierarchical' => true,
        'hide_empty' => false,
      )
    );
    ?>
    <div class="wd_product_cat">
      <ul class="small-block-grid-1 medium-block-grid-1-2 large-block-grid-<?php echo $columns ?>">
        <?php
        foreach ($product_cat as $cat) {
          $category_id = explode(',', $my_category);
          $cat_link = get_term_link( $cat );
          if (in_array($cat->term_id, $category_id)) {
            ?>
            <li class="product-cat-container">
              <?php
              $thumbnail_id = absint(get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true));
              ?>
              <div class="thumnbail">
                <a href="<?php echo esc_url($cat_link); ?>">
                  <?php
                  if ($thumbnail_id) {
                    $sap = str_replace(array('X', 'x'), 'X', $thumbnail_size);
                    $size_ = explode('X', $sap);
                    if (isset($size_[0])) {
                      $size_w = $size_[0];
                    }
                    if (isset($size_[1])) {
                      $size_h = $size_[1];
                    } else {
                      $size_h = '';
                    }
                    $image = wp_get_attachment_url($thumbnail_id, 'full');
                    if ($size_h != '') {
                      $image = ajzaa_resize($image, $size_w, $size_h, true);
                    } else {
                      $image = ajzaa_resize($image, $size_w, true);
                    }
                    ?>
                    <img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($cat->name) ?>"
                         width="<?php echo esc_attr($size_w) ?>" height="<?php echo esc_attr($size_h) ?>"/>
                    <?php
                  } else {
                    $image = wc_placeholder_img_src();
                    ?>
                    <img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($cat->name) ?>"/>
                    <?php
                  }
                  ?>
                </a>
              </div>
              <div class="cat_text">
                <a href="<?php echo esc_url($cat_link); ?>">
                  <h3><?php echo $cat->name; ?></h3>
                </a>
                <ul>
                  <?php
                  $product_sub_cat = get_terms(
                    'product_cat',
                    array(
                      'parent' => $cat->term_id,
                      'hierarchical' => true,
                      'hide_empty' => false,
                    )
                  );
                  $i = 0;
                  foreach ($product_sub_cat as $sub_cat) {
                    $cat_count = count($product_sub_cat);
                    if ($cat_count <= $items_per_cat) {
                      ?>
                      <li><a
                          href="<?php echo esc_url(get_term_link($sub_cat)); ?>"><?php echo esc_html($sub_cat->name) ?></a>
                      </li>
                      <?php
                    } else {
                      if ($i < $items_per_cat) {
                        ?>
                        <li><a
                            href="<?php echo esc_url(get_term_link($sub_cat)); ?>"><?php echo esc_html($sub_cat->name) ?></a>
                        </li>
                        <?php
                      } else {
                        break;
                      }
                    }
                    $i++;
                  }
                  ?>
                </ul>
              </div>
            </li>
            <?php
          } elseif ($my_category == '') {
            ?>
            <li>
              <?php
              $thumbnail_id = absint(get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true));
              ?>
              <div class="large-5 columns thumnbail">
                <a href="<?php echo esc_url($cat_link); ?>">
                  <?php
                  if ($thumbnail_id) {
                    $sap = str_replace(array('X', 'x'), 'X', $thumbnail_size);
                    $size_ = explode('X', $sap);
                    if (isset($size_[0])) {
                      $size_w = $size_[0];
                    }
                    if (isset($size_[1])) {
                      $size_h = $size_[1];
                    } else {
                      $size_h = '';
                    }
                    $image = wp_get_attachment_url($thumbnail_id, 'full');
                    if ($size_h != '') {
                      $image = ajzaa_resize($image, $size_w, $size_h, true);
                    } else {
                      $image = ajzaa_resize($image, $size_w, true);
                    }
                    ?>
                    <img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($cat->name) ?>"
                         width="<?php echo esc_attr($size_w) ?>" height="<?php echo esc_attr($size_h) ?>"/>
                    <?php
                  } else {
                    $image = wc_placeholder_img_src();
                    ?>
                    <img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($cat->name) ?>"/>
                    <?php
                  }
                  ?>
                </a>
              </div>
              <div class="large-7 columns cat_text">
                <a href="<?php echo esc_url($cat_link); ?>">
                  <h3><?php echo $cat->name; ?></h3>
                </a>
                <ul>
                  <?php
                  $product_sub_cat = get_terms(
                    'product_cat',
                    array(
                      'parent' => $cat->term_id,
                      'hierarchical' => true,
                      'hide_empty' => false,
                    )
                  );
                  $i = 0;
                  foreach ($product_sub_cat as $sub_cat) {
                    $cat_count = count($product_sub_cat);
                    if ($cat_count <= $items_per_cat) {
                      ?>
                      <li><a
                          href="<?php echo esc_url(get_term_link($sub_cat)); ?>"><?php echo esc_html($sub_cat->name) ?></a>
                      </li>
                      <?php
                    } else {
                      if ($i < $items_per_cat) {
                        ?>
                        <li><a
                            href="<?php echo esc_url(get_term_link($sub_cat)); ?>"><?php echo esc_html($sub_cat->name) ?></a>
                        </li>
                        <?php
                      } else {
                        break;
                      }
                    }
                    $i++;
                  }
                  ?>
                </ul>
              </div>
            </li>
            <?php
          }
        }
        ?>
      </ul>
    </div>
    <?php


    return ob_get_clean();
  }

  add_shortcode('ajzaa_product_cat', 'ajzaa_product_cat');
}
