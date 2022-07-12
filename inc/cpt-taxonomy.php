<?php
function ife_register_custom_post_types() {
    // Register Vendors cpt
    $labels = array(
        'name'               => _x( 'Vendors', 'post type general name' ),
        'singular_name'      => _x( 'Vendor', 'post type singular name'),
        'menu_name'          => _x( 'Vendors', 'admin menu' ),
        'name_admin_bar'     => _x( 'Vendor', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Vendor' ),
        'add_new_item'       => __( 'Add New Vendor' ),
        'new_item'           => __( 'New Vendor' ),
        'edit_item'          => __( 'Edit Vendor' ),
        'view_item'          => __( 'View Vendor' ),
        'all_items'          => __( 'All Vendors' ),
        'search_items'       => __( 'Search Vendors' ),
        'parent_item_colon'  => __( 'Parent Vendor:' ),
        'not_found'          => __( 'No Vendors found.' ),
        'not_found_in_trash' => __( 'No Vendors found in Trash.' ),
        'archives'           => __( 'Vendor Archives'),
        'insert_into_item'   => __( 'Insert into Vendor'),
        'uploaded_to_this_item' => __( 'Uploaded to this Vendor'),
        'filter_item_list'   => __( 'Filter Vendors list'),
        'items_list_navigation' => __( 'Vendors list navigation'),
        'items_list'         => __( 'Vendors list'),
        'featured_image'     => __( 'Vendor featured image'),
        'set_featured_image' => __( 'Set Vendor featured image'),
        'remove_featured_image' => __( 'Remove Vendor featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'vendors' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-store',
        'supports'           => array( 'title', 'thumbnail' ),
    );
    register_post_type( 'ife-vendor', $args );
    
    //Register Events cpt
    
    $labels = array(
        'name'               => _x( 'Events', 'post type general name'  ),
        'singular_name'      => _x( 'Event', 'post type singular name'  ),
        'menu_name'          => _x( 'Events', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Event', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Event' ),
        'add_new_item'       => __( 'Add New Event' ),
        'new_item'           => __( 'New Event' ),
        'edit_item'          => __( 'Edit Event' ),
        'view_item'          => __( 'View Event'  ),
        'all_items'          => __( 'All Events' ),
        'search_items'       => __( 'Search Events' ),
        'parent_item_colon'  => __( 'Parent Event:' ),
        'not_found'          => __( 'No Events found.' ),
        'not_found_in_trash' => __( 'No Events found in Trash.' ),
        'archives'           => __( 'Event Archives'),
        'insert_into_item'   => __( 'Insert into Event'),
        'uploaded_to_this_item' => __( 'Uploaded to this Event'),
        'filter_item_list'   => __( 'Filter Events list'),
        'items_list_navigation' => __( 'Events list navigation'),
        'items_list'         => __( 'Events list'),
        'featured_image'     => __( 'Event featured image'),
        'set_featured_image' => __( 'Set Event featured image'),
        'remove_featured_image' => __( 'Remove Event featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'events' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array( 'title', 'thumbnail' , 'excerpt' ),
    );
    
    register_post_type( 'ife-event', $args );
}
add_action( 'init', 'ife_register_custom_post_types' );
    
    
// Register vendor taxonmies
function ife_register_taxonomies() {
    // Add Vendor Category taxonomy
    $labels = array(
        'name'              => _x( 'Vendor Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Vendor Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Vendor Types' ),
        'all_items'         => __( 'All Vendor Types' ),
        'parent_item'       => __( 'Parent Vendor Type' ),
        'parent_item_colon' => __( 'Parent Vendor Type:' ),
        'edit_item'         => __( 'Edit Vendor Type' ),
        'view_item'         => __( 'View Vendor Type' ),
        'update_item'       => __( 'Update Vendor Type' ),
        'add_new_item'      => __( 'Add New Vendor Type' ),
        'new_item_name'     => __( 'New Vendor Type Name' ),
        'menu_name'         => __( 'Vendor Type' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'vendor-type' ),
    );
    register_taxonomy( 'ife-vendor-type', array( 'ife-vendor' ), $args );
    
    
    //Add Events Taxonomy
    
$labels = array(
    'name'              => _x( 'Event Types', 'taxonomy general name' ),
    'singular_name'     => _x( 'Event Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Event Types' ),
    'all_items'         => __( 'All Events Types' ),
    'parent_item'       => __( 'Parent Event Type' ),
    'parent_item_colon' => __( 'Parent Event Type:' ),
    'edit_item'         => __( 'Edit Event Type' ),
    'update_item'       => __( 'Update Event Type' ),
    'add_new_item'      => __( 'Add New Event Type' ),
    'new_item_name'     => __( 'New Work Event Type' ),
    'menu_name'         => __( 'Event Type' ),
);
$args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_in_menu'      => true,
    'show_in_nav_menu'  => true,
    'show_admin_column' => true,
    'show_in_rest'      => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'event-type' ),
    );
    
    register_taxonomy( 'ife-event-type', array( 'ife-event' ), $args );
    
}
add_action( 'init', 'ife_register_taxonomies');
    
    
// Flushes Permalinks when switching themes
function ife_rewrite_flush() {
    ife_register_custom_post_types();
    ife_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ife_rewrite_flush' );