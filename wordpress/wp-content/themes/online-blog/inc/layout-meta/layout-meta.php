<?php
/**
 * Implement theme metabox.
 *
 * @package online-blog
 */

if ( ! function_exists( 'online_blog_add_theme_meta_box' ) ) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function online_blog_add_theme_meta_box() {

        $apply_metabox_post_types = array( 'post', 'page' );

        foreach ( $apply_metabox_post_types as $key => $type ) {
            add_meta_box(
                'online-blog-theme-settings',
                esc_html__( 'Single Page/Post Settings', 'online-blog' ),
                'online_blog_render_theme_settings_metabox',
                $type
            );
        }

    }

endif;

add_action( 'add_meta_boxes', 'online_blog_add_theme_meta_box' );

if ( ! function_exists( 'online_blog_render_theme_settings_metabox' ) ) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function online_blog_render_theme_settings_metabox( $post, $metabox ) {

        $post_id = $post->ID;
        $online_blog_post_meta_value = get_post_meta($post_id);

        // Meta box nonce for verification.
        wp_nonce_field( basename( __FILE__ ), 'online_blog_meta_box_nonce' );
        // Fetch Options list.
        $page_layout = get_post_meta($post_id,'online-blog-meta-select-layout',true);

        ?>
        <div id="online-blog-settings-metabox-container" class="online-blog-settings-metabox-container">
            <div id="online-blog-settings-metabox-tab-layout">
                <h4><?php echo __( 'Layout Settings', 'online-blog' ); ?></h4>
                <div class="online-blog-row-content">
                    <!-- Select Field-->
                                        <p>
                    <div class="online-blog-row-content">
                        <label for="online-blog-meta-checkbox">
                            <input type="checkbox" name="online-blog-meta-checkbox" id="online-blog-meta-checkbox"
                                   value="yes" <?php if (isset ($online_blog_post_meta_value['online-blog-meta-checkbox'])) checked($online_blog_post_meta_value['online-blog-meta-checkbox'][0], 'yes'); ?> />
                            <?php _e('Check To Dissable Featured Image on Single Page/Post', 'online-blog') ?>
                        </label>
                    </div>
                    </p>
                    <p>
                        <label for="online-blog-meta-select-layout" class="online-blog-row-title">
                            <?php _e( 'Single Page/Post Layout', 'online-blog' )?>
                        </label>
                        <select name="online-blog-meta-select-layout" id="online-blog-meta-select-layout">
                            <option value="left-sidebar" <?php selected('left-sidebar',$page_layout);?>>
                                <?php _e( 'Primary Sidebar - Content', 'online-blog' )?>
                            </option>
                            <option value="right-sidebar" <?php selected('right-sidebar',$page_layout);?>>
                                <?php _e( 'Content - Primary Sidebar', 'online-blog' )?>
                            </option>
                            <option value="no-sidebar" <?php selected('no-sidebar',$page_layout);?>>
                                <?php _e( 'No Sidebar', 'online-blog' )?>
                            </option>
                        </select>
                    </p>
                </div><!-- .online-blog-row-content -->
            </div><!-- #online-blog-settings-metabox-tab-layout -->
        </div><!-- #online-blog-settings-metabox-container -->

        <?php
    }

endif;



if ( ! function_exists( 'online_blog_save_theme_settings_meta' ) ) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function online_blog_save_theme_settings_meta( $post_id, $post ) {

        // Verify nonce.
        if ( ! isset( $_POST['online_blog_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['online_blog_meta_box_nonce'], basename( __FILE__ ) ) ) {
            return; }

        // Bail if auto save or revision.
        if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
            return;
        }

        // Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
        if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
            return;
        }

        // Check permission.
        if ( 'page' === $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return; }
        } else if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        $online_blog_meta_checkbox = isset($_POST['online-blog-meta-checkbox']) ? esc_attr($_POST['online-blog-meta-checkbox']) : '';
        update_post_meta($post_id, 'online-blog-meta-checkbox', sanitize_text_field($online_blog_meta_checkbox));


        $online_blog_meta_select_layout =  isset( $_POST[ 'online-blog-meta-select-layout' ] ) ? esc_attr($_POST[ 'online-blog-meta-select-layout' ]) : '';
        if(!empty($online_blog_meta_select_layout)){
            update_post_meta($post_id, 'online-blog-meta-select-layout', sanitize_text_field($online_blog_meta_select_layout));
        }
    }

endif;

add_action( 'save_post', 'online_blog_save_theme_settings_meta', 10, 2 );