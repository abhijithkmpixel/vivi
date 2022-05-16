<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/share.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_share' ); // Sharing plugins can hook into here.

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

?>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58214f54eea71606"></script>
<script type="text/javascript">
var addthis_config = {
  // services_compact: 'facebook, twitter'
  ui_offset_top: 20,
  ui_508_compliant: false,
  data_track_addressbar: false,
  services_compact: 'facebook,twitter,skype,telegram,whatsapp,link',
  services_exclude: 'more,settings,100zakladok,addressbar,adfty,adifni,advqr,amazonwishlist,amazonsmile,amenme,aim,aolmail,apsense,atavi,baidu,balatarin,beat100,bitly,bizsugar,bland,blogger,blogmarks,bobrdobr,bonzobox,bookmarkycz,bookmerkende,box,buffer,camyoo,care2,cashme,citeulike,technerd,cosmiq,cssbased,diary_ru,digg,diggita,diigo,douban,draugiem,edcast,mailto,evernote,exchangle,stylishhome,facenama,informazione,thefancy,fashiolista,favable,favorites,favoritus,financialjuice,flipboard,folkd,thefreedictionary,gg,govn,google_classroom,googletranslate,hackernews,hatena,hedgehogs,historious,hootsuite,w3validator,indexor,instapaper,iorbix,jappy,kaixin,kakao,kakaotalk,ketnooi,kindleit,kledy,lidar,lineme,linkuj,livejournal,mymailru,margarin,markme,meinvz,memonic,mendeley,meneame,stumbleupon,mixi,moemesto,mrcnetworkit,myspace,myvidster,n4g,naszaklasa,netvibes,netvouz,newsvine,nujij,nurses_lounge,odnoklassniki_ru,oknotizie,onenote,openthedoor,hotmail,oyyla,pafnetde,patreon,paypalme,pdfmyurl,pinboard,plurk,pocket,posteezy,print,printfriendly,pusha,qrsrc,quantcast,qzone,reddit,rediff,renren,researchgate,safelinking,scoopit,sinaweibo,skyrock,slack,sms,sodahead,spinsnap,startaid,startlap,studivz,stuffpit,stumpedia,surfingbird,svejo,symbaloo,taringa,tencentqq,tencentweibo,trello,tuenti,tumblr,typepad,urlaubswerkde,venmo,viadeo,viber,virb,visitezmonsite,vk,vkrugudruzei,vybralisme,wanelo,internetarchive,weheartit,sharer,wechat,domaintoolswhois,wishmindr,wordpress,wykop,xing,yahoomail,yammer,yoolink,yummly,yuuby,zakladoknet,ziczac',
  services_expanded: 'facebook,twitter,linkedin,skype,telegram,whatsapp,email,messenger,pinterest_share,link,google,gmail,houzz'
}
</script>

<div class="share-wrap">
  <a href="#" class="btn btn-default-outline btn-icon addthis_toolbox addthis_button_compact"> <i class="icon-share"></i> <?php esc_html_e( 'Share this product', 'jasminewater' ); ?></a>
</div>