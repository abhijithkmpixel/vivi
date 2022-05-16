<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

wc_print_notices();
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<div class="flex col2-set">
  <div class="col">
    <form class="woocommerce-form woocommerce-form-login login" name="login" method="post">

      <?php do_action( 'woocommerce_login_form_start' ); ?>

      <?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

      <p class="form-row">
        <input type="text" class="input-text" name="username" id="username" autocomplete="username" placeholder="<?php esc_html_e( 'Email ID / Username', 'jasminewater' ); ?>" />
      </p>
      <p class="form-row">
        <input class="input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php esc_html_e( 'Password', 'jasminewater' ); ?>" />
      </p>
      <div class="clear"></div>

      <?php do_action( 'woocommerce_login_form' ); ?>

      <p class="lost_password flex flex-between">
        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot Password?', 'woocommerce' ); ?></a>
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
          <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
        </label>
      </p>

      <span class="hide">
        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
        <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
      </span>

      <p class="form-row btn-wrap">
        <button type="submit" class="btn btn-default btn-simple woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
        <span class="splitter"><?php esc_html_e( 'OR', 'jasminewater' ); ?></span>
        <button type="submit" class="btn btn-primary btn-simple" data-fancybox data-src="#otp-login-form" href="javascript:;"><?php esc_html_e( 'Login with OTP', 'jasminewater' ); ?></button>
      </p>

      <div class="clear"></div>

      <?php do_action( 'woocommerce_login_form_end' ); ?>

      <?php
      $redirect_url = site_url() . '/account';
      if(isset($_GET['callback']) == 'cart'){
        $redirect_url = site_url() . '/account?callback=cart';
      }
      ?>

      <a href="<?php echo $redirect_url; ?>" class="btn btn-link">
        <?php esc_html_e( 'Don\'t have an account with Vivi.', 'woocommerce' ); ?> &nbsp; <strong><?php esc_html_e( 'Register Now', 'woocommerce' ); ?> <i class="icon-next"> </i></strong> 
      </a>

    </form>
  </div>
  <div class="col">
    <div class="bobble-group">
      <img src="<?php echo get_template_directory_uri(); ?>/dist/images/bottle-group.png" />
    </div>
  </div>
</div>

<div style="display: none;" id="otp-login-form">
  <div class="title wide">
    <h4><?php esc_html_e( 'Login with mobile number.', 'woocommerce' ); ?></h4>
  </div>
  <p id="OtpError" class="woocommerce-error hidden"></p>
  <p id="OtpSuccess" class="woocommerce-message hidden"></p>
  <div class="clear"></div><br/>
  <form id="form_mobile" name="otp-login" class="form-login">
    <p class="form-row">
      <label for="mobile_number"><?php esc_html_e( 'Mobile Number', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
      <input type="tel" class="input-text intlTelInput" maxlength="15" name="intlTelInput" placeholder="<?php esc_html_e( 'Enter mobile number', 'jasminewater' ); ?>">
      <input type="hidden" id="mobile_number" name="mobile_number">
    </p>
    <p class="form-row" id="recaptcha-container"></p>
    <div class="clear"></div><br/>
    <p class="form-row btn-wrap">
     <button type="button" class="btn btn-primary btn-simple" data-otp="login" id="sendCode"><?php esc_html_e( 'Send OTP', 'jasminewater' ); ?></button>
    </p>
  </form>
  <form id="form_verification" name="otp-login-verification" class="form-verification hidden">
    <p class="form-row">
      <label for="verification_code"><?php esc_html_e( 'Enter the 6 digit OTP', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
      <input type="text" class="input-text" id="verification_code" maxlength="6" placeholder="<?php esc_html_e( 'Enter verification code', 'jasminewater' ); ?>">
    </p>
    <div class="clear"></div><br/>
    <p class="form-row btn-wrap">
      <button type="button" class="btn btn-primary btn-simple" data-otp="login" id="verifyCode"><?php esc_html_e( 'Verify OTP', 'jasminewater' ); ?></button>
    </p>
  </form>
</div>