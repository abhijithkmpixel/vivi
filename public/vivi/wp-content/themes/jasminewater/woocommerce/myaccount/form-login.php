<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */
$register = get_field('register', 'options');
?>

<?php if($register): ?>
  <div class="title wide">
    <h2 class="entry-title"><?php echo $register['title']; ?></h2>
    <?php echo $register['sub_title']; ?>
  </div>
<?php endif; ?>

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<form method="post" name="registration" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

  <div class="flex col2-set">
    <div class="col">
      <?php do_action( 'woocommerce_register_form_start' ); ?>

      <span class="hide">
        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
      </span>

      <p class="woocommerce-form-row form-row btn-wrap desktop">
        <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
        <span class="splitter"><?php esc_html_e( 'OR', 'jasminewater' ); ?></span>
        <button type="submit" class="btn btn-primary btn-simple" data-fancybox data-src="#otp-register-form" href="javascript:;"><?php esc_html_e( 'Register with OTP', 'jasminewater' ); ?></button>
      </p>

      <p class="woocommerce-form-row form-row desktop">
        <a href="<?php echo (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url(); ?>/login" class="btn btn-link"><?php esc_html_e( 'Already have an account with Vivi.', 'jasminewater' ); ?>  &nbsp; <strong><?php esc_html_e( 'Login Now', 'jasminewater' ); ?> <i class="icon-next"> </i></strong></a>
      </p>
    </div>
    <div class="col">

      <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
          <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
        </p>

      <?php endif; ?>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="user_phone"><?php esc_html_e( 'Phone', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--phone input-text" maxlength="15" name="user_phone" id="user_phone" autocomplete="phone" value="<?php echo ( ! empty( $_POST['user_phone'] ) ) ? esc_attr( wp_unslash( $_POST['user_phone'] ) ) : ''; ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="user_mobile"><?php esc_html_e( 'Mobile', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="tel" class="woocommerce-Input woocommerce-Input--mobile input-text intlTelInput" maxlength="15" name="intlTelInput" autocomplete="mobile" value="<?php echo ( ! empty( $_POST['user_mobile'] ) ) ? esc_attr( wp_unslash( $_POST['user_mobile'] ) ) : ''; ?>">
        <input type="hidden" id="user_mobile" name="user_mobile" value="<?php echo ( ! empty( $_POST['user_mobile'] ) ) ? esc_attr( wp_unslash( $_POST['user_mobile'] ) ) : ''; ?>">
      </p>

      <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
          <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
        </p>

      <?php else : ?>

        <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

      <?php endif; ?>

      <?php do_action( 'woocommerce_register_form' ); ?>

      <p class="woocommerce-form-row form-row">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <div class="g-recaptcha" data-sitekey="6LdI3NIaAAAAAOtJMcFbTv3Nbuedg4BUlDko6X0s"></div>
      </p>

      <p class="woocommerce-form-row form-row mobile btn-wrap">
        <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
        <span class="splitter"><?php esc_html_e( 'OR', 'jasminewater' ); ?></span>
        <button type="submit" class="btn btn-primary btn-simple" data-fancybox data-src="#otp-register-form" href="javascript:;"><?php esc_html_e( 'Register with OTP', 'jasminewater' ); ?></button>
      </p>

      <p class="woocommerce-form-row form-row mobile">
        <a href="<?php echo (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url(); ?>/login" class="btn btn-link"><?php esc_html_e( 'Already have an account with Vivi.', 'jasminewater' ); ?>  &nbsp; <strong><?php esc_html_e( 'Login Now', 'jasminewater' ); ?> <i class="icon-next"> </i></strong></a>
      </p>

      <div class="bobble-group">
        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/bottle-group.png" />
      </div>

    </div>
  </div>

  <?php do_action( 'woocommerce_register_form_end' ); ?>

</form>

<div style="display: none;" id="otp-register-form">
  <div class="title wide">
    <h4><?php esc_html_e( 'Register with mobile number.', 'woocommerce' ); ?></h4>
  </div>
  <p id="OtpError" class="woocommerce-error hidden"></p>
  <p id="OtpSuccess" class="woocommerce-message hidden"></p>
  <div class="clear"></div><br/>
  <form id="form_mobile" name="otp-register" class="form-login">
    <p class="form-row">
      <label for="email_address"><?php esc_html_e( 'Email Address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
      <input type="tel" class="input-text" placeholder="<?php esc_html_e( 'Enter email address', 'jasminewater' ); ?>" id="email_address" name="email_address">
    </p>
    <p class="form-row">
      <label for="mobile_number"><?php esc_html_e( 'Mobile Number', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
      <input type="tel" class="input-text intlTelInput" maxlength="15" name="intlTelInput" placeholder="<?php esc_html_e( 'Enter mobile number', 'jasminewater' ); ?>">
      <input type="hidden" id="mobile_number" name="mobile_number">
    </p>
    <p class="form-row" id="recaptcha-container"></p>
    <div class="clear"></div><br/>
    <p class="form-row btn-wrap">
     <button type="button" class="btn btn-primary btn-simple" data-otp="register" id="sendCode"><?php esc_html_e( 'Send OTP', 'jasminewater' ); ?></button>
    </p>
  </form>
  <form id="form_verification" name="otp-register-verification" class="form-verification hidden">
    <p class="form-row">
      <label for="verification_code"><?php esc_html_e( 'Enter the 6 digit OTP', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
      <input type="text" class="input-text" maxlength="6" id="verification_code" name="verification_code" placeholder="<?php esc_html_e( 'Enter verification code', 'jasminewater' ); ?>">
    </p>
    <div class="clear"></div><br/>
    <p class="form-row btn-wrap">
      <button type="button" class="btn btn-primary btn-simple" data-otp="register" id="verifyCode"><?php esc_html_e( 'Verify OTP', 'jasminewater' ); ?></button>
    </p>
  </form>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
