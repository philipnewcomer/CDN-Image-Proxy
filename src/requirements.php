<?php

namespace PhilipNewcomer\CDNImageProxy;

/**
 * Displays an admin notice for any missing requirements.
 */
function admin_notices() {

	$current_screen        = get_current_screen();
	$is_dashboard          = ! empty( $current_screen->id ) && 'dashboard' === $current_screen->id;
	$is_media_setting_page = ! empty( $current_screen->id ) && 'options-media' === $current_screen->id;
	$is_plugins_page       = ! empty( $current_screen->id ) && 'plugins' === $current_screen->id;

	if ( ! $is_dashboard && ! $is_media_setting_page && ! $is_plugins_page ) {
		return;
	}

	if ( ! is_jetpack_active() ) {
		?>
		<div class="notice notice-warning">
			<p>
				<?php esc_html_e( 'CDN Image Proxy requires Jetpack to be installed and active.', 'cdn-image-proxy' ); ?>

				<?php
				if ( ! $is_plugins_page ) {
					// Translators: %s: link to action
					printf( esc_html__( 'Please %s.', 'cdn-image-proxy' ),
						sprintf( '<a href="%s">%s</a>',
							esc_url( admin_url( 'plugins.php' ) ),
							esc_html__( 'Install Jetpack', 'cdn-image-proxy' )
						)
					);
				}
				?>
			</p>
		</div>
		<?php
	}

	if ( empty( get_proxy_remote_url() ) && ! $is_media_setting_page ) {
		?>
		<div class="notice notice-warning">
			<p>
				<?php
				// Translators: %s: link to action
				printf( esc_html__( 'Please %s.', 'cdn-image-proxy' ),
					sprintf( '<a href="%s">%s</a>',
						esc_url( admin_url( 'options-media.php' ) ),
						esc_html__( 'Configure the CDN Image Proxy remote URL', 'cdn-image-proxy' )
					)
				);
				?>
			</p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', __NAMESPACE__ . '\admin_notices' );
