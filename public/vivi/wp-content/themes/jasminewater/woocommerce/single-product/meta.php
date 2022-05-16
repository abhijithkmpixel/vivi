<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$term_obj_list = get_the_terms( $product->post->ID, 'product_cat' );
$cat_slug = $term_obj_list[0]->slug;
?>
<div class="product_meta">

  <?php echo woocommerce_template_single_excerpt(); ?>
  <span class="product-type">
    <i class="icon-<?php echo ($cat_slug == 'carton') ? 'carton' : 'bottle'; ?>"></i>
  </span>

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
