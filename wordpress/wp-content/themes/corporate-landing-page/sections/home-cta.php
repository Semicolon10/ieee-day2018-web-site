<?php  
/**
 * 
 * Call to Action Section Displayed in Homepage Template
 *
 * @package corporate-landing-page
 * 
 **/

if( !get_theme_mod( 'corporate_landing_page_homepage_banner_ed', 1 ) ) {
    return;
}

if( !function_exists('corporate_landing_page_get_homepage_banner') ) :
    /**
     * Filter function for homepage banner
     */
    function corporate_landing_page_get_homepage_banner( $input ) {

        $details = array();
        $details['title'] = get_theme_mod( 'corporate_landing_page_homepage_banner_title', __('let\'s work together', 'corporate-landing-page') );
        $details['button_label'] = get_theme_mod( 'corporate_landing_page_homepage_type_button', __('Read More', 'corporate-landing-page') );
        $details['excerpt'] = esc_html( get_theme_mod( 'corporate_landing_page_banner_type_custom', __('Lorem ipsum is the dummy text for print and typesetting industry', 'corporate-landing-page') ) );
        $details['button_link'] = esc_html( get_theme_mod( 'corporate_landing_page_banner_type_custom_button', __('#', 'corporate-landing-page') ) ); 

        if( !empty($details) ) {
            $input = $details;
        }
        return $input;

    }

endif;
add_filter( 'corporate_landing_page_filter_homepage_banner', 'corporate_landing_page_get_homepage_banner' );   

        $section_details = array();
        $section_details = apply_filters( 'corporate_landing_page_filter_homepage_banner', $section_details );
        if( !empty($section_details) ) {
        ?>
        <div id="cta" class="cta-content-wrapper section">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="cta-text">
                                <h2><?php echo esc_html($section_details['title']);?></h2>
                                <p><?php echo esc_html($section_details['excerpt']);?></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <a target="_blank" href="<?php echo esc_url($section_details['button_link']);?>" class="btn cta-btn"><?php echo esc_html($section_details['button_label']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        