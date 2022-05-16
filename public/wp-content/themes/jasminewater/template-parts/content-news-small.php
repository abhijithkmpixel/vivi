<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jasmine_Water
 */

?>

<div class="col">
  <div id="post-<?php the_ID(); ?>" class="card aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="0">
    <a href="<?php echo get_permalink(); ?>" class="link">
      <div class="overlay">
        <div class="top">
          <div class="date"><?php the_time( 'j F Y' ); ?></div>
          <?php the_title( '<h3>', '</31>' ); ?>
        </div>
        <div class="bottom">
          <p><?php echo wp_trim_words( get_the_excerpt(), 8 ); ?></p>
        </div>
      </div>
      <?php
      $thumb_id = get_post_thumbnail_id();
      jasminewater_post_thumbnail($thumb_id, 'news-thumb', '');
      ?>
    </a>
  </div>
</div>