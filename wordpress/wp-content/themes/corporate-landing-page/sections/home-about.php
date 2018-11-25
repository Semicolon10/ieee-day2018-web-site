<?php
/**
 * Template for homepage about us section
 * 
 * @package corporate-landing-page
 */

if( !get_theme_mod( 'corporate_landing_page_about_section_ed', 1 ) ) {
    return;
}

 if( !function_exists('corporate_landing_page_about_section') ) :
    /**
     * Filter function for abut section
     */
    function corporate_landing_page_about_section( $input ) {

        $details = array();

        /**
         * Fetch Content From Customizer
         */
        $page_id = get_theme_mod( 'corporate_landing_page_about_section_page' ); 
        if( $page_id != '' ) {
            $page_id = get_theme_mod( 'corporate_landing_page_about_section_page' ); 
            $page = get_post( $page_id );
            $content_title = $page -> post_title;
            $content_description = $page -> post_content;
            $content_description = wp_trim_words( $content_description, 80, '...');
            $content_link = get_page_link( $page_id );

            $details['button_label'] = get_theme_mod( 'corporate_landing_page_about_section_button' );
            $details['section_title'] = get_theme_mod( 'corporate_landing_page_about_section_title', __('About', 'corporate-landing-page') );
            $details['content_title'] = $content_title;
            $details['content_description'] = $content_description;
            $details['content_link'] = $content_link;
        }

        if ( ! empty( $details ) ) {
            $input = $details;
        }
        return $input;
    }
endif;
add_filter( 'corporate_landing_page_filter_about_details', 'corporate_landing_page_about_section' );
 
?>       
        
        <div id = "about" class="about-content-wrapper section">
        <?php 
            $section_details = array(); 
            $section_details = apply_filters( 'corporate_landing_page_filter_about_details', $section_details );
            if( !empty( $section_details ) ):
        ?>
            <div class="container">
                <div class="row">   
                    <div class="wrapper">
                        <div class="title">
                            <h2 class="section-title"><?php echo esc_html( $section_details['section_title'] ); ?></h2>
                            <div class="line"></div>
                            <p class="section-para"><?php echo esc_html( $section_details['content_title'] );?></p>
                        </div>
                        <div class="entry-content">
                            <p>
                        <?php echo esc_html( $section_details['content_description'] );?></p>
                        </div>
                        <a target="__blank" href="<?php echo esc_url( $section_details['content_link'] );?>"  class="btn learn"><?php echo esc_html( $section_details['button_label'] );?></a>
                    </div>
                </div>
            </div>
        <?php endif;?>
        </div>