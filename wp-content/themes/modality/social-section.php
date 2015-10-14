<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$social_bg_image = $modality_theme_options['social_bg_image'];

if ($social_bg_image != '') { ?>
	<div class="social" style="background: url(<?php echo esc_url($social_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"> 
<?php } else { ?>
	<div class="social">
<?php } ?>
	<div id="social-wrap">
		<div id="social-bar">
			<?php if($modality_theme_options['facebook_link']): ?>
				<a href="<?php echo esc_url($modality_theme_options['facebook_link']); ?>" target="_blank" title="<?php _e('Facebook','modality'); ?>"><i class="fa fa-facebook-square"></i></a>
			<?php endif; ?>	
			<?php if($modality_theme_options['twitter_link']): ?>
				<a href="<?php echo esc_url($modality_theme_options['twitter_link']); ?>" target="_blank" title="<?php _e('Twitter','modality'); ?>"><i class="fa fa-twitter"></i></a>
			<?php endif; ?>	
			<?php if($modality_theme_options['google_link']): ?>
				<a href="<?php echo esc_url($modality_theme_options['google_link']); ?>" target="_blank" title="<?php _e('Google+','modality'); ?>"><i class="fa fa-google-plus"></i></a>
			<?php endif; ?>	
			<?php if($modality_theme_options['linkedin_link']): ?>
				<a href="<?php echo esc_url($modality_theme_options['linkedin_link']); ?>" target="_blank" title="<?php _e('LinkedIn','modality'); ?>"><i class="fa fa-linkedin"></i></a>
			<?php endif; ?>
			<?php if($modality_theme_options['instagram_link']): ?>
				<a href="<?php echo esc_url($modality_theme_options['instagram_link']); ?>" target="_blank" title="<?php _e('Instagram','modality'); ?>"><i class="fa fa-instagram"></i></a>
			<?php endif; ?>
			<?php if($modality_theme_options['vimeo_link']): ?>
				<a href="<?php echo esc_url($modality_theme_options['vimeo_link']); ?>" target="_blank" title="<?php _e('Vimeo','modality'); ?>"><i class="fa fa-vimeo-square"></i></a>
			<?php endif; ?>			
		</div>
	</div>
</div>