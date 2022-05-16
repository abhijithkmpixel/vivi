<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<div class="sub-title">
  <div class="title wide">
    <h1><?php esc_html_e( 'Profile', 'jasminewater' ); ?></h1>
    <p><?php printf(
      /* translators: 1: user display name 2: logout url */
      wp_kses( __( 'Dear %1$s You can view your registered personal data and you can update your profile as well.  (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ), $allowed_html ),
      '<strong>' . esc_html( $current_user->first_name ) . '</strong>',
      esc_url( wc_logout_url() )
    ); ?>
  </div>
</div>

<?php
$user_email = $current_user->user_email;
$user_phone = $current_user->user_phone;
$user_mobile = $current_user->user_mobile;

// $shipping_postcode = get_user_meta( $current_user->ID, 'shipping_postcode', true );
// $billing_postcode = get_user_meta( $current_user->ID, 'billing_postcode', true );

$email = get_user_meta( $current_user->ID, 'user_email', true );
$phone = get_user_meta( $current_user->ID, 'user_phone', true );
$fname = get_user_meta( $current_user->ID, 'first_name', true );
$lname = get_user_meta( $current_user->ID, 'last_name', true );

$billing_address_1 = get_user_meta( $current_user->ID, 'billing_address_1', true ); 
$billing_address_2 = get_user_meta( $current_user->ID, 'billing_address_2', true );
$billing_city = get_user_meta( $current_user->ID, 'billing_city', true );
$billing_postcode = get_user_meta( $current_user->ID, 'billing_postcode', true );

// $billing_phone = get_user_meta( $current_user->ID, 'billing_phone', true );
// $billing_email = get_user_meta( $current_user->ID, 'billing_email', true );

$billing_address = $fname . ' ' . $lname . "</br>" . $billing_address_1 . "</br>" . $billing_address_2 . "</br>" . $billing_city . "</br>" . $billing_postcode . "</br>";
?>

<div class="woocommerce-profile">
  <div class="flex profile-cols woocommerce">
    <div class="col info">
      <div class="shop-table-wrap no-border">
        <table class="woocommerce-table shop_table profile-details">
          <tr>
            <td><?php esc_html_e( 'Name', 'jasminewater' ); ?>:</td> <td><strong> <?php echo $fname . ' ' . $lname; ?> </strong></td>
          </tr>
          <tr>
            <td><?php esc_html_e( 'Email', 'jasminewater' ); ?>:</td> <td><strong> <?php echo $user_email; ?> </strong></td>
          </tr>
          <tr>
            <td><?php esc_html_e( 'Phone', 'jasminewater' ); ?>:</td> <td><strong> <?php echo $user_phone; ?> </strong></td>
          </tr>
          <tr>
            <td><?php esc_html_e( 'Mobile', 'jasminewater' ); ?>:</td> <td><strong> <?php echo $user_mobile; ?> </strong></td>
          </tr>
        </table>
        <div class="btn-wrap">
          <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' ) ); ?>" class="btn btn-default btn-small"><?php esc_html_e( 'Update profile', 'jasminewater' ); ?></a>
          <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>" class="btn btn-primary btn-small"><?php esc_html_e( 'Your orders', 'jasminewater' ); ?></a>
        </div>
      </div>
    </div>
    <div class="col address">
      <?php if($billing_address): ?>
        <div class="billing-address">
          <div class="title">
            <h3><?php esc_html_e( 'Billing address', 'jasminewater' ); ?></h3>
            <address>
              <?php echo $billing_address; ?>
            </address>
          </div>
        </div>
        <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'billing' ) ); ?>" class="btn btn-default-outline btn-small"><?php esc_html_e( 'Edit Address', 'jasminewater' ); ?></a>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
