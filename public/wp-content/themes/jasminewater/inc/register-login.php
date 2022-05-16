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
      <form method="post" name="registration" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

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
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" <?php if ( ! empty( $_POST['password'] ) ) echo esc_attr( $_POST['password'] ); ?> />
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
  $site_url = (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url() .'\\/en' ;
  $myaccount_url = $site_url . '/account';
  woocommerce_login_form( array( 'redirect' => $myaccount_url ) );
  return ob_get_clean();
}

// add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {
  ?>
  <p class="form-row form-row-wide">
  <label for="reg_password2"><?php _e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label>
      <input type="password" class="input-text" name="password2" id="reg_password2" autocomplete="new-password" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
  </p>
  <?php
}

/**
 * @snippet       Add Select Field to "My Account" Register Form | WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=72508
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.5.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
// -------------------
// 1. Show field @ My Account Registration
  
//add_action( 'woocommerce_register_form_start', 'action_woocommerce_register_form_start', 10, 0 ); 
function action_woocommerce_register_form_start() {    
?>
  
  <div class="form-row form-row-wide">
    <div class="select-wrap">
      <label for="salutation"><?php _e( 'Account for', 'woocommerce' ); ?>  <span class="required">*</span></label>
      <select name="salutation" id="salutation">
          <option value="business"><?php _e( 'Business', 'woocommerce' ); ?></option>
          <option value="individual"><?php _e( 'Individual', 'woocommerce' ); ?></option>
      </select>
    </div>
  </div>
  
<?php
}
  
// -------------------
// 2. Save field on Customer Created action
  
add_action( 'woocommerce_created_customer', 'save_extra_register_select_field' );
function save_extra_register_select_field( $customer_id ) {
  if ( isset( $_POST['salutation'] ) ) {
    update_user_meta( $customer_id, 'salutation', $_POST['salutation'] );
  }
}
  
// -------------------
// 3. Display Select Field @ User Profile (admin) and My Account Edit page (front end)
   
// add_action( 'show_user_profile', 'show_extra_register_select_field', 30 );
// add_action( 'edit_user_profile', 'show_extra_register_select_field', 30 ); 
// add_action( 'woocommerce_edit_account_form', 'show_extra_register_select_field', 30 );
   
function show_extra_register_select_field($user){ 
    
  if (empty ($user) ) {
    $user_id = get_current_user_id();
    $user = get_userdata( $user_id );
  }
    
  ?>    
          
  <div class="form-row form-row-wide">
    <div class="select-wrap">
      <label for=""><?php _e( 'Account for', 'woocommerce' ); ?>  <span class="required">*</span></label>
      <select name="salutation" class="regular-text" id="salutation">
        <option disabled value>Select</option>
        <option value="business" <?php if (get_the_author_meta( 'salutation', $user->ID ) == "business") echo 'selected="selected" '; ?>><?php _e( 'Business', 'woocommerce' ); ?></option>
        <option value="individual" <?php if (get_the_author_meta( 'salutation', $user->ID ) == "individual") echo 'selected="selected" '; ?>><?php _e( 'Individual', 'woocommerce' ); ?></option>
      </select>
    </div>
  </div>
    
  <?php
    
}


function custom_user_profile_fields( $user ) {
  if (empty ($user) ) {
    $user_id = get_current_user_id();
    $user = get_userdata( $user_id );
  }
  ?>
  <table class="form-table">
    <tr>
      <th>
        <label for="salutation"><?php _e( 'Account for', 'woocommerce' ); ?></label>
      </th>
      <td>
        <select name="salutation" id="salutation">
          <option disabled value>Select</option>
          <option value="business" <?php if (get_the_author_meta( 'salutation', $user->ID ) == "business") echo 'selected="selected" '; ?>><?php _e( 'Business', 'woocommerce' ); ?></option>
          <option value="individual" <?php if (get_the_author_meta( 'salutation', $user->ID ) == "individual") echo 'selected="selected" '; ?>><?php _e( 'Individual', 'woocommerce' ); ?></option>
        </select>
      </td>
    </tr>
  </table>
<?php
}
//add_action( 'show_user_profile', 'custom_user_profile_fields', 10, 1 );
//add_action( 'edit_user_profile', 'custom_user_profile_fields', 10, 1 );
// add_action( 'woocommerce_edit_account_form', 'show_extra_register_select_field', 10, 1 );
  
// -------------------
// 4. Save User Field When Changed From the Admin/Front End Forms
   
add_action( 'personal_options_update', 'save_extra_register_select_field_admin' );    
add_action( 'edit_user_profile_update', 'save_extra_register_select_field_admin' );   
add_action( 'woocommerce_save_account_details', 'save_extra_register_select_field_admin' );
   
function save_extra_register_select_field_admin( $customer_id ){
  if ( isset( $_POST['salutation'] ) ) {
    update_user_meta( $customer_id, 'salutation', $_POST['salutation'] );
  }
}