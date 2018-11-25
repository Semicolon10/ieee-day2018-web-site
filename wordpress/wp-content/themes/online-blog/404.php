<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Online_Blog
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="col-sm-8 col-sm-offset-2 site-main pt-40 pb-40" role="main">
		    <section class="error-404 not-found pt-80 pb-80">
		        <div class="page-content text-center">
		            <h2>
		                <?php esc_html_e('404 page not found', 'online-blog'); ?></h2>
		            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try going back to Homepage or a search?', 'online-blog'); ?></p>

		            <?php get_search_form(); ?>

		        </div><!-- .page-content -->
		    </section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
