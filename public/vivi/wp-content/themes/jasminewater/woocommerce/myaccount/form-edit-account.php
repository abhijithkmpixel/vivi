<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<div class="title wide">
  <h1><?php esc_html_e( 'Update profile', 'jasminewater' ); ?></h1>
</div>

<form class="woocommerce-EditAccountForm edit-account" name="update-profile" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<div class="flex col2-set">
    <div class="col">
      <div class="title">
        <h3><?php esc_html_e( 'Personal Details', 'woocommerce' ); ?></h3>
      </div>
      <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
        <label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
      </p>
      <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
        <label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
      </p>
      <div class="clear"></div>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_display_name"><?php esc_html_e( 'Display name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span>
      </p>
      <div class="clear"></div>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
      </p>
      
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="user_phone"><?php esc_html_e( 'Phone', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--phone input-text" maxlength="15" name="user_phone" id="user_phone" autocomplete="phone" value="<?php echo esc_attr( $user->user_phone ); ?>" />
      </p>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="user_mobile"><?php esc_html_e( 'Mobile', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <!-- <input type="text" class="woocommerce-Input woocommerce-Input--mobile input-text intlTelInput" name="user_mobile" id="user_mobile" autocomplete="mobile" value="<?php echo esc_attr( $user->user_mobile ); ?>" /> -->
        <input type="tel" class="woocommerce-Input woocommerce-Input--mobile input-text intlTelInput" maxlength="15" name="intlTelInput" autocomplete="mobile" value="<?php echo esc_attr( $user->user_mobile ); ?>">
        <input type="hidden" id="user_mobile" name="user_mobile" value="<?php echo esc_attr( $user->user_mobile ); ?>">
      </p>

      <div class="clear"></div>

      <p>
        <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
        <div class="btn-wrap">
          <button type="submit" class="woocommerce-Button btn btn-primary btn-small" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
          <a href="<?php echo (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url(); ?>/account" class="btn btn-default"><?php esc_html_e( 'Cancel', 'woocommerce' ); ?></a>
          <input type="hidden" name="action" value="save_account_details" />
        </div>
      </p>

    </div>
    <div class="col">
      <div class="title">
        <h3><?php esc_html_e( 'Password change', 'woocommerce' ); ?></h3>
      </div>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
      </p>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
      </p>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
      </p>
      <div class="bobble-group">
        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/bottle-group.png" />
      </div>
    </div>
  </div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>


	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
