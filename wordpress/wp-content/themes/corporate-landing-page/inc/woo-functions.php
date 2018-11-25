<?php
/**
 * Functions related to woo commerce
 * 
 * @package corporate-landing-page
 */
//Remove woo-commerce breadcrumbs
function corporate_landing_page_remove_page_breadcrumbs(){
    if (is_page('shop'))
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}
add_action('template_redirect', 'corporate_landing_page_remove_page_breadcrumbs');