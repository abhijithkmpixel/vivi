<?php 

// /wp-json/wp/v2/user/orderedproduct

add_action('rest_api_init', 'details_order');
function details_order($request) {
  register_rest_route('wp/v2', 'user/orderedproduct', array(
    'methods' => 'GET',
    'callback' => 'details_order_handler',
  ));
}

function details_order_handler($request)
{

  $response = array();
  $error = new WP_Error();
  $parameters = $request->get_json_params();
  $language = $request["lang"];

  $order_id = $request["id"];

  $order = new WC_Order( $order_id );
  $items = $order->get_items();
  foreach ( $items as $item ) {
    $product_name = $item['name'];
    $product_id = $item['product_id'];
    $product_id = icl_object_id($product_id, 'product', false, $language);
    $product = wc_get_product( $product_id );
    $image_id = $product->get_image_id();
    $image_meta = get_post( $image_id );

    $product_details[] = array(
      'id'                =>  $product_id,
      'name'              =>  $product->get_name(),
      'images'            =>  array(
                                'id'   =>  $product->get_image_id(),
                                'name' =>  $image_meta->post_title,
                                'src'  =>  wp_get_attachment_image_url( $image_id, 'full' ),
                              ),
    );
  }

  $response = new WP_REST_Response( array( 'products_details' => $product_details ) );
  $response->set_status(200);

  return $response;
}


?>