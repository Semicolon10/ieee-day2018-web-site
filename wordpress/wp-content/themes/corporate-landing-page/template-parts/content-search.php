<?php 
/* Search Results Template
 * All the search results are displayed through this file
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("post blog-main"); ?>>
    <div class="featured-img">
        <a href="<?php the_permalink();?>"><?php the_post_thumbnail('corporate-landing-page-featured-home'); ?></a>
        <div class="caption"><a href="<?php the_permalink();?>"><?php echo get_the_date();?></a></div>
    </div>
    <header class="entry-header">
        <h2 class="entry-title"><?php the_title();?></h2>
    </header>
    <div class="custom-border"></div>
    <div class="entry-content">
        <?php the_excerpt();?>
    </div>
    <footer class="entry-footer">
        <span class="read-more"><a href="<?php the_permalink($post->ID);?>"><?php echo esc_html('Read More', 'corporate-landing-page' ); ?></a></span>
    </footer>
    <div class="author">
        <article class="post">
            <div class="text-holder">
                <div class="entry-header">
                    <div class="entry-meta">
                        <span class="post-author"><?php echo esc_html__('By', 'corporate-landing-page');?> <?php echo esc_html(get_the_author_meta('display_name'));?>  <?php echo esc_html('|', 'corporate-landing-page' ); ?> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
                    </div>
                </div>
            </div>
        </article>
    </div>
</article>