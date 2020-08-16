<?php 

if(! function_exists('ajzaa_dsm')){

  function ajzaa_dsm($var){

    print "<pre>" . print_r($var, true) . "</pre>";

  }

}



function ajzaa_is_blog() {

	global  $post;

	$posttype = get_post_type($post );

	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;

}

function ajzaa_get_post_category () {
  	$cat_name = get_the_terms( get_the_ID(), 'category' );
		$ajzaa_class_name = '';
			if( isset($cat_name) && $cat_name != null ) {          
            foreach ($cat_name as $cat) {
              $ajzaa_class_name .= ' ' . $cat->slug;
            }
		}
			return $ajzaa_class_name;
  }


function ajzaa_related_post () {
  global $post;
  $categories = get_the_category($post->ID);
  if ($categories) {
    $category_ids = array();
    foreach($categories as $individual_category) {
      $category_ids[] = $individual_category->term_id;
    }
    $args = array(
      'category__in' => $category_ids,
      'post__not_in' => array($post->ID),
      'posts_per_page'=> 6, // Number of related posts that will be shown.
      'ignore_sticky_posts'=> 1
    ); ?>
    <?php
    $my_query = new wp_query( $args );
    if( $my_query->have_posts() ) {
      ?>
      <h4 class="blog-heading"><?php echo esc_html__('related posts','ajzaa'); ?></h4>
      <div class="related-post-carousel owl-carousel">
        <?php
        while( $my_query->have_posts() ) {
          $my_query->the_post(); ?>
            <div class="related-post">
                <?php
                if(has_post_thumbnail()) {
                    ?>
                    <div class="related-post-thumbnail">
                        <?php the_post_thumbnail('ajzaa_related-post') ?>
                    </div>
                <?php } ?>
                <div class="related-post-body">
                    <ul class="flexed">
                        <li><span class="date_"><?php echo get_the_date();?></span></li>
                        <li>
                            <i class="fa fa-comments"></i>
                            <span><?php comments_number( "0", "1", "Comments" ); ?></span>
                        </li>
                        <li>
                            <i class="fa fa-tags"></i>
                            <?php the_category(); ?>
                        </li>
                    </ul>
                    <a href="<?php the_permalink(); ?>" class="related-post-title"><?php the_title(); ?></a>
                </div>
            </div>
          <?php
        } ?>
      </div>
    <?php }
  }
  wp_reset_query();
}
