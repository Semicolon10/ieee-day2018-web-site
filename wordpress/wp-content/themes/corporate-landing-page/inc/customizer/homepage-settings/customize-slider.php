<?php
/**
 * Settings for slider
 */

function corporate_landing_page_customize_register_slider( $config ){

	global $corporate_landing_page_options_posts, $corporate_landing_page_option_categories;

	//Register Panel for slider
	Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_kirki_slider_options', array(
		'title'		=>	__( 'Slider Settings', 'corporate-landing-page'),
		'priority'	=>	42,
        'capability' =>	'edit_theme_options',
        'panel'     =>  'corporate_landing_page_homepage_panel',
        ));

	//Enable Disable Slider
	Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page_ed_slider', array(
		'type'	=>	'toggle',
		'settings'	=>	'corporate_landing_page_ed_slider_settings',
		'label'	=>	__( 'Enable/Disable Slider', 'corporate-landing-page'),
		'section'	=>	'corporate_landing_page_kirki_slider_options',
		'default' => 1,
		'priority'	=>	10,
        ));
        
    //Select slider post category
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'type'  =>  'select',
        'settings'  =>  'corporate_landing_page_slider_categories',
        'label'     =>  __('Select a category', 'corporate-landing-page'),
        'section'   =>  'corporate_landing_page_kirki_slider_options',
        'default'   =>  '',
        'description'   =>  __('The posts that belong to this category will be shown in the slides. If nothing is selected then the latest posts will be shown.', 'corporate-landing-page'),
        'choices'   =>  corporate_landing_page_main_cat_dropdown()
	));
	
	//Button Text
	Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __( 'Button Title', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_kirki_slider_options',
        'settings'  =>  'corporate_landing_page_slider_button_text',
        'type'      =>  'text',
        'default'   =>  __('Read More', 'corporate-landing-page'),
    ));

    //Slider Animation Out Type
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
    	'type'	=>	'select',
    	'settings'	=>	'corporate_landing_page_slider_animation_in_settings',
    	'label'	=>	__( 'Slider In Animation', 'corporate-landing-page' ),
    	'section'	=> 'corporate_landing_page_kirki_slider_options',
    	'default'	=> 'slide',
    	'priority'	=>	90,
    	'choices'	=>	corporate_landing_page_animate_in_options(),
        ) );
         //Slider Animation In Type
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
    	'type'	=>	'select',
    	'settings'	=>	'corporate_landing_page_slider_animation_out_settings',
    	'label'	=>	__( 'Slider Out Animation', 'corporate-landing-page' ),
    	'section'	=> 'corporate_landing_page_kirki_slider_options',
    	'default'	=> 'slide',
    	'priority'	=>	100,
    	'choices'	=>	corporate_landing_page_animate_out_options(),
    	) );

}
add_action( 'kirki_config', 'corporate_landing_page_customize_register_slider' );