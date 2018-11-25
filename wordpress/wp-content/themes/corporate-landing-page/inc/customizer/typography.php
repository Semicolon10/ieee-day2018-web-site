<?php
/*Typography Setting*/

function corporate_landing_page_customize_typography($config){

	/*Typography*/
	Corporate_Landing_Page_Kirki::add_panel('corporate_landing_page_typography_panel',array(
			'title'	=>	__('Typography Settings','corporate-landing-page'),
			'priority' => 11,
            'capability'=> 'edit_theme_options',
            'panel' =>  'corporate_main_panel'

	));

	/** Base Section */
    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_typography_base_section', array(
        'title' => __( 'Base Font', 'corporate-landing-page' ),
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'panel'     => 'corporate_landing_page_typography_panel'
    ) );

    /** Base Font */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
    	'type'        => 'typography',
    	'settings'    => 'corporate_landing_page_body_font',
    	'label'       => __( 'Base Font', 'corporate-landing-page' ),
    	'section'     => 'corporate_landing_page_typography_base_section',
        'choices' => array(
            'fonts' => array(
            'google' => array( 'popularity', 100 ),
            ),
        ),
    	'default'  => array(
    		'font-family' => 'Open Sans',
    		'variant' => 'regular',
    	),
    ) );

     /** Heading Typography Section */
    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_heading_section', array(
        'title' => __( 'Heading Font', 'corporate-landing-page' ),
        'priority' => 14,
        'capability' => 'edit_theme_options',
        'panel'     => 'corporate_landing_page_typography_panel'
    ) );

    /** Heading Font */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
    	'type'        => 'typography',
    	'settings'    => 'corporate_landing_page_heading_font',
    	'label'       => __( 'Heading Font', 'corporate-landing-page' ),
    	'section'     => 'corporate_landing_page_heading_section',
        'choices' => array(
            'fonts' => array(
            'google' => array( 'popularity', 100 ),
            ),
        ),
    	'default'     => array(
    		'font-family'    => 'Raleway',
    		'variant'        => 'regular',
    	),
    ) );


}
add_action('kirki_config','corporate_landing_page_customize_typography');