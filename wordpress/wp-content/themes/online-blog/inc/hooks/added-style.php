<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package online blog
 */

if (!function_exists('online_blog_trigger_custom_css_action')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
    function online_blog_trigger_custom_css_action()
    {
        $online_blog_enable_banner_overlay = online_blog_get_option('enable_overlay_option');

        global $online_blog_google_fonts;

        $online_blog_primary_color = online_blog_get_option('primary_color');
        $online_blog_secondary_color = online_blog_get_option('secondary_color');
        $online_blog_primary_font = $online_blog_google_fonts[online_blog_get_option('primary_font')];
        $online_blog_secondary_font = $online_blog_google_fonts[online_blog_get_option('secondary_font')];
        $header_text_color = get_header_textcolor();
        ?>
        <style type="text/css">
            <?php
            /* Banner Image */
            if ( $online_blog_enable_banner_overlay == 1 ){
                ?>
            .site .banner-overlay {
                background: #000;
                filter: alpha(opacity=34);
                opacity: 0.34;
            }

            <?php
        }

         if (!empty($online_blog_primary_color) ){
            ?>
            .site .button,
            .site button,
            .site input[type="button"],
            .site input[type="reset"],
            .site input[type="submit"],
            .site .footer-social-icon,
            .site .read-more,
            .site .edit-link a,
            .site .load-more-posts .btn-link,
            .site .icon-search,
            .site .nav-links .page-numbers.current,
            .site .nav-links .page-numbers:hover,
            .site .nav-links .page-numbers:focus,
            .site .sticky .article-wrapper:before,
            .site .main-slider-1 .slider-wrapper {
                background-color: <?php echo esc_html($online_blog_primary_color); ?>;
            }

            @media only screen and (min-width: 992px) {
                .site .main-navigation .menu ul ul {
                    background-color: <?php echo esc_html($online_blog_primary_color); ?>;
                }
            }

            .site .button,
            .site button,
            .site input[type="button"],
            .site input[type="reset"],
            .site input[type="submit"],
            .site .social-icons ul li a:after,
            .site .widget .social-widget-menu ul a:before,
            .site .widget-title,
            .site .widget .tab-header {
                border-color: <?php echo esc_html($online_blog_primary_color); ?>;
            }

            <?php
        }


         if (!empty($online_blog_secondary_color) ){
            ?>
            body .site .slide-icon,
            body .reveal-effect.se2-white:after,
            .site .popup-search .search-form .search-submit{
                background-color: <?php echo esc_html($online_blog_secondary_color); ?>;
            }

            .site .popup-search .search-form .search-submit{
                border-color: <?php echo esc_html($online_blog_secondary_color); ?>;
            }

            body .site a:hover,
            body .site a:focus,
            body .site a:active {
                color: <?php echo esc_html($online_blog_secondary_color); ?>;
            }

            @media only screen and (min-width: 992px) {
                .site .main-navigation .menu ul > li.current-menu-item > a,
                .site .main-navigation .menu ul > li:hover > a,
                .site .main-navigation .menu ul > li:focus > a {
                    background: <?php echo esc_html($online_blog_secondary_color); ?>;
                }

                .site .site-header .main-navigation li.mega-menu > ul.sub-menu > li > a:hover,
                .site .site-header .main-navigation li.mega-menu > ul.sub-menu > li > a:focus,
                .site .site-header .main-navigation li.mega-menu > ul.sub-menu > li > ul li a:hover,
                .site .site-header .main-navigation li.mega-menu > ul.sub-menu > li > ul li a:focus {
                    color: <?php echo esc_html($online_blog_secondary_color); ?>;
                }
            }

            <?php
        }

        if (!empty($header_text_color) ){
            ?>
            .site .site-title a,
            .site .site-description {
                color: # <?php echo esc_attr( $header_text_color ); ?> !important;
            }

            <?php
        }

        if (!empty($online_blog_primary_font) ){
            ?>
            .site h1,
            .site h2,
            .site h3,
            .site h4,
            .site h5,
            .site h6,
            body,
            body button,
            body input,
            body select,
            body textarea,
            .site .article-wrapper-flex .column .sub-excerpt:before {
                font-family: <?php echo esc_html($online_blog_primary_font); ?> !important;
            }

            <?php
        }

        if (!empty($online_blog_secondary_font) ){
            ?>
            body .site .entry-content .content-excerpt,
            body .site .font-family-1 {
                font-family: <?php echo esc_html($online_blog_secondary_font); ?> !important;
            }

            <?php
        }


        ?>
        </style>

    <?php }

endif;