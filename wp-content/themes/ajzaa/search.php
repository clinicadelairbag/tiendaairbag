<?php 
get_header();

get_template_part( 'parts/titlebar/titlebar', '1' ); ?>

	<main id="l-main" class="row ">
		<div class="large-8 main columns search-result">
			<?php if ( have_posts() ) { ?>
				<?php while ( have_posts() ) {
					the_post(); ?>
					<article <?php post_class( 'result ajzaa_multi_post_masonry' ); ?>>

						<div class="ajzaa_multi_post_masonry_info">
							<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
							<div>
								<span><?php the_author() ?></span>
								<span>  <?php echo get_the_date() ?>  </span>
								<?php the_category() ?>

							</div>
							<div class="wd-redmore"><a
									href="<?php the_permalink() ?>"><?php echo esc_html__("Continue", 'ajzaa') ?></a><i
									class="ion-ios-arrow-thin-right"></i></div>
						</div>
					</article>
				<?php }
			}else {

				if ( is_search() ) { ?>
					<div class="no-result large-push-3 large-8">
						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ajzaa' ); ?></p>
            <section class="large-centered columns">
              <form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="serch" method="get">
                <input type="text" class="text-input" id="s" name="s" value="<?php echo esc_html__("Search...", 'ajzaa') ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
                <input  type="submit" class="submit-input" value="<?php echo esc_html__("Search", 'ajzaa') ?>">
              </form>
            </section>
					</div>

				<?php }else { ?>
					<div class="no-result large-push-3 large-6">
						<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ajzaa' ); ?></p>
						<?php get_search_form(); ?>
					</div>
					<?php
				}
	    }
			 ?>
		</div>
		<?php get_sidebar(); ?>
	</main>

<?php get_footer(); ?>