<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

  <div class="shop-table-wrap">
    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
      <thead>
        <tr>
          <!-- <th class="product-thumbnail">&nbsp;</th> -->
          <th colspan="2" class="product-item"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
          <th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
          <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
          <th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
          <th class="product-remove">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
          $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
          $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

          if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

              

              <td class="product-thumbnail">
              <?php
              $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

              if ( ! $product_permalink ) {
                echo $thumbnail; // PHPCS: XSS ok.
              } else {
                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
              }
              ?>
              </td>
              
              <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
              <?php
              
              $product_title = '<a href="' .get_permalink( $_product->get_ID() ). '">';
              $product_title .= strip_tags( $_product->get_name() .'  '. $_product->post->post_excerpt );
              $product_title .= '</a>';

              echo $product_title;

              // if ( ! $product_permalink ) {
              //   echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $product_title, $cart_item, $cart_item_key ) . '&nbsp;' );
              // } else {
              //   echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $product_title ), $cart_item, $cart_item_key ) );
              // }

              do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

              // Meta data.
              echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

              // Backorder notification.
              if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
              }
              ?>
              </td>

              <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                <span class="mobile-label"><?php esc_attr_e( 'Price', 'woocommerce' ); ?></span>
                <?php
                  echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                ?>
              </td>

              <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
              <span class="mobile-label"><?php esc_attr_e( 'Quantity', 'woocommerce' ); ?></span>
              <?php
              if ( $_product->is_sold_individually() ) {
                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
              } else {
                // $product_quantity = woocommerce_quantity_input(
                // 	array(
                // 		'input_name'   => "cart[{$cart_item_key}][qty]",
                // 		'input_value'  => $cart_item['quantity'],
                // 		'max_value'    => $_product->get_max_purchase_quantity(),
                // 		'min_value'    => '0',
                // 		'product_name' => $_product->get_name()
                // 	),
                // 	$_product,
                // 	false
                // );
                // echo $cart_item['quantity'];

                // global $woocommerce;
                // $cart = $woocommerce->cart;
                // $cart_item_qty = $cart->get_cart_item_quantities();

                echo woocommerce_quantity_input( array(
                  'input_name'   => "cart[{$cart_item_key}][qty]",
                  'input_value'  => $cart_item['quantity'],
                  'max_value'    => $_product->get_max_purchase_quantity(),
                  'min_value'    => 1,
                  'product_name' => $_product->get_name(),
                  'product_id' => $_product->get_id(),
                  'product_val' => $cart_item['quantity']
                ), 
                  $product, false );
              }

              // echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
              
              ?>
              </td>

              <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                <span class="mobile-label"><?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?></span>
                <?php
                  echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                ?>
              </td>

              <td class="product-remove">
                <?php
                  echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                      '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"> <i class="icon-close"></i> </a>',
                      esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                      esc_html__( 'Remove this item', 'woocommerce' ),
                      esc_attr( $product_id ),
                      esc_attr( $_product->get_sku() )
                    ),
                    $cart_item_key
                  );
                ?>
              </td>
            </tr>
            <?php
          }
        }
        ?>

        <?php do_action( 'woocommerce_cart_contents' ); ?>
        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
      </tbody>
    </table>
</div>

  <div class="actions cart-action-row">
    <?php if ( wc_coupons_enabled() ) { ?>
      <div class="coupon form-row">
        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
        <button type="submit" class="btn btn-default" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
        <?php do_action( 'woocommerce_cart_coupon' ); ?>
      </div>
    <?php } ?>

    <button type="submit" class="btn btn-primary btn-small" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

    <?php do_action( 'woocommerce_cart_actions' ); ?>

    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
  </div>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>

  <div class="cart-collaterals">
    <div class="delivery-options">

      <!-- <input type="text" name="delivery_type" id="delivery_type" value="" size="40" class="input-text" placeholder="Same Day"> -->

      <div class="form-row form-row-wide">
        <label for="delivery_type"><?php esc_html_e( 'Type of delivery', 'jasminewater' ); ?></label>
        <div class="select-wrap">
          <!-- <select name="delivery_type" id="delivery_type" class="input-select" autocomplete="off" required="required" oninvalid="this.setCustomValidity('<?php /* esc_html_e( 'Please select a delivery type', 'jasminewater' ); */ ?>')" onvalid="this.setCustomValidity('')" onchange="this.setCustomValidity('')"> -->
          <script>
            var invalid_message = '<?php esc_html_e( 'Please select a delivery type', 'jasminewater' ); ?>';
          </script>
          <select name="delivery_type" id="delivery_type" class="input-select" autocomplete="off" > 
            <option value=""><?php esc_html_e( 'Select a type', 'jasminewater' ); ?></option>
            <option value="<?php esc_html_e( 'Morning', 'jasminewater' ); ?>"><?php esc_html_e( 'Morning', 'jasminewater' ); ?></option>
            <option value="<?php esc_html_e( 'Afternoon', 'jasminewater' ); ?>"><?php esc_html_e( 'Afternoon', 'jasminewater' ); ?></option>
          </select>
        </div>
      </div>

      <div class="form-row form-row-wide">
        <label for="delivery_date"><?php esc_html_e( 'Schedule delivery', 'jasminewater' ); ?></label>
        <input type="text" name="delivery_date" id="delivery_date" autocomplete="off" readonly value="" size="40" class="input-text" placeholder="<?php esc_html_e( 'Select Date', 'jasminewater' ); ?>">
        <span class="icon-wrap"> <i class="icon-datepicker"></i> </span>
      </div>

    </div>
    <?php
      /**
       * Cart collaterals hook.
       *
       * @hooked woocommerce_cross_sell_display
       * @hooked woocommerce_cart_totals - 10
       */
      do_action( 'woocommerce_cart_collaterals' );
    ?>
  </div>

</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<?php do_action( 'woocommerce_after_cart' ); ?>
