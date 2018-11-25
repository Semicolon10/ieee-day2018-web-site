<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package corporate-landing-page
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-sm-768">
	<div id="secondary" class="widget-area widget-default" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div>
