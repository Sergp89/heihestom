<?php
/**
 * Clean Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Clean_Theme
 * @since Clean Theme 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Define theme constants
 */
define( 'CLEAN_THEME_VERSION', '1.0.0' );
define( 'CLEAN_THEME_DIR', get_template_directory() );
define( 'CLEAN_THEME_URI', get_template_directory_uri() );

/**
 * Include required files
 */
require_once CLEAN_THEME_DIR . '/inc/sanitization-callbacks.php';
require_once CLEAN_THEME_DIR . '/inc/template-tags.php';
require_once CLEAN_THEME_DIR . '/inc/customizer.php';
require_once CLEAN_THEME_DIR . '/inc/ajax-handler.php';

/**
 * Theme setup
 */
function clean_theme_setup() {
    /*
     * Make theme available for translation.
     */
    load_theme_textdomain( 'clean-theme', CLEAN_THEME_DIR . '/languages' );

    /*
     * Add default posts feed to RSS head.
     */
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails.
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 9999 );

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
     * Add custom background support.
     */
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );

    /*
     * Add custom header support.
     */
    add_theme_support( 'custom-header', array(
        'default-image'      => '',
        'default-text-color' => '000000',
        'width'              => 1920,
        'height'             => 400,
        'flex-height'        => true,
        'flex-width'         => true,
    ) );

    /*
     * Switch default core markup for various elements to HTML5.
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
     * Add support for wide and full alignment in block editor.
     */
    add_theme_support( 'align-wide' );

    /*
     * Add support for responsive embeds.
     */
    add_theme_support( 'responsive-embeds' );

    /*
     * Add support for core custom logo.
     */
    add_theme_support( 'custom-logo' );

    /*
     * Add support for widgets.
     */
    add_theme_support( 'widgets' );

    /*
     * Add support for block styles.
     */
    add_theme_support( 'wp-block-styles' );

    /*
     * Add support for editor styles.
     */
    add_theme_support( 'editor-styles' );

    /*
     * Add Editor Styles
     */
    add_editor_style( 'assets/css/editor-style.css' );

    /*
     * Register navigation menus.
     */
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'clean-theme' ),
        'footer'  => __( 'Footer Menu', 'clean-theme' ),
    ) );

    /*
     * Set the content width.
     */
    if ( ! isset( $content_width ) ) {
        $content_width = 1200;
    }
}
add_action( 'after_setup_theme', 'clean_theme_setup' );

/**
 * Register widget areas
 */
function clean_theme_widgets_init() {
    // Header widgets
    register_sidebar( array(
        'name'          => __( 'Header Widgets', 'clean-theme' ),
        'id'            => 'header-widgets',
        'description'   => __( 'Add widgets here to appear in the header area.', 'clean-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Sidebar
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'clean-theme' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'clean-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Footer widget areas based on style
    $footer_style = get_theme_mod( 'footer_style', 'style-1' );
    
    switch ( $footer_style ) {
        case 'style-1':
            $footer_columns = 2;
            break;
        case 'style-2':
            $footer_columns = 3;
            break;
        case 'style-3':
            $footer_columns = 4;
            break;
        case 'style-4':
            $footer_columns = 1;
            break;
        default:
            $footer_columns = 2;
    }

    for ( $i = 1; $i <= $footer_columns; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( __( 'Footer Column %d', 'clean-theme' ), $i ),
            'id'            => 'footer-' . $i,
            'description'   => sprintf( __( 'Widgets for footer column %d.', 'clean-theme' ), $i ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
}
add_action( 'widgets_init', 'clean_theme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function clean_theme_scripts() {
    // Main stylesheet
    wp_enqueue_style(
        'clean-theme-style',
        get_stylesheet_uri(),
        array(),
        CLEAN_THEME_VERSION
    );

    // Float buttons styles
    wp_enqueue_style(
        'clean-theme-float-buttons',
        CLEAN_THEME_URI . '/assets/css/float-buttons.css',
        array(),
        CLEAN_THEME_VERSION
    );

    // Google Fonts (if enabled)
    $font_body = get_theme_mod( 'font_body', 'system' );
    $font_headings = get_theme_mod( 'font_headings', 'system' );
    
    if ( $font_body !== 'system' || $font_headings !== 'system' ) {
        wp_enqueue_style(
            'clean-theme-google-fonts',
            clean_theme_google_fonts_url(),
            array(),
            null
        );
    }

    // Main JavaScript
    wp_enqueue_script(
        'clean-theme-main',
        CLEAN_THEME_URI . '/assets/js/main.js',
        array(),
        CLEAN_THEME_VERSION,
        true
    );

    // Mobile menu script
    wp_enqueue_script(
        'clean-theme-mobile-menu',
        CLEAN_THEME_URI . '/assets/js/mobile-menu.js',
        array(),
        CLEAN_THEME_VERSION,
        true
    );

    // Float buttons script
    wp_enqueue_script(
        'clean-theme-float-buttons',
        CLEAN_THEME_URI . '/assets/js/float-buttons.js',
        array( 'jquery' ),
        CLEAN_THEME_VERSION,
        true
    );

    // Localize float buttons script with AJAX URL
    wp_localize_script( 'clean-theme-float-buttons', 'cleanThemeAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'clean_theme_contact_form_nonce' ),
        'i18n'    => array(
            'sending'   => __( 'Sending...', 'clean-theme' ),
            'success'   => __( 'Message sent successfully!', 'clean-theme' ),
            'error'     => __( 'Error sending message. Please try again.', 'clean-theme' ),
        ),
    ) );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'clean_theme_scripts' );

/**
 * Get Google Fonts URL
 */
function clean_theme_google_fonts_url() {
    $fonts = array();
    
    $font_body = get_theme_mod( 'font_body', 'system' );
    $font_headings = get_theme_mod( 'font_headings', 'system' );
    
    if ( $font_body !== 'system' ) {
        $fonts[] = $font_body;
    }
    
    if ( $font_headings !== 'system' && $font_headings !== $font_body ) {
        $fonts[] = $font_headings;
    }
    
    if ( empty( $fonts ) ) {
        return '';
    }
    
    $fonts = array_unique( $fonts );
    $query = http_build_query( array(
        'family' => implode( '|', array_map( function( $font ) {
            return urlencode( $font ) . ':wght@300;400;500;600;700';
        }, $fonts ) ),
        'display' => 'swap',
    ) );
    
    return 'https://fonts.googleapis.com/css2?' . $query;
}

/**
 * Add preconnect for Google Fonts
 */
function clean_theme_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'clean_theme_resource_hints', 10, 2 );

/**
 * Add body classes
 */
function clean_theme_body_classes( $classes ) {
    // Container width class
    $container_width = get_theme_mod( 'container_width', 'boxed' );
    $classes[] = 'ct-container-' . esc_attr( $container_width );
    
    // Logo position class
    $logo_position = get_theme_mod( 'logo_position', 'left' );
    $classes[] = 'logo-' . esc_attr( $logo_position );
    
    // Menu position class
    $menu_position = get_theme_mod( 'menu_position', 'inline' );
    $classes[] = 'menu-' . esc_attr( $menu_position );
    
    // Footer style class
    $footer_style = get_theme_mod( 'footer_style', 'style-1' );
    $classes[] = 'footer-' . esc_attr( $footer_style );
    
    // Color scheme class
    $color_scheme = get_theme_mod( 'color_scheme', 'light' );
    $classes[] = 'color-scheme-' . esc_attr( $color_scheme );
    
    // Smooth scroll class
    if ( get_theme_mod( 'smooth_scroll', true ) ) {
        $classes[] = 'smooth-scroll';
    } else {
        $classes[] = 'no-smooth-scroll';
    }
    
    // Animations class
    if ( get_theme_mod( 'enable_animations', true ) ) {
        $classes[] = 'animations-enabled';
    } else {
        $classes[] = 'animations-disabled';
    }
    
    return $classes;
}
add_filter( 'body_class', 'clean_theme_body_classes' );

/**
 * Add pingback header
 */
function clean_theme_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'clean_theme_pingback_header' );

/**
 * Custom excerpt length
 */
function clean_theme_excerpt_length( $length ) {
    if ( is_admin() ) {
        return $length;
    }
    return 30;
}
add_filter( 'excerpt_length', 'clean_theme_excerpt_length' );

/**
 * Custom excerpt more
 */
function clean_theme_excerpt_more( $more ) {
    if ( is_admin() ) {
        return $more;
    }
    return '&hellip;';
}
add_filter( 'excerpt_more', 'clean_theme_excerpt_more' );

/**
 * Enable shortcodes in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Add custom image sizes
 */
function clean_theme_custom_image_sizes() {
    add_image_size( 'clean-theme-large', 1200, 9999, false );
    add_image_size( 'clean-theme-medium', 600, 400, true );
    add_image_size( 'clean-theme-small', 300, 200, true );
}
add_action( 'after_setup_theme', 'clean_theme_custom_image_sizes' );

/**
 * Filter archive title
 */
function clean_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = get_the_author();
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'clean_theme_archive_title' );

/**
 * Support child themes
 */
function clean_theme_child_theme_setup() {
    if ( is_child_theme() ) {
        // Child theme specific setup can go here
    }
}
add_action( 'after_setup_theme', 'clean_theme_child_theme_setup', 11 );

/**
 * Export Customizer settings
 */
function clean_theme_export_customizer_settings() {
    $mods = get_theme_mods();
    return $mods;
}

/**
 * Import Customizer settings
 */
function clean_theme_import_customizer_settings( $settings ) {
    if ( ! is_array( $settings ) ) {
        return false;
    }
    
    foreach ( $settings as $key => $value ) {
        set_theme_mod( $key, $value );
    }
    
    return true;
}

/**
 * Plugin compatibility
 */
function clean_theme_plugin_compatibility() {
    // WooCommerce support
    if ( class_exists( 'WooCommerce' ) ) {
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
    
    // Elementor support
    if ( did_action( 'elementor/loaded' ) ) {
        add_theme_support( 'elementor' );
    }
    
    // Contact Form 7 support
    if ( class_exists( 'WPCF7' ) ) {
        // CF7 specific support can be added here
    }
}
add_action( 'after_setup_theme', 'clean_theme_plugin_compatibility' );
