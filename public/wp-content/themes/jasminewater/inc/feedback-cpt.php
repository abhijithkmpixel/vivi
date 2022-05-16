<?php
/**
 * Register a custom post type called "feedback".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_feedback_new_init() {
  $labels = array(
      'name'                  => _x( 'Feedbacks', 'Post type general name', 'textdomain' ),
      'singular_name'         => _x( 'Feedback', 'Post type singular name', 'textdomain' ),
      'menu_name'             => _x( 'Feedbacks', 'Admin Menu text', 'textdomain' ),
      'name_admin_bar'        => _x( 'Feedback', 'Add New on Toolbar', 'textdomain' ),
      'add_new'               => __( 'Add New', 'textdomain' ),
      'add_new_item'          => __( 'Add New Feedback', 'textdomain' ),
      'new_item'              => __( 'New Feedback', 'textdomain' ),
      'edit_item'             => __( 'Edit Feedback', 'textdomain' ),
      'view_item'             => __( 'View Feedback', 'textdomain' ),
      'all_items'             => __( 'All Feedbacks', 'textdomain' ),
      'search_items'          => __( 'Search Feedbacks', 'textdomain' ),
      'parent_item_colon'     => __( 'Parent Feedbacks:', 'textdomain' ),
  );

  $args = array(
      'labels'             => $labels,
      'public'             => false,
      'publicly_queryable' => false,
      'taxonomies'         => array('feedback_category'),
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      // 'rewrite'            => array( 'slug' => 'feedback' ),
      'capability_type'    => 'post',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'menu_icon'          => 'dashicons-format-aside',
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
  );

  register_post_type( 'feedbacks', $args );
}

add_action( 'init', 'wpdocs_codex_feedback_new_init' );