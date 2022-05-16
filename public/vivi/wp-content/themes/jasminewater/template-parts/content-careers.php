<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jasmine_Water
 */

 $career_mail_to = get_field('career_mail_to', 'options');
 $career_mail_subject = get_field('career_mail_subject', 'options');
?>

<div class="col">
  <div id="post-<?php the_ID(); ?>" class="card-career aos-init aos-animate" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="0">
    <div class="card-top">
      <?php the_title( '<h3>', '</31>' ); ?>
    </div>
    <div class="card-content">
      <div class="date">
        <span class="icon-wrap">
          <i class="icon-datepicker"></i>
        </span>
        <?php the_time( 'F Y' ); ?>
      </div>
      <p><?php echo wp_trim_words( get_the_content(), 100 ); ?></p>
      <a href="mailto:<?php echo $career_mail_to; ?>?subject=<?php echo $career_mail_subject; ?> <?php echo get_the_title(); ?>" class="btn btn-default btn-small"><?php esc_html_e( 'Apply Now', 'jasminewater' ); ?></a>
    </div>
  </div>
</div>