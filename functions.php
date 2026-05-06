<?php
/**
 * Heyhestom Theme Functions and Definitions
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
 * Define theme constants
 */
define('HEYHESTOM_VERSION', '1.0.0');
define('HEYHESTOM_DIR', get_template_directory());
define('HEYHESTOM_URI', get_template_directory_uri());

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function heyhestom_setup(): void
{
    // Make theme available for translation
    load_theme_textdomain('heyhestom', HEYHESTOM_DIR . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 675, true);
    add_image_size('heyhestom-hero', 1920, 600, true);
    add_image_size('heyhestom-card', 600, 400, true);
    add_image_size('heyhestom-doctor', 400, 500, true);

    // Register navigation menus
    register_nav_menus([
        'primary' => esc_html__('Primary Menu', 'heyhestom'),
        'footer'  => esc_html__('Footer Menu', 'heyhestom'),
        'mobile'  => esc_html__('Mobile Menu', 'heyhestom'),
    ]);

    // Switch default core markup for search form, comment form, and comments
    // to output valid HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Add support for core custom logo
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
        'header-text' => ['site-title', 'site-description'],
    ]);

    // Add support for custom background
    add_theme_support('custom-background', [
        'default-color' => 'f8fafc',
    ]);

    // Add support for custom header
    add_theme_support('custom-header', [
        'default-image'      => '',
        'width'              => 1920,
        'height'             => 600,
        'flex-width'         => true,
        'flex-height'        => true,
        'random-default'     => false,
        'wp-head-callback'   => __NAMESPACE__ . '\\heyhestom_custom_header_callback',
    ]);

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for wide and full alignment in Gutenberg
    add_theme_support('align-wide');

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // Add support for custom line height controls
    add_theme_support('custom-line-height');

    // Add support for experimental link color control
    add_theme_support('experimental-link-color');

    // Add support for block styles
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images
    add_theme_support('align-wide');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for appearance tools (WordPress 5.9+)
    add_theme_support('appearance-tools');

    // Add support for spacing presets
    add_theme_support('custom-spacing');
}
add_action('after_setup_theme', __NAMESPACE__ . '\\heyhestom_setup');

/**
 * Custom header callback
 */
function heyhestom_custom_header_callback(): void
{
    $header_image = get_header_image();
    if ($header_image) {
        echo '<style type="text/css">';
        echo '.hero-slider { background-image: url(' . esc_url($header_image) . '); }';
        echo '</style>';
    }
}

/**
 * Register widget areas
 */
function heyhestom_widgets_init(): void
{
    register_sidebar([
        'name'          => esc_html__('Header Widget Area', 'heyhestom'),
        'id'            => 'header-widgets',
        'description'   => esc_html__('Add widgets here to appear in the header area.', 'heyhestom'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="widget-title screen-reader-text">',
        'after_title'   => '</span>',
    ]);

    register_sidebar([
        'name'          => esc_html__('Sidebar', 'heyhestom'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'heyhestom'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => esc_html__('Footer Column 1', 'heyhestom'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in footer column 1.', 'heyhestom'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => esc_html__('Footer Column 2', 'heyhestom'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here to appear in footer column 2.', 'heyhestom'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => esc_html__('Before Content', 'heyhestom'),
        'id'            => 'before-content',
        'description'   => esc_html__('Content before main page content.', 'heyhestom'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => esc_html__('After Content', 'heyhestom'),
        'id'            => 'after-content',
        'description'   => esc_html__('Content after main page content.', 'heyhestom'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\heyhestom_widgets_init');

/**
 * Enqueue scripts and styles
 */
function heyhestom_scripts(): void
{
    // Google Fonts
    wp_enqueue_style(
        'heyhestom-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Open+Sans:wght@400;600&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'heyhestom-style',
        get_stylesheet_uri(),
        ['heyhestom-fonts'],
        HEYHESTOM_VERSION
    );

    // Main CSS from assets
    wp_enqueue_style(
        'heyhestom-main',
        HEYHESTOM_URI . '/assets/css/main.css',
        ['heyhestom-style'],
        HEYHESTOM_VERSION
    );

    // Main JavaScript
    wp_enqueue_script(
        'heyhestom-main',
        HEYHESTOM_URI . '/assets/js/main.js',
        [],
        HEYHESTOM_VERSION,
        true
    );

    // Localize script with AJAX URL and other data
    wp_localize_script('heyhestom-main', 'heyhestomData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('heyhestom_nonce'),
        'i18n'    => [
            'loading' => __('Loading...', 'heyhestom'),
            'error'   => __('An error occurred. Please try again.', 'heyhestom'),
        ],
    ]);

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\heyhestom_scripts');

/**
 * Custom template tags
 */
require HEYHESTOM_DIR . '/inc/template-tags.php';

/**
 * Customizer additions
 */
require HEYHESTOM_DIR . '/inc/customizer.php';

/**
 * Custom functions
 */
require HEYHESTOM_DIR . '/inc/extras.php';

/**
 * Load Jetpack compatibility file
 */
if (defined('JETPACK__VERSION')) {
    require HEYHESTOM_DIR . '/inc/jetpack.php';
}

/**
 * Include the TGM_Plugin_Activation class
 */
require_once HEYHESTOM_DIR . '/inc/class-tgm-plugin-activation.php';

/**
 * Register recommended plugins
 */
function heyhestom_register_required_plugins(): void
{
    $plugins = [
        [
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ],
        [
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => false,
        ],
    ];

    $config = [
        'id'           => 'heyhestom',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'is_automatic' => false,
    ];

    tgmpa($plugins, $config);
}
add_action('tgmpa_register', __NAMESPACE__ . '\\heyhestom_register_required_plugins');

/**
 * Custom excerpt length
 */
function heyhestom_excerpt_length(int $length): int
{
    return 20;
}
add_filter('excerpt_length', __NAMESPACE__ . '\\heyhestom_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function heyhestom_excerpt_more(string $more): string
{
    return '&hellip;';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\heyhestom_excerpt_more');

/**
 * Add body classes for specific conditions
 */
function heyhestom_body_classes(array $classes): array
{
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1') && !is_page()) {
        $classes[] = 'has-sidebar';
    }

    // Add class for singular pages
    if (is_singular()) {
        $classes[] = 'singular-page';
    }

    return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\heyhestom_body_classes');

/**
 * Preload key resources
 */
function heyhestom_resource_hints(array $urls, string $relation_type): array
{
    if ('preconnect' === $relation_type) {
        $urls[] = [
            'href' => 'https://fonts.googleapis.com',
        ];
        $urls[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }

    return $urls;
}
add_filter('wp_resource_hints', __NAMESPACE__ . '\\heyhestom_resource_hints', 10, 2);

/**
 * Remove unnecessary WordPress features for better performance
 */
function heyhestom_cleanup(): void
{
    // Remove WP Emoji
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Remove WP Embed
    wp_deregister_script('wp-embed');

    // Remove RSD link
    remove_action('wp_head', 'rsd_link');

    // Remove WLW manifest link
    remove_action('wp_head', 'wlwmanifest_link');

    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');

    // Remove generator meta tag
    remove_action('wp_head', 'wp_generator');

    // Remove REST API links
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', __NAMESPACE__ . '\\heyhestom_cleanup');

/**
 * Security headers
 */
function heyhestom_security_headers(): void
{
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', __NAMESPACE__ . '\\heyhestom_security_headers');

/**
 * Filter the "read more" excerpt string
 */
function heyhestom_excerpt_more_filter(string $more): string
{
    if (is_admin()) {
        return $more;
    }
    return '&hellip;';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\heyhestom_excerpt_more_filter');
