<?php
/**
 * Plugin Name: Last.fm API Integration
 * Description: Store your Last.fm API Key.
 * Version: 0.1
 * Requires PHP: 5.6
 * Author: Hannah Malcolm
 * Author URI: https://www.kawaiihannah.com/
 *
 * @package   Last_FM_API_Integration
 * @author    Hannah Malcolm <kawaiihannah@gmail.com>
 * @copyright 2020 Hannah Malcolm
 * @license   GNU GPLv3
 * @link      https://www.kawaiihannah.com/
 */

namespace Hannah\Last_FM;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/inc/namespace.php';

add_action( 'plugins_loaded', __NAMESPACE__ . '\\bootstrap' );
