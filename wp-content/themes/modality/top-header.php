<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
?>
<div id="header-top">
	<div class="pagetop-inner clearfix">
		<div class="top-left left">
			<p class="no-margin"><?php echo esc_attr($modality_theme_options['header_address']); ?></p>
		</div>
		<div class="top-right right">
			<span class="top-phone"><i class="fa fa-phone"></i><?php echo esc_attr($modality_theme_options['header_phone']); ?></span>
			<span class="top-email"><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_attr($modality_theme_options['header_email']); ?>"><?php echo esc_attr($modality_theme_options['header_email']); ?></a></span>
		</div>
	</div>
</div>