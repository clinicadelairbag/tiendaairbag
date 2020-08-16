<ul class="wd-portfolio-carousel">
	<?php	
	
	global $wp_query;
	if( count($ajzaa_category_array) == 1 )
    {
      query_posts( array( 'post_type' => 'portfolio' ));
    }
    if( count($ajzaa_category_array) > 1 ) {
      query_posts( array( 
                          'post_type' => 'portfolio', 
                          'tax_query' => array( 
                                                 'relation' => 'AND', 
                                                 array( 
                                                        'taxonomy' => 'portfolio_categories', 
                                                        'field' => 'slug',
                                                        'terms' => $ajzaa_category_array
                                                      ) 
                                              ) 
                        ) 
      );
    }
    
    while ( have_posts() ) : the_post(); ?>
  	<li class="wd-portfolio-carousel-item">
  	<div class="large-12 clearfix">
  		<div class="wd-portfolio-carousel-item-text large-4 column">
	  		<<?php echo esc_attr($portfolio_title_tag); ?> class="portfolio-title">
		      <a href="<?php the_permalink(); ?>" style="<?php echo esc_attr($custom_portfolio_title_inline_style); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	      </<?php echo esc_attr($portfolio_title_tag); ?>>
	      <div class="wd-portfolio-carousel-item-tags" style="<?php echo esc_attr($custom_portfolio_tags_inline_style); ?>">
	        <?php
	        $terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
	        if ( $terms && ! is_wp_error( $terms ) ) {
	          foreach ( $terms as $term ) {
	            echo esc_attr($term->name) . "<span> ,</span>";
	          }
	        ?>
	        <?php } ?>
	      </div>
	      <p class="wd-portfolio-carousel-item-description"><?php echo wp_trim_words(get_the_content(),26); ?></p>
        <a href="<?php the_permalink(); ?>" class="view-project">View Project <i class="ion-ios-arrow-thin-right"></i></a>
	  	</div>
	  	<div class="wd-portfolio-carousel-item-image large-8 column">
	  		<?php $thumb = get_post_thumbnail_id(); $img_url = wp_get_attachment_url( $thumb,'full' ); $image = ajzaa_resize( $img_url, 700, 601, true, true, true); ?>
	      <img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>
	  	</div>
  	</div>
  	
  	</li>
	<?php endwhile;
	wp_reset_query();
	?>
</ul>