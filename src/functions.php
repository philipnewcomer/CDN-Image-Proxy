<?php

namespace PhilipNewcomer\CDNImageProxy;

/**
 * Determines whether the Jetpack plugin is active.
 *
 * @return bool
 */
function is_jetpack_active() {
	return is_plugin_active( 'jetpack/jetpack.php' );
}

/**
 * Returns the proxy remote URL.
 *
 * @return string
 */
function get_proxy_remote_url() {

	$constant_name = get_proxy_remote_url_constant_name();
	$option_name   = get_proxy_remote_url_option_name();

	if ( defined( $constant_name ) ) {
		return constant( $constant_name );
	}

	return get_option( $option_name );
}

/**
 * Returns the remote URL constant name.
 *
 * @return string
 */
function get_proxy_remote_url_constant_name() {
	return 'CDN_IMAGE_PROXY_REMOTE_URL';
}

/**
 * Returns the remote URL option name.
 *
 * @return string
 */
function get_proxy_remote_url_option_name() {
	return 'cdn_image_proxy_remote_url';
}

/**
 * Replaces the domain name in a URL with the one configured in the plugin settings.
 *
 * @param string $url The full URL.
 *
 * @return string The filtered URL.
 */
function replace_url_with_remote( $url = null ) {

	$url_parsed = wp_parse_url( $url );

	return untrailingslashit( get_proxy_remote_url() ) . $url_parsed['path'];
}
