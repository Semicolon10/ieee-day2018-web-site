<?php
/**
 * Template Name: Full-Width Page
 * 
 * Full Width Page Template
 * 
 * @package corporate-landing-page
 */

get_header(); 
?>
    <div id="content" class="site-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
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
                </div>
            </div>
        </div>
    </div>
<?php 
get_footer();