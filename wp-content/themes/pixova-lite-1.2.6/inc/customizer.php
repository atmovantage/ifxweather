<?php

function pixova_lite_customize_register( $wp_customize ) {
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Remove sections from customizer front-view
	$wp_customize->remove_section('colors');


    // Change panel for Site Title & Tagline Section
    $site_title        = $wp_customize->get_section( 'title_tagline' );
    $site_title->panel = 'pixova_lite_panel_general';

    // Change panel for Background Image
    $site_title        = $wp_customize->get_section( 'background_image' );
    $site_title->panel = 'pixova_lite_panel_general';

    // Change panel for Static Front Page
    $site_title        = $wp_customize->get_section( 'static_front_page' );
    $site_title->panel = 'pixova_lite_panel_general';

    // Change panel for Navigation
    $site_title        = $wp_customize->get_section( 'nav' );
    $site_title->panel = 'pixova_lite_panel_general';

    // Change priority for Site Title
    $site_title           = $wp_customize->get_control( 'blogname' );
    $site_title->priority = 15;

    // Change priority for Site Tagline
    $site_title           = $wp_customize->get_control( 'blogdescription' );
    $site_title->priority = 17;
	
	/**********************************************/
	/*************** ORDER ************************/
	/**********************************************/

	$wp_customize->add_section( 'pixova_lite_order_section' , array(
					'title'       => __( 'Section order', 'pixova-lite' ),
					'priority'    => 26
	));
	
	$wp_customize->add_setting(
	        'pixova_lite_order_section',
	        array(
	        	'sanitize_callback' => 'pixova_lite_sanitize_pro_version'
	        )
	);
	
	$wp_customize->add_control( new Pixova_Lite_Theme_Support( $wp_customize, 
			'pixova_lite_order_section',
		    array(
		        'section' => 'pixova_lite_order_section',
		   )
		)
	);

    $wp_customize->add_section( 'pixova_lite_pricing_section' , array(
        'title'       => __( 'Pricing tables', 'pixova-lite' ),
        'priority'    => 27
    ));

    $wp_customize->add_setting(
        'pixova_lite_pricing_section',
        array(
            'sanitize_callback' => 'pixova_lite_sanitize_pro_version'
        )
    );

    $wp_customize->add_control( new Pixova_Lite_Theme_Support_Pricing( $wp_customize,
            'pixova_lite_pricing_section',
            array(
                'section' => 'pixova_lite_pricing_section',
            )
        )
    );

	$wp_customize->add_section( 'pixova_lite_maps_section' , array(
					'title'       => __( 'Google Maps', 'pixova-lite' ),
					'priority'    => 37
	));
	
	$wp_customize->add_setting(
	        'pixova_lite_maps_section',
	        array(
	        	'sanitize_callback' => 'pixova_lite_sanitize_pro_version'
	        )
	);
	
	$wp_customize->add_control( new Pixova_Lite_Theme_Support_Googlemap( $wp_customize, 
			'pixova_lite_maps_section',
		    array(
		        'section' => 'pixova_lite_maps_section',
		   )
		)
	);


	/* Section Visibility */
	$wp_customize->add_section( 'pixova_lite_visibility_section' ,
		array(
			'title'       => __( 'Section visibility', 'pixova-lite' ),
			'priority'    => 28
		)
	);

	/* Intro visibility */
	$wp_customize->add_setting('pixova_lite_intro_visibility',
		array(
			'sanitize_callback' => 'pixova_lite_sanitize_checkbox',
			'default' => '1'
		)
	);
	$wp_customize->add_control( 
			'pixova_lite_intro_visibility',
		    array(
		    	'type'	=> 'checkbox',
		    	'label' => __('Display the Intro section ?', 'pixova-lite'),
		        'section' => 'pixova_lite_visibility_section',
		   )
	);

	/* About visibility */
	$wp_customize->add_setting('pixova_lite_about_visibility',
		array(
			'sanitize_callback' => 'pixova_lite_sanitize_checkbox',
			'default' => '1'
		)
	);
	$wp_customize->add_control( 
			'pixova_lite_about_visibility',
		    array(
		    	'type'	=> 'checkbox',
		    	'label' => __('Display the about section ?', 'pixova-lite'),
		        'section' => 'pixova_lite_visibility_section',
		   )
	);

	/* Recent works visibility */
	$wp_customize->add_setting('pixova_lite_works_visibility',
		array(
			'sanitize_callback' => 'pixova_lite_sanitize_checkbox',
			'default' => '1'
		)
	);
	$wp_customize->add_control( 
			'pixova_lite_works_visibility',
		    array(
		    	'type'	=> 'checkbox',
		    	'label' => __('Display the works section ?', 'pixova-lite'),
		        'section' => 'pixova_lite_visibility_section',
		   )
	);

	/* Testimonials visibility */
	$wp_customize->add_setting('pixova_lite_testimonials_visibility',
		array(
			'sanitize_callback' => 'pixova_lite_sanitize_checkbox',
			'default' => '1'
		)
	);
	$wp_customize->add_control( 
			'pixova_lite_testimonials_visibility',
		    array(
		    	'type'	=> 'checkbox',
		    	'label' => __('Display the testimonials section ?', 'pixova-lite'),
		        'section' => 'pixova_lite_visibility_section',
		   )
	);

	/* Team visibility */
	$wp_customize->add_setting('pixova_lite_team_visibility',
		array(
			'sanitize_callback' => 'pixova_lite_sanitize_checkbox',
			'default' => '1'
		)
	);
	$wp_customize->add_control( 
			'pixova_lite_team_visibility',
		    array(
		    	'type'	=> 'checkbox',
		    	'label' => __('Display the team section ?', 'pixova-lite'),
		        'section' => 'pixova_lite_visibility_section',
		   )
	);

	/* News visibility */
	$wp_customize->add_setting('pixova_lite_news_visibility',
		array(
			'sanitize_callback' => 'pixova_lite_sanitize_checkbox',
			'default' => '1'
		)
	);
	$wp_customize->add_control( 
			'pixova_lite_news_visibility',
		    array(
		    	'type'	=> 'checkbox',
		    	'label' => __('Display the news section ?', 'pixova-lite'),
		        'section' => 'pixova_lite_visibility_section',
		   )
	);

	/* Contact visibility */
	$wp_customize->add_setting('pixova_lite_contact_visibility',
		array(
			'sanitize_callback' => 'pixova_lite_sanitize_checkbox',
			'default' => '1'
		)
	);
	$wp_customize->add_control( 
			'pixova_lite_contact_visibility',
		    array(
		    	'type'	=> 'checkbox',
		    	'label' => __('Display the contact section ?', 'pixova-lite'),
		        'section' => 'pixova_lite_visibility_section',
		   )
	);


	/***********************************************/
	/************** GENERAL OPTIONS  ***************/
	/***********************************************/

	
		$wp_customize->add_panel( 'pixova_lite_panel_general',
			array(
				'priority' => 29,
				'capability' => 'edit_theme_options',
				'theme_supports' => '',
				'title' => __( 'Theme options', 'pixova-lite' )
			) 
		);
		
		/***********************************************/
		/************** General Site Settings  ***************/
		/***********************************************/
		$wp_customize->add_section( 'pixova_lite_general_section' ,
			array(
				'title'       => __( 'General', 'pixova-lite' ),
				'priority'    => 1,
				'panel' 	  => 'pixova_lite_panel_general'
			)
		);
		

		/* Company text logo */
		$wp_customize->add_setting('pixova_lite_text_logo',
			array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('Pixova', 'pixova-lite'),
				)
		);

		$wp_customize->add_control(
			'pixova_lite_text_logo',
			array(
				'label' 		=> __('Enter text logo here (company name)', 'pixova-lite'),
				'section' 		=> 'pixova_lite_general_section',
				'priority' 		=> 2
			)
		);


		/* COPYRIGHT */
		$wp_customize->add_setting( 'pixova_lite_copyright',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => sprintf('&copy; %s', 'pixova-lite'),
			)
		);
		$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control( 
			$wp_customize, 
			'pixova_lite_copyright' ,
			array(
					'label'    => __( 'Copyright', 'pixova-lite' ),
					'section'  => 'pixova_lite_general_section',
					'settings' => 'pixova_lite_copyright',
					'priority'    => 3,
				) 
			) 
		);



	/***********************************************/
		/************** Contact Details  ***************/
		/***********************************************/
		$wp_customize->add_section( 'pixova_lite_general_contact_section' ,
			array(
				'title'       => __( 'Contact Details', 'pixova-lite' ),
				'priority'    => 3,
				'panel' => 'panel_general'
			)
		);
		

			
		/* email */   
		$wp_customize->add_setting( 'pixova_lite_email',
			array( 
				'sanitize_callback' => 'sanitize_text_field',
				'default' => 'contact@site.com'
			) 
		);

		$wp_customize->add_control( 'pixova_lite_email',
			array(
					'label'   => __( 'Email', 'pixova-lite' ),
					'section' => 'pixova_lite_general_contact_section',
					'settings'   => 'pixova_lite_email',
					'priority' => 10
				)
		);
		
	
		/* phone number */
		$wp_customize->add_setting( 'pixova_lite_phone',
			array(
				'sanitize_callback' => 'pixova_lite_sanitize_number',
				'default' => '0 332 548 954'
			) 
		);

		$wp_customize->add_control( 'pixova_lite_phone',
			array(
				'label'   => __( 'Phone number', 'pixova-lite' ),
				'section' => 'pixova_lite_general_contact_section',
				'settings'   => 'pixova_lite_phone',
				'priority' => 12
				)
		);
		
		/* address */
		$wp_customize->add_setting( 'pixova_lite_address',
			array( 
				'sanitize_callback' => 'sanitize_text_field', 
				'default' => __('Street 221B Baker Street','pixova-lite')
			) 
		);

		$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control( $wp_customize, 'pixova_lite_address',
			array(
					'label'   => __( 'Address', 'pixova-lite' ),
					'section' => 'pixova_lite_general_contact_section',
					'settings'   => 'pixova_lite_address',
					'priority' => 14
				)
			)
		) ;




	/***********************************************/
	/************** Intro  ***************/
	/***********************************************/

	$wp_customize->add_panel( 'pixova_lite_panel_intro',
			array(
				'priority' => 30,
				'capability' => 'edit_theme_options',
				'theme_supports' => '',
				'title' => __( 'Intro Section (big bg. image)', 'pixova-lite' )
			) 
		);

	/* Text Section */
	$wp_customize->add_section( 'pixova_lite_intro_text' ,
		array(
			'title'       		=> __( 'Text', 'pixova-lite' ),
			'priority'    		=> 1,
			'panel' 			=> 'pixova_lite_panel_intro'
		)
	);
	
		/* Main CTA text */
		$wp_customize->add_setting('pixova_lite_intro_cta',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Probably the BEST FREE WordPress theme of all times. Now with WooCommerce Support', 'pixova-lite')
			)
		);

		$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
			$wp_customize,
			'pixova_lite_intro_cta',
				array(
					'label' 	=> __('Main CTA text ', 'pixova-lite'),
					'section' 	=> 'pixova_lite_intro_text',
					'priority' 	=> 1
				)
			)
		);

		/* Main CTA sub-text */
		$wp_customize->add_setting('pixova_lite_intro_sub_cta',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('60fps smooth parallax header; Random header images (multiple images allowed here).', 'pixova-lite'),
			)
		);

		$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
			$wp_customize,
			'pixova_lite_intro_sub_cta',
				array(
					'label' 	=> __('Main CTA sub-title ', 'pixova-lite'),
					'section' 	=> 'pixova_lite_intro_text',
					'priority' 	=> 2
				)
			)
		);

	/* Button Section */
	$wp_customize->add_section( 'pixova_lite_intro_button' ,
		array(
			'title'       		=> __( 'Button', 'pixova-lite' ),
			'priority'    		=> 2,
			'panel' 			=> 'pixova_lite_panel_intro'
		)
	);

		/* Button text */
		$wp_customize->add_setting('pixova_lite_intro_button_text',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Main CTA here', 'pixova-lite'),
			)
		);

		$wp_customize->add_control( 
			'pixova_lite_intro_button_text',
			array(
				'label' 	=> __('Button text ', 'pixova-lite'),
				'section' 	=> 'pixova_lite_intro_button',
				'priority' 	=> 1
			)
			
		);

		/* Button URL */
		$wp_customize->add_setting('pixova_lite_intro_button_url',
			array(
				'sanitize_callback' => 'esc_url',
				'default' => 'http://www.machothemes.com/pixova/'
			)
		);

		$wp_customize->add_control( 
			'pixova_lite_intro_button_url',
			array(
				'label' 	=> __('Button URL ', 'pixova-lite'),
				'section' 	=> 'pixova_lite_intro_button',
				'priority' 	=> 1
			)
			
		);

	/* What we do Section #1 */
	$wp_customize->add_section( 'pixova_lite_intro_what_we_do_1' ,
		array(
			'title'       		=> __( 'What we do #1', 'pixova-lite' ),
			'priority'    		=> 3,
			'panel' 			=> 'pixova_lite_panel_intro'
		)
	);

		/* What we do #1: title */
		$wp_customize->add_setting('pixova_lite_intro_what_we_do_1_title',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Web design', 'pixova-lite'),
			)
		);

		$wp_customize->add_control( 
			'pixova_lite_intro_what_we_do_1_title',
			array(
				'label' 	=> __('What we do #1 title ', 'pixova-lite'),
				'section' 	=> 'pixova_lite_intro_what_we_do_1',
				'priority' 	=> 1
			)
			
		);

		/* What we do #1: description */
		$wp_customize->add_setting('pixova_lite_intro_what_we_do_1_description',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Lorem ipsum dolor sit amet. Lorem ipsum.', 'pixova-lite'),
			)
		);

		$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
			$wp_customize,
			'pixova_lite_intro_what_we_do_1_description',
				array(
					'label' 	=> __('What we do #1 description ', 'pixova-lite'),
					'section' 	=> 'pixova_lite_intro_what_we_do_1',
					'priority' 	=> 2
				)
			)
		);


	/* What we do Section #2 */
	$wp_customize->add_section( 'pixova_lite_intro_what_we_do_2' ,
		array(
			'title'       		=> __( 'What we do #2', 'pixova-lite' ),
			'priority'    		=> 4,
			'panel' 			=> 'pixova_lite_panel_intro'
		)
	);

		/* What we do #2: title */
			$wp_customize->add_setting('pixova_lite_intro_what_we_do_2_title',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('Development', 'pixova-lite'),
				)
			);

			$wp_customize->add_control( 
				'pixova_lite_intro_what_we_do_2_title',
				array(
					'label' 	=> __('What we do #2 title ', 'pixova-lite'),
					'section' 	=> 'pixova_lite_intro_what_we_do_2',
					'priority' 	=> 2
				)
				
			);

			/* What we do #2: description */
			$wp_customize->add_setting('pixova_lite_intro_what_we_do_2_description',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('Lorem ipsum dolor sit amet. Lorem ipsum.', 'pixova-lite'),
				)
			);

			$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
				$wp_customize,
				'pixova_lite_intro_what_we_do_2_description',
					array(
						'label' 	=> __('What we do #2 description ', 'pixova-lite'),
						'section' 	=> 'pixova_lite_intro_what_we_do_2',
						'priority' 	=> 2
					)
				)
			);


	/* What we do Section #3 */
	$wp_customize->add_section( 'pixova_lite_intro_what_we_do_3' ,
		array(
			'title'       		=> __( 'What we do #3', 'pixova-lite' ),
			'priority'    		=> 5,
			'panel' 			=> 'pixova_lite_panel_intro'
		)
	);

		/* What we do #3: title */
		$wp_customize->add_setting('pixova_lite_intro_what_we_do_3_title',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Print design', 'pixova-lite'),
			)
		);

		$wp_customize->add_control( 
			'pixova_lite_intro_what_we_do_3_title',
			array(
				'label' 	=> __('What we do #3 title ', 'pixova-lite'),
				'section' 	=> 'pixova_lite_intro_what_we_do_3',
				'priority' 	=> 3
			)
			
		);

		/* What we do #3: description */
		$wp_customize->add_setting('pixova_lite_intro_what_we_do_3_description',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Lorem ipsum dolor sit amet. Lorem ipsum.', 'pixova-lite'),
			)
		);

		$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
			$wp_customize,
			'pixova_lite_intro_what_we_do_3_description',
				array(
					'label' 	=> __('What we do #3 description ', 'pixova-lite'),
					'section' 	=> 'pixova_lite_intro_what_we_do_3',
					'priority' 	=> 3
				)
			)
		);



	/***********************************************/
	/************** About Options  ***************/
	/***********************************************/

	
		$wp_customize->add_panel( 'pixova_lite_panel_about',
			array(
				'priority' => 31,
				'capability' => 'edit_theme_options',
				'theme_supports' => '',
				'title' => __( 'About Section', 'pixova-lite' )
			) 
		);

		$wp_customize->add_section( 'pixova_lite_about_titles' , array(
				'title'       => __( 'Section Titles', 'pixova-lite' ),
				'priority'    => 1,
				'panel' 	  => 'pixova_lite_panel_about'
		));

		/* Section Title */
		$wp_customize->add_setting('pixova_lite_about_section_title',
			array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('We build solutions for your everyday problems.', 'pixova-lite'),
				)
		);

		$wp_customize->add_control(
			'pixova_lite_about_section_title',
			array(
				'label' 	=> __('Section title', 'pixova-lite'),
				'section' 	=> 'pixova_lite_about_titles',
				'priority' 	=> 1,
			)
		);

		/* Section Sub-Title */
		$wp_customize->add_setting('pixova_lite_about_section_sub_title',
			array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'	=> __('This is what we do in a nutshell', 'pixova-lite'),
				)
		);

		$wp_customize->add_control(
			'pixova_lite_about_section_sub_title',
			array(
				'label' 	=> __('Section sub-title', 'pixova-lite'),
				'section' 	=> 'pixova_lite_about_titles',
				'priority' 	=> 0,
			)
		);


		
		$wp_customize->add_section('pixova_lite_about_section_text',
			array(
				'title' => __('Section text', 'pixova-lite'),
				'priority' => 1,
				'panel' => 'pixova_lite_panel_about'
			)
		);

		/* About textarea */
		$wp_customize->add_setting('pixova_lite_about_section_textarea',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('Creative ut tincidunt nibh, varius cursus nunc. Curabitur molestie, metus vel luctus euismod, mi libero laoreet odio, eu dapibus leo tortor sit amet purus. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'pixova-lite'),
				)
		);

		$wp_customize->add_control(new Pixova_Lite_Textarea_Custom_Control(
				$wp_customize,
				'pixova_lite_about_section_textarea',
					array(
						'label' => __('Block of text', 'pixova-lite'),
						'section' => 'pixova_lite_about_section_text',
					)
			)
		);

		/* About blockquote */
		$wp_customize->add_setting('pixova_lite_about_section_blockquote',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('Working with Pixova has been an experience for a lifetime. I strongly reccommend these guys for their awesome support. Erlich Bachman, Aviato', 'pixova-lite'),
				)
		);

		$wp_customize->add_control(new Pixova_Lite_Textarea_Custom_Control(
				$wp_customize,
				'pixova_lite_about_section_blockquote',
					array(
						'label' => __('Blockquote', 'pixova-lite'),
						'section' => 'pixova_lite_about_section_text',
					)
			)
		);

		/* Section Chart # 1 */
		$wp_customize->add_section('pixova_lite_section_chart_1',
			array(
				'title' 	=> __('Section Chart #1', 'pixova-lite'),
				'priority' 	=> 2,
				'panel' 	=> 'pixova_lite_panel_about'
			)
		);

		/* Chart #1 Heading */
		$wp_customize->add_setting('pixova_lite_about_section_chart_1_heading',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Web design', 'pixova-lite'),
			)
		);

		$wp_customize->add_control('pixova_lite_about_section_chart_1_heading',
			array(
				'label' => __('Heading for chart', 'pixova-lite'),
				'section' => 'pixova_lite_section_chart_1',
				'priority' => 0
			)
		);

		/* Chart #1 Settings */
		$wp_customize->add_setting('pixova_lite_about_section_chart_1_percentage',
			array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => '70'
				)
		);

		$wp_customize->add_control( new Pixova_Lite_Number_Custom_Control(
			$wp_customize,
			'pixova_lite_about_section_chart_1_percentage',
				array(
					'label' 	=> __('Chart Percentage', 'pixova-lite'),
					'section' 	=> 'pixova_lite_section_chart_1',
					'priority' 	=> 1,
				)
			)
		);

		/* Chart Bar Color */
		$wp_customize->add_setting('pixova_lite_about_section_chart_1_bar_color',
			array(
				'sanitize_callback' => 'pixova_lite_sanitize_hex_color',
				'default' => '#2cc36b',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'pixova_lite_about_section_chart_1_bar_color',
				array(
					'type' => 'color',
					'label' => __('Chart bar color', 'pixova-lite'),
					'section' => 'pixova_lite_section_chart_1',
					'priority' => 2
				)
			)
		);

		/* Chart Track Color */
		$wp_customize->add_setting('pixova_lite_about_section_chart_1_track_color',
			array(
				'sanitize_callback' => 'pixova_lite_sanitize_hex_color',
				'default' => '#EEE'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'pixova_lite_about_section_chart_1_track_color',
				array(
					'type' => 'color',
					'label' => __('Chart Track color', 'pixova-lite'),
					'section' => 'pixova_lite_section_chart_1',
					'priority' => 3
				)
			)
		);



		/* Section Chart # 2 */
		$wp_customize->add_section('pixova_lite_section_chart_2',
			array(
				'title' 	=> __('Section Chart #2', 'pixova-lite'),
				'priority' 	=> 3,
				'panel' 	=> 'pixova_lite_panel_about'
			)
		);

		/* Chart #2 Heading */
		$wp_customize->add_setting('pixova_lite_about_section_chart_2_heading',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Web development', 'pixova-lite'),
			)
		);

		$wp_customize->add_control('pixova_lite_about_section_chart_2_heading',
			array(
				'label' => __('Heading for chart', 'pixova-lite'),
				'section' => 'pixova_lite_section_chart_2',
				'priority' => 0
			)
		);

		/* Chart #2 Settings */
		$wp_customize->add_setting('pixova_lite_about_section_chart_2_percentage',
			array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => '90'
				)
		);

		$wp_customize->add_control( new Pixova_Lite_Number_Custom_Control(
			$wp_customize,
			'pixova_lite_about_section_chart_2_percentage',
				array(
					'label' 	=> __('Chart Percentage', 'pixova-lite'),
					'section' 	=> 'pixova_lite_section_chart_2',
					'priority' 	=> 1,
				)
			)
		);

		/* Chart Bar Color */
		$wp_customize->add_setting('pixova_lite_about_section_chart_2_bar_color',
			array(
				'sanitize_callback' => 'pixova_lite_sanitize_hex_color',
				'default' => '#2cc36b'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'pixova_lite_about_section_chart_2_bar_color',
				array(
					'type' => 'color',
					'label' => __('Chart bar color', 'pixova-lite'),
					'section' => 'pixova_lite_section_chart_2',
					'priority' => 2
				)
			)
		);

		/* Chart Track Color */
		$wp_customize->add_setting('pixova_lite_about_section_chart_2_track_color',
			array(
				'sanitize_callback' => 'pixova_lite_sanitize_hex_color',
				'default' => '#EEE'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'pixova_lite_about_section_chart_2_track_color',
				array(
					'type' => 'color',
					'label' => __('Chart Track color', 'pixova-lite'),
					'section' => 'pixova_lite_section_chart_2',
					'priority' => 3
				)
			)
		);

		/* Section Chart #3 */
		$wp_customize->add_section('pixova_lite_section_chart_3',
			array(
				'title' 	=> __('Section Chart #3', 'pixova-lite'),
				'priority' 	=> 4,
				'panel' 	=> 'pixova_lite_panel_about'
			)
		);

		/* Chart #3 Heading */
		$wp_customize->add_setting('pixova_lite_about_section_chart_3_heading',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Print design', 'pixova-lite'),
			)
		);

		$wp_customize->add_control('pixova_lite_about_section_chart_3_heading',
			array(
				'label' => __('Heading for chart', 'pixova-lite'),
				'section' => 'pixova_lite_section_chart_3',
				'priority' => 0
			)
		);

		/* Chart #3 Settings */
		$wp_customize->add_setting('pixova_lite_about_section_chart_3_percentage',
			array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => '90'
				)
		);

		$wp_customize->add_control( new Pixova_Lite_Number_Custom_Control(
			$wp_customize,
			'pixova_lite_about_section_chart_3_percentage',
				array(
					'label' 	=> __('Chart Percentage', 'pixova-lite'),
					'section' 	=> 'pixova_lite_section_chart_3',
					'priority' 	=> 1,
				)
			)
		);

		/* Chart Bar Color */
		$wp_customize->add_setting('pixova_lite_about_section_chart_3_bar_color',
			array(
				'sanitize_callback' => 'pixova_lite_sanitize_hex_color',
				'default' => '#2cc36b'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'pixova_lite_about_section_chart_3_bar_color',
				array(
					'type' => 'color',
					'label' => __('Chart bar color', 'pixova-lite'),
					'section' => 'pixova_lite_section_chart_3',
					'priority' => 2
				)
			)
		);

		/* Chart Track Color */
		$wp_customize->add_setting('pixova_lite_about_section_chart_3_track_color',
			array(
				'sanitize_callback' => 'pixova_lite_sanitize_hex_color',
				'default' => '#EEE'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'pixova_lite_about_section_chart_3_track_color',
				array(
					'type' => 'color',
					'label' => __('Chart Track color', 'pixova-lite'),
					'section' => 'pixova_lite_section_chart_3',
					'priority' => 3
				)
			)
		);

		/* Section Chart #4 */
		$wp_customize->add_section('pixova_lite_section_chart_4',
			array(
				'title' 	=> __('Section Chart #4', 'pixova-lite'),
				'priority' 	=> 5,
				'panel' 	=> 'pixova_lite_panel_about'
			)
		);

		/* Chart #4 Heading */
		$wp_customize->add_setting('pixova_lite_about_section_chart_4_heading',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => __('Graphic identity', 'pixova-lite'),
			)
		);

		$wp_customize->add_control('pixova_lite_about_section_chart_4_heading',
			array(
				'label' => __('Heading for chart', 'pixova-lite'),
				'section' => 'pixova_lite_section_chart_4',
				'priority' => 0
			)
		);

		/* Chart #4 Settings */
		$wp_customize->add_setting('pixova_lite_about_section_chart_4_percentage',
			array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => '50'
				)
		);

		$wp_customize->add_control( new Pixova_Lite_Number_Custom_Control(
			$wp_customize,
			'pixova_lite_about_section_chart_4_percentage',
				array(
					'label' 	=> __('Chart Percentage', 'pixova-lite'),
					'section' 	=> 'pixova_lite_section_chart_4',
					'priority' 	=> 1,
				)
			)
		);

		/* Chart Bar Color */
		$wp_customize->add_setting('pixova_lite_about_section_chart_4_bar_color',
			array(
				'sanitize_callback' => 'pixova_lite_sanitize_hex_color',
				'default' => '#2cc36b'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'pixova_lite_about_section_chart_4_bar_color',
				array(
					'type' => 'color',
					'label' => __('Chart bar color', 'pixova-lite'),
					'section' => 'pixova_lite_section_chart_4',
					'priority' => 2
				)
			)
		);

		/* Chart Track Color */
		$wp_customize->add_setting('pixova_lite_about_section_chart_4_track_color',
			array(
				'sanitize_callback' => 'pixova_lite_sanitize_hex_color',
				'default' => '#EEE'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 
			'pixova_lite_about_section_chart_4_track_color',
				array(
					'type' => 'color',
					'label' => __('Chart Track color', 'pixova-lite'),
					'section' => 'pixova_lite_section_chart_4',
					'priority' => 3
				)
			)
		);





		
	
	/***********************************************/
	/************** Recent Works  ***************/
	/***********************************************/

	
		$wp_customize->add_panel( 'pixova_lite_panel_works', 
			array(
				'priority' => 32,
				'capability' => 'edit_theme_options',
				'theme_supports' => '',
				'title' => __( 'Recent Works Section', 'pixova-lite' )
			) 
		);

		$wp_customize->add_section( 'pixova_lite_work_titles' , array(
				'title'       => __( 'Section Titles', 'pixova-lite' ),
				'priority'    => 1,
				'panel' 	  => 'pixova_lite_panel_works'
		));

		/* Section Title */
		$wp_customize->add_setting('pixova_lite_work_section_title',
			array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('Recent works', 'pixova-lite'),
				)
		);

		$wp_customize->add_control(
			'pixova_lite_work_section_title',
			array(
				'label' 	=> __('Section title', 'pixova-lite'),
				'section' 	=> 'pixova_lite_work_titles',
				'priority' 	=> 1,
			)
		);

		/* Section Sub-Title */
		$wp_customize->add_setting('pixova_lite_work_section_sub_title',
			array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('It\'s show and tell time.', 'pixova-lite')
				)
		);

		$wp_customize->add_control(
			'pixova_lite_work_section_sub_title',
			array(
				'label' 	=> __('Section sub-title', 'pixova-lite'),
				'section' 	=> 'pixova_lite_work_titles',
				'priority' 	=> 2,
			)
		);

		/* Recent works: project #1 section */
		$wp_customize->add_section('pixova_lite_works_project_1',
			array(
				'title' 	=> __('Project #1', 'pixova-lite'),
				'priority' 	=> 1,
				'panel' 	=> 'pixova_lite_panel_works'
			)
		);

			/* Recent works: project #1 image */
			$wp_customize->add_setting('pixova_lite_works_project_1_image',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' =>  get_template_directory_uri() . '/layout/images/recent-works/recent-works-1-270x426.jpg',
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_works_project_1_image',
					array(
						'label' 	=> __('Project big image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_1',
						'priority' 	=> 1,
					)
				)
			);

			/* Recent works: project #1 logo */
			$wp_customize->add_setting('pixova_lite_works_project_1_logo',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/recent-works/logo1.png'
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_works_project_1_logo',
					array(
						'label' 	=> __('Project logo image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_1',
						'priority' 	=> 2,
					)
				)
			);

			/* Recent works: project #1 URL */
			$wp_customize->add_setting('pixova_lite_works_project_1_url',
				array(
					'sanitize_callback' => 'esc_url',
					'default'			=> 'http://www.machothemes.com/themes/pixova/'
				)
			);

			$wp_customize->add_control(
				'pixova_lite_works_project_1_url',
					array(
						'label' 	=> __('Project URL (enter project link here)', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_1',
						'priority' 	=> 3,
					)
			);

			/* Recent works: project #2 section */
			$wp_customize->add_section('pixova_lite_works_project_2',
				array(
					'title' 	=> __('Project #2', 'pixova-lite'),
					'priority' 	=> 2,
					'panel' 	=> 'pixova_lite_panel_works'
				)
			);


			/* Recent works: project #2 image */
			$wp_customize->add_setting('pixova_lite_works_project_2_image',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/recent-works/recent-works-2-270x426.jpg'
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_works_project_2_image',
					array(
						'label' 	=> __('Project big image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_2',
						'priority' 	=> 2,
					)
				)
			);

			/* Recent works: project #2 logo */
			$wp_customize->add_setting('pixova_lite_works_project_2_logo',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/recent-works/logo2.png',
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_works_project_2_logo',
					array(
						'label' 	=> __('Project logo image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_2',
						'priority' 	=> 2,
					)
				)
			);

			/* Recent works: project #2 URL */
			$wp_customize->add_setting('pixova_lite_works_project_2_url',
				array(
					'sanitize_callback' => 'esc_url',
					'default'			=> 'http://www.machothemes.com/themes/pixova/'
				)
			);

			$wp_customize->add_control(
				'pixova_lite_works_project_2_url',
					array(
						'label' 	=> __('Project URL (enter project link here)', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_2',
						'priority' 	=> 3,
					)
			);

			/* Recent works: project #3 section */
			$wp_customize->add_section('pixova_lite_works_project_3',
				array(
					'title' 	=> __('Project #3', 'pixova-lite'),
					'priority' 	=> 3,
					'panel' 	=> 'pixova_lite_panel_works'
				)
			);


			/* Recent works: project #3 image */
			$wp_customize->add_setting('pixova_lite_works_project_3_image',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/recent-works/recent-works-3-270x426.jpg'
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_works_project_3_image',
					array(
						'label' 	=> __('Project big image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_3',
						'priority' 	=> 3,
					)
				)
			);

			/* Recent works: project #3 logo */
			$wp_customize->add_setting('pixova_lite_works_project_3_logo',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/recent-works/logo3.png'
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_works_project_3_logo',
					array(
						'label' 	=> __('Project logo image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_3',
						'priority' 	=> 3,
					)
				)
			);

			/* Recent works: project #3 URL */
			$wp_customize->add_setting('pixova_lite_works_project_3_url',
				array(
					'sanitize_callback' => 'esc_url',
					'default'			=> 'http://www.machothemes.com/themes/pixova/'
				)
			);

			$wp_customize->add_control(
				'pixova_lite_works_project_3_url',
					array(
						'label' 	=> __('Project URL (enter project link here)', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_3',
						'priority' 	=> 3,
					)
			);

			/* Recent works: project #4 section */
			$wp_customize->add_section('pixova_lite_works_project_4',
				array(
					'title' 	=> __('Project #4', 'pixova-lite'),
					'priority' 	=> 4,
					'panel' 	=> 'pixova_lite_panel_works'
				)
			);


			/* Recent works: project #4 image */
			$wp_customize->add_setting('pixova_lite_works_project_4_image',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/recent-works/recent-works-4-270x426.jpg'
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_works_project_4_image',
					array(
						'label' 	=> __('Project big image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_4',
						'priority' 	=> 4,
					)
				)
			);

			/* Recent works: project #4 logo */
			$wp_customize->add_setting('pixova_lite_works_project_4_logo',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/recent-works/logo4.png'
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_works_project_4_logo',
					array(
						'label' 	=> __('Project logo image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_4',
						'priority' 	=> 4,
					)
				)
			);

			/* Recent works: project #4 URL */
			$wp_customize->add_setting('pixova_lite_works_project_4_url',
				array(
					'sanitize_callback' => 'esc_url',
					'default'			=> 'http://www.machothemes.com/themes/pixova/'
				)
			);

			$wp_customize->add_control(
				'pixova_lite_works_project_4_url',
					array(
						'label' 	=> __('Project URL (enter project link here)', 'pixova-lite'),
						'section' 	=> 'pixova_lite_works_project_4',
						'priority' 	=> 4,
					)
			);



	/***********************************************/
	/************** Testimonials  ***************/
	/***********************************************/

	
		$wp_customize->add_panel( 'pixova_lite_panel_testimonials', 
			array(
				'priority' => 33,
				'capability' => 'edit_theme_options',
				'theme_supports' => '',
				'title' => __( 'Testimonials Section', 'pixova-lite' )
			) 
		);

		$wp_customize->add_section( 'pixova_lite_testimonial_titles' , array(
				'title'       => __( 'Section Titles', 'pixova-lite' ),
				'priority'    => 1,
				'panel' 	  => 'pixova_lite_panel_testimonials'
		));

			/* Section Title */
			$wp_customize->add_setting('pixova_lite_testimonial_section_title',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('Some words from our clients', 'pixova-lite'),
					)
			);

			$wp_customize->add_control(
				'pixova_lite_testimonial_section_title',
				array(
					'label' 	=> __('Section title', 'pixova-lite'),
					'section' 	=> 'pixova_lite_testimonial_titles',
					'priority' 	=> 1,
				)
			);

			/* Section Sub-Title */
			$wp_customize->add_setting('pixova_lite_testimonial_section_sub_title',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('We don\'t like to brag, others do it for us.', 'pixova-lite'),
					)
			);

			$wp_customize->add_control(
				'pixova_lite_testimonial_section_sub_title',
				array(
					'label' 	=> __('Section sub-title', 'pixova-lite'),
					'section' 	=> 'pixova_lite_testimonial_titles',
					'priority' 	=> 2,
				)
			);

		/* Testimonials: testimonial #1 section */
		$wp_customize->add_section( 'pixova_lite_testimonial_1' , array(
				'title'       => __( 'Testimonial #1', 'pixova-lite' ),
				'priority'    => 1,
				'panel' 	  => 'pixova_lite_panel_testimonials'
		));

			/* Testimonials: testimonial #1 person name */
			$wp_customize->add_setting('pixova_lite_testimonial_1_person_name',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('Katie Parry - Hooli', 'pixova-lite')
					)
			);

			$wp_customize->add_control(
				'pixova_lite_testimonial_1_person_name',
				array(
					'label' 	=> __('Testimonial person name', 'pixova-lite'),
					'section' 	=> 'pixova_lite_testimonial_1',
					'priority' 	=> 1,
				)
			);

			/* Testimonials: testimonial #1 text */
			$wp_customize->add_setting('pixova_lite_testimonial_1_person_description',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('Working with Pixova has been an experience for a lifetime. I strongly  reccommend these guys for their awesome support. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat eleifend convallis.', 'pixova-lite')
					)
			);

			$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
				$wp_customize,
				'pixova_lite_testimonial_1_person_description',
					array(
						'label' 	=> __('Testimonial person description', 'pixova-lite'),
						'section' 	=> 'pixova_lite_testimonial_1',
						'priority' 	=> 2,
					)
				)
			);

			/* Testimonials: testimonial #1 image */
			$wp_customize->add_setting('pixova_lite_testimonial_1_person_image',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned-92x92.jpg',
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_testimonial_1_person_image',
					array(
						'label' 	=> __('Testimonial person image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_testimonial_1',
						'priority' 	=> 3,
					)
				)
			);

		/* Testimonials: testimonial #2 section */
		$wp_customize->add_section( 'pixova_lite_testimonial_2' , array(
				'title'       => __( 'Testimonial #2', 'pixova-lite' ),
				'priority'    => 1,
				'panel' 	  => 'pixova_lite_panel_testimonials'
		));


			/* Testimonials: testimonial #2 person name */
			$wp_customize->add_setting('pixova_lite_testimonial_2_person_name',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('John Doe', 'pixova-lite'),
					)
			);

			$wp_customize->add_control(
				'pixova_lite_testimonial_2_person_name',
				array(
					'label' 	=> __('Testimonial person name', 'pixova-lite'),
					'section' 	=> 'pixova_lite_testimonial_2',
					'priority' 	=> 1,
				)
			);

			/* Testimonials: testimonial #2 text */
			$wp_customize->add_setting('pixova_lite_testimonial_2_person_description',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('Working with Pixova has been an experience for a lifetime. I strongly  reccommend these guys for their awesome support. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat eleifend convallis.', 'pixova-lite')
					)
			);

			$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
				$wp_customize,
				'pixova_lite_testimonial_2_person_description',
					array(
						'label' 	=> __('Testimonial person name', 'pixova-lite'),
						'section' 	=> 'pixova_lite_testimonial_2',
						'priority' 	=> 2,
					)
				)
			);

			/* Testimonials: testimonial #2 image */
			$wp_customize->add_setting('pixova_lite_testimonial_2_person_image',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned2-92x92.jpg',
				)
			);

			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_testimonial_2_person_image',
					array(
						'label' 	=> __('Testimonial person image', 'pixova-lite'),
						'section' 	=> 'pixova_lite_testimonial_2',
						'priority' 	=> 3,
					)
				)
			);

	/* Testimonials: testimonial #3 section */
	$wp_customize->add_section( 'pixova_lite_testimonial_3' , array(
		'title'       => __( 'Testimonial #3', 'pixova-lite' ),
		'priority'    => 3,
		'panel' 	  => 'pixova_lite_panel_testimonials'
	));

	/* Testimonials: testimonial #3 person name */
	$wp_customize->add_setting('pixova_lite_testimonial_3_person_name',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => __('Katie Parry - Hooli', 'pixova-lite')
		)
	);

	$wp_customize->add_control(
		'pixova_lite_testimonial_3_person_name',
		array(
			'label' 	=> __('Testimonial person name', 'pixova-lite'),
			'section' 	=> 'pixova_lite_testimonial_3',
			'priority' 	=> 1,
		)
	);

	/* Testimonials: testimonial #3 text */
	$wp_customize->add_setting('pixova_lite_testimonial_3_person_description',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => __('Working with Pixova has been an experience for a lifetime. I strongly  reccommend these guys for their awesome support. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat eleifend convallis.', 'pixova-lite')
		)
	);

	$wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
			$wp_customize,
			'pixova_lite_testimonial_3_person_description',
			array(
				'label' 	=> __('Testimonial person description', 'pixova-lite'),
				'section' 	=> 'pixova_lite_testimonial_3',
				'priority' 	=> 2,
			)
		)
	);

	/* Testimonials: testimonial #3 image */
	$wp_customize->add_setting('pixova_lite_testimonial_3_person_image',
		array(
			'sanitize_callback' => 'pixova_lite_sanitize_file_url',
			'default' => get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned-92x92.jpg',
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'pixova_lite_testimonial_3_person_image',
			array(
				'label' 	=> __('Testimonial person image', 'pixova-lite'),
				'section' 	=> 'pixova_lite_testimonial_3',
				'priority' 	=> 3,
			)
		)
	);

    /* Testimonials: testimonial #4 section */
    $wp_customize->add_section( 'pixova_lite_testimonial_4' , array(
        'title'       => __( 'Testimonial #4', 'pixova-lite' ),
        'priority'    => 4,
        'panel' 	  => 'pixova_lite_panel_testimonials'
    ));

    /* Testimonials: testimonial #4 person name */
    $wp_customize->add_setting('pixova_lite_testimonial_4_person_name',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => __('Katie Parry - Hooli', 'pixova-lite')
        )
    );

    $wp_customize->add_control(
        'pixova_lite_testimonial_4_person_name',
        array(
            'label' 	=> __('Testimonial person name', 'pixova-lite'),
            'section' 	=> 'pixova_lite_testimonial_4',
            'priority' 	=> 1,
        )
    );

    /* Testimonials: testimonial #4 text */
    $wp_customize->add_setting('pixova_lite_testimonial_4_person_description',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => __('Working with Pixova has been an experience for a lifetime. I strongly  reccommend these guys for their awesome support. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat eleifend convallis.', 'pixova-lite')
        )
    );

    $wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
            $wp_customize,
            'pixova_lite_testimonial_4_person_description',
            array(
                'label' 	=> __('Testimonial person description', 'pixova-lite'),
                'section' 	=> 'pixova_lite_testimonial_4',
                'priority' 	=> 2,
            )
        )
    );

    /* Testimonials: testimonial #4 image */
    $wp_customize->add_setting('pixova_lite_testimonial_4_person_image',
        array(
            'sanitize_callback' => 'pixova_lite_sanitize_file_url',
            'default' => get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned-92x92.jpg',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'pixova_lite_testimonial_4_person_image',
            array(
                'label' 	=> __('Testimonial person image', 'pixova-lite'),
                'section' 	=> 'pixova_lite_testimonial_4',
                'priority' 	=> 3,
            )
        )
    );

    /* Testimonials: testimonial #5 section */
    $wp_customize->add_section( 'pixova_lite_testimonial_5' , array(
        'title'       => __( 'Testimonial #5', 'pixova-lite' ),
        'priority'    => 5,
        'panel' 	  => 'pixova_lite_panel_testimonials'
    ));

    /* Testimonials: testimonial #5 person name */
    $wp_customize->add_setting('pixova_lite_testimonial_5_person_name',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => __('Katie Parry - Hooli', 'pixova-lite')
        )
    );

    $wp_customize->add_control(
        'pixova_lite_testimonial_5_person_name',
        array(
            'label' 	=> __('Testimonial person name', 'pixova-lite'),
            'section' 	=> 'pixova_lite_testimonial_5',
            'priority' 	=> 1,
        )
    );

    /* Testimonials: testimonial #5 text */
    $wp_customize->add_setting('pixova_lite_testimonial_5_person_description',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => __('Working with Pixova has been an experience for a lifetime. I strongly  reccommend these guys for their awesome support. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer volutpat eleifend convallis.', 'pixova-lite')
        )
    );

    $wp_customize->add_control( new Pixova_Lite_Textarea_Custom_Control(
            $wp_customize,
            'pixova_lite_testimonial_5_person_description',
            array(
                'label' 	=> __('Testimonial person description', 'pixova-lite'),
                'section' 	=> 'pixova_lite_testimonial_5',
                'priority' 	=> 2,
            )
        )
    );

    /* Testimonials: testimonial #5 image */
    $wp_customize->add_setting('pixova_lite_testimonial_5_person_image',
        array(
            'sanitize_callback' => 'pixova_lite_sanitize_file_url',
            'default' => get_template_directory_uri() . '/layout/images/testimonials/teammembru_burned-92x92.jpg',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'pixova_lite_testimonial_5_person_image',
            array(
                'label' 	=> __('Testimonial person image', 'pixova-lite'),
                'section' 	=> 'pixova_lite_testimonial_5',
                'priority' 	=> 3,
            )
        )
    );

	/***********************************************/
	/************** Latest News  ***************/
	/***********************************************/
	
		$wp_customize->add_panel( 'pixova_lite_panel_news', 
			array(
				'priority' => 34,
				'capability' => 'edit_theme_options',
				'theme_supports' => '',
				'title' => __( 'Latest News Section', 'pixova-lite' )
			) 
		);

			$wp_customize->add_section( 'pixova_lite_news_titles' ,
				array(
					'title'       => __( 'Section Titles', 'pixova-lite' ),
					'priority'    => 1,
					'panel' 	  => 'pixova_lite_panel_news'
				)
			);

			/* Section Title */
			$wp_customize->add_setting('pixova_lite_news_section_title',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('Latest news', 'pixova-lite')
					)
			);

			$wp_customize->add_control(
				'pixova_lite_news_section_title',
				array(
					'label' 	=> __('Section title', 'pixova-lite'),
					'section' 	=> 'pixova_lite_news_titles',
					'priority' 	=> 1,
				)
			);

			/* Section Sub-Title */
			$wp_customize->add_setting('pixova_lite_news_section_sub_title',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('Straight from our blog', 'pixova-lite')
					)
			);

			$wp_customize->add_control(
				'pixova_lite_news_section_sub_title',
				array(
					'label' 	=> __('Section sub-title', 'pixova-lite'),
					'section' 	=> 'pixova_lite_news_titles',
					'priority' 	=> 2,
				)
			);

			$wp_customize->add_control( new Pixova_Lite_Number_Custom_Control(
				$wp_customize,
				'pixova_lite_news_post_number',
					array(
						'label' => __('Number of posts to display', 'pixova-lite'),
						'section' => 'pixova_lite_news_number',
						'priority' => 1,
					)
				)
			);


	/***********************************************/
	/************** Contact  ***************/
	/***********************************************/
	
		$wp_customize->add_panel( 'pixova_lite_panel_contact', 
			array(
				'priority' => 35,
				'capability' => 'edit_theme_options',
				'theme_supports' => '',
				'title' => __( 'Contact Section', 'pixova-lite' )
			) 
		);

			$wp_customize->add_section('pixova_lite_contact_titles',
				array(
					'title' => __('Section titles', 'pixova-lite'),
					'priority' => 1,
					'panel' => 'pixova_lite_panel_contact'
				)
			);


			/* Section Title */
				$wp_customize->add_setting('pixova_lite_contact_section_title',
					array(
							'sanitize_callback' => 'sanitize_text_field',
							'default' => __('Contact us', 'pixova-lite')
						)
				);

				$wp_customize->add_control(
					'pixova_lite_contact_section_title',
					array(
						'label' 	=> __('Section title', 'pixova-lite'),
						'section' 	=> 'pixova_lite_contact_titles',
						'priority' 	=> 1,
					)
				);

				/* Section Sub-Title */
				$wp_customize->add_setting('pixova_lite_contact_section_sub_title',
					array(
							'sanitize_callback' => 'sanitize_text_field',
							'default' => __('And we\'ll reply in no time', 'pixova-lite'),
						)
				);

				$wp_customize->add_control(
					'pixova_lite_contact_section_sub_title',
					array(
						'label' 	=> __('Section sub-title', 'pixova-lite'),
						'section' 	=> 'pixova_lite_contact_titles',
						'priority' 	=> 2,
					)
				);

				$wp_customize->add_section('pixova_lite_contact_cf7',
				array(
					'title' => __('Contact forms', 'pixova-lite'),
					'priority' => 1,
					'panel' => 'pixova_lite_panel_contact'
				)
			);

				/* Contact: contact form select */
				$wp_customize->add_setting('pixova_lite_contact_section_cf7',
					array(
						'sanitize_callback' => 'pixova_lite_sanitize_number'
					)
				);
				
				$wp_customize->add_control( new Pixova_Lite_CF7_Custom_Control(
					$wp_customize,
					'pixova_lite_contact_section_cf7',
						array(
							'label' => __('Select the contact form you\'d like to display (powered by Contact Form 7)', 'pixova-lite'),
							'section' => 'pixova_lite_contact_cf7',
							'priority' => 1,
							'type' => 'pixova_lite_contact_form_7',
						)
					)
				);
				
			
			

	/***********************************************/
	/************** Team  ***************/
	/***********************************************/
	
		$wp_customize->add_panel( 'pixova_lite_panel_team', 
			array(
				'priority' => 36,
				'capability' => 'edit_theme_options',
				'theme_supports' => '',
				'title' => __( 'Team Section', 'pixova-lite' )
			) 
		);


		$wp_customize->add_section( 'pixova_lite_team_titles' , array(
				'title'       => __( 'Section Titles', 'pixova-lite' ),
				'priority'    => 1,
				'panel' 	  => 'pixova_lite_panel_team'
		));

			/* Section Title */
			$wp_customize->add_setting('pixova_lite_team_section_title',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('The team', 'pixova-lite'),
					)
			);

			$wp_customize->add_control(
				'pixova_lite_team_section_title',
				array(
					'label' 	=> __('Section title', 'pixova-lite'),
					'section' 	=> 'pixova_lite_team_titles',
					'priority' 	=> 1,
				)
			);

			/* Section Sub-Title */
			$wp_customize->add_setting('pixova_lite_team_section_sub_title',
				array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => __('Meet the people that made it all happen.', 'pixova-lite'),
					)
			);

			$wp_customize->add_control(
				'pixova_lite_team_section_sub_title',
				array(
					'label' 	=> __('Section sub-title', 'pixova-lite'),
					'section' 	=> 'pixova_lite_team_titles',
					'priority' 	=> 2,
				)
			);

			/* Team: team member #1 section */
			$wp_customize->add_section('pixova_lite_team_member_1',
				array(
					'title' => __('Team member #1', 'pixova-lite'),
					'priority' => 2,
					'panel' => 'pixova_lite_panel_team'
				)
			);

			/* Team: team member #1 name */
			$wp_customize->add_setting('pixova_lite_team_member_1_name',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('John Doe', 'pixova-lite'),
				)
			);

			$wp_customize->add_control(
				'pixova_lite_team_member_1_name',
				array(
					'label' => __('Team member #1 name', 'pixova-lite'),
					'section' => 'pixova_lite_team_member_1',
					'priority' => 1,
				)
			);

			/* Team: team member #1 picture */
			$wp_customize->add_setting('pixova_lite_team_member_1_image',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/team/teammembru-150x150.jpg'
				)
			);
			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_team_member_1_image',
					array(
						'label' => __('Team member #1 image', 'pixova-lite'),
						'section' => 'pixova_lite_team_member_1',
						'priority' => 2
					)
				)
			);

			/* Team: team member #1 facebook */
			$wp_customize->add_setting('pixova_lite_team_member_1_facebook',
				array(
					'sanitize_callback' => 'esc_url',
					'default' => 'https://www.facebook.com/machothemes/'
				)
			);

			$wp_customize->add_control(
				'pixova_lite_team_member_1_facebook',
				array(
					'label' => __('Team member #1 Facebook URL', 'pixova-lite'),
					'section' => 'pixova_lite_team_member_1',
					'priority' => 3
				)
			);

			/* Team: team member #1 Dribbble */
			$wp_customize->add_setting('pixova_lite_team_member_1_dribbble',
				array(
					'sanitize_callback' => 'esc_url',
					'default' => 'http://www.dribbble.com/madalin.duca/'
				)
			);

			$wp_customize->add_control(
				'pixova_lite_team_member_1_dribbble',
				array(
					'label' => __('Team member #1 Dribbble URL', 'pixova-lite'),
					'section' => 'pixova_lite_team_member_1',
					'priority' => 4
				)
			);


			/* Team: team member #2 section */
			$wp_customize->add_section('pixova_lite_team_member_2',
				array(
					'title' => __('Team member #2', 'pixova-lite'),
					'priority' => 2,
					'panel' => 'pixova_lite_panel_team'
				)
			);

			/* Team: team member #2 name */
			$wp_customize->add_setting('pixova_lite_team_member_2_name',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default' => __('John Doe', 'pixova-lite'),
				)
			);

			$wp_customize->add_control(
				'pixova_lite_team_member_2_name',
				array(
					'label' => __('Team member #2 name', 'pixova-lite'),
					'section' => 'pixova_lite_team_member_2',
					'priority' => 1,
				)
			);

			/* Team: team member #2 picture */
			$wp_customize->add_setting('pixova_lite_team_member_2_image',
				array(
					'sanitize_callback' => 'pixova_lite_sanitize_file_url',
					'default' => get_template_directory_uri() . '/layout/images/team/teammembru2-150x150.jpg'
				)
			);
			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize,
				'pixova_lite_team_member_2_image',
					array(
						'label' => __('Team member #2 image', 'pixova-lite'),
						'section' => 'pixova_lite_team_member_2',
						'priority' => 2
					)
				)
			);

			/* Team: team member #2 facebook */
			$wp_customize->add_setting('pixova_lite_team_member_2_facebook',
				array(
					'sanitize_callback' => 'esc_url',
					'default' => 'https://www.facebook.com/machothemes/'
				)
			);

			$wp_customize->add_control(
				'pixova_lite_team_member_2_facebook',
				array(
					'label' => __('Team member #2 Facebook URL', 'pixova-lite'),
					'section' => 'pixova_lite_team_member_2',
					'priority' => 3
				)
			);

			/* Team: team member #2 Dribbble */
			$wp_customize->add_setting('pixova_lite_team_member_2_dribbble',
				array(
					'sanitize_callback' => 'esc_url',
					'default' => 'http://www.dribbble.com/madalin.duca/'
				)
			);

			$wp_customize->add_control(
				'pixova_lite_team_member_2_dribbble',
				array(
					'label' => __('Team member #2 Dribbble URL', 'pixova-lite'),
					'section' => 'pixova_lite_team_member_2',
					'priority' => 4
				)
			);

            /* Team: team member #3 section */
            $wp_customize->add_section('pixova_lite_team_member_3',
                array(
                    'title' => __('Team member #3', 'pixova-lite'),
                    'priority' => 3,
                    'panel' => 'pixova_lite_panel_team'
                )
            );

            /* Team: team member #3 name */
            $wp_customize->add_setting('pixova_lite_team_member_3_name',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default' => __('John Doe', 'pixova-lite'),
                )
            );

            $wp_customize->add_control(
                'pixova_lite_team_member_3_name',
                array(
                    'label' => __('Team member #3 name', 'pixova-lite'),
                    'section' => 'pixova_lite_team_member_3',
                    'priority' => 1,
                )
            );

            /* Team: team member #3 picture */
            $wp_customize->add_setting('pixova_lite_team_member_3_image',
                array(
                    'sanitize_callback' => 'pixova_lite_sanitize_file_url',
                    'default' => get_template_directory_uri() . '/layout/images/team/teammembru-150x150.jpg'
                )
            );
            $wp_customize->add_control( new WP_Customize_Image_Control(
                    $wp_customize,
                    'pixova_lite_team_member_3_image',
                    array(
                        'label' => __('Team member #3 image', 'pixova-lite'),
                        'section' => 'pixova_lite_team_member_3',
                        'priority' => 2
                    )
                )
            );

            /* Team: team member #3 facebook */
            $wp_customize->add_setting('pixova_lite_team_member_3_facebook',
                array(
                    'sanitize_callback' => 'esc_url',
                    'default' => 'https://www.facebook.com/machothemes/'
                )
            );

            $wp_customize->add_control(
                'pixova_lite_team_member_3_facebook',
                array(
                    'label' => __('Team member #3 Facebook URL', 'pixova-lite'),
                    'section' => 'pixova_lite_team_member_3',
                    'priority' => 3
                )
            );

            /* Team: team member #3 Dribbble */
            $wp_customize->add_setting('pixova_lite_team_member_3_dribbble',
                array(
                    'sanitize_callback' => 'esc_url',
                    'default' => 'http://www.dribbble.com/madalin.duca/'
                )
            );

            $wp_customize->add_control(
                'pixova_lite_team_member_3_dribbble',
                array(
                    'label' => __('Team member #3 Dribbble URL', 'pixova-lite'),
                    'section' => 'pixova_lite_team_member_3',
                    'priority' => 4
                )
            );

            /* Team: team member #4 section */
            $wp_customize->add_section('pixova_lite_team_member_4',
                array(
                    'title' => __('Team member #4', 'pixova-lite'),
                    'priority' => 4,
                    'panel' => 'pixova_lite_panel_team'
                )
            );

            /* Team: team member #4 name */
            $wp_customize->add_setting('pixova_lite_team_member_4_name',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default' => __('John Doe', 'pixova-lite'),
                )
            );

            $wp_customize->add_control(
                'pixova_lite_team_member_4_name',
                array(
                    'label' => __('Team member #4 name', 'pixova-lite'),
                    'section' => 'pixova_lite_team_member_4',
                    'priority' => 1,
                )
            );

            /* Team: team member #4 picture */
            $wp_customize->add_setting('pixova_lite_team_member_4_image',
                array(
                    'sanitize_callback' => 'pixova_lite_sanitize_file_url',
                    'default' => get_template_directory_uri() . '/layout/images/team/teammembru2-150x150.jpg'
                )
            );
            $wp_customize->add_control( new WP_Customize_Image_Control(
                    $wp_customize,
                    'pixova_lite_team_member_4_image',
                    array(
                        'label' => __('Team member #4 image', 'pixova-lite'),
                        'section' => 'pixova_lite_team_member_4',
                        'priority' => 2
                    )
                )
            );

            /* Team: team member #4 facebook */
            $wp_customize->add_setting('pixova_lite_team_member_4_facebook',
                array(
                    'sanitize_callback' => 'esc_url',
                    'default' => 'https://www.facebook.com/machothemes/'
                )
            );

            $wp_customize->add_control(
                'pixova_lite_team_member_4_facebook',
                array(
                    'label' => __('Team member #4 Facebook URL', 'pixova-lite'),
                    'section' => 'pixova_lite_team_member_4',
                    'priority' => 3
                )
            );

            /* Team: team member #4 Dribbble */
            $wp_customize->add_setting('pixova_lite_team_member_4_dribbble',
                array(
                    'sanitize_callback' => 'esc_url',
                    'default' => 'http://www.dribbble.com/madalin.duca/'
                )
            );

            $wp_customize->add_control(
                'pixova_lite_team_member_4_dribbble',
                array(
                    'label' => __('Team member #4 Dribbble URL', 'pixova-lite'),
                    'section' => 'pixova_lite_team_member_4',
                    'priority' => 4
                )
            );

            /* Team: team member #5 section */
            $wp_customize->add_section('pixova_lite_team_member_5',
                array(
                    'title' => __('Team member #5', 'pixova-lite'),
                    'priority' => 5,
                    'panel' => 'pixova_lite_panel_team'
                )
            );

            /* Team: team member #5 name */
            $wp_customize->add_setting('pixova_lite_team_member_5_name',
                array(
                    'sanitize_callback' => 'sanitize_text_field',
                    'default' => __('John Doe', 'pixova-lite'),
                )
            );

            $wp_customize->add_control(
                'pixova_lite_team_member_5_name',
                array(
                    'label' => __('Team member #5 name', 'pixova-lite'),
                    'section' => 'pixova_lite_team_member_5',
                    'priority' => 1,
                )
            );

            /* Team: team member #5 picture */
            $wp_customize->add_setting('pixova_lite_team_member_5_image',
                array(
                    'sanitize_callback' => 'pixova_lite_sanitize_file_url',
                    'default' => get_template_directory_uri() . '/layout/images/team/teammembru-150x150.jpg'
                )
            );
            $wp_customize->add_control( new WP_Customize_Image_Control(
                    $wp_customize,
                    'pixova_lite_team_member_5_image',
                    array(
                        'label' => __('Team member #5 image', 'pixova-lite'),
                        'section' => 'pixova_lite_team_member_5',
                        'priority' => 2
                    )
                )
            );

            /* Team: team member #5 facebook */
            $wp_customize->add_setting('pixova_lite_team_member_5_facebook',
                array(
                    'sanitize_callback' => 'esc_url',
                    'default' => 'https://www.facebook.com/machothemes/'
                )
            );

            $wp_customize->add_control(
                'pixova_lite_team_member_5_facebook',
                array(
                    'label' => __('Team member #5 Facebook URL', 'pixova-lite'),
                    'section' => 'pixova_lite_team_member_5',
                    'priority' => 3
                )
            );

            /* Team: team member #5 Dribbble */
            $wp_customize->add_setting('pixova_lite_team_member_5_dribbble',
                array(
                    'sanitize_callback' => 'esc_url',
                    'default' => 'http://www.dribbble.com/madalin.duca/'
                )
            );

            $wp_customize->add_control(
                'pixova_lite_team_member_5_dribbble',
                array(
                    'label' => __('Team member #5 Dribbble URL', 'pixova-lite'),
                    'section' => 'pixova_lite_team_member_5',
                    'priority' => 4
                )
            );

            /***********************************************/
            /************** Upgrade to PRO section  ***************/
            /***********************************************/
            $wp_customize->add_section( 'pixova_lite_pro_section' , array(
                'title'      => __('Get the PRO version', 'pixova-lite'),
                'priority'   => 1000,
            ) );

            $wp_customize->add_setting(
                'pixova_lite_upgrade_pro',
                array(
                    'default' => __('','pixova-lite'),
                    'capability'     => 'edit_theme_options',
                    'sanitize_callback' => 'sanitize_text_field',
                )
            );
            $wp_customize->add_control( new Pixova_Lite_WP_Pro_Customize_Control( $wp_customize, 'pixova_lite_upgrade_pro', array(
                    'label' => __('Discover Pixova PRO','pixova-lite'),
                    'section' => 'pixova_lite_pro_section',
                    'setting' => 'pixova_lite_upgrade_pro',
                ))
            );


    /*
        $wp_customize->add_setting(
            'pro_Review',
            array(
                'default' => __('','pixova-lite'),
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( new Pixova_Lite_WP_Review_Customize_Control( $wp_customize, 'pro_Review', array(
                'label' => __('Discover mt Pro','pixova-lite'),
                'section' => 'pixova_lite_pro_section',
                'setting' => 'pro_Review',
            ))
        );
    
    */


            $wp_customize->add_setting(
                'pixova_lite_doc_review',
                array(
                    'default' => __('','pixova-lite'),
                    'capability'     => 'edit_theme_options',
                    'sanitize_callback' => 'sanitize_text_field',
                )
            );
            $wp_customize->add_control( new Pixova_Lite_WP_Document_Customize_Control( $wp_customize, 'pixova_lite_doc_review', array(
                    'label' => __('Discover Pixova PRO','pixova-lite'),
                    'section' => 'pixova_lite_pro_section',
                    'setting' => 'pixova_lite_doc_review',
                ))
            );
	

}
add_action( 'customize_register', 'pixova_lite_customize_register' );


function pixova_lite_customize_preview_js() {
	wp_enqueue_script( 'pixova_lite_customizer', get_template_directory_uri() . '/layout/js/customizer/customizer.js', array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'pixova_lite_customize_preview_js' );


function pixova_lite_sanitize_pro_version( $input ) {
    return force_balance_tags( $input );
}

function pixova_lite_sanitize_number( $input ) {
    return force_balance_tags( $input );
}

function pixova_lite_sanitize_file_url( $url ) {

	$output = '';

	$filetype = wp_check_filetype( $url );
	if ( $filetype["ext"] ) {
		$output = esc_url( $url );
	}

	return $output;
}

function pixova_lite_sanitize_hex_color( $color ) {
	if ( '' === $color ) {
		return '';
	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}

	return null;
}

function pixova_lite_sanitize_checkbox( $value ) {
	if ( $value == 1 ) {
		return 1;
    } else {
		return 0;
    }
}

function pixova_lite_customizer_js_load() {
    wp_register_script( 'pixova_lite_customizer_script', get_template_directory_uri() . '/layout/js/customizer/customizer.js', array('jquery'), '1.0', true  );
    wp_enqueue_script( 'pixova_lite_customizer_script' );
}
add_action( 'customize_controls_enqueue_scripts', 'pixova_lite_customizer_js_load' );

function pixova_lite_customizer_css_load()
{
	wp_enqueue_style('mt-customizer-css', get_template_directory_uri() .'/layout/css/pixova-pro.css');
}
add_action('customize_controls_print_styles','pixova_lite_customizer_css_load');