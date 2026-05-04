<?php
/**
 * Customizer functionality
 *
 * @package Clean_Theme
 * @since Clean Theme 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description
 */
function clean_theme_customize_register( $wp_customize ) {
    // Site Title & Description
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    
    // Selective refresh for site title
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'clean_theme_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'clean_theme_customize_partial_blogdescription',
        ) );
    }
    
    // ============================================
    // 1. GENERAL SETTINGS
    // ============================================
    $wp_customize->add_panel( 'clean_theme_general_panel', array(
        'title'       => __( 'General Settings', 'clean-theme' ),
        'priority'    => 30,
        'description' => __( 'Configure general theme settings', 'clean-theme' ),
    ) );
    
    // Container Width Section
    $wp_customize->add_section( 'clean_theme_container_section', array(
        'title'    => __( 'Container Width', 'clean-theme' ),
        'panel'    => 'clean_theme_general_panel',
        'priority' => 10,
    ) );
    
    $wp_customize->add_setting( 'container_width', array(
        'default'           => 'boxed',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'container_width', array(
        'label'   => __( 'Container Width', 'clean-theme' ),
        'section' => 'clean_theme_container_section',
        'type'    => 'select',
        'choices' => array(
            'fluid'  => __( 'Fluid (Full Width)', 'clean-theme' ),
            'boxed'  => __( 'Boxed (1200px)', 'clean-theme' ),
            'wide'   => __( 'Wide (1400px)', 'clean-theme' ),
        ),
    ) );
    
    // Smooth Scroll Section
    $wp_customize->add_section( 'clean_theme_scroll_section', array(
        'title'    => __( 'Scroll Settings', 'clean-theme' ),
        'panel'    => 'clean_theme_general_panel',
        'priority' => 20,
    ) );
    
    $wp_customize->add_setting( 'smooth_scroll', array(
        'default'           => true,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'smooth_scroll', array(
        'label'   => __( 'Enable Smooth Scroll', 'clean-theme' ),
        'section' => 'clean_theme_scroll_section',
        'type'    => 'checkbox',
    ) );
    
    // Animations Section
    $wp_customize->add_section( 'clean_theme_animations_section', array(
        'title'    => __( 'Animations', 'clean-theme' ),
        'panel'    => 'clean_theme_general_panel',
        'priority' => 30,
    ) );
    
    $wp_customize->add_setting( 'enable_animations', array(
        'default'           => true,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'enable_animations', array(
        'label'   => __( 'Enable Animations', 'clean-theme' ),
        'section' => 'clean_theme_animations_section',
        'type'    => 'checkbox',
    ) );
    
    // ============================================
    // 2. COLOR SCHEME
    // ============================================
    $wp_customize->add_panel( 'clean_theme_colors_panel', array(
        'title'       => __( 'Color Scheme', 'clean-theme' ),
        'priority'    => 35,
        'description' => __( 'Configure theme colors', 'clean-theme' ),
    ) );
    
    // Color Presets Section
    $wp_customize->add_section( 'clean_theme_color_presets_section', array(
        'title'    => __( 'Color Presets', 'clean-theme' ),
        'panel'    => 'clean_theme_colors_panel',
        'priority' => 10,
    ) );
    
    $wp_customize->add_setting( 'color_scheme', array(
        'default'           => 'light',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'color_scheme', array(
        'label'   => __( 'Color Scheme', 'clean-theme' ),
        'section' => 'clean_theme_color_presets_section',
        'type'    => 'select',
        'choices' => array(
            'light'    => __( 'Light (Default)', 'clean-theme' ),
            'dark'     => __( 'Dark', 'clean-theme' ),
            'minimal'  => __( 'Minimal', 'clean-theme' ),
        ),
    ) );
    
    // Accent Color Section
    $wp_customize->add_section( 'clean_theme_accent_color_section', array(
        'title'    => __( 'Accent Colors', 'clean-theme' ),
        'panel'    => 'clean_theme_colors_panel',
        'priority' => 20,
    ) );
    
    $wp_customize->add_setting( 'color_primary', array(
        'default'           => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_primary', array(
        'label'   => __( 'Primary/Accent Color', 'clean-theme' ),
        'section' => 'clean_theme_accent_color_section',
    ) ) );
    
    // Text Colors Section
    $wp_customize->add_section( 'clean_theme_text_color_section', array(
        'title'    => __( 'Text Colors', 'clean-theme' ),
        'panel'    => 'clean_theme_colors_panel',
        'priority' => 30,
    ) );
    
    $wp_customize->add_setting( 'color_text', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_text', array(
        'label'   => __( 'Body Text Color', 'clean-theme' ),
        'section' => 'clean_theme_text_color_section',
    ) ) );
    
    $wp_customize->add_setting( 'color_heading', array(
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_heading', array(
        'label'   => __( 'Heading Color', 'clean-theme' ),
        'section' => 'clean_theme_text_color_section',
    ) ) );
    
    // Header & Footer Colors Section
    $wp_customize->add_section( 'clean_theme_header_footer_colors_section', array(
        'title'    => __( 'Header & Footer Colors', 'clean-theme' ),
        'panel'    => 'clean_theme_colors_panel',
        'priority' => 40,
    ) );
    
    $wp_customize->add_setting( 'color_header_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_header_bg', array(
        'label'   => __( 'Header Background Color', 'clean-theme' ),
        'section' => 'clean_theme_header_footer_colors_section',
    ) ) );
    
    $wp_customize->add_setting( 'color_footer_bg', array(
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_footer_bg', array(
        'label'   => __( 'Footer Background Color', 'clean-theme' ),
        'section' => 'clean_theme_header_footer_colors_section',
    ) ) );
    
    // ============================================
    // 3. TYPOGRAPHY
    // ============================================
    $wp_customize->add_panel( 'clean_theme_typography_panel', array(
        'title'       => __( 'Typography', 'clean-theme' ),
        'priority'    => 40,
        'description' => __( 'Configure fonts and sizes', 'clean-theme' ),
    ) );
    
    // Font Family Section
    $wp_customize->add_section( 'clean_theme_fonts_section', array(
        'title'    => __( 'Font Families', 'clean-theme' ),
        'panel'    => 'clean_theme_typography_panel',
        'priority' => 10,
    ) );
    
    $wp_customize->add_setting( 'font_body', array(
        'default'           => 'system',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'font_body', array(
        'label'   => __( 'Body Font', 'clean-theme' ),
        'section' => 'clean_theme_fonts_section',
        'type'    => 'select',
        'choices' => array(
            'system'              => __( 'System Fonts', 'clean-theme' ),
            'Roboto'              => 'Roboto',
            'Open+Sans'           => 'Open Sans',
            'Lato'                => 'Lato',
            'Montserrat'          => 'Montserrat',
            'Poppins'             => 'Poppins',
            'Nunito'              => 'Nunito',
            'Raleway'             => 'Raleway',
            'Merriweather'        => 'Merriweather',
            'Playfair+Display'    => 'Playfair Display',
        ),
    ) );
    
    $wp_customize->add_setting( 'font_headings', array(
        'default'           => 'system',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'font_headings', array(
        'label'   => __( 'Headings Font', 'clean-theme' ),
        'section' => 'clean_theme_fonts_section',
        'type'    => 'select',
        'choices' => array(
            'system'              => __( 'System Fonts', 'clean-theme' ),
            'Roboto'              => 'Roboto',
            'Open+Sans'           => 'Open Sans',
            'Lato'                => 'Lato',
            'Montserrat'          => 'Montserrat',
            'Poppins'             => 'Poppins',
            'Nunito'              => 'Nunito',
            'Raleway'             => 'Raleway',
            'Merriweather'        => 'Merriweather',
            'Playfair+Display'    => 'Playfair Display',
        ),
    ) );
    
    // Font Sizes Section
    $wp_customize->add_section( 'clean_theme_font_sizes_section', array(
        'title'    => __( 'Font Sizes', 'clean-theme' ),
        'panel'    => 'clean_theme_typography_panel',
        'priority' => 20,
    ) );
    
    $font_sizes = array(
        'font_size_base'  => array( 'label' => __( 'Base Font Size (px)', 'clean-theme' ), 'default' => 16, 'min' => 12, 'max' => 24 ),
        'font_size_h1'    => array( 'label' => __( 'H1 Size (rem)', 'clean-theme' ), 'default' => 2.5, 'min' => 1.5, 'max' => 4 ),
        'font_size_h2'    => array( 'label' => __( 'H2 Size (rem)', 'clean-theme' ), 'default' => 2, 'min' => 1.25, 'max' => 3 ),
        'font_size_h3'    => array( 'label' => __( 'H3 Size (rem)', 'clean-theme' ), 'default' => 1.75, 'min' => 1, 'max' => 2.5 ),
        'font_size_h4'    => array( 'label' => __( 'H4 Size (rem)', 'clean-theme' ), 'default' => 1.5, 'min' => 1, 'max' => 2 ),
        'font_size_h5'    => array( 'label' => __( 'H5 Size (rem)', 'clean-theme' ), 'default' => 1.25, 'min' => 0.875, 'max' => 1.75 ),
        'font_size_h6'    => array( 'label' => __( 'H6 Size (rem)', 'clean-theme' ), 'default' => 1, 'min' => 0.75, 'max' => 1.5 ),
    );
    
    foreach ( $font_sizes as $setting_id => $args ) {
        $wp_customize->add_setting( $setting_id, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( $setting_id, array(
            'label'       => $args['label'],
            'section'     => 'clean_theme_font_sizes_section',
            'type'        => 'range',
            'input_attrs' => array(
                'min'  => $args['min'],
                'max'  => $args['max'],
                'step' => 0.25,
            ),
        ) );
    }
    
    // ============================================
    // 4. HEADER SETTINGS
    // ============================================
    $wp_customize->add_panel( 'clean_theme_header_panel', array(
        'title'       => __( 'Header Settings', 'clean-theme' ),
        'priority'    => 45,
        'description' => __( 'Configure header layout', 'clean-theme' ),
    ) );
    
    // Logo Position Section
    $wp_customize->add_section( 'clean_theme_logo_position_section', array(
        'title'    => __( 'Logo Position', 'clean-theme' ),
        'panel'    => 'clean_theme_header_panel',
        'priority' => 10,
    ) );
    
    $wp_customize->add_setting( 'logo_position', array(
        'default'           => 'left',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'logo_position', array(
        'label'   => __( 'Logo Position', 'clean-theme' ),
        'section' => 'clean_theme_logo_position_section',
        'type'    => 'select',
        'choices' => array(
            'left'   => __( 'Left', 'clean-theme' ),
            'center' => __( 'Center', 'clean-theme' ),
            'right'  => __( 'Right', 'clean-theme' ),
        ),
    ) );
    
    // Menu Position Section
    $wp_customize->add_section( 'clean_theme_menu_position_section', array(
        'title'    => __( 'Menu Position', 'clean-theme' ),
        'panel'    => 'clean_theme_header_panel',
        'priority' => 20,
    ) );
    
    $wp_customize->add_setting( 'menu_position', array(
        'default'           => 'inline',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'menu_position', array(
        'label'   => __( 'Menu Position', 'clean-theme' ),
        'section' => 'clean_theme_menu_position_section',
        'type'    => 'select',
        'choices' => array(
            'inline' => __( 'Inline with Logo', 'clean-theme' ),
            'below'  => __( 'Below Logo', 'clean-theme' ),
        ),
    ) );
    
    // Header Widgets Section
    $wp_customize->add_section( 'clean_theme_header_widgets_section', array(
        'title'    => __( 'Header Widgets', 'clean-theme' ),
        'panel'    => 'clean_theme_header_panel',
        'priority' => 30,
    ) );
    
    $wp_customize->add_setting( 'header_widgets_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'header_widgets_enabled', array(
        'label'   => __( 'Enable Header Widgets', 'clean-theme' ),
        'section' => 'clean_theme_header_widgets_section',
        'type'    => 'checkbox',
    ) );
    
    $wp_customize->add_setting( 'header_widget_columns', array(
        'default'           => 1,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'header_widget_columns', array(
        'label'       => __( 'Number of Widget Columns', 'clean-theme' ),
        'section'     => 'clean_theme_header_widgets_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 3,
        ),
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'header_widgets_enabled' )->value();
        },
    ) );
    
    // ============================================
    // 5. FOOTER SETTINGS
    // ============================================
    $wp_customize->add_panel( 'clean_theme_footer_panel', array(
        'title'       => __( 'Footer Settings', 'clean-theme' ),
        'priority'    => 50,
        'description' => __( 'Configure footer layout', 'clean-theme' ),
    ) );
    
    // Footer Style Section
    $wp_customize->add_section( 'clean_theme_footer_style_section', array(
        'title'    => __( 'Footer Style', 'clean-theme' ),
        'panel'    => 'clean_theme_footer_panel',
        'priority' => 10,
    ) );
    
    $wp_customize->add_setting( 'footer_style', array(
        'default'           => 'style-1',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'footer_style', array(
        'label'   => __( 'Footer Layout', 'clean-theme' ),
        'section' => 'clean_theme_footer_style_section',
        'type'    => 'select',
        'choices' => array(
            'style-1' => __( 'Style 1: 2 Columns (Logo + Info, Menu)', 'clean-theme' ),
            'style-2' => __( 'Style 2: 3 Columns (Logo, Menu, Contact)', 'clean-theme' ),
            'style-3' => __( 'Style 3: 4 Columns (Full Widget Grid)', 'clean-theme' ),
            'style-4' => __( 'Style 4: Minimal (Centered Copyright + Social)', 'clean-theme' ),
        ),
    ) );
    
    // Footer Options Section
    $wp_customize->add_section( 'clean_theme_footer_options_section', array(
        'title'    => __( 'Footer Options', 'clean-theme' ),
        'panel'    => 'clean_theme_footer_panel',
        'priority' => 20,
    ) );
    
    $wp_customize->add_setting( 'footer_show_copyright', array(
        'default'           => true,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'footer_show_copyright', array(
        'label'   => __( 'Show Copyright', 'clean-theme' ),
        'section' => 'clean_theme_footer_options_section',
        'type'    => 'checkbox',
    ) );
    
    $wp_customize->add_setting( 'footer_show_top_border', array(
        'default'           => true,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'footer_show_top_border', array(
        'label'   => __( 'Show Top Border', 'clean-theme' ),
        'section' => 'clean_theme_footer_options_section',
        'type'    => 'checkbox',
    ) );
    
    // ============================================
    // 6. FLOAT BUTTONS
    // ============================================
    $wp_customize->add_panel( 'clean_theme_float_buttons_panel', array(
        'title'       => __( 'Floating Buttons', 'clean-theme' ),
        'priority'    => 55,
        'description' => __( 'Configure floating action buttons', 'clean-theme' ),
    ) );
    
    // Back to Top Button Section
    $wp_customize->add_section( 'clean_theme_back_to_top_section', array(
        'title'    => __( 'Back to Top Button', 'clean-theme' ),
        'panel'    => 'clean_theme_float_buttons_panel',
        'priority' => 10,
    ) );
    
    $wp_customize->add_setting( 'back_to_top_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'back_to_top_enabled', array(
        'label'   => __( 'Enable Back to Top Button', 'clean-theme' ),
        'section' => 'clean_theme_back_to_top_section',
        'type'    => 'checkbox',
    ) );
    
    $wp_customize->add_setting( 'back_to_top_icon', array(
        'default'           => 'arrow-up',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'back_to_top_icon', array(
        'label'   => __( 'Icon', 'clean-theme' ),
        'section' => 'clean_theme_back_to_top_section',
        'type'    => 'select',
        'choices' => array(
            'arrow-up' => __( 'Arrow Up', 'clean-theme' ),
            'chevron-up' => __( 'Chevron Up', 'clean-theme' ),
            'angle-up' => __( 'Angle Up', 'clean-theme' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'back_to_top_scroll_offset', array(
        'default'           => 500,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'back_to_top_scroll_offset', array(
        'label'       => __( 'Show After Scroll (px)', 'clean-theme' ),
        'section'     => 'clean_theme_back_to_top_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 100,
            'max'  => 2000,
            'step' => 100,
        ),
    ) );
    
    $wp_customize->add_setting( 'back_to_top_bg_color', array(
        'default'           => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'back_to_top_bg_color', array(
        'label'   => __( 'Button Background Color', 'clean-theme' ),
        'section' => 'clean_theme_back_to_top_section',
    ) ) );
    
    // Contact Buttons Group Section
    $wp_customize->add_section( 'clean_theme_contact_buttons_section', array(
        'title'    => __( 'Contact Buttons', 'clean-theme' ),
        'panel'    => 'clean_theme_float_buttons_panel',
        'priority' => 20,
    ) );
    
    $wp_customize->add_setting( 'contact_buttons_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'contact_buttons_enabled', array(
        'label'   => __( 'Enable Contact Buttons', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'checkbox',
    ) );
    
    $wp_customize->add_setting( 'contact_animation', array(
        'default'           => 'fade',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'contact_animation', array(
        'label'   => __( 'Animation Style', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'select',
        'choices' => array(
            'fade'  => __( 'Fade', 'clean-theme' ),
            'slide' => __( 'Slide', 'clean-theme' ),
            'scale' => __( 'Scale', 'clean-theme' ),
        ),
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'contact_buttons_enabled' )->value();
        },
    ) );
    
    // Phone Button
    $wp_customize->add_setting( 'phone_button_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'phone_button_enabled', array(
        'label'   => __( 'Enable Phone Button', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'checkbox',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'contact_buttons_enabled' )->value();
        },
    ) );
    
    $wp_customize->add_setting( 'phone_number', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'phone_number', array(
        'label'   => __( 'Phone Number', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'phone_button_enabled' )->value();
        },
    ) );
    
    $wp_customize->add_setting( 'phone_tooltip', array(
        'default'           => __( 'Call Us', 'clean-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'phone_tooltip', array(
        'label'   => __( 'Tooltip Text', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'phone_button_enabled' )->value();
        },
    ) );
    
    // Messenger Button (Max)
    $wp_customize->add_setting( 'messenger_button_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'messenger_button_enabled', array(
        'label'   => __( 'Enable Messenger Button (Max)', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'checkbox',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'contact_buttons_enabled' )->value();
        },
    ) );
    
    $wp_customize->add_setting( 'messenger_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'messenger_link', array(
        'label'   => __( 'Messenger Link', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'url',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'messenger_button_enabled' )->value();
        },
    ) );
    
    $wp_customize->add_setting( 'messenger_tooltip', array(
        'default'           => __( 'Chat on Max', 'clean-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'messenger_tooltip', array(
        'label'   => __( 'Tooltip Text', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'messenger_button_enabled' )->value();
        },
    ) );
    
    // Contact Form Button
    $wp_customize->add_setting( 'contact_form_button_enabled', array(
        'default'           => false,
        'sanitize_callback' => 'clean_theme_sanitize_checkbox',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'contact_form_button_enabled', array(
        'label'   => __( 'Enable Contact Form Button', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'checkbox',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'contact_buttons_enabled' )->value();
        },
    ) );
    
    $wp_customize->add_setting( 'contact_form_display_type', array(
        'default'           => 'modal',
        'sanitize_callback' => 'clean_theme_sanitize_select',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'contact_form_display_type', array(
        'label'   => __( 'Form Display Type', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'select',
        'choices' => array(
            'modal' => __( 'Modal Window', 'clean-theme' ),
            'panel' => __( 'Side Panel', 'clean-theme' ),
        ),
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'contact_form_button_enabled' )->value();
        },
    ) );
    
    $wp_customize->add_setting( 'contact_form_email', array(
        'default'           => get_option( 'admin_email' ),
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'contact_form_email', array(
        'label'   => __( 'Email Address', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'email',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'contact_form_button_enabled' )->value();
        },
    ) );
    
    $wp_customize->add_setting( 'contact_form_submit_text', array(
        'default'           => __( 'Send Message', 'clean-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'contact_form_submit_text', array(
        'label'   => __( 'Submit Button Text', 'clean-theme' ),
        'section' => 'clean_theme_contact_buttons_section',
        'type'    => 'text',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'contact_form_button_enabled' )->value();
        },
    ) );
    
    // Float Buttons Position Section
    $wp_customize->add_section( 'clean_theme_float_position_section', array(
        'title'    => __( 'Position Settings', 'clean-theme' ),
        'panel'    => 'clean_theme_float_buttons_panel',
        'priority' => 30,
    ) );
    
    $wp_customize->add_setting( 'float_bottom_position', array(
        'default'           => 20,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'float_bottom_position', array(
        'label'       => __( 'Bottom Position (px)', 'clean-theme' ),
        'section'     => 'clean_theme_float_position_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 5,
        ),
    ) );
    
    $wp_customize->add_setting( 'float_right_position', array(
        'default'           => 20,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'float_right_position', array(
        'label'       => __( 'Right Position (px)', 'clean-theme' ),
        'section'     => 'clean_theme_float_position_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 5,
        ),
    ) );
    
    $wp_customize->add_setting( 'float_button_gap', array(
        'default'           => 10,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'float_button_gap', array(
        'label'       => __( 'Gap Between Buttons (px)', 'clean-theme' ),
        'section'     => 'clean_theme_float_position_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 5,
            'max'  => 30,
            'step' => 1,
        ),
    ) );
    
    // ============================================
    // 7. ADDITIONAL OPTIONS
    // ============================================
    $wp_customize->add_panel( 'clean_theme_additional_panel', array(
        'title'       => __( 'Additional Options', 'clean-theme' ),
        'priority'    => 60,
        'description' => __( 'Advanced settings', 'clean-theme' ),
    ) );
    
    // Analytics Section
    $wp_customize->add_section( 'clean_theme_analytics_section', array(
        'title'    => __( 'Analytics Code', 'clean-theme' ),
        'panel'    => 'clean_theme_additional_panel',
        'priority' => 10,
    ) );
    
    $wp_customize->add_setting( 'analytics_code_head', array(
        'default'           => '',
        'sanitize_callback' => 'clean_theme_sanitize_analytics_code',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'analytics_code_head', array(
        'label'       => __( 'Code in <head>', 'clean-theme' ),
        'section'     => 'clean_theme_analytics_section',
        'type'        => 'textarea',
        'description' => __( 'Paste analytics code to be added before </head>', 'clean-theme' ),
    ) );
    
    $wp_customize->add_setting( 'analytics_code_body', array(
        'default'           => '',
        'sanitize_callback' => 'clean_theme_sanitize_analytics_code',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'analytics_code_body', array(
        'label'       => __( 'Code before </body>', 'clean-theme' ),
        'section'     => 'clean_theme_analytics_section',
        'type'        => 'textarea',
        'description' => __( 'Paste analytics code to be added before </body>', 'clean-theme' ),
    ) );
    
    // Custom CSS Section
    $wp_customize->add_section( 'clean_theme_custom_css_section', array(
        'title'    => __( 'Custom CSS', 'clean-theme' ),
        'panel'    => 'clean_theme_additional_panel',
        'priority' => 20,
    ) );
    
    $wp_customize->add_setting( 'custom_css', array(
        'default'           => '',
        'sanitize_callback' => 'wp_strip_all_tags',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'custom_css', array(
        'label'       => __( 'Custom CSS', 'clean-theme' ),
        'section'     => 'clean_theme_custom_css_section',
        'type'        => 'textarea',
        'description' => __( 'Add your custom CSS here', 'clean-theme' ),
    ) );
}
add_action( 'customize_register', 'clean_theme_customize_register' );

/**
 * Render site title partial
 */
function clean_theme_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render site description partial
 */
function clean_theme_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Output Customizer CSS
 */
function clean_theme_customizer_css() {
    $css = '';
    
    // Color variables
    $color_primary = get_theme_mod( 'color_primary', '#0073aa' );
    $color_text = get_theme_mod( 'color_text', '#333333' );
    $color_heading = get_theme_mod( 'color_heading', '#1a1a1a' );
    $color_header_bg = get_theme_mod( 'color_header_bg', '#ffffff' );
    $color_footer_bg = get_theme_mod( 'color_footer_bg', '#1a1a1a' );
    
    if ( $color_primary !== '#0073aa' ) {
        $css .= ':root { --ct-color-primary: ' . esc_attr( $color_primary ) . '; }';
    }
    
    if ( $color_text !== '#333333' ) {
        $css .= ':root { --ct-color-text: ' . esc_attr( $color_text ) . '; }';
    }
    
    if ( $color_heading !== '#1a1a1a' ) {
        $css .= ':root { --ct-color-heading: ' . esc_attr( $color_heading ) . '; }';
    }
    
    if ( $color_header_bg !== '#ffffff' ) {
        $css .= ':root { --ct-color-header-bg: ' . esc_attr( $color_header_bg ) . '; }';
    }
    
    if ( $color_footer_bg !== '#1a1a1a' ) {
        $css .= ':root { --ct-color-footer-bg: ' . esc_attr( $color_footer_bg ) . '; }';
    }
    
    // Typography
    $font_body = get_theme_mod( 'font_body', 'system' );
    $font_headings = get_theme_mod( 'font_headings', 'system' );
    
    if ( $font_body !== 'system' ) {
        $css .= ':root { --ct-font-base: "' . esc_attr( $font_body ) . '", sans-serif; }';
    }
    
    if ( $font_headings !== 'system' ) {
        $css .= ':root { --ct-font-headings: "' . esc_attr( $font_headings ) . '", sans-serif; }';
    }
    
    // Font sizes
    $font_size_base = get_theme_mod( 'font_size_base', 16 );
    if ( $font_size_base !== 16 ) {
        $css .= ':root { --ct-font-size-base: ' . absint( $font_size_base ) . 'px; }';
    }
    
    $font_sizes = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
    foreach ( $font_sizes as $size ) {
        $mod_name = 'font_size_' . $size;
        $default = array( 'h1' => 2.5, 'h2' => 2, 'h3' => 1.75, 'h4' => 1.5, 'h5' => 1.25, 'h6' => 1 );
        $value = get_theme_mod( $mod_name, $default[$size] );
        if ( $value !== $default[$size] ) {
            $css .= ':root { --ct-font-size-' . $size . ': ' . floatval( $value ) . 'rem; }';
        }
    }
    
    // Container width
    $container_width = get_theme_mod( 'container_width', 'boxed' );
    if ( $container_width === 'boxed' ) {
        $css .= ':root { --ct-container-width: 1200px; }';
    } elseif ( $container_width === 'wide' ) {
        $css .= ':root { --ct-container-width: 1400px; }';
    }
    
    // Float buttons position
    $float_bottom = get_theme_mod( 'float_bottom_position', 20 );
    $float_right = get_theme_mod( 'float_right_position', 20 );
    $float_gap = get_theme_mod( 'float_button_gap', 10 );
    
    if ( $float_bottom !== 20 || $float_right !== 20 || $float_gap !== 10 ) {
        $css .= '.ct-float-buttons { bottom: ' . absint( $float_bottom ) . 'px; right: ' . absint( $float_right ) . 'px; gap: ' . absint( $float_gap ) . 'px; }';
    }
    
    // Back to top button color
    $back_to_top_color = get_theme_mod( 'back_to_top_bg_color', '#0073aa' );
    if ( $back_to_top_color !== '#0073aa' ) {
        $css .= '.ct-back-to-top { background-color: ' . esc_attr( $back_to_top_color ) . '; }';
    }
    
    // Custom CSS
    $custom_css = get_theme_mod( 'custom_css', '' );
    if ( ! empty( $custom_css ) ) {
        $css .= wp_strip_all_tags( $custom_css );
    }
    
    if ( ! empty( $css ) ) {
        wp_add_inline_style( 'clean-theme-style', $css );
    }
}
add_action( 'wp_enqueue_scripts', 'clean_theme_customizer_css', 20 );

/**
 * Output analytics code in head
 */
function clean_theme_analytics_head() {
    $code = get_theme_mod( 'analytics_code_head', '' );
    if ( ! empty( $code ) ) {
        echo wp_kses( $code, array(
            'script' => array(
                'src'   => array(),
                'async' => array(),
                'type'  => array(),
            ),
        ) );
    }
}
add_action( 'wp_head', 'clean_theme_analytics_head', 999 );

/**
 * Output analytics code before body
 */
function clean_theme_analytics_body() {
    $code = get_theme_mod( 'analytics_code_body', '' );
    if ( ! empty( $code ) ) {
        echo wp_kses( $code, array(
            'script' => array(
                'src'   => array(),
                'async' => array(),
                'type'  => array(),
            ),
        ) );
    }
}
add_action( 'wp_footer', 'clean_theme_analytics_body', 999 );
