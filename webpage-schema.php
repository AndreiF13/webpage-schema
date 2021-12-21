<?php
/**
 * Plugin Name:       WebPage Custom Schema (Schema.org JSON-LD)
 * Plugin URI:        https://github.com/AndreiF13/webpage-schema
 * Description:       WebPage Schema Plugin allows you to use your custom full-featured schema. Schema (JSON-LD) is the most important factor in search engine optimization.
 * Version:           1.0.0
 * Author:            AndreiF13
 * Author URI:        https://github.com/AndreiF13/webpage-schema/
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0-standalone.html
 * Text Domain:       webpage-schema
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WEBPAGE_SCHEMA_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webpage-schema-activator.php
 */
function activate_webpage_schema() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webpage-schema-activator.php';
	Webpage_Schema_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webpage-schema-deactivator.php
 */
function deactivate_webpage_schema() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webpage-schema-deactivator.php';
	Webpage_Schema_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_webpage_schema' );
register_deactivation_hook( __FILE__, 'deactivate_webpage_schema' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-webpage-schema.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_webpage_schema() {

	$plugin = new Webpage_Schema();
	$plugin->run();

}
run_webpage_schema();
