<?php get_header() ?>
		

  <div class="corp">
		<div class="row">
      <section class="oops large-6 large-centered columns">
				<h3><?php echo esc_html__('OHH!! PAGE NOT FOUND', 'ajzaa'); ?></h3>
				<p class="message">
					<?php echo esc_html__('It seems we can\'t find what you\'re looking for. Perhaps searching can help or go back to ', 'ajzaa'); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><strong><?php echo esc_html__('Homepage', 'ajzaa'); ?>.</strong></a>
				</p>
			</section>
      <section class="large-6 large-centered columns">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="serch" method="get">
					   <input type="text" class="text-input" id="s" name="s" value="<?php echo esc_html__("Search...", 'ajzaa') ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
					   <input  type="submit" class="submit-input" value="<?php echo esc_html__("Search", 'ajzaa') ?>">
				    </form>
			</section>
		</div>	
	</div>

	<?php get_footer(); ?> 
