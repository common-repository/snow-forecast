<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://pistepro.com/
 * @since      1.0.0
 *
 * @package    BDPP_Snow_Forecast
 * @subpackage BDPP_Snow_Forecast/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BDPP_Snow_Forecast
 * @subpackage BDPP_Snow_Forecast/admin
 * @author     Piste Pro <contact@pistepro.com>
 */
class BDPP_Snow_Forecast_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BDPP_Snow_Forecast_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BDPP_Snow_Forecast_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/snow-forecast-admin.css?asdas', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BDPP_Snow_Forecast_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BDPP_Snow_Forecast_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/snow-forecast-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Load the plugin's widgets.
	 *
	 * @since    1.0.0
	 */
	public function load_widgets()
	{
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-snow-forecast-widget.php';
		register_widget('BDPP_snow_forecast_widget');
	}

	public function create_admin_menu()
	{
		//create new top-level menu
		add_menu_page(__('Snow Forecast - Piste Pro Widget Constructor', 'snow-forecast'), __('Snow Forecast', 'snow-forecast'), 'administrator', 'snow-forecast', array($this, 'snow_forecast_settings_page'), 'dashicons-location', 98);
	}

	function plugin_settings() {
		register_setting( 'snow-forecast-settings-group', 'snow-forecast_country' );
		register_setting( 'snow-forecast-settings-group', 'snow-forecast_resort' );
		register_setting( 'snow-forecast-settings-group', 'snow-forecast_resort_encoded' );
		register_setting( 'snow-forecast-settings-group', 'snow-forecast_units' );
		register_setting( 'snow-forecast-settings-group', 'snow-forecast_size' );
		register_setting( 'snow-forecast-settings-group', 'snow-forecast_link' );
	}

	public function snow_forecast_settings_page()
	{

		$var = [];
		$var['api-data'] = $this->get_data("GET","https://pistepro.com/widget/data");
		$var['country'] = get_option('snow-forecast_country');
		$var['resort'] = get_option('snow-forecast_resort');
		$var['resort_encoded'] = get_option('snow-forecast_resort_encoded');
		$var['units'] = get_option('snow-forecast_units');
		$var['size'] = get_option('snow-forecast_size');
		$var['link'] = get_option('snow-forecast_link');
		
		
		require_once 'partials/snow-forecast-admin-display.php';

	}

	private function get_data($method, $url, $data = false)
	{
		$json_local_data = file_get_contents(plugin_dir_path(dirname(__FILE__)) . 'admin/data.json');

		return json_decode($json_local_data, true);
		
	}
	
}
