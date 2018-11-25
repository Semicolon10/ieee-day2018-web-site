<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package corporate-landing-page
 */

 /**
 * Check woo commerce
 */
 function corporate_landing_page_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
  }

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function corporate_landing_page_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'corporate_landing_page_pingback_header' );


if ( ! function_exists( 'corporate_landing_page_options_pages' ) ) :
    /**
     * @return array with page id and page title of all pages
     */
    function corporate_landing_page_options_pages() {
        /* Option list of all page */   
        $corporate_landing_page_options_pages = array();
        $corporate_landing_page_options_pages_obj = get_pages('posts_per_page=-1');
        $corporate_landing_page_options_pages[''] = __( 'Choose Page', 'corporate-landing-page' );

        foreach ( $corporate_landing_page_options_pages_obj as $corporate_landing_page_pages ) {
            $corporate_landing_page_options_pages[$corporate_landing_page_pages->ID] = $corporate_landing_page_pages->post_title;
        }

        $output = apply_filters( 'corporate_landing_page_options_pages', $corporate_landing_page_options_pages );

        return $output;
    }
endif;

if( !function_exists('corporate_landing_page_pagination') ) {
    function corporate_landing_page_pagination() {

    $pagination = get_theme_mod( 'corporate_landing_page_pagination_type', 'default' );
    
    switch( $pagination ){
        case 'default': // Default Pagination
        the_posts_navigation();
        break;
        
        case 'numbered': // Numbered Pagination
        
        the_posts_pagination( array(
          'screen_reader_text' => ' ',
          'prev_text' => __( 'Previous', 'corporate-landing-page' ),
          'next_text' => __( 'Next', 'corporate-landing-page' ),
          ) );
        
        break;
        
        default:
        
        the_posts_navigation();
        
        break;
        }   
    }
    }

    /**
    * Query Jetpack activation
    */
function is_jetpack_activated( $gallery = false ){
	if( $gallery ){
        return ( class_exists( 'jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' ) ) ? true : false;
	}else{
        return class_exists( 'jetpack' ) ? true : false;
    }           
}
