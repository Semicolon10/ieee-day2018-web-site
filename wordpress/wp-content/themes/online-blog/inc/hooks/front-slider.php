<?php
if (!function_exists('online_blog_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since online-blog 1.0.0
     *
     */
    function online_blog_banner_slider()
    {
        if (1 != online_blog_get_option('show_slider_section')) {
            return null;
        }
        $online_blog_slider_category = esc_attr(online_blog_get_option('select_category_for_slider'));
        $online_blog_slider_number = 4;
        ?>
        <?php
        if (1 != online_blog_get_option('show_fullwidth_slider_section')) {
            $fullwidth_slider = '';
        } else {
            $fullwidth_slider = 'main-banner-fullwidth';
        }?>
        <div class="feature-block main-banner <?php echo esc_attr($fullwidth_slider); ?>">
            <div class="wrapper">
                <?php
                $online_blog_banner_slider_args = array(
                    'post_type' => 'post',
                    'cat' => absint($online_blog_slider_category),
                    'ignore_sticky_posts' => true,
                    'posts_per_page' => absint( $online_blog_slider_number ),
                ); ?>
                <?php
                $online_blog_slider_options = esc_attr(online_blog_get_option('slider_options_section'));
                if ( $online_blog_slider_options == 'main-slider-1') {
                    $online_blog_slider_style = 'main-slider-1';
                } else {
                    $online_blog_slider_style = 'main-slider-2';
                }

                 ?>
                <div class="main-slider <?php echo esc_attr($online_blog_slider_style); ?>">
                    <?php
                    $online_blog_banner_slider_post_query = new WP_Query($online_blog_banner_slider_args);
                    if ($online_blog_banner_slider_post_query->have_posts()) :
                        while ($online_blog_banner_slider_post_query->have_posts()) : $online_blog_banner_slider_post_query->the_post();
                            if(has_post_thumbnail()){
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                $url = $thumb['0'];
                            }
                            global $post;
                            $author_id = $post->post_author;
                            ?>
                            <figure class="slick-item">
                                <a href="<?php the_permalink(); ?>" class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>">
                                </a>
                                <figcaption class="slider-figcaption">
                                    <div class="slider-wrapper">
                                        <h2 class="slide-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="entry-meta">
                                            <?php online_blog_posted_on(); ?>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>

        <?php
    }
endif;
add_action('online_blog_action_banner_slider', 'online_blog_banner_slider', 40);

if (!function_exists('online_blog_featured_section')) :
    /**
     * Featured Section
     *
     * @since online-blog 1.0.0
     *
     */
    function online_blog_featured_section()
    {
        if (1 != online_blog_get_option('show_featured_section_section')) {
            return null;
        }
    ?>
    <section class="section-block section-feature">
        <div class="wrapper">
            <div class="col-row">
                <?php for ($i=1; $i <= 3; $i++) { ?>
                    <div class="col col-sm col-three">
                        <div class="image-block bg-image bg-image-featured">
                            <img src="<?php echo esc_url(online_blog_get_option('featured_section_image_'.$i)); ?>">
                            <h3>
                                <a href="<?php echo esc_url(online_blog_get_option('url_for_featured_'.$i)); ?>">
                                    <span><?php echo esc_html(online_blog_get_option('title_for_featured_'.$i)); ?></span>
                                </a>
                            </h3>
                        </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </section>
    <?php }
endif;
add_action('online_blog_action_featured_post', 'online_blog_featured_section', 20);
