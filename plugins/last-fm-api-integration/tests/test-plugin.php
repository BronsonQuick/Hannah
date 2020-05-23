<?php
/**
 * Class LastFMIntegrationTest
 *
 * @package Last_Fm_Api_Integration
 */

/**
 * Test our base functions for the plugin
 */
class LastFMIntegrationTest extends WP_UnitTestCase {

	/**
	 * Test getting our stored key
	 */
	public function testGetStoredKey() {
		$key = \Hannah\Last_FM\get_stored_key();
		$this->assertTrue( $key );
	}
}
