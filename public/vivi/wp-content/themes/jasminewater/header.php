<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jasmine_Water
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

  <?php
  global $woocommerce;  
  $cart = $woocommerce->cart;

  $cart_item_list = array();
  $loop = 0;
  foreach( $cart->get_cart_item_quantities() as $id => $count ){
    // array_push($cart_item_list, array(  ));
    $cart_item_list[$loop]['id'] = $id;
    $cart_item_list[$loop]['title'] = get_the_title($id);
    $cart_item_list[$loop]['count'] = $count;
    $loop++;
  }

  if(is_product()): 
  global $product;
  if ( ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_id() );
  }
  $product_name = strip_tags($product->get_name());
  $product_short_description = strip_tags($product->get_short_description());
  $product_short_excerpt = strip_tags(get_the_excerpt( get_the_id() ));
  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
  $product_url = get_permalink( get_the_id() );
  ?>
  <meta property="og:url"                content="<?php echo $product_url; ?>" />
  <meta property="og:type"               content="product" />
  <meta property="og:title"              content="<?php echo $product_name; ?> : <?php echo $product_short_description; ?>" />
  <meta property="og:description"        content="<?php echo $product_short_excerpt; ?>" />
  <meta property="og:image"              content="<?php echo $featured_img_url; ?>" />
  <?php endif; ?>

  <!-- <link rel="preload" href="Font URL Showing in PageSpeed" as="font" crossorigin="anonymous"> -->

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-aos-easing="ease-in-out" data-aos-duration="800" data-aos-delay="0" data-aos-offset="10" data-aos-anchor-placement="top-center">
<?php wp_body_open(); ?>
<div id="page" class="site" data-scroll-container>
  <span class="loader"></span>
  
  <script>
  var update_cart_nonce = '<?php echo wp_create_nonce('update_cart_nonce'); ?>';
  var otp_auth_nonce = '<?php echo wp_create_nonce('otp_auth_nonce'); ?>';
  var verify_user_nonce = '<?php echo wp_create_nonce('verify_user_nonce'); ?>';
  var ajax_url = '<?php echo site_url(); ?>/wp-admin/admin-ajax.php';
  var site_url = '<?php echo (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url(); ?>';
  var lang  = '<?php echo ICL_LANGUAGE_CODE == 'ar' ? 'rtl' : 'ltr' ?>';

  //Validate Errors
  var val_rfld = "<?php esc_html_e( 'This field is required', 'jasminewater' ); ?>";
  var val_char = "<?php esc_html_e( 'Please enter valid characters', 'jasminewater' ); ?>";
  var val_phone = "<?php esc_html_e( 'Please enter valid phone number', 'jasminewater' ); ?>";
  var val_mobile = "<?php esc_html_e( 'Please enter valid mobile number', 'jasminewater' ); ?>";
  var val_mail = "<?php esc_html_e( 'Please enter a valid email address', 'jasminewater' ); ?>";
  var val_fname = "<?php esc_html_e( 'Please enter your firstname', 'jasminewater' ); ?>";
  var val_lname = "<?php esc_html_e( 'Please enter your lastname', 'jasminewater' ); ?>";
  var val_baddr = "<?php esc_html_e( 'Please enter billing address', 'jasminewater' ); ?>";
  var val_city = "<?php esc_html_e( 'Please enter billing city', 'jasminewater' ); ?>";
  var val_pmin = "<?php esc_html_e( 'Your password must be at least 8 characters long', 'jasminewater' ); ?>";
  var val_peqr = "<?php esc_html_e( 'Password and confirm password don\'t match', 'jasminewater' ); ?>";
  var val_otpc = "<?php esc_html_e( 'Please enter OTP verification code', 'jasminewater' ); ?>";
  var val_nuex = "<?php esc_html_e( 'No user exists with this mobile number.', 'jasminewater' ); ?>";
  var val_malr = "<?php esc_html_e( 'Mobile number already registered. Please login.', 'jasminewater' ); ?>";
  var val_perm = "<?php esc_html_e( 'Please enter your registered mobile number.', 'jasminewater' ); ?>";
  var val_eotpr = "<?php esc_html_e( 'Please enter OTP received on your registered mobile number.', 'jasminewater' ); ?>";
  var val_otsm = "<?php esc_html_e( 'OTP will be sent to the mobile number.', 'jasminewater' ); ?>";
  var val_otsr = "<?php esc_html_e( 'The OTP will be sent to your registered mobile number.', 'jasminewater' ); ?>";
  </script>

  <?php
  $telephone = get_field('telephone', 'options');
  $order_now = get_field('order_now', 'options');
  $note = get_field('note', 'options');
  ?>

	<header class="site-header blue-gradient">
		<div class="header-top">
      <div class="container">
        <div class="flex flex-between">
          <?php if($note): ?>
          <div class="left flex flex-left flex-align-center">
            <strong><?php echo $note['label']; ?></strong> <span><?php echo $note['text']; ?></span>
          </div>
          <?php endif; ?>
          <div class="right flex flex-right flex-align-center">
            <?php if($telephone): ?>
            <div class="contact-num"><a href="tel:<?php echo $telephone['number']; ?>"><?php echo $telephone['label']; ?>: <?php echo $telephone['number']; ?></a></div>
            <?php endif; ?>
            <div class="language-switcher"><?php echo do_shortcode('[wpml_language_switcher type="footer" flags=0 native=1 translated=0][/wpml_language_switcher]'); ?></div>
          </div>
        </div>
      </div>
    </div>
		<div class="header-bottom">
      <div class="container">
        <div class="site-branding">
          <?php the_custom_logo();?>
        </div>
        <nav id="site-navigation" class="main-navigation">
          <?php if($order_now): ?>
          <div class="order">
            <a href="<?php echo $order_now['link']; ?>" class=""><?php echo $order_now['title']; ?></a>
          </div>
          <?php endif; ?>
          <div class="cart dynamic-cart">
            <span class="count <?php echo (count($cart_item_list)) ? '' : 'hidden'; ?>"><?php echo count($cart_item_list); ?></span>
            <a href="<?php echo (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url(); ?>/cart" class="icon-wrap">
              <i class="icon icon-cart"></i>
            </a>
          </div>
          <button class="mobile-menu" id="mobile_menu_btn"><i class="icon icon-menu"></i></button>
          <div class="primary-menu-wrappper flex flex-center">
            <div class="site-branding">
              <?php the_custom_logo();?>
            </div>
            <button class="mobile-menu-close" id="mobile_menu_close_btn"><i class="icon icon-close"></i></button>
            <?php
            wp_nav_menu(
              array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'container_class'          => 'primary-menu-container',
                'menu_class'          => 'primary-menu flex flex-between'
              )
            );
            ?>
          </div>
        </nav>
      </div>
    </div>
	</header>
