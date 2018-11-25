<?php
/**
 * Homepage Settings panel on the customizer
 * 
 *  @package corporate-landing-page
 */

add_action( 'kirki_config', 'corporate_landing_page_theme_panel' );
function corporate_landing_page_theme_panel() {
    /**
     * Add a main panel for other panels
     */
    Corporate_Landing_Page_Kirki::add_panel('corporate_main_panel', array(
        'title' =>  esc_attr__( 'Theme Options', 'corporate-landing-page' ),
        'description'   =>  esc_attr__( 'Panel for the custom theme options', 'corporate-landing-page' )
    ));

    /**
     * Homepage Panel
     */
    Corporate_Landing_Page_Kirki::add_panel('corporate_landing_page_homepage_panel', array(
        'title' =>  esc_attr__( 'Theme Homepage Options', 'corporate-landing-page' ),
        'description'   =>  esc_attr__( 'Panel for the Theme homepage', 'corporate-landing-page' ),
        'panel' =>  'corporate_main_panel'
    ));
}

 $custom_sections = array( 
    'slider',
    'about',
    'cta',
    'blog',
    'contact',
    'subscribe',
     );

 foreach( $custom_sections as $section ) {
     get_template_part('inc/customizer/homepage-settings/customize', $section);
 }

 /**
 * Script to jump to corresponding sections in customizer
 */
function corporate_landing_page_customizer_section_locate() {
    wp_enqueue_script( 'corporate-landing-page-sections', get_template_directory_uri().'/inc/js/customizer-admin.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_controls_enqueue_scripts', 'corporate_landing_page_customizer_section_locate' );