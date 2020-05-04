<?php

namespace Hannah\Last_FM;

define( 'LAST_FM_PREFIX', 'last_fm_' );

/**
 * Bootstrap the plugin.
 *
 * @return void
 */
function bootstrap() {
	require_once __DIR__ . '../../vendor/cmb2/cmb2/init.php';
	add_action( 'cmb2_admin_init', __NAMESPACE__ . '\\register_options_page' );
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
