<?php 

// /wp-json/wp/v2/user/cartTableLabel

add_action('rest_api_init', 'cart_table_label_updates');
function cart_table_label_updates($request) {
  register_rest_route('wp/v2', 'user/cartTableLabel', array(
    'methods' => 'GET',
    'callback' => 'cart_table_label_handler',
  ));
}

function cart_table_label_handler($request)
{

  $response = array();
  $error = new WP_Error();
  $parameters = $request->get_json_params();

  // $language = $request["lang"];
  // if (empty($language)) {
  //   $error->add(400, __("Language 'lang' required", 'wc-update-cart'), array('status' => 400));
  //   return $error;
  // }

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

  $response = new WP_REST_Response( array( 'cart_table_labels' => $cart_table_labels, 'show_hide' => $show_hide ) );
  $response->set_status(200);

  return $response;
}


?>