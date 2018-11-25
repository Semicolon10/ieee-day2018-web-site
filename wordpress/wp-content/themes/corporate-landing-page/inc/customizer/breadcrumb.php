<?php
/**
 * BreadCrumb Options
 *
 */

function corporate_landing_page_customize_breadcrumb( $config ) {

    Corporate_Landing_Page_Kirki::add_section( 'corporate_landing_page_breadcrumb_section', array(
        'priority'   => 14,
        'capability' => 'edit_theme_options',
        'title'      => __( 'BreadCrumb Settings', 'corporate-landing-page' ),
        'panel' =>  'corporate_main_panel'
    ) );
    
    /** BreadCrumb */
    Corporate_Landing_Page_Kirki::add_field( 'corporate_landing_page', array(
        'label'     => __( 'Breadcrumb', 'corporate-landing-page' ),
        'section'   => 'corporate_landing_page_breadcrumb_section',
        'settings'  => 'corporate_landing_page_ed_breadcrumb',
        'type'      => 'toggle',
        'default'   => '1',
    ) );

}
add_action( 'kirki_config', 'corporate_landing_page_customize_breadcrumb' );