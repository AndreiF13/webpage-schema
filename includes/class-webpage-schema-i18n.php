<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/AndreiF13/webpage-schema/
 * @since      1.0.0
 *
 * @package    Webpage_Schema
 * @subpackage Webpage_Schema/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Webpage_Schema
 * @subpackage Webpage_Schema/includes
 * @author     AndreiF13 <andrei@webdesignwordpress.eu>
 */
class Webpage_Schema_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'webpage-schema',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
