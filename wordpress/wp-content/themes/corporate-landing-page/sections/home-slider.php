<?php
/**
 * Template part for displaying slider on custom homepage.
 *
 * @package corporate-landing-page
 */

 if( !get_theme_mod( 'corporate_landing_page_ed_slider_settings', 1 ) ) {
     return;
 }

   /** If slider type is category */
        $button = get_theme_mod( 'corporate_landing_page_slider_button_text', __('Read More', 'corporate-landing-page') );
        $corporate_landing_page_slider_cat = array(get_theme_mod( 'corporate_landing_page_slider_categories' ));
        $args = array(
           'posts_per_page'	=>	6,
           'cat'    =>  $corporate_landing_page_slider_cat
        );
?>
        <div id="slider" class="slider">
            <div class="container-fluid">
                 <div class="row">
                    <div class="owl-carousel owl-theme">
                        <?php 
                        $loop = new WP_Query($args); 
                        if( $loop -> have_posts() ) :
                            while( $loop -> have_posts() ) : $loop -> the_post();
                        ?>  
                        <div class="slides">
                            <?php the_post_thumbnail('corporate-landing-page-slider');?>
                            <div class="overlay"></div>
                            <div class="carousel-caption container">
                                <h2><?php the_title(); ?></h2>
                                <p><?php echo esc_html(wp_trim_words( get_the_excerpt(), 10, '...' )); ?></p>
                                <a href="<?php the_permalink();?>" class="btn buy_now"><?php echo esc_html($button);?></a>
                            </div>
                        </div>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>