<?php 

// /wp-json/wp/v2/user/cartTable

add_action('rest_api_init', 'cart_table_updates');
function cart_table_updates($request) {
  register_rest_route('wp/v2', 'user/cartTable', array(
    'methods' => 'GET',
    'callback' => 'cart_table_handler',
  ));
}

function cart_table_handler($request)
{

  $response = array();
  $error = new WP_Error();
  $parameters = $request->get_json_params();

  wc_load_cart();

  // $language = $request["lang"];
  // if (empty($language)) {
  //   $error->add(400, __("Language 'lang' required", 'wc-update-cart'), array('status' => 400));
  //   return $error;
  // }

  $user = wp_get_current_user();

  // Number of items
  $session_handler = new WC_Session_Handler();
  $session = $session_handler->get_session($user->ID);
  $cart_items = maybe_unserialize($session['cart']);
  $count = 0;
  foreach( $cart_items as $cart_item_key => $cart_item ) {
      $count++;
  }

  // Total value
  $regular_prices = 0;
  foreach( WC()->cart->get_cart() as $cart_item ){
    $product_id = $cart_item['product_id']; 
    $_product = wc_get_product( $product_id );
    $regular_prices += $_product->get_regular_price() * $cart_item['quantity'];
  }

  // Discount
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

  // Net amount
  $net_amount = WC()->cart->get_displayed_subtotal();

  // VAT 15%
  $sales_total = WC()->cart->total;
  $befr_vat = $sales_total/1.15;
  $vat_price = ($befr_vat*15)/100; 

  // Shipping
  $shipping = esc_html__( 'Free', 'woocommerce' );

  // Total including VAT
  $total_inc_vat = WC()->cart->total;
  
  $cart_table_values[] = array(
    'cart_count'        =>  $count,
    'total_value'       =>  number_format($regular_prices, 2),
    'discount'          =>  number_format($discount_total, 2),
    'net_amount'        =>  number_format($net_amount, 2),
    'vat_price'         =>  number_format($vat_price, 2),
    'shipping'          =>  $shipping,
    'total_inc_vat'     =>  $total_inc_vat,
  );

  wc_load_cart();


  $cart_table = get_field('cart_table', 'option');
  
  $cart_table_labels[] = array(
    'cart_count_label'    =>  $cart_table['number_of_item'],
    'total_value_label'   =>  $cart_table['total_regular_price'],
    'discount_label'      =>  $cart_table['discount_price'],
    'net_amount_label'    =>  $cart_table['total_sales_price'],
    'vat_price_label'     =>  $cart_table['vat_box'],
    'shipping_label'      =>  $cart_table['shipping_box'],
    'total_inc_vat_label' =>  $cart_table['total_inc_vat'],
  );

  $show_hide[] = array(
    'show_cart_count'     =>  $cart_table['show_num_of_product'],
    'show_coupon'         =>  $cart_table['show_coupan'],
    'show_shipping'       =>  $cart_table['show_shipping'],
  );


  $response = new WP_REST_Response( array( 'cart_table_values' => $cart_table_values, 'cart_table_labels' => $cart_table_labels, 'show_hide' => $show_hide ) );
  $response->set_status(200);

  return $response;
}


?>