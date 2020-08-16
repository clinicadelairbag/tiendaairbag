	<?php get_header() ?>
				
	<?php get_template_part( 'parts/titlebar/titlebar', '1' ); ?>
	<main class="row l-main">
		
		<?php if (have_posts()) : ?>
	     <?php while (have_posts()) : the_post(); ?>
			<article>
			<div class="wd-portfolio-single-portfolio-tags large-8 column">
          <?php
          $terms = get_the_terms( $post->ID, 'portfolio_categories' );
          if ( $terms && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
              echo   $term->name . "<span> ,</span>";
            }
          ?>
          <?php } ?>
        </div>
        <div class="large-4 column portfolio-next-prev">
					<?php previous_post_link('%link', 'Prev') ?>
        	<?php next_post_link('%link', 'Next') ?>
        </div>
        <?php 
        $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', true);
        $ajzaa_portoflio_post_format = get_post_format();
        switch ($ajzaa_portoflio_post_format) {
        	case 'video':
		        	switch ($portfolio_type) {
		        		case 'video_youtube':
		        			?>
		        			<div class="Portfolio-image">
			        			<iframe width="100%" height="600" src="https://www.youtube.com/embed/<?php echo esc_url(get_post_meta(get_the_ID(), "portfolio_youtube_link", true));  ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
			        		</div>
		        			<?php
		        			break;
		        			case 'video_vimeo':
		        			?>
		        			<div class="Portfolio-image">
										<iframe src="https://player.vimeo.com/video/<?php echo esc_url(get_post_meta(get_the_ID(), "portfolio_vimeo_id", true));  ?>?color=faee05&title=0&byline=0&portrait=0" width="100%" height="700" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			        		</div>
		        			<?php 
		        			break;
		        			case 'video_self_hosted':
			        		?>
				        		<video controls preload="auto" width="723" height="287" >
								       <source src="<?php echo esc_url(get_post_meta(get_the_ID(), "portfolio_video_mp4", true)) ?>" type='video/mp4' />
								       <source src="<?php echo esc_url(get_post_meta(get_the_ID(), "portfolio_video_webm", true))?>" type='video/webm' />
								       <source src="<?php echo esc_url(get_post_meta(get_the_ID(), "portfolio_video_ogv", true));  ?>" type='video/ogg' />
							      </video>
		        			<?php
		        		default:
		        			?>
		        			<div class="Portfolio-image">
			        			<iframe width="100%" height="600" src="https://www.youtube.com/embed/<?php echo esc_url(get_post_meta(get_the_ID(), "portfolio_youtube_link", true));  ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
			        		</div>
		        			<?php
		        			break;
		        	}
        	break;
    			case 'audio':
    			?>
						<audio controls="controls">
				          <source  src="http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3" type="audio/mpeg">
				          <source src="http://upload.wikimedia.org/wikipedia/en/0/04/Rayman_2_music_sample.ogg" type="audio/ogg" preload="auto" >
				   	</audio>
    			<?php
    			break;
    			case 'gallery':
    			?>
    			<div class="Portfolio-image">
        		<ul class="wd-single-portfolio-carousel">  												
					  	<?php $portfolio_image_gallery_val = get_post_meta(get_the_ID(), 'ajzaa_portfolio-image-gallery', true);
							if ($portfolio_image_gallery_val != '')
							 $portfolio_image_gallery_array = explode(',', $portfolio_image_gallery_val);
								if (isset($portfolio_image_gallery_array) && count($portfolio_image_gallery_array) != 0) :
									foreach ($portfolio_image_gallery_array as $gimg_id) :
										$thumb = wp_get_attachment_image_src($gimg_id, 'full');
										$image = ajzaa_resize( $thumb[0], 1170, 650 , true, true, true );
										echo '<li><img src="' . esc_url($image) . '"/></li>';
									endforeach;
								endif;
					  	?>
				   	</ul>
			 		</div>
    			<?php
        	default:
        		?>
						<div class="Portfolio-image">
							<?php $thumb = get_post_thumbnail_id(); $img_url = wp_get_attachment_url( $thumb,'full' ); $image = ajzaa_resize( $img_url, 1170, 650, true, true, true ); ?>
		          <img src="<?php echo esc_attr($image); ?>" alt="<?php the_title(); ?>"/>
						</div>
        		<?php
        	break;
        }
         ?>
				
			
				<div class="portfolio-body clearfix">
					<div class="large-8 column">
						<div class="portfolio-text">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="large-4 column portfolio-infos-container">
						<div class="portfolio-infos">
						<ul>
							<?php if (esc_attr(get_post_meta(get_the_ID(), 'portfolio_client_name', true)) != ""){ ?>
							<li class="client-infos">
								<span><i class="ion-android-star-outline"></i><?php echo esc_html__('Client :','ajzaa') ?> </span>
								<span class="client"><?php echo esc_attr(get_post_meta(get_the_ID(), 'portfolio_client_name', true)); ?></span>
							</li>
							<?php } ?>
							<?php if (esc_attr(get_post_meta(get_the_ID(), 'portfolio_period', true)) != ""){ ?>
								<li class="period-infos">
								<span><i class="ion-ios-calendar-outline"></i><?php echo esc_html__('Period :','ajzaa') ?> </span>
								<span class="period"><?php echo esc_attr(get_post_meta(get_the_ID(), 'portfolio_period', true)); ?></span>
								</li>
							<?php } ?>
							<?php if (esc_attr(get_post_meta(get_the_ID(), 'portfolio_location', true)) != ""){ ?>
								<li class="location-infos">
									<span><i class="ion-ios-location-outline"></i><?php echo esc_html__('Location :','ajzaa') ?> </span>
									<span class="location"><?php echo esc_attr(get_post_meta(get_the_ID(), 'portfolio_location', true)); ?></span>
								</li>
							<?php } ?>
							<?php if (esc_attr(get_post_meta(get_the_ID(), 'portfolio_author', true)) != ""){ ?>
								<li class="author-infos">
									<span><i class="ion-ios-person-outline"></i><?php echo esc_html__('Author :','ajzaa') ?> </span>
									<span class="author"><?php echo esc_attr(get_post_meta(get_the_ID(), 'portfolio_author', true)); ?></span>
								</li>
							<?php } ?>
						</ul>
						</div>
						<div class="share-icons">
						<span><?php echo esc_html__("share :", 'ajzaa') ?> </span>
							<ul>
								<li><a id="twitter" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Tweet" href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a id="facebook" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Like" href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a id="pinterest" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="Like" href="#"><i class="ion-social-pinterest"></i></a></li>
								<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
								<li><a href="#"><i class="ion-social-dribbble-outline"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				

			</article>
			 <?php endwhile;
			endif;
				?>

				<div class="related-portfolio">
				<h4><?php echo esc_html__("Related Projects", 'ajzaa') ?></h4>
					<?php 
							$terms = get_the_terms( $post->ID , 'portfolio_categories', 'string');
							$term_ids = wp_list_pluck($terms,'term_id');
							  $loop = new WP_Query( array(
							      'post_type' => 'portfolio',
							      'tax_query' => array(
							                    array(
							                        'taxonomy' => 'portfolio_categories',
							                        'field' => 'id',
							                        'terms' => $term_ids,
							                        'operator'=> 'IN'
							                     )),
							      'posts_per_page' => 3,
							      'ignore_sticky_posts' => 1,
							      'orderby' => 'rand',
							      'post__not_in'=>array($post->ID)
							   ) );

							    if($loop->have_posts()) {
							    	?>
							    	<ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1">
							    	<?php
								     while ($loop->have_posts() ) : $loop->the_post(); ?>
								      <li class="single_related">
								          <div class="wd-portfolio-related-item-image">
						                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						                    <?php $thumb = get_post_thumbnail_id(); $img_url = wp_get_attachment_url( $thumb,'full' ); $image = ajzaa_resize( $img_url, 370, 314, true, true, true ); ?>
						                    <img src="<?php echo esc_attr($image) ?>" alt="<?php the_title(); ?>"/>
						                  </a>
						                </div>
						                <div class="wd-portfolio-related-item-text-container">
						                  <div class="wd-portfolio-related-item-text">

						                    <h6 class="portfolio-title">
						                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						                    </h6>
						                  </div>

						                  <div class="wd-portfolio-related-item-tags">
						                    <?php
						                    $terms = get_the_terms( $post->ID, 'portfolio_categories' );
						                    if ( $terms && ! is_wp_error( $terms ) ) {
						                      foreach ( $terms as $term ) {
						                        echo   $term->name . "<span> ,</span>";
						                      }
						                    ?>
						                    <?php } ?>
						                  </div>
						                </div>

								       </li>
								   <?php endwhile;
								   ?>
								   </ul>
							   <?php } ?>

				</div>
	</main>
	<?php get_footer(); ?>