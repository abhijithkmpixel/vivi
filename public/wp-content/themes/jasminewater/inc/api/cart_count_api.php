<?php 

// /wp-json/wp/v2/user/cart_count

add_action('rest_api_init', 'user_cart_count');
function user_cart_count($request) {
  register_rest_route('wp/v2', 'user/cart_count', array(
    'methods' => 'GET',
    'callback' => 'user_cart_count_handler',
  ));
}

function user_cart_count_handler($request)
{

  // $count = 0;
  // foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
  //     $count++;
  // }

  // $cart_count = count(WC()->cart->get_cart());

  $user = wp_get_current_user();

  $session_handler = new WC_Session_Handler();
  $session = $session_handler->get_session($user->ID);
  $cart_items = maybe_unserialize($session['cart']);
  $count = 0;
  foreach( $cart_items as $cart_item_key => $cart_item ) {
      $count++;
  }

  $response = new WP_REST_Response(
      array(
        'user_cart_count' => $count,
      )
  );
  $response->set_status(200);

  return $response;
}


?>