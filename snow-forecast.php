<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://pistepro.com/
 * @since             1.0.0
 * @package           BDPP_Snow_Forecast
 *
 * @wordpress-plugin
 * Plugin Name:       Snow Forecast - Piste Pro
 * Plugin URI:        https://pistepro.com/
 * Description:       Snow forecast data is valuable content for website owners, encouraging repeat visits and longer site engagement. The Snow Forecast - Piste Pro widget enables website masters to display snow forecast data in metric or imperial units.
 * Version:           1.0.0
 * Author:            Piste Pro
 * Author URI:        https://barracuda.digital/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       snow-forecast
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
define( 'BDPP_SNOW_FORECAST_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-snow-forecast-activator.php
 */
function activate_bdpp_snow_forecast() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-snow-forecast-activator.php';
	BDPP_Snow_Forecast_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-snow-forecast-deactivator.php
 */
function deactivate_bdpp_snow_forecast() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-snow-forecast-deactivator.php';
	BDPP_Snow_Forecast_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bdpp_snow_forecast' );
register_deactivation_hook( __FILE__, 'deactivate_bdpp_snow_forecast' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-snow-forecast.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bdpp_snow_forecast() {

	$plugin = new BDPP_Snow_Forecast();
	$plugin->run();

}
run_bdpp_snow_forecast();
