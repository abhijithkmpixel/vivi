<?php 

// /wp-json/wp/v2/api/wc-nonce

// Key is X-WC-Store-API-Nonce

add_action('rest_api_init', 'wc_nonce_api');

function wc_nonce_api($request) {

  register_rest_route('wp/v2', 'api/wc-nonce', array(
    'methods' => 'GET',
    'callback' => 'generate_wc_nonce',
  ));
}

function generate_wc_nonce($request)
{
	$response = new WP_REST_Response(wp_create_nonce('wc_store_api'));
	$response->set_status(200);

	return $response;
}


?>