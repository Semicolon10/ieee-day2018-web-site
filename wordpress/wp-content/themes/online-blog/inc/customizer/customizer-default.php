<?php
/**
 * Default theme options.
 *
 * @package online-blog
 */

if (!function_exists('online_blog_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function online_blog_get_default_theme_options() {

	$defaults = array();

	// Slider Section.
	$defaults['show_slider_section']                    = 1;
	$defaults['show_fullwidth_slider_section']          = 0;
	$defaults['number_of_home_slider']                  = 3;
	$defaults['select_category_for_slider']             = 1;
	$defaults['read_more_button_text'] = esc_html__( 'Continue Reading', 'online-blog' );
	$defaults['slider_options_section']   = 'main-slider-2';
    $defaults['show_featured_section_section']    = 0;
	
	/*layout*/
	$defaults['home_page_content_status'] = 1;
	$defaults['enable_overlay_option']    = 0;
	$defaults['homepage_layout_option']   = 'full-width';
	$defaults['global_layout']            = 'no-sidebar';
	$defaults['excerpt_length_global']    = 35;
	$defaults['pagination_type']          = 'button_click_load';
	$defaults['copyright_text']           = esc_html__('Copyright All right reserved', 'online-blog');
	$defaults['enable_preloader']         = 1;

	$defaults['number_of_footer_widget'] = 3;
	$defaults['breadcrumb_type']         = 'simple';

	/*font and color*/
	$defaults['primary_color']     = '#000000';
	$defaults['secondary_color']   = '#ff424e';
	$defaults['primary_font']      = 'Source+Sans+Pro:400,400italic,600,900,300';
	$defaults['secondary_font']    = 'Oregano:400,400i';

	// Pass through filter.
	$defaults = apply_filters('online_blog_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;
