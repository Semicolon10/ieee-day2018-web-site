<?php

/**
 * Theme Options Panel.
 *
 * @package online-blog
 */

$default = online_blog_get_default_theme_options();

// Slider Main Section.
$wp_customize->add_section('slider_section_settings',
	array(
		'title'      => esc_html__('Slider Section', 'online-blog'),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting - show_slider_section.
$wp_customize->add_setting('show_slider_section',
	array(
		'default'           => $default['show_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'online_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control('show_slider_section',
	array(
		'label'    => esc_html__('Enable Slider', 'online-blog'),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting('show_fullwidth_slider_section',
    array(
        'default'           => $default['show_fullwidth_slider_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'online_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_fullwidth_slider_section',
    array(
        'label'    => esc_html__('Enable Fullwidth wrapper', 'online-blog'),
        'section'  => 'slider_section_settings',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);

$wp_customize->add_setting('slider_options_section',
	array(
		'default'           => $default['slider_options_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'online_blog_sanitize_select',
	)
);
$wp_customize->add_control('slider_options_section',
	array(
		'label'          => esc_html__('Select Slider layout', 'online-blog'),
		'section'        => 'slider_section_settings',
		'choices'        => array(
			'main-slider-1' => esc_html__('Full-Width Image Slider', 'online-blog'),
			'main-slider-2'  => esc_html__('Carousel Slider', 'online-blog'),
		),
		'type'     => 'select',
		'priority' => 100,
	)
);
// Setting - drop down category for slider.
$wp_customize->add_setting('select_category_for_slider',
	array(
		'default'           => $default['select_category_for_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(new Online_Blog_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_slider',
		array(
			'label'    => esc_html__('Category For Main slider', 'online-blog'),
			'section'  => 'slider_section_settings',
			'type'     => 'dropdown-taxonomies',
			'taxonomy' => 'category',
			'priority' => 130,
		)));



// Featured Section.
$wp_customize->add_section('featured_section_settings',
    array(
        'title' => esc_html__('Featured Category Options', 'online-blog'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);
// Setting - show_featured_section_section.
$wp_customize->add_setting('show_featured_section_section',
    array(
        'default' => $default['show_featured_section_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'online_blog_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_featured_section_section',
    array(
        'label' => esc_html__('Enable Featured Section', 'online-blog'),
        'section' => 'featured_section_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


//featured section image and url
for ( $i=1; $i <= 3 ; $i++ ) {
        $wp_customize->add_setting( 'title_for_featured_'.$i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( 'title_for_featured_'.$i, array(
            'label'             => esc_html__( 'Title For Intor Section ', 'online-blog' ) . ' - ' . $i ,
            'priority'          =>  '120' . $i,
            'section'           => 'featured_section_settings',
            'type'              => 'text',
            'priority'          => 120,
            )
        );
        $wp_customize->add_setting( 'featured_section_image_'.$i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'online_blog_sanitize_image',
        ) );
        $wp_customize->add_control(
            new WP_Customize_Image_Control( $wp_customize, 'featured_section_image_'.$i,
            array(
            'label'             => esc_html__( 'Upload Image For Featured Section ', 'online-blog' ) . ' - ' . $i ,
            'section'         => 'featured_section_settings',
            'priority'        => 120,
            )
        )
        );
        $wp_customize->add_setting( 'url_for_featured_'.$i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( 'url_for_featured_'.$i, array(
            'label'             => esc_html__( 'URL For Intor Section ', 'online-blog' ) . ' - ' . $i ,
            'priority'          =>  '120' . $i,
            'section'           => 'featured_section_settings',
            'type'              => 'text',
            'priority'          => 120,
            )
        );
    }
// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel',
	array(
		'title'      => esc_html__('Theme Options', 'online-blog'),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);

/*layout management section start */
$wp_customize->add_section('theme_option_section_settings',
	array(
		'title'      => esc_html__('Layout Management', 'online-blog'),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

/*Home Page Layout*/
$wp_customize->add_setting('home_page_content_status',
	array(
		'default'           => $default['home_page_content_status'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'online_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control('home_page_content_status',
	array(
		'label'    => esc_html__('Enable Static Page Content', 'online-blog'),
		'description' 	=> esc_html__( 'Enable content of static front page only, if you have coosen a static page.', 'online-blog' ),
		'section'  => 'static_front_page',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

/*Home Page Layout*/
$wp_customize->add_setting('enable_overlay_option',
	array(
		'default'           => $default['enable_overlay_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'online_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_overlay_option',
	array(
		'label'    => esc_html__('Enable Banner Overlay', 'online-blog'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

/*Global Layout*/
$wp_customize->add_setting('global_layout',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'online_blog_sanitize_select',
	)
);
$wp_customize->add_control('global_layout',
	array(
		'label'          => esc_html__('Global Layout', 'online-blog'),
		'section'        => 'theme_option_section_settings',
		'choices'        => array(
			'right-sidebar' => esc_html__('Content - Primary Sidebar', 'online-blog'),
			'left-sidebar'  => esc_html__('Primary Sidebar - Content', 'online-blog'),
			'no-sidebar'    => esc_html__('No Sidebar', 'online-blog')
		),
		'type'     => 'select',
		'priority' => 170,
	)
);

/*content excerpt in global*/
$wp_customize->add_setting('excerpt_length_global',
    array(
        'default' => $default['excerpt_length_global'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'online_blog_sanitize_positive_integer',
    )
);
$wp_customize->add_control('excerpt_length_global',
    array(
        'label' => esc_html__('Set Global Archive Length', 'online-blog'),
        'section' => 'theme_option_section_settings',
        'type' => 'number',
        'priority' => 175,
        'input_attrs' => array('min' => 1, 'max' => 200, 'style' => 'width: 150px;'),

    )
);

// Setting - read_more_button_text.
$wp_customize->add_setting( 'read_more_button_text',
    array(
        'default'           => $default['read_more_button_text'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'read_more_button_text',
    array(
        'label'    => esc_html__( 'Read More Button Text', 'online-blog' ),
        'section'  => 'theme_option_section_settings',
        'type'     => 'text',
        'priority' => 175,
    )
);


// Pagination Section.
$wp_customize->add_section('pagination_section',
	array(
		'title'      => esc_html__('Pagination Options', 'online-blog'),
		'priority'   => 110,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting('pagination_type',
	array(
		'default'           => $default['pagination_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'online_blog_sanitize_select',
	)
);
$wp_customize->add_control('pagination_type',
	array(
		'label'    => esc_html__('Pagination Type', 'online-blog'),
		'section'  => 'pagination_section',
		'type'     => 'select',
		'choices'  => array(
			'default' => esc_html__('Default (Older / Newer Post)', 'online-blog'),
			'numeric' => esc_html__('Numeric', 'online-blog'),
            'infinite_scroll_load' => esc_html__( 'Infinite Scroll Ajax Load', 'online-blog' ),
            'button_click_load' => esc_html__( 'Button Click Ajax Load', 'online-blog' ),
		),
		'priority' => 100,
	)
);

// Footer Section.
$wp_customize->add_section('footer_section',
	array(
		'title'      => esc_html__('Footer Options', 'online-blog'),
		'priority'   => 130,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting social_content_heading.
$wp_customize->add_setting('number_of_footer_widget',
	array(
		'default'           => $default['number_of_footer_widget'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'online_blog_sanitize_select',
	)
);
$wp_customize->add_control('number_of_footer_widget',
	array(
		'label'    => esc_html__('Number Of Footer Widget', 'online-blog'),
		'section'  => 'footer_section',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => array(
			0         => esc_html__('Disable footer sidebar area', 'online-blog'),
			1         => esc_html__('1', 'online-blog'),
			2         => esc_html__('2', 'online-blog'),
			3         => esc_html__('3', 'online-blog'),
		),
	)
);

// Setting copyright_text.
$wp_customize->add_setting('copyright_text',
	array(
		'default'           => $default['copyright_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('copyright_text',
	array(
		'label'    => esc_html__('Footer Copyright Text', 'online-blog'),
		'section'  => 'footer_section',
		'type'     => 'text',
		'priority' => 120,
	)
);

// Preloader Section.
$wp_customize->add_section('enable_preloader_option',
	array(
		'title'      => __('Preloader Options', 'online-blog'),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting enable_preloader.
$wp_customize->add_setting('enable_preloader',
	array(
		'default'           => $default['enable_preloader'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'online_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_preloader',
	array(
		'label'    => __('Enable Preloader', 'online-blog'),
		'section'  => 'enable_preloader_option',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

// Breadcrumb Section.
$wp_customize->add_section('breadcrumb_section',
	array(
		'title'      => esc_html__('Breadcrumb Options', 'online-blog'),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting('breadcrumb_type',
	array(
		'default'           => $default['breadcrumb_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'online_blog_sanitize_select',
	)
);

$wp_customize->add_control('breadcrumb_type',
	array(
		'label'       => esc_html__('Breadcrumb Type', 'online-blog'),
		'section'     => 'breadcrumb_section',
		'type'        => 'select',
		'choices'     => array(
			'disabled'   => esc_html__('Disabled', 'online-blog'),
			'simple'     => esc_html__('Simple', 'online-blog'),
		),
		'priority' => 100,
	)
);