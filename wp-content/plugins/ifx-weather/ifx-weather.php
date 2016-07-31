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
 * @since             2.0.0
 * @package           ifx-weather
 *
 * @wordpress-plugin
 * Plugin Name:       iFx Weather
 * Plugin URI:        http://www.ifxweather.com
 * Description:       Create your own weather forecast. Plugin stores all weather forecasts in a database to be recalled anytime, verified and scored for accuracy.
 * Version:           2.0.0
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
 * This action is documented in includes/class-ifx-weather-activator.php
 */
function activate_ifx_weather() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ifx-weather-activator.php';
	iFx_Weather_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ifx-weather-deactivator.php
 */
function deactivate_ifx_weather() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ifx-weather-deactivator.php';
	iFx_Weather_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ifx_weather' );
register_deactivation_hook( __FILE__, 'deactivate_ifx_weather' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ifx-weather.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ifx_weather() {

	$plugin = new iFx_Weather();
	$plugin->run();

}

function get_terms_dropdown($taxonomies, $args){
	$myterms = get_terms($taxonomies, $args);
	$output ="<select>";
	foreach($myterms as $term){
		$root_url = get_bloginfo('url');
		$term_taxonomy=$term->taxonomy;
		$term_slug=$term->slug;
		$term_name =$term->name;
		$link = $root_url.'/'.$term_taxonomy.'/'.$term_slug;
		$output .="<option value='".$link."'>".$term_name."</option>";
	}
	$output .="</select>";
return $output;
}

$taxonomies = array('forecast_types');
$args = array('orderby'=>'count','hide_empty'=>true);

// Register Custom Taxonomy
function forecast_type() {

	$labels = array(
		'name'                       => _x( 'Forecast Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Forecast Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Forecast Types', 'text_domain' ),
		'all_items'                  => __( 'All Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Forecast Type', 'text_domain' ),
		'add_new_item'               => __( 'Add New Forecast Type', 'text_domain' ),
		'edit_item'                  => __( 'Edit Type', 'text_domain' ),
		'update_item'                => __( 'Update Type', 'text_domain' ),
		'view_item'                  => __( 'View Type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove types', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used types', 'text_domain' ),
		'popular_items'              => __( 'Popular Forecast Types', 'text_domain' ),
		'search_items'               => __( 'Search Forecast Types', 'text_domain' ),
		'not_found'                  => __( 'Forecast Type Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Forecast Types', 'text_domain' ),
		'items_list'                 => __( 'Forecast Type List', 'text_domain' ),
		'items_list_navigation'      => __( 'Forecast Type list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'forecast_type', array( 'Forecast' ), $args );
	

}
add_action( 'init', 'forecast_type', 0 );

function insert_fx_categories() {
	wp_insert_term(
		'3 Day Forecast',
		'forecast_type',
		array(
		  'description'	=> 'A forecast duration of 72 hours.',
		  'slug' 		=> '3-day'
		)
	);
	
	wp_insert_term(
		'5 Day Forecast',
		'forecast_type',
		array(
		  'description'	=> 'A forecast duration of 120 hours.',
		  'slug' 		=> '5-day'
		)
	);
}

add_action( 'init', 'insert_fx_categories' );


// Register Custom Post Type
function forecast_post() {

	$labels = array(
		'name'                  => _x( 'Forecasts', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Forecast', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'iFx Weather', 'text_domain' ),
		'name_admin_bar'        => __( 'Forecast', 'text_domain' ),
		'archives'              => __( 'Forecast Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Forecast:', 'text_domain' ),
		'all_items'             => __( 'All Forecasts', 'text_domain' ),
		'add_new_item'          => __( 'Add New Forecast', 'text_domain' ),
		'add_new'               => __( 'Add New Forecast', 'text_domain' ),
		'new_item'              => __( 'New Forecast', 'text_domain' ),
		'edit_item'             => __( 'Edit Forecast', 'text_domain' ),
		'update_item'           => __( 'Update Forecast', 'text_domain' ),
		'view_item'             => __( 'View Forecast', 'text_domain' ),
		'search_items'          => __( 'Search Forecasts', 'text_domain' ),
		'not_found'             => __( 'No Forecasts Found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Forecast Feature Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set forecast featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove forecast featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as forecast featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into forecast', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this forecast', 'text_domain' ),
		'items_list'            => __( 'Forecasts list', 'text_domain' ),
		'items_list_navigation' => __( 'Forecasts list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter forecasts list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Forecast', 'text_domain' ),
		'description'           => __( 'Weather forecast', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'taxonomies'            => array( 'forecast_type', ),
		'hierarchical'          => false,
		'public'                => true,
		'menu_icon'             => 'dashicons-cloud',
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_submenu'       => 'ifxwx-add-fx.php',
		'menu_position'         => 6,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	
	register_post_type( 'forecast', $args );
	
}
add_action( 'init', 'forecast_post', 0 );



//Begin Day1 Meta Box
class Day1fx_Metabox {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes',        array( $this, 'add_metabox' )         );
		add_action( 'save_post',             array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		add_meta_box(
			'day1fx',
			__( 'Day 1 Forecast', 'text_domain' ),
			array( $this, 'render_metabox' ),
			'Forecast',
			'normal',
			'default'
		);

	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'day1fx_nonce_action', 'day1fx_nonce' );

		// Retrieve an existing value from the database.
		$day1fx_day1date_ = get_post_meta( $post->ID, 'day1fx_day1date_', true );
		$day1fx_day1fxhigh_ = get_post_meta( $post->ID, 'day1fx_day1fxhigh_', true );
		$day1fx_day1fxlow_ = get_post_meta( $post->ID, 'day1fx_day1fxlow_', true );
		$day1fx_day1wxdesc_ = get_post_meta( $post->ID, 'day1fx_day1wxdesc_', true );
		$day1fx_day1disc_ = get_post_meta( $post->ID, 'day1fx_day1disc_', true );

		// Set default values.
		if( empty( $day1fx_day1date_ ) ) $day1fx_day1date_ = '';
		if( empty( $day1fx_day1fxhigh_ ) ) $day1fx_day1fxhigh_ = '';
		if( empty( $day1fx_day1fxlow_ ) ) $day1fx_day1fxlow_ = '';
		if( empty( $day1fx_day1wxdesc_ ) ) $day1fx_day1wxdesc_ = '';
		if( empty( $day1fx_day1disc_ ) ) $day1fx_day1disc_ = '';

		// Form fields.
		echo '<table class="form-table">';

		echo '	<tr>';
		echo '		<th><label for="day1fx_day1date_" class="day1fx_day1date__label">' . __( 'Date', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="date" id="day1fx_day1date_" name="day1fx_day1date_" class="day1fx_day1date__field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $day1fx_day1date_ ) . '">';
		echo '			<p class="description">' . __( 'Date of the day 1 forecast.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="day1fx_day1fxhigh_" class="day1fx_day1fxhigh__label">' . __( 'High Temperature', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="number" id="day1fx_day1fxhigh_" name="day1fx_day1fxhigh_" class="day1fx_day1fxhigh__field" placeholder="' . esc_attr__( '72', 'text_domain' ) . '" value="' . esc_attr__( $day1fx_day1fxhigh_ ) . '">';
		echo '			<p class="description">' . __( 'High temperature for day 1.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="day1fx_day1fxlow_" class="day1fx_day1fxlow__label">' . __( 'Low Temperature', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="number" id="day1fx_day1fxlow_" name="day1fx_day1fxlow_" class="day1fx_day1fxlow__field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $day1fx_day1fxlow_ ) . '">';
		echo '			<p class="description">' . __( 'Low temperature for day 1.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="day1fx_day1wxdesc_" class="day1fx_day1wxdesc__label">' . __( 'Weather Description', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		get_terms_dropdown($taxonomies, $args);
		echo '			<p class="description">' . __( 'Description of the weather for day 1.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '	<tr>';
		echo '		<th><label for="day1fx_day1disc_" class="day1fx_day1disc__label">' . __( 'Discussion', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		wp_editor( $day1fx_day1disc_, 'day1fx_day1disc_', array( 'media_buttons' => true ) );
		echo '			<p class="description">' . __( 'Discussion about the forecast for day 1.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '</table>';

	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['day1fx_nonce'] ) ? $_POST['day1fx_nonce'] : '';
		$nonce_action = 'day1fx_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) )
			return;

		// Check if it's not a revision.
		if ( wp_is_post_revision( $post_id ) )
			return;

		// Sanitize user input.
		$day1fx_new_day1date_ = isset( $_POST[ 'day1fx_day1date_' ] ) ? sanitize_text_field( $_POST[ 'day1fx_day1date_' ] ) : '';
		$day1fx_new_day1fxhigh_ = isset( $_POST[ 'day1fx_day1fxhigh_' ] ) ? floatval( $_POST[ 'day1fx_day1fxhigh_' ] ) : '';
		$day1fx_new_day1fxlow_ = isset( $_POST[ 'day1fx_day1fxlow_' ] ) ? floatval( $_POST[ 'day1fx_day1fxlow_' ] ) : '';
		$day1fx_new_day1wxdesc_ = isset( $_POST[ 'day1fx_day1wxdesc_' ] ) ? sanitize_text_field( $_POST[ 'day1fx_day1wxdesc_' ] ) : '';
		$day1fx_new_day1disc_ = isset( $_POST[ 'day1fx_day1disc_' ] ) ? wp_kses_post( $_POST[ 'day1fx_day1disc_' ] ) : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'day1fx_day1date_', $day1fx_new_day1date_ );
		update_post_meta( $post_id, 'day1fx_day1fxhigh_', $day1fx_new_day1fxhigh_ );
		update_post_meta( $post_id, 'day1fx_day1fxlow_', $day1fx_new_day1fxlow_ );
		update_post_meta( $post_id, 'day1fx_day1wxdesc_', $day1fx_new_day1wxdesc_ );
		update_post_meta( $post_id, 'day1fx_day1disc_', $day1fx_new_day1disc_ );

	}

}

new Day1fx_Metabox;
//End Day1 Meta Box

//Adding Menu Options to parent iFx Weather menu
add_action('admin_menu', 'ifx_weather_submenu');

function ifx_weather_submenu()
{
	add_submenu_page( 'edit.php?post_type=forecast', 'Options', 'Options', 'manage_options', 'ifxwx_options', 'ifxwx_admin_options');
}




function ifxwx_admin_page(){
	?>
	<div class="wrap">
		<h2>iFx Weather Overview</h2>
	</div>
	<?php
}

function ifxwx_admin_view_fx(){
	?>
	<div class="wrap">
		<h2>View Forecasts</h2>
	</div>
	<?php
}

function ifxwx_admin_add_fx(){
	?>
	<div class="wrap">
		<h2>Add New Forecast</h2>
	</div>

	<?php
}

function ifxwx_admin_options(){
	?>
	<div class="wrap">
		<h2>iFx Weather Options</h2>
	</div>
	<?php
}

