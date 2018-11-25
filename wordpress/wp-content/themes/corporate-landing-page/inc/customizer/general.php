<?php
/**
 * General Settings
 *
 * @package corporate-landing-page
 */
 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function corporate_landing_page_customize_register_general( $config ) {
	
    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_general_settings', array(
        'priority'   => 12,
        'capability' => 'edit_theme_options',
        'title'      => __( 'General Settings', 'corporate-landing-page' ),
        'panel' =>  'corporate_main_panel'
    ) );
	
    /** Pagination Type */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'type'        => 'radio',
        'settings'    => 'corporate_landing_page_pagination_type',
        'label'       => __( 'Pagination Type', 'corporate-landing-page' ),
        'help'        => __( 'Select pagination type.', 'corporate-landing-page' ),
        'section'     => 'corporate_landing_page_general_settings',
        'default'     => 'default',
        'choices'     => array(
            'default'         => __( 'Default (Older Posts / Newer Posts)', 'corporate-landing-page' ),
            'numbered'        => __( 'Numbered (1 2 3 4...)', 'corporate-landing-page' ),
        )  
    ) );
 
}
add_action( 'kirki_config', 'corporate_landing_page_customize_register_general' );