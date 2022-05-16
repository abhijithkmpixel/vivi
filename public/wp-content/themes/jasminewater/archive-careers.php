<?php
/* Template Name: Career Template */ 

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jasmine_Water
 */

get_header();
$career = get_field('career', 'options');
$args = array( 'post_type' => 'careers', 'posts_per_page' => -1 );
$the_query = new WP_Query( $args ); 
?>

	<main id="primary" class="site-main">
    <span class="loader"></span>

    <section class="careers-listing sub-title white" data-scroll-section>
      <div class="container">
		  
		  
		  <?php if($career): ?>
          <div class="title wide">
            <h1><?php echo $career['title']; ?></h1>
            <?php echo $career['sub_title']; ?>
          </div>
          <?php endif; ?>

        <?php if ( $the_query->have_posts() ) : ?>

          <div class="content">
            <div class="title">
              <h3><?php echo $career['vacancies_title']; ?></h3>
            </div>
            <div class="flex flex-between flex-wrap">

              <?php
              /* Start the Loop */
              while ( $the_query->have_posts() ) : $the_query->the_post();

                /*
                * Include the Post-Type-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                */
                get_template_part( 'template-parts/content-careers' );

              endwhile;
              ?>

              <div class="col-placeholder"></div>

              

            </div>
          </div>
        
          <?php vivi_numeric_posts_nav(); ?>

        <?php endif; ?>

      </div>
    </section>
	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
