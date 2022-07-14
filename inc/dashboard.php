<?php 

// Remove all default dashboard widgets
function ife_remove_all_dashboard_metaboxes() {
  $user = wp_get_current_user();
  if ( in_array( 'shop_manager', (array) $user->roles ) ) {
    // Remove Welcome panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
    // Remove the rest of the dashboard widgets
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
  }
}
add_action( 'wp_dashboard_setup', 'ife_remove_all_dashboard_metaboxes' );

// Disable setup widget in WooCommerce
function disable_woocommerce_setup_remove_dashboard_widgets() {
  remove_meta_box( 'wc_admin_dashboard_setup', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'disable_woocommerce_setup_remove_dashboard_widgets', 40);