<?php get_header();
get_template_part('parts/titlebar/titlebar', '1');
?>

	<main id="l-main" class="row ">
		<div class="large-8 main columns">
      <?php if(have_posts()) : ?>
	      <div class="blog-page">
				<ul>
         <?php while(have_posts()) : the_post();
	         /*
						* Include the post format-specific template for the content. If you want to
						* use this in a child theme, then include a file called called content-___.php
						* (where ___ is the post format) and that will be used instead.
						*/
	         get_template_part('content', get_post_format());
         endwhile; ?>
				 </ul>
         </div>
      <?php endif;
      wp_reset_query();
      ?>

			<div class="wd-pagination">
				<?php
				global $wp_query;
				$big = 999999999;
				echo paginate_links(array('base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format' => '?paged=%#%', 'current' => max(1, get_query_var('paged')), 'total' => $wp_query->max_num_pages,
					'prev_text' => esc_html__('prev', 'ajzaa'), 'next_text' => esc_html__('Next', 'ajzaa'),));
				?>
			</div>
			<?php if(comments_open()) {
				comments_template('', true);
			} ?>
		</div>

		<?php get_sidebar(); ?>

	</main>


<?php get_footer(); ?>