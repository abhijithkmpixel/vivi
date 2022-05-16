<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Jasmine_Water
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function jasminewater_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 180,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'jasminewater_woocommerce_setup' );

// set thumbnails size in shop page
add_filter( 'woocommerce_get_image_size_thumbnail', 'ci_theme_override_woocommerce_image_size_thumbnail' );
function ci_theme_override_woocommerce_image_size_thumbnail( $size ) {
    // Catalog images: specific size
    return array(
        'width'  => 220,
        // 'height' => 400,
        'crop'   => 0, // not cropped
    );
}

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function jasminewater_woocommerce_scripts() {
	
  $font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'jasminewater-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'jasminewater_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function jasminewater_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'jasminewater_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function jasminewater_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jasminewater_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'jasminewater_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function jasminewater_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'jasminewater_woocommerce_wrapper_before' );

if ( ! function_exists( 'jasminewater_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function jasminewater_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'jasminewater_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'jasminewater_woocommerce_header_cart' ) ) {
			jasminewater_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'jasminewater_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function jasminewater_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		jasminewater_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'jasminewater_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'jasminewater_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function jasminewater_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'jasminewater' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'jasminewater' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'jasminewater_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function jasminewater_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php jasminewater_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

//Add Quantity Input
add_filter( 'woocommerce_loop_add_to_cart_link', function( $html, $product ) {

  global $woocommerce;
  $cart = $woocommerce->cart;

  $cart_item_qty = $cart->get_cart_item_quantities();
  $active_class = ($cart_item_qty[$product->get_id()]) ?  'active' : '';
  $product_detail = get_field('product_detail', 'options');

  if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
	    $promotion_details = get_field('promotion_details', $product->get_id());
	    $html = '<p class="promotion_details">'.$promotion_details.'</p>';
      $html .= '<div class="btn-wrap flex flex-center">';
      if($product_detail):
      $html .= '<a href="' . get_permalink() . '" class="btn btn-default btn-simple">More info</a>';
      else:
      $html .= '<a href="#" addthis:url="' . get_permalink( woocommerce_get_page_id( 'shop' ) ) . '" addthis:title="' . get_the_title() . '" addthis:description="' .wp_trim_words( get_the_excerpt(), 10 ). '" addthis:media="' . get_the_post_thumbnail_url() . '" class="btn btn-default btn-simple addthis_toolbox addthis_button_compact"> '.esc_html__( 'Share', 'woocommerce' ).' </a>';
      endif;
      $html .= '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="vivi-quantity cart ' . $active_class . ' " method="post" enctype="multipart/form-data">';
      $html .= woocommerce_quantity_input( array('product_id' => $product->get_id(), 'product_val' => $cart_item_qty[$product->get_id()] ), $product, false );

      // $html .= '<button type="submit" class="btn btn-primary loop_add_to_cart_button btn-simple">' . esc_html( $product->add_to_cart_text() ) . '</button>';
      if ( is_user_logged_in() ) {
        $html .= '<button type="submit" class="btn btn-primary loop_add_to_cart_button btn-simple">' . esc_html( $product->add_to_cart_text() ) . '</button>';
      } else {
        $site_url = (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url() .'\\/en' ;
        $login = $site_url . '/login';
        $html .= '<a href="'.$login.'" class="btn btn-primary btn-simple">' . esc_html( $product->add_to_cart_text() ) . '</a>';
      }

      $html .= '</form>';
      $html .= '</div>';
  }
  return $html;
}, 10, 2 );

//Add Product Desc
function jasminewater_excerpt_in_product_archives() {
  echo '<p class="woocommerce-loop-product__desc">'.wp_trim_words( get_the_excerpt(), 10 ).'</p>';
}
add_action( 'woocommerce_shop_loop_item_title', 'jasminewater_excerpt_in_product_archives', 40 );

//Change Loop Count
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

//Remove From Products
add_action( 'after_setup_theme', 'remove_product_info', 99 );
function remove_product_info() { 
  remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
  remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );
  remove_action( 'woocommerce_before_main_content' , 'woocommerce_breadcrumb', 20 );
  remove_action( 'woocommerce_after_single_product_summary' , 'woocommerce_output_product_data_tabs', 10 );
  remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_title', 5 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );
}

// AddProduct Short Desc to Cart
function excerpt_in_cart($cart_item_html, $product_data) {
  global $_product;
  $excerpt = get_the_excerpt($product_data['product_id']);
  $excerpt = substr($excerpt, 0, 80);
  echo $cart_item_html . '<span class="short-description"> &nbsp; ' . $excerpt . '</span>';
}
  
add_filter('woocommerce_cart_item_name', 'excerpt_in_cart', 40, 2);

//Remove Gallery Zoom
function remove_image_zoom_support() {
  remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

/**
 * Custom currency and currency symbol
 */
add_filter( 'woocommerce_currencies', 'add_vivi_currency' );
function add_vivi_currency( $currencies ) {
     $currencies['SAR'] = __( 'Saudi Riyal', 'woocommerce' );
     return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_vivi_currency_symbol', 10, 2);
function add_vivi_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'SAR': $currency_symbol = __( 'SAR', 'jasminewater' ); break;
     }
     return $currency_symbol;
}



add_action("wp_ajax_update_cart_status", "update_cart_status");
add_action("wp_ajax_nopriv_update_cart_status", "update_cart_status");
function update_cart_status() {
  global $woocommerce;
  $cart = $woocommerce->cart;
  // $cart = WC()->cart;
  $nonce = $_POST['nonce'];
  if(!wp_verify_nonce($nonce, 'update_cart_nonce')) {
    wp_die('Busted!');  
  }
  $cart_item_qty = filter_var($_POST['cart_item_qty'], FILTER_SANITIZE_STRING);
  $cart_item_key = filter_var($_POST['cart_item_key'], FILTER_SANITIZE_STRING);
  $cart_item_id = filter_var($_POST['cart_item_id'], FILTER_SANITIZE_STRING);

  foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
    if ( $cart_item['product_id'] == $cart_item_id ) {
      $cart->remove_cart_item( $cart_item_key );
    }
  }

  if ( isset( $cart_item_key, $cart_item_qty ) ) {
    if ( (float) $cart_item_qty > 0 ) {
      $cart->add_to_cart((float) $cart_item_id, (float) $cart_item_qty);
      // $cart->set_quantity( (float) $cart_item_id, (float) $cart_item_qty );
    }
  }

  $cart_item_list = array();
  $loop = 0;
  foreach( $cart->get_cart_item_quantities() as $id => $count ){
    // array_push($cart_item_list, array(  ));
    $cart_item_list[$loop]['id'] = $id;
    $cart_item_list[$loop]['title'] = get_the_title($id);
    $cart_item_list[$loop]['count'] = $count;
    $loop++;
  }

  $cart = array( 
    'action' => 'cart_updated',
    'cart_item_id' => $cart_item_id,
    'cart_item_title' => get_the_title($cart_item_id),
    'cart_total_count' => count($cart_item_list),
    // 'cart_items' => $cart->get_cart_item_quantities(),
    'cart_items' => $cart_item_list
  );
  echo json_encode( $cart );
  die();
}



add_action( 'woocommerce_before_order_notes', 'add_delivery_cart_hidden_checkout_field' );
function add_delivery_cart_hidden_checkout_field( $checkout ) { 
  //  $current_user = wp_get_current_user();
  //  $saved_license_no = $current_user->license_no;
  $delivery_type = $_POST['delivery_type'];
  $delivery_date = $_POST['delivery_date'];

  if($delivery_type){
    woocommerce_form_field( 'delivery_type', array(        
      'type' => 'text',        
      'class' => array( 'form-row-wide' ),        
      'label' => esc_html__('Delivery Type', 'woocommerce'),        
      'placeholder' => '',        
      'required' => true,
      'value'=> $delivery_type,
      'default' => 'Same Day',        
    ), $checkout->get_value( 'delivery_type' ) ); 
  }

  if($delivery_date){
    woocommerce_form_field( 'delivery_date', array(        
      'type' => 'text',        
      'class' => array( 'form-row-wide' ),        
      'label' => esc_html__('Delivery Date', 'woocommerce'),        
      'placeholder' => $delivery_date,        
      'required' => true,
      'value'=> $delivery_date,   
      'default' => '',        
    ), $checkout->get_value( 'delivery_date' ) ); 
  }
}

add_action( 'woocommerce_checkout_process', 'add_delivery_cart_validate_new_checkout_field' );
function add_delivery_cart_validate_new_checkout_field() {    
  if ( ! $_POST['delivery_type'] ) {
    wc_add_notice( 'Please select Delivery Type', 'error' );
  }
  if ( ! $_POST['delivery_date'] ) {
    wc_add_notice( 'Please select Delivery Date', 'error' );
  }
}

add_action( 'woocommerce_checkout_update_order_meta', 'add_delivery_cart_save_new_checkout_field' );
function add_delivery_cart_save_new_checkout_field( $order_id ) { 
    if ( $_POST['delivery_type'] ) update_post_meta( $order_id, '_delivery_type', esc_attr( $_POST['delivery_type'] ) );
    if ( $_POST['delivery_date'] ) update_post_meta( $order_id, '_delivery_date', esc_attr( $_POST['delivery_date'] ) );
}
  
add_action( 'woocommerce_admin_order_data_after_billing_address', 'add_delivery_cart_show_new_checkout_field_order', 10, 1 );
function add_delivery_cart_show_new_checkout_field_order( $order ) {    
   $order_id = $order->get_id();
   if ( get_post_meta( $order_id, '_delivery_type', true ) ) echo '<p><strong>Delivery Type:</strong> ' . get_post_meta( $order_id, '_delivery_type', true ) . '</p>';
   if ( get_post_meta( $order_id, '_delivery_date', true ) ) echo '<p><strong>Delivery Date:</strong> ' . get_post_meta( $order_id, '_delivery_date', true ) . '</p>';
}
 
add_action( 'woocommerce_email_after_order_table', 'add_delivery_cart_show_new_checkout_field_emails', 20, 4 );
function add_delivery_cart_show_new_checkout_field_emails( $order, $sent_to_admin, $plain_text, $email ) {
  if ( get_post_meta( $order->get_id(), '_delivery_type', true ) ) echo '<p><strong>Delivery Type:</strong> ' . get_post_meta( $order->get_id(), '_delivery_type', true ) . '</p>';
  if ( get_post_meta( $order->get_id(), '_delivery_date', true ) ) echo '<p><strong>Delivery Date:</strong> ' . get_post_meta( $order->get_id(), '_delivery_date', true ) . '</p>';
}

/**
 * Product filter on the shop page
 */
function filter_pre_get_posts_query( $q ) {

  $tax_query = (array) $q->get( 'tax_query' );
  $orderby = $_POST['orderby'];
  $sort = $_POST['sort'];
  $sku = $_POST['sku'];

  if($sort != ''){
    $sort = explode(',', $sort);
  }
  if($sku != ''){
    $sku = explode(',', $sku);
  }

  if(count($sort) != 0 && $sort != ''){
    $tax_query[] = array(
      'taxonomy' => 'product_tag',
      'field' => 'slug',
      'terms' => $sort,
      'operator' => 'IN'
    );
  }

  if(count($sku) != 0 && $sku != ''){
    $tax_query[] = array(
      'taxonomy' => 'product_cat',
      'field' => 'slug',
      'terms' => $sku,
      'operator' => 'IN'
    );
  }

  $q->set( 'tax_query', $tax_query );
  $q->set( 'posts_per_page', 9 );

}
add_action( 'woocommerce_product_query', 'filter_pre_get_posts_query' ); 





// Function to check starting char of a string
function startsWith($haystack, $needle){
  return $needle === '' || strpos($haystack, $needle) === 0;
}


// Adding Account Fields
add_filter('user_contactmethods', 'custom_user_contactmethods');
function custom_user_contactmethods($user_contact){ 
  $user_contact['user_phone'] = 'Phone';
  $user_contact['user_mobile'] = 'Mobile';
  return $user_contact;
}

add_action( 'woocommerce_save_account_details', 'my_account_saving_billing_phone', 10, 1 );
function my_account_saving_billing_phone( $user_id ) {
  $user_phone = $_POST['user_phone'];
  $user_mobile = $_POST['user_mobile'];
  if( ! empty( $user_phone ) ){
    update_user_meta( $user_id, 'user_phone', sanitize_text_field( $user_phone ) );
    update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $user_phone ) );
  }
  if( ! empty( $user_mobile ) ){
    update_user_meta( $user_id, 'user_mobile', sanitize_text_field( $user_mobile ) );
  }     
}

add_action( 'woocommerce_created_customer', 'custom_save_extra_register_fields' );
function custom_save_extra_register_fields( $customer_id ) {
  $user_phone = $_POST['user_phone'];
  $user_mobile = $_POST['user_mobile'];
  if (isset($user_phone)) {
    update_user_meta( $customer_id, 'user_phone', sanitize_text_field($_POST['user_phone']));
    update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $user_phone ) );
  }
  if (isset($user_mobile)) {
    update_user_meta($customer_id, 'user_mobile', sanitize_text_field($_POST['user_mobile']));
  }
}

// Custom function to display the Billing Address form to registration page
function vivi_add_billing_form_to_registration(){
  global $woocommerce;
  $checkout = $woocommerce->checkout();
  ?>
  <?php foreach ( $checkout->get_checkout_fields( 'billing' ) as $key => $field ) : ?>

      <?php
      if($key!='billing_email' && $key!='billing_phone' && $key!='billing_address_2' && $key!='billing_state' && $key!='billing_postcode'){ 
          woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
      }
      ?>

  <?php endforeach; 
}
add_action('woocommerce_register_form_start','vivi_add_billing_form_to_registration');

// Custom function to save Usermeta or Billing Address of registered user
function vivi_save_billing_address($user_id){
  global $woocommerce;
  $address = $_POST;
  foreach ($address as $key => $field){
      if(startsWith($key,'billing_')){
          // Condition to add firstname and last name to user meta table
          if($key == 'billing_first_name' || $key == 'billing_last_name'){
              $new_key = explode('billing_',$key);
              update_user_meta( $user_id, $new_key[1], $_POST[$key] );
          }
          update_user_meta( $user_id, $key, $_POST[$key] );
      }
  }

}
add_action('woocommerce_created_customer','vivi_save_billing_address');

// Registration page billing address form Validation
function vivi_validation_billing_address( $errors ) {
  $address = $_POST;
  foreach ($address as $key => $field) :
      if(startsWith($key,'billing_')){
          if($key == 'billing_country' && $field == ''){
              add_the_error($errors, $key, 'Country');
          }
          if($key == 'billing_first_name' && $field == ''){
              add_the_error($errors, $key, 'First Name');
          }
          if($key == 'billing_last_name' && $field == ''){
              add_the_error($errors, $key, 'Last Name');
          }
          if($key == 'billing_address_1' && $field == ''){
              add_the_error($errors, $key, 'Address');
          }
          if($key == 'billing_city' && $field == ''){
              add_the_error($errors, $key, 'City');
          }
          // if($key == 'billing_state' && $field == ''){
          //     add_the_error($errors, $key, 'State');
          // }
          // if($key == 'billing_postcode' && $field == ''){
          //     add_the_error($errors, $key, 'Post Code');
          // }
          // if($key == 'billing_phone' && $field == ''){
          //     add_the_error($errors, $key, 'Phone Number');
          // }

      }
  endforeach;

  return $errors;
}
add_filter( 'woocommerce_registration_errors', 'vivi_validation_billing_address', 10 );

function add_the_error( $errors, $key, $field_name ) {
  $message = sprintf( __( '%s is a required field.', 'iconic' ), '<strong>' . $field_name . '</strong>' );
  $errors->add( $key, $message );
}

add_filter( 'woocommerce_billing_fields', 'remove_account_billing_phone_and_email_fields', 20, 1 );
function remove_account_billing_phone_and_email_fields( $billing_fields ) {
    // Only on my account 'edit-address'
    if( is_wc_endpoint_url( 'edit-address' ) ){
        unset($billing_fields['billing_phone']);
        unset($billing_fields['billing_email']);
    }
    return $billing_fields;
}


add_filter( 'woocommerce_login_redirect', 'user_login_register_redirect' );
add_filter( 'woocommerce_registration_redirect', 'user_login_register_redirect' );
function user_login_register_redirect( $redirect ) {
  $site_url = (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url() .'\\/en' ;
  if(isset(($_GET['callback'])) == 'cart'){
    return $site_url . '/cart';
  } else {
    return $site_url . '/account';
  }
	
}


// define the woocommerce_customer_save_address callback 
add_action( 'woocommerce_customer_save_address', 'action_woocommerce_customer_save_address', 10, 2 ); 
function action_woocommerce_customer_save_address( $user_id, $load_address ) { 
  $site_url = (ICL_LANGUAGE_CODE == 'ar') ? site_url()  .'\\/ar' : site_url() .'\\/en' ;
  wp_redirect( $site_url . '/account' );
  exit;
}; 

// Remove Company Name
add_filter( 'woocommerce_checkout_fields' , 'remove_company_name' );
function remove_company_name( $fields ) {
     unset($fields['billing']['billing_company']);
     return $fields;
}


add_theme_support( 'woocommerce', array(
  'thumbnail_image_width' => 200,
  'gallery_thumbnail_image_width' => 100,
  'single_image_width' => 600,
));

add_filter('pre_option_default_role', function($default_role){
  // You can also add conditional tags here and return whatever
  return 'customer'; // This is changed
  return $default_role; // This allows default
});



// Register Guest on Place Order
function wc_register_guests( $order_id ) {
  // get all the order data
  $order = new WC_Order($order_id);
  
  //get the user email from the order
  $order_email = $order->billing_email;
    
  // check if there are any users with the billing email as user or email
  $email = email_exists( $order_email );  
  $user = username_exists( $order_email );
  
  // if the UID is null, then it's a guest checkout
  if( $user == false && $email == false ){
    
    // random password with 12 chars
    $user_pass = wp_generate_password();
    
    // create new user with email as username & newly created pw
    $user_id = wp_create_user( $order_email, $user_pass, $order_email );

    $user = new WP_User($user_id); // Get the WP_User Object instance from user ID
    $user->set_role('customer');   // Set the WooCommerce "customer" user role

    // Get all WooCommerce emails Objects from WC_Emails Object instance
    $emails = WC()->mailer()->get_emails();

    // Send WooCommerce "Customer New Account" email notification with the password
    $emails['WC_Email_Customer_New_Account']->trigger( $user_id, $user_pass, true );
    
    //WC guest customer identification
    update_user_meta( $user_id, 'guest', 'yes' );
 
    //user's billing data
    update_user_meta( $user_id, 'billing_address_1', $order->billing_address_1 );
    update_user_meta( $user_id, 'billing_address_2', $order->billing_address_2 );
    update_user_meta( $user_id, 'billing_city', $order->billing_city );
    update_user_meta( $user_id, 'billing_company', $order->billing_company );
    update_user_meta( $user_id, 'billing_country', $order->billing_country );
    update_user_meta( $user_id, 'billing_email', $order->billing_email );
    update_user_meta( $user_id, 'billing_first_name', $order->billing_first_name );
    update_user_meta( $user_id, 'billing_last_name', $order->billing_last_name );
    update_user_meta( $user_id, 'billing_phone', $order->billing_phone );
    update_user_meta( $user_id, 'billing_postcode', $order->billing_postcode );
    update_user_meta( $user_id, 'billing_state', $order->billing_state );
 
    // user's shipping data
    update_user_meta( $user_id, 'shipping_address_1', $order->shipping_address_1 );
    update_user_meta( $user_id, 'shipping_address_2', $order->shipping_address_2 );
    update_user_meta( $user_id, 'shipping_city', $order->shipping_city );
    update_user_meta( $user_id, 'shipping_company', $order->shipping_company );
    update_user_meta( $user_id, 'shipping_country', $order->shipping_country );
    update_user_meta( $user_id, 'shipping_first_name', $order->shipping_first_name );
    update_user_meta( $user_id, 'shipping_last_name', $order->shipping_last_name );
    update_user_meta( $user_id, 'shipping_method', $order->shipping_method );
    update_user_meta( $user_id, 'shipping_postcode', $order->shipping_postcode );
    update_user_meta( $user_id, 'shipping_state', $order->shipping_state );
    
    // link past orders to this newly created customer
    wc_update_new_customer_past_orders( $user_id );
  }
  
}
 
//add this newly created function to the thank you page
// add_action( 'woocommerce_thankyou', 'wc_register_guests', 10, 1 );


/**
 * Disable WooCommerce block styles (front-end).
 */
function slug_disable_woocommerce_block_styles() {
  wp_dequeue_style( 'wc-block-style' );
}
add_action( 'wp_enqueue_scripts', 'slug_disable_woocommerce_block_styles' );



function my_customize_rest_cors() {
  remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
  add_filter( 'rest_pre_serve_request', function( $value ) {
    header( 'Access-Control-Allow-Origin: *' );
    header( 'Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT' );
    header( 'Access-Control-Allow-Credentials: true' );
    header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization' );
    header( 'Access-Control-Expose-Headers: Link', false );
    return $value;
  } );
}
add_action( 'rest_api_init', 'my_customize_rest_cors', 15 );

function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
    header( 'Access-Control-Allow-Origin: *' );
    header( 'Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT' );
    header( 'Access-Control-Allow-Credentials: true' );
    header( 'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization' );
    header( 'Access-Control-Expose-Headers: Link', false );
}
add_action('init','add_cors_http_header');


function cart_redirect_without_account() {
  if ( WC()->is_rest_api_request() ) {
    return;
  }
  if (! is_user_logged_in() && (is_cart()) ) {
    if(ICL_LANGUAGE_CODE == 'ar'){
      wp_redirect( site_url() . '/ar/login?callback=cart' );
    } else{
      wp_redirect( site_url() . '/en/login?callback=cart' );
    }
    exit;
  }
}
add_action('template_redirect', 'cart_redirect_without_account');

add_filter( 'woocommerce_cart_shipping_method_full_label', 'add_free_shipping_label', 10, 2 );
function add_free_shipping_label( $label, $method ) {
  print_r($method);
  
    if ( $method->cost == 0 ) {
        $label = 'Free shipping'; //not quite elegant hard coded string
    }
    return $label;
}

add_filter( 'woocommerce_order_shipping_to_display', 'add_free_shipping_label_email', 10, 2 );
function add_free_shipping_label_email( $label, $method ) {
    if ( $method->cost == 0 ) {
        $label = 'Free shipping'; //not quite elegant hard coded string
    }
    return $label;
}

/* check mobile number on registration */
add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );
function bbloomer_validate_name_fields( $errors, $username, $email ) {
  $mobile_number = filter_var($_POST['intlTelInput'], FILTER_SANITIZE_STRING);
  $hasPhoneNumber = get_users(
    array(
      'meta_key' => 'user_mobile', 
      'meta_value' => $mobile_number, 
      'offset' => 0, 
      'number' => 1, 
      'count_total' => false
    )
  );
  // $hasPhoneNumber= get_users('meta_value='.$_POST['mobile_number']);
  if ( !empty($hasPhoneNumber)) {
      $errors->add( 'billing_phone_error', __( 'Mobile number is already used!.', 'woocommerce' ) );
  }
  return $errors;
}
/* check mobile number on registration end*/

/* Change the default postcode */
add_filter( 'default_checkout_billing_postcode', 'change_default_checkout_postcode' );
function change_default_checkout_postcode() {
  return '12222';
}
add_filter('woocommerce_billing_fields', 'my_woocommerce_billing_postcode');
function my_woocommerce_billing_postcode($fields) {
   $fields['billing_postcode']['custom_attributes'] = array('readonly'=>'readonly');
   return $fields;
}
/* Change the default postcode end*/

/* Change the default city */
add_filter( 'default_checkout_billing_city', 'change_default_checkout_city' );
function change_default_checkout_city() {
  //return 'Riyadh'; // city code
  if(ICL_LANGUAGE_CODE == 'ar'){
    return 'الرياض'; // city code
  } else{
    return 'Riyadh'; // city code
  }
}
add_filter('woocommerce_billing_fields', 'my_woocommerce_billing_fields');
function my_woocommerce_billing_fields($fields) {
   $fields['billing_city']['custom_attributes'] = array('readonly'=>'readonly');
   return $fields;
}
/* Change the default city end*/

/* order of city and and address_1 */
add_filter( 'woocommerce_default_address_fields', 'custom_override_default_locale_fields' );
function custom_override_default_locale_fields( $fields ) {
    $fields['city']['priority'] = 50;
    $fields['address_1']['priority'] = 60;
    return $fields;
}
/* order of city and and address_1 end*/

/* max quantity */
add_filter( 'woocommerce_quantity_input_max', 'woocommerce_quantity_input_max_callback', 10, 2 );
function woocommerce_quantity_input_max_callback( $max, $product ) {
  $max = 9999;  
  return $max;
}

add_filter( 'woocommerce_quantity_input_args', 'jk_woocommerce_quantity_input_args', 10, 2 );
function jk_woocommerce_quantity_input_args( $args, $product ) {
  $args['max_value']  = 9999;
  $args['min_value']  = 1;
  // $args['step']     = 2;
  return $args;
}

add_filter( 'woocommerce_available_variation', 'jk_woocommerce_available_variation' );
function jk_woocommerce_available_variation( $args ) {
  $args['max_qty'] = 9999;
  $args['min_qty'] = 1;
  return $args;
}
/* max quantity end*/

//do not enter zero as first input in quantity field
add_action( 'wp_footer', 'silva_cart_refresh_update_qty' ); 
function silva_cart_refresh_update_qty() { 
   if (is_cart()) { 
      ?> 
      <script type="text/javascript"> 
        
         jQuery('div.woocommerce').on('click', '[name="update_cart"]', function(){ 

            var count = '<?php echo count(WC()->cart->get_cart()); ?>';
            var rowCount = jQuery('.cart >tbody >tr').length;

            var val = jQuery('.quantity.qty-selector input.qty').val();
            var oldValue = jQuery('.quantity.qty-selector input.qty').attr("data-product-val");
            var newValue = jQuery('.quantity.qty-selector input.qty').val();

            if(rowCount<=2) {
              if(oldValue=== newValue) {
                jQuery(".btn[name=update_cart]").attr("disabled", true);
              }
              if('0'+oldValue=== newValue) {
                jQuery(".btn[name=update_cart]").attr("disabled", true);
              }
              if('00'+oldValue=== newValue) {
                jQuery(".btn[name=update_cart]").attr("disabled", true);
              }
              if('000'+oldValue=== newValue) {
                jQuery(".btn[name=update_cart]").attr("disabled", true);
              }
            }

            var reg1 = /^0/gi;
            var reg2 = /^00/gi;
            var reg3 = /^000/gi;

            if (val.match(reg1)) {
              val = val.substring(1); 
            } else if (val.match(reg2)) {
              val = val.substring(2);
            } else if (val.match(reg3)) {
              val = val.substring(3);
            }
            jQuery(this).val(val);
         }); 

      </script> 
      <?php 
   } 
}
//do not enter zero as first input in quantity field end

// cart count on header (ajax)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
  ob_start();

  global $woocommerce;  
  $cart = $woocommerce->cart;
  $cart_item_list = array();
  $loop = 0;
  foreach( $cart->get_cart_item_quantities() as $id => $count ){
    // array_push($cart_item_list, array(  ));
    $cart_item_list[$loop]['id'] = $id;
    $cart_item_list[$loop]['title'] = get_the_title($id);
    $cart_item_list[$loop]['count'] = $count;
    $loop++;
  }
?>
  <!-- <span class="count"><?php /* echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); */ ?></span> -->
  <span class="count <?php echo (count($cart_item_list)) ? '' : 'hidden'; ?>"><?php echo count($cart_item_list); ?></span>
<?php
  $fragments['span.count'] = ob_get_clean();
  return $fragments;
}
// cart count on header (ajax) end