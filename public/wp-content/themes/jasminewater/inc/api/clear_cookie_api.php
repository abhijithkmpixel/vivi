<?php 

// /wp-json/wp/v2/user/clear_cookie

add_action('rest_api_init', 'user_clear_cookie');
function user_clear_cookie($request) {
  register_rest_route('wp/v2', 'user/clear_cookie', array(
    'methods' => 'GET',
    'callback' => 'user_clear_cookie_handler',
  ));
}

function user_clear_cookie_handler($request)
{

  unset($_COOKIE['wpb_visit_time']);

  $response = new WP_REST_Response(
      array(
        'message' => 'Cart cookie is cleared',
      )
  );
  $response->set_status(200);

  return $response;
}


?>