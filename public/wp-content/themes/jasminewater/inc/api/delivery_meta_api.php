<?php 

// /wp-json/wp/v2/order/metadelivery

add_action('rest_api_init', 'order_meta_delivery');
/**
 * Check delivery date and type
 *
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function order_meta_delivery($request) {
  /**
   * Handle Delivery date and type request.
   */
  register_rest_route('wp/v2', 'order/metadelivery', array(
    'methods' => 'POST',
    'callback' => 'delivery_meta_handler',
  ));
}

function delivery_meta_handler($request = null) {
  $response = array();
  $parameters = $request->get_json_params();
  $order_id = $request["order_id"];
  $deliverydate = $request["deliverydate"];
  $deliverytype = $request["deliverytype"];

  $error = new WP_Error();

  if (empty($order_id)) {
    $error->add(400, __("Order id 'order_id' is required.", 'wc-delivery-meta'), array('status' => 400));
    return $error;
  }  

  $order = wc_get_order( $order_id );

  if (empty($deliverydate)) {
    $error->add(400, __("Delivery date 'deliverydate' is required.", 'wc-delivery-meta'), array('status' => 400));
    return $error;
  }

  if (empty($deliverytype)) {
    $error->add(400, __("Delivery type 'deliverytype' is required.", 'wc-delivery-meta'), array('status' => 400));
    return $error;
  }

  if ( $order ) {
    if (!is_wp_error($deliverydate) && !is_wp_error($deliverydate)) {
      
      update_post_meta( $order_id, '_delivery_type', $deliverytype );
      update_post_meta( $order_id, '_delivery_date', $deliverydate );

      $response['code'] = 200;
      $response['message'] = __("Delivery date is '" . $deliverydate . "' and Delivery type is '" . $deliverytype . "'", "wc-delivery-meta");
    } else {
      return array($deliverydate, $deliverytype);
    }
  } else {
    $error->add(406, __("No order exist", 'wc-delivery-meta'), array('status' => 400));
    return $error;
  }
  
  return new WP_REST_Response($response, 123);
}

?>