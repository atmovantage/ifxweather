<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Modality
 */ 
$modality_theme_options = modality_get_options( 'modality_theme_options' );?>
	<div class="clear"></div>
	<div id="footer">
	<?php if ( $modality_theme_options['footer_widgets'] == '1') { ?>
		<div id="footer-wrap">
			<?php  get_sidebar('footer'); ?>
		</div><!--footer-wrap-->
	<?php } ?>
	</div><!--footer-->
	<?php get_template_part( 'copyright' ); ?>
</div><!--grid-container-->
<?php wp_footer(); ?>
</body>
</html>