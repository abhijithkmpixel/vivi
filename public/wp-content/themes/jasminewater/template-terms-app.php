<?php 
/* Template Name: App terms & condition */ 
get_header();
?>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap');
    body.mobile-app-page header,
    body.mobile-app-page footer {
      display: none;
    }
    body.mobile-app-page .site {
      padding-top: 0;
    }
    body.mobile-app-page p {
      font-size: 14px; 
      line-height: 19px;
      font-weight: 500;
      margin-top: 0;
      margin-bottom: 15px;
    }
    body.mobile-app-page h2 {
      font-weight: 600;
      font-size: 18px;
      margin-bottom: 5px;
      margin-top: 0;
    }
    body.mobile-app-page h1 {
      color: #113F97;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      /*padding-top: 10px;*/
      padding-top: 0px;
    }
    body.mobile-app-page, 
    body.mobile-app-page .site-main {
      font-family: 'Open Sans', sans-serif; 
      color: #113F97;
      padding: 0px 10px 30px 10px;
    }
    #load {
        width:100%;
        height:100vh;
        position:fixed;
        z-index:9999;
        background:#ffffff;
        text-align: center;
    }
    #load img {
      position: relative;
      top: 20%;
    }
  </style>

  <div id="load">
    <img src="https://vivi.pixelflames.net/wp-content/themes/jasminewater/dist/images/loader.svg">
  </div>
	<main id="primary" class="site-main" style="font-family: 'Open Sans', sans-serif; color: #113F97; padding: 0px 10px 30px 10px;">
    <?php the_field('terms_and_conditions'); ?>
	</main>

  <script>
    document.onreadystatechange = function () {
      var state = document.readyState
      if (state == 'complete') {
       document.getElementById('interactive');
       document.getElementById('load').style.visibility="hidden";
      }
    }
  </script>

<?php
  get_footer();
?>