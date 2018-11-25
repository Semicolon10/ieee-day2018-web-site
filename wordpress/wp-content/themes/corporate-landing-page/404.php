<?php
/**
 * The template for displaying all single page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#page
 *
 * @package corporate-landing-page
 */

get_header(); ?>
<div id="content" class="site-content error">
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article class="post error-main">
                    <div class="text-holder">
                        <header class="entry-header">
                            <h2 class="entry-title">
                                <?php echo esc_html__('Error 404!', 'corporate-landing-page');?>
                            </h2>
                        </header>
                        <div class="entry-excerpt">
                            <p>
                                <?php
                                echo esc_html__('Page Not Found', 'corporate-landing-page');
                                ?>
                            </p>
                        </div>
                        <footer class="entry-footer">
                            <a class="btn read" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="arrow">&larr;</span><span class="back">
                                <?php
                                echo esc_html__('Go Back', 'corporate-landing-page');
                                ?>
                            </span></a> 
                        </footer>
                    </div>
                </article>
            </main>
        </div>
    </div>
</div> 
<?php 
get_footer();



