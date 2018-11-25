<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online_Blog
 */
$global_layout = online_blog_get_option( 'global_layout' );
if ( $post && is_singular() ) {
    $post_options = get_post_meta( $post->ID, 'online-blog-meta-select-layout', true );
    if ( empty( $post_options ) ) {
        $global_layout = esc_attr( online_blog_get_option('global_layout') );
    } else{
        $global_layout = esc_attr($post_options);
    }
}
if ($global_layout == 'no-sidebar') {
    return;
}
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="theiaStickySidebar">
	    <?php dynamic_sidebar('sidebar-1'); ?>
	</div>
</aside><!-- #secondary -->
