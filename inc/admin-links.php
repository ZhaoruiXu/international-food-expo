<?php 

// Remove admin menu links for non-Administrator accounts
function ife_remove_admin_links() {
	if ( !current_user_can( 'manage_options' ) ) {
    remove_menu_page( 'edit-comments.php' );          // Remove Comments link
    remove_menu_page( 'getwooplugins' );              // Remove GetWooPlugins link
    remove_menu_page( 'wc-admin&path=/marketing' );   // Remove WooCommerce Marketing Link
    remove_menu_page( 'tools.php' );                  // Remove Tools Link
    remove_menu_page( 'users.php' );                  // Remove Users Link
    remove_menu_page( 'themes.php' );                  // Remove Users Link
	}
}
add_action( 'admin_menu', 'ife_remove_admin_links' );


function ife_remove_woocommerce_marketing ( $features ) {
  /**
   * Filter list of features and remove those not needed     *
   */
  if ( !current_user_can( 'manage_options' ) ) {
    return array_values(
      array_filter( $features, function($feature) {
          return $feature !== 'marketing';
      } ) 
    );
	}
  return $features;
}
add_filter( 'woocommerce_admin_features', 'ife_remove_woocommerce_marketing' );