<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://davenorm.me
 * @since      1.0.0
 *
 * @package    Htpasswd_Handler
 * @subpackage Htpasswd_Handler/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Htpasswd_Handler
 * @subpackage Htpasswd_Handler/includes
 * @author     david norminton <davidnorminton@gmail.com>
 */
class Htpasswd_Handler_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'htpasswd-handler',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
