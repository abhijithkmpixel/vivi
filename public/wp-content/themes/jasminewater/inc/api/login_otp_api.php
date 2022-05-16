<?php 

// /wp-json/wp/v2/user/login/otp

add_action('rest_api_init', 'wp_rest_user_login_otp_endpoints');
/**
 * Register a new user
 *
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function wp_rest_user_login_otp_endpoints($request) {
  /**
   * Handle Register User request.
   */
  register_rest_route('wp/v2', 'user/login/otp', array(
    'methods' => 'POST',
    'callback' => 'wc_rest_user_login_otp_endpoint_handler',
  ));
}

use \Firebase\JWT\JWT;

function wc_rest_user_login_otp_endpoint_handler($request = null) {
  $response = array();
  $parameters = $request->get_json_params();
  $user_mobile = $request["user_mobile"];
  $error = new WP_Error();

  if (empty($user_mobile)) {
    $error->add(404, __("Phone field 'user_mobile' is required.", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if(!preg_match("/^[0-9\-\(\)\/\+\s]{5,15}$/", $user_mobile)) {
    $error->add(404, __("Please enter valid mobile number", 'wp-rest-user'), array('status' => 400));
    return $error;
  }

  $hasPhoneNumber = get_users(array(
      'meta_key' => 'user_mobile', 
      'meta_value' => $user_mobile, 
    )
  );
  foreach($hasPhoneNumber as $member) {
    $user_login = $member->user_login;
    $user_pass = $member->user_pass;
    $userID = $member->ID;
    $user_email = $member->user_email;
    $user_nicename = $member->user_nicename;
    $user_display_name = $member->display_name;
    $user_role = $member->roles;
    $user_first_name = $member->first_name;
    $user_last_name = $member->last_name;
    // $cart_count = count(WC()->cart->get_cart());

    $session_handler = new WC_Session_Handler();
    $session = $session_handler->get_session($userID);
    $cart_items = maybe_unserialize($session['cart']);
    $count = 0;
    foreach( $cart_items as $cart_item_key => $cart_item ) {
        $count++;
    }

    $cart_count = $count;

  }

  if (!empty($hasPhoneNumber)) {
    
    $secret_key = defined('JWT_AUTH_SECRET_KEY') ? JWT_AUTH_SECRET_KEY : false;
    $user = get_user_by( 'id', $userID );
    $issuedAt = time();
    $notBefore = apply_filters('jwt_auth_not_before', $issuedAt, $issuedAt);
    $expire = apply_filters('jwt_auth_expire', $issuedAt + (DAY_IN_SECONDS * 7), $issuedAt);
    $token = array(
        'iss' => get_bloginfo('url'),
        'iat' => $issuedAt,
        'nbf' => $notBefore,
        'exp' => $expire,
        'data' => array(
            'user' => array(
                'id' => $userID,
            ),
        ),
    );
    $token = JWT::encode(apply_filters('jwt_auth_token_before_sign', $token, $user), $secret_key);
    
    $response['token'] = $token;
    $response['user_email'] = $user_email;
    $response['user_nicename'] = $user_nicename;
    $response['user_display_name'] = $user_display_name;
    $response['user_role'] = $user_role;
    $response['user_id'] = $userID;
    $response['user_first_name'] = $user_first_name;
    $response['user_last_name'] = $user_last_name;
    $response['cart_count'] = $cart_count;
    
  } else {
    $error->add(406, __("No user registered with this mobile number", 'wp-login-otp-user'), array('status' => 400));
    return $error;    
  }

  return new WP_REST_Response($response, 123);
}

?>