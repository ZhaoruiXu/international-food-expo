<?php 

function my_acf_google_map_api( $api ){
  $api['key'] = 'AIzaSyCPir7Ni3R_oa9ZPOh5i_-_n40zs_Cvw5I';
  return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');