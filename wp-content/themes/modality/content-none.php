<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
get_header(); ?>
	<div id="main" class="<?php echo esc_attr($modality_theme_options['layout_settings']);?>">
		<div class="content-posts-wrap">	
			<div id="content-box">
				<div id="post-body">
					<h1><?php _e('Nothing Found!', 'modality'); ?></h1>
					<div class="sorry"><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'modality'); ?></div>
					<br>
					<br>
				</div><!--post-body-->
			</div><!--content-box-->
			<div class="sidebar-frame">
				<div class="sidebar">
					<?php get_sidebar(); ?>
				</div><!--sidebar-->
			</div><!--sidebar-frame-->
		</div><!--content-posts-wrap-->
	</div><!--main-->
<?php if ($modality_theme_options['social_section_on'] == '1') {
	get_template_part( 'social', 'section' );	
}
get_footer(); ?>