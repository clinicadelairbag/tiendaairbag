<?php
//Sections Our Models

function ajzaa_single_product_supplier($atts)
{
  extract(shortcode_atts(array(
    'number_rows' => '1',
    'number_items' => '6',
    'margin' => '',
    'size' => '',
    'show_title' => '',
    'layout' => 'grid',
  ), $atts));
  ob_start();
  ?>
  <?php
  $product_tax_parents = get_terms(array(
    'taxonomy' => 'product_provider',
    'hide_empty' => false,
  ));
  if ($layout == 'grid') {
    $class = 'small-block-grid-1 large-block-grid-' . $number_rows;
  } elseif ($layout == 'carousel') {
    $class = 'suppliers_carousel owl-theme';
  }
  ?>
  <ul class="<?php echo $class; ?> product_meta product_supplier" <?php $layout == 'carousel' ? print'data-showdesktop="'.$number_rows.'"': '' ?>>
    <?php
    $i = 0;
    foreach ($product_tax_parents as $parent) {

      $i++;
      $image_id = get_term_meta($parent->term_id, 'showcase-taxonomy-image-id', true);
      $cat_link = get_term_link($parent);
      if ($i <= $number_items) {
      ?>
      <li <?php if($margin != '') echo "style='margin-bottom: $margin;'" ?>" class="<?php $layout == 'carousel' ? print'item' : '' ?>">
        <span>
          <a href="<?php echo esc_url($cat_link); ?>">
            <?php
            $sap = str_replace(array('X', 'x'), 'X', $size);
            $ajzaa_image_size_ = explode('X', $sap);
            if (isset($ajzaa_image_size_[0])) {
              $ajzaa_image_size_w = $ajzaa_image_size_[0];
            }
            if (isset($ajzaa_image_size_[1])) {
              $ajzaa_image_size_h = $ajzaa_image_size_[1];
            } else {
              $ajzaa_image_size_h = '';
            }

            $ajzaa_image_url = wp_get_attachment_url($image_id, 'full');
            if ($ajzaa_image_size_h != '') {
              $image = ajzaa_resize($ajzaa_image_url, $ajzaa_image_size_w, $ajzaa_image_size_h, true);
            } else {
              $image = ajzaa_resize($ajzaa_image_url, $ajzaa_image_size_w, true);
            }
            if ($image == false) { ?>
              <img src="<?php echo $ajzaa_image_url ?>" alt='<?php echo $parent->slug; ?>'>
            <?php } else { ?>
              <img src="<?php echo esc_attr($image) ?>" alt='<?php echo $parent->slug; ?>'>
            <?php }
            if ($show_title) { ?>
              <span class="posted_in"> <?php echo $parent->name ?><?php if ($parent->count > 0) echo "($parent->count)"; ?> </span>
              <?php
            }
            ?>
          </a>
        </span>
      </li>
      <?php
      } else { break; } ?>

      <?php
    }
    ?>
  </ul>
  <?php return ob_get_clean();

}

add_shortcode('ajzaa_single_product_supplier', 'ajzaa_single_product_supplier');