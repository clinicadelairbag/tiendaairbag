<?php get_header(); ?>

    <div class="wd-title-bar">
      <div class="row">
        <div class="large-12 columns wd-title-section_l">
          <h2><?php the_title(); ?></h2>
          </div>
        </div>
    </div>

			<main id="l-main" class="row single-post">
        <div class="large-8 main column">
          <?php if (have_posts()) :
              while (have_posts()) : the_post();
            ?>
          <div class="blog-page">


					<?php switch (get_post_format()){
						case "gallery" : ?>
							 <ul class="ajzaa_blog_post_gallery_masonry">
								  	<?php $portfolio_image_gallery_val = get_post_meta(get_the_ID(), 'ajzaa_portfolio-image-gallery', true);
										if ($portfolio_image_gallery_val != '')
										 $portfolio_image_gallery_array = explode(',', $portfolio_image_gallery_val);
											if (isset($portfolio_image_gallery_array) && count($portfolio_image_gallery_array) != 0) :
												foreach ($portfolio_image_gallery_array as $gimg_id) :
													$thumb = wp_get_attachment_image_src($gimg_id, 'full');
														$image = ajzaa_resize( $thumb[0],840, 420 , true );
													echo '<li><img src="' . esc_attr($image) . '"/></li>';
												endforeach;
											endif;
								  	?>
							   </ul>
							<?php
						 break;
						case "video" :
							 $_video_type = get_post_meta(get_the_ID(), "video_type", true);?>

									<?php if($_video_type == "youtube") { ?>
										<iframe width="100%" height="<?php echo esc_attr($ajzaa_image_size_h); ?>" src="https://www.youtube.com/embed/<?php echo esc_url(get_post_meta(get_the_ID(), "ajzaa_youtube_link", true));  ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>

									<?php } else if ($_video_type == "vimeo"){ ?>
										
										<iframe src="http://player.vimeo.com/video/<?php echo esc_url(get_post_meta(get_the_ID(), "ajzaa_vimeo_id", true));  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						
									<?php } else if ($_video_type == "self_hosted"){ ?>

										<video
							        controls preload="auto" width="<?php echo esc_attr($ajzaa_image_size_w); ?>" height="<?php echo esc_attr($ajzaa_image_size_h); ?>" >
							       <source src="<?php echo esc_url(get_post_meta(get_the_ID(), "ajzaa_video_mp4", true)) ?>" type='video/mp4' />
							       <source src="<?php echo esc_url(get_post_meta(get_the_ID(), "ajzaa_video_webm", true))?>" type='video/webm' />
							       <source src="<?php echo esc_url(get_post_meta(get_the_ID(), "ajzaa_video_ogv", true));  ?>" type='video/ogg' />

							      </video>

								<?php }
						break;
						default;
						  the_post_thumbnail('ajzaa_blog-thumb');
						 break;
					}

					 ?>

						<div class="blog-body clearfix p-t-20">
							<?php the_content() ?>
						</div>
								<ul class="post-infos">
									<li class="author">
										<?php echo esc_html__('POSTED BY:','ajzaa') ?> <a href="<?php the_author_link() ?>"><?php the_author() ?></a>
									</li>
									<li class="date">
										<?php the_date(); ?>
									</li>
									<li class="category">
										<?php  the_category(', '); ?>
									</li>
								</ul>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ajzaa' ), 'after' => '</div>' ) ); ?>
		            <div class="wd-tages">


										<?php $ajzaa_posttags = get_the_tags();
										?>
									<ul class="tags">
										<?php if(has_tag()){ ?>
											<?php the_tags('', '', ''); ?>
										<?php } ?>
									</ul>


		            </div>
					<?php if(get_the_author_meta('description') != '') { ?>
								<div class="author-section">
									<div class="author-thumbnail">
										<?php echo get_avatar( get_the_author_meta('email') , 90 ); ?>
										<div class="contact-me">
											<a href="<?php echo get_the_author_meta('email') ?>" ><img src="<?php echo get_template_directory_uri() ?>/images/envelope.png" alt="me"></a>
										</div>
									</div>
									<div class="author-body">
										<h5 class="author-name"><?php echo get_the_author(); echo esc_html__(' / About Author','ajzaa'); ?> </h5>
										<div class="author-desc">
											<p><?php echo get_the_author_meta('description'); ?></p>
										</div>
										<div class="more-posts">
											<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo esc_html__('More posts by ','ajzaa'); echo get_the_author(); ?></a>
										</div>
									</div>
								</div>
								<?php }
					  ajzaa_related_post(); ?>
		            <?php if (comments_open()){ ?>
		             <div class="post-infos clearfix">
			            <h4 class="comment-count"><?php comments_number( esc_html__('NO COMMENTS','ajzaa'), esc_html__('ONE COMMENT','ajzaa'), esc_html__('% COMMENTS','ajzaa') ); ?></h4>

		            </div>
		            <?php } ?>
	            </div>

	            <?php if (comments_open()|| get_comments_number()){
		              comments_template( '', true );
		            }
				endwhile;
				endif;
							?>

            </div>
           <?php get_sidebar(); ?>
        </main>

<?php get_footer(); ?>