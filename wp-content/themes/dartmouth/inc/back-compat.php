<?php
/**
 * Dartmouth back compat functionality
 *
 * Prevents Dartmouth from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage Dartmouth
 * @since Dartmouth 1.0
 */

/**
 * Prevent switching to Dartmouth on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Dartmouth 1.0
 */
function dartmouth_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'dartmouth_upgrade_notice' );
}
add_action( 'after_switch_theme', 'dartmouth_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Dartmouth on WordPress versions prior to 3.6.
 *
 * @since Dartmouth 1.0
 */
function dartmouth_upgrade_notice() {
	$message = sprintf( __( 'Dartmouth requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'dartmouth' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since Dartmouth 1.0
 */
function dartmouth_customize() {
	wp_die( sprintf( __( 'Dartmouth requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'dartmouth' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'dartmouth_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since Dartmouth 1.0
 */
function dartmouth_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Dartmouth requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'dartmouth' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'dartmouth_preview' );
