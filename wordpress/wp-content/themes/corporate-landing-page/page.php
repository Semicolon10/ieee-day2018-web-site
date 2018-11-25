<?php
/**
 * The template for displaying all single page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#page
 *
 * @package corporate-landing-page
 */

get_header(); 
$colmain = (is_active_sidebar( 'sidebar-1' )) ? 'col-md-8 col-lg-8' : 'col-md-12 col-lg-12';
?>
    
    <div id="content" class="site-content">
            <div class="container">
                <div class="row">
                    <div class="<?php echo esc_attr($colmain);?>">
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <?php while ( have_posts() ) : the_post();
                                    get_template_part( 'template-parts/content', 'page');
                                    if ( comments_open() || get_comments_number() ) :
                                        comments_template();
                                    endif;
                                endwhile; // End of the loop.?>
                            </main>
                        </div>
                    </div>
                    <?php 
                    get_sidebar();
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php 
get_footer();



