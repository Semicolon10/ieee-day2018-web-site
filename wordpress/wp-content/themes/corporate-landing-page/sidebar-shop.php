<?php
/**
 * The sidebar containing the woocommerce widgets
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package corporate-landing-page
 */

if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-sm-768">
	<div id="secondary" class="widget-area widget-right" role="complementary">
		<?php dynamic_sidebar( 'sidebar-shop' ); ?>
	</div>
</div>
