<?php
/**
 * The Header of the theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Modality
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="grid-container">
	<div class="clear"></div>
		<?php $modality_theme_options = modality_get_options( 'modality_theme_options' );
		if ($modality_theme_options['header_top_enable'] == '1') {
			get_template_part( 'top', 'header' );
		} ?>
		<?php if (get_header_image()!='') { ?>
			<div id="header-holder" style="background: url(<?php echo esc_url(header_image()); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
		<?php } else { ?>
			<div id="header-holder">
		<?php } ?>
			<div id ="header-wrap">
      			<nav class="navbar navbar-default">
					<div id="logo">
						<?php if ( $modality_theme_options['logo'] != '' ) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ) ?>"><img src="<?php echo esc_url($modality_theme_options['logo']); ?>" alt="<?php echo esc_attr($modality_theme_options['logo_alt_text']); ?>"/></a>
							<?php if ($modality_theme_options['enable_logo_tagline'] == '1' ) { ?> 
								<h5 class="site-description"><?php echo esc_attr(bloginfo('description')); ?></h5>
							<?php } ?>
						<?php } else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ) ?>"><?php esc_attr(bloginfo( 'name' )); ?></a>
							<?php if ($modality_theme_options['enable_logo_tagline'] == '1' ) { ?> 
								<h5 class="site-description"><?php echo esc_attr(bloginfo('description')); ?></h5>
							<?php } ?>
						<?php } ?>
					</div>
        			<div class="navbar-header">
            			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              			<span class="sr-only">Toggle navigation</span>
              			<span class="icon-bar"></span>
              			<span class="icon-bar"></span>
              			<span class="icon-bar"></span>
            			</button>
          			</div><!--navbar-header-->
          			<div id="navbar" class="navbar-collapse collapse">
					<?php 
					if (has_nav_menu('main_navigation')) {
						
						$modality_default_menu = array(
    						'theme_location'  => 'main_navigation',
							'menu'       => 'main_navigation',
    						'depth'      => 0,
    						'container'  => false,
    						'menu_class' => 'nav navbar-nav',
                			'fallback_cb'       => 'wp_page_menu',
    						'walker'     => new wp_bootstrap_navwalker(),
						);
					
					} else {
						
						$modality_default_menu = array(
    						'theme_location'  => 'main_navigation',
							'menu'       => 'main_navigation',
    						'depth'      => 0,
    						'container'  => false,
    						'menu_class' => 'nav-bar',
                			'fallback_cb'       => 'wp_page_menu',
						);
						
					} 
					
					wp_nav_menu( $modality_default_menu );
					
					?>
					
          			</div><!--/.nav-collapse -->
        
      </nav>
			</div><!--header-wrap-->
		</div><!--header-holder-->