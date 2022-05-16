<?php 

// /wp-json/wp/v2/user/change-password

add_action('rest_api_init', 'user_change_password');
/**
 * Check delivery
 *
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function user_change_password($request) {
  /**
   * Handle Delivery Checking request.
   */
  register_rest_route('wp/v2', 'user/change-password', array(
    'methods' => 'POST',
    'callback' => 'user_password_handler',
  ));
}

function user_password_handler($request = null) {
  $response = array();
  $parameters = $request->get_json_params();
  $error = new WP_Error();

  $user_id = $request["user_id"];
  if (empty($user_id)) {
    $error->add(400, __("Customer id field 'user_id' is required.", 'wp-password-user'), array('status' => 400));
    return $error;
  }

  $current_password = $request["current_password"];
  // if (empty($current_password)) {
  //   $error->add(400, __("Current password field 'current_password' is required.", 'wp-password-user'), array('status' => 400));
  //   return $error;
  // }

  $user = new WP_User($user_id);
  $password_hashed = $user->user_pass;
  $plain_password  = $current_password;
  wp_hash_password( $password );
  global $wp_hasher;
  $wp_hasher = new PasswordHash( 16, FALSE );

  if($current_password) {

    if( $wp_hasher->CheckPassword($plain_password, $password_hashed) ) {
      $response['code'] = 200;
      $response['message'] = __("Current password match", "wp-password-user");
    }
    else {
      $error->add(400, __("Current password is not correct", 'wp-password-user'), array('status' => 400));
      return $error;
    }

    $new_password = $request["new_password"];
    if (empty($new_password)) {
      $error->add(400, __("New password field 'new_password' is required.", 'wp-password-user'), array('status' => 400));
      return $error;
    }
   
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $new_password)) {
        echo '';
      $error->add(404, __("The password does not meet the requirements!", 'wp-password-user'), array('status' => 400));
      return $error;
    }

    $confirm_password = $request["confirm_password"];
    if (empty($confirm_password)) {
      $error->add(400, __("Confirm new password field 'confirm_password' is required.", 'wp-password-user'), array('status' => 400));
      return $error;
    }

    if ($new_password!=$confirm_password) {
      $error->add(404, __("Password and confirm password don't match", 'wp-password-user'), array('status' => 400));
      return $error;
    }

    if (!is_wp_error($user_id)) {
      wp_set_password($confirm_password , $user_id);
      $response['code'] = 200;
      $response['message'] = __("User password updated successfully", "wp-rest-user");
    } else {
      $error->add(404, __("User password updation failed", 'wp-password-user'), array('status' => 400));
      return $error;
    }

  } else {
    $response['code'] = 200;
    $response['message'] = __("Leave blank the Current password field 'current_password' to leave unchanged", "wp-rest-user");      
  }

  return new WP_REST_Response($response, 123);
}

?>