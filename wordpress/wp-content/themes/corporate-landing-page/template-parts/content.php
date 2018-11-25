<?php 
/* Main Template file for index page
 * All the content of the posts are displayed through this file
 */

$archive_year  = get_the_time('Y'); 
$archive_month = get_the_time('m'); 
$archive_day   = get_the_time('d');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("post blog-main"); ?>>
    <div class="featured-img">
        <a href="<?php the_permalink();?>"><?php the_post_thumbnail('corporate-landing-page-featured-home'); ?></a>
        
        <div class="caption"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day));?>"><?php echo get_the_date();?></a></div>
    </div>
    <header class="entry-header">
        <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    </header>
    <div class="custom-border"></div>
    <div class="entry-content">
        <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), '20', '...'));?></p>
    </div>
    <footer class="entry-footer">
        <span class="read-more"><a href="<?php the_permalink();?>"><?php echo esc_html('Read More', 'corporate-landing-page' ); ?></a></span>
    </footer>
    <div class="author">
        <article class="post">
            <div class="text-holder">
                <div class="entry-header">
                    <div class="entry-meta">
                        <span class="post-author"><?php echo esc_html__('By', 'corporate-landing-page');?> <?php echo esc_html(get_the_author_meta('display_name'));?>    | <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
                    </div>
                </div>
            </div>
        </article>
    </div>
</article>