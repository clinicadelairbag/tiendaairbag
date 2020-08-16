<?php
/*
Template Name: Left Sidebar
*/


//// Get include the header
get_header();

if(get_post_meta(get_queried_object_id(), "show_titlebar", true) != "no" && !is_front_page()) {
    get_template_part( 'parts/titlebar/titlebar', '1' );
}else{ ?>
  <div class="ajzaa_empty_space" data-heightmobile="10" data-heighttablet="20" data-heightdesktop="30"></div>
<?php } ?>

<!-- content  -->
<main class="l-main left-sidebar" id="content">
    <div class="main row">

      <div class="small-12 large-3 columns">
        <?php get_sidebar( 'shop' ); ?>
      </div>

        <div class="small-12 large-9 columns">
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
    </div>
</main>
<!-- /content  -->

<?php get_footer(); ?>
