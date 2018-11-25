<?php
/**
 * Layout Settings
 * 
 * @package corporate-landing-page
 *
 */
 
function corporate_landing_page_customize_register_styling( $config ) {
    
    /** Styling Options */
    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_styling_settings', array(
        'title' => __( 'Styling Options', 'corporate-landing-page' ),
        'priority' => 13,
        'capability' => 'edit_theme_options',
        'panel' =>  'corporate_main_panel'
    ) );
    
    /** Primary Color */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     => __( 'Primary Color', 'corporate-landing-page' ),
        'help'      => __( 'Choose primary color for your site .', 'corporate-landing-page' ),
        'section'   => 'corporate_landing_page_styling_settings',
        'settings'  => 'corporate_landing_page_primary_color',
        'type'      => 'color',
        'default'   => '#353c4e',
    ) );	

    /** Secondary Color */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     => __( 'Accent Color', 'corporate-landing-page' ),
        'help'      => __( 'Choose an accent color for your site .', 'corporate-landing-page' ),
        'section'   => 'corporate_landing_page_styling_settings',
        'settings'  => 'corporate_landing_page_secondary_color',
        'type'      => 'color',
        'default'   => '#cf9556',
    ) );    
    
    /** Styling Options Ends */
}
add_action( 'kirki_config', 'corporate_landing_page_customize_register_styling' );