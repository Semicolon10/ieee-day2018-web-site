<?php
/**
 * Customizer for the banner sections in homepage
 * 
 * @package corporate-landing-page
 */

 add_action( 'kirki_config', 'corporate_landing_page_customize_banner' );
 function corporate_landing_page_customize_banner( $config ) {
     /**
     * ============== 
     * Banner Section
     * ============== 
     * */
    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_homepage_banner', array(
        'priority'  =>  44,
        'capability'    =>  'edit_theme_options',
        'title'     =>  __( 'Banner Settings', 'corporate-landing-page'),
        'panel'     =>  'corporate_landing_page_homepage_panel'
    ) );

    /**
     * Enable or Disable
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate-landing-page', array(
        'label' =>  __( 'Enable/Disable the section', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_homepage_banner',
        'settings'  =>  'corporate_landing_page_homepage_banner_ed',
        'type'  =>  'toggle',
        'default'   =>  1
    ));

    /**
     * Section Title
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __( 'Title of the section', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_homepage_banner',
        'settings'  =>  'corporate_landing_page_homepage_banner_title',
        'type'      =>  'text',
        'default'   =>  __( 'Lets Work Together', 'corporate-landing-page' )
    ));

    //Button Label
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label' =>  __( 'Button Label', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_homepage_banner',
        'settings'  =>  'corporate_landing_page_homepage_type_button',
        'type'  =>  'text',
        'default'   =>  esc_attr__( 'Read More', 'corporate-landing-page' ),
    ));

    /** If banner type == custom */
    //Description   
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label' =>  __( 'Banner Description', 'corporate-landing-page'),
        'section'   =>  'corporate_landing_page_homepage_banner',
        'settings'   =>  'corporate_landing_page_banner_type_custom',
        'type'  =>  'textarea',
        'default'   =>  esc_attr__( 'Lorem ipsum is the dummy text for print and typesetting industry', 'corporate-landing-page' ),
    ));

    //Button Link
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label' =>  __( 'Button Link', 'corporate-landing-page'),
        'section'   =>  'corporate_landing_page_homepage_banner',
        'settings'   =>  'corporate_landing_page_banner_type_custom_button',
        'type'  =>  'link',
        'default'   =>  esc_attr__( '#', 'corporate-landing-page' ),
    ));
 }