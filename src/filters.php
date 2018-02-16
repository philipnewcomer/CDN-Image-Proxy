<?php

namespace PhilipNewcomer\CDNImageProxy;

/**
 * Disables Jetpack Image CDN (Photon) Development Mode.
 *
 * Not to be confused with Jetpack development mode.
 */
add_filter( 'jetpack_photon_development_mode', '__return_false' );

/**
 * Run all attachment URLs through Jetpack Image CDN (Photon).
 */
add_filter( 'wp_get_attachment_url', 'jetpack_photon_url' );

/**
 * Disables the wordpress.com connection requirement for the Jetpack Image CDN (Photon) module.
 *
 * @param array  $module_data The module data.
 * @param string $module_slug The module slug.
 *
 * @return array The filtered module data.
 */
function disable_photon_connection_required( $module_data, $module_slug ) {

	if ( 'photon' !== $module_slug ) {
		return $module_data;
	}

	$module_data['requires_connection'] = false;

	return $module_data;
}
add_filter( 'jetpack_get_module', __NAMESPACE__ . '\disable_photon_connection_required', 10, 2 );

/**
 * Forces the Jetpack Image CDN (Photon) module to be active.
 *
 * @param array $active_modules The active Jetpack modules.
 *
 * @return array The filtered list of active modules.
 */
function force_activate_photon( $active_modules ) {

	if ( ! in_array( 'photon', $active_modules, true ) ) {
		$active_modules[] = 'photon';
	}

	return $active_modules;
}
add_filter( 'jetpack_active_modules', __NAMESPACE__ . '\force_activate_photon' );

/**
 * Replaces the image source URL with the proxy remote URL.
 *
 * @param string $url The image source URL.
 *
 * @return string The filtered URL.
 */
function photon_use_proxy_remote_url( $url ) {

	return replace_url_with_remote( $url );
}
add_filter( 'jetpack_photon_pre_image_url', __NAMESPACE__ . '\photon_use_proxy_remote_url' );
