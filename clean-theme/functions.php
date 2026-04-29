<?php
/**
 * Clean Theme functions and definitions
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define theme constants
 */
define( 'CLEAN_THEME_VERSION', '1.0.0' );
define( 'CLEAN_THEME_DIR', get_template_directory() );
define( 'CLEAN_THEME_URI', get_template_directory_uri() );

/**
 * Include additional files
 */
require_once CLEAN_THEME_DIR . '/inc/customizer.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function clean_theme_setup() {
    /*
     * Make theme available for translation.
     */
    load_theme_textdomain( 'clean-theme', CLEAN_THEME_DIR . '/languages' );

    /*
     * Add default posts and comments RSS feed links to head.
     */
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support( 'post-thumbnails' );

    /*
     * Set post thumbnail size.
     */
    set_post_thumbnail_size( 1200, 675, true );

    /*
     * Add custom logo support.
     */
    add_theme_support( 'custom-logo', array(
        'height'      => 120,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    /*
     * Switch default core markup for search form, comment form, comments, galleries, captions etc. to HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    /*
     * Add support for wide alignment in Gutenberg.
     */
    add_theme_support( 'align-wide' );

    /*
     * Add support for responsive embeds.
     */
    add_theme_support( 'responsive-embeds' );

    /*
     * Add support for custom background.
     */
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );

    /*
     * Add support for custom header.
     */
    add_theme_support( 'custom-header', array(
        'default-image'      => '',
        'width'              => 1920,
        'height'             => 400,
        'flex-height'        => true,
        'flex-width'         => true,
    ) );

    /*
     * Add support for editor styles.
     */
    add_theme_support( 'editor-styles' );

    /*
     * Add support for block styles.
     */
    add_theme_support( 'wp-block-styles' );

    /*
     * Add support for full and wide align images.
     */
    add_theme_support( 'align-wide' );

    /*
     * Add support for responsive embedded content.
     */
    add_theme_support( 'responsive-embeds' );

    /*
     * Add support for custom logo.
     */
    add_theme_support( 'custom-logo' );

    /*
     * Add support for widgets.
     */
    add_theme_support( 'widgets' );

    /*
     * Register navigation menus.
     */
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'clean-theme' ),
        'footer'  => __( 'Footer Menu', 'clean-theme' ),
    ) );

    /*
     * Set the default content width.
     */
    if ( ! isset( $content_width ) ) {
        $content_width = 1200;
    }
}
add_action( 'after_setup_theme', 'clean_theme_setup' );

/**
 * Register widget areas.
 */
function clean_theme_widgets_init() {
    // Header Widgets (Desktop)
    register_sidebar( array(
        'name'          => __( 'Header Widgets', 'clean-theme' ),
        'id'            => 'header-widgets',
        'description'   => __( 'Widgets displayed in the header on desktop (phone, social icons, etc.)', 'clean-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="screen-reader-text">',
        'after_title'   => '</span>',
    ) );

    // Mobile Contact Widget
    register_sidebar( array(
        'name'          => __( 'Mobile Contact', 'clean-theme' ),
        'id'            => 'mobile-contact',
        'description'   => __( 'Contact information displayed in mobile menu (phone, messengers)', 'clean-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Content Top Widget Area
    register_sidebar( array(
        'name'          => __( 'Content Top', 'clean-theme' ),
        'id'            => 'content-top',
        'description'   => __( 'Widgets displayed above the main content (sliders, banners, etc.)', 'clean-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Content Bottom Widget Area
    register_sidebar( array(
        'name'          => __( 'Content Bottom', 'clean-theme' ),
        'id'            => 'content-bottom',
        'description'   => __( 'Widgets displayed below the main content', 'clean-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Sidebar
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'clean-theme' ),
        'id'            => 'sidebar',
        'description'   => __( 'Main sidebar widget area', 'clean-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Footer Left
    register_sidebar( array(
        'name'          => __( 'Footer Left', 'clean-theme' ),
        'id'            => 'footer-left',
        'description'   => __( 'Left column in footer', 'clean-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Footer Contact Widget Area
    register_sidebar( array(
        'name'          => __( 'Footer Contact', 'clean-theme' ),
        'id'            => 'footer-contact',
        'description'   => __( 'Contact information widget area in footer (address, phone, email, hours)', 'clean-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Footer Menu Widget Area
    register_sidebar( array(
        'name'          => __( 'Footer Menu', 'clean-theme' ),
        'id'            => 'footer-menu',
        'description'   => __( 'Menu widget area in footer right column', 'clean-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-menu-title">',
        'after_title'   => '</h4>',
    ) );

    // Footer Right
    register_sidebar( array(
        'name'          => __( 'Footer Right', 'clean-theme' ),
        'id'            => 'footer-right',
        'description'   => __( 'Right column in footer', 'clean-theme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'clean_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function clean_theme_scripts() {
    // Main stylesheet
    wp_enqueue_style(
        'clean-theme-style',
        get_stylesheet_uri(),
        array(),
        CLEAN_THEME_VERSION
    );

    // Mobile menu script
    wp_enqueue_script(
        'clean-theme-mobile-menu',
        CLEAN_THEME_URI . '/assets/js/mobile-menu.js',
        array(),
        CLEAN_THEME_VERSION,
        true
    );

    // FAB (Floating Action Buttons) script
    wp_enqueue_script(
        'clean-theme-fab',
        CLEAN_THEME_URI . '/assets/js/fab.js',
        array(),
        CLEAN_THEME_VERSION,
        true
    );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'clean_theme_scripts' );

/**
 * Add custom body classes.
 */
function clean_theme_body_classes( $classes ) {
    // Add a class if no sidebar
    if ( ! is_active_sidebar( 'sidebar' ) ) {
        $classes[] = 'no-sidebar';
    }

    // Add a class if there are header widgets
    if ( is_active_sidebar( 'header-widgets' ) ) {
        $classes[] = 'has-header-widgets';
    }

    return $classes;
}
add_filter( 'body_class', 'clean_theme_body_classes' );

/**
 * Custom excerpt length.
 */
function clean_theme_excerpt_length( $length ) {
    if ( is_admin() ) {
        return $length;
    }
    return 30;
}
add_filter( 'excerpt_length', 'clean_theme_excerpt_length' );

/**
 * Custom excerpt more.
 */
function clean_theme_excerpt_more( $more ) {
    if ( is_admin() ) {
        return $more;
    }
    return '&hellip;';
}
add_filter( 'excerpt_more', 'clean_theme_excerpt_more' );

/**
 * Add pingback/trackback support.
 */
function clean_theme_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'clean_theme_pingback_header' );

/**
 * Remove WordPress version from head for security.
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Add preconnect for Google Fonts (optional, can be customized).
 */
function clean_theme_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'clean_theme_resource_hints', 10, 2 );
