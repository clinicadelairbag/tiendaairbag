
<?php
//Sections Our Models

function ajzaa_single_product_carmodel_sc()
{
    ob_start();
    ?>
    <?php
    $product_tax_parents = get_terms(array(
        'taxonomy' => 'product_provider',
        'hide_empty' => false,
    ));
    ?>
    <ul class="small-block-grid-1 large-block-grid-3 product_meta">
        <?php
        foreach ($product_tax_parents as $parent) {
            $image_id = get_term_meta ( $parent->term_id, 'showcase-taxonomy-image-id', true );
            ?>
            <li>
                <?php echo wp_get_attachment_image ( $image_id, 'large' ); ?>
                <span class="posted_in">
                      <?php echo $parent->name ?><?php if($parent->count==0) {echo "";}elseif ($parent->count>0){echo "(".$parent->count.")";} ?>
                </span>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php return ob_get_clean(); }
add_shortcode('ajzaa_single_product_carmodel', 'ajzaa_single_product_carmodel_sc');