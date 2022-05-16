<?php 

// disable nonce for cart API
add_filter( 'woocommerce_store_api_disable_nonce_check', '__return_true' );

// load cart
add_action( 'woocommerce_init', 'load_cart_function' );
function load_cart_function() {
	if ( ! WC()->is_rest_api_request() ) {
		return;
	}

	WC()->frontend_includes();

	if ( null === WC()->cart && function_exists( 'wc_load_cart') ) {
		wc_load_cart();
	}
}

// clear cart 
// add_action( 'init', 'woocommerce_clear_cart_url' );
// function woocommerce_clear_cart_url() {
// global $woocommerce;
// 	$woocommerce->cart->empty_cart(); 
// }
// clear cart end

// error log
function log_rest_api_errors( $result, $server, $request ) {
	if ( $result->is_error() ) {
		error_log( sprintf(
			"REST request: %s: %s",
			$request->get_route(),
			print_r( $request->get_params(), true )
		) );

		error_log( sprintf(
			"REST result: %s: %s",
			$result->get_matched_route(),
			print_r( $result->get_data(), true )
		) );
	}

	return $result;
}
add_filter( 'rest_post_dispatch', 'log_rest_api_errors', 10, 3 );
// error log end

//disable persistent cart
	add_filter( 'woocommerce_persistent_cart_enabled', '__return_false' );
//disable persistent cart end

// expiry time of session
	add_filter('wc_session_expiring', 900);
	add_filter('wc_session_expiration' , 900);
// expiry time of session end

// check cart item exist or not based on user id
	function check_cart_item_user($product_id) {
		foreach( WC()->cart->get_cart() as $cart_item_key => $values ) {
			$_product = $values['data'];
			$product_id = icl_object_id($product_id, 'product', false, 'ar');
			$_product_id = icl_object_id($_product->id, 'product', false, 'ar');
			//$product_cart_id = WC()->cart->generate_cart_id( $product_id );
			if( $product_id == $_product_id ) {
				//return $product_cart_id;
				//return $values['key'];
		    return array(
								'key' 			=> $values['key'],
             		'quantity' 	=> $values['quantity'],
							 );
			}
		}
	}
// check cart item exist or not based on user id end

//Increase or manage JWT Token Expiration time in wordpress
add_filter( 'jwt_auth_token_before_sign', 'increase_expiry_time_token', 10, 2 );
function increase_expiry_time_token( $token, $user)
{
  $issuedAt = time();
  $notBefore = apply_filters('jwt_auth_not_before', $issuedAt, $issuedAt);
  $expire = apply_filters('jwt_auth_expire', $issuedAt + (24*60*60*15), $issuedAt);
  $token = array(
    'iss' => get_bloginfo('url'),
    'iat' => $issuedAt,
    'nbf' => $notBefore,
    'exp' => $expire,
    'data' => array(
        'user' => array(
            'id' => $user->data->ID,
        )
    )
);
  return  $token;
}
//Increase or manage JWT Token Expiration time in wordpress end

// column for zip code post type
add_filter('manage_postcodes_posts_columns','filter_cpt_columns');
function filter_cpt_columns( $columns ) {
    $columns['user_name'] = 'Name';
    return $columns;
}

add_action( 'manage_posts_custom_column','action_custom_columns_content', 10, 2 );
function action_custom_columns_content ( $column_id, $post_id ) {
  switch( $column_id ) { 
    case 'user_name':
      echo ($value = get_post_meta($post_id, 'postcode_user_name', true ) ) ? $value : '-';
    break;
  } 
}

add_filter ( 'manage_postcodes_posts_columns', 'add_ourteam_columns' );
function add_ourteam_columns ( $columns ) {
  unset($columns['title']);
  unset($columns['user_name']);
  unset($columns['date']);
 	return array_merge ( $columns, array ( 
   	'title' => __ ('Zipcode'),
   	'user_name'   => __ ( 'Name' ),
   	'date' => __('Date')
 	) );
}
// column for zip code post type end

// order API - product details
add_action( 'rest_api_init', 'create_api_posts_meta_field' );
function create_api_posts_meta_field() {
  register_rest_field( 'shop_order', 'products', array(
         'get_callback'    => 'get_post_meta_for_api',
         'schema'          => null,
      )
  );
}
function get_post_meta_for_api( $object ) {
	$data = $object['id'];
	$order = new WC_Order( $data );
	$items = $order->get_items();
	foreach ( $items as $item ) {
	  $product_id = $item['product_id'];
	  $post_image =  get_post_thumbnail_id( $product_id );  
	  $post_image_url = wp_get_attachment_url( $post_image );
	  $product = wc_get_product( $product_id );
	  $product_details[] = array(
	    'product_id'        =>  $item['product_id'],
	    'product_name'     	=>  $item['name'],
	    'product_image'     =>  $post_image_url,
	    'product_quantity'  =>  $item['quantity'],
	    'product_subtotal'  =>  number_format($item['subtotal'], 2),
      // 'description'       =>  $product->get_description(),
      'short_description' =>  $product->get_short_description(),
	  );
	}
  return $product_details;
}
// order API - product details end




?>