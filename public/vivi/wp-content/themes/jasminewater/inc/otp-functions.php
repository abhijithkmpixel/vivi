<?php
function programmatic_login( $username ) {
  if ( is_user_logged_in() ) {
      wp_logout();
  }

  add_filter( 'authenticate', 'allow_programmatic_login', 10, 3 );    // hook in earlier than other callbacks to short-circuit them
  $user = wp_signon( array( 'user_login' => $username ) );
  remove_filter( 'authenticate', 'allow_programmatic_login', 10, 3 );

  if ( is_a( $user, 'WP_User' ) ) {
    wp_set_current_user( $user->ID, $user->user_login );

    if ( is_user_logged_in() ) {
        return true;
    }
  }

  return false;
}

function allow_programmatic_login( $user, $username, $password ) {
  return get_user_by( 'login', $username );
}

add_action("wp_ajax_check_user_exists", "check_user_exists");
add_action("wp_ajax_nopriv_check_user_exists", "check_user_exists");
function check_user_exists() {
  
  $nonce = $_POST['nonce'];
  if(!wp_verify_nonce($nonce, 'verify_user_nonce')) {
    wp_die('Busted!');  
  }

  $mobile_number = filter_var($_POST['mobile_number'], FILTER_SANITIZE_STRING);
  $user = get_user_by_mobile($mobile_number);

  $status = false;
  if(count($user) > 0){
    $status = true;
  }

  $user = array( 
    'action' => 'verify_user',
    'status' => $status
  );
  echo json_encode( $user );

  die();
}

add_action("wp_ajax_process_otp_login", "process_otp_login");
add_action("wp_ajax_nopriv_process_otp_login", "process_otp_login");
function process_otp_login() {
  
  $nonce = $_POST['nonce'];
  if(!wp_verify_nonce($nonce, 'otp_auth_nonce')) {
    wp_die('Busted!');  
  }

  $status = "";
  $idToken = filter_var($_POST['idToken'], FILTER_SANITIZE_STRING);
  $apiKey = filter_var($_POST['apiKey'], FILTER_SANITIZE_STRING);
  $phoneNumber = filter_var($_POST['phoneNumber'], FILTER_SANITIZE_STRING);

  $members = get_user_by_mobile($phoneNumber);

  $curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_URL => "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=".$apiKey."&idToken=".$idToken,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTPHEADER => array(
          "Content-length:0"
      )
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  $array_response = json_decode($response, true);
  $username = $members[0]->data->user_login;

  if (array_key_exists("users", $array_response) && count($members) != 0) {
    $user_res = $array_response["users"];
    if (count($user_res) > 0) {
      $user_res_1 = $user_res[0];
      if(array_key_exists("phoneNumber", $user_res_1)) {
        if($phoneNumber==$user_res_1['phoneNumber']){
          $status = programmatic_login($username);
        } else {
          $status = esc_html__( 'Invalid Login Request', 'jasminewater' );
        }
      } else {
        $status = esc_html__( 'No user exists with this phone number', 'jasminewater' );
      }
    } else {
      $status = esc_html__( 'Unknown Bad Request', 'jasminewater' );
    }
  } else {
    $status = esc_html__( 'Unable to process, Please try again later', 'jasminewater' );
  }

  $res = array( 
    'action' => 'otp_auth',
    'status' => $status
  );
  echo json_encode( $res );

  die();
}

function programmatic_register($userName, $emailAddress, $phoneNumber) {
  // random password with 12 chars
  $user_pass = wp_generate_password();
    
  // create new user with email as username & newly created pw
  $user_id = '';
  $user_id = wp_create_user( $userName, $user_pass, $emailAddress );

  if(is_wp_error($user_id)){

    $error = $user_id->get_error_message();
    print_r($error);
  
  } else {
    
    $user = new WP_User($user_id); // Get the WP_User Object instance from user ID
    $user->set_role('customer');   // Set the WooCommerce "customer" user role

    // Get all WooCommerce emails Objects from WC_Emails Object instance
    $emails = WC()->mailer()->get_emails();

    // Send WooCommerce "Customer New Account" email notification with the password
    $emails['WC_Email_Customer_New_Account']->trigger( $user_id, $user_pass, true );
    
    //WC guest customer identification
    update_user_meta( $user_id, 'guest', 'yes' );

    //user's billing data
    update_user_meta( $user_id, 'first_name', $userName );
    update_user_meta( $user_id, 'user_phone', $phoneNumber );
    update_user_meta( $user_id, 'user_mobile', $phoneNumber );
    
    // link past orders to this newly created customer
    wc_update_new_customer_past_orders( $user_id );

    $user = get_user_by('id', $user_id);
    return $user;

  }
}

add_action("wp_ajax_process_otp_register", "process_otp_register");
add_action("wp_ajax_nopriv_process_otp_register", "process_otp_register");
function process_otp_register() {
  
  $nonce = $_POST['nonce'];
  if(!wp_verify_nonce($nonce, 'otp_auth_nonce')) {
    wp_die('Busted!');  
  }

  $status = "";
  $emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_STRING);
  $phoneNumber = filter_var($_POST['phoneNumber'], FILTER_SANITIZE_STRING);
  $idToken = filter_var($_POST['idToken'], FILTER_SANITIZE_STRING);
  $apiKey = filter_var($_POST['apiKey'], FILTER_SANITIZE_STRING);

  $curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_URL => "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=".$apiKey."&idToken=".$idToken,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTPHEADER => array(
          "Content-length:0"
      )
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  $array_response = json_decode($response, true);

  $userName = $emailAddress;
  $parts = explode("@", $emailAddress);
  if (count($parts) == 2) {
    $userName = $parts[0];
  }

  $mobile_number = get_user_by_mobile( $phoneNumber );
  $mobile_exists = count($mobile_number);
  $email_exists = email_exists( $emailAddress );  
  $user_exists = username_exists( $userName );

  if (array_key_exists("users", $array_response)) {
    $user_res = $array_response["users"];
    if (count($user_res) > 0) {
      $user_res_1 = $user_res[0];
      if(array_key_exists("phoneNumber", $user_res_1)) {
        if($phoneNumber==$user_res_1['phoneNumber']){

          if( $user_exists == false && $email_exists == false && $mobile_exists ==  false ){
            $user_reg = programmatic_register($userName, $emailAddress, $phoneNumber);
            $username = $user_reg->data->user_login;
            if($username){
              $status = programmatic_login($username);
            } else {
              $status = esc_html__( 'Unable to create account, Please try again later', 'jasminewater' );
            }
          } else {
            if($user_exists == true || $email_exists == true){
              $status = esc_html__( 'Username / Email Address already exists.', 'jasminewater' );
            }
            if($mobile_exists == true){
              $status = esc_html__( 'Mobile Number already exists.', 'jasminewater' );
            }
          }

        } else {
          $status = esc_html__( 'Invalid Login Request', 'jasminewater' );
        }
      } else {
        $status = esc_html__( 'No user exists with this phone number', 'jasminewater' );
      }
    } else {
      $status = esc_html__( 'Unknown Bad Request', 'jasminewater' );
    }
  } else {
    $status = esc_html__( 'Unable to process, Please try again later', 'jasminewater' );
  }

  $res = array( 
    'action' => 'otp_register',
    'status' => $status
  );
  echo json_encode( $res );

  die();

}