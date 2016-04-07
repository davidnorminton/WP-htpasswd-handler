<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://davenorm.me
 * @since             1.0.0
 * @package           Htpasswd_Handler
 *
 * @wordpress-plugin
 * Plugin Name:       htpasswd handler
 * Plugin URI:        https://github.com/davidnorminton/htpasswd
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            david norminton
 * Author URI:        https://davenorm.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       htpasswd-handler
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-htpasswd-handler-activator.php
 */
function activate_htpasswd_handler() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-htpasswd-handler-activator.php';
	Htpasswd_Handler_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-htpasswd-handler-deactivator.php
 */
function deactivate_htpasswd_handler() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-htpasswd-handler-deactivator.php';
	Htpasswd_Handler_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_htpasswd_handler' );
register_deactivation_hook( __FILE__, 'deactivate_htpasswd_handler' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-htpasswd-handler.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_htpasswd_handler() {

	$plugin = new Htpasswd_Handler();
	$plugin->run();

}
run_htpasswd_handler();
