<?php
/**
 * Template file for the front page google map section
 * 
 * @package corporate-landing-page
 */

if( !get_theme_mod( 'corporate_landing_page_contact_section_ed', 1 ) ) {
    return;
}

$social_links = get_theme_mod('corporate_landing_page_contact_social');
$map_embed = get_theme_mod('corporate_landing_page_contact_map_code');
$section_title = get_theme_mod( 'corporate_landing_page_contact_title', __('Get In Touch', 'corporate-landing-page') );
$section_subtext = get_theme_mod( 'corporate_landing_page_contact_subtext', __('Contact us to get in touch with our experts.', 'corporate-landing-page'));
$address = get_theme_mod('corporate_landing_page_contact_address', __('Some Street-01, Kathmandu, Nepal 44600', 'corporate-landing-page') );
$phone = get_theme_mod('corporate_landing_page_contact_phone', __('(+977) 01 123456789', 'corporate-landing-page'));
$email = get_theme_mod('corporate_landing_page_contact_email', __('info@domain.com', 'corporate-landing-page'));
?> 
        <div id ="contact" class="contact-content-wrapper section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <article class=" post contact-left">
                            <h2 class="section-title"><?php echo esc_html($section_title);?></h2>
                            <div class="line"></div>
                            <p class="section-para"><?php echo esc_html($section_subtext);?></p>
                            <ul class="contacts">
                                <li>
                                    <h3><?php echo esc_html__('Address :', 'corporate-landing-page');?></h3>
                                    <p><?php echo esc_html($address);?></p>
                                </li>
                                <li>
                                    <h3><?php echo esc_html('Phone','corporate-landing-page');?></h3>
                                    <p><?php echo esc_html($phone);?></p>
                                </li>
                                <li>
                                    <h3><?php echo esc_html('Email','corporate-landing-page');?></h3>
                                    <p><?php echo esc_html($email);?></p>
                                </li>
                            </ul>
                            <?php $social = get_theme_mod('corporate_landing_page_ed_social_settings', 0);
                            if($social){?>
                                <?php  
                                do_action( 'corporate_landing_page_social_link' );
                                ?>
                            <?php }?>
                
                    </div>

                    <div class="col-lg-6 col-sm-6">
                        <div class="map-wrapper">
                        <?php
                        $allowedposttags = array (
                            'iframe'    =>  array(
                                'align'       => true,
                                'frameborder' => true,
                                'width'       => true,
                                'sandbox'     => true,
                                'seamless'    => true,
                                'scrolling'   => true,
                                'srcdoc'      => true,
                                'src'         => true,
                                'class'       => true,
                                'id'          => true,
                                'style'       => true,
                                'border'      => true,
                            )
                        );
                        if($map_embed){
                            echo wp_kses($map_embed, $allowedposttags);
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>