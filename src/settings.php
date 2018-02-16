<?php

namespace PhilipNewcomer\CDNImageProxy;

/**
 * Registers the plugin settings sections and fields.
 */
function register_settings() {

	add_settings_section(
		'cdn_image_proxy',
		__( 'CDN Image Proxy', 'cdn-image-proxy' ),
		__NAMESPACE__ . '\settings_section_description',
		'media'
	);

	add_settings_field(
		get_proxy_remote_url_option_name(),
		__( 'Remote URL', 'cdn-image-proxy' ),
		__NAMESPACE__ . '\remote_url_settings_field',
		'media',
		'cdn_image_proxy'
	);

	register_setting( 'media', get_proxy_remote_url_option_name(), [
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'string',
	] );
}
add_action( 'admin_init', __NAMESPACE__ . '\register_settings' );

/**
 * Displays the plugin settings section description text.
 */
function settings_section_description() {

	?>
	<p>
		<?php esc_html_e( 'Use Jetpack Image CDN (formerly Photon) to proxy image uploads from another site.', 'cdn-image-proxy' ); ?>
	</p>
	<?php
}

/**
 * Displays the settings field for the Remote URL setting.
 */
function remote_url_settings_field() {

	$constant_name       = get_proxy_remote_url_constant_name();
	$current_value       = get_proxy_remote_url();
	$is_constant_defined = defined( $constant_name );
	$option_name         = get_proxy_remote_url_option_name();

	?>
	<input type="text"
		id="<?php echo esc_attr( $option_name ); ?>"
		class="regular-text code"
		name="<?php echo esc_attr( $option_name ); ?>"
		value="<?php echo esc_attr( $current_value ); ?>"
		placeholder="http://example.com"
		<?php disabled( $is_constant_defined, true ); ?>>
	<?php

	if ( $is_constant_defined ) :
		?>
		<p class="description">
			<?php
			// Translators: %1$s: PHP constant name; %2$s: wp-config.php filename
			printf( esc_html__( 'The %1$s constant is defined in %2$s.', 'cdn-image-proxy' ),
				'<code>' . esc_html( $constant_name ) . '</code>',
				'<code>wp-config.php</code>'
			);
			?>
		</p>
		<?php
	endif;
}
