<?php 

// /wp-json/wp/v2/user/zipcode

add_action('rest_api_init', 'user_zipcode_delivery');
/**
 * Check delivery
 *
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function user_zipcode_delivery($request) {
  /**
   * Handle Delivery Checking request.
   */
  register_rest_route('wp/v2', 'user/zipcode', array(
    'methods' => 'POST',
    'callback' => 'zipcode_endpoint_handler',
  ));
}

function zipcode_endpoint_handler($request = null) {
  $response = array();
  $parameters = $request->get_json_params();
  $error = new WP_Error();

  $zipcode = $request["zipcode"];
  if (empty($zipcode)) {
    $error->add(400, __("Zip code field 'zipcode' is required.", 'wp-zipcode-user'), array('status' => 400));
    return $error;
  }

  $user_name = $request["user_name"];
  if (empty($user_name)) {
    $error->add(401, __("Name field 'user_name' is required.", 'wp-zipcode-user'), array('status' => 400));
    return $error;
  }
  $user_email = $request["user_email"];
  if (empty($user_email)) {
    $error->add(402, __("Email field 'user_email' is required.", 'wp-zipcode-user'), array('status' => 400));
    return $error;
  }
  if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/", $user_email)) {
    $error->add(405, __("Please enter valid email", 'wp-zipcode-user'), array('status' => 400));
    return $error;
  }
  $user_phone = $request["user_phone"];
  if (empty($user_phone)) {
    $error->add(403, __("Phone field 'user_phone' is required.", 'wp-zipcode-user'), array('status' => 400));
    return $error;
  }
  if(!preg_match("/^[0-9\-\(\)\/\+\s]{5,15}$/", $user_phone)) {
    $error->add(404, __("Please enter valid phone number", 'wp-zipcode-user'), array('status' => 400));
    return $error;
  }

  if ( $zipcode ) {
    if ( !is_wp_error($zipcode) ) {
      $response['code']     = 200;
      $response['zipcode']  = $zipcode;
      $response['name']     = $user_name;
      $response['email']    = $user_email;
      $response['phone']    = $user_phone;
    } else {
      return array($zipcode, $user_name, $user_email, $user_phone);
    }

    $postcode_post = array(
      'post_title'    => $zipcode,
      'post_status'   => 'publish',
      'post_type'     => 'postcodes',
      'first_name'   =>  $user_name
    );
    $postcode_id  = wp_insert_post( $postcode_post );
    $post_date = get_post_field ('post_date', $postcode_id);
   
    add_post_meta( $postcode_id, 'postcode_user_name', $user_name, true );
    add_post_meta( $postcode_id, 'postcode_user_email', $user_email, true );
    add_post_meta( $postcode_id, 'postcode_user_phone', $user_phone, true );
    add_post_meta( $postcode_id, 'postcode_post_date', $post_date, true );

  } else {
    $error->add(406, __("Zipcode is empty'", 'wp-zipcode-user'), array('status' => 400));
    return $error;
  }

  return new WP_REST_Response($response, 123);
}

?>