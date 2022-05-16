<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Jasmine_Water
 */

get_header();
?>

	<main id="primary" class="site-main">

    <section class="content" data-scroll-section>
      <div class="container">

        <div class="entry-content">
          <?php if ( have_posts() ) : ?>

          <div class="title wide">
            <h2>
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'jasminewater' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </h2>
          </div>

          <?php
          /* Start the Loop */
          while ( have_posts() ) :
            the_post();

            /**
            * Run the loop for the search to output the results.
            * If you want to overload this in a child theme then include a file
            * called content-search.php and that will be used instead.
            */
            get_template_part( 'template-parts/content', 'search' );

          endwhile;

          the_posts_navigation();

          else :

          get_template_part( 'template-parts/content', 'none' );

          endif;
          ?>
        </div>

      </div>
    </section>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
