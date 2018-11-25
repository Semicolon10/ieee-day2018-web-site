<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online_Blog
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="wrapper">
        <?php $online_blog_footer_widgets_number = online_blog_get_option('number_of_footer_widget');
        if (1 == $online_blog_footer_widgets_number) {
            $col = 'col-full';
        } elseif (2 == $online_blog_footer_widgets_number) {
            $col = 'col-half';
        } elseif (3 == $online_blog_footer_widgets_number) {
            $col = 'col-three';
        } elseif (4 == $online_blog_footer_widgets_number) {
            $col = 'col-four';
        } else {
            $col = 'col-three';
        }
        if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) { ?>
            <div class="footer-widget-area">
                <div class="col-row">
                    <?php if (is_active_sidebar('footer-col-one') && $online_blog_footer_widgets_number > 0) : ?>
                        <div class="col <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-one'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-two') && $online_blog_footer_widgets_number > 1) : ?>
                        <div class="col <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-two'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-three') && $online_blog_footer_widgets_number > 2) : ?>
                        <div class="col <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-three'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-four') && $online_blog_footer_widgets_number > 3) : ?>
                        <div class="col <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-four'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php } ?>

        <?php if (has_nav_menu('social')) { ?>
            <div class="footer-social-icon">
                <div class="social-icons">
                    <?php
                    wp_nav_menu(
                        array('theme_location' => 'social',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                            'menu_id' => 'social-menu',
                            'fallback_cb' => false,
                            'menu_class' => false
                        )); ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="site-info">
        <div class="wrapper">
            <?php
                $online_blog_copyright_text = wp_kses_post(online_blog_get_option('copyright_text'));
                if (!empty ($online_blog_copyright_text)) {
                    echo wp_kses_post(online_blog_get_option('copyright_text'));
                }
            ?>
            <span class="sep"> | </span>
            <?php
            define('online_blog_CREDIT','https://thememattic.com','online-blog');
            echo esc_html__('Theme : Online Blog By ','online-blog')."<a href=".esc_url(online_blog_CREDIT)." target='_blank'>".esc_html__('Thememattic Team','online-blog')."</a>";
            ?>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->
<a id="scroll-up">
    <span>
        <strong><?php esc_html_e('Back To Top', 'online-blog'); ?></strong> <i class="icon-arrow-right-circle icons"></i>
    </span>
</a>


<?php if (is_active_sidebar('slide-menu')) : ?>
    <div id="sidr-nav">
        <div class="sidr-header">
            <div class="sidr-right">
                <a class="sidr-class-sidr-button-close" href="#sidr-nav">
                    <span class="screen-reader-text"><?php esc_html_e('Close', 'online-blog');?></span>
                    <i class="thememattic-icon icon-close"></i>
                </a>
            </div>
        </div>
        <?php dynamic_sidebar('slide-menu'); ?>
        <?php if (has_nav_menu('social')) { ?>
            <div class="tm-social-share">
                <div class="social-icons">
                    <?php
                    wp_nav_menu(
                        array('theme_location' => 'social',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                            'menu_id' => 'social-menu',
                            'fallback_cb' => false,
                            'menu_class' => false
                        )); ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
