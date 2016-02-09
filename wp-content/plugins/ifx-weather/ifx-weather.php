<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.ifxweather.com
 * @since             1.1.0
 * @package           ifx-weather
 *
 * @wordpress-plugin
 * Plugin Name:       iFx Weather
 * Plugin URI:        http://www.ifxweather.com
 * Description:       Create your own weather forecast. Plugin stores all weather forecasts in a database to be recalled anytime, verified and scored for accuracy.
 * Version:           1.0.1
 * Author:            Austin's Atmosphere
 * Author URI:        http://www.austinsatmosphere.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ifx-weather
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Plugin_Name();
	$plugin->run();

}
run_plugin_name();

function ifxwx_install () {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . '3dayforecasts';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
    forecaster varchar(55) NOT NULL,
    station varchar(20),
    location varchar(55) NOT NULL,
		date varchar(55) NOT NULL,
		time varchar(55) NOT NULL,
	fx_valid_month tinyint(2) NOT NULL,
	fx_valid_day tinyint(2) NOT NULL,
	fx_valid_year tinyint(4) NOT NULL,
	fx_valid_time varchar(10) NOT NULL,
	col1_title varchar(30),
	col1_icon varchar(200),
	col1_weather varchar(55),
	col1_temp tinyint(3),
	col1_highlow varchar(4),
	col1_pop tinyint(3),
	col1_precip tinyint(5),
	col1_hiderain tinyint(1),
	col1_snowmin tinyint(3),
	col1_snowmax tinyint(3),
	col1_windmin tinyint(3),
	col1_winmax tinyint(3),
	col1_windgust tinyint(3),
	col1_winddir varchar(20),
	col1_hidewind tinyint(1),
	col1_details varchar(255),
	col2_title varchar(30),
	col2_icon varchar(200),
	col2_weather varchar(55),
	col2_temp tinyint(3),
	col2_highlow varchar(4),
	col2_pop tinyint(3),
	col2_precip tinyint(5),
	col2_hiderain tinyint(1),
	col2_snowmin tinyint(3),
	col2_snowmax tinyint(3),
	col2_windmin tinyint(3),
	col2_winmax tinyint(3),
	col2_windgust tinyint(3),
	col2_winddir varchar(20),
	col2_hidewind tinyint(1),
	col2_details varchar(255),
	col3_title varchar(30),
	col3_icon varchar(200),
	col3_weather varchar(55),
	col3_temp tinyint(3),
	col3_highlow varchar(4),
	col3_pop tinyint(3),
	col3_precip tinyint(5),
	col3_hiderain tinyint(1),
	col3_snowmin tinyint(3),
	col3_snowmax tinyint(3),
	col3_windmin tinyint(3),
	col3_winmax tinyint(3),
	col3_windgust tinyint(3),
	col3_winddir varchar(20),
	col3_hidewind tinyint(1),
	col3_details varchar(255),
	col4_title varchar(30),
	col4_icon varchar(200),
	col4_weather varchar(55),
	col4_temp tinyint(3),
	col4_highlow varchar(4),
	col4_pop tinyint(3),
	col4_precip tinyint(5),
	col4_hiderain tinyint(1),
	col4_snowmin tinyint(3),
	col4_snowmax tinyint(3),
	col4_windmin tinyint(3),
	col4_winmax tinyint(3),
	col4_windgust tinyint(3),
	col4_winddir varchar(20),
	col4_hidewind tinyint(1),
	col4_details varchar(255),
	col5_title varchar(30),
	col5_icon varchar(200),
	col5_weather varchar(55),
	col5_temp tinyint(3),
	col5_highlow varchar(4),
	col5_pop tinyint(3),
	col5_precip tinyint(5),
	col5_hiderain tinyint(1),
	col5_snowmin tinyint(3),
	col5_snowmax tinyint(3),
	col5_windmin tinyint(3),
	col5_winmax tinyint(3),
	col5_windgust tinyint(3),
	col5_winddir varchar(20),
	col5_hidewind tinyint(1),
	col5_details varchar(255),
	col6_title varchar(30),
	col6_icon varchar(200),
	col6_weather varchar(55),
	col6_temp tinyint(3),
	col6_highlow varchar(4),
	col6_pop tinyint(3),
	col6_precip tinyint(5),
	col6_hiderain tinyint(1),
	col6_snowmin tinyint(3),
	col6_snowmax tinyint(3),
	col6_windmin tinyint(3),
	col6_winmax tinyint(3),
	col6_windgust tinyint(3),
	col6_winddir varchar(20),
	col6_hidewind tinyint(1),
	col6_details varchar(255),
	temp_unit varchar(11),
	precip_unit varchar(3),
	wind_unit varchar(4),
	colorize_temp varchar(4),
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );

}
	function ifxwx_install_data() {
	global $wpdb;
	
	$welcome_forecaster = 'Austin';
	$welcome_station = 'KDXR';
	$welcome_location = 'Danbury, CT';
	$welcome_fx_valid_month = '02';
	$welcome_fx_valid_day = '08';
	$welcome_fx_valid_year = '2016';
	$welcome_fx_valid_time = '5PM - 5AM';
	
	$table_name = $wpdb->prefix . '3dayforecasts';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'forecaster' => $welcome_forecaster, 
			'station' => $welcome_station,
			'location'=> $welcome_location,
			'fx_valid_month' => $welcome_fx_valid_month,
			'fx_valid_day' => $welcome_fx_valid_day,
			'fx_valid_year' => $welcome_fx_valid_year,
			'fx_valid_time' => $welcome_fx_valid_time
		) 
	);

		ifxwx_install ();
		/*ifxwx_install_data ();*/
	}

register_activation_hook( __FILE__, 'ifxwx_install' );
register_activation_hook( __FILE__, 'ifxwx_install_data' );

