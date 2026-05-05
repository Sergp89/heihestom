<?php
/**
 * Sanitization Callback Functions
 *
 * @package Clean_Theme
 * @since Clean Theme 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Sanitize checkbox
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function clean_theme_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize select
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
 * Sanitize range
 *
 * @param number $input   The range value.
 * @param object $setting The setting object.
 * @return number The sanitized value.
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
 * Sanitize analytics code
 *
 * @param string $code The analytics code.
 * @return string The sanitized code.
 */
function clean_theme_sanitize_analytics_code( $code ) {
    if ( empty( $code ) ) {
        return '';
    }
    
    $allowed_tags = array(
        'script' => array(
            'src'   => array(),
            'async' => array(),
            'type'  => array(),
            'defer' => array(),
        ),
        'noscript' => array(),
        'iframe'   => array(
            'src'           => array(),
            'height'        => array(),
            'width'         => array(),
            'frameborder'   => array(),
            'allowfullscreen' => array(),
        ),
    );
    
    return wp_kses( $code, $allowed_tags );
}

/**
 * Sanitize text field
 *
 * @param string $input The text value.
 * @return string The sanitized text.
 */
function clean_theme_sanitize_text( $input ) {
    return sanitize_text_field( $input );
}

/**
 * Sanitize textarea
 *
 * @param string $input The textarea value.
 * @return string The sanitized textarea.
 */
function clean_theme_sanitize_textarea( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize email
 *
 * @param string $email The email address.
 * @return string The sanitized email.
 */
function clean_theme_sanitize_email( $email ) {
    return sanitize_email( $email );
}

/**
 * Sanitize URL
 *
 * @param string $url The URL.
 * @return string The sanitized URL.
 */
function clean_theme_sanitize_url( $url ) {
    return esc_url_raw( $url );
}

/**
 * Sanitize number
 *
 * @param number $input The number value.
 * @return number The sanitized number.
 */
function clean_theme_sanitize_number( $input ) {
    return absint( $input );
}

/**
 * Sanitize CSS
 *
 * @param string $css The CSS code.
 * @return string The sanitized CSS.
 */
function clean_theme_sanitize_css( $css ) {
    return wp_strip_all_tags( $css );
}
