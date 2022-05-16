<?php 

// /wp-json/wp/v2/user/clear_cart

add_action('rest_api_init', 'user_clear_cart');
function user_clear_cart($request) {
  register_rest_route('wp/v2', 'user/clear_cart', array(
    'methods' => 'GET',
    'callback' => 'user_clear_cart_handler',
  ));
}

function user_clear_cart_handler($request)
{

  WC()->cart->empty_cart();

  $response = new WP_REST_Response(
      array(
        'message' => 'Cart is empty',
      )
  );
  $response->set_status(200);

  return $response;
}


?>