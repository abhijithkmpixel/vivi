<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jasmine_Water
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

  <?php if ( 'post' === get_post_type() ) : ?>
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

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->
