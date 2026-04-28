<?php
/**
 * Dental Clinic Theme Functions
 *
 * @package Dental_Clinic
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Setup theme features
 */
function dental_clinic_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dental-clinic'),
        'mobile'  => __('Mobile Menu', 'dental-clinic'),
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'dental_clinic_setup');

/**
 * Enqueue scripts and styles
 */
function dental_clinic_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('dental-clinic-style', get_stylesheet_uri(), array(), '1.0.0');

    // Enqueue custom JavaScript
    wp_enqueue_script('dental-clinic-scripts', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);

    // Localize script for AJAX calls
    wp_localize_script('dental-clinic-scripts', 'dentalClinic', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'dental_clinic_scripts');

/**
 * Register widget areas
 */
function dental_clinic_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'dental-clinic'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'dental-clinic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'dental-clinic'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'dental-clinic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area 3', 'dental-clinic'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in your footer.', 'dental-clinic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'dental_clinic_widgets_init');

/**
 * Custom excerpt length
 */
function dental_clinic_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'dental_clinic_excerpt_length');

/**
 * Custom excerpt more
 */
function dental_clinic_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'dental_clinic_excerpt_more');

/**
 * Add custom body classes
 */
function dental_clinic_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'dental_clinic_body_classes');

/**
 * Include custom template tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template for comment display
 */
if (file_exists(get_template_directory() . '/inc/comments-walker.php')) {
    require get_template_directory() . '/inc/comments-walker.php';
}