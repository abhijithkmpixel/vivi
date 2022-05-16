<?php 

// /wp-json/wp/v2/user/updateCart

add_action('rest_api_init', 'update_cart_products');
function update_cart_products($request) {
  register_rest_route('wp/v2', 'user/updateCart', array(
    'methods' => 'POST',
    'callback' => 'update_cart_products_handler',
  ));
}

function update_cart_products_handler($request)
{

  $response = array();
  $error = new WP_Error();
  $parameters = $request->get_json_params();

  wc_load_cart();

  $language = $request["lang"];
  if (empty($language)) {
    $error->add(400, __("Language 'lang' required", 'wc-update-cart'), array('status' => 400));
    return $error;
  }

  $product_id = $request["product_id"];
  if (empty($product_id)) {
    $error->add(400, __("Product id 'product_id' required", 'wc-update-cart'), array('status' => 400));
    return $error;
  } 
  $product_id = icl_object_id($product_id, 'product', false, $language);

  $quantity = $request["quantity"];
  if (empty($quantity)) {
    $error->add(400, __("Quantity 'quantity' required", 'wc-update-cart'), array('status' => 400));
    return $error;
  }
 
  $items = WC()->cart->get_cart();
  foreach($items as $cart_item_key => $item) {
    $product = wc_get_product( $product_id );
    $in_cart = check_cart_item_user( $product_id );

    if($in_cart) {
      if (($item['product_id']) == $product_id) {
          WC()->cart->set_quantity( $cart_item_key, $quantity );
      }      
    } else {
      $error->add(400, __("No products found", 'wc-update-cart'), array('status' => 400));
      return $error;
    }
  }

  $product_details[] = array(
    'id'                =>  $product_id,
    'quantity'          =>  $quantity,
    'name'              =>  $product->get_name(),
  );

  wc_load_cart();

  $response = new WP_REST_Response( array( 'products_details' => $product_details ) );
  $response->set_status(200);

  return $response;
}


?>