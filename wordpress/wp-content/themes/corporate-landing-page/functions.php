<?php
/**
 * corporate landing page functions and definitions
 * 
 * Do not go gentle into that good night,
 * Old age should burn and rave at close of day;
 * Rage, rage against the dying of the light.
 * 
 * Though wise men at their end know dark is right,
 * Because their words had forked no lightning they
 * Do not go gentle into that good night.
 *  
 * Dylan Thomas, 1914 - 1953
 *   
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    corporate-landing-page
 * @subpackage Functions
 * @author     ThemeThread <support@themethread.com>
 * @copyright  Copyright (c) 2017, ThemeThread
 * @link       https://themethread.com/theme/corporate-landing-page/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package corporate-landing-page
 * 
 */

if ( ! function_exists( 'corporate_landing_page_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function corporate_landing_page_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Corporate Blog, use a find and replace
	 * to change 'corporate-landing-page' to the name of your theme in all the template files.
	 */

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'corporate-landing-page-slider', 1351, 664, true );
	add_image_size( 'corporate-landing-page-featured-two', 360, 237, true );
	add_image_size( 'corporate-landing-page-featured-home', 750, 370, true);
	add_image_size( 'corporate-landing-page-featured-about', 971, 396, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'corporate-landing-page' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'corporate_landing_page_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 45,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	add_theme_support( 'woocommerce' );
}
endif;
add_action( 'after_setup_theme', 'corporate_landing_page_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function corporate_landing_page_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'corporate_landing_page_content_width', 780 );
}
add_action( 'after_setup_theme', 'corporate_landing_page_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function corporate_landing_page_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'corporate-landing-page' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'corporate-landing-page' ),
		'before_widget' => '<aside id= "%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class ="custom-border"></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-1', 'corporate-landing-page' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'corporate-landing-page' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class ="custom-border"></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-2', 'corporate-landing-page' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'corporate-landing-page' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class ="custom-border"></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-3', 'corporate-landing-page' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'corporate-landing-page' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class ="custom-border"></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-4', 'corporate-landing-page' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'corporate-landing-page' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class ="custom-border"></div>',
	) );

	if(corporate_landing_page_woocommerce_activated()) {
		register_sidebar( array(
			'name'          => esc_html__( 'Woocommerce Sidebar', 'corporate-landing-page' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here.', 'corporate-landing-page' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2><div class ="custom-border"></div>',
		) );
	}
}
add_action( 'widgets_init', 'corporate_landing_page_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function corporate_landing_page_scripts() {

	$corporate_landing_page_theme = wp_get_theme();
    $corporate_landing_page_version = $corporate_landing_page_theme['Version'];

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css');
	wp_enqueue_style('jquery-smartmenu-bootstrap', get_template_directory_uri() . '/css/jquery.smartmenus.bootstrap.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
	
	wp_enqueue_style('corporate-landing-page-extra', get_template_directory_uri() . '/css/extra.css');
	wp_enqueue_style('corporate-landing-page-header-layout', get_template_directory_uri() . '/css/header.css', '', $corporate_landing_page_version);
	wp_enqueue_style('corporate-landing-page-style', get_stylesheet_uri());
	
	wp_enqueue_script( 'jquery-bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), $corporate_landing_page_version, true );
	wp_enqueue_script('jquery-smartmenus', get_template_directory_uri(). '/js/jquery.smartmenus.js', array('jquery'), $corporate_landing_page_version, true);
	wp_enqueue_script( 'jquery-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), $corporate_landing_page_version, true );
	wp_enqueue_script('jquery-smartmenus-bootstrap-js', get_template_directory_uri(). '/js/jquery.smartmenus.bootstrap.js', array('jquery'), $corporate_landing_page_version, true);
    

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	 }

	 wp_register_script('corporate-landing-page-custom', get_template_directory_uri().'/js/custom.js', array('jquery'), $corporate_landing_page_version, true);
	 $corporate_landing_page_slider_array = array(
		'animation_in'		=>	esc_attr( get_theme_mod( 'corporate_landing_page_slider_animation_in_settings', '' ) ),
		'animation_out'		=>	esc_attr( get_theme_mod( 'corporate_landing_page_slider_animation_out_settings', '' ) )
	);
	wp_localize_script( 'corporate-landing-page-custom', 'corporate_landing_page_slider_data', $corporate_landing_page_slider_array );

	wp_enqueue_script( 'corporate-landing-page-custom' );

}
add_action( 'wp_enqueue_scripts', 'corporate_landing_page_scripts' );

// Filter to move comment field to bottom 
function corporate_landing_page_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'corporate_landing_page_move_comment_field_to_bottom' );

//Filter to modify comment date
 function corporate_landing_page_comment_date( $date ) {
   $date = date("d M Y");   
   return $date;
 }
add_filter( 'get_comment_date', 'corporate_landing_page_comment_date' ); 

//To remove 'Category: ' from the archive title
function corporate_landing_page_remove_cat( $title ) {
	$title = single_cat_title( '', false );
	return $title;
}
add_filter( 'get_the_archive_title', 'corporate_landing_page_remove_cat' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
 
/**
 * Walker for bootsrap menu
 */
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';
/**
 * Extra Functions for Corporate Landing Page including Breadcrumbs
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Styles from Customizer 
 */
require get_template_directory() . '/inc/style.php';

/**
 * Including Template Functions
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Recommend Kirki
 */
include get_theme_file_path( 'inc/kirki-class/kirki-class-recommend.php' );

/**
 * Kirki Fallback
 */
require get_template_directory() . '/inc/kirki-class/class-corporate-landing-page-kirki.php';

/**
 * Customizer additions.
 */

require get_template_directory() . '/inc/customizer/customizer.php';
/**
 * TGM
 */
require_once get_template_directory() . '/inc/tgm/plugins_recommended.php';

/**
 * woo functions
 */
require_once get_template_directory() . '/inc/woo-functions.php';

