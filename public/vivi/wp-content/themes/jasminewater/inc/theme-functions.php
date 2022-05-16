<?php
add_image_size( 'banner-inner', 1152, 500, true );
add_image_size( 'banner-inner-mobile', 375, 530, true );
add_image_size( 'about-image', 992, 400, true );
add_image_size( 'about-image-mobile', 335, 250, true );
add_image_size( 'news-thumb', 288, 280, true );
add_image_size( 'news-small', 340, 230, true );
add_image_size( 'news-large', 750, 360, true );
add_image_size( 'bottle-lg', 620, 540, false );
add_image_size( 'story-thumb', 426, 426, true );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}


function wooc_validate_re_captcha_field( $username, $email, $wpErrors )
{
    $remoteIP = $_SERVER['REMOTE_ADDR'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', [
        'body' => [
            'secret'   => '6LdI3NIaAAAAAKVWkG_5p6vpTY-tQfBidyWihFVR',
            'response' => $recaptchaResponse,
            'remoteip' => $remoteIP
        ]
    ] );

    $response_code = wp_remote_retrieve_response_code( $response );
    $response_body = wp_remote_retrieve_body( $response );

    if ( $response_code == 200 )
    {
        $result = json_decode( $response_body, true );

        if ( ! $result['success'] )
        {
            switch ( $result['error-codes'] )
            {
                case 'missing-input-secret':
                case 'invalid-input-secret':
                    $wpErrors->add( 'recaptcha', __( '<strong>ERROR</strong>: Invalid reCAPTCHA secret key.', 'woocommerce' ) );
                    break;

                case 'missing-input-response' :
                case 'invalid-input-response' :
                    $wpErrors->add( 'recaptcha', __( '<strong>ERROR</strong>: Please check the box to prove that you are not a robot.', 'woocommerce' ) );
                    break;

                default:
                    $wpErrors->add( 'recaptcha', __( '<strong>ERROR</strong>: Something went wront validating the reCAPTCHA.', 'woocommerce' ) );
                    break;
            }
        }
    }
    else
    {
        $wpErrors->add( 'recaptcha_error', __( '<strong>Error</strong>: Unable to reach the reCAPTCHA server.', 'woocommerce' ) );
    }
}
add_action( 'woocommerce_register_post', 'wooc_validate_re_captcha_field', 10, 3 );