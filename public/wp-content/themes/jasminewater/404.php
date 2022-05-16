<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Jasmine_Water
 */

get_header();
?>

	<main id="primary" class="site-main">
    <span class="loader"></span>

		<section class="content error-404 not-found">
      <div class="container">
        <div class="entry-content">
          <div class="title wide sub-title">
            <h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'jasminewater' ); ?></h2>
            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'jasminewater' ); ?></p>
          </div>

          <div class="page-content">
            <?php // get_search_form(); ?>
            <a href="<?php echo (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url() .'\\/en' ; ?>" class="btn btn-default-outline"><?php esc_html_e( 'Back to Home', 'jasminewater' ); ?></a>
          </div><!-- .page-content -->
        </div>
      </div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
