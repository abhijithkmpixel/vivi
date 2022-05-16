<?php

// Our custom post type function
function create_news_cpt() {
  register_post_type( 'news',
    // CPT Options
    array(
      'labels' => array(
          'name' => __( 'News' ),
          'singular_name' => __( 'News' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'news'),
      'show_in_rest' => true,
      'supports' => array( 'title', 'editor', 'thumbnail' ),
    )
  );
}

// Hooking up our function to theme setup
add_action( 'init', 'create_news_cpt' );