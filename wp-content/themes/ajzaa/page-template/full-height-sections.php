<?php 
/*
Template Name: Full Page Sections
*/


//// Get include the header
get_header();

if(get_post_meta(get_queried_object_id(), "show_titlebar", true) != "no" && !is_front_page()) {
	get_template_part( 'parts/titlebar/titlebar', '1' );
}else{ ?>
  <div class="ajzaa_empty_space" data-heightmobile="10" data-heighttablet="20" data-heightdesktop="30"></div>
<?php } ?>

<!-- content  -->
<main class="l-main full-page" id="content">
	<div class="main row">
		<?php if (have_posts()) :
			while (have_posts()) : the_post(); ?>
				<article>
					<div class="body field">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile;
		endif; ?>
		<?php if (comments_open()){
			comments_template( '', true );
		} ?>
	</div>
</main>
<!-- /content  -->

<?php get_footer(); ?>
