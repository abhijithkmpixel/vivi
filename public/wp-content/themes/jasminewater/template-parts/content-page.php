<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jasmine_Water
 */

?>

<section class="content" data-scroll-section>
  <div class="container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="title wide">
        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
      </div>

      <?php
      $thumb_id = get_post_thumbnail_id();
      jasminewater_post_thumbnail($thumb_id, 'news-large', 'wp-block-image is-style-rounded');
      ?>

      <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
          array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jasminewater' ),
            'after'  => '</div>',
          )
        );
        ?>
      </div><!-- .entry-content -->
    </article><!-- #post-<?php the_ID(); ?> -->
  </div>
</section>