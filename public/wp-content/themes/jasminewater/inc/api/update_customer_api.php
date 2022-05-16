<?php 

// /wp-json/wp/v2/user/update 

add_action('rest_api_init', 'wp_update_user_endpoints');
/**
 * Register a new user
 *
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function wp_update_user_endpoints($request) {
  /**
   * Handle Register User request.
   */
  register_rest_route('wp/v2', 'user/update', array(
    'methods' => 'POST',
    'callback' => 'wc_update_user_endpoint_handler',
  ));
}
function wc_update_user_endpoint_handler($request = null) {
  $response = array();
  $parameters = $request->get_json_params();
  $user_id = $request["user_id"];
  $first_name = $request["first_name"];
  $last_name = $request["last_name"];
  $email = $request["email"];
  $user_phone = $request["user_phone"];
  $user_mobile = $request["user_mobile"];
  $billing_address_1 = $request["billing_address_1"];
  $billing_address_2 = $request["billing_address_2"];
  //$billing_city = $request["billing_city"];
  $billing_state = $request["billing_state"];
  $billing_postcode = $request["billing_postcode"];

  $lang = $request["lang"];
  if($lang == 'ar') {
    $billing_city = 'مدينة الرياض';
  } elseif($lang == 'en') {
    $billing_city = 'Riyadh';
  } else {
    $billing_city = 'Riyadh';
  }  

  $error = new WP_Error();
  if (empty($user_id)) {
    $error->add(400, __("User id field 'user_id' is required.", 'wp-update-user'), array('status' => 400));
    return $error;
  }  

  $user = get_user_by( 'id', $user_id );
  $user_name = $user->user_login;
  $user_email_crt = $user->user_email;
  $user_mobile_crt = $user->user_mobile;

  if($first_name) {
    $first_name = $first_name;
  } else {
    $first_name = $user->first_name;
  }

  if($last_name) {
    $last_name = $last_name;
  } else {
    $last_name = $user->last_name;
  }

  if( $email && $email != $user_email_crt ) {
    if ( !preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email) ) {
      $error->add(401, __("Please enter valid email id", 'wp-update-user'), array('status' => 400));
      return $error;
    }
    if ( email_exists($email) == true) {
      $error->add(405, __("Email already exists, please try 'Reset Password'", 'wp-update-user'), array('status' => 400));
      return $error;   
    }
    $args = array(
        'ID'         => $user_id,
        'user_email' => $email
    );
    wp_update_user( $args );
  } 

  if($user_phone) {
    if( !preg_match("/^[0-9\-\(\)\/\+\s]{9,15}$/", $user_phone) && $user_phone ) {
      $error->add(404, __("Please enter valid phone number", 'wp-update-user'), array('status' => 400));
      return $error;
    }
    $user_phone = $user_phone;
  } else {
    $user_phone = $user->user_phone;
  }

  if( $user_mobile && $user_mobile != $user_mobile_crt ) {
    if( !preg_match("/^[0-9\-\(\)\/\+\s]{9,15}$/", $user_mobile) ) {
      $error->add(408, __("Please enter valid mobile number", 'wp-update-user'), array('status' => 400));
      return $error;
    }
    $hasPhoneNumber= get_users('meta_value='.$user_mobile);
    if ( !empty($hasPhoneNumber) ) {
      $error->add(406, __("Mobile number is already used", 'wp-update-user'), array('status' => 400));
      return $error;
    }
    $user_mobile = $user_mobile;
  } else {
    $user_mobile = $user->user_mobile;
  }

  if($billing_address_1) {
    $billing_address_1 = $billing_address_1;
  } else {
    $billing_address_1 = $user->billing_address_1;
  }

  if($billing_address_2) {
    $billing_address_2 = $billing_address_2;
  } else {
    $billing_address_2 = $user->billing_address_2;
  }

  if($billing_city) {
    $billing_city = $billing_city;
  } else {
    $billing_city = $user->billing_city;
  }

  if($billing_state) {
    $billing_state = $billing_state;
  } else {
    $billing_state = $user->billing_state;
  }

  if($billing_postcode) {
    $billing_postcode = $billing_postcode;
  } else {
    $billing_postcode = $user->billing_postcode;
  }  

  $meta = array(
    'first_name'          => $first_name,
    'billing_first_name'  => $first_name,
    'last_name'           => $last_name,
    'billing_last_name'   => $last_name,
    'billing_email'       => $email,
    'billing_phone'       => $user_phone,
    'user_phone'          => $user_phone,
    'user_mobile'         => $user_mobile,
    'billing_address_1'   => $billing_address_1,
    'billing_address_2'   => $billing_address_2,
    'billing_city'        => $billing_city,
    'billing_state'       => $billing_state,
    'billing_postcode'    => $billing_postcode,
    'billing_country'     => 'SA',
    'viaphp' => true
  );

  if (!is_wp_error($user_id)) {
    foreach( $meta as $key => $val ) {
      update_user_meta( $user_id, $key, $val ); 
    }
    $response['code'] = 200;
    $response['message'] = __("Updated user :'" . $user_name . "' ", "wp-update-user");
  } else {
    return $user_id;
  }

  return new WP_REST_Response($response, 123);
}

?>