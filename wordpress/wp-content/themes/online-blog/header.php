<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online_Blog
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ((online_blog_get_option('enable_preloader')) == 1) { ?>
    <div class="preloader">
        <div class="loader">
            <div></div>
        </div>
        <svg aria-hidden="true" role="img">
            <defs>
                <filter id="goo">
                    <fegaussianblur in="SourceGraphic" stddeviation="15" result="blur"></fegaussianblur>
                    <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 26 -7" result="goo"></fecolormatrix>
                    <feblend in="SourceGraphic" in2="goo"></feblend>
                </filter>
            </defs>
        </svg>
    </div>
<?php } ?>
<?php
    $online_blog_enable_banner_overlay = online_blog_get_option('enable_overlay_option');
    if ( $online_blog_enable_banner_overlay == 1 ){
        $online_blog_header_overlay = "data-bg-overlay";
    } else {
        $online_blog_header_overlay = "data-bg-overlay";
    }
?>
<div id="page" class="site ">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'online-blog'); ?></a>
    <?php $online_blog_header_image = get_header_image(); ?>
    <header id="masthead" class="site-header">
        <div class="wrapper">
            <div class="top-area data-bg <?php echo esc_attr($online_blog_header_overlay); ?>" data-background="<?php echo esc_url($online_blog_header_image); ?>">
                <div class="site-branding">
                    <?php
                    the_custom_logo();
                    if (is_front_page() && is_home()) :
                        ?>
                        <h1 class="site-title font-family-1">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                    <?php
                    else :
                        ?>
                        <p class="site-title font-family-1">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </p>
                    <?php
                    endif;
                    $online_blog_description = get_bloginfo('description', 'display');
                    if ($online_blog_description || is_customize_preview()) :
                        ?>
                        <p class="site-description"><?php echo esc_html($online_blog_description); /* WPCS: xss ok. */ ?></p>
                    <?php endif; ?>
                </div>
                <div class="banner-overlay"></div>
            </div>
        </div>

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <div class="wrapper">
                <div class="main-bar">
                    <?php if (is_active_sidebar('slide-menu')) {?>
                        <div class="thememattic-sidr">
                            <a id="widgets-nav" class="alt-bgcolor" href="#sidr-nav">
                                    <span class="hamburger hamburger--arrow">
                                          <span class="hamburger-box">
                                            <span class="hamburger-inner">
                                               <small class="screen-reader-text"><?php esc_html_e('Toggle menu', 'online-blog'); ?></small>
                                            </span>
                                          </span>
                                    </span>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="icon-search">
                        <i class="thememattic-icon icon-magnifier"></i>
                    </div>

                    <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                         <span class="screen-reader-text">
                            <?php esc_html_e('Primary Menu', 'online-blog'); ?>
                        </span>
                        <i class="ham"></i>
                    </span>
                    <?php
                    if (has_nav_menu( 'menu-1' )) {
                        wp_nav_menu(array(
                            'theme_location' => 'menu-1',
                            'menu_id' => 'primary-menu',
                            'container' => 'div',
                            'container_class' => 'menu',
                            'depth'             => 3,
                            'walker'       => new Online_Blog_Walker_Nav_Menu()
                        ));
                    } else {
                    wp_nav_menu(array(
                        'menu_id' => 'primary-menu',
                        'container' => 'div',
                        'container_class' => 'menu',
                        'depth'             => 3,
                    ));
                    } ?>
                </div>
            </div>
        </nav>
    </header>

    <div class="popup-search">
        <div class="table-align">
            <div class="table-align-cell">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="close-popup"></div>
    </div>

    <?php
    if (is_front_page() || is_home()) {
        /**
         * online_blog_action_front_page hook
         * @since perfect-magazine 0.0.2
         *
         * @hooked online_blog_action_banner_slider -  10
         * @sub_hooked online_blog_action_front_page -  10
         */
        do_action('online_blog_action_banner_slider');
        do_action('online_blog_action_featured_post');
    } ?>
    <div id="content" class="site-content">
        <?php if (is_home()) {
        } else { ?>
            <div class="breadcrumb-wrapper">
                <div class="wrapper">
                    <div class="col-row">
                        <?php
                        /**
                         * Hook - online_blog_add_breadcrumb.
                         */
                        do_action('online_blog_action_breadcrumb');
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
