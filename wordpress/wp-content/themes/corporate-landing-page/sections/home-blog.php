<?php
/**
 * 
 * Latest Blog sections to display on homepage template
 * @package corporate-landing-page
 * 
 * */   
if( !get_theme_mod( 'corporate_landing_page_blog_section_ed', 1 ) ) {
    return;
}

$section_title = get_theme_mod( 'corporate_landing_page_blog_section_title', __( 'Latest Blogs', 'corporate-landing-page') );
$cat_id = esc_html( get_theme_mod( 'corporate_landing_page_blog_section_cat' ) );
 $args = array(
    'post_type' => 'post',
    'cat' => $cat_id    ,
    'ignore_sticky_posts' => true,
    'posts_per_page' => 3,
 );
 $loop = new WP_Query( $args );
?>      
        <div id ="blog" class="blog-content-wrapper section">
            <div class="container">
                <div class="row">
                    <div class="wrapper">
                        <div class="title">
                            <h2 class="section-title"><?php echo esc_html($section_title);?> </h2>
                            <div class="line"></div>
                        </div>
                        <?php 
                        if($loop->have_posts()):
                        while($loop->have_posts()):$loop->the_post(); ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <article class="post card-one">
                                <div class="img-holder">
                                    <div class="overlay"></div>
                                    <div class="search-button">
                                        <a href="<?php the_permalink();?>"><i class="fa fa-search"></i></a>
                                    </div>
                                    <a href="<?php the_permalink($post->ID);?>"><?php the_post_thumbnail('corporate-landing-page-featured-two');?></a>
                                </div>
                                <div class="text-holder">
                                    <header class="entry-header">
                                        <div class="entry-meta">
                                            <span class="post-date"><?php echo get_the_date();?></span>
                                        </div>
                                        <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                    </header>
                                </div>
                            </article>
                        </div>
                        <?php endwhile;
                        endif;?>
                    </div>
                </div>
            </div>
        </div>