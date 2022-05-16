<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Jasmine_Water
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses jasminewater_header_style()
 */
function jasminewater_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'jasminewater_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'jasminewater_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'jasminewater_custom_header_setup' );

if ( ! function_exists( 'jasminewater_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see jasminewater_custom_header_setup().
	 */
	function jasminewater_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;


function add_current_nav_class($classes, $item) {

  // Getting the current post details
  global $post;

  // Get post ID, if nothing found set to NULL
  $id = ( isset( $post->ID ) ? get_the_ID() : NULL );

  // Checking if post ID exist...
  if (isset( $id )){

      // Getting the post type of the current post
      $current_post_type = get_post_type_object(get_post_type($post->ID));

      // Getting the rewrite slug containing the post type's ancestors
      $ancestor_slug = $current_post_type->rewrite ? $current_post_type->rewrite['slug'] : '';

      // Split the slug into an array of ancestors and then slice off the direct parent.
      $ancestors = explode('/',$ancestor_slug);
      $parent = array_pop($ancestors);

      // Getting the URL of the menu item
      $menu_slug = strtolower(trim($item->url));

      // Remove domain from menu slug
      $menu_slug = str_replace($_SERVER['SERVER_NAME'], "", $menu_slug);

      // If the menu item URL contains the post type's parent
      if (!empty($menu_slug) && !empty($parent) && strpos($menu_slug,$parent) !== false) {
          $classes[] = 'current-menu-item';
      }

      // If the menu item URL contains any of the post type's ancestors
      foreach ( $ancestors as $ancestor ) {
        if (!empty($menu_slug) && !empty($ancestor) && strpos($menu_slug,$ancestor) !== false) {
            $classes[] = 'current-page-ancestor';
        }
      }
  }
  // Return the corrected set of classes to be added to the menu item
  return $classes;

}
add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );