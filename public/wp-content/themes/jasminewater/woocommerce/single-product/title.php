<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// the_title( ' <h1 class="product_title entry-title">', '</h1></div>' );

$title = get_the_title();
// $title = filter_var($title, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$title = str_replace('&#8211;', '-', $title);
$matches = preg_split('/\s[—–-]\s/', $title);

if($title):
echo '<div class="title"><h1>';
if($matches){
  echo ($matches[0]) ? '<span>'.$matches[0].'</span>' : '';
  echo ($matches[1]) ? '<small>'.$matches[1].'</small>' : '';
} else {
  echo $title;
}
echo '</div></h1>';
endif;