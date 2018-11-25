<?php
$default = online_blog_get_default_theme_options();

// Add Theme Options Panel.
$wp_customize->add_panel('theme_color_typo',
    array(
        'title' => esc_html__('General settings', 'online-blog'),
        'priority' => 40,
        'capability' => 'edit_theme_options',
    )
);

// font Section.
$wp_customize->add_section('font_typo_section',
    array(
        'title' => esc_html__('Fonts & Typography', 'online-blog'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_color_typo',
    )
);

// font Section.
$wp_customize->add_section('colors',
    array(
        'title' => esc_html__('Color Options', 'online-blog'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_color_typo',
    )
);

// Setting - primary_color.
$wp_customize->add_setting('primary_color',
    array(
        'default' => $default['primary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control('primary_color',
    array(
        'label' => esc_html__('Primary Background Color', 'online-blog'),
        'section' => 'colors',
        'type' => 'color',
        'priority' => 100,
    )
);


// Setting - secondary_color.
$wp_customize->add_setting('secondary_color',
    array(
        'default' => $default['secondary_color'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control('secondary_color',
    array(
        'label' => esc_html__('Secondary Background Color', 'online-blog'),
        'section' => 'colors',
        'type' => 'color',
        'priority' => 100,
    )
);


global $online_blog_google_fonts;

// Setting - primary_font.
$wp_customize->add_setting('primary_font',
    array(
        'default' => $default['primary_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'online_blog_sanitize_select',
    )
);
$wp_customize->add_control('primary_font',
    array(
        'label' => esc_html__('Primary Font', 'online-blog'),
        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $online_blog_google_fonts,
        'priority' => 100,
    )
);

// Setting - secondary_font.
$wp_customize->add_setting('secondary_font',
    array(
        'default' => $default['secondary_font'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'online_blog_sanitize_select',
    )
);
$wp_customize->add_control('secondary_font',
    array(
        'label' => esc_html__('Secondary Font', 'online-blog'),
        'section' => 'font_typo_section',
        'type' => 'select',
        'choices' => $online_blog_google_fonts,
        'priority' => 110,
    )
);