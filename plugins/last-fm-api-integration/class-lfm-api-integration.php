<?php
/**
 * Plugin Name: LastFM API Integration
 * Plugin Description: Store your Last FM API Key.
 *
 * @package LFM_API
 */

namespace LFM;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * LastFM API Integration
 */
class LFM_API_Integration {

	/**
	 * The prefix used within the project
	 *
	 * @var string
	 */
	public static $prefix = 'lfm';

	/**
	 * Initalise the plugin
	 *
	 * @return true;
	 */
	public static function init() {
		require_once __DIR__ . '/cmb2/init.php';

		return true;
	}

	/**
	 * Register the CMB2 options page for capturing necessary data for our plugin
	 * @return [type] [description]
	 */
	private static function register_options_page() {
		$cmb_options = new_cmb2_box(
			array(
				'id'           => self::$prefix . '_plugin_options_page',
				'title'        => esc_html__( 'Plugin Options', 'cmb2' ),
				'object_types' => array( 'options-page' ),
				'option_key'      => self::$prefix . '_plugin_options', // The option key and admin menu page slug.
				'icon_url'        => 'dashicons-smile', // Menu icon. Only applicable if 'parent_slug' is left empty.
			)
		);
	}

}
