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

get_header();
?>

	<main id="primary" class="site-main">

    <section class="content sub-title" data-scroll-section>
      <div class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="title wide">
            
            <?php 
            if ( function_exists( 'is_order_received_page' ) && is_order_received_page() ) {
              echo '<h1 class="entry-title">';
              esc_html_e( 'Order Received', 'jasminewater' );
              echo '</h1>';
            } else {
              the_title( '<h1 class="entry-title">', '</h1>' ); 
            }
            ?>
          </div>
          <div class="entry-content">
            <?php the_content(); ?>
          </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->
      </div>
    </section>

    <?php get_template_part( 'template-parts/content', 'get-more' ); ?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();