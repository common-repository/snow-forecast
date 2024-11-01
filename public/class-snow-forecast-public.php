<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://pistepro.com/
 * @since      1.0.0
 *
 * @package    BDPP_Snow_Forecast
 * @subpackage BDPP_Snow_Forecast/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    BDPP_Snow_Forecast
 * @subpackage BDPP_Snow_Forecast/public
 * @author     Piste Pro <contact@pistepro.com>
 */
class BDPP_Snow_Forecast_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/snow-forecast-public.css', array(), $this->version, 'all' );		

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/snow-forecast-public.js', array( 'jquery' ), $this->version, false );

	}

	function snow_forecast_widget_function ($atts = [], $content = null )
    {
        return $this->widget_element($atts);
		
    }

	private function widget_element($atts)
    {
        ob_start();
        include 'partials/snow-forecast-public-display.php';
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

}
