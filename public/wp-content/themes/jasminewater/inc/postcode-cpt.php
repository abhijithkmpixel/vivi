<?php
/**
 * Register a custom post type called "Postcode".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_postcode_new_init() {
  $labels = array(
      'name'                  => _x( 'Postcode / Zip', 'Post type general name', 'textdomain' ),
      'singular_name'         => _x( 'Postcode / Zip', 'Post type singular name', 'textdomain' ),
      'menu_name'             => _x( 'Postcode / Zip', 'Admin Menu text', 'textdomain' ),
      'name_admin_bar'        => _x( 'Postcode / Zip', 'Add New on Toolbar', 'textdomain' ),
      'add_new'               => __( 'Add New', 'textdomain' ),
      'add_new_item'          => __( 'Add New Postcode / Zip', 'textdomain' ),
      'new_item'              => __( 'New Postcode / Zip', 'textdomain' ),
      'edit_item'             => __( 'Edit Postcode / Zip', 'textdomain' ),
      'view_item'             => __( 'View Postcode / Zip', 'textdomain' ),
      'all_items'             => __( 'All Postcode / Zip', 'textdomain' ),
      'search_items'          => __( 'Search Postcode / Zip', 'textdomain' ),
      'parent_item_colon'     => __( 'Parent Postcode / Zip:', 'textdomain' ),
  );

  $args = array(
      'labels'             => $labels,
      'public'             => false,
      'publicly_queryable' => false,
      'taxonomies'         => array('postcode_category'),
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      // 'rewrite'            => array( 'slug' => 'postcode' ),
      'capability_type'    => 'post',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'menu_icon'          => 'dashicons-format-aside',
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
  );

  register_post_type( 'postcodes', $args );
}

add_action( 'init', 'wpdocs_codex_postcode_new_init' );