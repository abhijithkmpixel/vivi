<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form class="woocommerce-ordering" method="post">
	<!-- <select name="orderby" class="orderby" aria-label="<?php // esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
		<?php // foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php // echo esc_attr( $id ); ?>" <?php // selected( $orderby, $id ); ?>><?php // echo esc_html( $name ); ?></option>
		<?php // endforeach; ?>
	</select> -->

  <div class="filter-wrapper">

    <?php
    $selected_tag = $_POST['sort'];
    $product_tag = array(
      'taxonomy' => 'product_tag',
      'orderby' => 'name',
      'order' => 'ASC',
      'hide_empty' => true
    );
    $tags = get_categories( $product_tag );
    if($tags):
    ?>
    <div class="filter-item drop-wrap">
      <label for="sort"><?php esc_html_e( 'Sort By', 'jasminewater' ); ?></label>
      <div class="custom-select">
        <select name="sort" id="sort" class="input-select">
          <?php 
          echo '<option value="">'.esc_html__( 'Best Sellers', 'jasminewater' ).'</option>';
          foreach( $tags as $tag ) : 
          $selected = ($selected_tag == $tag->slug) ? 'selected' : '';
          echo '<option value="'.$tag->slug.'" ' . $selected . ' >'.$tag->name.'</option>';
          endforeach;
          ?>
        </select>
      </div>
    </div>
    <?php endif; ?>

    <?php
    $selected_cat = $_POST['sku'];
    $product_cat = array(
      'taxonomy' => 'product_cat',
      'orderby' => 'name',
      'order' => 'DESC',
      'hide_empty' => true
    );
    $cats = get_categories( $product_cat );
    if($cats):
    ?>
    <div class="filter-item check-wrap">
      <label for="sku"><?php esc_html_e( 'Show by SKU\'s', 'jasminewater' ); ?></label>
      <div class="cat-selector">
        <?php 
        foreach( $cats as $cat ) : 
        $checked = ($selected_cat == $cat->slug) ? 'checked' : '';
        $icon = $cat->slug;
        if($cat->slug == 'shrink-case'){
          $icon = 'bottle';
        }
        echo '<div class="input-wrap" title="'.$cat->name.'"> <input type="radio" id="'.$cat->slug.'" name="sku" value="'.$cat->slug.'" ' . $checked . '> <label for="'.$cat->slug.'"> <i class="icon-'.$icon.'"></i> </label></div>';
        endforeach;
        ?>
      </div>
    </div>
    <?php endif; ?>

  </div>

	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
