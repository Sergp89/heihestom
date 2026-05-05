<?php
/**
 * Heyhestom Theme Customizer
 *
 * @package Heyhestom
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Heyhestom;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function heyhestom_customize_register(\WP_Customize_Manager $wp_customize): void
{
    // Enable live preview for customizer
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    // Selective refresh for site title and description
    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            [
                'selector'        => '.site-title a',
                'render_callback' => __NAMESPACE__ . '\\heyhestom_customize_partial_blogname',
            ]
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            [
                'selector'        => '.site-description',
                'render_callback' => __NAMESPACE__ . '\\heyhestom_customize_partial_blogdescription',
            ]
        );
    }

    /* =========================================
       Colors Panel
       ========================================= */
    $wp_customize->add_panel(
        'heyhestom_colors_panel',
        [
            'title'       => esc_html__('Colors', 'heyhestom'),
            'description' => esc_html__('Customize theme colors', 'heyhestom'),
            'priority'    => 25,
        ]
    );

    // Primary Color Section
    $wp_customize->add_section(
        'heyhestom_primary_colors',
        [
            'title'    => esc_html__('Primary Colors', 'heyhestom'),
            'panel'    => 'heyhestom_colors_panel',
            'priority' => 10,
        ]
    );

    // Primary Color
    $wp_customize->add_setting(
        'heyhestom_primary_color',
        [
            'default'           => '#0ea5e9',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        new \WP_Customize_Color_Control(
            $wp_customize,
            'heyhestom_primary_color',
            [
                'label'   => esc_html__('Primary Color', 'heyhestom'),
                'section' => 'heyhestom_primary_colors',
            ]
        )
    );

    // Primary Dark Color
    $wp_customize->add_setting(
        'heyhestom_primary_dark_color',
        [
            'default'           => '#0284c7',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        new \WP_Customize_Color_Control(
            $wp_customize,
            'heyhestom_primary_dark_color',
            [
                'label'   => esc_html__('Primary Dark Color', 'heyhestom'),
                'section' => 'heyhestom_primary_colors',
            ]
        )
    );

    // Secondary Color
    $wp_customize->add_setting(
        'heyhestom_secondary_color',
        [
            'default'           => '#10b981',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        new \WP_Customize_Color_Control(
            $wp_customize,
            'heyhestom_secondary_color',
            [
                'label'   => esc_html__('Secondary Color', 'heyhestom'),
                'section' => 'heyhestom_primary_colors',
            ]
        )
    );

    // Text & Background Section
    $wp_customize->add_section(
        'heyhestom_text_background_colors',
        [
            'title'    => esc_html__('Text & Background', 'heyhestom'),
            'panel'    => 'heyhestom_colors_panel',
            'priority' => 20,
        ]
    );

    // Text Color
    $wp_customize->add_setting(
        'heyhestom_text_color',
        [
            'default'           => '#0f172a',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        new \WP_Customize_Color_Control(
            $wp_customize,
            'heyhestom_text_color',
            [
                'label'   => esc_html__('Text Color', 'heyhestom'),
                'section' => 'heyhestom_text_background_colors',
            ]
        )
    );

    // Background Color
    $wp_customize->add_setting(
        'heyhestom_background_color',
        [
            'default'           => '#f8fafc',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        new \WP_Customize_Color_Control(
            $wp_customize,
            'heyhestom_background_color',
            [
                'label'   => esc_html__('Background Color', 'heyhestom'),
                'section' => 'heyhestom_text_background_colors',
            ]
        )
    );

    // Header Background
    $wp_customize->add_setting(
        'heyhestom_header_bg_color',
        [
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        new \WP_Customize_Color_Control(
            $wp_customize,
            'heyhestom_header_bg_color',
            [
                'label'   => esc_html__('Header Background', 'heyhestom'),
                'section' => 'heyhestom_text_background_colors',
            ]
        )
    );

    // Footer Background
    $wp_customize->add_setting(
        'heyhestom_footer_bg_color',
        [
            'default'           => '#0f172a',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        new \WP_Customize_Color_Control(
            $wp_customize,
            'heyhestom_footer_bg_color',
            [
                'label'   => esc_html__('Footer Background', 'heyhestom'),
                'section' => 'heyhestom_text_background_colors',
            ]
        )
    );

    /* =========================================
       Typography Panel
       ========================================= */
    $wp_customize->add_panel(
        'heyhestom_typography_panel',
        [
            'title'       => esc_html__('Typography', 'heyhestom'),
            'description' => esc_html__('Customize theme typography', 'heyhestom'),
            'priority'    => 30,
        ]
    );

    // Font Settings Section
    $wp_customize->add_section(
        'heyhestom_fonts',
        [
            'title'    => esc_html__('Fonts', 'heyhestom'),
            'panel'    => 'heyhestom_typography_panel',
            'priority' => 10,
        ]
    );

    // Heading Font
    $wp_customize->add_setting(
        'heyhestom_heading_font',
        [
            'default'           => 'Montserrat',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_heading_font',
        [
            'label'   => esc_html__('Heading Font', 'heyhestom'),
            'section' => 'heyhestom_fonts',
            'type'    => 'select',
            'choices' => [
                'Montserrat' => 'Montserrat',
                'Roboto'     => 'Roboto',
                'Open Sans'  => 'Open Sans',
                'Lato'       => 'Lato',
                'Poppins'    => 'Poppins',
            ],
        ]
    );

    // Body Font
    $wp_customize->add_setting(
        'heyhestom_body_font',
        [
            'default'           => 'Open Sans',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_body_font',
        [
            'label'   => esc_html__('Body Font', 'heyhestom'),
            'section' => 'heyhestom_fonts',
            'type'    => 'select',
            'choices' => [
                'Open Sans'  => 'Open Sans',
                'Roboto'     => 'Roboto',
                'Lato'       => 'Lato',
                'Montserrat' => 'Montserrat',
                'Nunito'     => 'Nunito',
            ],
        ]
    );

    // Font Sizes Section
    $wp_customize->add_section(
        'heyhestom_font_sizes',
        [
            'title'    => esc_html__('Font Sizes', 'heyhestom'),
            'panel'    => 'heyhestom_typography_panel',
            'priority' => 20,
        ]
    );

    // H1 Font Size
    $wp_customize->add_setting(
        'heyhestom_h1_font_size',
        [
            'default'           => 48,
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_h1_font_size',
        [
            'label'       => esc_html__('H1 Font Size (px)', 'heyhestom'),
            'section'     => 'heyhestom_font_sizes',
            'type'        => 'number',
            'input_attrs' => [
                'min'  => 24,
                'max'  => 96,
                'step' => 1,
            ],
        ]
    );

    // H2 Font Size
    $wp_customize->add_setting(
        'heyhestom_h2_font_size',
        [
            'default'           => 36,
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_h2_font_size',
        [
            'label'       => esc_html__('H2 Font Size (px)', 'heyhestom'),
            'section'     => 'heyhestom_font_sizes',
            'type'        => 'number',
            'input_attrs' => [
                'min'  => 20,
                'max'  => 72,
                'step' => 1,
            ],
        ]
    );

    // Body Font Size
    $wp_customize->add_setting(
        'heyhestom_body_font_size',
        [
            'default'           => 16,
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_body_font_size',
        [
            'label'       => esc_html__('Body Font Size (px)', 'heyhestom'),
            'section'     => 'heyhestom_font_sizes',
            'type'        => 'number',
            'input_attrs' => [
                'min'  => 12,
                'max'  => 24,
                'step' => 1,
            ],
        ]
    );

    /* =========================================
       Layout Panel
       ========================================= */
    $wp_customize->add_panel(
        'heyhestom_layout_panel',
        [
            'title'       => esc_html__('Layout', 'heyhestom'),
            'description' => esc_html__('Customize theme layout settings', 'heyhestom'),
            'priority'    => 35,
        ]
    );

    // Container Section
    $wp_customize->add_section(
        'heyhestom_container',
        [
            'title'    => esc_html__('Container Width', 'heyhestom'),
            'panel'    => 'heyhestom_layout_panel',
            'priority' => 10,
        ]
    );

    // Container Width
    $wp_customize->add_setting(
        'heyhestom_container_width',
        [
            'default'           => 1280,
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_container_width',
        [
            'label'       => esc_html__('Container Max Width (px)', 'heyhestom'),
            'section'     => 'heyhestom_container',
            'type'        => 'range',
            'input_attrs' => [
                'min'  => 960,
                'max'  => 1920,
                'step' => 10,
            ],
        ]
    );

    // Layout Style
    $wp_customize->add_setting(
        'heyhestom_layout_style',
        [
            'default'           => 'wide',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_layout_style',
        [
            'label'   => esc_html__('Layout Style', 'heyhestom'),
            'section' => 'heyhestom_container',
            'type'    => 'radio',
            'choices' => [
                'boxed'  => esc_html__('Boxed', 'heyhestom'),
                'wide'   => esc_html__('Wide', 'heyhestom'),
                'fluid'  => esc_html__('Fluid', 'heyhestom'),
            ],
        ]
    );

    // Header Section
    $wp_customize->add_section(
        'heyhestom_header_settings',
        [
            'title'    => esc_html__('Header Settings', 'heyhestom'),
            'panel'    => 'heyhestom_layout_panel',
            'priority' => 20,
        ]
    );

    // Logo Position
    $wp_customize->add_setting(
        'heyhestom_logo_position',
        [
            'default'           => 'left',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_logo_position',
        [
            'label'   => esc_html__('Logo Position', 'heyhestom'),
            'section' => 'heyhestom_header_settings',
            'type'    => 'radio',
            'choices' => [
                'left'   => esc_html__('Left', 'heyhestom'),
                'center' => esc_html__('Center', 'heyhestom'),
                'right'  => esc_html__('Right', 'heyhestom'),
            ],
        ]
    );

    // Show Header Border
    $wp_customize->add_setting(
        'heyhestom_show_header_border',
        [
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_show_header_border',
        [
            'label'   => esc_html__('Show Header Border', 'heyhestom'),
            'section' => 'heyhestom_header_settings',
            'type'    => 'checkbox',
        ]
    );

    // Sticky Header
    $wp_customize->add_setting(
        'heyhestom_sticky_header',
        [
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'refresh',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_sticky_header',
        [
            'label'   => esc_html__('Enable Sticky Header', 'heyhestom'),
            'section' => 'heyhestom_header_settings',
            'type'    => 'checkbox',
        ]
    );

    // Footer Section
    $wp_customize->add_section(
        'heyhestom_footer_settings',
        [
            'title'    => esc_html__('Footer Settings', 'heyhestom'),
            'panel'    => 'heyhestom_layout_panel',
            'priority' => 30,
        ]
    );

    // Show Footer Widgets
    $wp_customize->add_setting(
        'heyhestom_show_footer_widgets',
        [
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'refresh',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_show_footer_widgets',
        [
            'label'   => esc_html__('Show Footer Widgets', 'heyhestom'),
            'section' => 'heyhestom_footer_settings',
            'type'    => 'checkbox',
        ]
    );

    // Copyright Text
    $wp_customize->add_setting(
        'heyhestom_copyright_text',
        [
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_copyright_text',
        [
            'label'   => esc_html__('Copyright Text', 'heyhestom'),
            'section' => 'heyhestom_footer_settings',
            'type'    => 'textarea',
        ]
    );

    /* =========================================
       Floating Elements Panel
       ========================================= */
    $wp_customize->add_panel(
        'heyhestom_floating_panel',
        [
            'title'       => esc_html__('Floating Elements', 'heyhestom'),
            'description' => esc_html__('Customize floating buttons (scroll to top, contact)', 'heyhestom'),
            'priority'    => 40,
        ]
    );

    // Scroll to Top Section
    $wp_customize->add_section(
        'heyhestom_scroll_top',
        [
            'title'    => esc_html__('Scroll to Top Button', 'heyhestom'),
            'panel'    => 'heyhestom_floating_panel',
            'priority' => 10,
        ]
    );

    // Show Scroll to Top
    $wp_customize->add_setting(
        'heyhestom_show_scroll_top',
        [
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'refresh',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_show_scroll_top',
        [
            'label'   => esc_html__('Show Scroll to Top Button', 'heyhestom'),
            'section' => 'heyhestom_scroll_top',
            'type'    => 'checkbox',
        ]
    );

    // Scroll to Top Position
    $wp_customize->add_setting(
        'heyhestom_scroll_top_position',
        [
            'default'           => 'right',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_scroll_top_position',
        [
            'label'   => esc_html__('Position', 'heyhestom'),
            'section' => 'heyhestom_scroll_top',
            'type'    => 'radio',
            'choices' => [
                'left'  => esc_html__('Left', 'heyhestom'),
                'right' => esc_html__('Right', 'heyhestom'),
            ],
        ]
    );

    // Contact FAB Section
    $wp_customize->add_section(
        'heyhestom_contact_fab',
        [
            'title'    => esc_html__('Contact Button (FAB)', 'heyhestom'),
            'panel'    => 'heyhestom_floating_panel',
            'priority' => 20,
        ]
    );

    // Show Contact FAB
    $wp_customize->add_setting(
        'heyhestom_show_contact_fab',
        [
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport'         => 'refresh',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_show_contact_fab',
        [
            'label'   => esc_html__('Show Contact Button', 'heyhestom'),
            'section' => 'heyhestom_contact_fab',
            'type'    => 'checkbox',
        ]
    );

    // Phone Number for FAB
    $wp_customize->add_setting(
        'heyhestom_fab_phone',
        [
            'default'           => '+74951234567',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_fab_phone',
        [
            'label'   => esc_html__('Phone Number', 'heyhestom'),
            'section' => 'heyhestom_contact_fab',
            'type'    => 'tel',
        ]
    );

    // Messenger Link
    $wp_customize->add_setting(
        'heyhestom_fab_messenger',
        [
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        ]
    );

    $wp_customize->add_control(
        'heyhestom_fab_messenger',
        [
            'label'   => esc_html__('Messenger Link', 'heyhestom'),
            'section' => 'heyhestom_contact_fab',
            'type'    => 'url',
        ]
    );
}
add_action('customize_register', __NAMESPACE__ . '\\heyhestom_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function heyhestom_customize_partial_blogname(): void
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function heyhestom_customize_partial_blogdescription(): void
{
    bloginfo('description');
}

/**
 * Output Customizer CSS
 */
function heyhestom_customizer_css(): void
{
    // Get customizer values
    $primary_color       = get_theme_mod('heyhestom_primary_color', '#0ea5e9');
    $primary_dark_color  = get_theme_mod('heyhestom_primary_dark_color', '#0284c7');
    $secondary_color     = get_theme_mod('heyhestom_secondary_color', '#10b981');
    $text_color          = get_theme_mod('heyhestom_text_color', '#0f172a');
    $background_color    = get_theme_mod('heyhestom_background_color', '#f8fafc');
    $header_bg_color     = get_theme_mod('heyhestom_header_bg_color', '#ffffff');
    $footer_bg_color     = get_theme_mod('heyhestom_footer_bg_color', '#0f172a');
    $h1_font_size        = get_theme_mod('heyhestom_h1_font_size', 48);
    $h2_font_size        = get_theme_mod('heyhestom_h2_font_size', 36);
    $body_font_size      = get_theme_mod('heyhestom_body_font_size', 16);
    $container_width     = get_theme_mod('heyhestom_container_width', 1280);
    $show_header_border  = get_theme_mod('heyhestom_show_header_border', true);
    ?>
    <style type="text/css">
        :root {
            --primary: <?php echo esc_attr($primary_color); ?>;
            --primary-dark: <?php echo esc_attr($primary_dark_color); ?>;
            --secondary: <?php echo esc_attr($secondary_color); ?>;
            --dark: <?php echo esc_attr($text_color); ?>;
            --light: <?php echo esc_attr($background_color); ?>;
            --header-bg: <?php echo esc_attr($header_bg_color); ?>;
            --footer-bg: <?php echo esc_attr($footer_bg_color); ?>;
            --container-width: <?php echo absint($container_width); ?>px;
        }

        body {
            font-size: <?php echo absint($body_font_size); ?>px;
        }

        h1, .hero-slider .slide-title {
            font-size: <?php echo absint($h1_font_size); ?>px;
        }

        h2, .about-section-title, .services-title, .doctors-title, 
        .news-title, .how-title, .calc-title, .comparison-title {
            font-size: <?php echo absint($h2_font_size); ?>px;
        }

        .header {
            background-color: var(--header-bg);
            <?php if (!$show_header_border): ?>
            border-bottom: none;
            <?php endif; ?>
        }

        .footer {
            background-color: var(--footer-bg);
        }

        <?php if (get_theme_mod('heyhestom_logo_position') === 'center'): ?>
        .header-inner {
            justify-content: center;
        }
        .logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        <?php endif; ?>

        <?php if (get_theme_mod('heyhestom_show_scroll_top') === false): ?>
        .scroll-top-btn {
            display: none !important;
        }
        <?php endif; ?>

        <?php if (get_theme_mod('heyhestom_show_contact_fab') === false): ?>
        .callback-fab-container {
            display: none !important;
        }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', __NAMESPACE__ . '\\heyhestom_customizer_css');

/**
 * Enqueue Customizer JS for live preview
 */
function heyhestom_customizer_preview_js(): void
{
    wp_enqueue_script(
        'heyhestom-customizer',
        HEYHESTOM_URI . '/assets/js/customizer.js',
        ['customize-preview'],
        HEYHESTOM_VERSION,
        true
    );
}
add_action('customize_preview_init', __NAMESPACE__ . '\\heyhestom_customizer_preview_js');
