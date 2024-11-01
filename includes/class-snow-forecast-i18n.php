<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://pistepro.com/
 * @since      1.0.0
 *
 * @package    BDPP_Snow_Forecast
 * @subpackage Snow_Forecast/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    BDPP_Snow_Forecast
 * @subpackage BDPP_Snow_Forecast/includes
 * @author     Piste Pro <contact@pistepro.com>
 */
class BDPP_Snow_Forecast_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'snow-forecast',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
