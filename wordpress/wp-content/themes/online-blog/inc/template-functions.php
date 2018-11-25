<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Online_Blog
 */
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function online_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'online_blog_body_classes' );


if (!function_exists('online_blog_body_class')) :

    /**
     * body class.
     *
     * @since 1.0.0
     */
    function online_blog_body_class($online_blog_body_class)
    {
        global $post;
        $global_layout = online_blog_get_option('global_layout');
        $input = '';
        $home_content_status = online_blog_get_option('home_page_content_status');
        if (1 != $home_content_status) {
            $input = 'home-content-not-enabled';
        }
        // Check if single.
        if ($post && is_singular()) {
            $post_options = get_post_meta($post->ID, 'online-blog-meta-select-layout', true);
            if (empty($post_options)) {
                $global_layout = esc_attr(online_blog_get_option('global_layout'));
            } else {
                $global_layout = esc_attr($post_options);
            }
        }
        if ($global_layout == 'left-sidebar') {
            $online_blog_body_class[] = 'left-sidebar ' . esc_attr($input);
        } elseif ($global_layout == 'no-sidebar') {
            $online_blog_body_class[] = 'no-sidebar ' . esc_attr($input);
        } else {
            $online_blog_body_class[] = 'right-sidebar ' . esc_attr($input);

        }
        return $online_blog_body_class;
    }
endif;

add_action('body_class', 'online_blog_body_class');


if (!function_exists('online_blog_excerpt_length')) :

    /**
     * Excerpt length
     *
     * @since  online_blog 1.0.0
     *
     * @param null
     * @return int
     */
    function online_blog_excerpt_length($length)
    {
        if (is_admin() && !wp_doing_ajax()) {
            return $length;
        }
        $excerpt_length = online_blog_get_option('excerpt_length_global');
        if (empty($excerpt_length)) {
            $excerpt_length = $length;
        }
        return absint($excerpt_length);

    }

endif;
add_filter('excerpt_length', 'online_blog_excerpt_length', 999);

function online_blog_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'online_blog_excerpt_more');
/**
 * Returns word count of the sentences.
 *
 * @since online_blog 1.0.0
 */
if (!function_exists('online_blog_words_count')) :
    function online_blog_words_count($length = 25, $online_blog_content = null)
    {
        $length = absint($length);
        $source_content = preg_replace('`\[[^\]]*\]`', '', $online_blog_content);
        $trimmed_content = wp_trim_words($source_content, $length, '');
        return $trimmed_content;
    }
endif;


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function online_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'online_blog_pingback_header' );



if ( ! function_exists( 'online_blog_ajax_pagination' ) ) :
    /**
     * Outputs the required structure for ajax loading posts on scroll and click
     *
     * @since 1.0.0
     * @param $type string Ajax Load Type
     */
    function online_blog_ajax_pagination($type) {
        ?>
        <div class="load-more-posts" data-load-type="<?php echo esc_attr($type);?>">
            <a href="#" class="btn-link btn-link-load">
                <span class="ajax-loader"></span>
                <?php _e('Load More Posts', 'online-blog')?>
                <i class="ion-ios-arrow-right"></i>
            </a>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'online_blog_load_more' ) ) :
    /**
     * Ajax Load posts Callback.
     *
     * @since 1.0.0
     *
     */
    function online_blog_load_more() {

        check_ajax_referer( 'online-blog-load-more-nonce', 'nonce' );

        $output['more_post'] = false;
        $output['content'] = array();

        $args['post_type'] = ( isset( $_GET['post_type']) && !empty($_GET['post_type'] ) ) ? esc_attr( $_GET['post_type'] ) : 'post';
        $args['post_status'] = 'publish';
        $args['paged'] = (int) esc_attr( $_GET['page'] );

        if( isset( $_GET['cat'] ) && isset( $_GET['taxonomy'] ) ){
            $args['tax_query'] = array(
                array(
                    'taxonomy' => esc_attr($_GET['taxonomy']),
                    'field'    => 'slug',
                    'terms'    => array(esc_attr($_GET['cat'])),
                ),
            );
        }

        if( isset($_GET['search']) ){
            $args['s'] = esc_attr( $_GET['search'] );
        }

        if( isset($_GET['author']) ){
            $args['author_name'] = esc_attr( $_GET['author'] );
        }

        if( isset($_GET['year']) || isset($_GET['month']) || isset($_GET['day']) ){

            $date_arr = array();

            if( !empty($_GET['year']) ){
                $date_arr['year'] = (int) esc_attr($_GET['year']);
            }
            if( !empty($_GET['month']) ){
                $date_arr['month'] = (int) esc_attr($_GET['month']);
            }
            if( !empty($_GET['day']) ){
                $date_arr['day'] = (int) esc_attr($_GET['day']);
            }

            if( !empty($date_arr) ){
                $args['date_query'] = array($date_arr);
            }
        }

        $loop = new WP_Query( $args );
        if($loop->max_num_pages > $args['paged']){
            $output['more_post'] = true;
        }
        if ( $loop->have_posts() ):
            while ( $loop->have_posts() ): $loop->the_post();
                ob_start();
                get_template_part('template-parts/content', 'general');
                $output['content'][] = ob_get_clean();
            endwhile;wp_reset_postdata();
            wp_send_json_success($output);
        else:
            $output['more_post'] = false;
            wp_send_json_error($output);
        endif;
        wp_die();
    }
endif;
add_action( 'wp_ajax_online_blog_load_more', 'online_blog_load_more' );
add_action( 'wp_ajax_nopriv_online_blog_load_more', 'online_blog_load_more' );


if (!function_exists('online_blog_custom_posts_navigation')):
/**
 * Posts navigation.
 *
 * @since 1.0.0
 */
function online_blog_custom_posts_navigation() {

    $pagination_type = online_blog_get_option('pagination_type');

    switch ($pagination_type) {

        case 'default':
            the_posts_navigation();
            break;

        case 'numeric':
            the_posts_pagination();
            break;

        case 'infinite_scroll_load':
            online_blog_ajax_pagination('scroll');
            break;
        case 'button_click_load':
            online_blog_ajax_pagination('click');
            break;
        default:
            break;
    }

}
endif;

add_action('online_blog_action_posts_navigation', 'online_blog_custom_posts_navigation');

if ( ! function_exists( 'online_blog_simple_breadcrumb' ) ) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function online_blog_simple_breadcrumb() {

        if ( ! function_exists( 'breadcrumb_trail' ) ) {

            require_once get_template_directory() . '/assets/breadcrumbs/breadcrumbs.php';
        }

        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
        );
        breadcrumb_trail( $breadcrumb_args );

    }

endif;


if ( ! function_exists( 'online_blog_add_breadcrumb' ) ) :

    /**
     * Add breadcrumb.
     *
     * @since 1.0.0
     */
    function online_blog_add_breadcrumb() {

        // Bail if Breadcrumb disabled.
        $breadcrumb_type = online_blog_get_option( 'breadcrumb_type' );
        if ( 'disabled' === $breadcrumb_type ) {
            return;
        }
        // Bail if Home Page.
        if ( is_front_page() || is_home() ) {
            return;
        }
        // Render breadcrumb.
        echo '<div class="col col-sm col-full">';
        switch ( $breadcrumb_type ) {
            case 'simple':
                online_blog_simple_breadcrumb();
            break;

            case 'advanced':
                if ( function_exists( 'bcn_display' ) ) {
                    bcn_display();
                }
            break;

            default:
            break;
        }
        echo '</div><!-- .container -->';
        return;

    }

endif;

add_action( 'online_blog_action_breadcrumb', 'online_blog_add_breadcrumb' , 10 );

if ( class_exists( 'Walker_Nav_Menu' ) ) {
    // For main menu to generate mage menu related elements
    class Online_Blog_Walker_Nav_Menu extends Walker_Nav_Menu {
        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
            if ( ! $element ) {
                return;
            }

            $id_field = $this->db_fields['id'];
            $id       = $element->$id_field;

            //display this element
            $this->has_children = ! empty( $children_elements[$id] );
            if ( isset( $args[0] ) && is_array( $args[0] ) ) {
                $args[0]['has_children'] = $this->has_children; // Back-compat.
            }

            $cb_args = array_merge( array( &$output, $element, $depth ), $args );
            call_user_func_array( array( $this, 'start_el' ), $cb_args );

            // descend only when the depth is right and there are childrens for this element
            if ( ( $max_depth == 0 || ( $max_depth > $depth + 1 ) ) && isset( $children_elements[$id] ) ) {
                if ( ! $this->is_mega_category( $element, $depth ) ) {
                    foreach ( $children_elements[$id] as $child ) {
                        if ( ! isset( $newlevel ) ) {
                            $newlevel = true;
                            //start the child delimiter
                            $cb_args = array_merge( array( &$output, $depth ), $args );
                            call_user_func_array( array( $this, 'start_lvl' ), $cb_args );
                        }
                        $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
                    }
                }
                unset( $children_elements[$id] );
            }
            if ( isset( $newlevel ) && $newlevel ) {
                //end the child delimiter
                $cb_args = array_merge( array( &$output, $depth ), $args );
                call_user_func_array( array( $this, 'end_lvl' ), $cb_args );
            }

            //end this element
            $cb_args = array_merge( array( &$output, $element, $depth ), $args );
            call_user_func_array( array( $this, 'end_el' ), $cb_args );
        }
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $classes = empty( $item->classes ) ? array() : ( array )$item->classes;
            // $depth starts from 0, so 2 means third level
            if ( $depth > 1 ) {
                if ( in_array( 'menu-item-has-children', $classes ) ) {
                    $item->classes = array_diff( $classes, array( 'menu-item-has-children' ) );
                }
            }
            // Support mega menu for first level only
            if ( $depth > 0 ) {
                if ( in_array( 'mega-menu', $classes ) ) {
                    $item->classes = array_diff( $classes, array( 'mega-menu' ) );
                }
            }
            // If is category and has its child category, add class menu-item-has-children
            if ( $this->is_mega_category( $item, $depth ) ) {
                $term_id = $item->object_id;
                $terms = get_terms( array( 'taxonomy' => 'category', 'parent' => $term_id ) );
                if ( ! is_wp_error( $terms ) && ( count( $terms ) > 0 ) ) {
                    $item->classes = array_merge( $classes, array( 'menu-item-has-children' ) );
                };
            }
            parent::start_el( $output, $item, $depth, $args, $id );
        }
        public function end_el( &$output, $item, $depth = 0, $args = array() ) {
            if ( $this->is_mega_category( $item, $depth ) ) { 
                $term_id = $item->object_id;
                $terms = get_terms( array( 'taxonomy' => 'category', 'parent' => $term_id ) );
                $ppp = ( ! is_wp_error( $terms ) && ( count( $terms ) > 0 ) ) ? 3 : 4;
                $query = new WP_Query( array( 'posts_per_page' => $ppp, 'cat' => $term_id, 'offset' => 0 ) );
                if ( $query->have_posts() ) {
                    $output .= '<ul class="sub-menu">';
                    if ( ! is_wp_error( $terms ) && ( count( $terms ) > 0 ) ) {
                        $tmpl = '<li class="sub-cat-list"><ul>%s</ul></li><li class="sub-cat-posts">%s</li>';
                        $cat_list = sprintf(
                            '<li class="current" data-id="cat-%s"><a href="%s">%s</a></li>',
                            $term_id,
                            get_term_link( intval( $term_id ), 'category' ),
                            esc_html__( 'All', 'online-blog' )
                        );
                        $post_list = $this->post_list( $query, '<div class="sub-cat current cat-' . $term_id . '"><ul>', '</ul></div>' );
                        foreach ( $terms as $t ) {
                            $term_id = $t->term_id;
                            $query = new WP_Query( array( 'posts_per_page' => $ppp, 'cat' => $term_id, 'offset' => 0 ) );
                            if ( $query->have_posts() ) {
                                $term_id = $t->term_id;
                                $cat_list .= sprintf( 
                                    '<li data-id="cat-%s"><a href="%s">%s</a></li>',
                                    $term_id,
                                    get_term_link( $t, 'category' ),
                                    $t->name
                                );
                                $post_list .= $this->post_list( $query, '<div class="sub-cat cat-' . $term_id . '"><ul>', '</ul></div>' );
                            }
                        } 
                        $output .= sprintf( $tmpl, $cat_list, $post_list );
                    } else {
                        $output .= $this->post_list( $query );
                    }
                    $output .= '</ul>';
                }
            }
            parent::end_el( $output, $item, $depth, $args );
        }   
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }
            $indent = str_repeat( $t, $depth );
            $output .= "{$n}{$indent}<ul class=\"sub-menu\">{$n}";
        }
        private function is_mega_category( $item, $depth ) {
            return in_array( 'mega-menu', ( array )$item->classes ) && ( $depth == 0 ) && ( $item->object == 'category' );
        }
        private function post_list( $query, $before = '', $after = '' ) {
            ob_start();
            print( $before );
            while ( $query->have_posts() ) : $query->the_post();
                $has_thumbnail = has_post_thumbnail();
                $link = get_permalink(); ?>
                <li>
                    <div class="post mega-menu-post<?php if ( $has_thumbnail ) { echo ' has-post-thumbnail'; } ?>">
                        <?php if ( $has_thumbnail ) : ?>
                        <figure class="featured-img">
                            <?php the_post_thumbnail('medium'); ?>
                        </figure>
                        <?php endif; ?>
                        <div class="post-content">
                            <div class="post-header">
                                <p class="post-title">
                                    <a href="<?php echo esc_url( $link ); ?>"><?php the_title(); ?></a>
                                </p>
                            </div>
                            <?php $this->show_meta(); ?>
                        </div>
                    </div>
                </li> <?php
            endwhile; 
            wp_reset_postdata();
            print( $after );
            return ob_get_clean();
        }
        private function show_meta() {
            return '';
        }
    }

    // Waler class for fullscreen site header
    class Online_Blog_Walker_Fullscreen_Nav_Menu extends Walker_Nav_Menu {
        /*
         * @description add a wrapper div
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of wp_nav_menu() arguments.
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat( "\t", $depth );
            $wrap = ( $args->theme_location === 'primary' ) 
                ? sprintf( '<button class="dropdown-toggle" aria-expanded="false"><span class="screen-reader-text">%s</span></button>', esc_html__( 'expand child menu', 'online-blog' ) ) : '';
            $output .=  "\n$indent$wrap<ul class=\"sub-menu\">\n";
        }
    }
}
