<?php

	// /wp-json/wp/v2/user/process_payment

		add_action('rest_api_init', 'wc_user_payment');

		function wc_user_payment($request) {

		  register_rest_route('wp/v2', 'user/process_payment', array(
		    'methods' => 'POST',
		    'callback' => 'process_payment_handler',
		  ));

		}


		function process_payment_handler($request) {

			$payment_response = array();
			$error = new WP_Error();

		  	$parameters = $request->get_json_params();
		  	$order_id = $request["order_id"];

			if (empty($order_id)) {
			    $error->add(400, __("Order id Field 'order_id' is required.", 'wp-payment-user'), array('status' => 400));
			    return $error;
			}

			$your_gateway 	= WC()->payment_gateways->payment_gateways()['woo_mpgs'];
			$api_version 	= $your_gateway->api_version;
			$merchant_id 	= $your_gateway->merchant_id;
			$auth_pass 		= $your_gateway->auth_pass;
			$service_host 	= $your_gateway->service_host;

			// $order_id = 1208;
			$order = wc_get_order( $order_id );

			// Prepare session request
			$session_request = array();
			$session_request['apiOperation']                = "CREATE_CHECKOUT_SESSION";
			$session_request['userId']                      = $order->get_user_id();
			$session_request['order']['id']                 = $order_id;
			$session_request['order']['amount']             = $order->get_total();
			$session_request['order']['currency']           = get_woocommerce_currency();


			$session_request['interaction']['returnUrl']    = add_query_arg( array( 'order_id' => $order_id, 'wc-api' => 'woo_mpgs' ), home_url('/') );
			if( (int) $api_version >= 52 ) {
				$session_request['interaction']['operation']    = "PURCHASE";
            }

			$request_url = $service_host . "api/rest/version/" . $api_version . "/merchant/" . $merchant_id . "/session";

			// Request the session
			$response_json = wp_remote_post( $request_url, array(
				'body'	  => json_encode ( $session_request ),
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( "merchant." . $merchant_id . ":" . $auth_pass ),
				),
			) );
			
			// $this->write_log($response_json);

			if ( is_wp_error( $response_json ) ) {

				wc_add_notice( __( 'Payment error: Failed to communicate with MPGS server. Make sure MPGS URL looks like `https://example.mastercard.com/` by removing `checkout/version/*/checkout.js` and end the URL with a slash "/".', 'woo-mpgs' ), 'error' );

				return array(
					'result'	=> 'fail',
					'redirect'	=> '',
				);
			}

			$response = json_decode( $response_json['body'], true );

			if( $response['result'] == 'SUCCESS' && ! empty( $response['successIndicator'] ) ) {

				update_post_meta( $order_id,'woo_mpgs_successIndicator', $response['successIndicator'] );
				update_post_meta( $order_id,'woo_mpgs_sessionVersion', $response['session']['version'] );

				$pay_url = add_query_arg( array(
					'sessionId'     => $response['session']['id'],
					'key'           => $order->get_order_key(),
					'pay_for_order' => false,
				), $order->get_checkout_payment_url() );

				$payment_url = $service_host.'checkout/pay/'.$response['session']['id'];

				return array(
					'result'		=> 'success',
					'redirect'		=> $pay_url,
					'payment_url'	=> $payment_url
				);

			} else {
				wc_add_notice( __( 'Payment error: ', 'woo-mpgs' ) . $response['error']['explanation'], 'error' );
			}

			$payment_response = new WP_REST_Response($pay_url);
	    	$payment_response->set_status(200);   

	    	return $payment_response;

		}


?>