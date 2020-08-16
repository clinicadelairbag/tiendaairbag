<?php
//// Get include the header
get_header();
if(get_post_meta(get_queried_object_id(), "show_titlebar", true) != "no" && !is_front_page()) {
	get_template_part('parts/titlebar/titlebar', '1');
} ?>

	<!-- content  -->

	<main class="l-main" id="content">
		<div class="main row">	
		  <?php if(have_posts()) :
			  while(have_posts()) : the_post();
				  global $more;
				  $more = true;
				  ?>
				  <article class="large-12 columns">
  				<div class="body field clearfix">
  					<?php the_content('More');
					?>
  				</div>
					  <?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'ajzaa'),
						  'after' => '</div>')); ?>
					  <?php
					  if(comments_open()) {
						  comments_template('', true);
					  } ?>
        </article>


			  <?php endwhile;
		  endif;
		  wp_reset_query();
		  ?>
			
		</div>  
	</main>

	<!-- /content  -->


<?php get_footer(); ?>