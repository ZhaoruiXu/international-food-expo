<?php 

// ID 60: About Page
if ( function_exists( 'get_field' ) ) :
  if( get_field('event_address', 60) ): 
    $location = get_field('event_address', 60);
    ?>
    <div class="acf-map event-map" data-zoom="16">
      <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
    <?php 
  endif; 
endif;