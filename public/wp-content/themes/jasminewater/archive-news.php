<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jasmine_Water
 */

get_header();
?>

	<main id="primary" class="site-main">
    <span class="loader"></span>
    
    <section class="news-updates sub-title news-listing white" data-scroll-section>
      <div class="container">

        <?php
        $count = 0;
        if ( have_posts() ) :
        ?>

          <div class="title title-split wide">
            <div class="flex flex-between">
              <div class="col title-head">
                <h1>News & Events</h1>
              </div>
              <div class="col filter">
                <div class="filter-wrapper">
                  <div class="filter-item drop-wrap">
                    <label for="sort">Sort By Year</label>
                    <div class="custom-select">
                      <select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;" class="input-select">
                        <option value=""><?php esc_attr( _e( 'Select Month', 'textdomain' ) ); ?></option> 
                        <?php wp_get_archives( array( 'type' => 'yearly', 'format' => 'option', 'show_post_count' => 0, 'post_type' => 'news' ) ); ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="content">
            <div class="flex flex-between flex-wrap">

              <?php
              /* Start the Loop */
              while ( have_posts() ) :
                the_post();

                /*
                * Include the Post-Type-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                */
                ?>
                <?php
                if($count == 0 && !is_paged()):
                get_template_part( 'template-parts/content', 'news-large' );
                else:
                get_template_part( 'template-parts/content', 'news-small' );
                endif;
                ?>

                <?php
              $count++;
              endwhile;
              ?>

              <div class="col-placeholder"></div>

            </div>
          </div>
        
          <?php vivi_numeric_posts_nav(); ?>

        <?php endif; ?>

      </div>
    </section>

    <?php get_template_part( 'template-parts/content', 'get-more' ); ?>

	</main><!-- #main -->

<?php
get_footer();
