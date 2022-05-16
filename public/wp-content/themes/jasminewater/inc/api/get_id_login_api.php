<?php 

// wp-json/jwt-auth/v1/token 

/*
 * Insert some additional data to the JWT Auth plugin
 */
function jwt_auth_function($data, $user) { 

    // $count = 0;
    // foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    //     $count++;
    // }

    // $cart_count = count(WC()->cart->get_cart());

    $data['user_role'] = $user->roles; 
    $data['user_id'] = $user->ID;
    $data['user_first_name'] = $user->first_name;
    $data['user_last_name'] = $user->last_name; 
    $data['user_mobile'] = $user->user_mobile; 
    // $data['avatar'] = get_avatar_url($user->ID);
    // $data['cart_count'] = $cart_count;

    $session_handler = new WC_Session_Handler();
    $session = $session_handler->get_session($user->ID);
    $cart_items = maybe_unserialize($session['cart']);
    $count = 0;
    foreach( $cart_items as $cart_item_key => $cart_item ) {
        $count++;
    }

    $data['cart_count'] = $count;

    return $data; 
} 
add_filter( 'jwt_auth_token_before_dispatch', 'jwt_auth_function', 10, 2 );


?>