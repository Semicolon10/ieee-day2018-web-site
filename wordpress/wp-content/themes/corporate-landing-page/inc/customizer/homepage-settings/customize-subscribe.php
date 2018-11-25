<?php
/**
 * Front page subscription form customizer
 * 
 * @package corporate-landing-page
 */



 add_action( 'kirki_config', 'corporate_landing_page_customize_subscribe' );
 function corporate_landing_page_customize_subscribe( $config ) {

    /**
     * ====================
     * Subscription Section
     * ====================
     */
    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_subscription', array(
        'priority'  =>  47,
        'capability'    =>  'edit_theme_options',
        'title'     =>  __( 'Subscribe Section', 'corporate-landing-page'),
        'panel'     =>  'corporate_landing_page_homepage_panel'
    ) );

    /**
     * Enable or Disable
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate-landing-page', array(
        'label' =>  __( 'Enable/Disable the section', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_subscription',
        'settings'  =>  'corporate_landing_page_subscription_ed',
        'type'  =>  'toggle',
        'default'   =>  1
    ));

    /**
     * Section Title
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     => __( 'Subscription Form Title', 'corporate-landing-page' ),
        'section'   => 'corporate_landing_page_subscription',
        'settings'  => 'corporate_landing_page_subscription_title',
        'type'      => 'text',
        'default'   => __( 'Subscribe and stay updated', 'corporate-landing-page' ),
    ) );

    /**
     * Section Description
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     => __( 'Subscription Form Sub-Text', 'corporate-landing-page' ),
        'section'   => 'corporate_landing_page_subscription',
        'settings'  => 'corporate_landing_page_subscription_sub_text',
        'type'      => 'text',
        'default'   => __( 'Subscribe now and receive weekly newsletter with us.', 'corporate-landing-page' ),
    ) );


    /**
     * Form Content
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     => __( 'Form Code', 'corporate-landing-page' ),
        'section'   => 'corporate_landing_page_subscription',
        'settings'  => 'corporate_landing_page_subscription_form',
        'type'      => 'code',
        'choices'   =>  array(
            'language'  =>  'html'
        )
    ) );
 }
