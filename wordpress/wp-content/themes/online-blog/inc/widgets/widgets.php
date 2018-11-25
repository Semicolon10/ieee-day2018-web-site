<?php
/**
 * Theme widgets.
 *
 * @package Online Blog
 */

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';

if (!function_exists('online_blog_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function online_blog_load_widgets()
    {

        register_widget('online_blog_widget_social');

        // Recent Post widget.
        register_widget('online_blog_sidebar_widget');

        // Tabbed widget.
        register_widget('online_blog_Tabbed_Widget');

        // Auther widget.
        register_widget('online_blog_Author_Post_widget');

    }
endif;
add_action('widgets_init', 'online_blog_load_widgets');

/*Grid Panel widget*/
if (!class_exists('online_blog_sidebar_widget')) :

    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class online_blog_sidebar_widget extends Online_Blog_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'online_blog_popular_post_widget tm-widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'online-blog'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'online-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'online-blog'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'online-blog'),
                ),
                'enable_discription' => array(
                    'label' => __('Enable Discription:', 'online-blog'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'online-blog'),
                    'description' => __('Number of words', 'online-blog'),
                    'default' => 15,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'online-blog'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 6,
                ),
            );

            parent::__construct('online-blog-popular-sidebar-layout', __('RB: Recent/Popular Post Widget', 'online-blog'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            if ((!empty($params['title'])) || (!empty($params['description']))) {
                echo "<div class='widget-header-wrapper'>";
                if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                }
                echo "</div>";
            }

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            $count = 1;
            ?>
            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="tm-recent-widget">
                <ul class="recent-widget-list">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <li class="full-item clear">
                            <div class="col-row">
                                <div class="col col-four">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'online-blog-460-280');
                                        $url = $thumb['0'];
                                    } else {
                                        $url = get_template_directory_uri() . '/images/no-image.jpg';
                                    }
                                    ?>
                                    <figure class="tm-article">
                                        <div class="tm-article-item">
                                            <div class="article-item-image">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url($url); ?>">
                                                </a>
                                            </div>
                                        </div>
                                    </figure>

                                </div>
                                <div class="col col-six">
                                    <div class="full-item-content">
                                        <h3 class="entry-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>

                                    <div class="full-item-discription">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <div class="post-description">
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <?php
                                                    $excerpt = online_blog_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                        $count++;
                    endforeach; ?>
                </ul>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*tabed widget*/
if (!class_exists('online_blog_Tabbed_Widget')) :

    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class online_blog_Tabbed_Widget extends Online_Blog_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {

            $opts = array(
                'classname' => 'online_blog_widget_tabbed tm-widget',
                'description' => __('Tabbed widget.', 'online-blog'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label' => __('Popular', 'online-blog'),
                    'type' => 'heading',
                ),
                'popular_number' => array(
                    'label' => __('No. of Posts:', 'online-blog'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'enable_discription' => array(
                    'label' => __('Enable Discription:', 'online-blog'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'online-blog'),
                    'description' => __('Number of words', 'online-blog'),
                    'default' => 30,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'recent_heading' => array(
                    'label' => __('Recent', 'online-blog'),
                    'type' => 'heading',
                ),
                'recent_number' => array(
                    'label' => __('No. of Posts:', 'online-blog'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'comments_heading' => array(
                    'label' => __('Comments', 'online-blog'),
                    'type' => 'heading',
                ),
                'comments_number' => array(
                    'label' => __('No. of Comments:', 'online-blog'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
            );

            parent::__construct('online-blog-tabbed', __('RB: Sidebar Tab Widget', 'online-blog'), $opts, array(), $fields);

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);
            $tab_id = 'tabbed-' . $this->number;

            echo $args['before_widget'];
            ?>
            <div class="tab-header clear">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="tab tab-popular active">
                        <span data-href="#<?php echo esc_attr($tab_id); ?>-popular" aria-controls="<?php esc_html_e('Popular', 'online-blog'); ?>" role="tab" data-toggle="tab" class="tab-trigger">
                            <?php esc_html_e('Popular', 'online-blog'); ?>
                        </span>
                    </li>
                    <li class="tab tab-recent">
                        <span data-href="#<?php echo esc_attr($tab_id); ?>-recent" aria-controls="<?php esc_html_e('Recent', 'online-blog'); ?>" role="tab" data-toggle="tab" class="tab-trigger">
                            <?php esc_html_e('Recent', 'online-blog'); ?>
                        </span>
                    </li>
                    <li class="tab tab-comments">
                        <span data-href="#<?php echo esc_attr($tab_id); ?>-comments" aria-controls="<?php esc_html_e('Comments', 'online-blog'); ?>" role="tab" data-toggle="tab" class="tab-trigger">
                            <?php esc_html_e('Comments', 'online-blog'); ?>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab active">
                    <?php $this->render_news('popular', $params); ?>
                </div>
                <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab">
                    <?php $this->render_news('recent', $params); ?>
                </div>
                <div id="<?php echo esc_attr($tab_id); ?>-comments" role="tabpanel" class="tab">
                    <?php $this->render_comments($params); ?>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }

        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params)
        {

            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }

            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows' => true,
                        'orderby' => 'comment_count',
                    );
                    break;

                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows' => true,
                    );
                    break;

                default:
                    break;
            }

            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            ?>

            <ul class="article-item article-list-item article-tabbed-list article-item-left">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <li class="full-item clear">
                        <div class="col-row">
                            <div class="col col-four pull-right">
                                <a href="<?php the_permalink(); ?>" class="news-item-thumb">
                                    <?php if (has_post_thumbnail($post->ID)) : ?>
                                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'online-blog-720-480'); ?>
                                        <?php if (!empty($image)) : ?>
                                            <img src="<?php echo esc_url($image[0]); ?>"/>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/no-image-720x480.jpg'); ?>"/>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="col col-six">

                                <div class="full-item-content">
                                    <h3 class="entry-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <div class="full-item-desc">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <div class="post-description">
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <?php
                                                    $excerpt = online_blog_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .news-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .news-list -->

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

            <?php

        }

        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params)
        {

            $comment_args = array(
                'number' => $params['comments_number'],
                'status' => 'approve',
                'post_status' => 'publish',
            );

            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)) : ?>
            <ul class="article-item article-list-item article-item-left comments-tabbed--list">
                <?php foreach ($comments as $key => $comment) : ?>
                    <li class="article-panel clearfix">
                        <figure class="article-thumbmnail">
                            <?php $comment_author_url = get_comment_author_url($comment); ?>
                            <?php if (!empty($comment_author_url)) : ?>
                                <a href="<?php echo esc_url($comment_author_url); ?>"><?php echo get_avatar($comment, 65); ?></a>
                            <?php else : ?>
                                <?php echo get_avatar($comment, 65); ?>
                            <?php endif; ?>
                        </figure><!-- .comments-thumb -->
                        <div class="comments-content">
                            <?php echo get_comment_author_link($comment); ?>
                            &nbsp;<?php echo esc_html_x('on', 'Tabbed Widget', 'online-blog'); ?>&nbsp;<a
                                    href="<?php echo esc_url(get_comment_link($comment)); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a>
                        </div><!-- .comments-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .comments-list -->
        <?php endif; ?>
            <?php
        }

    }
endif;


/*author widget*/
if (!class_exists('online_blog_Author_Post_widget')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class online_blog_Author_Post_widget extends Online_Blog_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'online_blog_author_widget tm-widget',
                'description' => __('Displays authors details in post.', 'online-blog'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'online-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'author-name' => array(
                    'label' => __('Name:', 'online-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'discription' => array(
                    'label' => __('Description:', 'online-blog'),
                    'type' => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => __('Author Image:', 'online-blog'),
                    'type' => 'image',
                ),
                'url-fb' => array(
                    'label' => __('Facebook URL:', 'online-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tw' => array(
                    'label' => __('Twitter URL:', 'online-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-gp' => array(
                    'label' => __('Googleplus URL:', 'online-blog'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('online-blog-author-layout', __('RB: Author Widget', 'online-blog'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            } ?>

            <!--cut from here-->
            <div class="author-info">
                <div class="author-image">
                    <?php if (!empty($params['image_url'])) { ?>
                        <div class="profile-image bg-image">
                            <img src="<?php echo esc_url($params['image_url']); ?>">
                        </div>
                    <?php } ?>
                </div> <!-- /#author-image -->
                <div class="author-details">
                    <?php if (!empty($params['author-name'])) { ?>
                        <h3 class="author-name"><?php echo esc_html($params['author-name']); ?></h3>
                    <?php } ?>
                    <?php if (!empty($params['discription'])) { ?>
                        <p><?php echo wp_kses_post($params['discription']); ?></p>
                    <?php } ?>
                </div> <!-- /#author-details -->
                <div class="author-social">
                    <?php if (!empty($params['url-fb'])) { ?>
                        <a href="<?php echo esc_url($params['url-fb']); ?>"><i class="meta-icon icon-social-facebook icons"></i></a>
                    <?php } ?>
                    <?php if (!empty($params['url-tw'])) { ?>
                        <a href="<?php echo esc_url($params['url-tw']); ?>"><i class="meta-icon icon-social-twitter icons"></i></a>
                    <?php } ?>
                    <?php if (!empty($params['url-gp'])) { ?>
                        <a href="<?php echo esc_url($params['url-gp']); ?>"><i class="meta-icon icon-social-google icons"></i></a>
                    <?php } ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*author widget*/
if (!class_exists('online_blog_widget_social')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class online_blog_widget_social extends Online_Blog_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'online_blog_social_widget tm-widget',
                'description' => __('Displays social menu if you have set it(social menu)', 'online-blog'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'online-blog'),
                    'description' => __('Note: Displays social menu if you have set it(social menu)', 'online-blog'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('online-blog-social-layout', __('RB: Social Menu Widget', 'online-blog'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if ((!empty($params['title'])) || (!empty($params['description']))) {
                echo "<div class='widget-header-wrapper'>";
                if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                }
                echo "</div>";
            } ?>

            <!--cut from here-->
            <div class="social-widget-menu">
                <?php
                if (has_nav_menu('social')) {
                    wp_nav_menu(array(
                        'theme_location' => 'social',
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after' => '</span>',
                    ));
                } ?>
            </div>
            <?php if (!has_nav_menu('social')) : ?>
            <p>
                <?php esc_html_e('Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'online-blog'); ?>
            </p>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

