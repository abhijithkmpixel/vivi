<?php 
/* Template Name: Contact Template */ 
get_header();
$contact = get_field('contact', 'options');
$contact_form = ICL_LANGUAGE_CODE == 'ar' ? '[contact-form-7 id="697" title="Contact form - AR"]' : '[contact-form-7 id="358" title="Contact form - EN"]';
?>

  <link href="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>

	<main id="primary" class="site-main">

  <section class="contact-page sub-title white" data-scroll-section>
    <div class="container">

      <?php if($contact): ?>
      <div class="title wide">
        <h1><?php echo $contact['title']; ?></h1>
        <?php echo $contact['sub_title']; ?>
      </div>
      <?php endif; ?>

      <div class="content">
        <div class="flex">
          <?php if($contact_form): ?>
          <div class="col">
            <?php echo do_shortcode($contact_form); ?>
          </div>
          <?php endif; ?>
          <div class="col">
            <div class="contact-info">
              <?php 
              $call = get_field('call');
              $address = get_field('address');
              $contact_info = get_field('contact_info');
              if($call):
              ?>
              <div class="block">
                <h4><?php echo $call['label']; ?></h4>
                <h3><?php echo $call['number']; ?></h3>
              </div>
              <?php
              endif; 
              if($address):
              ?>
              <div class="block">
                <address>
                <?php echo $address; ?>
                </address>
              </div>
              <?php
              endif; 
              if($contact_info):
              ?>
              <div class="block">
                <?php foreach( $contact_info as $row ): ?>
                  <h4 style="direction: <?php echo (ICL_LANGUAGE_CODE == 'ar') ? 'rtl':'ltr'; ?>"><?php echo $row['label']; ?>: <?php echo $row['text']; ?></h4>
                <?php endforeach; ?>
              </div>
              <?php
              endif;
              ?>
            </div>
            <div class="bobble-group">
              <img src="<?php echo get_template_directory_uri(); ?>/dist/images/bottle-single.png" />
            </div>
          </div>
        </div>
        <?php
        $map_title = get_field('map_title');
        $map_location = get_field('map_location');
        $map_zoom_level = get_field('map_zoom_level');
        if($map_location):
        ?>
        <div class="locate-map">
          <div class="title center wide">
            <h3><?php echo $map_title; ?></h3>
          </div>
          <div id="map"></div>
          <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoidmlqaXRocGFuZ2F0aCIsImEiOiJPY013WlZNIn0.bAJLJnEPlccVpDfPjaVtJg';
            var map = new mapboxgl.Map({
              container: 'map', // container id
              style: 'mapbox://styles/mapbox/streets-v11', // style URL
              center: [<?php echo $map_location; ?>], // starting position [lng, lat]
              zoom: <?php echo $map_zoom_level; ?> // starting zoom
            });
            // Create a marker and add it to the map.
            new mapboxgl.Marker().setLngLat([<?php echo $map_location; ?>]).addTo(map);
          </script>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </section>

  </main><!-- #main -->

<?php
// get_sidebar();
get_footer();
