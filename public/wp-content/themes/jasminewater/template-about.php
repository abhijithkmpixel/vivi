<?php 
/* Template Name: About Template */ 
get_header();
?>

	<main id="primary" class="site-main">

		<?php
    if ( have_posts() ) :
      while ( have_posts() ) :
        the_post();
        ?>

        <?php get_template_part( 'template-parts/content', 'banner' ); ?>

        <?php
        $showhide_about = get_field('showhide_about');
        $about_content = get_field('about_content');
        $about_image = $about_content['about_image'];
        $about_image_url = $about_image['sizes']['about-image'];
        ?>

        <?php if($showhide_about): ?>
        <section class="about-content content" data-scroll-section>
          <div class="container">
            <div class="title wide">
              <h3><?php echo $about_content['title']; ?></h3>
            </div>
            <div class="flex flex-between intro">
              <div class="col">
                <?php echo $about_content['column_one']; ?>
              </div>
              <div class="col">
                <?php echo $about_content['column_two']; ?>
              </div>
            </div>
            <div class="top-space">
              <?php if($about_image): jasminewater_picture($about_image, 'about-image', 'about-img wp-block-image is-style-rounded'); endif; ?>
            </div>
          </div>
        </section>
        <?php endif; ?>

        <?php 
        $showhide_chairman = get_field('showhide_chairman');
        $chairman_image = get_field('chairman_image');
        $chairman_image_mobile = get_field('chairman_image_mobile');
        $chairman_image_url = $chairman_image['url'];
        $chairman_image_mobile_url = $chairman_image_mobile['url'];
        $chairman_blockquote = get_field('chairman_blockquote');
        ?>

        <?php if($showhide_chairman): ?>
        <section class="chairman blue" data-scroll-section>
          <?php if($chairman_blockquote): ?>
          <div class="caption">
            <div class="container aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100">
              <div class="caption-inner">
                <div class="title">
                  <h2>Always with <span class="vivi"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo_vivi+white.svg" alt="Vivi" /></span></h2>
                </div>
                <?php echo $chairman_blockquote['message']; ?>
                <div class="end">
                  <h4><?php echo $chairman_blockquote['name']; ?></h4>
                  <h5><?php echo $chairman_blockquote['designation']; ?></h5>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if($chairman_image): ?>
          <picture class="chairman-bg aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-in" data-aos-delay="0">
            <source media="(min-width: 769px)" srcset="<?php echo webp($chairman_image_url); ?>" type="image/webp">
            <source media="(min-width: 769px)" srcset="<?php echo webp($chairman_image_url); ?>" type="image/jpeg"> 
            <source media="(max-width: 768px)" srcset="<?php echo webp($chairman_image_mobile_url); ?>" type="image/webp">
            <source media="(max-width: 768px)" srcset="<?php echo webp($chairman_image_mobile_url); ?>" type="image/jpeg"> 
            <img src="<?php echo webp($chairman_image_url); ?>" alt="<?php echo $chairman_image['alt']; ?>">
          </picture>
          <?php endif; ?>
        </section>
        <?php endif; ?>

        <?php 
        $showhide_certificates = get_field('showhide_certificates');
        $certificate_title = get_field('certificate_title');
        ?>

        <?php if( $showhide_certificates && have_rows('certificates') ): ?>
        <section class="white certificates" data-scroll-section>
            <div class="container">
              <div class="flex flex-between">
                <div class="col caption">
                  <div class="title">
                    <h2><?php echo $certificate_title['title']; ?></h2>
                    <p><?php echo $certificate_title['sub_title']; ?></p>
                  </div>
                  <div class="certificate-paginate desktop">
                    <span class="certificate-arrow swiper-button-prev-certiificate">
                      <i class="icon icon-prev"></i>
                    </span>
                    <span class="certificate-arrow swiper-button-next-certiificate">
                      <i class="icon icon-next"></i>
                    </span>
                  </div>
                </div>
                <div class="col slider">
                  <div class="certiificate-slider swiper-container">
                    <div class="swiper-wrapper">
                      <?php
                      while( have_rows('certificates') ): the_row(); 
                      $logo = get_sub_field('logo');
                      $logo_url = $logo['sizes']['thumbnail'];
                      $description = get_sub_field('description');
                      ?>
                      <div class="swiper-slide">
                        <div class="certificate-block">
                          <picture class="logo-img aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-in" data-aos-delay="0">
                            <source srcset="<?php echo webp($logo_url); ?>" type="image/webp">
                            <source srcset="<?php echo $logo_url; ?>" type="image/jpeg"> 
                            <img src="<?php echo $logo_url; ?>" alt="<?php echo $logo['alt']; ?>">
                          </picture>
                          <p><?php echo $description; ?></p>
                        </div>
                      </div>
                      <?php endwhile; ?>
                    </div>
                  </div>
                </div>
                <div class="certificate-paginate mobile">
                  <span class="certificate-arrow swiper-button-prev-certiificate">
                    <i class="icon icon-prev"></i>
                  </span>
                  <span class="certificate-arrow swiper-button-next-certiificate">
                    <i class="icon icon-next"></i>
                  </span>
                </div>
              </div>
            </div>
        </section>
        <?php endif; ?>

        <?php get_template_part( 'template-parts/content', 'get-more' ); ?>

        <?php
      endwhile; // End of the loop.
    endif;
    ?>  

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
