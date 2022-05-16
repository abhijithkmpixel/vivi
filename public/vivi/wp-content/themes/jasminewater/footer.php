<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jasmine_Water
 */

?>
  <?php if (  !is_front_page() ) : ?>
  <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
  <script>
      // For Firebase JS SDK v7.20.0 and later, measurementId is optional
      const firebaseConfig = {
        apiKey: "AIzaSyB3rVUYdNLDr4ch44APAKuz7hnibevD-b8",
        authDomain: "vivi-otp-ceb3f.firebaseapp.com",
        projectId: "vivi-otp-ceb3f",
        storageBucket: "vivi-otp-ceb3f.appspot.com",
        messagingSenderId: "43748445364",
        appId: "1:43748445364:web:29a834fcfb5ec22858dbe1",
        measurementId: "G-SSBNVB74ZX"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
  </script>
  <?php endif; ?>

  <?php
  global $woocommerce;  
  $cart = $woocommerce->cart;
  $social_media = get_field('social_media', 'options');
  $footer_links = get_field('footer_links', 'options');
  $order_now = get_field('order_now', 'options');
  $cart_item_list = array();
  $loop = 0;
  foreach( $cart->get_cart_item_quantities() as $id => $count ){
    // array_push($cart_item_list, array(  ));
    $cart_item_list[$loop]['id'] = $id;
    $cart_item_list[$loop]['title'] = get_the_title($id);
    $cart_item_list[$loop]['count'] = $count;
    $loop++;
  }
  ?>

	<footer id="colophon" class="site-footer blue" data-scroll-section>
		<div class="container">
      <div class="site-branding">
        <?php the_custom_logo();?>
      </div>
      <div class="order-wrap">
        <?php if($order_now): ?>
        <div class="order">
          <a href="<?php echo $order_now['link']; ?>" class=""><?php echo $order_now['title']; ?></a>
        </div>
        <?php endif; ?>
      </div>
      <div class="top flex flex-between">
        <div class="footer-navigation">
          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'menu-1',
              'menu_id'        => 'primary-menu',
              'container_class'          => 'primary-menu-wrappper flex flex-center',
              'menu_class'          => 'primary-menu flex flex-between'
            )
          );
          ?>
        </div>
        <div class="cart dynamic-cart">
          <!-- <span class="count <?php // echo ($cart->get_cart_contents_count()) ? '' : 'hidden'; ?>"><?php // echo $cart->get_cart_contents_count(); ?></span> -->
          <span class="count <?php echo (count($cart_item_list)) ? '' : 'hidden'; ?>"><?php echo count($cart_item_list); ?></span>
          <a href="<?php echo (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url(); ?>/cart" class="icon-wrap">
            <i class="icon icon-cart"></i>
          </a>
        </div>
      </div>
      <div class="bottom flex flex-between">

        <?php if($social_media): ?>
        <div class="social-media">
          <ul>
            <?php 
            foreach( $social_media as $social ):
            $link = $social['link'];
            $icon = $social['icon'];
            ?>
            <li> <a href="<?php echo $link; ?>"> <i class="icon <?php echo $icon; ?>"></i> </a> </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <?php if($footer_links): ?>
        <div class="privacy">
          <ul>
            <?php 
            foreach( $footer_links as $footer ):
            $footer = $footer['link'];
            ?>
            <li> <a href="<?php echo $footer['url']; ?>"><?php echo $footer['title']; ?></a> </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

      </div>
    </div>
	</footer><!-- #colophon -->

</div><!-- #page -->
<style>#at-expanded-menu-host{direction: ltr !important;}.addthis_bar_fixed{display: none !important}</style>
<?php wp_footer(); ?>

</body>
</html>
