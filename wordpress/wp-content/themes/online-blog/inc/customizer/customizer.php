<?php
/**
 * online_blog Theme Customizer.
 *
 * @package online_blog
 */

//customizer core option
require get_template_directory() . '/inc/customizer/core-customizer.php';

//customizer 
require get_template_directory() . '/inc/customizer/customizer-default.php';
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function online_blog_customize_register( $wp_customize ) {

	// Load custom customizer functions.
	require get_template_directory() . '/inc/customizer/customizer-function.php';

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'online_blog_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'online_blog_customize_partial_blogdescription',
        ) );
    }
	/*theme option panel details*/
    require get_template_directory() . '/inc/customizer/theme-option.php';
	require get_template_directory() . '/inc/customizer/color-font.php';
// Register custom section types.
    $wp_customize->register_section_type( 'Online_Blog_Customize_Section_Upsell' );

    // Register sections.
    $wp_customize->add_section(
        new Online_Blog_Customize_Section_Upsell(
            $wp_customize,
            'theme_upsell',
            array(
                'title'    => esc_html__( 'Online Blog Pro', 'online-blog' ),
                'pro_text' => esc_html__( 'Upgrade To Pro', 'online-blog' ),
                'pro_url'  => 'http://www.thememattic.com/theme/online-blog-pro/',
                'priority'  => 1,
            )
        )
    );
}
add_action( 'customize_register', 'online_blog_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function online_blog_customize_preview_js() {

	wp_enqueue_script( 'online_blog_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );

}
add_action( 'customize_preview_init', 'online_blog_customize_preview_js' );

function online_blog_customizer_script() {
	wp_enqueue_script( 'online_blog_customize_controls', get_template_directory_uri() . '/js/customizer-admin.js', array( 'customize-controls' ) );
}
add_action( 'customize_controls_enqueue_scripts', 'online_blog_customizer_script',0 );
