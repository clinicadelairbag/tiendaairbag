<?php
$ajzaa_page_titlebar_bmargin = get_post_meta(get_queried_object_id(), "ajzaa_page_titlebar_bmargin", true)
?>

<div class="wd-title-bar"  <?php if($ajzaa_page_titlebar_bmargin){ ?>style="margin-bottom: <?php echo esc_attr($ajzaa_page_titlebar_bmargin); ?>;" <?php } ?>>
	<div class="row">
		<div class="large-12 columns wd-title-section_l">
			<?php
      if(is_archive()){ ?>
        <h2 id="page-title" class="title">
          <?php if(is_category()){
            echo esc_html__('Category Archives', 'ajzaa');
            echo "  ". strip_tags ( category_description() );
          }elseif( is_tag() ) {
            echo esc_html__('Tag Archives',  'ajzaa');
          }elseif( is_year() ){
            echo esc_html__('Yearly Archives', 'ajzaa');
          }elseif( is_month() ){
            echo esc_html__('Monthly Archives', 'ajzaa');
          }elseif( is_date() ){
            echo esc_html__('Daily Archives', 'ajzaa');
          }elseif( is_author() ){
            echo esc_html__('Author Archives', 'ajzaa');
          } ?>
        </h2> <?php
      }elseif (ajzaa_is_blog()){
				$page_for_posts = get_option( 'page_for_posts' );
				if($page_for_posts != 0) {
				?>
				<h2><?php echo get_the_title($page_for_posts); ?></h2>
				<h5><?php echo esc_html__('Our Latest Blog Posts', 'ajzaa'); ?></h5>
			  <?php
			  }else{ ?>
			  	<h2><?php echo esc_html__('Blog', 'ajzaa'); ?></h2>
				<h5><?php echo esc_html__('Our Latest Blog Posts', 'ajzaa'); ?></h5>
			  <?php
			  }

			}elseif(is_search()){ ?>
				<h2><?php echo esc_html__('Search Result of', 'ajzaa') .': '. get_search_query( false ); ?></h2>
				<?php
			}else {
				the_title( '<h2>', '</h2>' );
				if ( ! empty( $ajzaa_page_sub_title ) ) { ?>
					<h5><?php echo esc_html($ajzaa_page_sub_title) ?></h5>
				<?php }
			} ?>
		</div>

	</div>
</div>