<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jasmine_Water
 */

if ( is_user_logged_in() ) {
  if(ICL_LANGUAGE_CODE == 'ar'):
  wp_redirect( site_url() . '/ar/account' );
  else:
  wp_redirect( site_url() . '/en/account' );
  endif;
  exit;
}

get_header();
$login = get_field('login', 'options');
?>

	<main id="primary" class="site-main">
    <div class="clear"></div>
    <section class="content sub-title login" data-scroll-section>
      <div class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="entry-content">
            <div class="woocommerce">
              <?php if($login): ?>
                <div class="title wide">
                  <h2 class="entry-title"><?php echo $login['title']; ?></h2>
                  <?php echo $login['sub_title']; ?>
                </div>
              <?php endif; ?>
              <?php the_content(); ?>
            </div>
          </div>
        </article>
      </div>
    </section>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();