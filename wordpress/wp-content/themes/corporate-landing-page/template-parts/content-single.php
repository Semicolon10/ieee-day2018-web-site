<?php
/**
 * Template part for displaying content on single.php.
 *
 * @package corporate-landing-page
 */
$num_comments = get_comments_number(); // get_comments_number returns only a numeric 
?>
<article class="post blog-main">
    <div class="featured-img">
        <?php the_post_thumbnail('corporate-landing-page-featured-home');?>
        <div class="caption">
            <a href="<?php echo esc_url(get_day_link( get_the_date('Y'), get_the_date('m'), get_the_date('d') ));?>">
            <?php echo esc_html( get_the_date('M d, Y') );?>
            </a>
        </div>
    </div>
    <header class="entry-header">
        <h2 class="entry-title"><?php the_title();?></h2>
        <div class="custom-border"></div>
    </header>
    <div class="entry-content">
			<?php 
            the_content(); 
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'corporate-landing-page' ),
                'after'  => '</div>',
            ) );
            
            ?>
    </div>
    <div class="clearfix"></div>
    <div class="author">
        <article class="post">
            <div class="text-holder">
                <div class="entry-header">
                    <div class="entry-meta">
                        <span class="post-author"><?php echo esc_html__('By', 'corporate-landing-page');?> 
                        <?php echo esc_html(get_the_author_meta('display_name'));?> |
                        <?php if ( comments_open() ) {
	                        if ( $num_comments == 0 ) {
		                        $comments = __('No Comments', 'corporate-landing-page');
	                        } elseif ( $num_comments > 1 ) {
		                        $comments = $num_comments . __(' Comments', 'corporate-landing-page');
	                        } else {
		                        $comments = __('1 Comment', 'corporate-landing-page');
                            }
                            echo esc_html($comments);
                        }
                        ?></span>
                    <?php the_tags(); ?>
                    </span>
                    </div>
                </div>
            </div>
        </article>
    </div>
    