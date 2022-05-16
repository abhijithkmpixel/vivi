<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jasmine_Water
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
  if ( is_singular() ) :
    the_title( '<div class="title wide"><h1 class="entry-title">', '</h1></div>' );
  else :
    the_title( '<div class="title wide"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></div>' );
  endif;
  ?>
  <div class="content">
    <?php
    if ( 'post' === get_post_type() ) :
      ?>
      <div class="entry-meta">
        <?php
        jasminewater_posted_on();
        jasminewater_posted_by();
        ?>
      </div><!-- .entry-meta -->
    <?php endif; ?>

    <?php
    $thumb_id = get_post_thumbnail_id();
    jasminewater_post_thumbnail($thumb_id, 'news-large', 'wp-block-image is-style-rounded');
    ?>

    <div class="entry-content">
      <?php
      the_content(
        sprintf(
          wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'jasminewater' ),
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          wp_kses_post( get_the_title() )
        )
      );

      wp_link_pages(
        array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jasminewater' ),
          'after'  => '</div>',
        )
      );
      ?>
    </div><!-- .entry-content -->
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
