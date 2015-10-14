<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$getin_bg_image = $modality_theme_options['getin_bg_image'];

if ($getin_bg_image != '') { ?>
	<div class="get-in-touch" style="background: url(<?php echo esc_url($getin_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"> 
<?php } else { ?>
	<div class="get-in-touch">
<?php } ?>
	<div id="get-in-touch-wrap">
		<div>
			<h2 class="boxtitle wow bounceInLeft" data-wow-delay="0.1s"><?php echo esc_attr($modality_theme_options['getin_section_header']); ?></h2>
			<h4 class="sub-title wow bounceInRight" data-wow-delay="0.2s"><?php echo esc_attr($modality_theme_options['getin_section_text']); ?> </h4>
			<a href="<?php echo esc_url($modality_theme_options['getin_button_url']); ?>" class="git-link"><?php echo esc_attr($modality_theme_options['getin_button_text']); ?></a>
		</div>
	</div>
</div>