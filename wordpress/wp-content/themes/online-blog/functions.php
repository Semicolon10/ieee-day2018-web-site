<?php
/**
 * Online Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Online_Blog
 */

if (!function_exists('online_blog_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function online_blog_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Online Blog, use a find and replace
         * to change 'online-blog' to the name of your theme in all the template files.
         */
        load_theme_textdomain('online-blog', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('online-blog-archive-post', 720, 576, true);


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary Menu', 'online-blog'),
            'social' => esc_html__('Social Menu', 'online-blog'),

        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('online_blog_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
    
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

endif;
add_action('after_setup_theme', 'online_blog_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function online_blog_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('online_blog_content_width', 640);
}

add_action('after_setup_theme', 'online_blog_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function online_blog_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'online-blog'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'online-blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Off-canvas Navigation', 'online-blog'),
        'id' => 'slide-menu',
        'description' => esc_html__('Add widgets here.', 'online-blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    $online_blog_footer_widgets_number = online_blog_get_option('number_of_footer_widget');
    if ($online_blog_footer_widgets_number > 0) {
        register_sidebar(array(
            'name' => esc_html__('Footer Column One', 'online-blog'),
            'id' => 'footer-col-one',
            'description' => esc_html__('Displays items on footer section.', 'online-blog'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
        if ($online_blog_footer_widgets_number > 1) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Two', 'online-blog'),
                'id' => 'footer-col-two',
                'description' => esc_html__('Displays items on footer section.', 'online-blog'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
        }
        if ($online_blog_footer_widgets_number > 2) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Three', 'online-blog'),
                'id' => 'footer-col-three',
                'description' => esc_html__('Displays items on footer section.', 'online-blog'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
        }
    }
}

add_action('widgets_init', 'online_blog_widgets_init');

/**
 * function for google fonts
 */
if (!function_exists('online_blog_fonts_url')) :

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function online_blog_fonts_url()
    {


        $fonts_url = '';
        $fonts     = array();
        $online_blog_primary_font   = online_blog_get_option('primary_font');
        $online_blog_secondary_font = online_blog_get_option('secondary_font');


        $online_blog_fonts   = array();
        $online_blog_fonts[] = $online_blog_primary_font;
        $online_blog_fonts[] = $online_blog_secondary_font;

        $online_blog_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

        $i = 0;
        for ($i = 0; $i < count($online_blog_fonts); $i++) {

            if ('off' !== sprintf(_x('on', '%s font: on or off', 'online-blog'), $online_blog_fonts[$i])) {
                $fonts[] = $online_blog_fonts[$i];
            }

        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;
/**
 * Enqueue scripts and styles.
 */
function online_blog_scripts()
{
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    wp_enqueue_style('jquery-slick', get_template_directory_uri() . '/assets/slick/css/slick' . $min . '.css');
    wp_enqueue_style('simple-line-icons', get_template_directory_uri() . '/assets/simple-line-icons/css/simple-line-icons' . $min . '.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/magnific-popup.css');
    wp_enqueue_style('sidr', get_template_directory_uri().'/assets/sidr/css/jquery.sidr.dark.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/animate/animate.css');
    wp_enqueue_style('online-blog-style', get_stylesheet_uri());
    wp_add_inline_style('online-blog-style', online_blog_trigger_custom_css_action());


    $fonts_url = online_blog_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('online-blog-google-fonts', $fonts_url, array(), null);
    }

    wp_enqueue_script('online-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);
    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/slick/js/slick' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/jquery.magnific-popup' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-match-height', get_template_directory_uri() . '/assets/jquery-match-height/jquery.matchHeight' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-sidr', get_template_directory_uri().'/assets/sidr/js/jquery.sidr'. $min .'.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-wow', get_template_directory_uri() . '/assets/wow/js/wow.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-theia-sticky-sidebar', get_template_directory_uri() . '/assets/theiaStickySidebar/theia-sticky-sidebar' . $min . '.js', array('jquery'), '', true);

    /*For Ajax Load Posts*/
    $args = array(
        'nonce' => wp_create_nonce( 'online-blog-load-more-nonce' ),
        'ajaxurl'   => admin_url( 'admin-ajax.php' ),
    );
    if( is_front_page() ){
        $args['post_type'] = 'post';
    }

    /*Support for custom post types*/
    if( is_post_type_archive() ){
        $args['post_type'] = get_queried_object()->name;
    }
    /**/

    /*Support for categories and taxonomies*/
    if( is_category() || is_tag() || is_tax() ){
        $args['cat'] = get_queried_object()->slug;
        $args['taxonomy'] = get_queried_object()->taxonomy;
        /*Get the associated post type for custom taxonomy*/
        if( is_tax() ){
            global $wp_taxonomies;
            $tax_object = isset( $wp_taxonomies[$args['taxonomy']] ) ? $wp_taxonomies[$args['taxonomy']]->object_type : array();
            $args['post_type'] = array_pop($tax_object);
        }
        /**/
    }
    /**/

    /*Support for search*/
    if( is_search() ){
        $args['search'] = get_search_query();
    }
    /**/

    /*Support for author*/
    if( is_author() ){
        $args['author'] = get_the_author_meta( 'user_nicename' ) ;
    }
    /**/

    /*Support for date archive*/
    if( is_date() ){
        $args['year'] = get_query_var('year');
        $args['month'] = get_query_var('monthnum');
        $args['day'] = get_query_var('day');
    }
    /**/

    wp_enqueue_script('online-blog-script', get_template_directory_uri() . '/js/custom-script.js', array( 'jquery', 'wp-mediaelement'), '', true);
    wp_localize_script( 'online-blog-script', 'onlineVal', $args );


    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'online_blog_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function online_blog_admin_scripts($hook)
{
    if ('widgets.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('online-blog-custom-widgets', get_template_directory_uri() . '/js/widgets.js', array('jquery'), '1.0.0', true);
        wp_enqueue_style('online-custom-admin-style', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0.0');

    }

}

add_action('admin_enqueue_scripts', 'online_blog_admin_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/hooks/front-slider.php';
require get_template_directory() . '/inc/hooks/added-style.php';
require get_template_directory() . '/inc/widgets/widgets.php';
/*layout meta*/
require get_template_directory() . '/inc/layout-meta/layout-meta.php';
/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.5
 */
function online_blog_customizer_control_scripts()
{

    wp_enqueue_style('online-blog-customize-controls', get_template_directory_uri() . '/assets/css/customize-controls.css');

}

add_action('customize_controls_enqueue_scripts', 'online_blog_customizer_control_scripts', 0);