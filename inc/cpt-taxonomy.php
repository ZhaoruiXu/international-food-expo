<?php
function ife_register_custom_post_types() {
    // Register Vendors cpt
    $labels = array(
        'name'               => _x( 'Vendors', 'post type general name' ),
        'singular_name'      => _x( 'Vendor', 'post type singular name'),
        'menu_name'          => _x( 'Vendors', 'admin menu' ),
        'name_admin_bar'     => _x( 'Vendors', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'vendors' ),
        'add_new_item'       => __( 'Add New Vendors' ),
        'new_item'           => __( 'New Vendors' ),
        'edit_item'          => __( 'Edit ' ),
        'view_item'          => __( 'View Vendors' ),
        'all_items'          => __( 'All Vendors' ),
        'search_items'       => __( 'Search Vendors' ),
        'parent_item_colon'  => __( 'Parent Vendors:' ),
        'not_found'          => __( 'No Vendors found.' ),
        'not_found_in_trash' => __( 'No Vendors found in Trash.' ),
        'archives'           => __( 'Vendors Archives'),
        'insert_into_item'   => __( 'Insert into Vendors'),
        'uploaded_to_this_item' => __( 'Uploaded to this Vendors'),
        'filter_item_list'   => __( 'Filter Vendors list'),
        'items_list_navigation' => __( 'Vendors list navigation'),
        'items_list'         => __( 'Vendors list'),
        'featured_image'     => __( 'Vendors featured image'),
        'set_featured_image' => __( 'Set Vendors featured image'),
        'remove_featured_image' => __( 'Remove  featured image'),
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
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title', 'thumbnail' ),
    );
    register_post_type( 'ife-vendor', $args );
    
    //Register Events cpt
    
    $labels = array(
        'name'               => _x( 'Events', 'post type general name'  ),
        'singular_name'      => _x( 'Event', 'post type singular name'  ),
        'menu_name'          => _x( 'Events', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Events', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Events' ),
        'add_new_item'       => __( 'Add New Events' ),
        'new_item'           => __( 'New Events' ),
        'edit_item'          => __( 'Edit Events' ),
        'view_item'          => __( 'View Events'  ),
        'all_items'          => __( 'All Events' ),
        'search_items'       => __( 'Search Events' ),
        'parent_item_colon'  => __( 'Parent Events:' ),
        'not_found'          => __( 'No Events found.' ),
        'not_found_in_trash' => __( 'No Events found in Trash.' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'events' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'thumbnail' ),
    );
    
    register_post_type( 'ife-event', $args );
}
add_action( 'init', 'ife_register_custom_post_types' );
    
    
// // Register vendor taxonmies
function fwd_register_taxonomies() {
    // Add Vendor Category taxonomy
    $labels = array(
        'name'              => _x( 'Vendor Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Vendor Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Vendor Types' ),
        'all_items'         => __( 'All Vendor Type' ),
        'parent_item'       => __( 'Parent Vendor Type' ),
        'parent_item_colon' => __( 'Parent Vendor Type:' ),
        'edit_item'         => __( 'Edit Vendor Type' ),
        'view_item'         => __( 'Vview Vendor Type' ),
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
    register_taxonomy( 'ife-vendor-type', array( 'vendors' ), $args );
    
    
    //Add Events Taxonomy
    
$labels = array(
    'name'              => _x( 'Events Types', 'taxonomy general name' ),
    'singular_name'     => _x( 'Event Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Events Type' ),
    'all_items'         => __( 'All Events Type' ),
    'parent_item'       => __( 'Parent Events Type' ),
    'parent_item_colon' => __( 'Parent Events Type:' ),
    'edit_item'         => __( 'Edit Events Type' ),
    'update_item'       => __( 'Update Events Type' ),
    'add_new_item'      => __( 'Add New Events Type' ),
    'new_item_name'     => __( 'New Work Events Type' ),
    'menu_name'         => __( 'Events Type' ),
);
$args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'event-type' ),
    );
    
    register_taxonomy( 'ife-event-type', array( 'events' ), $args );
    
}
add_action( 'init', 'ife_register_taxonomies');
    
    
    // flushes Permalinks when switching themes
    
    function ife_rewrite_flush() {
    ife_register_custom_post_types();
    ife_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ife_rewrite_flush' );