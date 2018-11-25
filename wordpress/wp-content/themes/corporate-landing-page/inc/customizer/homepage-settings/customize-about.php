<?php
/**
 * Customizer settings for the about us section in homepage
 * 
 * @package corporate-landing-page
 */



 add_action( 'kirki_config', 'corporate_landing_page_customize_about' );
 function corporate_landing_page_customize_about( $config ) {
    /**
     * ============== 
     * About Section
     * ============== 
     * */
    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_about_section', array(
        'priority'  =>  43,
        'capability'    =>  'edit_theme_options',
        'title'     =>  __( 'About Us Section', 'corporate-landing-page'),
        'panel'     =>  'corporate_landing_page_homepage_panel'
    ));

    /**
     * Enable or Disable
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate-landing-page', array(
        'label' =>  __( 'Enable/Disable the section', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_about_section',
        'settings'  =>  'corporate_landing_page_about_section_ed',
        'type'  =>  'toggle',
        'default'   =>  1
    ));

    /** Section Title */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __( 'Section Title', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_about_section',
        'settings'  =>  'corporate_landing_page_about_section_title',
        'type'      =>  'text',
        'default'   =>  __('About', 'corporate-landing-page'),
    ));

    /** Button Label */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __( 'Button Label', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_about_section',
        'settings'  =>  'corporate_landing_page_about_section_button',
        'type'      =>  'text',
    ));

    /** If type == pages */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __('Select a page', 'corporate-landing-page'),
        'section'   =>  'corporate_landing_page_about_section',
        'settings'   =>  'corporate_landing_page_about_section_page',
        'type'      =>  'select',
        'choices'   =>  corporate_landing_page_options_pages(),
    ));

 }