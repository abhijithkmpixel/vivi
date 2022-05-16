<?php 

// /wp-json/wp/v2/user/feedback

add_action('rest_api_init', 'user_feedback');
/**
 * Check user feedback
 *
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function user_feedback($request) {
  /**
   * Handle user feedback
   */
  register_rest_route('wp/v2', 'user/feedback', array(
    'methods' => 'POST',
    'callback' => 'user_feedback_handler',
  ));
}

function user_feedback_handler($request = null) {
  $response = array();
  $parameters = $request->get_json_params();
  $starcount = $request["starcount"];
  $reason = $request["reason"];
  $messages = $request["messages"];

  $error = new WP_Error();

  if (empty($starcount)) {
    $error->add(400, __("Star count 'starcount' is required.", 'wp-user-feedback'), array('status' => 400));
    return $error;
  }

  // if (empty($reason)) {
  //   $error->add(400, __("Reason 'reason' is required.", 'wp-user-feedback'), array('status' => 400));
  //   return $error;
  // }

  // if (empty($messages)) {
  //   $error->add(400, __("Message type 'messages' is required.", 'wp-user-feedback'), array('status' => 400));
  //   return $error;
  // }

  if ( $starcount ) {
    if (!is_wp_error($starcount) && !is_wp_error($reason) && !is_wp_error($messages)) {
      $response['code'] = 200;
      $response['starcount']  = $starcount;
      $response['reason']     = $reason;
      $response['messages']   = $messages;
    } else {
      return array($starcount, $reason, $messages);
    }

    $feedback_post = array(
      'post_title'    => 'Feedback',
      'post_status'   => 'publish',
      'post_type'     => 'feedbacks'
    );
    $feedback_id  = wp_insert_post( $feedback_post );
    $post_date = get_post_field ('post_date', $feedback_id);
    $author_id = get_post_field ('post_author', $feedback_id);
    $user_name = get_the_author_meta( 'display_name' , $author_id );
    $user_email = get_the_author_meta( 'user_email' , $author_id ); 

    add_post_meta( $feedback_id, 'feedback_user_name', $user_name, true );
    add_post_meta( $feedback_id, 'feedback_user_email', $user_email, true );
    add_post_meta( $feedback_id, 'feedback_post_date', $post_date, true );
    add_post_meta( $feedback_id, 'feedback_star_count', $starcount, true );
    add_post_meta( $feedback_id, 'feedback_reason', $reason, true );
    add_post_meta( $feedback_id, 'feedback_message', $messages, true );

  } else {
    $error->add(406, __("Feedback fields are empty'", 'wp-user-feedback'), array('status' => 400));
    return $error;
  }
  
  return new WP_REST_Response($response, 123);
}

?>