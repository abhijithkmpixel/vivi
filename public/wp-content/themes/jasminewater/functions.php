<?php
/**
 * Jasmine Water functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jasmine_Water
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'jasminewater_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function jasminewater_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Jasmine Water, use a find and replace
		 * to change 'jasminewater' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'jasminewater', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'jasminewater' ),
				'menu-2' => esc_html__( 'Footer', 'jasminewater' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'jasminewater_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'jasminewater_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jasminewater_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jasminewater_content_width', 640 );
}
add_action( 'after_setup_theme', 'jasminewater_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jasminewater_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'jasminewater' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'jasminewater' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'jasminewater_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jasminewater_scripts() {
	wp_enqueue_style( 'jasminewater-style', get_template_directory_uri() . '/dist/css/style.css', array(), _S_VERSION );
  // wp_enqueue_style( 'jasminewater-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );
	wp_enqueue_style( 'jasminewater-plugins', get_template_directory_uri() . '/dist/css/plugins.css', array(), _S_VERSION );
	wp_enqueue_style( 'jasminewater-app-main', get_template_directory_uri() . '/dist/css/app-main.css', array(), _S_VERSION );

  if (  !is_front_page() ) :
	  wp_enqueue_style( 'jasminewater-app-inner', get_template_directory_uri() . '/dist/css/app-inner.css', array(), _S_VERSION );
    wp_enqueue_style( 'jasminewater-plugins-inner', get_template_directory_uri() . '/dist/css/plugins-inner.css', array(), _S_VERSION );
  endif;

  if(ICL_LANGUAGE_CODE == 'ar'):
    wp_enqueue_style( 'jasminewater-app-rtl', get_template_directory_uri() . '/dist/css/app-rtl.css', array(), _S_VERSION );
  endif; 

	wp_style_add_data( 'jasminewater-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jasminewater-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jasminewater-swiper', get_template_directory_uri() . '/dist/js/swiper.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jasminewater-locomotive', get_template_directory_uri() . '/dist/js/locomotive.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jasminewater-SmoothScroll', get_template_directory_uri() . '/dist/js/SmoothScroll.min.js', array(), _S_VERSION, true );
	

  if (  !is_front_page() ) :
	wp_enqueue_script( 'jasminewater-app', get_template_directory_uri() . '/dist/js/app.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jasminewater-ajax', get_template_directory_uri() . '/dist/js/ajax.min.js', array(), _S_VERSION, true );
  wp_enqueue_script( 'jasminewater-toast', get_template_directory_uri() . '/dist/js/toast.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jasminewater-select', get_template_directory_uri() . '/dist/js/select.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jasminewater-datepicker', get_template_directory_uri() . '/dist/js/datepicker.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jasminewater-intlTelInput', get_template_directory_uri() . '/dist/js/intlTelInput.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jasminewater-validate', get_template_directory_uri() . '/dist/js/jquery.validate.min.js', array(), _S_VERSION, true );
  else:
  wp_enqueue_script( 'jasminewater-home', get_template_directory_uri() . '/dist/js/home.min.js', array(), _S_VERSION, true );
  endif;

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jasminewater_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/register-login.php';
require get_template_directory() . '/inc/otp-functions.php';
require get_template_directory() . '/inc/theme-functions.php';
require get_template_directory() . '/inc/news-cpt.php';
require get_template_directory() . '/inc/careers-cpt.php';
require get_template_directory() . '/inc/api/create_customer_api.php';
require get_template_directory() . '/inc/api/get_id_login_api.php';
require get_template_directory() . '/inc/api/check_delivery_api.php';
require get_template_directory() . '/inc/api/api_general.php';
require get_template_directory() . '/inc/api/delivery_meta_api.php';
require get_template_directory() . '/inc/api/feedback_api.php';
// require get_template_directory() . '/inc/api/create_nonce_api.php';
require get_template_directory() . '/inc/api/cart_count_api.php';
require get_template_directory() . '/inc/api/user_products_api.php';
require get_template_directory() . '/inc/api/process_payment_api.php';
require get_template_directory() . '/inc/feedback-cpt.php';
require get_template_directory() . '/inc/api/change_password_api.php';
require get_template_directory() . '/inc/api/clear_cart_api.php';
require get_template_directory() . '/inc/api/login_otp_api.php';
require get_template_directory() . '/inc/api/update_customer_api.php';
require get_template_directory() . '/inc/api/clear_cookie_api.php';
require get_template_directory() . '/inc/postcode-cpt.php';
require get_template_directory() . '/inc/api/products_details_api.php';
require get_template_directory() . '/inc/api/order_details_api.php';
require get_template_directory() . '/inc/api/update_cart_api.php';
require get_template_directory() . '/inc/api/save_zipcode_api.php';
require get_template_directory() . '/inc/api/cart_table_api.php';
require get_template_directory() . '/inc/api/cart_table_label_api.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/* Convert to WEBP URL*/
function webp($url) {
  if($url && strpos($url, 'uploads') !== false){
    $url = str_replace("uploads","webp-express/webp-images/uploads", $url);
    $url = $url . '.webp';
  }
  return $url;
}


// function jasmine_water_gutenberg_styles() {
// 	wp_enqueue_style( 'jasmine-water-gutenberg', get_theme_file_uri( '/dist/css/gutenberg.css' ), false, '1.0', 'all' );
// }
// add_action( 'enqueue_block_editor_assets', 'jasmine_water_gutenberg_styles' );

add_filter( 'use_block_editor_for_post', '__return_false' );


function vivi_numeric_posts_nav() {
 
  if( is_singular() )
      return;

  global $wp_query;

  /** Stop execution if there's only 1 page */
  if( $wp_query->max_num_pages <= 1 )
      return;

  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max   = intval( $wp_query->max_num_pages );

  /** Add current page to the array */
  if ( $paged >= 1 )
      $links[] = $paged;

  /** Add the pages around the current page to the array */
  if ( $paged >= 3 ) {
      $links[] = $paged - 1;
      $links[] = $paged - 2;
  }

  if ( ( $paged + 2 ) <= $max ) {
      $links[] = $paged + 2;
      $links[] = $paged + 1;
  }

  echo '<div class="vivi-pagination"><ul class="page-numbers">' . "\n";

  /** Previous Post Link */
  // if ( get_previous_posts_link() )
      // printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

  /** Link to first page, plus ellipses if necessary */
  if ( ! in_array( 1, $links ) ) {
      $class = 1 == $paged ? ' class="active"' : '';

      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

      if ( ! in_array( 2, $links ) )
          echo '<li>…</li>';
  }

  /** Link to current page, plus 2 pages in either direction if necessary */
  sort( $links );
  foreach ( (array) $links as $link ) {
      $class = $paged == $link ? ' class="active"' : '';
      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  }

  /** Link to last page, plus ellipses if necessary */
  if ( ! in_array( $max, $links ) ) {
      if ( ! in_array( $max - 1, $links ) )
          echo '<li>…</li>' . "\n";

      $class = $paged == $max ? ' class="active"' : '';
      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }

  /** Next Post Link */
  // if ( get_next_posts_link() )
      // printf( '<li>%s</li>' . "\n", get_next_posts_link() );

  echo '</ul></div>' . "\n";

}

function slugify($text){
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicated - symbols
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function dm_remove_wp_block_library_css(){
  wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'dm_remove_wp_block_library_css' );