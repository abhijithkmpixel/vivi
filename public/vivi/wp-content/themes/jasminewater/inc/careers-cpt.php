<?php

// Our custom post type function
function create_careers_cpt() {
  register_post_type( 'careers',
    // CPT Options
    array(
      'labels' => array(
          'name' => __( 'Careers' ),
          'singular_name' => __( 'Career' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'careers'),
      'show_in_rest' => true,
      'supports' => array( 'title', 'editor'),
    )
  );
}

// Hooking up our function to theme setup
add_action( 'init', 'create_careers_cpt' );