<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jasmine_Water
 */

  $product_detail = get_field('product_detail', 'options');
?>

<?php
$banner_slider = get_field('banner_slider');
if( $banner_slider ):
?>
<section class="banner home" data-scroll-section>
  <div class="swiper-container banner-slider">
    <div class="swiper-wrapper">

      <?php 
      foreach( $banner_slider as $slide ): 
      $banner_title = $slide['banner_title'];
      $buttons = $slide['buttons'];
      $side_image = $slide['side_image'];
      $background_image = $slide['background_image'];
      ?>

      <div class="swiper-slide">
        <div class="container">
          <div class="overlay">
            <div class="caption">
              <div class="title aos-init" data-scroll data-aos="fade-up" data-aos-delay="200">
                <h1><?php echo $banner_title['title']; ?> <span class="vivi"><img src="<?php echo $banner_title['image']['url']; ?>" width="121px" height="104px" alt="<?php echo $banner_title['image']['alt']; ?>" /></span></h1>
                <p><?php echo $banner_title['short_description']; ?></p>
              </div>
              <?php if( $buttons ): ?>
              <div class="btn-wrap">
                <?php 
                $count = 0;
                foreach( $buttons as $button ):
                $links = $button['links'];
                ?>
                
                <?php if($count == 0): ?>
                <a href="<?php echo $links['url']; ?>" class="aos-init btn btn-default btn-hover-white" data-scroll data-aos="fade-in" data-aos-offset="50" data-aos-delay="400"><?php echo $links['title']; ?></a>
                <?php else: ?>
                <a href="<?php echo $links['url']; ?>" class="aos-init btn btn-white" data-scroll data-aos="fade-in" data-aos-offset="50" data-aos-delay="600"><?php echo $links['title']; ?></a>
                <?php endif; ?>

                <?php
                $count++;
                endforeach; 
                ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php if($background_image): ?>
        <picture class="swiper-bg aos-init" data-scroll data-aos="fade-in" data-aos-duration="1500">
          <source srcset="<?php echo webp($background_image['url']); ?>" type="image/webp">
          <source srcset="<?php echo $background_image['url']; ?>" type="image/jpeg"> 
          <img src="<?php echo $background_image['url']; ?>" width="1270px" height="569px" alt="<?php echo $background_image['alt']; ?>">
        </picture>
        <?php endif; ?>
        <?php if($side_image): ?>
        <picture class="swiper-bottle aos-init" data-scroll data-aos="zoom-in" data-aos-offset="60" data-aos-delay="0" data-aos-duration="800">
          <source srcset="<?php echo webp($side_image['url']); ?>" type="image/webp">
          <source srcset="<?php echo $side_image['url']; ?>" type="image/jpeg"> 
          <img src="<?php echo $side_image['url']; ?>" width="322px" height="539px" alt="<?php echo $side_image['alt']; ?>">
        </picture>
        <?php endif; ?>
      </div>

      <?php endforeach; ?>
      
      <!--
      <div class="swiper-slide">
        <div class="container">
          <div class="overlay">
            <div class="caption aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-in" data-aos-delay="100">
              <div class="title">
                <h2><span class="head">For every<br/> adventure,<br/> there’s<br/> always</span> <span class="vivi end"><img src="<?php // echo get_template_directory_uri(); ?>/dist/images/logo_vivi.svg" alt="Vivi" /></span></h2>
                <p>Aarchitecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptaa voluptas sit asp.</p>
              </div>
              <div class="btn-wrap">
                <a href="#" class="btn btn-default btn-hover-white">Shop Products</a>
                <a href="#" class="btn btn-white">Download App</a>
              </div>
            </div>
          </div>
        </div>
        <picture class="swiper-bg aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-in" data-aos-delay="0">
          <source srcset="<?php // echo webp('https://vivi.pixelflames.net/wp-content/uploads/2021/04/hero-banner-2.jpg'); ?>" type="image/webp">
          <source srcset="https://vivi.pixelflames.net/wp-content/uploads/2021/04/hero-banner-2.jpg" type="image/jpeg"> 
          <img src="https://vivi.pixelflames.net/wp-content/uploads/2021/04/hero-banner-2.jpg" alt="VIVI">
        </picture>
      </div>
      <div class="swiper-slide">
        <div class="container">
          <div class="overlay">
            <div class="caption aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-in" data-aos-delay="200">
              <div class="title">
                <h2>Download<br/> the <span class="vivi center"><img src="<?php // echo get_template_directory_uri(); ?>/dist/images/logo_vivi.svg" alt="Vivi" /></span> App<br/> for instant ordering</h2>
                <p>Aarchitecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptaa voluptas sit asp.</p>
              </div>
              <div class="btn-wrap">
                <a href="#" class="btn btn-default btn-hover-white">Shop Products</a>
                <a href="#" class="btn btn-white">Download App</a>
              </div>
            </div>
          </div>
        </div>
        <picture class="swiper-bg aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-in" data-aos-delay="0">
          <source srcset="<?php // echo webp('https://vivi.pixelflames.net/wp-content/uploads/2021/04/image-19.jpg'); ?>" type="image/webp">
          <source srcset="https://vivi.pixelflames.net/wp-content/uploads/2021/04/image-19.jpg" type="image/jpeg"> 
          <img src="https://vivi.pixelflames.net/wp-content/uploads/2021/04/image-19.jpg" alt="VIVI">
        </picture>
        <picture class="swiper-right aos-init" data-scroll data-scroll-class="aos-animate" data-aos="zoom-in" data-aos-delay="100">
          <source srcset="<?php // echo webp('https://vivi.pixelflames.net/wp-content/uploads/2021/04/iphone-2.png'); ?>" type="image/webp">
          <source srcset="https://vivi.pixelflames.net/wp-content/uploads/2021/04/iphone-2.png" type="image/jpeg"> 
          <img src="https://vivi.pixelflames.net/wp-content/uploads/2021/04/iphone-2.png" alt="VIVI">
        </picture>
      </div>
      -->
      
    </div>
    <div class="swiper-pagination">
      <div class="container"></div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$showhide_shop = get_field('showhide_shop');
$shop_items = get_field('shop_item'); 
$shop_title = get_field('shop_title'); 
if( $showhide_shop && $shop_items ):
?>
<section class="shop home" data-scroll-section>
	<div class="container">

    <?php if($shop_title): ?>
    <div class="title aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100">
      <?php if($shop_title['title']): ?>
      <h2><?php echo $shop_title['title']; ?> <span class="vivi blue"><img src="<?php echo $shop_title['image']['url']; ?>" width="118px" height="88px" alt="<?php echo $shop_title['alt']; ?>" /></span></h2>
      <?php endif; ?>
      <?php echo ($shop_title['short_description']) ? '<p>' .$shop_title['short_description']. '</p>' : ''; ?>
    </div>
    <?php endif; ?>

    <div class="content">
      <div class="shop-list">
        <div class="flex flex-between">
          <?php
          foreach( $shop_items as $shop_item ): 
          $image = $shop_item['image'];
          $image_url = $image['url'];
          $name = $shop_item['name'];
          $size = $shop_item['size'];
          $short_description = $shop_item['short_description'];
          $link = $shop_item['link'];
          ?>
          <div class="col wow">
            <div class="shop aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100">
              <?php if($image): ?>
              <div class="shop-img">
                <picture class="swiper-bottle wow fadeInUp" data-wow-delay="0.3s">
                  <source srcset="<?php echo webp($image_url); ?>" type="image/webp">
                  <source srcset="<?php echo $image_url; ?>" type="image/jpeg"> 
                  <img src="<?php echo $image_url; ?>" width="90px" height="280px" alt="<?php echo $image['alt']; ?>">
                </picture>
              </div>
              <?php endif; ?>
              <div class="shop-info">
                <h4><strong><?php echo $name; ?></strong> <?php echo $size; ?></h4>
                <h5><?php echo $short_description; ?></h5>
              </div>
              <?php if($product_detail): ?>
                <?php if($link): ?>
                <div class="btn-wrap">
                  <a href="<?php echo $link['url']; ?>" class="btn btn-primary"><?php echo $link['title']; ?></a>
                </div>
                <?php endif; ?>
              <?php else: ?>
                <?php if(ICL_LANGUAGE_CODE == 'ar'): ?>
                <a href="<?php echo site_url(); ?>/ar/products" class="btn btn-primary"><?php echo $link['title']; ?></a>
                <?php else: ?>
                <a href="<?php echo site_url(); ?>/products" class="btn btn-primary"><?php echo $link['title']; ?></a>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$showhide_drink = get_field('showhide_drink'); 
$slide_items = get_field('slide_item'); 
if( $showhide_drink && $slide_items ):
?>
<section class="why-vivi home blue-gradient" data-scroll-section>
  <div class="swiper-container content-slider">
    <div class="swiper-wrapper">

      <?php
      foreach( $slide_items as $slide_item ): 
      $slide_title = $slide_item['slide_title'];
      $drink_benefits = $slide_item['drink_benefits'];
      $slide_image = $slide_item['slide_image'];
      ?>
      <div class="swiper-slide">
        <div class="container">
          <div class="caption aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="50">

            <?php if($slide_title): ?>
            <div class="title">
              <?php if($slide_title['title']): ?>
              <h2><?php echo $slide_title['title']; ?> <span class="vivi"><img src="<?php echo $slide_title['image']['url']; ?>" width="102px" height="88px" alt="<?php echo $slide_title['alt']; ?>" /></span></h2>
              <?php endif; ?>
              <?php echo ($slide_title['short_description']) ? '<p>' .$slide_title['short_description']. '</p>' : ''; ?>
            </div>
            <?php endif; ?>

            <?php if($drink_benefits): ?>
            <div class="vivi-offers">
              <?php foreach( $drink_benefits as $drink_benefit ): ?>
              <div class="offers"><h4><strong><?php echo $drink_benefit['label']; ?></strong><?php echo $drink_benefit['value']; ?></div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <?php if($slide_image): ?>
        <div class="swiper-bottle" data-scroll data-scroll-speed="2" data-scroll-direction="vertical">
          <picture class="swiper-bottle">
            <source srcset="<?php echo webp($slide_image['url']); ?>" type="image/webp">
            <source srcset="<?php echo $slide_image['url']; ?>" type="image/jpeg"> 
            <img src="<?php echo $slide_image['url']; ?>" width="672px" height="340px" alt="<?php echo $slide_image['alt']; ?>">
          </picture>
        </div>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
      
    </div>
    <div class="swiper-pagination">
      <div class="container"></div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$showhide_story = get_field('showhide_story');
$story_title = get_field('story_title');
$story_slides = get_field('story_slide');
if($showhide_story && $story_slides):
?>
<section class="our-story home green" data-scroll-section>
	<div class="container">
    <?php if($story_title): ?>
    <div class="title aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100">
      <?php if($story_title['title']): ?>
      <h2><?php echo $story_title['title']; ?></h2>
      <?php endif; ?>
      <?php echo ($story_title['short_description']) ? '<p>' .$story_title['short_description']. '</p>' : ''; ?>
    </div>
    <?php endif; ?>
  </div>
  <div class="content aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="200">
    <span class="connect-draw connect1"></span>
    <span class="connect-draw connect2"></span>
    <div class="swiper-container-slide" <?php echo (ICL_LANGUAGE_CODE == 'ar') ? 'dir="ltr"': ''; ?> >
      <div class="swiper-wrapper">
        <?php
        foreach( $story_slides as $story_slide ):
        $title = $story_slide['title'];
        $icon = $story_slide['icon'];
        $link = $story_slide['link'];
        $image = $story_slide['image'];
        ?>
        <div class="swiper-slide">
          <div class="swiper-block">
            <div class="overlay">
              <div class="icon-wrap">
                <i class="icon <?php echo $icon; ?>"></i>
              </div>
              <div class="content">
                <h3><?php echo $title; ?></h3>
                <?php if($link): ?>
                <a href="<?php echo $link['url']; ?>" class="btn btn-primary btn-hover-white"><?php echo $link['title']; ?></a>
                <?php endif; ?>
              </div>
            </div>
            <picture class="swiper-img">
              <source srcset="<?php echo webp($image['sizes']['story-thumb']); ?>" type="image/webp">
              <source srcset="<?php echo $image['sizes']['story-thumb']; ?>" type="image/jpeg"> 
              <img src="<?php echo $image['sizes']['story-thumb']; ?>" width="426px" height="426px" alt="<?php echo $image['alt']; ?>">
            </picture>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-pagination">
        <div class="container"></div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$showhide_download = get_field('showhide_download');
$download_title = get_field('download_title');
$play_store = get_field('play_store');
$app_store = get_field('app_store');
$iphone = get_field('iphone');
$download_bg_image = get_field('download_bg_image');
if($showhide_download):
?>
<section class="download-app home blue" data-scroll-section>
	<div class="container">
    <div class="overlay">
      <div class="flex">
        <div class="col" data-scroll data-scroll-speed="3" data-scroll-direction="vertical">

          <?php if($download_title): ?>
          <div class="title">
            <?php if($download_title['title']): ?>
            <h2><?php echo $download_title['title']; ?></h2>
            <?php endif; ?>
            <?php echo ($download_title['short_description']) ? '<p>' .$download_title['short_description']. '</p>' : ''; ?>
          </div>
          <?php endif; ?>

          <div class="btn-wrap">
            <?php if($app_store): ?>
            <a href="<?php echo $app_store['store_url']; ?>" target="_blank" class="store-btns"><img src="<?php echo $app_store['button_image']['url']; ?>" width="136px" height="40px" alt="App Store" /></a>
            <?php endif; ?>
            <?php if($play_store): ?>
            <a href="<?php echo $play_store['store_url']; ?>" target="_blank" class="store-btns"><img src="<?php echo $play_store['button_image']['url']; ?>" width="136px" height="40px" alt="Play Store" /></a>
            <?php endif; ?>
          </div>

        </div>
        <div class="col">
          <picture class="iphone" data-scroll data-scroll-speed="<?php echo (ICL_LANGUAGE_CODE == 'ar') ? '-2': '2'; ?>" data-scroll-direction="horizontal">
            <source srcset="<?php echo webp($iphone['url']); ?>" type="image/webp">
            <source srcset="<?php echo $iphone['url']; ?>" type="image/jpeg"> 
            <img src="<?php echo $iphone['url']; ?>" width="580px" height="703px" alt="<?php echo $iphone['alt']; ?>">
          </picture>
        </div>
      </div>
    </div>
  </div>
  <picture class="swiper-img">
    <source srcset="<?php echo webp($download_bg_image['sizes']['banner-inner']); ?>" type="image/webp">
    <source srcset="<?php echo $download_bg_image['sizes']['banner-inner']; ?>" type="image/jpeg"> 
    <img src="<?php echo $download_bg_image['sizes']['banner-inner']; ?>" width="1270px" height="550px" alt="<?php echo $download_bg_image['alt']; ?>">
  </picture>
</section>
<?php endif; ?>

<?php
$showhide_news = get_field('showhide_news');
$news_title = get_field('news_title');
$news_items = get_field('news_items');
if($showhide_news && $news_items):
?>
<section class="news-updates home white" data-scroll-section>
	<div class="container">

    <?php if($news_title): ?>
    <div class="title aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100">
      <?php if($news_title['title']): ?>
      <h2><?php echo $news_title['title']; ?></h2>
      <?php endif; ?>
      <?php echo ($news_title['short_description']) ? '<p>' .$news_title['short_description']. '</p>' : ''; ?>
    </div>
    <?php endif; ?>

    <div class="content">
      <div class="flex flex-between flex-wrap">
        <?php
        $query = new WP_Query( array( 'post__in' => $news_items, 'post_type' => 'news' ) );
        while ( $query->have_posts() ):
        $query->the_post();
        get_template_part( 'template-parts/content', 'news-small' ); 
        endwhile;
        wp_reset_postdata();
        ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$showhide_social = get_field('showhide_social');
$social_title = get_field('social_title');
if($showhide_social):
?>
<section class="social home white" data-scroll-section>
	<div class="container">

    <?php if($social_title): ?>
    <div class="title center aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100">
      <?php if($social_title['title']): ?>
      <h2><?php echo $social_title['title']; ?></h2>
      <?php endif; ?>
      <?php echo ($social_title['short_description']) ? '<h4>' .$social_title['short_description']. '</h4>' : ''; ?>
    </div>
    <?php endif; ?>

    <div class="content">
      <?php // echo do_shortcode('[ff id="1"]'); ?>
      <div class="social-media-listing flex flex-wrap flex-between" id="social-wall-container">
        <div class="col"> <div class="card aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100"> <div class="social-item-picture"></div> </div> </div>
        <div class="col"> <div class="card aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100"> <div class="social-item-picture"></div> </div> </div>
        <div class="col"> <div class="card aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100"> <div class="social-item-picture"></div> </div> </div>
        <div class="col"> <div class="card aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100"> <div class="social-item-picture"></div> </div> </div>
        <div class="col"> <div class="card aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100"> <div class="social-item-picture"></div> </div> </div>
        <div class="col"> <div class="card aos-init" data-scroll data-scroll-class="aos-animate" data-aos="fade-up" data-aos-delay="100"> <div class="social-item-picture"></div> </div> </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/content', 'get-more' ); ?>
