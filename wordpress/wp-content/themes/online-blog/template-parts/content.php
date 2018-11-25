<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Online_Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-mh="article-group">
    <div class="article-wrapper">

        <?php if (!is_single()) { ?>
            <?php online_blog_post_thumbnail(); ?>
        <?php } else {
            $single_image_alignment = get_post_meta($post->ID,'online-blog-meta-checkbox',true);
            if (empty ($single_image_alignment)) {
                online_blog_post_thumbnail();
            }
        } ?>
        <header class="entry-header">
            <?php
            if (is_singular()) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

            if ('post' === get_post_type()) :
                ?>
                <div class="entry-meta">
                    <?php
                    online_blog_posted_on();
                    if (is_single()) {
                        online_blog_posted_by();
                    }
                     online_blog_entry_footer();
                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->


        <?php if (is_single()) { ?>
            <div class="entry-content">
                <div class = "content-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <?php
                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'online-blog'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'online-blog'),
                    'after' => '</div>',
                ));
                ?>
            </div><!-- .entry-content -->
        <?php } else { ?>
            <div class="entry-content">
                <?php
                the_excerpt();
                ?>  
                <?php 
                    $read_more_text = esc_html(online_blog_get_option('read_more_button_text')); ?>
                    <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html($read_more_text); ?><i class="ion-ios-arrow-right"></i></a>
            </div><!-- .entry-content -->
        <?php } ?>
    </div>
</article>
