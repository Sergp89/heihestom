<?php
/**
 * Customizer settings for Clean Theme
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add customizer sections, settings, and controls
 */
function clean_theme_customize_register( $wp_customize ) {

    // ===== Theme Options Panel =====
    $wp_customize->add_panel( 'clean_theme_options', array(
        'title'       => __( 'Theme Options', 'clean-theme' ),
        'description' => __( 'Customize your theme settings', 'clean-theme' ),
        'priority'    => 30,
    ) );

    // ===== Header Section =====
    $wp_customize->add_section( 'clean_header_section', array(
        'title'       => __( 'Header Settings', 'clean-theme' ),
        'description' => __( 'Configure header appearance and behavior', 'clean-theme' ),
        'panel'       => 'clean_theme_options',
        'priority'    => 10,
    ) );

    // Show/Hide Header Widgets
    $wp_customize->add_setting( 'show_header_widgets', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'show_header_widgets', array(
        'label'       => __( 'Show Header Widgets', 'clean-theme' ),
        'description' => __( 'Display widgets in the header area on desktop', 'clean-theme' ),
        'section'     => 'clean_header_section',
        'type'        => 'checkbox',
        'priority'    => 10,
    ) );

    // ===== Colors Section =====
    $wp_customize->add_section( 'clean_colors_section', array(
        'title'    => __( 'Colors', 'clean-theme' ),
        'panel'    => 'clean_theme_options',
        'priority' => 20,
    ) );

    // Accent Color
    $wp_customize->add_setting( 'accent_color', array(
        'default'           => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
        'label'       => __( 'Accent Color', 'clean-theme' ),
        'description' => __( 'Used for links, buttons, and highlights', 'clean-theme' ),
        'section'     => 'clean_colors_section',
        'priority'    => 10,
    ) ) );

    // Link Color
    $wp_customize->add_setting( 'link_color', array(
        'default'           => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
        'label'       => __( 'Link Color', 'clean-theme' ),
        'description' => __( 'Color for all links', 'clean-theme' ),
        'section'     => 'clean_colors_section',
        'priority'    => 20,
    ) ) );

    // Footer Background Color
    $wp_customize->add_setting( 'footer_background_color', array(
        'default'           => '#f5f5f5',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
        'label'       => __( 'Footer Background Color', 'clean-theme' ),
        'description' => __( 'Background color for footer area', 'clean-theme' ),
        'section'     => 'clean_colors_section',
        'priority'    => 30,
    ) ) );

    // ===== Mobile Menu Section =====
    $wp_customize->add_section( 'clean_mobile_menu_section', array(
        'title'       => __( 'Mobile Menu', 'clean-theme' ),
        'description' => __( 'Configure mobile menu behavior', 'clean-theme' ),
        'panel'       => 'clean_theme_options',
        'priority'    => 30,
    ) );

    // Enable Menu Animation
    $wp_customize->add_setting( 'enable_menu_animation', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'enable_menu_animation', array(
        'label'       => __( 'Enable Menu Animation', 'clean-theme' ),
        'description' => __( 'Smooth animation for mobile menu slide-in', 'clean-theme' ),
        'section'     => 'clean_mobile_menu_section',
        'type'        => 'checkbox',
        'priority'    => 10,
    ) );

    // ===== Footer Section =====
    $wp_customize->add_section( 'clean_footer_section', array(
        'title'       => __( 'Footer Settings', 'clean-theme' ),
        'description' => __( 'Configure footer appearance', 'clean-theme' ),
        'panel'       => 'clean_theme_options',
        'priority'    => 40,
    ) );

    // Show Footer Menu
    $wp_customize->add_setting( 'show_footer_menu', array(
        'default'           => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'show_footer_menu', array(
        'label'       => __( 'Show Footer Menu', 'clean-theme' ),
        'description' => __( 'Display footer navigation menu', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'checkbox',
        'priority'    => 10,
    ) );

    // Copyright Text
    $wp_customize->add_setting( 'footer_copyright', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'footer_copyright', array(
        'label'       => __( 'Copyright Text', 'clean-theme' ),
        'description' => __( 'Leave empty to show default copyright', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'textarea',
        'priority'    => 20,
    ) );

    // ===== Typography Section (Optional) =====
    $wp_customize->add_section( 'clean_typography_section', array(
        'title'       => __( 'Typography', 'clean-theme' ),
        'description' => __( 'Basic typography settings', 'clean-theme' ),
        'panel'       => 'clean_theme_options',
        'priority'    => 50,
    ) );

    // Base Font Size
    $wp_customize->add_setting( 'base_font_size', array(
        'default'           => 16,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'base_font_size', array(
        'label'       => __( 'Base Font Size (px)', 'clean-theme' ),
        'description' => __( 'Default font size for body text', 'clean-theme' ),
        'section'     => 'clean_typography_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
        'priority'    => 10,
    ) );
}
add_action( 'customize_register', 'clean_theme_customize_register' );

/**
 * Output customizer CSS
 */
function clean_theme_customizer_css() {
    $accent_color = get_theme_mod( 'accent_color', '#0073aa' );
    $link_color   = get_theme_mod( 'link_color', '#0073aa' );
    $footer_bg    = get_theme_mod( 'footer_background_color', '#f5f5f5' );
    $font_size    = get_theme_mod( 'base_font_size', 16 );

    $css = '';

    // Accent color
    if ( '#0073aa' !== $accent_color ) {
        $css .= "a:hover, .main-navigation .current-menu-item > a { color: {$accent_color}; }";
    }

    // Link color
    if ( '#0073aa' !== $link_color ) {
        $css .= "a { color: {$link_color}; }";
    }

    // Footer background
    if ( '#f5f5f5' !== $footer_bg ) {
        $css .= ".site-footer { background-color: {$footer_bg}; }";
    }

    // Font size
    if ( 16 !== $font_size ) {
        $css .= "body { font-size: {$font_size}px; }";
    }

    // Output inline CSS
    if ( ! empty( $css ) ) {
        wp_add_inline_style( 'clean-theme-style', $css );
    }
}
add_action( 'wp_enqueue_scripts', 'clean_theme_customizer_css', 20 );

/**
 * Sanitize checkbox values
 */
function clean_theme_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
