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
          <div class="entry-content">
            <?php the_content(); ?>
          </div><!-- .entry-content -->
        </article>
      </div>
    </section>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
