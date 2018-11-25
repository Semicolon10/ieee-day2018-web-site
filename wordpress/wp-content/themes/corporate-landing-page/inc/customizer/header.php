<?php
/** 
 * Header Settings
 * 
 * @package corporate-landing-page
 * 
*/

function corporate_landing_page_customize_register_header( $config ){

    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_header_options', array(
        'title'          => __( 'Header Settings', 'corporate-landing-page' ),
        'priority'       => 15,
		'capability'     => 'edit_theme_options',
		'panel'	=>	'corporate_main_panel'
    ) );

	/** Woocommerce Cart */
	Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
		'type'	=>	'toggle',
		'settings'	=>	'corporate_landing_page_ed_cart',
		'label'	=>	__( 'Cart', 'corporate-landing-page'),
		'section'	=>	'corporate_landing_page_header_options',
		'default'	=>	0,
		'priority'	=>	20,
	));

	/** Header Contact */
	Corporate_Landing_Page_Kirki::add_field( 'corporate-landing-page', array(
		'label'		=>	__( 'Header Contact Icon', 'corporate-landing-page'),
		'description'	=>	__( 'Choose your own font awesome icons', 'corporate-landing-page'),
		'section'	=>	'corporate_landing_page_header_options',
		'settings'	=>	'corporate_landing_page_header_contact_icon',
		'type'	=>	'repeater',
		'row_label'	=>	array(
			'type'	=>	'field',
			'field'	=>	'text'
		),
		'fields'	=>	array(
			'icon'	=>	array(
				'type'	=>	'select',
				'label'	=>	esc_attr__( 'Icon', 'corporate-landing-page' ),
				'choices'	=>	corporate_landing_page_font_awesome()
			),
			'text'	=>	array(
				'type'	=>	'text',
				'label'	=>	esc_attr__( 'Label', 'corporate-landing-page' )
			)
		),
		'priority' 	=> 40,
		
	) );

}
add_action( 'kirki_config', 'corporate_landing_page_customize_register_header' );