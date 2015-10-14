<?php
/**
 * Modality functions and definitions
 *
 * @package Modality
*/

function modality_customize_register($wp_customize){

	class WP_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	
		public function render_content() {
			?>
        	<label>
        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        	<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        	</label>
        	<?php	
		}
	}
	
	class WP_Customize_Info_Control extends WP_Customize_Control {
		public $type = 'info';
	
		public function render_content() {
			?>
				<strong> <?php _e('If you like my work. Buy me a coffee.','modality'); ?></strong>
                <div class="donate">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="VJP4U4NDG2P9Y">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				</div>
				<p class="btn">
					<a class="button button-primary" target="_blank" href="http://vpthemes.com/faq/"><?php _e('Theme Support','modality') ?></a><br><br>
					<a class="button button-primary" target="_blank" href="http://vpthemes.com/preview/Modality/"><?php _e('View Theme Demo','modality') ?></a><br><br>
					<a class="button button-primary" target="_blank" href="http://vpthemes.com/modality/#theme-pricing"><?php  _e('Upgrade to Pro','modality') ?></a>
				</p>
        	<?php	
		}
	}
    
	// Google Fonts
	$google_fonts = array(
		'Open Sans' => 'Open Sans',
		'Roboto'	=> 'Roboto',
	);
						
	// Opacity
	$opacity = array(
		'1' => '1',
		'0.9'	=> '0.9',
		'0.8'	=> '0.8',
		'0.7'	=> '0.7',
		'0.6'	=> '0.6',
		'0.5'	=> '0.5',
		'0.4'	=> '0.4',
		'0.3'	=> '0.3',
		'0.2'	=> '0.2',
		'0.1'	=> '0.1',
		'0'	=> '0',
	);
	
	// Sidebar Position
	$theme_layout = array('col1' => __('No Sidebars','modality'), 'col2-l' => __('Right Sidebar','modality'), 'col2-r' => __('Left Sidebar','modality'));
	
	// Blog Content
	$blog_content = array('excerpt' => __('Excerpt','modality'),'full' => __('Full Content','modality'));
	
	// Post Navigation Links Location
	$post_nav_array = array(
		'disable' => __('Disable', 'modality'),
		'sidebar' => __('Main Sidebar', 'modality'),
		'below' => __('Below Content', 'modality'),

	);
	
	// Post Info Location
	$post_info_array = array(
		'disable' => __('Disable', 'modality'),
		'above' => __('Above Content', 'modality'),

	);
	
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	//  =============================
    //  = Theme Options Panel       =
    //  =============================
	$wp_customize->add_panel( 'theme_options', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Modality Theme Options', 'modality' ),
	));
	
	//  =============================
    //  = Theme Info Section        =
    //  =============================					
	$wp_customize->add_section( 'Theme Settings', array(
    	'title'          => __( 'Theme Information', 'modality' ),
    	'priority'       => 999, 
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[theme_info]', array(
    	'default'        => '',
		'sanitize_callback' => 'modality_no_sanitize',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Info_Control($wp_customize, 'theme_info', array(
        'label'    => __('', 'modality'),
        'section'  => 'Theme Settings',
        'settings' => 'modality_theme_options[theme_info]',
    )));

	//  =============================
    //  = General Section           =
    //  =============================					
	$wp_customize->add_section( 'General Settings', array(
    	'title'          => __( 'Theme General Settings', 'modality' ),
    	'priority'       => 1000,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[theme_color]', array(
    	'default'        => '#3498db',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'theme_color', array(
        'label'    => __('Theme Color', 'modality'),
        'section'  => 'General Settings',
        'settings' => 'modality_theme_options[theme_color]',
    )));
	//===============================    
	$wp_customize->add_setting('modality_theme_options[breadcrumbs]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('breadcrumbs', array(
        'settings' => 'modality_theme_options[breadcrumbs]',
        'label'    => __('Display Breadcrumbs', 'modality'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[animation]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('animation', array(
        'settings' => 'modality_theme_options[animation]',
        'label'    => __('Enable Animation', 'modality'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[responsive_design]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('responsive_design', array(
        'settings' => 'modality_theme_options[responsive_design]',
        'label'    => __('Enable Resposive Design', 'modality'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[scrollup]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('scrollup', array(
        'settings' => 'modality_theme_options[scrollup]',
        'label'    => __('Enable Scrollup', 'modality'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[scrollup_color]', array(
    	'default'        => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'scrollup_color', array(
        'label'    => __('ScrollUp Color', 'modality'),
        'section'  => 'General Settings',
        'settings' => 'modality_theme_options[scrollup_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[scrollup_hover_color]', array(
    	'default'        => '#3498db',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'scrollup_hover_color', array(
        'label'    => __('ScrollUp Hover Color', 'modality'),
        'section'  => 'General Settings',
        'settings' => 'modality_theme_options[scrollup_hover_color]',
    )));

	//  =============================
    //  = Logo Section              =
    //  =============================

	$wp_customize->add_section( 'Logo Settings', array(
    	'title'          => __( 'Theme Logo Settings', 'modality' ),
    	'priority'       => 1001,
		'panel' => 'theme_options',
	) );
	//===============================    
    $wp_customize->add_setting( 'modality_theme_options[logo_width]', array(
        'default'        => '300',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_width', array(
        'label'      => __('Logo Width (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_width]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_height]', array(
        'default'        => '30',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_height', array(
        'label'      => __('Logo Height (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_height]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_top_margin]', array(
        'default'        => '8',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_top_margin', array(
        'label'      => __('Logo Top Margin (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_top_margin]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_left_margin]', array(
        'default'        => '0',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_left_margin', array(
        'label'      => __('Logo Left Margin (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_left_margin]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_bottom_margin]', array(
        'default'        => '0',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_bottom_margin', array(
        'label'      => __('Logo Bottom Margin (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_bottom_margin]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_right_margin]', array(
        'default'        => '25',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_right_margin', array(
        'label'      => __('Logo Right Margin (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_right_margin]',
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[logo]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label'    => __('Image Logo', 'modality'),
        'section'  => 'Logo Settings',
        'settings' => 'modality_theme_options[logo]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_alt_text]', array(
        'default'        => 'Logo',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_alt_text', array(
        'label'      => __('Logo ALT Text', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_alt_text]',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[logo_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('logo_uppercase', array(
        'settings' => 'modality_theme_options[logo_uppercase]',
        'label'    => __('Logo Uppercase', 'modality'),
        'section'  => 'Logo Settings',
        'type'     => 'checkbox',
    ));
	//===============================
     $wp_customize->add_setting('modality_theme_options[google_font_logo]', array(
		'sanitize_callback' => 'modality_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'Open Sans',
 
    ));

    $wp_customize->add_control( 'google_font_logo', array(
        'settings' => 'modality_theme_options[google_font_logo]',
        'label'   => __('Select logo font family','modality'),
        'section' => 'Logo Settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_font_size]', array(
        'default'        => '24',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_font_size', array(
        'label'      => __('Logo Font Size (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_font_size]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[logo_font_weight]', array(
        'default'        => '700',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_font_weight', array(
        'label'      => __('Logo Font Weight', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[logo_font_weight]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[text_logo_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_logo_color', array(
        'label'    => __('Logo Color', 'modality'),
        'section'  => 'Logo Settings',
        'settings' => 'modality_theme_options[text_logo_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[enable_logo_tagline]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('enable_logo_tagline', array(
        'settings' => 'modality_theme_options[enable_logo_tagline]',
        'label'    => __('Display Tagline Underneath Logo', 'modality'),
        'section'  => 'Logo Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[tagline_font_size]', array(
        'default'        => '16',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('tagline_font_size', array(
        'label'      => __('Tagline Font Size (px)', 'modality'),
        'section'    => 'Logo Settings',
        'settings'   => 'modality_theme_options[tagline_font_size]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[tagline_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'tagline_color', array(
        'label'    => __('Tagline Color', 'modality'),
        'section'  => 'Logo Settings',
        'settings' => 'modality_theme_options[tagline_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[tagline_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('tagline_uppercase', array(
        'settings' => 'modality_theme_options[tagline_uppercase]',
        'label'    => __('Tagline Uppercase', 'modality'),
        'section'  => 'Logo Settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Navigation Section        =
    //  =============================

	$wp_customize->add_section( 'Navigation Settings', array(
    	'title'          => __( 'Theme Navigation Settings', 'modality' ),
    	'priority'       => 1002,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting('modality_theme_options[menu_sticky]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('menu_sticky', array(
        'settings' => 'modality_theme_options[menu_sticky]',
        'label'    => __('Sticky Menu', 'modality'),
        'section'  => 'Navigation Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[menu_top_margin]', array(
        'default'        => '0',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('menu_top_margin', array(
        'label'      => __('Menu Top Margin (px)', 'modality'),
        'section'    => 'Navigation Settings',
        'settings'   => 'modality_theme_options[menu_top_margin]',
    ));
	//===============================
     $wp_customize->add_setting('modality_theme_options[google_font_menu]', array(
		'sanitize_callback' => 'modality_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'Open Sans',
 
    ));

    $wp_customize->add_control( 'google_font_menu', array(
        'settings' => 'modality_theme_options[google_font_menu]',
        'label'   => __('Select Menu Font Family','modality'),
        'section' => 'Navigation Settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[nav_font_size]', array(
        'default'        => '13',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('nav_font_size', array(
        'label'      => __('Menu Font Size (px)', 'modality'),
        'section'    => 'Navigation Settings',
        'settings'   => 'modality_theme_options[nav_font_size]',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[menu_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('menu_uppercase', array(
        'settings' => 'modality_theme_options[menu_uppercase]',
        'label'    => __('Menu Uppercase', 'modality'),
        'section'  => 'Navigation Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_font_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_font_color', array(
        'label'    => __('Navigation Menu Font Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_font_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_border_color]', array(
    	'default'        => '#c9c9c9',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_border_color', array(
        'label'    => __('Navigation Menu Border Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_border_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_bg_color]', array(
    	'default'        => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_color', array(
        'label'    => __('Navigation Menu Background Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_bg_sub_color]', array(
    	'default'        => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_sub_color', array(
        'label'    => __('SubMenu Background Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_bg_sub_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_hover_font_color]', array(
    	'default'        => '#3498db',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_hover_font_color', array(
        'label'    => __('Menu Hover Font Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_hover_font_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_bg_hover_color]', array(
    	'default'        => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_hover_color', array(
        'label'    => __('Menu Background Hover Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_bg_hover_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[nav_cur_item_color]', array(
    	'default'        => '#3498db',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_cur_item_color', array(
        'label'    => __('Selected Menu Color', 'modality'),
        'section'  => 'Navigation Settings',
        'settings' => 'modality_theme_options[nav_cur_item_color]',
    )));
	//  =============================
    //  = Typography Section        =
    //  =============================
	$wp_customize->add_section( 'Typography Settings', array(
    	'title'          => __( 'Theme Typography Settings', 'modality' ),
    	'priority'       => 1003,
		'panel' => 'theme_options',
	) );
	//===============================
     $wp_customize->add_setting('modality_theme_options[google_font_body]', array(
		'sanitize_callback' => 'modality_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'Open Sans',
 
    ));

    $wp_customize->add_control( 'google_font_body', array(
        'settings' => 'modality_theme_options[google_font_body]',
        'label'   => __('Select Body Font Family','modality'),
        'section' => 'Typography Settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[body_font_size]', array(
        'default'        => '15',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('body_font_size', array(
        'label'      => __('Body Font Size (px)', 'modality'),
        'section'    => 'Typography Settings',
        'settings'   => 'modality_theme_options[body_font_size]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[body_font_color]', array(
    	'default'        => '#777777',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_font_color', array(
        'label'    => __('Body Font Color', 'modality'),
        'section'  => 'Typography Settings',
        'settings' => 'modality_theme_options[body_font_color]',
    )));
	//  =============================
    //  = Header Section            =
    //  =============================
	$wp_customize->add_section( 'Header Settings', array(
    	'title'          => __( 'Theme Header Settings', 'modality' ),
    	'priority'       => 1004,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[header_bg_color]', array(
    	'default'        => '#1a1a1a',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label'    => __('Header Background Color', 'modality'),
        'section'  => 'Header Settings',
        'settings' => 'modality_theme_options[header_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[header_opacity]', array(
        'default'        => '1',
		'sanitize_callback' => 'modality_sanitize_opacity',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('header_opacity', array(
        'label'      => __('Header Background Color Opacity', 'modality'),
        'section'    => 'Header Settings',
        'settings'   => 'modality_theme_options[header_opacity]',
        'type'    => 'select',
        'choices'    => $opacity,
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[header_top_enable]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('header_top_enable', array(
        'settings' => 'modality_theme_options[header_top_enable]',
        'label'    => __('Display Top Header Section', 'modality'),
        'section'  => 'Header Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[header_address]', array(
        'default'        => '1234 Street Name, City Name, United States',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('header_address', array(
        'label'      => __('Address', 'modality'),
        'section'    => 'Header Settings',
        'settings'   => 'modality_theme_options[header_address]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[header_phone]', array(
        'default'        => '(123) 456-7890',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('header_phone', array(
        'label'      => __('Phone Number', 'modality'),
        'section'    => 'Header Settings',
        'settings'   => 'modality_theme_options[header_phone]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[header_email]', array(
        'default'        => 'info@yourdomain.com',
		'sanitize_callback' => 'modality_sanitize_email',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('header_email', array(
        'label'      => __('Email', 'modality'),
        'section'    => 'Header Settings',
        'settings'   => 'modality_theme_options[header_email]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[address_color]', array(
    	'default'        => '#cccccc',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'address_color', array(
        'label'    => __('Top Section Font Color', 'modality'),
        'section'  => 'Header Settings',
        'settings' => 'modality_theme_options[address_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[top_head_color]', array(
    	'default'        => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'top_head_color', array(
        'label'    => __('Top Section Color', 'modality'),
        'section'  => 'Header Settings',
        'settings' => 'modality_theme_options[top_head_color]',
    )));
	//  =============================
    //  = Home Page Section         =
    //  =============================
	$wp_customize->add_section( 'Home Settings', array(
    	'title'          => __( 'Theme Home Page Settings', 'modality' ),
    	'priority'       => 1005,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting('modality_theme_options[image_slider_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('image_slider_on', array(
        'settings' => 'modality_theme_options[image_slider_on]',
        'label'    => __('Enable Image Slider', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[getstarted_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('getstarted_section_on', array(
        'settings' => 'modality_theme_options[getstarted_section_on]',
        'label'    => __('Display Get Started Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[features_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('features_section_on', array(
        'settings' => 'modality_theme_options[features_section_on]',
        'label'    => __('Display Features Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[about_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('about_section_on', array(
        'settings' => 'modality_theme_options[about_section_on]',
        'label'    => __('Display About Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[services_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('services_section_on', array(
        'settings' => 'modality_theme_options[services_section_on]',
        'label'    => __('Display Services Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[cta_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('cta_section_on', array(
        'settings' => 'modality_theme_options[cta_section_on]',
        'label'    => __('Display Call To Action Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[content_boxes_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('content_boxes_section_on', array(
        'settings' => 'modality_theme_options[content_boxes_section_on]',
        'label'    => __('Display Content Boxes Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[getin_home_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('getin_home_on', array(
        'settings' => 'modality_theme_options[getin_home_on]',
        'label'    => __('Display Get In Touch Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[blog_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('blog_section_on', array(
        'settings' => 'modality_theme_options[blog_section_on]',
        'label'    => __('Display Latest News Section', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[latest_posts_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('latest_posts_on', array(
        'settings' => 'modality_theme_options[latest_posts_on]',
        'label'    => __('Display Blog Posts', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[social_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('social_section_on', array(
        'settings' => 'modality_theme_options[social_section_on]',
        'label'    => __('Display Social Links', 'modality'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Image Slider Section      =
    //  =============================
	$wp_customize->add_section( 'Slider Settings', array(
    	'title'          => __( 'Theme Image Slider Settings', 'modality' ),
    	'priority'       => 1006,
		'panel' => 'theme_options',
	) );
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[slider_height]', array(
        'default'        => '500',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('slider_height', array(
        'label'      => __('Image Slider Height (px)', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[slider_height]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[image_slider_cat]', array(
        'default'        => '',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('image_slider_cat', array(
        'label'      => __('Image Slider Category', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[image_slider_cat]',
        'type'    => 'select',
        'choices'    => $options_categories,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[slideshow_speed]', array(
        'default'        => '5000',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('slideshow_speed', array(
        'label'      => __('Slideshow Interval', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[slideshow_speed]',
		'description' => __('1000 = 1 second, default value: 5000', 'modality'),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[animation_speed]', array(
        'default'        => '800',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('animation_speed', array(
        'label'      => __('Animation Speed', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[animation_speed]',
		'description' => __('1000 = 1 second, default value: 800', 'modality'),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[slider_num]', array(
        'default'        => '3',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('slider_num', array(
        'label'      => __('Number of Slides', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[slider_num]',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[captions_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => true,
    ));
 
    $wp_customize->add_control('captions_on', array(
        'settings' => 'modality_theme_options[captions_on]',
        'label'    => __('Enable Slider Captions', 'modality'),
        'section'  => 'Slider Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[captions_pos_left]', array(
        'default'        => '0',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('captions_pos_left', array(
        'label'      => __('Caption Position Left %', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[captions_pos_left]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[captions_pos_top]', array(
        'default'        => '120',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('captions_pos_top', array(
        'label'      => __('Caption Position Top (px)', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[captions_pos_top]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[captions_width]', array(
        'default'        => '70',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('captions_width', array(
        'label'      => __('Caption Width %', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[captions_width]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[captions_title_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'captions_title_color', array(
        'label'    => __('Caption Title Color', 'modality'),
        'section'  => 'Slider Settings',
        'settings' => 'modality_theme_options[captions_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[captions_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'captions_text_color', array(
        'label'    => __('Captions Text Color', 'modality'),
        'section'  => 'Slider Settings',
        'settings' => 'modality_theme_options[captions_text_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[captions_button_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'captions_button_color', array(
        'label'    => __('Captions Button Color', 'modality'),
        'section'  => 'Slider Settings',
        'settings' => 'modality_theme_options[captions_button_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[captions_button]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('captions_button', array(
        'settings' => 'modality_theme_options[captions_button]',
        'label'    => __('Enable Captions Button', 'modality'),
        'section'  => 'Slider Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[caption_button_text]', array(
        'default'        => 'Read More',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('caption_button_text', array(
        'label'      => __('Captions Button Text', 'modality'),
        'section'    => 'Slider Settings',
        'settings'   => 'modality_theme_options[caption_button_text]',
    ));
	//  =============================
    //  = Footer Section            =
    //  =============================
	$wp_customize->add_section( 'Footer Settings', array(
    	'title'          => __( 'Theme Footer Settings', 'modality' ),
    	'priority'       => 1007,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_bg_color]', array(
    	'default'        => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
        'label'    => __('Footer Background Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[copyright_bg_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'copyright_bg_color', array(
        'label'    => __('Copyright Section Background Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[copyright_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_widget_title_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_title_color', array(
        'label'    => __('Footer Widget Title Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_widget_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_widget_title_border_color]', array(
    	'default'        => '#444444',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_title_border_color', array(
        'label'    => __('Footer Widget Title Border Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_widget_title_border_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_widget_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_text_color', array(
        'label'    => __('Footer Widget Text Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_widget_text_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_widget_text_border_color]', array(
    	'default'        => '#444444',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_text_border_color', array(
        'label'    => __('Footer Widget Text Border Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_widget_text_border_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[footer_social_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_social_color', array(
        'label'    => __('Footer Social Icons Color', 'modality'),
        'section'  => 'Footer Settings',
        'settings' => 'modality_theme_options[footer_social_color]',
    )));
	//===============================
	$wp_customize->add_setting('modality_theme_options[footer_widgets]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('footer_widgets', array(
        'settings' => 'modality_theme_options[footer_widgets]',
        'label'    => __('Enable Footer Widgets', 'modality'),
        'section'  => 'Footer Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[footer_copyright_text]', array(
        'default'        => 'Copyright '.date('Y').' '.get_bloginfo('site_title'),
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('footer_copyright_text', array(
        'label'      => __('Copyright Text', 'modality'),
        'section'    => 'Footer Settings',
        'settings'   => 'modality_theme_options[footer_copyright_text]',
    ));
	//  =============================
    //  = Layout Section            =
    //  =============================
	$wp_customize->add_section( 'Layout Settings', array(
    	'title'          => __( 'Theme Layout Settings', 'modality' ),
    	'priority'       => 1008,
		'panel' => 'theme_options',
	) );
	//===============================
     $wp_customize->add_setting('modality_theme_options[layout_settings]', array(
		'sanitize_callback' => 'modality_sanitize_theme_layout',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'col2-l',
 
    ));

    $wp_customize->add_control( 'layout_settings', array(
        'settings' => 'modality_theme_options[layout_settings]',
        'label'   => __('Theme Layout','modality'),
        'section' => 'Layout Settings',
        'type'    => 'radio',
        'choices'    => $theme_layout,
    ));
	//  =============================
    //  = Blog Section              =
    //  =============================
	$wp_customize->add_section( 'Blog Settings', array(
    	'title'          => __( 'Theme Blog Settings', 'modality' ),
    	'priority'       => 1009,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_posts_home_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_posts_home_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_home_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[blog_posts_home_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_posts_home_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_home_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_posts_top_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_posts_top_color', array(
        'label'    => __('Top Section Background Color', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_top_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_posts_top_font_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_posts_top_font_color', array(
        'label'    => __('Top Section Font Color', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_top_font_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[blog_posts_top_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_posts_top_image', array(
        'label'    => __('Top Section Image', 'modality'),
        'section'  => 'Blog Settings',
        'settings' => 'modality_theme_options[blog_posts_top_image]',
    )));

	//===============================
     $wp_customize->add_setting('modality_theme_options[blog_content]', array(
		'sanitize_callback' => 'modality_sanitize_blog_content',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'excerpt',
 
    ));

    $wp_customize->add_control( 'blog_content', array(
        'settings' => 'modality_theme_options[blog_content]',
        'label'   => __('Blog Content','modality'),
        'section' => 'Blog Settings',
        'type'    => 'radio',
        'choices'    => $blog_content,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_excerpt]', array(
        'default'        => '50',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('blog_excerpt', array(
        'label'      => __('Blog Excerpt Length', 'modality'),
        'section'    => 'Blog Settings',
        'settings'   => 'modality_theme_options[blog_excerpt]',
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[simple_paginaton]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('simple_paginaton', array(
        'settings' => 'modality_theme_options[simple_paginaton]',
        'label'    => __('Use Simple Pagination', 'modality'),
        'section'  => 'Blog Settings',
        'type'     => 'checkbox',
    ));
	//===============================
     $wp_customize->add_setting('modality_theme_options[post_navigation]', array(
		'sanitize_callback' => 'modality_sanitize_post_nav',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'sidebar',
 
    ));

    $wp_customize->add_control( 'post_navigation', array(
        'settings' => 'modality_theme_options[post_navigation]',
        'label'   => __('Post Navigation Links','modality'),
        'section' => 'Blog Settings',
        'type'    => 'radio',
        'choices'    => $post_nav_array,
    ));
	//===============================
     $wp_customize->add_setting('modality_theme_options[post_info]', array(
		'sanitize_callback' => 'modality_sanitize_post_info',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'above',
 
    ));

    $wp_customize->add_control( 'post_info', array(
        'settings' => 'modality_theme_options[post_info]',
        'label'   => __('Post Info Position','modality'),
        'section' => 'Blog Settings',
        'type'    => 'radio',
        'choices'    => $post_info_array,
    ));
	//===============================
	$wp_customize->add_setting('modality_theme_options[featured_img_post]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'modality_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('featured_img_post', array(
        'settings' => 'modality_theme_options[featured_img_post]',
        'label'    => __('Featured Image Inside the Post', 'modality'),
        'section'  => 'Blog Settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Get Started Section       =
    //  =============================
	$wp_customize->add_section( 'GetStarted Settings', array(
    	'title'          => __( 'Theme Get Started Section', 'modality' ),
    	'priority'       => 1010,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getst_bg_color]', array(
    	'default'        => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getst_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'GetStarted Settings',
        'settings' => 'modality_theme_options[getst_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getst_header_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getst_header_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'GetStarted Settings',
        'settings' => 'modality_theme_options[getst_header_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getst_section_header]', array(
        'default'        => 'Awesome Design & Clean Coding',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getst_section_header', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'GetStarted Settings',
        'settings'   => 'modality_theme_options[getst_section_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getst_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getst_text_color', array(
        'label'    => __('Subtitle Color', 'modality'),
        'section'  => 'GetStarted Settings',
        'settings' => 'modality_theme_options[getst_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getst_section_text]', array(
        'default'        => 'Are you ready?',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getst_section_text', array(
        'label'      => __('Subtitle Text', 'modality'),
        'section'    => 'GetStarted Settings',
        'settings'   => 'modality_theme_options[getst_section_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getst_button_text]', array(
        'default'        => 'Get Started',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getst_button_text', array(
        'label'      => __('Button Text', 'modality'),
        'section'    => 'GetStarted Settings',
        'settings'   => 'modality_theme_options[getst_button_text]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getst_button_color]', array(
    	'default'        => '#3498db',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getst_button_color', array(
        'label'    => __('Subtitle Color', 'modality'),
        'section'  => 'GetStarted Settings',
        'settings' => 'modality_theme_options[getst_button_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getst_button_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getst_button_url', array(
        'label'      => __('Button URL', 'modality'),
        'section'    => 'GetStarted Settings',
        'settings'   => 'modality_theme_options[getst_button_url]',
    ));
	//  =============================
    //  = Features Settings         =
    //  =============================
	$wp_customize->add_section( 'Features Settings', array(
    	'title'          => __( 'Theme Features Section', 'modality' ),
    	'priority'       => 1011,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[features_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'features_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[features_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[features_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'features_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[features_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[features_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'features_title_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[features_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[features_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'features_text_color', array(
        'label'    => __('Text Color', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[features_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[features_section_title]', array(
        'default'        => 'Clean Design & Great Functionality',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('features_section_title', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[features_section_title]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[features_section_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet pellentesque',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('features_section_desc', array(
        'label'      => __('Description Text', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[features_section_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_one]', array(
        'default'        => 'Responsive Design',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_one', array(
        'label'      => __('Feature #1 Title', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_one]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_one_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_one_desc', array(
        'label'      => __('Feature #1 Description', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_one_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_one_icon]', array(
        'default'        => 'fa-tablet',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_one_icon', array(
        'label'      => __('Feature #1 Icon', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_one_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[feature_one_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_one_image', array(
        'label'    => __('Feature #1 Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[feature_one_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_one_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_one_url', array(
        'label'      => __('Feature #1 URL', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_one_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_two]', array(
        'default'        => 'Unlimited Colors',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_two', array(
        'label'      => __('Feature #2 Title', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_two]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_two_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_two_desc', array(
        'label'      => __('Feature #2 Description', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_two_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_two_icon]', array(
        'default'        => 'fa-tint',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_two_icon', array(
        'label'      => __('Feature #2 Icon', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_two_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[feature_two_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_two_image', array(
        'label'    => __('Feature #2 Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[feature_two_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_two_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_two_url', array(
        'label'      => __('Feature #2 URL', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_two_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_three]', array(
        'default'        => 'Clean Code',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_three', array(
        'label'      => __('Feature #3 Title', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_three]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_three_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_three_desc', array(
        'label'      => __('Feature #3 Description', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_three_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_three_icon]', array(
        'default'        => 'fa-html5',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_three_icon', array(
        'label'      => __('Feature #3 Icon', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_three_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[feature_three_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_three_image', array(
        'label'    => __('Feature #3 Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[feature_three_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_three_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_three_url', array(
        'label'      => __('Feature #3 URL', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_three_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_four]', array(
        'default'        => 'eCommerce Ready',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_four', array(
        'label'      => __('Feature #4 Title', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_four]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_four_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_four_desc', array(
        'label'      => __('Feature #4 Description', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_four_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_four_icon]', array(
        'default'        => 'fa-shopping-cart',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_four_icon', array(
        'label'      => __('Feature #4 Icon', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_four_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting('modality_theme_options[feature_four_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_four_image', array(
        'label'    => __('Feature #4 Image', 'modality'),
        'section'  => 'Features Settings',
        'settings' => 'modality_theme_options[feature_four_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[feature_four_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_four_url', array(
        'label'      => __('Feature #4 URL', 'modality'),
        'section'    => 'Features Settings',
        'settings'   => 'modality_theme_options[feature_four_url]',
    ));
	//  =============================
    //  = About Us Settings         =
    //  =============================
	$wp_customize->add_section( 'About Settings', array(
    	'title'          => __( 'Theme About Us Section', 'modality' ),
    	'priority'       => 1012,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_bg_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'about_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'About Settings',
        'settings' => 'modality_theme_options[about_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[about_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'about_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'About Settings',
        'settings' => 'modality_theme_options[about_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_header_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'about_header_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'About Settings',
        'settings' => 'modality_theme_options[about_header_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[about_section_header]', array(
        'default'        => 'About Us',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('about_section_header', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[about_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'about_text_color', array(
        'label'    => __('Text Color', 'modality'),
        'section'  => 'About Settings',
        'settings' => 'modality_theme_options[about_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[about_section_text]', array(
        'default'        => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize,'about_section_text', array(
        'label'      => __('Section Text', 'modality'),
        'section'    => 'About Settings',
        'settings'   => 'modality_theme_options[about_section_text]',
    )));
	//  =============================
    //  = Our Services Settings     =
    //  =============================
	$wp_customize->add_section( 'Services Settings', array(
    	'title'          => __( 'Theme Services Section', 'modality' ),
    	'priority'       => 1013,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[services_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'services_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[services_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'services_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[services_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'services_title_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[services_text_color]', array(
    	'default'        => '#777777',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'services_text_color', array(
        'label'    => __('Section Text Color', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[services_section_title]', array(
        'default'        => 'Our Services',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('services_section_title', array(
        'label'      => __('Section Text', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[services_section_title]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[services_section_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis. Praesent gravida dignissim felis, id sagittis mauris rutrum non. Nullam pretium id sem ut hendrerit.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'services_section_desc', array(
        'label'      => __('Description Text', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[services_section_desc]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[services_image]', array(
        'default'           => get_template_directory_uri() . '/images/assets/tablet-313002_640.jpg',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'services_image', array(
        'label'    => __('Section Image', 'modality'),
        'section'  => 'Services Settings',
        'settings' => 'modality_theme_options[services_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_one]', array(
        'default'        => 'Easy to Use',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_one', array(
        'label'      => __('Service #1 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_one]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_one_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_one_desc', array(
        'label'      => __('Service #1 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_one_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_one_icon]', array(
        'default'        => 'fa-coffee',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_one_icon', array(
        'label'      => __('Service #1 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_one_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_two]', array(
        'default'        => 'Works Everywhere',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_two', array(
        'label'      => __('Service #2 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_two]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_two_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_two_desc', array(
        'label'      => __('Service #2 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_two_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_two_icon]', array(
        'default'        => 'fa-paper-plane',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_two_icon', array(
        'label'      => __('Service #2 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_two_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_three]', array(
        'default'        => 'Great Performance',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_three', array(
        'label'      => __('Service #3 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_three]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_three_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_three_desc', array(
        'label'      => __('Service #3 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_three_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_three_icon]', array(
        'default'        => 'fa-tachometer',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_three_icon', array(
        'label'      => __('Service #3 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_three_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_four]', array(
        'default'        => 'Clean Code',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_four', array(
        'label'      => __('Service #4 Title', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_four]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_four_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_four_desc', array(
        'label'      => __('Service #4 Description', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_four_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[service_four_icon]', array(
        'default'        => 'fa-code',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_four_icon', array(
        'label'      => __('Service #4 Icon', 'modality'),
        'section'    => 'Services Settings',
        'settings'   => 'modality_theme_options[service_four_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//  =============================
    //  = Call to Action Settings   =
    //  =============================
	$wp_customize->add_section( 'CTA Settings', array(
    	'title'          => __( 'Theme Call To Action Section', 'modality' ),
    	'priority'       => 1014,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[cta_bg_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cta_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'CTA Settings',
        'settings' => 'modality_theme_options[cta_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[cta_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'cta_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'CTA Settings',
        'settings' => 'modality_theme_options[cta_bg_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[cta_section_sm_header]', array(
        'default'        => 'Why work with us',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('cta_section_sm_header', array(
        'label'      => __('Small Header Text', 'modality'),
        'section'    => 'CTA Settings',
        'settings'   => 'modality_theme_options[cta_section_sm_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[cta_sm_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cta_sm_color', array(
        'label'    => __('Small Header Color', 'modality'),
        'section'  => 'CTA Settings',
        'settings' => 'modality_theme_options[cta_sm_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[cta_section_big_header]', array(
        'default'        => 'Creative People That Make Awesome Things',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('cta_section_big_header', array(
        'label'      => __('Big Header Text', 'modality'),
        'section'    => 'CTA Settings',
        'settings'   => 'modality_theme_options[cta_section_big_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[cta_big_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cta_big_color', array(
        'label'    => __('Big Header Color', 'modality'),
        'section'  => 'CTA Settings',
        'settings' => 'modality_theme_options[cta_big_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[cta_button_text]', array(
        'default'        => 'Get in touch',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('cta_button_text', array(
        'label'      => __('Button Text', 'modality'),
        'section'    => 'CTA Settings',
        'settings'   => 'modality_theme_options[cta_button_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[cta_button_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('cta_button_url', array(
        'label'      => __('Button URL', 'modality'),
        'section'    => 'CTA Settings',
        'settings'   => 'modality_theme_options[cta_button_url]',
    ));
	//  =============================
    //  = Content Boxes Settings    =
    //  =============================
	$wp_customize->add_section( 'CB Settings', array(
    	'title'          => __( 'Theme Content Boxes Section', 'modality' ),
    	'priority'       => 1015,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[cont_bg_color]', array(
    	'default'        => '#252525',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cont_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'CB Settings',
        'settings' => 'modality_theme_options[cont_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[cntbx_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'cntbx_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'CB Settings',
        'settings' => 'modality_theme_options[cntbx_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[cntbx_title_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cntbx_title_color', array(
        'label'    => __('Titles Color', 'modality'),
        'section'  => 'CB Settings',
        'settings' => 'modality_theme_options[cntbx_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[cont_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cont_text_color', array(
        'label'    => __('Text Color', 'modality'),
        'section'  => 'CB Settings',
        'settings' => 'modality_theme_options[cont_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[first_column_header]', array(
        'default'        => 'Responsive Design',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('first_column_header', array(
        'label'      => __('First Column Header', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[first_column_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[first_column_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control(new WP_Customize_Textarea_Control( $wp_customize, 'first_column_text', array(
        'label'      => __('First Column Text', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[first_column_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[first_column_image]', array(
        'default'        => 'fa-tablet',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('first_column_image', array(
        'label'      => __('First Column Image', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[first_column_image]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[first_column_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('first_column_url', array(
        'label'      => __('First Column URL', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[first_column_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[second_column_header]', array(
        'default'        => 'High Quality',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('second_column_header', array(
        'label'      => __('Second Column Header', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[second_column_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[second_column_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control(new WP_Customize_Textarea_Control( $wp_customize, 'second_column_text', array(
        'label'      => __('Second Column Text', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[second_column_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[second_column_image]', array(
        'default'        => 'fa-umbrella',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('second_column_image', array(
        'label'      => __('Second Column Image', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[second_column_image]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[second_column_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('second_column_url', array(
        'label'      => __('Second Column URL', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[second_column_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[third_column_header]', array(
        'default'        => 'Tons of Features',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('third_column_header', array(
        'label'      => __('Third Column Header', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[third_column_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[third_column_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control(new WP_Customize_Textarea_Control( $wp_customize, 'third_column_text', array(
        'label'      => __('Third Column Text', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[third_column_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[third_column_image]', array(
        'default'        => 'fa-cog',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('third_column_image', array(
        'label'      => __('Third Column Image', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[third_column_image]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'modality' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[third_column_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('third_column_url', array(
        'label'      => __('Third Column URL', 'modality'),
        'section'    => 'CB Settings',
        'settings'   => 'modality_theme_options[third_column_url]',
    ));
	//  =============================
    //  = Get In Touch Settings     =
    //  =============================
	$wp_customize->add_section( 'GIT Settings', array(
    	'title'          => __( 'Theme Get In Touch Section', 'modality' ),
    	'priority'       => 1016,
		'panel' => 'theme_options',
	));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getin_bg_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[getin_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'getin_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getin_header_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_header_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_header_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getin_section_header]', array(
        'default'        => 'Get In Touch with Us',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getin_section_header', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'GIT Settings',
        'settings'   => 'modality_theme_options[getin_section_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getin_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_text_color', array(
        'label'    => __('Subtitle Color', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getin_section_text]', array(
        'default'        => 'If you have any questions, do not hesitate to contact us',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getin_section_text', array(
        'label'      => __('Subtitle Text', 'modality'),
        'section'    => 'GIT Settings',
        'settings'   => 'modality_theme_options[getin_section_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getin_button_text]', array(
        'default'        => 'Contact us now',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getin_button_text', array(
        'label'      => __('Button Text', 'modality'),
        'section'    => 'GIT Settings',
        'settings'   => 'modality_theme_options[getin_button_text]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[getin_button_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_button_color', array(
        'label'    => __('Button Color', 'modality'),
        'section'  => 'GIT Settings',
        'settings' => 'modality_theme_options[getin_button_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[getin_button_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getin_button_url', array(
        'label'      => __('Button URL', 'modality'),
        'section'    => 'GIT Settings',
        'settings'   => 'modality_theme_options[getin_button_url]',
    ));
	//  =============================
    //  = Latest News Settings      =
    //  =============================
	$wp_customize->add_section( 'News Settings', array(
    	'title'          => __( 'Theme Latest News Section', 'modality' ),
    	'priority'       => 1017,
		'panel' => 'theme_options',
	));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_bg_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[blog_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_bg_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_cat]', array(
        'default'        => '',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('blog_cat', array(
        'label'      => __('Latest News Category', 'modality'),
        'section'    => 'News Settings',
        'settings'   => 'modality_theme_options[blog_cat]',
        'type'    => 'select',
        'choices'    => $options_categories,
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[num_posts]', array(
        'default'        => '3',
		'sanitize_callback' => 'modality_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('num_posts', array(
        'label'      => __('Number of Posts', 'modality'),
        'section'    => 'News Settings',
        'settings'   => 'modality_theme_options[num_posts]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[blog_section_title]', array(
        'default'        => 'Latest News',
		'sanitize_callback' => 'modality_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('blog_section_title', array(
        'label'      => __('Title Text', 'modality'),
        'section'    => 'News Settings',
        'settings'   => 'modality_theme_options[blog_section_title]',
    ));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_title_color', array(
        'label'    => __('Title Color', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_post_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_post_color', array(
        'label'    => __('Post Title Color', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_post_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[blog_meta_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_meta_color', array(
        'label'    => __('Post Meta Color', 'modality'),
        'section'  => 'News Settings',
        'settings' => 'modality_theme_options[blog_meta_color]',
    )));
	//  =============================
    //  = Social Settings           =
    //  =============================
	$wp_customize->add_section( 'Social Settings', array(
    	'title'          => __( 'Theme Social Links', 'modality' ),
    	'priority'       => 1018,
		'panel' => 'theme_options',
		'description' => __("Enter your profile URL. To remove it, just leave it blank","modality"),
	));
	//===============================
	$wp_customize->add_setting( 'modality_theme_options[social_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'social_color', array(
        'label'    => __('Background Color', 'modality'),
        'section'  => 'Social Settings',
        'settings' => 'modality_theme_options[social_color]',
    )));
	//===============================
    $wp_customize->add_setting('modality_theme_options[social_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'social_bg_image', array(
        'label'    => __('Background Image', 'modality'),
        'section'  => 'Social Settings',
        'settings' => 'modality_theme_options[social_bg_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[facebook_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('facebook_link', array(
        'label'      => __('Facebook', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[facebook_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[twitter_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('twitter_link', array(
        'label'      => __('Twitter', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[twitter_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[google_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('google_link', array(
        'label'      => __('Google Plus', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[google_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[linkedin_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('linkedin_link', array(
        'label'      => __('LinkedIn', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[linkedin_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[instagram_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('instagram_link', array(
        'label'      => __('Instagram', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[instagram_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'modality_theme_options[vimeo_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('vimeo_link', array(
        'label'      => __('Vimeo', 'modality'),
        'section'    => 'Social Settings',
        'settings'   => 'modality_theme_options[vimeo_link]',
    ));

}
 
add_action('customize_register', 'modality_customize_register');


/**
 * Sets up theme custom styling
 * 
 */
function modality_theme_custom_styling() {
	$modality_theme_options = modality_get_options( 'modality_theme_options' );
	/**
	 * General Settings 
	 */	
	$theme_color = $modality_theme_options['theme_color'];
	$scrollup_color = $modality_theme_options['scrollup_color'];
	$scrollup_hover_color = $modality_theme_options['scrollup_hover_color'];
	/**
	 * Logo Settings 
	 */		
	$logo_width = $modality_theme_options['logo_width'];
	$logo_height = $modality_theme_options['logo_height'];
	$logo_top_margin = $modality_theme_options['logo_top_margin'];
	$logo_left_margin = $modality_theme_options['logo_left_margin'];
	$logo_bottom_margin = $modality_theme_options['logo_bottom_margin'];
	$logo_right_margin = $modality_theme_options['logo_right_margin'];
	$logo_uppercase = $modality_theme_options['logo_uppercase'];
	$google_font_logo = $modality_theme_options['google_font_logo'];
	$logo_font_size = $modality_theme_options['logo_font_size'];
	$logo_font_weight = $modality_theme_options['logo_font_weight'];
	$text_logo_color = $modality_theme_options['text_logo_color'];
	$tagline_font_size = $modality_theme_options['tagline_font_size'];
	$tagline_color = $modality_theme_options['tagline_color'];
	$tagline_uppercase = $modality_theme_options['tagline_uppercase'];
	/**
	 * Navigation Settings
	 */	
	$menu_sticky = $modality_theme_options['menu_sticky'];
	$menu_top_margin = $modality_theme_options['menu_top_margin'];
	$google_font_menu = $modality_theme_options['google_font_menu'];
	$nav_font_size = $modality_theme_options['nav_font_size'];
	$menu_uppercase = $modality_theme_options['menu_uppercase'];
	$nav_font_color = $modality_theme_options['nav_font_color'];
	$nav_border_color = $modality_theme_options['nav_border_color'];
	$nav_bg_color = $modality_theme_options['nav_bg_color'];
	$nav_bg_sub_color = $modality_theme_options['nav_bg_sub_color'];
	$nav_hover_font_color = $modality_theme_options['nav_hover_font_color'];
	$nav_bg_hover_color = $modality_theme_options['nav_bg_hover_color'];
	$nav_cur_item_color = $modality_theme_options['nav_cur_item_color'];
	/**
	 * Typography Settings
	 */	
	$google_font_body = $modality_theme_options['google_font_body'];
	$body_font_size = $modality_theme_options['body_font_size'];
	$body_font_color = $modality_theme_options['body_font_color'];
	/**
	 * Header Settings
	 */	
	$header_bg_color = $modality_theme_options['header_bg_color'];
	$header_opacity = $modality_theme_options['header_opacity'];
	$address_color = $modality_theme_options['address_color'];
	$top_head_color = $modality_theme_options['top_head_color'];
	/**
	 * Image Slider 
	 */	
	$slider_height = $modality_theme_options['slider_height'];
	$captions_pos_left = $modality_theme_options['captions_pos_left'];
	$captions_pos_top = $modality_theme_options['captions_pos_top'];
	$captions_width = $modality_theme_options['captions_width'];
	$captions_title_color = $modality_theme_options['captions_title_color'];
	$captions_text_color = $modality_theme_options['captions_text_color'];
	$captions_button_color = $modality_theme_options['captions_button_color'];
	/**
	 * Footer Settings
	 */
	$footer_bg_color = $modality_theme_options['footer_bg_color'];
	$copyright_bg_color = $modality_theme_options['copyright_bg_color'];
	$footer_widget_title_color = $modality_theme_options['footer_widget_title_color'];
	$footer_widget_title_border_color = $modality_theme_options['footer_widget_title_border_color'];
	$footer_widget_text_color = $modality_theme_options['footer_widget_text_color'];
	$footer_widget_text_border_color = $modality_theme_options['footer_widget_text_border_color'];
	$footer_social_color = $modality_theme_options['footer_social_color'];
	/**
	 * Blog Settings
	 */	
	$blog_posts_home_color = $modality_theme_options['blog_posts_home_color'];
	$blog_bg_color = $modality_theme_options['blog_bg_color'];
	$blog_title_color = $modality_theme_options['blog_title_color'];
	$blog_post_color = $modality_theme_options['blog_post_color'];
	$blog_meta_color = $modality_theme_options['blog_meta_color'];
	$blog_posts_top_color = $modality_theme_options['blog_posts_top_color'];
	$blog_posts_top_font_color = $modality_theme_options['blog_posts_top_font_color'];
	/**
	* Get Started Section
	*/
	$getst_bg_color = $modality_theme_options['getst_bg_color'];
	$getst_header_color = $modality_theme_options['getst_header_color'];
	$getst_text_color = $modality_theme_options['getst_text_color'];
	$getst_button_color = $modality_theme_options['getst_button_color'];
	/**
	* Features Section
	*/
	$features_bg_color = $modality_theme_options['features_bg_color'];
	$features_text_color = $modality_theme_options['features_text_color'];
	$features_title_color = $modality_theme_options['features_title_color'];
	/**
	* About Section
	*/
	$about_text_color = $modality_theme_options['about_text_color'];
	$about_bg_color = $modality_theme_options['about_bg_color'];
	$about_header_color = $modality_theme_options['about_header_color'];
	/**
	* Our Services Section
	*/
	$services_bg_color = $modality_theme_options['services_bg_color'];
	$services_title_color = $modality_theme_options['services_title_color'];
	$services_text_color = $modality_theme_options['services_text_color'];
	/**
	* Call To Action Section
	*/
	$cta_bg_color = $modality_theme_options['cta_bg_color'];
	$cta_sm_color = $modality_theme_options['cta_sm_color'];
	$cta_big_color = $modality_theme_options['cta_big_color'];
	/**
	* Content Boxes Section
	*/
	$cont_text_color = $modality_theme_options['cont_text_color'];
	$cont_bg_color = $modality_theme_options['cont_bg_color'];
	$cntbx_title_color = $modality_theme_options['cntbx_title_color'];
	/**
	* Get in Touch Section
	*/
	$getin_header_color = $modality_theme_options['getin_header_color'];
	$getin_text_color = $modality_theme_options['getin_text_color'];
	$getin_button_color = $modality_theme_options['getin_button_color'];
	$getin_bg_color = $modality_theme_options['getin_bg_color'];
	/**
	* Social Section
	*/
	$social_color = $modality_theme_options['social_color'];
	
	$output = '';

	/**
	 * General Settings 
	 */
	if ( $theme_color )
	$output .= 'blockquote, address, .page-links a:hover, .post-format-wrap {border-color:' . $theme_color . '}' . "\n";
	$output .= '.meta span i, .more-link, .post-title h3:hover, #main .standard-posts-wrapper .posts-wrapper .post-single .text-holder-full .post-format-wrap p.link-text a:hover, .breadcrumbs .breadcrumbs-wrap ul li a:hover, #article p a, .navigation a, .link-post i.fa, .quote-post i.fa, #article .link-post p.link-text a:hover, .link-post p.link-text a:hover, .quote-post span.quote-author, .post-single ul.link-pages li a strong, .post-info span i, .footer-widget-col ul li a:hover, .sidebar ul.link-pages li.next-link a span, .sidebar ul.link-pages li.previous-link a span, .sidebar ul.link-pages li i, .row .row-item .service i.fa {color:' . $theme_color . '}' . "\n";
	$output .= 'input[type="submit"],button, .page-links a:hover {background:' . $theme_color . '}' . "\n";
	$output .= '.search-submit,.wpcf7-form-control,.main-navigation ul ul, .content-boxes .circle, .feature .circle, .section-title-right:after, .boxtitle:after, .section-title:after, .content-btn, #comments .form-submit #submit {background-color:' . $theme_color . '}' . "\n";
	
	if ( $scrollup_color )
	$output .= '.back-to-top {color:' . $scrollup_color . '}' . "\n";
	
	if ( $scrollup_hover_color )
	$output .= '.back-to-top i.fa:hover {color:' . $scrollup_hover_color . '}' . "\n";

	/**
	 * Logo Settings 
	 */	
	if ( $logo_width )
	$output .= '#logo {width:' . $logo_width . 'px }' . "\n";
	
	if ( $logo_height )
	$output .= '#logo {height:' . $logo_height . 'px }' . "\n";
	
	if ( $logo_top_margin )
	$output .= '#logo { margin-top:' . $logo_top_margin . 'px }' . "\n";
	
	if ( $logo_left_margin )
	$output .= '#logo { margin-left:' . $logo_left_margin . 'px }' . "\n";
	
	if ( $logo_bottom_margin )
	$output .= '#logo { margin-bottom:' . $logo_bottom_margin . 'px }' . "\n";
	
	if ( $logo_right_margin )
	$output .= '#logo { margin-right:' . $logo_right_margin . 'px }' . "\n";
	
	if ( $logo_uppercase == '1' )
	$output .= '#logo {text-transform: uppercase }' . "\n";
	
	if ( $google_font_logo )
	$output .= '#logo {font-family:' . $google_font_logo . '}' . "\n";
	
	if ( $logo_font_size )
	$output .= '#logo {font-size:' . $logo_font_size . 'px }' . "\n";
	
	if ( $logo_font_weight )
	$output .= '#logo {font-weight:' . $logo_font_weight . '}' . "\n";

	if ( $text_logo_color )
	$output .= '#logo a {color:' . $text_logo_color . '}' . "\n";
	
	if ( $tagline_font_size )
	$output .= '#logo h5.site-description {font-size:' . $tagline_font_size . 'px }' . "\n";
	
	if ( $tagline_color )
	$output .= '#logo .site-description {color:' . $tagline_color . '}' . "\n";
	
	if ( $tagline_uppercase == '0' )
	$output .= '#logo .site-description {text-transform: none}' . "\n";

	if ( $tagline_uppercase == '1' )
	$output .= '#logo .site-description {text-transform: uppercase}' . "\n";

	/**
	 * Navigation Settings
	 */	
	if ( $menu_top_margin )
	$output .= '#navbar {margin-top:'. $menu_top_margin .'px}' . "\n";
	
	if ( $google_font_menu )
	$output .= '#navbar ul li a {font-family:' . $google_font_menu . '}' . "\n";
	
	if ( $nav_font_size )
	$output .= '#navbar ul li a {font-size:' . $nav_font_size . 'px}' . "\n";
	
	if ( $menu_uppercase == '1' )
	$output .= '#navbar ul li a {text-transform: uppercase;}' . "\n";
	
	if ( $nav_font_color )
	$output .= '.navbar-nav li a {color:' . $nav_font_color . '}' . "\n";
	
	if ( $nav_border_color )
	$output .= '.dropdown-menu {border-bottom: 5px solid ' . $nav_border_color . '}' . "\n";
	
	if ( $nav_bg_color )
	$output .= '.navbar-nav {background-color:' . $nav_bg_color . '}' . "\n";
	
	if ( $nav_bg_sub_color )
	$output .= '.dropdown-menu { background:'.$nav_bg_sub_color . '}' . "\n";
	
	if ( $nav_hover_font_color )
	$output .= '.navbar-nav li a:hover {color:' . $nav_hover_font_color . '}' . "\n";
	
	if ( $nav_bg_hover_color )
	$output .= '.navbar-nav ul li a:hover, .navbar-nav ul li a:focus, .navbar-nav ul li a.active, .navbar-nav ul li a.active-parent, .navbar-nav ul li.current_page_item a, #menu-navmenu li a:hover { background:' . $nav_bg_hover_color . '}' . "\n";
	
	if ( $nav_cur_item_color )
	$output .= '.active a { color:' . $nav_cur_item_color . ' !important}' . "\n";
	/**
	 * Typography Settings
	 */	
	if ( $google_font_body != 'None' )
	$output .= 'body {font-family:' . $google_font_body . '}' . "\n";
	
	if ( $body_font_size )
	$output .= 'body {font-size:' . $body_font_size . 'px !important}' . "\n";
	
	if ( $body_font_color )
	$output .= 'body {color:' . $body_font_color . '}' . "\n";
	/**
	 * Header Settings
	 */
	if ( $header_bg_color )
	$output .= '#header-holder { background-color: ' . $header_bg_color . '}' . "\n";
	
	if ( $header_opacity )
	$output .= '#header-holder {opacity:'. $header_opacity .'}' . "\n";
	
	if ( $address_color )
	$output .= '#header-top .top-phone,#header-top p, #header-top a, #header-top i { color:' . $address_color . '}' . "\n";
	
	if ( $top_head_color )
	$output .= '#header-top { background-color: ' . $top_head_color . '}' . "\n";
	/**
	 * Image Slider 
	 */	
	if ( $slider_height )
	$output .= '.banner ul li { height:' . $slider_height . 'px;}' . "\n";

	if ( $captions_title_color )
	$output .= '.banner .inner h1 { color:' . $captions_title_color . '}' . "\n";
	
	if ( $captions_text_color )
	$output .= '.banner .inner p { color: ' . $captions_text_color . '}' . "\n";
	
	if ( $captions_button_color )
	$output .= '.banner .btn { color: ' . $captions_button_color . '}' . "\n";
	$output .= '.banner .btn { border-color: ' . $captions_button_color . '}' . "\n";	
	
	if ( $captions_pos_left )
	$output .= '.banner .inner { padding-left: ' . $captions_pos_left . '%}' . "\n";
	
	if ( $captions_pos_top )
	$output .= '.banner .inner { padding-top: ' . $captions_pos_top . 'px}' . "\n";
	
	if ( $captions_width )
	$output .= '.banner .inner { width: ' . $captions_width . '%}' . "\n";
	/**
	 * Footer Settings
	 */
	if ( $footer_bg_color )
	$output .= '#footer { background-color:' . $footer_bg_color . '}' . "\n";

	if ( $copyright_bg_color )
	$output .= '#copyright { background-color:' . $copyright_bg_color . '}' . "\n";
	
	if ( $footer_widget_title_color )
	$output .= '.footer-widget-col h4 { color:' . $footer_widget_title_color . '}' . "\n";
	
	if ( $footer_widget_title_border_color )
	$output .= '.footer-widget-col h4 { border-bottom: 4px solid ' . $footer_widget_title_border_color . '}' . "\n";
	
	if ( $footer_widget_text_color )
	$output .= '.footer-widget-col a, .footer-widget-col { color:' . $footer_widget_text_color . '}' . "\n";

	if ( $footer_widget_text_border_color )
	$output .= '.footer-widget-col ul li { border-bottom: 1px solid ' . $footer_widget_text_border_color . '}' . "\n";
	
	if ( $footer_social_color )
	$output .= '#social-bar-footer ul li a i { color:' . $footer_social_color . '}' . "\n";
	/**
	 * Blog Settings 
	 */
	if ($blog_posts_home_color)
	$output .= '.home-blog {background: none repeat scroll 0 0 ' . $blog_posts_home_color . '}' . "\n";
	
	if ($blog_meta_color)
	$output .= '.from-blog .post-info span a, .from-blog .post-info span {color:' . $blog_meta_color . ';}' . "\n";

	if ($blog_post_color)
	$output .= '.from-blog h3 {color:' . $blog_post_color . ';}' . "\n";
	
	if ($blog_title_color)
	$output .= '.from-blog h2 {color:' . $blog_title_color . ';}' . "\n";
	
	if ($blog_bg_color)
	$output .= '.from-blog {background: none repeat scroll 0 0 ' . $blog_bg_color . ';}' . "\n";
	
	if ($blog_posts_top_color)
	$output .= '.blog-top-image {background: none repeat scroll 0 0 ' . $blog_posts_top_color . ';}' . "\n";
	
	if ($blog_posts_top_font_color)
	$output .= '.blog-top-image h1.section-title, .blog-top-image h1.section-title-right {color:' . $blog_posts_top_font_color . ';}' . "\n";
	/**
	* Get Started Section
	*/

	if ($getst_button_color)
	$output .= '.get-strated-button { background-color: ' . $getst_button_color . '}' . "\n";
	
	if ($getst_header_color)
	$output .= '#get-started h2 { color: ' . $getst_header_color . '}' . "\n";
	
	if ($getst_text_color)
	$output .= '.get-strated-left span { color: ' . $getst_text_color . '}' . "\n";
	
	if ($getst_bg_color)
	$output .= '#get-started { background: none repeat scroll 0 0 ' . $getst_bg_color . '}' . "\n";
	/**
	* Features Section
	*/
	if ( $features_bg_color )
	$output .= '#features { background-color:' . $features_bg_color . ';}' . "\n";
	
	if ( $features_text_color )
	$output .= 'h4.sub-title, #features p { color:' . $features_text_color . ';}' . "\n";
	
	if ( $features_title_color )
	$output .= '#features .section-title, #features h3 { color:' . $features_title_color . ';}' . "\n";
	/**
	* About Section
	*/
	if ($about_text_color)
	$output .= '.about p {color:' . $about_text_color . ';}' . "\n";
	
	if ($about_header_color)
	$output .= '.about h2 {color:' . $about_header_color . ';}' . "\n";
	
	if ($about_bg_color)
	$output .= '.about {background: none repeat scroll 0 0 ' . $about_bg_color . ';}' . "\n";
	/**
	* Our Services Section
	*/
	if ( $services_bg_color )
	$output .= '#services { background-color:' . $services_bg_color . ';}' . "\n";
	
	if ( $services_title_color )
	$output .= '#services h2, #services h3 { color:' . $services_title_color . ';}' . "\n";
	
	if ( $services_text_color )
	$output .= '#services p { color:' . $services_text_color . ';}' . "\n";
	/**
	* Call To Action Section
	*/
	if ( $cta_big_color )
	$output .= '.cta h2 { color:' . $cta_big_color . ';}' . "\n";
	
	if ( $cta_sm_color )
	$output .= '.cta h4 { color:' . $cta_sm_color . ';}' . "\n";
	
	if ( $cta_bg_color )
	$output .= '.cta { background-color:' . $cta_bg_color . ';}' . "\n";
	/**
	* Content Boxes Section
	*/
	if ( $cntbx_title_color )
	$output .= '.content-boxes h4 { color:' . $cntbx_title_color . ';}' . "\n";

	if ($cont_text_color)
	$output .= '.content-boxes {color:' . $cont_text_color. '}' . "\n";
	
	if ($cont_bg_color)
	$output .= '.content-boxes {background: none repeat scroll 0 0 ' . $cont_bg_color . '}' . "\n";
	/**
	* Get in Touch Section
	*/
	if ($getin_bg_color)
	$output .= '.get-in-touch { background-color: ' . $getin_bg_color . '}' . "\n";
	
	if ($getin_header_color)
	$output .= '.get-in-touch h2.boxtitle {color:' . $getin_header_color . ';}' . "\n";
	
	if ($getin_text_color)
	$output .= '.get-in-touch h4.sub-title {color:' . $getin_text_color . ';}' . "\n";
	
	if ( $getin_button_color )
	$output .= '.git-link { color: ' . $getin_button_color . '}' . "\n";
	$output .= '.git-link { border-color: ' . $getin_button_color . '}' . "\n";
	/**
	* Social Section
	*/
	if ( $social_color )
	$output .= '.social { background-color: ' . $social_color . '}' . "\n";
			
	// Output styles
	if ( isset( $output ) && $output != '' ) {
		$output = strip_tags( $output );
		$output = "<!--Custom Styling-->\n<style media=\"screen\" type=\"text/css\">\n" . esc_html($output) . "</style>\n";
		echo $output;
	}
}
add_action('wp_head','modality_theme_custom_styling');

/**
 * Sanitization for checkbox input
 *
 * @param $input string (1 or empty) checkbox state
 * @return $output '1' or false
 */
function modality_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}

/**
 * Sanitization for font style
 */
function modality_sanitize_font_style( $value ) {
	$recognized = modality_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_font_style', current( $recognized ) );
}

/**
 * Sanitization for opacity value
 */
function modality_sanitize_opacity( $value ) {
	$recognized = modality_opacity();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_opacity', current( $recognized ) );
}

/**
 * Sanitization for layout value
 */
function modality_sanitize_theme_layout( $value ) {
	$recognized = modality_layout();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_layout', current( $recognized ) );
}

/**
 * Sanitization for navigation position
 */
function modality_sanitize_post_nav( $value ) {
	$recognized = modality_post_nav();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_post_nav', current( $recognized ) );
}

/**
 * Sanitization for post info position
 */
function modality_sanitize_post_info( $value ) {
	$recognized = modality_post_info();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_post_info', current( $recognized ) );
}

/**
 * Sanitization for blog content value
 */
function modality_sanitize_blog_content( $value ) {
	$recognized = modality_blog_content();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'modality_blog_content', current( $recognized ) );
}

function modality_sanitize_cat ( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option ) ) {
		$output = $input;
	}
	return $output;
}

/**
 * Sanitization callback function
 */
function modality_sanitize_cb( $input ) {     
	return wp_kses_post( $input );
}

/**
 * Sanitization to validate that the input value is an integer
 */
function modality_sanitize_number( $input ) {
	return absint( $input );
}

/**
 * Sanitization for image position
*/
function modality_sanitize_image_pos( $input ) {
	$valid = array(
       'left' => 'left',
        'right' => 'right',
        'center' => 'center',
	);
	
	if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function modality_sanitize_image_repeat( $input ) {
	$valid = array(
		'no-repeat' => 'no-repeat',
		'repeat' => 'repeat',
		'repeat-x' => 'repeat-x',
		'repeat-y' => 'repeat-y',
	);
	
	if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function modality_sanitize_email( $email ) {
	if(is_email( $email )){
		return $email;
	}else{
		return '';
	}
} 

/**
 * Function for options that do not require sanitization.
 */
function modality_no_sanitize( $input ) {
} 

function modality_font_styles() {
	$default = array(
		'Open Sans' => 'Open Sans',
		'Roboto'	=> 'Roboto',
		);
	return apply_filters( 'modality_font_styles', $default );
}

function modality_opacity() {
	$default = array(
		'1' => '1',
		'0.9'	=> '0.9',
		'0.8'	=> '0.8',
		'0.7'	=> '0.7',
		'0.6'	=> '0.6',
		'0.5'	=> '0.5',
		'0.4'	=> '0.4',
		'0.3'	=> '0.3',
		'0.2'	=> '0.2',
		'0.1'	=> '0.1',
		'0'	=> '0',
	);
	return apply_filters( 'modality_opacity', $default );
}

function modality_layout() {
	$default = array(
	'col1' => 'col1', 
	'col2-l' => 'col2-l', 
	'col2-r' =>'col2-r',
	);
	return apply_filters( 'modality_layout', $default );
}

function modality_blog_content() {
	$default = array(
	'excerpt' => 'excerpt', 
	'full' => 'full', 
	);
	return apply_filters( 'modality_blog_content', $default );
}

function modality_post_nav() {
	$default = array(
		'disable' => 'disable',
		'sidebar' => 'sidebar',
		'below' => 'below',
	);
	return apply_filters( 'modality_post_nav', $default );
}

function modality_post_info() {
	$default = array(
		'disable' => 'disable',
		'above' => 'above',
	);
	return apply_filters( 'modality_post_info', $default );
}

function modality_get_option_defaults() {
	$defaults = array(
		'theme_color' => '#3498db',
		'breadcrumbs' => '1',
		'animation' => false,
		'responsive_design' => '1',
		'scrollup' => '1',
		'scrollup_color' => '#888888',
		'scrollup_hover_color' => '#3498db',
		'logo_width' => '300',
		'logo_height' => '30',
		'logo_top_margin' => '8',
		'logo_left_margin' => '0',
		'logo_bottom_margin' => '0',
		'logo_right_margin' => '25',
		'logo' => '',
		'logo_alt_text' => 'Logo',
		'logo_uppercase' => '1',
		'google_font_logo' => 'Open Sans',
		'logo_font_size' => '24',
		'logo_font_weight' => '700',
		'text_logo_color' => '#ffffff',
		'enable_logo_tagline' => false,
		'tagline_font_size' => '16',
		'tagline_color' => '#ffffff',
		'tagline_uppercase' => '1',
		'menu_sticky' => '1',
		'menu_top_margin' => '0',
		'google_font_menu' => 'Open Sans',
		'nav_font_size' => '13',
		'menu_uppercase' => '1',
		'nav_font_color' => '#ffffff',
		'nav_border_color' => '#c9c9c9',
		'nav_bg_color' => '#1a1a1a',
		'nav_bg_sub_color' => '#1a1a1a',
		'nav_hover_font_color' => '#3498db',
		'nav_bg_hover_color' => '#1a1a1a',
		'nav_cur_item_color' => '#3498db',
		'google_font_body' => 'Open Sans',
		'body_font_size' => '15',
		'body_font_color' => '#777777',
		'header_bg_color' => '#1a1a1a',
		'header_opacity' => '1',
		'header_top_enable' => '1',
		'header_address' => '1234 Street Name, City Name, United States',
		'header_phone' => '(123) 456-7890',
		'header_email' => 'info@yourdomain.com',
		'address_color' => '#cccccc',
		'top_head_color' => '#252525',
		'image_slider_on' => '1',
		'getstarted_section_on' => '1',
		'features_section_on' => '1',
		'about_section_on' => '1',
		'services_section_on' => '1',
		'cta_section_on' => false,
		'content_boxes_section_on' => false,
		'getin_home_on' => '1',
		'blog_section_on' => '1',
		'latest_posts_on' => '1',
		'social_section_on' => '1',
		'slider_height' => '500',
		'image_slider_cat' => '',
		'slideshow_speed' => '5000',
		'animation_speed' => '800',
		'slider_num' => '3',
		'captions_on' => true,
		'captions_pos_left' => '0',
		'captions_pos_top' => '120',
		'captions_width' => '70',
		'captions_title_color' => '#ffffff',
		'captions_text_color' => '#ffffff',
		'captions_button_color' => '#ffffff',
		'captions_button' => '1',
		'caption_button_text' => 'Read More',
		'footer_bg_color' => '#252525',
		'copyright_bg_color' => '#111111',
		'footer_widget_title_color' => '#ffffff',
		'footer_widget_title_border_color' => '#444444',
		'footer_widget_text_color' => '#ffffff',
		'footer_widget_text_border_color' => '#444444',
		'footer_social_color' => '#ffffff',
		'footer_widgets' => '1',
		'footer_copyright_text' => 'Copyright '.date('Y').' '.get_bloginfo('site_title'),
		'layout_settings' => 'col2-l',
		'blog_posts_home_color' => '#ffffff',
		'blog_posts_home_image' => '',
		'blog_posts_top_color' => '#eeeeee',
		'blog_posts_top_font_color' => '#111111',
		'blog_posts_top_image' => '',
		'blog_content' => 'excerpt',
		'blog_excerpt' => '50',
		'simple_paginaton' => false,
		'post_navigation' => 'sidebar',
		'post_info' => 'above',
		'featured_img_post' => '1',
		'getst_bg_color' => '#252525',
		'getst_header_color' => '#ffffff',
		'getst_section_header' => 'Awesome Design & Clean Coding',
		'getst_text_color' => '#ffffff',
		'getst_section_text' => 'Are you ready?',
		'getst_button_text' => 'Get Started',
		'getst_button_color' => '#3498db',
		'getst_button_url' => '',
		'features_bg_color' => '#ffffff',
		'features_bg_image' => '',
		'features_title_color' => '#111111',
		'features_text_color' => '#111111',
		'features_section_title' => 'Clean Design & Great Functionality',
		'features_section_desc' => 'Lorem ipsum dolor sit amet pellentesque',
		'feature_one' => 'Responsive Design',
		'feature_one_desc' => 'Lorem ipsum dolor sit',
		'feature_one_icon' => 'fa-tablet',
		'feature_one_image' => '',
		'feature_one_url' => '',
		'feature_two' => 'Unlimited Colors',
		'feature_two_desc' => 'Lorem ipsum dolor sit',
		'feature_two_icon' => 'fa-tint',
		'feature_two_image' => '',
		'feature_two_url' => '',
		'feature_three' => 'Clean Code',
		'feature_three_desc' => 'Lorem ipsum dolor sit',
		'feature_three_icon' => 'fa-html5',
		'feature_three_image' => '',
		'feature_three_url' => '',
		'feature_four' => 'eCommerce Ready',
		'feature_four_desc' => 'Lorem ipsum dolor sit',
		'feature_four_icon' => 'fa-shopping-cart',
		'feature_four_image' => '',
		'feature_four_url' => '',
		'about_bg_color' => '#eeeeee',
		'about_bg_image' => '',
		'about_header_color' => '#111111',
		'about_section_header' => 'About Us',
		'about_text_color' => '#111111',
		'about_section_text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
		'services_bg_color' => '#ffffff',
		'services_bg_image' => '',
		'services_title_color' => '#111111',
		'services_text_color' => '#777777',
		'services_section_title' => 'Our Services',
		'services_section_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis. Praesent gravida dignissim felis, id sagittis mauris rutrum non. Nullam pretium id sem ut hendrerit.',
		'services_image' => get_template_directory_uri() . '/images/assets/tablet-313002_640.jpg',
		'service_one' => 'Easy to Use',
		'service_one_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_one_icon' => 'fa-coffee',
		'service_two' => 'Works Everywhere',
		'service_two_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_two_icon' => 'fa-paper-plane',
		'service_three' => 'Great Performance',
		'service_three_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_three_icon' => 'fa-tachometer',
		'service_four' => 'Clean Code',
		'service_four_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis.',
		'service_four_icon' => 'fa-code',
		'cta_bg_color' => '#eeeeee',
		'cta_bg_image' => '',
		'cta_section_sm_header' => 'Why work with us',
		'cta_sm_color' => '#111111',
		'cta_section_big_header' => 'Creative People That Make Awesome Things',
		'cta_big_color' => '#111111',
		'cta_button_text' => 'Get in touch',
		'cta_button_url' => '',
		'cont_bg_color' => '#252525',
		'cntbx_bg_image' => '',
		'cntbx_title_color' => '#ffffff',
		'cont_text_color' => '#ffffff',
		'first_column_header' => 'Responsive Design',
		'first_column_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'first_column_image' => 'fa-tablet',
		'first_column_url' => '',
		'second_column_header' => 'High Quality',
		'second_column_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'second_column_image' => 'fa-umbrella',
		'second_column_url' => '',
		'third_column_header' => 'Tons of Features',
		'third_column_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'third_column_image' => 'fa-cog',
		'third_column_url' => '',
		'getin_bg_color' => '#eeeeee',
		'getin_bg_image' => '',
		'getin_header_color' => '#111111',
		'getin_section_header' => 'Get In Touch with Us',
		'getin_text_color' => '#111111',
		'getin_section_text' => 'If you have any questions, do not hesitate to contact us',
		'getin_button_text' => 'Contact us now',
		'getin_button_color' => '#111111',
		'getin_button_url' => '',
		'blog_bg_color' => '#ffffff',
		'blog_bg_image' => '',
		'blog_cat' => '',
		'num_posts' => '3',
		'blog_section_title' => 'Latest News',
		'blog_title_color' => '#111111',
		'blog_post_color' => '#111111',
		'blog_meta_color' => '#111111',
		'facebook_link' => '#',
		'twitter_link' => '#',
		'google_link' => '#',
		'linkedin_link' => '#',
		'instagram_link' => '#',
		'vimeo_link' => '#',
		'social_color' => '#eeeeee',
		'social_bg_image' => '',
	);
	return apply_filters( 'modality_get_option_defaults', $defaults );
}

function modality_get_options() {
    // Options API
    return wp_parse_args( 
        get_option( 'modality_theme_options', array() ), 
        modality_get_option_defaults() 
    );
}
