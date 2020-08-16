<?php



class wd_recent_projects extends WP_Widget {

  function __construct() {

    parent::__construct(false, $name = 'Latest Projects');

  }



  function form($instance) {

    $title = esc_attr($instance['title']);

    $dis_posts = esc_attr($instance['dis_posts']);

    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </label>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('dis_posts'); ?>"><?php _e('Number of Posts Displayed:'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('dis_posts'); ?>" name="<?php echo $this->get_field_name('dis_posts'); ?>" type="number" value="<?php echo $dis_posts; ?>" />
      </label>
    </p>
    <?php

  }





  function widget($args, $instance) {

    extract( $args );

    $title = apply_filters('widget_title', $instance['title']);

    $dis_posts = $instance['dis_posts'];


    ?>

    <?php echo $before_widget; ?>

    <?php if ( $title )

      echo $before_title . $title . $after_title;

    global $wp_registered_sidebars;

    foreach ($wp_registered_sidebars as $value){



      if($value['name']=='footer'){

        $class="black-separateur";

      }else{

        $class="";

      }

    }



    ?>

    <ul class="carousel_projects projects small-block-grid-3 large-block-grid-3 owl-theme">
      <?php
      $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => $dis_posts ,
        'order' => 'DESC',
        'exclude'     => get_post_thumbnail_id(),
      );
      $loop = get_posts($args);
      $results = array_chunk($loop, "2");
      foreach ($results as $result) { ?>
        <div class="container">
            <?php foreach ($result as $data) {
              $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($data->ID), 'plasticfactory_small-thumb');

              ?>

              <li><a href="<?php the_permalink($data->ID); ?>"><img src="<?php echo $thumb[0];?>"></a></li>
            <?php }  ?>
        </div>
        <?php
      }
      ?>
    </ul>

    <?php echo $after_widget; ?>

    <?php

  }

}



add_action('widgets_init', create_function('', 'return register_widget("wd_recent_projects");'));