<?php
/**
 * Template part for displaying content on page.php.
 *
 * @package corporate-landing-page
 */
?>
<article class="post blog-main">
    <?php if(has_post_thumbnail()):?>
    <div class="featured-img">
    <?php the_post_thumbnail('corporate-landing-page-featured-home'); ?>
    </div>
    <?php endif;?>
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
</article>