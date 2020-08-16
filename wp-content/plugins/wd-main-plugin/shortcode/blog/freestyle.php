<?php 


	$ajzaa_counter = 0;
	
?>
<div class="large-8 columns">
	<?php $loop = new WP_Query( array( 'post_type' => 'post','posts_per_page'=>3) );
	    while ( $loop->have_posts() ) : $loop->the_post(); 
		$do_not_duplicate[] = get_the_ID();
		$ajzaa_counter++;
		$ajzaa_one_post_format = get_post_format();
		switch ($ajzaa_one_post_format) {
         case 'gallery':
             include( plugin_dir_path( __FILE__ ).'wd-content-gallery.php');
             break;
			 
         case 'video':
            include( plugin_dir_path( __FILE__ ).'wd-content-video.php');
             break;
		case 'quote':
			
             include( plugin_dir_path( __FILE__ ).'wd-content-quote.php');
        	break;
			case 'audio':
             include( plugin_dir_path( __FILE__ ).'wd-content-sound.php');
        	 break;
         default:
             include( plugin_dir_path( __FILE__ ).'wd-content.php');
             break;
     }
		endwhile; 
		wp_reset_query(); 
 ?>
</div>
<div class="large-4 columns">
	<?php $loop = new WP_Query( array( 'post_type' => 'post','posts_per_page'=>1,'post__not_in' => $do_not_duplicate) );
	    while ( $loop->have_posts() ) : $loop->the_post(); 
		if ( in_array( get_the_ID(), $do_not_duplicate ) ) continue;
		$ajzaa_counter++;
		$ajzaa_one_post_format = get_post_format();
		switch ($ajzaa_one_post_format) {
         case 'gallery':
             include( plugin_dir_path( __FILE__ ).'wd-content-gallery.php');
             break;
			 
         case 'video':
            include( plugin_dir_path( __FILE__ ).'wd-content-video.php');
             break;
		case 'quote':
			
             include( plugin_dir_path( __FILE__ ).'wd-content-quote.php');
        	break;
			case 'audio':
             include( plugin_dir_path( __FILE__ ).'wd-content-sound.php');
        	 break;
         default:
             include( plugin_dir_path( __FILE__ ).'wd-content.php');
             break;
     }
		endwhile; 
		wp_reset_query(); 
 ?>
</div>