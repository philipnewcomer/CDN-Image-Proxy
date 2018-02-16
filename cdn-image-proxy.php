<?php
/**
 * Plugin Name: CDN Image Proxy
 * Plugin URI:  https://github.com/philipnewcomer/CDN-Image-Proxy
 * Description: Use Jetpack Image CDN (formerly Photon) to proxy image uploads from another site.
 * Version:     1.0.0
 * Author:      Philip Newcomer
 * Author URI:  https://philipnewcomer.net
 * Text Domain: cdn-image-proxy
 * Domain Path: /languages
 */

/**
 * Initializes the plugin.
 *
 * Loads the plugin includes, or enqueues an admin message if the required PHP version is not met.
 */
function cdn_image_proxy_init() {

	if ( false === version_compare( PHP_VERSION, cdn_image_proxy_get_required_php_version(), '>=' ) ) {
		add_action( 'admin_notices', 'cdn_image_proxy_php_version_notice' );
		return;
	}

	require_once __DIR__ . '/src/filters.php';
	require_once __DIR__ . '/src/functions.php';
	require_once __DIR__ . '/src/requirements.php';
	require_once __DIR__ . '/src/settings.php';
}
add_action( 'plugins_loaded', 'cdn_image_proxy_init' );

/**
 * Returns the minimum PHP version required by the plugin.
 *
 * @return string
 */
function cdn_image_proxy_get_required_php_version() {
	return '5.4';
}

/**
 * Displays an admin notice regarding the plugin's PHP version requirements.
 */
function cdn_image_proxy_php_version_notice() {
	?>
	<div class="notice notice-error">
		<p>
			<?php
			// Translators: %1$s: the required PHP version; %2$s: the current PHP version
			printf( esc_html__( 'CDN Image Proxy requires PHP version %1$s or greater. Your site is using PHP version %2$s.', 'cdn-image-proxy' ),
				esc_html( cdn_image_proxy_get_required_php_version() ),
				esc_html( PHP_VERSION )
			);
			?>
		</p>
	</div>
	<?php
}
