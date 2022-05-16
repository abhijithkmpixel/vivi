<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
$product_detail = get_field('product_detail', 'options');
?>

<?php 
get_template_part( 'template-parts/content', 'banner' ); 
if(!$product_detail){
  ?>
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58214f54eea71606"></script>
  <script type="text/javascript">
  var addthis_config = {
    ui_offset_top: 20,
    ui_508_compliant: false,
    data_track_addressbar: false,
    services_compact: 'facebook,twitter,skype,telegram,whatsapp,link',
    services_exclude: 'more,settings,100zakladok,addressbar,adfty,adifni,advqr,amazonwishlist,amazonsmile,amenme,aim,aolmail,apsense,atavi,baidu,balatarin,beat100,bitly,bizsugar,bland,blogger,blogmarks,bobrdobr,bonzobox,bookmarkycz,bookmerkende,box,buffer,camyoo,care2,cashme,citeulike,technerd,cosmiq,cssbased,diary_ru,digg,diggita,diigo,douban,draugiem,edcast,mailto,evernote,exchangle,stylishhome,facenama,informazione,thefancy,fashiolista,favable,favorites,favoritus,financialjuice,flipboard,folkd,thefreedictionary,gg,govn,google_classroom,googletranslate,hackernews,hatena,hedgehogs,historious,hootsuite,w3validator,indexor,instapaper,iorbix,jappy,kaixin,kakao,kakaotalk,ketnooi,kindleit,kledy,lidar,lineme,linkuj,livejournal,mymailru,margarin,markme,meinvz,memonic,mendeley,meneame,stumbleupon,mixi,moemesto,mrcnetworkit,myspace,myvidster,n4g,naszaklasa,netvibes,netvouz,newsvine,nujij,nurses_lounge,odnoklassniki_ru,oknotizie,onenote,openthedoor,hotmail,oyyla,pafnetde,patreon,paypalme,pdfmyurl,pinboard,plurk,pocket,posteezy,print,printfriendly,pusha,qrsrc,quantcast,qzone,reddit,rediff,renren,researchgate,safelinking,scoopit,sinaweibo,skyrock,slack,sms,sodahead,spinsnap,startaid,startlap,studivz,stuffpit,stumpedia,surfingbird,svejo,symbaloo,taringa,tencentqq,tencentweibo,trello,tuenti,tumblr,typepad,urlaubswerkde,venmo,viadeo,viber,virb,visitezmonsite,vk,vkrugudruzei,vybralisme,wanelo,internetarchive,weheartit,sharer,wechat,domaintoolswhois,wishmindr,wordpress,wykop,xing,yahoomail,yammer,yoolink,yummly,yuuby,zakladoknet,ziczac',
    services_expanded: 'facebook,twitter,skype,telegram,whatsapp,email,linkedin,messenger,pinterest_share,link,google,gmail,houzz'
  }
  </script>
  <?php
}
?>

<section class="content product-listing" data-scroll-section>
  <div class="container">

    <?php
    /**
     * Hook: woocommerce_before_main_content.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    do_action( 'woocommerce_before_main_content' );

    ?>

    <header class="woocommerce-products-header hidden">
      <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
      <?php endif; ?>

      <?php
      /**
       * Hook: woocommerce_archive_description.
       *
       * @hooked woocommerce_taxonomy_archive_description - 10
       * @hooked woocommerce_product_archive_description - 10
       */
      do_action( 'woocommerce_archive_description' );
      ?>
    </header>

    <?php
    if ( woocommerce_product_loop() ) {

      /**
       * Hook: woocommerce_before_shop_loop.
       *
       * @hooked woocommerce_output_all_notices - 10
       * @hooked woocommerce_result_count - 20
       * @hooked woocommerce_catalog_ordering - 30
       */
      do_action( 'woocommerce_before_shop_loop' );

      woocommerce_product_loop_start();

      if ( wc_get_loop_prop( 'total' ) ) {
        while ( have_posts() ) {
          the_post();

          /**
           * Hook: woocommerce_shop_loop.
           */
          do_action( 'woocommerce_shop_loop' );

          wc_get_template_part( 'content', 'product' );
        }
      }

      woocommerce_product_loop_end();

      /**
       * Hook: woocommerce_after_shop_loop.
       *
       * @hooked woocommerce_pagination - 10
       */
      do_action( 'woocommerce_after_shop_loop' );
    } else {
      /**
       * Hook: woocommerce_no_products_found.
       *
       * @hooked wc_no_products_found - 10
       */
      do_action( 'woocommerce_no_products_found' );
    }

    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );
    ?>

  </div>
</section>

<?php get_template_part( 'template-parts/content', 'get-more' ); ?>

<?php
/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );