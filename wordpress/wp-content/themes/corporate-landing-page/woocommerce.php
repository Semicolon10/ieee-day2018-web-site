<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package corporate-landing-page
 */

get_header(); 

$colmain = (is_active_sidebar( 'sidebar-shop' )) ? 'col-md-8 col-lg-8' : 'col-md-12 col-lg-12';
?>
<div id="content" class="site-content">
    <div class="container">
        <div class="row">	
	        <div id="primary" class="content-area">
		        <main id="main" class="site-main">
		            <?php if (is_woocommerce() || is_shop() || is_product_category() ): ?>
			        <div class="<?php echo esc_attr($colmain); ?>">
		            <?php endif; ?>
                    <?php
                    woocommerce_content();
                    ?>
                    <?php if ( is_woocommerce() || is_shop() || is_product_category() ): ?>
                    </div>
                    <?php endif; ?>
		        </main><!-- #main -->
	        </div><!-- #primary -->
        <?php
            get_sidebar('shop');
        ?>
        </div>
    </div>
</div>
<?php
get_footer();
