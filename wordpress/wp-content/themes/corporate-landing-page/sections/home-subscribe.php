<?php
/**
 * Template for the subscribe form
 * 
 * @package corporate-landing-page
 */

if( !get_theme_mod( 'corporate_landing_page_subscription_ed', 1 ) ) {
    return;
}


 if( !function_exists('corporate_landing_page_get_subscribe_details') ) :
    function corporate_landing_page_get_subscribe_details( $inputs ) {
        $details = array();
        $details['section_title'] = get_theme_mod( 'corporate_landing_page_subscription_title', __('Subscribe and stay updated', 'corporate-landing-page') );
        $defimage = get_template_directory_uri().'/img/subscribe.png';
        $details['img'] = get_theme_mod('corporate_landing_page_subscription_image', $defimage);
        $details['form_code'] = get_theme_mod('corporate_landing_page_subscription_form');
        $details['section_sub_text'] = get_theme_mod('corporate_landing_page_subscription_sub_text', __('Subscribe now and receive weekly newsletter with us.','corporate-landing-page'));

        if( !empty( $details ) ) {
            $inputs = $details;
        }

        return $inputs;
    }
endif;
add_filter( 'corporate_landing_page_filter_subscribe', 'corporate_landing_page_get_subscribe_details' );
?>
        <?php 
        $section_details = array();
        $section_details = apply_filters( 'corporate_landing_page_filter_subscribe', $section_details );
        ?>
        <div id ="subscribe" class="subscribe-content-wrapper section">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="subscribe-text">
                                <h2><?php echo esc_html($section_details['section_title']); ?></h2>
                                <p><?php echo esc_html($section_details['section_sub_text']);?></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-wrapper">
                            <?php echo wp_kses_post( $section_details['form_code'] );?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        