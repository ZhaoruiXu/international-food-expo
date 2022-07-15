<?php
/**
 * Food Expo Theme Customizer
 *
 * @package Food_Expo
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function food_expo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'food_expo_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'food_expo_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'food_expo_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function food_expo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function food_expo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function food_expo_customize_preview_js() {
	wp_enqueue_script( 'food-expo-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'food_expo_customize_preview_js' );

function ja_remove_customizer_options( $wp_customize ) {
	//$wp_customize->remove_section( 'static_front_page' );
	//$wp_customize->remove_section( 'title_tagline'     );
	//$wp_customize->remove_section( 'nav'               );
	$wp_customize->remove_section( 'colors'              );
}
add_action( 'customize_register', 'ja_remove_customizer_options', 30 );