<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Food_Expo
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function food_expo_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'food_expo_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function food_expo_woocommerce_scripts() {
	wp_enqueue_style( 'food-expo-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'food-expo-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'food_expo_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function food_expo_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'food_expo_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function food_expo_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'food_expo_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'food_expo_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function food_expo_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'food_expo_woocommerce_wrapper_before' );

if ( ! function_exists( 'food_expo_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function food_expo_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'food_expo_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'food_expo_woocommerce_header_cart' ) ) {
			food_expo_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'food_expo_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function food_expo_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		food_expo_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'food_expo_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'food_expo_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function food_expo_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'food-expo' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'food-expo' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'food_expo_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function food_expo_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php food_expo_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

// Initialize WooCommerce theme config
function food_expo_woocommerce_init () {

	// Remove Price from Single Product page
  remove_action(
    'woocommerce_single_product_summary',
    'woocommerce_template_single_title',
    5
  );

	// Remove product meta from Single Product page
  remove_action(
    'woocommerce_single_product_summary',
    'woocommerce_template_single_meta',
    40
  );

	// Remove additional info from Single Product page
  remove_action(
    'woocommerce_after_single_product_summary',
    'woocommerce_output_product_data_tabs',
    10
  );
}

add_action( 'init', 'food_expo_woocommerce_init');

// Add label in front of the quantity field
function wp_echo_qty_front_add_cart() {
	echo '<label class="qty">Select Ticket Quantity</label>'; 
}
add_action( 'woocommerce_before_add_to_cart_quantity', 'wp_echo_qty_front_add_cart' );

// Move variation price below the quantity field
function move_variation_price() {
    remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
    add_action( 'woocommerce_after_add_to_cart_quantity', 'woocommerce_single_variation', 10 );
		 
}
add_action( 'woocommerce_before_add_to_cart_form', 'move_variation_price' );

// Add label in front of the variation price
function wp_echo_label_front_var_price($price) {
	// echo '<label class="qty">Price per Selected Ticket</label>'; 
	$text_to_add_before_price  = ' per ticket '; //change text in bracket to your preferred text 
	return  $price . $text_to_add_before_price;
}
add_filter( 'woocommerce_get_price_html', 'wp_echo_label_front_var_price' );

// Change In Stock text to custom text
function change_in_stock_text( $availability, $product ) {

	// Change In Stock Text
	if ( $product->managing_stock() ) {
		$availability['availability'] = __('' . $product->get_stock_quantity() . ' Ticket(s) Remaining!', 'woocommerce');
	} 
	
	return $availability;
}
add_filter( 'woocommerce_get_availability', 'change_in_stock_text', 1, 2);

// Remove sidebar in single product page
function ife_remove_sidebar_product_pages() {
	if ( is_product() ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}
add_action( 'woocommerce_before_main_content', 'ife_remove_sidebar_product_pages' );

// Add wc cart in the single product page
function ife_cart_on_single_product_page() {
	echo "<h2 class='cart-title'>Cart</h2>";
	echo do_shortcode('[woocommerce_cart]');
	
}
add_action( 'woocommerce_after_single_product_summary', 'ife_cart_on_single_product_page', 5 );

// Remove cart item image
add_filter( 'woocommerce_cart_item_thumbnail', '__return_false' );

// Remove cart item link
function ife_remove_cart_product_link( $product_link, $cart_item, $cart_item_key ) {
    $product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    return $product->get_title();
}
add_filter( 'woocommerce_cart_item_name', 'ife_remove_cart_product_link', 10, 3 );

// Remove WooCommerce Breadcrumbs
function remove_shop_breadcrumbs(){
    if (is_product())
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}
add_action('template_redirect', 'remove_shop_breadcrumbs' );


// Add banner to single product pages
function add_single_product_page_banner(){
		get_template_part( 'template-parts/banner' );
};
add_action('woocommerce_before_single_product_summary', 'add_single_product_page_banner');

// Remove reset variations button
add_filter('woocommerce_reset_variations_link', '__return_empty_string');

// Redirect WooCommerce Shop URL
function ife_woocommerce_shop_url(){
	return get_permalink(44);
}
add_filter( 'woocommerce_return_to_shop_redirect', 'ife_woocommerce_shop_url' );


// Change 'Return to Shop' text on button
function prefix_store_button() {
	$store_button = "Back to Ticketing"; // Change text as required
	return $store_button;
}
add_filter('woocommerce_return_to_shop_text', 'prefix_store_button');

// Add featured vendors after single product in ticketing page
function ife_featured_vendors_after_single_product(){
		get_template_part( 'template-parts/featured-vendors' );
}
add_action( 'woocommerce_after_single_product', 'ife_featured_vendors_after_single_product' );

// Add featured vendors after cart in cart page
function ife_featured_vendors_after_cart(){
	if(!is_product()){
		get_template_part( 'template-parts/featured-vendors' );
	}
}
add_action( 'woocommerce_after_cart', 'ife_featured_vendors_after_cart' );


// Add featured vendors to checkout page
function ife_featured_vendors_after_checkout(){
	get_template_part( 'template-parts/featured-vendors' );
}
add_action( 'woocommerce_after_checkout_form', 'ife_featured_vendors_after_checkout' );



