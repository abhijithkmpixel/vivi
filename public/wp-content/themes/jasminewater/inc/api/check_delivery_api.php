<?php 

// /wp-json/wp/v2/user/location

add_action('rest_api_init', 'user_location_delivery');
/**
 * Check delivery
 *
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function user_location_delivery($request) {
  /**
   * Handle Delivery Checking request.
   */
  register_rest_route('wp/v2', 'user/location', array(
    'methods' => 'POST',
    'callback' => 'delivery_endpoint_handler',
  ));
}

function delivery_endpoint_handler($request = null) {
  $response = array();
  $parameters = $request->get_json_params();
  $error = new WP_Error();

  $latitude = $request["latitude"];
  if (empty($latitude)) {
    $error->add(400, __("Latitude field 'latitude' is required.", 'wp-location-user'), array('status' => 400));
    return $error;
  }
  $longitude = $request["longitude"];
  if (empty($longitude)) {
    $error->add(400, __("Longitude field 'longitude' is required.", 'wp-location-user'), array('status' => 400));
    return $error;
  }

  // $location = $request["location"];
  // if (empty($location)) {
  //   $error->add(400, __("Location field 'location' is required.", 'wp-location-user'), array('status' => 400));
  //   return $error;
  // }

  // $ip = $_SERVER['REMOTE_ADDR'];
  // $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
  // $location = $query['zip'];

  $queryString = http_build_query([
    'access_key' => 'f94d0e346ae44eb7df7322714f25130e',
    'query' => ''.$latitude.','.$longitude.'',
    'output' => 'json',
    'limit' => 1,
  ]);
  $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/reverse', $queryString));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($ch);
  curl_close($ch);
  $apiResult = json_decode($json, true);
  // print_r($apiResult);
  $data = $apiResult['data'];
  foreach($data as $post) {
    $location = $post['postal_code'];
    $country_code = $post['country_code'];
  }

  // $available = array('Riyadh');
  $zip_codes_given = get_field('delivery_zip_codes', 'options');
  $available = explode(" ", $zip_codes_given ); 

  // && $country_code=='SAU'

  if (in_array($location, $available) && $country_code=='SAU' && $location ) { // 50.094078, 8.497134 = 65931 (USA)
    if (!is_wp_error($location)) {
      $response['code'] = 200;
      $response['message'] = __("Delivery available for the zip code ".$location, "wp-location-user");
    } else {
      return $location;
    }
  } else {

    // $auth = apache_request_headers();
    // $valid = $auth['Authorization'];    

    // if($valid) {
    //   $postcode_post = array(
    //     'post_title'    => $location,
    //     'post_status'   => 'publish',
    //     'post_type'     => 'postcodes'
    //   );
    //   $postcode_id  = wp_insert_post( $postcode_post );
    //   $post_date = get_post_field ('post_date', $postcode_id);
    //   $author_id = get_post_field ('post_author', $postcode_id);
    //   $user_name = get_the_author_meta( 'display_name' , $author_id );
    //   $user_email = get_the_author_meta( 'user_email' , $author_id ); 

    //   add_post_meta( $postcode_id, 'postcode_user_name', $user_name, true );
    //   add_post_meta( $postcode_id, 'postcode_user_email', $user_email, true );
    //   add_post_meta( $postcode_id, 'postcode_post_date', $post_date, true );
    // }
    
    $error->add(406, __("Delivery not available for the zip code ".$location, 'wp-location-user'), array('zipcode' => $location, 'status' => 400));
    return $error;
  }
  
  return new WP_REST_Response($response, 123);
}

?>