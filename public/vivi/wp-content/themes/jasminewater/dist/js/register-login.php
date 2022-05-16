<?php
/**
 * @snippet       WooCommerce User Registration Shortcode
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 4.0
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
   
// add_shortcode( 'wc_reg_form_woocommerce', 'woocommerce_separate_registration_form' );
    
function woocommerce_separate_registration_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return;
   ob_start();
 
   // NOTE: THE FOLLOWING <FORM></FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php
   // IF WOOCOMMERCE RELEASES AN UPDATE TO THAT TEMPLATE, YOU MUST CHANGE THIS ACCORDINGLY
 
   do_action( 'woocommerce_before_customer_login_form' );

   wc_print_notices();
 
   ?>
      <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

        <?php do_action( 'woocommerce_register_form_start' ); ?>

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
          <input type="tel" class="woocommerce-Input woocommerce-Input--text input-text" name="user_phone" id="user_phone" autocomplete="phone" value="<?php echo ( ! empty( $_POST['user_phone'] ) ) ? esc_attr( wp_unslash( $_POST['user_phone'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
        </p>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
          <label for="user_mobile"><?php esc_html_e( 'Mobile', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
          <input type="tel" class="woocommerce-Input woocommerce-Input--text input-text" name="user_mobile" id="user_mobile" autocomplete="mobile" value="<?php echo ( ! empty( $_POST['user_mobile'] ) ) ? esc_attr( wp_unslash( $_POST['user_mobile'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
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
          <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
          <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
        </p>

        <?php do_action( 'woocommerce_register_form_end' ); ?>

      </form>
 
   <?php
     
   return ob_get_clean();
}

/**
 * @snippet       WooCommerce User Login Shortcode
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 4.0
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
add_shortcode( 'wc_login_form_woocommerce', 'woocommerce_separate_login_form' );
function woocommerce_separate_login_form() {
  if ( is_admin() ) return;
  if ( is_user_logged_in() ) return;
  ob_start();
  $myaccount_url = site_url() . '/account';
  woocommerce_login_form( array( 'redirect' => $myaccount_url ) );
  return ob_get_clean();
}

add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {
  ?>
  <p class="form-row form-row-wide">
  <label for="reg_password2"><?php _e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label>
      <input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
  </p>
  <?php
}

add_action("wp_ajax_mobile_verify_user", "mobile_verify_user");
add_action("wp_ajax_nopriv_mobile_verify_user", "mobile_verify_user");
function mobile_verify_user() {
  
  $nonce = $_POST['nonce'];
  if(!wp_verify_nonce($nonce, 'verify_user_nonce')) {
    wp_die('Busted!');  
  }

  $mobile_number = filter_var($_POST['mobile_number'], FILTER_SANITIZE_STRING);
  $members = get_users(
    array(
      'meta_key' => 'user_mobile', 
      'meta_value' => $mobile_number, 
      'offset' => 0, 
      'number' => 1, 
      'count_total' => false
    )
  );

  $user = array( 
    'action' => 'verify_user',
    // 'member' => $members,
    'count' => count($members)
  );
  echo json_encode( $user );

  die();
}

add_action("wp_ajax_otp_login_user", "otp_login_user");
add_action("wp_ajax_nopriv_otp_login_user", "otp_login_user");
function otp_login_user() {
  
  $nonce = $_POST['nonce'];
  if(!wp_verify_nonce($nonce, 'login_user_nonce')) {
    wp_die('Busted!');  
  }

  $mobile_number = filter_var($_POST['mobile_number'], FILTER_SANITIZE_STRING);
  $members = get_users(
    array(
      'meta_key' => 'user_mobile', 
      'meta_value' => $mobile_number, 
      'offset' => 0, 
      'number' => 1, 
      'count_total' => false
    )
  );


  // die();

  // $username = 

   // log in automatically
  // if ( !is_user_logged_in() ) {
  //   $user = get_userdatabylogin( $username );
  //   $user_id = $user->ID;
  //   wp_set_current_user( $user_id, $user_login );
  //   wp_set_auth_cookie( $user_id );
  //   do_action( 'wp_login', $user_login );
  // }  

  $user = array( 
    'action' => 'login_user',
    'member' => $members,
    'count' => count($members)
  );
  echo json_encode( $user );

  die();
}