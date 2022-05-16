<?php 

// /wp-json/wp/v2/user/productsdetails

add_action('rest_api_init', 'details_products');
function details_products($request) {
  register_rest_route('wp/v2', 'user/productsdetails', array(
    'methods' => 'GET',
    'callback' => 'details_products_handler',
  ));
}

function details_products_handler($request)
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
        $in_cart = $in_cart;
      } else {
        $in_cart = "";
      }
      
      //$product_cart_id = WC()->cart->generate_cart_id( $product_id );
      //$in_cart = WC()->cart->find_product_in_cart( $product_cart_id );

      $product_details[] = array(
        'id'                =>  $product_id,
        'name'              =>  $product->get_name(),
        'images'            =>  array(
                                  'id'   =>  $product->get_image_id(),
                                  'name' =>  $image_meta->post_title,
                                  'src'  =>  wp_get_attachment_image_url( $image_id, 'full' ),
                                ),
      );
      $products_count++;
    }
// all products end

  if (empty($all_ids)) {
    $error->add(400, __("No products", 'wc-user-products'), array('status' => 400));
    return $error;
  } 

  $response = new WP_REST_Response( array( 'products_details' => $product_details ) );
  $response->set_status(200);

  return $response;
}


?>