<?php
/**
 * Plugin Name: Simple Woo Notification
 * Description: Create a small WooCommerce plugin that displays add to cart notifications in a popup when a product is added to cart.
 * Author: Donny
 * Author URI: https://woo.com/
 * Version: 1.0.14
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: swcp
 * Domain Path: /languages
 *
 * @since 1.0.0
 * @package Swcp
 */

defined( 'ABSPATH' ) || exit;

// define( 'SWCP_VER', '1.0.14' );
define( 'SWCP_VER', time() );
define( 'SWCP_PATH', plugin_dir_path( __FILE__ ) );
define( 'SWCP_URL', plugin_dir_url( __FILE__ ) );
define( 'SWCP_DEFAULT', [
	'layout'   => 'image_not_bg',
	'position' => 'top',
	'close'    => 3,
	'pages'    => [],
] );

register_activation_hook(
	__FILE__,
	function () {}
);
register_deactivation_hook(
	__FILE__,
	function () {}
);

// enqueue scripts
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script( 'swcp', SWCP_URL . 'script.js', [ 'jquery' ], SWCP_VER, true );
	wp_enqueue_style( 'swcp', SWCP_URL . 'style.css', [], SWCP_VER, 'screen' );

	// get settings
	$settings = get_option( 'swcp_popup_settings', SWCP_DEFAULT );
	$show     = 0;

	if ( ! empty( $settings['pages'] ) ) {
		if ( in_array( 'all', $settings['pages'], true ) ) {
			// show popup on all pages
			$show = 1;
		} else {
			// show popup only on selected pages
			foreach ( $settings['pages'] as $page ) {
				if ( 'shop_archive' === $page && is_shop() ) {
					$show = 1;
					break;
				}

				if ( 'shop_categories' === $page && is_product_category() ) {
					$show = 1;
					break;
				}

				if ( 'shop_tags' === $page && is_product_tag() ) {
					$show = 1;
					break;
				}

				if ( 'shop_attribs' === $page ) {
					$show = 1;
					break;
				}

				if ( 'single_products' === $page && is_singular( 'product' ) ) {
					$show = 1;
					break;
				}
			}
		}
	}

	// set javascript variables
	wp_localize_script( 'swcp', 'swcp', [
		'layout'   => $settings['layout'],
		'position' => $settings['position'],
		'close'    => apply_filters( 'swcp_close_timer', (int) $settings['close'] ),
		'show'     => $show,
	] );
} );

add_action( 'admin_menu', function () {
	// create submenu for settings
	add_submenu_page(
		'woocommerce',
		esc_html__( 'Cart Popup Settings', 'swcp' ),
		esc_html__( 'Cart Popup Settings', 'swcp' ),
		'manage_options',
		'cart-popup-settings',
		function () {
			// bail if not admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// get settings, or use default if not set
			$settings = get_option( 'swcp_popup_settings', SWCP_DEFAULT );

			require_once SWCP_PATH . 'admin-settings.php';
		},
	);
} );

// save settings
add_action( 'admin_post_swcp_cart_popup_settings', function () {
	$post    = wp_unslash( $_POST );
	$referer = esc_url( home_url(
		isset( $post['_wp_http_referer'] ) ?
			sanitize_text_field( $post['_wp_http_referer'] ) :
			'/'
	) );

	if ( ! isset( $post['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( $post['_wpnonce'] ), 'swcp_cart_popup_settings' ) ) {
		$text = esc_html__( 'Sorry, your nonce did not verify.', 'swcp' );

		// phpcs:ignore
		wp_die( $text, $text, [
			'link_url'  => esc_url( $referer ),
			'link_text' => esc_html__( 'Back', 'swcp' ),
		] );
	}

	// check/set settings, in not set use default
	$layout   = isset( $post['layout'] ) ? sanitize_text_field( $post['layout'] ) : 'image_not_bg';
	$position = isset( $post['position'] ) ? sanitize_text_field( $post['position'] ) : 'top';
	$close    = isset( $post['close'] ) ? (int) sanitize_text_field( $post['close'] ) : 3;
	$pages    = [];

	if ( isset( $post['pages'] ) ) {
		if ( in_array( 'all', (array) $post['pages'], true ) ) {
			$pages = [ 'all' ];
		} else {
			foreach ( (array) $post['pages'] as $page ) {
				$pages[] = $page;
			}
		}
	}

	// save to options table
	update_option( 'swcp_popup_settings', [
		'layout'   => $layout,
		'position' => $position,
		'close'    => $close,
		'pages'    => $pages,
	], false );

	wp_safe_redirect( esc_url( $referer ) );
	exit;
} );