<?php

namespace Hannah\Last_FM;

use Barryvanveen\Lastfm\Lastfm;
use GuzzleHttp\Client;

define( 'LAST_FM_PREFIX', 'last_fm_' );

/**
 * Bootstrap the plugin.
 *
 * @return void
 */
function bootstrap() {
	require_once __DIR__ . '../../vendor/cmb2/cmb2/init.php';
	add_action( 'cmb2_admin_init', __NAMESPACE__ . '\\register_options_page' );
	$connection = connect_to_api();
}

/**
 * Get the Last FM API Key
 * @return string The public API key string
 */
function get_api_key() {
	return get_plugin_option( 'lastfm_api_key' );
}

/**
 * Connect to the LastFM Api
 * @return instance
 */
function connect_to_api() {
	return new Lastfm( new Client(), get_api_key() );
}

/**
 * Register the CMB2 options page for capturing necessary data for our plugin
 * @return void
 */
function register_options_page() {
	$cmb_options = new_cmb2_box(
		[
			'id'           => LAST_FM_PREFIX . '_plugin_options_page',
			'title'        => __( 'LastFM Options', 'last_fm' ),
			'object_types' => [ 'options-page' ],
			'option_key'   => LAST_FM_PREFIX . '_plugin_options', // The option key and admin menu page slug.
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


/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function get_plugin_option( $key = '', $default = false ) {

	if ( function_exists( 'cmb2_get_option' ) ) {
		return cmb2_get_option( 'last_fm__plugin_options', $key, $default );
	}

	$opts = get_option( 'last_fm__plugin_options', $default );
	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}
