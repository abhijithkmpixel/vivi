<?php 

// /wp-json/wp/v2/user/register 

add_action('rest_api_init', 'wp_rest_user_endpoints');
/**
 * Register a new user
 *
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function wp_rest_user_endpoints($request) {
  /**
   * Handle Register User request.
   */
  register_rest_route('wp/v2', 'user/register', array(
    'methods' => 'POST',
    'callback' => 'wc_rest_user_endpoint_handler',
  ));
}
function wc_rest_user_endpoint_handler($request = null) {
  $response = array();
  $parameters = $request->get_json_params();
  $account = $request["account"];
  $first_name = $request["first_name"];
  $last_name = $request["last_name"];
  $email = $request["email"];
  $username = strstr($email, '@', true);
  $password = $request["password"];
  $password2 = $request["password2"];
  $user_phone = $request["user_phone"];
  $user_mobile = $request["user_mobile"];
  $billing_address_1 = $request["billing_address_1"];
  $billing_address_2 = $request["billing_address_2"];
  $billing_city = $request["billing_city"];
  $billing_state = $request["billing_state"];
  $billing_postcode = $request["billing_postcode"];
  // $role = sanitize_text_field($parameters['role']);
  $error = new WP_Error();
  // if (empty($account)) {
  //   $error->add(400, __("Account field 'account' is required. Choose Business as 'business' or Individual as 'individual'", 'wp-rest-user'), array('status' => 400));
  //   return $error;
  // }
  if (empty($first_name)) {
    $error->add(400, __("First name field 'first_name' is required.", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if (empty($last_name)) {
    $error->add(400, __("Last name field 'last_name' is required.", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if (empty($email)) {
    $error->add(401, __("Email field 'email' is required.", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
    $error->add(401, __("Please enter valid email id", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if (empty($password)) {
    $error->add(404, __("Password field 'password' is required.", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
      echo '';
    $error->add(404, __("The password does not meet the requirements!", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if (empty($password2)) {
    $error->add(404, __("Confirm password field 'password2' is required.", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password2)) {
      echo '';
    $error->add(404, __("The password does not meet the requirements!", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if ($password!=$password2) {
    $error->add(404, __("Password and confirm password don't match", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  // if($account=='business') {
  //   if (empty($user_phone)) {
  //     $error->add(404, __("Phone field 'user_phone' is required.", 'wp-rest-user'), array('status' => 400));
  //     return $error;
  //   }
  //   if(!preg_match("/^[0-9\-\(\)\/\+\s]{5,15}$/", $user_phone)) {
  //     $error->add(404, __("Please enter valid phone number", 'wp-rest-user'), array('status' => 400));
  //     return $error;
  //   }
  // }
  if (empty($user_mobile)) {
    $error->add(404, __("Phone field 'user_mobile' is required.", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if(!preg_match("/^[0-9\-\(\)\/\+\s]{5,15}$/", $user_mobile)) {
    $error->add(404, __("Please enter valid mobile number", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  $hasPhoneNumber= get_users('meta_value='.$user_mobile);
  if ( !empty($hasPhoneNumber)) {
    $error->add(406, __("Mobile number is already used", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  if (empty($billing_address_1)) {
    $error->add(404, __("House number and street name field 'billing_address_1' is required. Apartment, suite, unit, etc. field 'billing_address_2' is optional.", 'wp-rest-user'), array('status' => 400));
    return $error;
  }
  // if (empty($billing_address_2)) {
  //   $error->add(404, __("Apartment, suite, unit, etc. (optional) field 'billing_address_2' is required.", 'wp-rest-user'), array('status' => 400));
  //   return $error;
  // }
  // if (empty($billing_city)) {
  //   $error->add(404, __("Town / City field 'billing_city' is required.", 'wp-rest-user'), array('status' => 400));
  //   return $error;
  // }
  // if (empty($billing_state)) {
  //   $error->add(404, __("State / County field 'billing_state' is required.", 'wp-rest-user'), array('status' => 400));
  //   return $error;
  // }
  // if (empty($billing_postcode)) {
  //   $error->add(404, __("Postcode / ZIP field 'billing_postcode' is required.", 'wp-rest-user'), array('status' => 400));
  //   return $error;
  // }
  // if (empty($role)) {
  //  $role = 'subscriber';
  // } else {
  //     if ($GLOBALS['wp_roles']->is_role($role)) {
  //      // Silence is gold
  //     } else {
  //    $error->add(405, __("Role field 'role' is not a valid. Check your User Roles from Dashboard.", 'wp_rest_user'), array('status' => 400));
  //    return $error;
  //     }
  // }
  $user_id = username_exists($username);
  if ( email_exists($email) == false) {

    $meta = array(
      'salutation'          => $account,
      'first_name'          => $first_name,
      'last_name'           => $last_name,
      'billing_phone'       => $user_phone,
      'user_phone'          => $user_phone,
      'user_mobile'         => $user_mobile,
      'billing_address_1'   => $billing_address_1,
      'billing_address_2'   => $billing_address_2,
      'billing_city'        => 'Riyadh',
      'billing_state'       => $billing_state,
      'billing_postcode'    => $billing_postcode,
      'billing_country'     => 'SA',
      'viaphp' => true
    );

    $args = array(
        'role'        => 'Customer',
        'orderby'     => 'registered',
        'order'       => 'DESC',
        'number'      => 1
    );
    $users = get_users( $args );
    foreach ( $users as $user ) {
        $the_user_id = $user->ID + 1;  
    }

    if(!$user_id) {
      $user_name = $username;
    } else {
      $user_name = $username.'-'.$the_user_id;
    }

    $user_id = wp_create_user($user_name, $password, $email);
    if (!is_wp_error($user_id)) {

      foreach( $meta as $key => $val ) {
        update_user_meta( $user_id, $key, $val ); 
      }

      // Ger User Meta Data (Sensitive, Password included. DO NOT pass to front end.)
      $user = get_user_by('id', $user_id);
      // $user->set_role($role);
      $user->set_role('subscriber');
      // WooCommerce specific code
      if (class_exists('WooCommerce')) {
        $user->set_role('customer');
      }
      // Ger User Data (Non-Sensitive, Pass to front end.)
      $response['code'] = 200;
      $response['message'] = __("User '" . $user_name . "' Registration was Successful", "wp-rest-user");
    } else {
      return $user_id;
    }
  } else {
    $error->add(405, __("Email already exists, please try 'Reset Password'", 'wp-rest-user'), array('status' => 400));
    return $error;
  }

  // if (username_exists($username) == false) {
  //   $error->add(406, __("Email already exists, please try 'Reset Password'", 'wp-rest-user'), array('status' => 400));
  //   return $error;
  // }

  // if (email_exists($email) == false) {
  //   $error->add(406, __("User already exists, please try 'Reset Password'", 'wp-rest-user'), array('status' => 400));
  //   return $error;
  // }

  // email 
  $emails = WC()->mailer()->get_emails();
  $emails['WC_Email_Customer_New_Account']->trigger( $user_id, $password, true );
  // email end

  return new WP_REST_Response($response, 123);
}

?>