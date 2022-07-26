<?php
/**
 * Food Expo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Food_Expo
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function food_expo_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Food Expo, use a find and replace
		* to change 'food-expo' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'food-expo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
	

	//custom image crop sizes
	add_image_size('ife-banner',1920,860,true);

	add_image_size('ife-thumbnail',450,300,true);

	add_image_size('ife-event-guest',300,300,true);

	add_image_size('ife-vendor-logo',500,500,true);

	add_image_size('ife-organizer',500,500,true);


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'food-expo' ),
			'footer-left' => esc_html__( 'Footer Left', 'food-expo' ),
			'footer-right' => esc_html__( 'Footer Right', 'food-expo' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'food_expo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function food_expo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'food_expo_content_width', 640 );
}
add_action( 'after_setup_theme', 'food_expo_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function food_expo_scripts() {
	
	wp_enqueue_style( 
		'ife-google-fonts', // Unique Handle 
		"https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&display=swap", 
		array(), // Dependencies
		null, // Need null for version number with Google fonts since it can re-use query terms (e.g. family)
		'all'
	);

	// Enqueue Swiper on all pages to enable featured vendors carousel
	wp_enqueue_style(
		'ife-swiper-styles',
		get_template_directory_uri() . '/css/swiper-bundle.css',
		array(),
		'8.1.4'
	);

	wp_enqueue_style( 'food-expo-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'food-expo-style', 'rtl', 'replace' );

	wp_enqueue_script( 'food-expo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue Swiper on all pages to enable featured vendors carousel
	wp_enqueue_script(
		'ife-swiper-scripts',
		get_template_directory_uri() . '/js/swiper-bundle.min.js',
		array(),
		'8.1.4',
		true	// load in footer
	);

	// Featured Vendors Template Part Carousel (every page)
	wp_enqueue_script(
		'ife-swiper-settings-vendors',
		get_template_directory_uri() . '/js/swiper-settings-vendors.js',
		array( 'ife-swiper-scripts' ),
		_S_VERSION,
		true	// load in footer
	);

	// Home Page Carousel Banner
	if ( is_front_page() ) :
		wp_enqueue_script(
			'ife-swiper-settings-home',
			get_template_directory_uri() . '/js/swiper-settings-home.js',
			array( 'ife-swiper-scripts' ),
			_S_VERSION,
			true	// load in footer
		);
	endif;

	// About Page Organizers Carousel
	if ( is_page( array( 60 ) ) ) :
		wp_enqueue_script(
			'ife-swiper-settings-organizers',
			get_template_directory_uri() . '/js/swiper-settings-organizers.js',
			array( 'ife-swiper-scripts' ),
			_S_VERSION,
			true	// load in footer
		);
	endif;

	// About Page History section
	if ( is_page( array( 60 ) ) ) :
		wp_enqueue_script(
			'ife-about-history',
			get_template_directory_uri() . '/js/about-history.js',
			array(),
			_S_VERSION,
			true	// load in footer
		);
	endif;

	// Vendor Page Modal
	if ( is_page( array( 40 ) ) ) :
		wp_enqueue_script(
			'ife-vendor-modal',
			get_template_directory_uri() . '/js/vendor-modal.js',
			array(),
			_S_VERSION,
			true	// load in footer
		);
	endif;

	// If on the front page or in a selection of pages, setup the google maps
	// ID: 60 - About Page
	if ( is_front_page() || is_page( array( 60 ) ) ) :

		// Google Maps code
		wp_enqueue_script(
			'ife-google-maps',
			'https://maps.googleapis.com/maps/api/js?key=AIzaSyBXXzioydGJrV3pWfn5Pe0eYp6iOGyuhco',
			array(),
			_S_VERSION,
			true	// load in footer
		);

		// Helper functions/setup
		wp_enqueue_script(
			'ife-google-maps-setup',
			get_template_directory_uri() . '/js/google-maps-setup.js',
			array( 'ife-google-maps' ),
			_S_VERSION,
			true	// load in footer
		);
	endif;

	// Isotope Js for Vendor Page
	if ( is_page( array( 40 ) ) ) {
		wp_enqueue_script(
			'ife-isotope',
			get_template_directory_uri() . '/js/isotope.pkgd.min.js',
			array(),
			_S_VERSION,
			true	// load in footer
		);

		wp_enqueue_script(
			'ife-isotope-settings-vendors',
			get_template_directory_uri() . '/js/isotope-settings-vendors.js',
			array( 'ife-isotope' ),
			_S_VERSION,
			true	// load in footer
		);
	}
}
add_action( 'wp_enqueue_scripts', 'food_expo_scripts' );

// Custom post types & taxonomies
require get_template_directory() . '/inc/cpt-taxonomy.php';

// Add Google api key
require get_template_directory() . '/inc/google-api.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Move Yoast metabox.
 */
require get_template_directory() . '/inc/move-yoast-metabox.php';

/**
 * Customize Dashboard.
 */
require get_template_directory() . '/inc/dashboard.php';

/**
 * Customize Admin Links.
 */
require get_template_directory() . '/inc/admin-links.php';

// Replacing The Title Placeholder Text in WordPress
function ife_change_title_text( $title ){
     $screen = get_current_screen();
   
		 // target the individual CPT
     if  ( 'ife-event' == $screen->post_type ) {
					// change the placeholder text in $title
          $title = 'Event Name';
     }

		 if  ( 'ife-vendor' == $screen->post_type ) {
          $title = 'Vendor Name';
     }

     return $title;
}
add_filter( 'enter_title_here', 'ife_change_title_text' );

// Save acf_form to send an email to admin
function ife_save_vendor ( $post_id ) {
	
	// bail early if not a ife-vendor post
	if( get_post_type($post_id) !== 'ife-vendor' ) {
		return;	
	}

	// bail early if editing in admin
	if( is_admin() ) {
		return;
	}
	
	// vars
	$post = get_post( $post_id );
	
	if ( function_exists ( 'get_field' ) ) {

		// get custom fields (field group exists for ife-vendor CPT)
		if ( get_field( 'full_name', $post_id ) ) {
				$full_name = get_field( 'full_name', $post_id );
		}

		if ( get_field( 'email_address', $post_id ) ) {
				$email_address = get_field( 'email_address', $post_id );
		}

		if ( get_field( 'company_website', $post_id ) ) {
				$company_website = get_field( 'company_website', $post_id );
		}

		if ( get_field( 'company_description', $post_id ) ) {
			$company_description = get_field( 'company_description', $post_id );
		}
		
		// email data
		$to = 'zxu80@my.bcit.ca';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$post_title = get_the_title( $post_id );
		$subject 	= get_bloginfo( 'name' ) . " - A new vendor application has been submitted to your site.";
		$message 	= "<p>Please review the application before publishing:</p><br>";
		$message   .= "<table>";
		$message   .= "<tr><td>Company Name</td><td>" . $post_title . "</td></tr>";
		$message   .= "<tr><td>Company Website</td><td>" . $company_website . "</td></tr>";
		$message   .= "<tr><td>Company Name</td><td>" . $company_description . "</td></tr>";
		$message   .= "</table>";
		
		/* 
		Uncomment this code to send all admin accounts the email notification when an application is received
		*/
		// $administrators 	= get_users(array(
		// 'role'	=> 'administrator'
		// ));

		// foreach ($administrators as $administrator) {
		// 	wp_mail($administrator->data->user_email, $subject, $message, $headers );
		// }

		// send one email
		wp_mail($to, $subject, $message, $headers);

		// Redirect to thank-you page with the newly created post id embedded
		if ($_POST['issubmitform'] === "yes"){
        wp_redirect( home_url('vendor-thank-you/?thankid=' . $post_id) ); exit;
    }

	}

}
add_action('acf/save_post', 'ife_save_vendor', 99);

// Modify ACF Form Label for Post Title Field
function ife_post_title_acf_name( $field ) {
     if( is_page($page = 'vendor-application') ) { // if on the vendor page
          $field['label'] = 'Company Name';
     } else {
          $field['label'] = 'Name';
     }
     return $field;
}
add_filter('acf/load_field/name=_post_title', 'ife_post_title_acf_name');

// Set ACF image as featured image
function ife_acf_set_featured_image( $value, $post_id ){
    
    if($value != ''){
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
 
    return $value;
}
// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=upload_company_logo', 'ife_acf_set_featured_image', 10, 3);
 
// Change the excerpt length
function ife_excerpt_length ( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'ife_excerpt_length', 999 );

// Change the excerpt ending
function ife_excerpt_more ( $more ) {
	$more = "... <a href='" . get_permalink() . "' class='read-more'>More Info</a>";
	return $more;
}
add_filter( 'excerpt_more', 'ife_excerpt_more' );

// Customize login logo 
function ife_login_logo () { 
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );
	?> 
	<style type="text/css"> 
		#login h1 a, .login h1 a { 
			background-image: url(<?php echo esc_url( $logo[0] ) ?>); 
			height:150px; /* those lines are for custom styling for the logo */ 
			width:150px; 
			background-size: 150px 150px; 
			background-repeat: no-repeat; 
			padding-bottom: 10px; 
		} 
	</style> 
	<?php 
} 
add_action( 'login_enqueue_scripts', 'ife_login_logo' );

// Change Login form logo url
function ife_login_logo_url () {
	return home_url();
}
add_filter( 'login_headerurl', 'ife_login_logo_url' );

// Change Login form logo text
function ife_login_logo_url_title () {
	return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'ife_login_logo_url_title' );

// Style Login form
function ife_login_form () { ?> 
	<style type="text/css"> 
		body.login div#login form#loginform { 
			background-color:#D5EAEE; 
			border-radius:1rem; 
		} 
	</style> 
<?php } 
add_action( 'login_enqueue_scripts', 'ife_login_form' );

// Disable Content Editor
// https://www.scorp13.com/en/workflow/how-to-turn-off-the-editor-for-certain-pages-posts-in-wordpress.html
function ife_disable_content_editor()
{
    if (isset($_GET['post'])) {
			$post_ID = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
			$post_ID = $_POST['post_ID'];
    }

    if (!isset($post_ID) || empty($post_ID)) {
			return;
    }

    $disabled_IDs = array(15, 29, 36, 38, 40, 42, 60);
    if (in_array($post_ID, $disabled_IDs)) {
			remove_post_type_support('page', 'editor');
    }
}

add_action('admin_init', 'ife_disable_content_editor');