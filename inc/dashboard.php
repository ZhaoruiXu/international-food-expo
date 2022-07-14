<?php 

// Remove all default dashboard widgets
function ife_edit_dashboard_metaboxes() {
  $user = wp_get_current_user();
  // Remove Welcome panel
  remove_action( 'welcome_panel', 'wp_welcome_panel' );
  // Remove the rest of the dashboard widgets
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
  remove_meta_box('dashboard_site_health', 'dashboard', 'normal');

  // Disable setup widget in WooCommerce
  remove_meta_box( 'wc_admin_dashboard_setup', 'dashboard', 'normal');
  
  // Add custom widget
  wp_add_dashboard_widget(
      'ife_dashboard_widget',           // Widget slug.
      esc_html__( 'Welcome', 'ife' ),   // Title.
      'ife_dashboard_widget_render'     // Display function.
  ); 
}
add_action( 'wp_dashboard_setup', 'ife_edit_dashboard_metaboxes' );

/**
* Create the function to output the content of our Dashboard Widget.
*/
function ife_dashboard_widget_render() {
  ?>
  <p><?php esc_html_e( "Welcome to the admin view for the International Food Expo website. Use this view to manage the site content.", "ife" ); ?></p>
  <section>
    <h3>Site Tutorial</h3>
    <iframe 
      width="480" 
      height="270" 
      src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
      title="Rick Astley - Never Gonna Give You Up (Official Music Video)" 
      frameborder="0" 
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
      allowfullscreen 
      style="width: 100%;"
    >
    </iframe>
  </section>
  <?php
}