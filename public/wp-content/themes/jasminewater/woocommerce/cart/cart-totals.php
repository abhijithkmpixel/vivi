<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<div class="title">
    <h3><?php esc_html_e( 'Cart totals', 'woocommerce' ); ?></h3>
  </div>

  <div class="shop-table-wrap">
    <table cellspacing="0" class="shop_table shop_table_responsive">

      <?php $cart_table = get_field('cart_table', 'option'); ?>

      <?php if($cart_table['show_num_of_product'] == true) : ?>
        <tr class="">
          <th><?php echo $cart_table['number_of_item']; ?></th>
          <td data-title="<?php echo $cart_table['number_of_item']; ?>"><?php echo count( WC()->cart->get_cart() ); ?></td>
        </tr> 
      <?php endif; ?> 

      <tr class="">
        <th><?php echo $cart_table['total_regular_price']; ?></th>
        <?php
          $regular_price = 0;
          foreach( WC()->cart->get_cart() as $cart_item ){
            $product_id = $cart_item['product_id']; 
            $_product = wc_get_product( $product_id );
            $regular_price += $_product->get_regular_price() * $cart_item['quantity'];
          }
        ?>
        <td data-title="<?php echo $cart_table['total_regular_price']; ?>"><?php echo wc_price($regular_price); ?></td>
      </tr>   

      <tr class="">
        <th><?php echo $cart_table['discount_price']; ?></th>
        <?php
          $discount_total = 0;
          foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {         
            $product = $values['data'];
            if ( $product->is_on_sale() ) {
               $regular_price = $product->get_regular_price();
               $sale_price = $product->get_sale_price();
               $discount = ( $regular_price - $sale_price ) * $values['quantity'];
               $discount_total += $discount;
            }
         }
        ?>
        <td data-title="<?php echo $cart_table['discount_price']; ?>">-<?php echo wc_price($discount_total); ?></td>
      </tr>    

      <tr class="cart-subtotal">
        <th><?php echo $cart_table['total_sales_price']; ?></th>
        <td data-title="<?php echo $cart_table['total_sales_price']; ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
      </tr>

      <tr class="">
        <th><?php echo $cart_table['vat_box']; ?></th>
        <?php
          $sales_total = WC()->cart->total;
          $befr_vat = $sales_total/1.15;
          $vat_price = ($befr_vat*15)/100; 
        ?>
        <td data-title="<?php echo $cart_table['vat_box']; ?>"><?php echo wc_price($vat_price); ?></td>
      </tr>

      <?php if($cart_table['show_coupan'] == true) : ?>
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
          <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
            <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
            <td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

      <?php if($cart_table['show_shipping'] == true) : ?>
        <tr class="shipping">
          <th><?php echo $cart_table['shipping_box']; ?></th>
          <td data-title="<?php echo $cart_table['shipping_box']; ?>"><?php esc_attr_e( 'Free', 'woocommerce' ); ?></td>
        </tr>
      <?php endif; ?>

      <?php
      if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : 
      ?>

        <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

        <?php wc_cart_totals_shipping_html(); ?>

        <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

      <?php
      elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : 
      ?>

        <tr class="shipping">
          <th><?php echo $cart_table['shipping_box']; ?></th>
          <td data-title="<?php echo $cart_table['shipping_box']; ?>"><?php woocommerce_shipping_calculator(); ?></td>
        </tr>

      <?php endif; ?>

      <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <tr class="fee">
          <th><?php echo esc_html( $fee->name ); ?></th>
          <td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
        </tr>
      <?php endforeach; ?>

      <?php
      if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
        $taxable_address = WC()->customer->get_taxable_address();
        $estimated_text  = '&nbsp; <small>(15%)</small>';

        if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
          /* translators: %s location. */
          $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
        }

        if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
          foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            ?>
            <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
              <th><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
              <td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
            </tr>
            <?php
          }
        } else {
          ?>
          <tr class="tax-total">
            <th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
            <td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
          </tr>
          <?php
        }
      }
      ?>

      <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

      <tr class="order-total">
        <th><?php echo $cart_table['total_inc_vat']; ?></th>
        <td data-title="<?php echo $cart_table['total_inc_vat']; ?>"><?php wc_cart_totals_order_total_html(); ?></td>
      </tr>

      <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    </table>
  </div>

	<div class="wc-proceed-to-checkout btn-wrap">
		<?php // do_action( 'woocommerce_proceed_to_checkout' ); ?>
    <button type="submit" class="btn btn-primary btn-small"><?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?></button>
    <!-- <input type="submit" class="btn btn-primary" value="Proceed to Checkout"> -->
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
