<?php
/** Customizer settings for Clean Theme */
if ( ! defined( "ABSPATH" ) ) exit;

function clean_theme_customize_register( $wp_customize ) {
    $wp_customize->add_panel( "clean_theme_options", array( "title" => __( "Theme Options", "clean-theme" ), "priority" => 30 ));
    $wp_customize->add_section( "clean_general_section", array( "title" => __( "General Settings", "clean-theme" ), "panel" => "clean_theme_options", "priority" => 5 ));
    $wp_customize->add_setting( "container_width", array( "default" => "boxed", "sanitize_callback" => "clean_theme_sanitize_layout" ));
    $wp_customize->add_control( "container_width", array( "label" => __( "Container Width", "clean-theme" ), "section" => "clean_general_section", "type" => "select", "choices" => array( "fluid" => "Fluid", "boxed" => "Boxed", "wide" => "Wide" )));
    $wp_customize->add_setting( "enable_smooth_scroll", array( "default" => true, "sanitize_callback" => "clean_theme_sanitize_checkbox" ));
    $wp_customize->add_control( "enable_smooth_scroll", array( "label" => __( "Enable Smooth Scroll", "clean-theme" ), "section" => "clean_general_section", "type" => "checkbox" ));
    $wp_customize->add_setting( "enable_animations", array( "default" => true, "sanitize_callback" => "clean_theme_sanitize_checkbox" ));
    $wp_customize->add_control( "enable_animations", array( "label" => __( "Enable Animations", "clean-theme" ), "section" => "clean_general_section", "type" => "checkbox" ));
} add_action( "customize_register", "clean_theme_customize_register" );
