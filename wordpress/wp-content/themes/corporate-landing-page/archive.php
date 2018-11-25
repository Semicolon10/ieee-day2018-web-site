<?php 
get_header();

$colmain = (is_active_sidebar( 'sidebar-1' )) ? 'col-md-8 col-lg-8' : 'col-md-12 col-lg-12';
?>
    <div id="content" class="site-content blog-two">
        <div class="container">
            <div class="row">
                <div id="content" class="site-content">
                    <div class="container">
                        <div class="row">
                            <div class="<?php echo esc_attr($colmain);?> ">
                                <div id="primary" class="content-area">
                                    <main id="main" class="site-main blog-main">
                                    <?php 
                                    if(have_posts()):
                                        while(have_posts()): the_post();
                                        get_template_part('template-parts/content', get_post_format() ); 
                                        endwhile;
                                        echo "<div class='clearfix'></div>";
                                        
                                    else:
                                        get_template_part('template-parts/content' , 'none' );        
                                    endif;
                                    corporate_landing_page_pagination();
                                    ?>
                                        </main>
                                    </div>
                                </div>
                                <?php
                                get_sidebar(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php get_footer();?>
