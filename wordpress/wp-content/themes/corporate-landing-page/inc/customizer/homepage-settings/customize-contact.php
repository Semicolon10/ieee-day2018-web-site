<?php
/**
 * Contact form 7 and google map homepage section customizer settings
 * 
 * @package corporate-landing-page
 */

 if( ! function_exists('corporate_landing_page_customize_contact') ) :
    
 add_action( 'kirki_config', 'corporate_landing_page_customize_contact' );
 function corporate_landing_page_customize_contact( $config ) {

     /**
     * ====================
     * Contact Section
     * ====================
     */
    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_contact_section', array(
        'priority'  =>  46,
        'capability'    =>  'edit_theme_options',
        'title'     =>  __( 'Contact Section', 'corporate-landing-page'),
        'panel'     =>  'corporate_landing_page_homepage_panel'
    ));

    /**
     * Enable or Disable
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate-landing-page', array(
        'label' =>  __( 'Enable/Disable the section', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_contact_section',
        'settings'  =>  'corporate_landing_page_contact_section_ed',
        'type'  =>  'toggle',
        'default'   =>  1
    ));

    /**
     * Section Title
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __( 'Enter a title', 'corporate-landing-page' ),
        'description'   =>  __( 'Title for this section.', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_contact_section',
        'settings'  =>  'corporate_landing_page_contact_title',
        'default'   =>  __('Get In Touch', 'corporate-landing-page'),
        'type'      =>  'text',
    ) );
    /**
     * Address Field
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __('Address', 'corporate-landing-page' ),
        'description'   =>  __( 'Enter your address here.', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_contact_section',
        'settings'  =>  'corporate_landing_page_contact_address',
        'default'   =>  __('Pulchowk 8, Lalitpur', 'corporate-landing-page'),
        'type'      =>  'text',
    ) );
    /**
     * Phone Field
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __('Phone', 'corporate-landing-page' ),
        'description'   =>  __( 'Enter your phone number here.', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_contact_section',
        'settings'  =>  'corporate_landing_page_contact_phone',
        'default'   =>  __('01-4455667', 'corporate-landing-page'),
        'type'      =>  'text',
    ) );
    /**
     * Email Field
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __('Email', 'corporate-landing-page' ),
        'description'   =>  __( 'Enter your email address here.', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_contact_section',
        'settings'  =>  'corporate_landing_page_contact_email',
        'default'   =>  __('Email', 'corporate-landing-page'),
        'type'      =>  'text',
    ) );
    /**
     * Section Subtext
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __( 'Enter a title', 'corporate-landing-page' ),
        'description'   =>  __( 'SubText for this section.', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_contact_section',
        'settings'  =>  'corporate_landing_page_contact_subtext',
        'default'   =>  __('Contact Us to get in touch with our experts.
        ', 'corporate-landing-page'),
        'type'      =>  'textarea',
    ) );

    /**
     * Map code
     */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     =>  __( 'Enter google map embed code', 'corporate-landing-page' ),
        'section'   =>  'corporate_landing_page_contact_section',
        'settings'  =>  'corporate_landing_page_contact_map_code',
        'description'   =>  __('Enter the google map embed code to show your desired location', 'corporate-landing-page'),
        'type'      =>  'code',
        'choices'   =>  array(
            'language'  =>  'html'
        )
    ) );
 }
endif;