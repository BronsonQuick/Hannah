<?php

namespace Hannah\Last_FM;

use Barryvanveen\Lastfm\Lastfm;
use GuzzleHttp\Client;

define( 'LAST_FM_PREFIX', 'last_fm_' );
// define( 'LAST_FM_API_KEY', 'plzkey' );

/**
 * Bootstrap the plugin.
 *
 * @return void
 */
function bootstrap() {
	require_once __DIR__ . '../../vendor/cmb2/cmb2/init.php';
	add_action( 'cmb2_admin_init', __NAMESPACE__ . '\\register_options_page' );

	$api_key = get_key();
}

/**
 * Get the API key. 
 * This looks for a constant or gets the stored option.
 * @return string The API key string
 */
function get_key() {
	if ( defined( 'LAST_FM_API_KEY' ) ) {
		return LAST_FM_API_KEY;
	}
	return get_stored_key();
}

/**
 * Get the stored API key from our options
 * @return string The API key string
 */
function get_stored_key() {
	$key = 'storedkeyplz'; // Get the option from the database
	if ( defined( 'LAST_FM_API_KEY' ) && empty( $key ) ) {
		$key = update_stored_key( LAST_FM_API_KEY );
	}
	return $key;
}

/**
 * Update the API key stored in the database
 * @param  string $value Our API key option value
 * @return string        The stored option value
 */
function update_stored_key( $value ) {
	// Update the meta field here
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
