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

    // Footer Accent Color
    $wp_customize->add_setting( 'footer_accent_color', array(
        'default'           => '#38bdf8',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_accent_color', array(
        'label'       => __( 'Footer Accent Color', 'clean-theme' ),
        'description' => __( 'Accent color for footer elements', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'priority'    => 5,
    ) ) );

    // Footer Accent Text
    $wp_customize->add_setting( 'footer_accent_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'footer_accent_text', array(
        'label'       => __( 'Footer Accent Text', 'clean-theme' ),
        'description' => __( 'Optional accent text after site name in footer', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'text',
        'priority'    => 6,
    ) );

    // Footer Description
    $wp_customize->add_setting( 'footer_description', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'footer_description', array(
        'label'       => __( 'Footer Description', 'clean-theme' ),
        'description' => __( 'Short description displayed in footer', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'textarea',
        'priority'    => 7,
    ) );

    // Footer Address
    $wp_customize->add_setting( 'footer_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'footer_address', array(
        'label'       => __( 'Address', 'clean-theme' ),
        'description' => __( 'Full address for footer', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'textarea',
        'priority'    => 8,
    ) );

    // Footer Phone
    $wp_customize->add_setting( 'footer_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'footer_phone', array(
        'label'       => __( 'Phone Number', 'clean-theme' ),
        'description' => __( 'Phone number for footer (clickable)', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'text',
        'priority'    => 9,
    ) );

    // Footer Email
    $wp_customize->add_setting( 'footer_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'footer_email', array(
        'label'       => __( 'Email Address', 'clean-theme' ),
        'description' => __( 'Email for footer (clickable)', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'email',
        'priority'    => 10,
    ) );

    // Footer Hours
    $wp_customize->add_setting( 'footer_hours', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'footer_hours', array(
        'label'       => __( 'Working Hours', 'clean-theme' ),
        'description' => __( 'Business hours for footer', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'text',
        'priority'    => 11,
    ) );

    // Footer Copyright Text
    $wp_customize->add_setting( 'footer_copyright_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'footer_copyright_text', array(
        'label'       => __( 'Additional Copyright Text', 'clean-theme' ),
        'description' => __( 'Extra text after copyright (optional)', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'text',
        'priority'    => 20,
    ) );

    // ===== Floating Buttons Section (Updated for FAB) =====
    $wp_customize->add_section( 'clean_floating_buttons_section', array(
        'title'       => __( 'Floating Action Buttons (FAB)', 'clean-theme' ),
        'description' => __( 'Configure floating action buttons with messenger, phone, and form', 'clean-theme' ),
        'panel'       => 'clean_theme_options',
        'priority'    => 45,
    ) );

    // Scroll Button Background Color
    $wp_customize->add_setting( 'fab_scroll_bg_color', array(
        'default'           => '#0ea5e9',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fab_scroll_bg_color', array(
        'label'       => __( 'Scroll to Top Button Color', 'clean-theme' ),
        'description' => __( 'Background color for scroll button', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'priority'    => 10,
    ) ) );

    // FAB Feedback Button Background Color
    $wp_customize->add_setting( 'fab_feedback_bg_color', array(
        'default'           => '#8b5cf6',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fab_feedback_bg_color', array(
        'label'       => __( 'Main FAB Button Color', 'clean-theme' ),
        'description' => __( 'Background color for main feedback button', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'priority'    => 20,
    ) ) );

    // FAB Messenger Link
    $wp_customize->add_setting( 'fab_messenger_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'fab_messenger_link', array(
        'label'       => __( 'Messenger Link', 'clean-theme' ),
        'description' => __( 'Link to messenger (Telegram, WhatsApp, etc.)', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'type'        => 'url',
        'priority'    => 30,
    ) );

    // FAB Messenger Label
    $wp_customize->add_setting( 'fab_messenger_label', array(
        'default'           => __( 'Write us', 'clean-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'fab_messenger_label', array(
        'label'       => __( 'Messenger Button Label', 'clean-theme' ),
        'description' => __( 'Text shown on messenger button', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'type'        => 'text',
        'priority'    => 31,
    ) );

    // FAB Phone
    $wp_customize->add_setting( 'fab_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'fab_phone', array(
        'label'       => __( 'Phone Number', 'clean-theme' ),
        'description' => __( 'Phone number for call button', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'type'        => 'text',
        'priority'    => 32,
    ) );

    // FAB Form Label
    $wp_customize->add_setting( 'fab_form_label', array(
        'default'           => __( 'Form', 'clean-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'fab_form_label', array(
        'label'       => __( 'Form Button Label', 'clean-theme' ),
        'description' => __( 'Text shown on form button', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'type'        => 'text',
        'priority'    => 33,
    ) );

    // Feedback Modal Title
    $wp_customize->add_setting( 'feedback_modal_title', array(
        'default'           => __( 'Request a Call', 'clean-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'feedback_modal_title', array(
        'label'       => __( 'Feedback Modal Title', 'clean-theme' ),
        'description' => __( 'Title for feedback modal window', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'type'        => 'text',
        'priority'    => 40,
    ) );

    // Feedback Modal Subtitle
    $wp_customize->add_setting( 'feedback_modal_subtitle', array(
        'default'           => __( 'Leave your details and we will call you back shortly.', 'clean-theme' ),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'feedback_modal_subtitle', array(
        'label'       => __( 'Feedback Modal Subtitle', 'clean-theme' ),
        'description' => __( 'Subtitle text for feedback modal', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'type'        => 'textarea',
        'priority'    => 41,
    ) );

    // Old settings (keep for backward compatibility)
    $wp_customize->add_setting( 'feedback_popup_title', array(
        'default'           => __( 'Contact Us', 'clean-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'feedback_popup_title', array(
        'label'       => __( '[Old] Feedback Popup Title', 'clean-theme' ),
        'description' => __( 'Title for old feedback popup (deprecated)', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'type'        => 'text',
        'priority'    => 100,
    ) );

    // Show Footer Menu
    $wp_customize->add_setting( 'show_footer_menu', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'show_footer_menu', array(
        'label'       => __( 'Show Footer Menu', 'clean-theme' ),
        'description' => __( 'Display footer navigation menu', 'clean-theme' ),
        'section'     => 'clean_footer_section',
        'type'        => 'checkbox',
        'priority'    => 15,
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
    $accent_color         = get_theme_mod( 'accent_color', '#0073aa' );
    $link_color           = get_theme_mod( 'link_color', '#0073aa' );
    $footer_bg            = get_theme_mod( 'footer_background_color', '#f5f5f5' );
    $font_size            = get_theme_mod( 'base_font_size', 16 );
    $footer_accent_color  = get_theme_mod( 'footer_accent_color', '#38bdf8' );
    
    // FAB colors (new settings)
    $fab_scroll_bg        = get_theme_mod( 'fab_scroll_bg_color', '#0ea5e9' );
    $fab_feedback_bg      = get_theme_mod( 'fab_feedback_bg_color', '#8b5cf6' );
    
    // Old settings (fallback for backward compatibility)
    $scroll_btn_bg        = get_theme_mod( 'scroll_btn_bg_color', $fab_scroll_bg );
    $feedback_btn_bg      = get_theme_mod( 'feedback_btn_bg_color', $fab_feedback_bg );

    $css = '';

    // Accent color
    if ( '#0073aa' !== $accent_color ) {
        $css .= "a:hover, .main-navigation .current-menu-item > a { color: {$accent_color}; }";
    }

    // Link color
    if ( '#0073aa' !== $link_color ) {
        $css .= "a { color: {$link_color}; }";
    }

    // Footer accent color
    if ( '#38bdf8' !== $footer_accent_color ) {
        $css .= ":root { --footer-accent-color: {$footer_accent_color}; }";
    }

    // FAB scroll button background (new)
    if ( '#0ea5e9' !== $fab_scroll_bg ) {
        $css .= ":root { --fab-scroll-bg: {$fab_scroll_bg}; }";
    }

    // FAB feedback button background (new)
    if ( '#8b5cf6' !== $fab_feedback_bg ) {
        $css .= ":root { --fab-feedback-bg: {$fab_feedback_bg}; }";
    }

    // Old scroll button background (backward compatibility)
    if ( '#0ea5e9' !== $scroll_btn_bg && $scroll_btn_bg !== $fab_scroll_bg ) {
        $css .= ":root { --fab-scroll-bg: {$scroll_btn_bg}; }";
    }

    // Old feedback button background (backward compatibility)
    if ( '#8b5cf6' !== $feedback_btn_bg && $feedback_btn_bg !== $fab_feedback_bg ) {
        $css .= ":root { --fab-feedback-bg: {$feedback_btn_bg}; }";
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
