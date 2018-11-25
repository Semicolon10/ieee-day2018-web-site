<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Online_Blog
 */

?>
<?php if (has_excerpt()) { 
    $online_blog_article_class = "with-excerpt"; 
} else {
    $online_blog_article_class = "no-excerpt"; 
}?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-mh="article-group">
    <div class="article-wrapper article-wrapper-flex <?php echo esc_attr($online_blog_article_class); ?> ">
        <?php if (has_post_thumbnail()) { ?>
        <div class="column">
            <figure class="reveal-effect se2-white wow main-image">
                <?php the_post_thumbnail( 'online-blog-archive-post'); ?>
            </figure>
            <?php if (has_excerpt()) { ?>
                <div class="reveal-effect se2-white wow sub-excerpt font-family-1">
                    <?php the_excerpt(); ?>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="column bg1 wow fadeInRight">
            <div class="contenty">
                <header class="entry-header">
                    <?php
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

                    if ('post' === get_post_type()) :
                        ?>
                        <div class="entry-meta">
                            <?php online_blog_posted_on();

                            online_blog_entry_footer();
                            ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="entry-content">
                    <?php
                    $online_blog_excerpt_content = absint(online_blog_get_option('excerpt_length_global'));
                    $excerpt = online_blog_words_count($online_blog_excerpt_content, get_the_content());
                    echo wp_kses_post(wpautop($excerpt));
                    ?>
                    <?php $read_more_text = esc_html(online_blog_get_option('read_more_button_text')); ?>
                    <a href="<?php the_permalink(); ?>" class="read-more">
                        <?php echo esc_html($read_more_text); ?> <i class="ion-ios-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>