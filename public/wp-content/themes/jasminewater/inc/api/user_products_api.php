<?php 

// /wp-json/wp/v2/user/products

add_action('rest_api_init', 'user_products');
function user_products($request) {
  register_rest_route('wp/v2', 'user/products', array(
    'methods' => 'GET',
    'callback' => 'user_products_handler',
  ));
}

function user_products_handler($request)
{

  $response = array();
  $error = new WP_Error();
  $parameters = $request->get_json_params();
  $language = $request["lang"];

  $param_id = $request["id"];
  if (empty($param_id)) {
    $id_product = '';
  } else {
    $id_product = array($param_id);
  }

  $param_category = $request["category"];
  if (empty($param_category)) {
    $category_product = null;
  } else {
    $category_product = $param_category;
  }

  $param_tag = $request["tag"];
  if (empty($param_tag)) {
    $tag_product = null;
  } else {
    $tag_product = $param_tag;
  }

  $param_per_page = $request["per_page"];
  if (empty($param_per_page)) {
    $per_page_product = -1;
  } else {
    $per_page_product = $param_per_page;
  }

  $param_page = $request["page"];
  if (empty($param_page)) {
    $page_product = 0;
  } else {
    $page_product = $param_page;
  }

  // only cart products 
    $count = 0;
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $cart_key = $cart_item_key;
        $cart_id = $cart_item['product_id'];
        $count++;
        $val[] = array(
          'key' => $cart_key, 
          'value' => $cart_id
        );
    }
  // only cart products end

// all products
    global $sitepress;
    $lang = $language;
    $sitepress->switch_lang($lang);
    $paged = (get_query_var('paged')) ? get_query_var('paged') : $page_product;
    $all_ids = get_posts( array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'post__in' => $id_product,
        'fields' => 'ids',
        'posts_per_page' => $per_page_product,
        'paged' => $paged, 
        'suppress_filters' => false,

        'tax_query' =>  array(
                'relation' => 'AND',
                        array(
                            'taxonomy'  => 'product_cat',
                            'fields'     => 'id',
                            'terms'     => $param_category,
                            'operator' => 'AND'
                        ),
                        array(
                            'taxonomy'  => 'product_tag',
                            'fields'     => 'id',
                            'terms'     => $param_tag,
                            'operator' => 'AND'
                        ),                                                
        ),

    ) );
    $products_count = 0;
    foreach ( $all_ids as $id ) {
      $product_id = $id;
      $product = wc_get_product( $product_id );
      $image_id = $product->get_image_id();
      $image_meta = get_post( $image_id );
      $in_cart = check_cart_item_user( $product_id );

      if($in_cart) {
        $key = $in_cart['key'];
        $quantity = $in_cart['quantity'];
      } else {
        $key = "";
        $quantity = "";
      }
      
      //$product_cart_id = WC()->cart->generate_cart_id( $product_id );
      //$in_cart = WC()->cart->find_product_in_cart( $product_cart_id );

      $product_details[] = array(
        'id'                =>  $product_id,
        'name'              =>  $product->get_name(),
        'slug'              =>  $product->get_slug(),
        'permalink'         =>  get_permalink( $product->get_id() ),
        'description'       =>  $product->get_description(),
        'short_description' =>  $product->get_short_description(),
        'sku'               =>  $product->get_sku(),
        'price'             =>  $product->get_price(),
        'regular_price'     =>  $product->get_regular_price(),
        'sale_price'        =>  $product->get_sale_price(),
        'promotion_text'    =>  get_field('promotion_details', $product_id),
        'stock_quantity'    =>  $product->get_stock_quantity(),
        'weight'            =>  $product->get_weight(),
        'dimensions'        =>  array(
                                  'length'  =>  $product->get_length(),
                                  'width'   =>  $product->get_width(),
                                  'height'  =>  $product->get_height(),
                                ),
        'average_rating'    =>  $product->get_average_rating(),
        'rating_count'      =>  $product->get_rating_counts(),
        'categories'        =>  wp_get_post_terms( $product_id, 'product_cat' ),
        'tags'              =>  wp_get_post_terms( $product_id, 'product_tag' ),
        'images'            =>  array(
                                  'id'   =>  $product->get_image_id(),
                                  'name' =>  $image_meta->post_title,
                                  'src'  =>  wp_get_attachment_image_url( $image_id, 'full' ),
                                ),
        'price_html'        =>  $product->get_price_html(),
        'related_ids'       =>  wc_get_related_products( $product_id, 4 ),
        'stock_status'      =>  $product->get_stock_status(),
        'acf'               =>  get_field('product_content', $product_id),
        'cart_key'          =>  $key, 
        'cart_quantity'     =>  $quantity, 
      );
      $products_count++;
    }
// all products end

  if (empty($all_ids)) {
    $error->add(400, __("No products", 'wc-user-products'), array('status' => 400));
    return $error;
  }

  $auth = apache_request_headers();
  $valid = $auth['Authorization'];  

  $response = new WP_REST_Response( array( 'Authorization' => $valid, 'total_products' => $products_count, 'products_details' => $product_details ) );
  $response->set_status(200);

  return $response;
}


?>