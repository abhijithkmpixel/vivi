<?php 
if(is_shop()) {
  $page_id = woocommerce_get_page_id('shop');
} else {
  $page_id = $post->ID;
}
$count = count( get_field('banner_slider', $page_id) );
if( have_rows('banner_slider', $page_id) ): 
?>

<section class="banner inner-banner" data-scroll-section>
  <div class="page-banner-wrapper">
    <div class="swiper-container banner-inner-slider">
      <div class="swiper-wrapper">
      <?php while( have_rows('banner_slider', $page_id) ): the_row(); 
        $background_image = get_sub_field('background_image');
        $background_image_mobile = get_sub_field('background_image_mobile');
        $background_image_url = $background_image['sizes']['banner-inner'];
        $background_image_mobile_url = $background_image_mobile['sizes']['banner-inner-mobile'];
        $side_image = get_sub_field('side_image');
        $caption = get_sub_field('caption');
        ?>
        <div class="swiper-slide slide-item <?php echo($side_image) ? 'with-side-image':''; ?>">
          <?php if($caption): ?>
          <div class="caption">
            <div class="container aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-in" data-aos-delay="0">
              <?php echo $caption; ?>
            </div>
          </div>
          <?php endif; ?>

          <?php if($background_image): ?>
            <picture class="swiper-bg aos-init aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-in" data-aos-delay="0">
              <source media="(min-width: 769px)" srcset="<?php echo webp($background_image_url); ?>" type="image/webp">
              <source media="(min-width: 769px)" srcset="<?php echo $background_image_url; ?>" type="image/jpeg"> 
              <source media="(max-width: 768px)" srcset="<?php echo webp($background_image_mobile_url); ?>" type="image/webp">
              <source media="(max-width: 768px)" srcset="<?php echo $background_image_mobile_url; ?>" type="image/jpeg"> 
              <img src="<?php echo $background_image_url; ?>" alt="<?php echo $background_image['alt']; ?>">
            </picture>
          <?php endif; ?>

          <?php if($side_image): jasminewater_picture($side_image, 'bottle-lg', 'swiper-bottle-img'); endif; ?>
        </div>
      <?php endwhile; ?>
      </div>
    </div>
    <?php if($count > 1): ?>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>