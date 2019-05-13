<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.virtualbit.it
 * @since             1.0.0
 * @package           Whaddaprice
 *
 * @wordpress-plugin
 * Plugin Name:       Whadda Price
 * Plugin URI:        https://www.virtualbit.it/whaddaprice
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.0.1
 * Author:            Lucio Crusca
 * Author URI:        https://www.virtualbit.it
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       whaddaprice
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
define( 'WHADDAPRICE_VERSION', '0.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-whaddaprice-activator.php
 */
function activate_whaddaprice() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-whaddaprice-activator.php';
	Whaddaprice_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-whaddaprice-deactivator.php
 */
function deactivate_whaddaprice() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-whaddaprice-deactivator.php';
	Whaddaprice_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_whaddaprice' );
register_deactivation_hook( __FILE__, 'deactivate_whaddaprice' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-whaddaprice.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_whaddaprice() {

	$plugin = new Whaddaprice();
	$plugin->run();

}
run_whaddaprice();
