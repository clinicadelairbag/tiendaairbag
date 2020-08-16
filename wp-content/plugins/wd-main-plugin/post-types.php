<?php

/*-------------- portfolio custom posttyp -----------------------*/
if( ! function_exists('ajzaa_portfolio_posttype')):
  function ajzaa_portfolio_posttype() {
    register_post_type( 'portfolio',
      array(
        'labels' => array(
          'name' => __( 'Portfolio', 'ajzaa' ),
          'singular_name' => __( 'portfolio', 'ajzaa' ),
          'add_new' => __( 'Add New Portfolio Item', 'ajzaa' ),
          'add_new_item' => __( 'Add New Portfolio Item', 'ajzaa' ),
          'edit_item' => __( 'Edit portfolio', 'ajzaa' ),
          'new_item' => __( 'Add New Portfolio Item', 'ajzaa' ),
          'view_item' => __( 'View Portfolio Item', 'ajzaa' ),
          'search_items' => __( 'Search Portfolio Item', 'ajzaa' ),
          'not_found' => __( 'No Portfolio Item found', 'ajzaa' ),
          'not_found_in_trash' => __( 'No Portfolio Item found in trash', 'ajzaa' )
        ),
        'public' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array( 'title', 'comments','editor' , 'thumbnail'),
        'capability_type' => 'post',
        'rewrite' => array("slug" => "portfolio"), // Permalinks format
        'menu_position' => 5
      )
    );
    register_taxonomy( 'portfolio_categories', 'portfolio', array( 'hierarchical' => true,
      'label' => 'Categories',
      'query_var' => true,
      'show_ui' => true,
      'rewrite' => true ) );
  }
  add_action( 'init', 'ajzaa_portfolio_posttype' );
endif;


//----------------------- Custom type Team Member -----------------
if( ! function_exists('ajzaa_team_member_post_type')):
  function ajzaa_team_member_post_type() {
    register_post_type( 'wd-team-member',
      array(
        'labels' => array(
          'name' => __( 'Team Members', 'ajzaa' ),
          'singular_name' => __( 'team member', 'ajzaa' ),
          'add_new' => __( 'Add New Team Member', 'ajzaa' ),
          'add_new_item' => __( 'Add New Team Member', 'ajzaa' ),
          'edit_item' => __( 'Edit Team Member', 'ajzaa' ),
          'new_item' => __( 'Add New Team Member', 'ajzaa' ),
          'view_item' => __( 'View Team Member', 'ajzaa' ),
          'search_items' => __( 'Search Team Member', 'ajzaa' ),
          'not_found' => __( 'No Team Member found', 'ajzaa' ),
          'not_found_in_trash' => __( 'No Team Member found in trash', 'ajzaa' )
        ),
        'public' => true,
        'menu_icon' => 'dashicons-businessman',
        'supports' => array( 'title'),
        'capability_type' => 'post',
        'rewrite' => array("slug" => "wd-team-member"), // Permalinks format
        'menu_position' => 5
      )
    );
  }
  add_action( 'init', 'ajzaa_team_member_post_type' );
endif;
//----------------------- Custom type Testimonials -----------------
if( ! function_exists('ajzaa_testimonials_posttype')):
  function ajzaa_testimonials_posttype() {
    register_post_type( 'testimonials',
      array(
        'labels' => array(
          'name' => __( 'Testimonials', 'ajzaa' ),
          'singular_name' => __( 'testimonials', 'ajzaa' ),
          'add_new' => __( 'Add New Testimonial Item', 'ajzaa' ),
          'add_new_item' => __( 'Add New Testimonial Item', 'ajzaa' ),
          'edit_item' => __( 'Edit testimonials', 'ajzaa' ),
          'new_item' => __( 'Add New Testimonial Item', 'ajzaa' ),
          'view_item' => __( 'View Testimonial Item', 'ajzaa' ),
          'search_items' => __( 'Search Testimonial Item', 'ajzaa' ),
          'not_found' => __( 'No Testimonial Item found', 'ajzaa' ),
          'not_found_in_trash' => __( 'No Testimonial Item found in trash', 'ajzaa' )
        ),
        'public' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array( 'title', 'comments','editor' , 'thumbnail','excerpt'),
        'capability_type' => 'post',
        'rewrite' => array("slug" => "testimonials"), // Permalinks format
        'menu_position' => 5
      )
    );
    register_taxonomy( 'testimonials_categories', 'testimonials', array( 'hierarchical' => true,
      'label' => 'Categories',
      'query_var' => true,
      'show_ui' => true,
      'rewrite' => true ) );
  }
  add_action( 'init', 'ajzaa_testimonials_posttype' );
endif;

if( ! function_exists('ajzaa_product_tax')):
  function ajzaa_product_tax() {
    $labels = array(
      'name'              => _x( 'Models', 'taxonomy general name', 'ajzaa' ),
      'singular_name'     => _x( 'Model', 'taxonomy singular name', 'ajzaa' ),
      'search_items'      => __( 'Search Models', 'ajzaa' ),
      'all_items'         => __( 'All Models', 'ajzaa' ),
      'parent_item'       => __( 'Parent Model', 'ajzaa' ),
      'parent_item_colon' => __( 'Parent Model:', 'ajzaa' ),
      'edit_item'         => __( 'Edit Model', 'ajzaa' ),
      'update_item'       => __( 'Update Model', 'ajzaa' ),
      'add_new_item'      => __( 'Add New Model', 'ajzaa' ),
      'new_item_name'     => __( 'New Model Name', 'ajzaa' ),
      'menu_name'         => __( 'Model', 'ajzaa' ),
    );
    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array(
          'slug' => __('models', 'ajzaa'),
        'with_front' => false
      ),
    );
    register_taxonomy( 'product_tax', 'product', $args );
  }
  add_action( 'init', 'ajzaa_product_tax' );
endif;

if( ! function_exists('ajzaa_product_provider')):
  function ajzaa_product_provider() {
    $labels = array(
      'name'              => _x( 'Suppliers', 'taxonomy general name', 'ajzaa' ),
      'singular_name'     => _x( 'Supplier', 'taxonomy singular name', 'ajzaa' ),
      'search_items'      => __( 'Search Suppliers', 'ajzaa' ),
      'all_items'         => __( 'All Suppliers', 'ajzaa' ),
      'parent_item'       => __( 'Parent Supplier', 'ajzaa' ),
      'parent_item_colon' => __( 'Parent Supplier:', 'ajzaa' ),
      'edit_item'         => __( 'Edit Supplier', 'ajzaa' ),
      'update_item'       => __( 'Update Supplier', 'ajzaa' ),
      'add_new_item'      => __( 'Add New Supplier', 'ajzaa' ),
      'new_item_name'     => __( 'New Provider Name', 'ajzaa' ),
      'menu_name'         => __( 'Supplier', 'ajzaa' ),
    );
    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'genre' ),
    );
    register_taxonomy( 'product_provider', 'product', $args );
  }
  add_action( 'init', 'ajzaa_product_provider' );
endif;