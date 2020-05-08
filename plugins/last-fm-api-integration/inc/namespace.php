<?php

namespace Hannah\Last_FM;

use Barryvanveen\Lastfm\Lastfm;
use GuzzleHttp\Client;

define( 'LAST_FM_PREFIX', 'last_fm_' );
define( 'LAST_FM_API_KEY', 'constantkey' );

/**
 * Bootstrap the plugin.
 *
 * @return void
 */
function bootstrap() {
	require_once __DIR__ . '../../vendor/cmb2/cmb2/init.php';
	add_action( 'cmb2_admin_init', __NAMESPACE__ . '\\register_options_page' );

	$api_key = get_api_key();
}

/**
 * Get the API key.
 * This looks for a constant or gets the stored option.
 * @return string|false The API key string or the boolean false
 */
function get_api_key() {
	$key = get_stored_key();

	if ( defined( 'LAST_FM_API_KEY' ) && empty( $key ) ) {
		$key = update_stored_key( LAST_FM_API_KEY );
	}

	if ( defined( 'LAST_FM_API_KEY' ) ) {
		return LAST_FM_API_KEY;
	}

	return $key;
}

/**
 * Get the stored API key from our options
 * @return string|false The API key string or the boolean false
 */
function get_stored_key() {
	$options = get_plugin_options();

	if ( is_array( $options ) && array_key_exists( 'lastfm_api_key', $options ) && false !== $options['lastfm_api_key'] ) {
		return $options['lastfm_api_key'];
	}

	return false;
}

/**
 * Get the stored options for our plugin
 * @return array|false An array of stored options
 */
function get_plugin_options() {
	$options = get_option( LAST_FM_PREFIX . 'plugin_options', false );

	if ( is_array( $options ) ) {
		return $options;
	}

	return false;
}

/**
 * Update the API key stored in the database
 * @param  string $value Our API key option value
 * @return string        The stored option value
 */
function update_stored_key( $value ) {
	$options = get_plugin_options();

	if ( is_array( $options ) ) {
		$options['lastfm_api_key'] = $value;
		update_option( LAST_FM_PREFIX . 'plugin_options', $options );
		return $value;
	}

	return false;
}

/**
 * Register the CMB2 options page for capturing necessary data for our plugin
 * @return void
 */
function register_options_page() {
	$cmb_options = new_cmb2_box(
		[
			'id'           => LAST_FM_PREFIX . 'plugin_options_page',
			'title'        => __( 'LastFM Options', 'last_fm' ),
			'object_types' => [ 'options-page' ],
			'option_key'   => LAST_FM_PREFIX . 'plugin_options', // The option key and admin menu page slug.
			'icon_url'     => 'dashicons-format-audio', // Menu icon. Only applicable if 'parent_slug' is left empty.
		]
	);

	// Add the API Key field
	$cmb_options->add_field(
		[
			'name' => __( 'LastFM API key', 'last_fm' ),
			'desc' => __( 'Enter your LastFM API Key. To get an API key, log into your Last.fm account and visit the <a target="_blank" href="https://www.last.fm/api/account/create">Create an API account</a> page.', 'last_fm' ),
			'id'   => 'lastfm_api_key',
			'type' => 'text',
			'default' => '',
		]
	);
}
