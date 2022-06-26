<?php 

function my_acf_google_map_api( $api ){
  $api['key'] = 'AIzaSyBXXzioydGJrV3pWfn5Pe0eYp6iOGyuhco';
  return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');