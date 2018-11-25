<?php
/**
 * Customizer settings for the latest post section
 * 
 * @package corporate-landing-page
 */

 add_action( 'kirki_config', 'corporate_landing_page_customize_latest' );
 function corporate_landing_page_customize_latest( $config ) {
     /**
     * ====================
     * Latest Blogs Section
     * ====================
     */
    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_blog_section', array(
        'priority'  =>  45,
        'capability'    =>  'edit_theme_options',
        'title'     =>  __( 'Latest Posts', 'corporate-landing-page'),
        'panel'     =>  'corporate_landing_page_homepage_panel'
    ));

    /**
     * Enable or Disable
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate-landing-page', array(
        'label' =>  __( 'Enable/Disable the section', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_blog_section',
        'settings'  =>  'corporate_landing_page_blog_section_ed',
        'type'  =>  'toggle',
        'default'   =>  1
    ));

    /**
     * Section Title
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __( 'Title of the section', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_blog_section',
        'settings'  =>  'corporate_landing_page_blog_section_title',
        'type'      =>  'text',
        'default'   =>  __( 'Latest Blogs', 'corporate-landing-page' )
    ));

 }