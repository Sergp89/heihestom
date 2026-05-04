<?php
/**
 * Sanitization callbacks for Customizer settings
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Sanitize checkbox values
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function clean_theme_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize select values
 *
 * @param string $input   The select value.
 * @param object $setting The setting object.
 * @return string The sanitized value.
 */
function clean_theme_sanitize_select( $input, $setting ) {
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize range values
 *
 * @param int    $input   The range value.
 * @param object $setting The setting object.
 * @return int The sanitized value.
 */
function clean_theme_sanitize_range( $input, $setting ) {
    $atts = $setting->manager->get_control( $setting->id )->input_attrs;
    $min = ( isset( $atts['min'] ) ? $atts['min'] : 0 );
    $max = ( isset( $atts['max'] ) ? $atts['max'] : 100 );
    $step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
    $number = floor( $input / $step ) * $step;
    return ( $number < $min ? $min : ( $number > $max ? $max : $number ) );
}

/**
 * Sanitize layout style
 *
 * @param string $input The layout value.
 * @return string The sanitized value.
 */
function clean_theme_sanitize_layout( $input ) {
    $valid = array( 'fluid', 'boxed', 'wide' );
    return in_array( $input, $valid, true ) ? $input : 'boxed';
}

/**
 * Sanitize logo position
 *
 * @param string $input The position value.
 * @return string The sanitized value.
 */
function clean_theme_sanitize_logo_position( $input ) {
    $valid = array( 'left', 'center', 'right' );
    return in_array( $input, $valid, true ) ? $input : 'left';
}

/**
 * Sanitize menu position
 *
 * @param string $input The position value.
 * @return string The sanitized value.
 */
function clean_theme_sanitize_menu_position( $input ) {
    $valid = array( 'below', 'inline' );
    return in_array( $input, $valid, true ) ? $input : 'below';
}

/**
 * Sanitize footer style
 *
 * @param string $input The footer style value.
 * @return string The sanitized value.
 */
function clean_theme_sanitize_footer_style( $input ) {
    $valid = array( 'style-1', 'style-2', 'style-3', 'style-4' );
    return in_array( $input, $valid, true ) ? $input : 'style-1';
}

/**
 * Sanitize animation type
 *
 * @param string $input The animation value.
 * @return string The sanitized value.
 */
function clean_theme_sanitize_animation( $input ) {
    $valid = array( 'fade', 'slide', 'scale' );
    return in_array( $input, $valid, true ) ? $input : 'fade';
}

/**
 * Sanitize form display type
 *
 * @param string $input The form display value.
 * @return string The sanitized value.
 */
function clean_theme_sanitize_form_display( $input ) {
    $valid = array( 'modal', 'panel' );
    return in_array( $input, $valid, true ) ? $input : 'modal';
}

/**
 * Sanitize analytics code
 *
 * @param string $input The analytics code.
 * @return string The sanitized code.
 */
function clean_theme_sanitize_analytics( $input ) {
    if ( empty( $input ) ) {
        return '';
    }
    return wp_kses( $input, array(
        'script' => array(
            'src'  => array(),
            'type' => array(),
        ),
        'iframe' => array(
            'src'    => array(),
            'width'  => array(),
            'height' => array(),
            'frameborder' => array(),
        ),
        'noscript' => array(),
        'img'      => array(
            'src'    => array(),
            'alt'    => array(),
            'height' => array(),
            'width'  => array(),
        ),
    ) );
}

/**
 * Sanitize custom CSS
 *
 * @param string $input The CSS code.
 * @return string The sanitized CSS.
 */
function clean_theme_sanitize_css( $input ) {
    if ( empty( $input ) ) {
        return '';
    }
    // Strip out any potentially dangerous characters
    $input = strip_tags( $input );
    $input = str_replace( array( '<', '>', '\\' ), '', $input );
    return $input;
}

/**
 * Sanitize phone number
 *
 * @param string $input The phone number.
 * @return string The sanitized phone number.
 */
function clean_theme_sanitize_phone( $input ) {
    return preg_replace( '/[^0-9+\-\s()]/', '', $input );
}

/**
 * Sanitize URL with protocol support
 *
 * @param string $input The URL.
 * @return string The sanitized URL.
 */
function clean_theme_sanitize_url_protocol( $input ) {
    if ( empty( $input ) ) {
        return '';
    }
    // Allow custom protocols like max://
    return esc_url_raw( $input, array( 'http', 'https', 'tel', 'mailto', 'max', 'sms' ) );
}
