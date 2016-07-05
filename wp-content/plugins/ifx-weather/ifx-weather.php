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
 * @since             1.3.1
 * @package           ifx-weather
 *
 * @wordpress-plugin
 * Plugin Name:       iFx Weather
 * Plugin URI:        http://www.ifxweather.com
 * Description:       Create your own weather forecast. Plugin stores all weather forecasts in a database to be recalled anytime, verified and scored for accuracy.
 * Version:           1.3.1
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
	$table_name2 = $wpdb->prefix . '3dayobservations';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		type varchar(5) NOT NULL,
		verified varchar(5) NOT NULL,
    forecaster varchar(55) NOT NULL,
    station varchar(20),
    location varchar(55) NOT NULL,
		date varchar(55) NOT NULL,
		time varchar(55) NOT NULL,
	fx_valid_month smallint(2) NOT NULL,
	fx_valid_day smallint(2) NOT NULL,
	fx_valid_year smallint(4) NOT NULL,
	fx_valid_time varchar(10) NOT NULL,
	col1_title varchar(30),
	col1_icon varchar(400),
	col1_weather varchar(55),
	col1_temp smallint(3),
	col1_highlow varchar(20),
	col1_pop smallint(3),
	col1_precip decimal(3,3),
	col1_hiderain smallint(1),
	col1_snowmin smallint(3),
	col1_snowmax smallint(3),
	col1_windmin smallint(3),
	col1_winmax smallint(3),
	col1_windgust smallint(3),
	col1_winddir varchar(20),
	col1_hidewind smallint(1),
	col1_details varchar(255),
	col2_title varchar(30),
	col2_icon varchar(400),
	col2_weather varchar(55),
	col2_temp smallint(3),
	col2_highlow varchar(20),
	col2_pop smallint(3),
	col2_precip decimal(3,3),
	col2_hiderain smallint(1),
	col2_snowmin smallint(3),
	col2_snowmax smallint(3),
	col2_windmin smallint(3),
	col2_winmax smallint(3),
	col2_windgust smallint(3),
	col2_winddir varchar(20),
	col2_hidewind smallint(1),
	col2_details varchar(255),
	col3_title varchar(30),
	col3_icon varchar(400),
	col3_weather varchar(55),
	col3_temp smallint(3),
	col3_highlow varchar(20),
	col3_pop smallint(3),
	col3_precip decimal(3,3),
	col3_hiderain smallint(1),
	col3_snowmin smallint(3),
	col3_snowmax smallint(3),
	col3_windmin smallint(3),
	col3_winmax smallint(3),
	col3_windgust smallint(3),
	col3_winddir varchar(20),
	col3_hidewind smallint(1),
	col3_details varchar(255),
	col4_title varchar(30),
	col4_icon varchar(400),
	col4_weather varchar(55),
	col4_temp smallint(3),
	col4_highlow varchar(20),
	col4_pop smallint(3),
	col4_precip decimal(3,3),
	col4_hiderain smallint(1),
	col4_snowmin smallint(3),
	col4_snowmax smallint(3),
	col4_windmin smallint(3),
	col4_winmax smallint(3),
	col4_windgust smallint(3),
	col4_winddir varchar(20),
	col4_hidewind smallint(1),
	col4_details varchar(255),
	col5_title varchar(30),
	col5_icon varchar(400),
	col5_weather varchar(55),
	col5_temp smallint(3),
	col5_highlow varchar(20),
	col5_pop smallint(3),
	col5_precip decimal(3,3),
	col5_hiderain smallint(1),
	col5_snowmin smallint(3),
	col5_snowmax smallint(3),
	col5_windmin smallint(3),
	col5_winmax smallint(3),
	col5_windgust smallint(3),
	col5_winddir varchar(20),
	col5_hidewind smallint(1),
	col5_details varchar(255),
	col6_title varchar(30),
	col6_icon varchar(400),
	col6_weather varchar(55),
	col6_temp smallint(3),
	col6_highlow varchar(20),
	col6_pop smallint(3),
	col6_precip decimal(3,3),
	col6_hiderain smallint(1),
	col6_snowmin smallint(3),
	col6_snowmax smallint(3),
	col6_windmin smallint(3),
	col6_winmax smallint(3),
	col6_windgust smallint(3),
	col6_winddir varchar(20),
	col6_hidewind smallint(1),
	col6_details varchar(255),
	temp_unit varchar(11),
	precip_unit varchar(3),
	wind_unit varchar(4),
	colorize_temp varchar(4),
		UNIQUE KEY id (id)
	) $charset_collate;";
	
	$sql2 = "CREATE TABLE $table_name2 (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		type varchar(5) NOT NULL,
		verified varchar(5) NOT NULL,
    forecaster varchar(55) NOT NULL,
    station varchar(20),
    location varchar(55) NOT NULL,
		date varchar(55) NOT NULL,
		time varchar(55) NOT NULL,
	col1_date varchar(30),
	col1_time varchar(400),
	col1_weather varchar(55),
	col1_temp smallint(3),
	col1_highlow varchar(20),
	col1_pop smallint(3),
	col1_precip decimal(3,3),
	col1_snow smallint(3),
	col1_windmin smallint(3),
	col1_winmax smallint(3),
	col1_windgust smallint(3),
	col1_winddir varchar(20),
	col2_date varchar(30),
	col2_time varchar(400),
	col2_weather varchar(55),
	col2_temp smallint(3),
	col2_highlow varchar(20),
	col2_pop smallint(3),
	col2_precip decimal(3,3),
	col2_snow smallint(3),
	col2_windmin smallint(3),
	col2_winmax smallint(3),
	col2_windgust smallint(3),
	col2_winddir varchar(20),
	col3_date varchar(30),
	col3_time varchar(400),
	col3_weather varchar(55),
	col3_temp smallint(3),
	col3_highlow varchar(20),
	col3_pop smallint(3),
	col3_precip decimal(3,3),
	col3_snow smallint(3),
	col3_windmin smallint(3),
	col3_winmax smallint(3),
	col3_windgust smallint(3),
	col3_winddir varchar(20),
	col4_date varchar(30),
	col4_time varchar(400),
	col4_weather varchar(55),
	col4_temp smallint(3),
	col4_highlow varchar(20),
	col4_pop smallint(3),
	col4_precip decimal(3,3),
	col4_snow smallint(3),
	col4_windmin smallint(3),
	col4_winmax smallint(3),
	col4_windgust smallint(3),
	col4_winddir varchar(20),
	col5_date varchar(30),
	col5_time varchar(400),
	col5_weather varchar(55),
	col5_temp smallint(3),
	col5_highlow varchar(20),
	col5_pop smallint(3),
	col5_precip decimal(3,3),
	col5_snow smallint(3),
	col5_windmin smallint(3),
	col5_winmax smallint(3),
	col5_windgust smallint(3),
	col5_winddir varchar(20),
	col6_date varchar(30),
	col6_time varchar(400),
	col6_weather varchar(55),
	col6_temp smallint(3),
	col6_highlow varchar(20),
	col6_pop smallint(3),
	col6_precip decimal(3,3),
	col6_snow smallint(3),
	col6_windmin smallint(3),
	col6_winmax smallint(3),
	col6_windgust smallint(3),
	col6_winddir varchar(20),
	temp_unit varchar(11),
	precip_unit varchar(3),
	wind_unit varchar(4),
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	dbDelta( $sql2 );

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
	
			$welcome_forecaster2 = 'Austin';
	$welcome_station2 = 'KDXR';
	$welcome_location2 = '06776';
	$welcome_date = '2016-04-12';
	$welcome_time = '08:00';
		
	$table_name2 = $wpdb->prefix . '3dayobservations';
	
	$wpdb->insert( 
		$table_name2, 
		array( 
			'forecaster' => $welcome_forecaster2, 
			'station' => $welcome_station2,
			'location'=> $welcome_location2,
			'date' => $welcome_date,
			'time' => $welcome_time
		) 
	);

		ifxwx_install ();
		/*ifxwx_install_data ();*/
	}

function test_shortcode() {
	global $wpdb;
	
	$result = $wpdb->get_results( "SELECT * FROM wp_3dayforecasts ");

	ob_start();
echo "ID" . " Location" . "<br><br>";
	
foreach($result as $row) {

 echo $row->id . "  " . $row->location . "<br>";

 }
return ob_get_clean();
	
}

add_shortcode('listforecasts', 'test_shortcode');

register_activation_hook( __FILE__, 'ifxwx_install' );
register_activation_hook( __FILE__, 'ifxwx_install_data' );


add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'iFx Weather', 'iFx Weather', 'manage_options', 'ifxwx/options.php', 'myplguin_admin_page', 'dashicons-cloud', 6  );
}

