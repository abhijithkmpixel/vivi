<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Jasmine_Water
 */

get_header();
$current_post = get_the_ID();
?>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

	<main id="primary" class="site-main news-single">
    <section class="news-info content" data-scroll-section>
      <div class="container small">

      <div class="btn-wrap">
        <a href="<?php echo (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url(); ?>/news" class="btn btn-default btn-default-outline btn-simple btn-back">Back to news</a>
      </div>

      <?php
      while ( have_posts() ) :
        the_post();
        
        ?>

        <div class="title wide">
          <h2><?php the_title(); ?></h2>
        </div>

        <div class="date"><?php the_time( 'j F Y' ); ?></div>

        <div class="featured-img">
        <?php
        $thumb_id = get_post_thumbnail_id();
        jasminewater_post_thumbnail($thumb_id, 'news-large', 'wp-block-image is-style-rounded');
        ?>
        </div>

        <div class="editor-content">
        <?php the_content(); ?>
        </div>

        <?php 
        $news_video = get_field('news_video');
        $thumbnail = $news_video['thumbnail'];
        $video_url = $news_video['video_url'];
        $thumbnail_url = $thumbnail['sizes']['news-large'];
        if($news_video):
        ?>
        <div class="video-block">
          <a class="video-thumb-wrap" href="<?php echo $video_url; ?>" data-fancybox>
            <span class="play-btn"> <i class="icon-right"></i> </span>
            <?php if($thumbnail): jasminewater_picture($thumbnail, 'news-large', 'wp-block-image is-style-rounded'); endif; ?>
          </a>
        </div>
        <?php endif; ?>

        <?php 
        $news_content = get_field('news_content');
        $first_half = $news_content['first_half'];
        $second_half = $news_content['second_half'];
        $first_half_thumb = $news_content['first_half_thumb'];
        $second_half_thumb = $news_content['second_half_thumb'];
        if($news_content):
        ?>
        <div class="content-page">
          <div class="block">
          <?php if($first_half_thumb): jasminewater_picture($first_half_thumb, 'news-small', 'wp-block-image is-style-rounded small-rounded align-left'); endif; ?>
          <?php echo $first_half; ?>
          </div>
          <div class="block">
          <?php if($second_half_thumb): jasminewater_picture($second_half_thumb, 'news-small', 'wp-block-image is-style-rounded small-rounded align-left'); endif; ?>
          <?php echo $second_half; ?>
          </div>
        </div>
        <?php endif; ?>

        <?php
      endwhile; // End of the loop.
      ?>
      </div>
    </section>
    <section class="news-updates related-articles white" data-scroll-section>
      <div class="container">

        <?php
        $args = array(  
          'post_type' => 'news',
          'post_status' => 'publish',
          'post__not_in' => array($current_post),
          'posts_per_page' => 3, 
          'orderby' => 'rand', 
          'order' => 'ASC', 
        );
        $loop = new WP_Query( $args ); 
        if ( $loop->have_posts() ) :
        ?>

          <div class="title center wide">
            <h3>Related Articles</h3>
          </div>

          <div class="content">
            <div class="flex flex-between flex-wrap">

              <?php
              /* Start the Loop */
              while ( $loop->have_posts() ) : $loop->the_post(); 
                ?>

                <?php get_template_part( 'template-parts/content', 'news-small' ); ?>

                <?php
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
