<?php
/**
 * Modality theme functions and definitions
 *
 * Enabling support for WooCommerce
 *
 * @package Modality
 */

// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}
?>
<?php
global $woo_options;

/*-----------------------------------------------------------------------------------*/
/* This theme supports WooCommerce													 */
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'modality_woocommerce_support' );
function modality_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', 'modality_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'modality_theme_wrapper_end', 10);
 
/**
 * Load start of theme wrapper function	
*/
function modality_theme_wrapper_start() {
$modality_theme_options = modality_get_options( 'modality_theme_options' );
?>
	<div id="main" class="<?php echo $modality_theme_options['layout_settings'];?>">
		<div class="content-posts-wrap">
			<div class="woocommerce">
				<div id="content-box">
					<div id="post-body">
						<div class="post-single">
<?php }
 
/**
 * Load the end of theme wrapper function	
*/
function modality_theme_wrapper_end() { 
?>
						</div><!-- post-single -->
							<?php get_template_part('post','sidebar'); ?>
					</div><!-- post-body -->
				</div><!-- content-box -->
				<div class="sidebar-frame">
					<div class="sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- main -->
<?php }