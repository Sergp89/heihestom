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

/**
 * Sanitize modal configurations (JSON)
 *
 * @param string|array $input The modal configurations.
 * @return array The sanitized modal configurations.
 */
function clean_theme_sanitize_modals( $input ) {
    // If input is a JSON string, decode it
    if ( is_string( $input ) ) {
        $input = json_decode( $input, true );
        
        // Handle JSON decode error
        if ( json_last_error() !== JSON_ERROR_NONE ) {
            return array();
        }
    }
    
    // Validate array structure
    if ( ! is_array( $input ) ) {
        return array();
    }
    
    $sanitized = array();
    
    foreach ( $input as $modal ) {
        if ( ! is_array( $modal ) ) {
            continue;
        }
        
        $sanitized_modal = array(
            'id'                 => ! empty( $modal['id'] ) ? sanitize_title( $modal['id'] ) : '',
            'title'              => ! empty( $modal['title'] ) ? sanitize_text_field( $modal['title'] ) : '',
            'enabled'            => ! empty( $modal['enabled'] ),
            'size'               => ! empty( $modal['size'] ) && in_array( $modal['size'], array( 'narrow', 'medium', 'wide', 'fullscreen' ), true ) ? $modal['size'] : 'medium',
            'position'           => ! empty( $modal['position'] ) && in_array( $modal['position'], array( 'center', 'right', 'left', 'bottom' ), true ) ? $modal['position'] : 'center',
            'animation_open'     => ! empty( $modal['animation_open'] ) && in_array( $modal['animation_open'], array( 'fade', 'slide-top', 'slide-bottom', 'slide-left', 'slide-right', 'zoom', 'bounce' ), true ) ? $modal['animation_open'] : 'fade',
            'animation_duration' => ! empty( $modal['animation_duration'] ) ? absint( $modal['animation_duration'] ) : 300,
            'overlay_type'       => ! empty( $modal['overlay_type'] ) && in_array( $modal['overlay_type'], array( 'solid', 'gradient', 'glass', 'pattern' ), true ) ? $modal['overlay_type'] : 'solid',
            'overlay_opacity'    => ! empty( $modal['overlay_opacity'] ) ? floatval( $modal['overlay_opacity'] ) : 0.5,
            'border_radius'      => ! empty( $modal['border_radius'] ) ? absint( $modal['border_radius'] ) : 8,
            'shadow'             => ! empty( $modal['shadow'] ) && in_array( $modal['shadow'], array( 'none', 'light', 'medium', 'heavy' ), true ) ? $modal['shadow'] : 'medium',
            'close_position'     => ! empty( $modal['close_position'] ) && in_array( $modal['close_position'], array( 'inside-top-right', 'outside-top-right', 'center-bottom' ), true ) ? $modal['close_position'] : 'inside-top-right',
            'close_style'        => ! empty( $modal['close_style'] ) && in_array( $modal['close_style'], array( 'icon', 'text', 'icon-text' ), true ) ? $modal['close_style'] : 'icon',
            'bg_color'           => ! empty( $modal['bg_color'] ) ? sanitize_hex_color( $modal['bg_color'] ) : '#ffffff',
            'bg_image'           => ! empty( $modal['bg_image'] ) ? esc_url_raw( $modal['bg_image'] ) : '',
            'bg_image_opacity'   => ! empty( $modal['bg_image_opacity'] ) ? floatval( $modal['bg_image_opacity'] ) : 1,
            'padding_desktop'    => ! empty( $modal['padding_desktop'] ) ? absint( $modal['padding_desktop'] ) : 30,
            'padding_mobile'     => ! empty( $modal['padding_mobile'] ) ? absint( $modal['padding_mobile'] ) : 20,
            'description'        => ! empty( $modal['description'] ) ? wp_kses_post( $modal['description'] ) : '',
            'content'            => ! empty( $modal['content'] ) ? wp_kses_post( $modal['content'] ) : '',
            'enable_form'        => ! empty( $modal['enable_form'] ),
            'form_email'         => ! empty( $modal['form_email'] ) ? sanitize_email( $modal['form_email'] ) : get_option( 'admin_email' ),
            'form_subject'       => ! empty( $modal['form_subject'] ) ? sanitize_text_field( $modal['form_subject'] ) : __( 'New Form Submission', 'clean-theme' ),
            'form_submit_text'   => ! empty( $modal['form_submit_text'] ) ? sanitize_text_field( $modal['form_submit_text'] ) : __( 'Submit', 'clean-theme' ),
            'form_success_message' => ! empty( $modal['form_success_message'] ) ? sanitize_text_field( $modal['form_success_message'] ) : __( 'Thank you! Your submission has been received.', 'clean-theme' ),
            'form_fields'        => ! empty( $modal['form_fields'] ) && is_array( $modal['form_fields'] ) ? clean_theme_sanitize_form_fields( $modal['form_fields'] ) : array(),
            'action_buttons'     => ! empty( $modal['action_buttons'] ) && is_array( $modal['action_buttons'] ) ? clean_theme_sanitize_action_buttons( $modal['action_buttons'] ) : array(),
            'auto_open_delay'    => ! empty( $modal['auto_open_delay'] ) ? absint( $modal['auto_open_delay'] ) : 0,
            'scroll_trigger'     => ! empty( $modal['scroll_trigger'] ) ? absint( $modal['scroll_trigger'] ) : 0,
            'exit_intent'        => ! empty( $modal['exit_intent'] ),
            'close_on_overlay'   => ! empty( $modal['close_on_overlay'] ),
            'show_condition'     => ! empty( $modal['show_condition'] ) && in_array( $modal['show_condition'], array( 'all', 'only', 'except' ), true ) ? $modal['show_condition'] : 'all',
            'show_pages'         => ! empty( $modal['show_pages'] ) && is_array( $modal['show_pages'] ) ? array_map( 'absint', $modal['show_pages'] ) : array(),
        );
        
        // Only add if ID exists
        if ( ! empty( $sanitized_modal['id'] ) ) {
            $sanitized[] = $sanitized_modal;
        }
    }
    
    return $sanitized;
}

/**
 * Sanitize form fields configuration
 *
 * @param array $fields Form fields array.
 * @return array Sanitized form fields.
 */
function clean_theme_sanitize_form_fields( $fields ) {
    if ( ! is_array( $fields ) ) {
        return array();
    }
    
    $sanitized = array();
    
    foreach ( $fields as $field ) {
        if ( ! is_array( $field ) ) {
            continue;
        }
        
        $sanitized_field = array(
            'type'        => ! empty( $field['type'] ) && in_array( $field['type'], array( 'text', 'email', 'tel', 'url', 'number', 'textarea', 'select', 'checkbox', 'radio', 'file', 'html', 'divider' ), true ) ? $field['type'] : 'text',
            'label'       => ! empty( $field['label'] ) ? sanitize_text_field( $field['label'] ) : '',
            'name'        => ! empty( $field['name'] ) ? sanitize_title( $field['name'] ) : '',
            'required'    => ! empty( $field['required'] ),
            'placeholder' => ! empty( $field['placeholder'] ) ? sanitize_text_field( $field['placeholder'] ) : '',
            'width'       => ! empty( $field['width'] ) && in_array( $field['width'], array( 'full', 'half' ), true ) ? $field['width'] : 'full',
            'rows'        => ! empty( $field['rows'] ) ? absint( $field['rows'] ) : 4,
            'options'     => ! empty( $field['options'] ) && is_array( $field['options'] ) ? clean_theme_sanitize_select_options( $field['options'] ) : array(),
            'multiple'    => ! empty( $field['multiple'] ),
            'orientation' => ! empty( $field['orientation'] ) && in_array( $field['orientation'], array( 'vertical', 'horizontal' ), true ) ? $field['orientation'] : 'vertical',
            'accept'      => ! empty( $field['accept'] ) ? sanitize_text_field( $field['accept'] ) : '',
            'max_size'    => ! empty( $field['max_size'] ) ? absint( $field['max_size'] ) : 2,
            'html'        => ! empty( $field['html'] ) ? wp_kses_post( $field['html'] ) : '',
            'level'       => ! empty( $field['level'] ) && in_array( $field['level'], array( 'h3', 'h4', 'h5', 'h6' ), true ) ? $field['level'] : 'h3',
            'text'        => ! empty( $field['text'] ) ? sanitize_text_field( $field['text'] ) : '',
            'min'         => isset( $field['min'] ) ? floatval( $field['min'] ) : '',
            'max'         => isset( $field['max'] ) ? floatval( $field['max'] ) : '',
            'pattern'     => ! empty( $field['pattern'] ) ? sanitize_text_field( $field['pattern'] ) : '',
        );
        
        $sanitized[] = $sanitized_field;
    }
    
    return $sanitized;
}

/**
 * Sanitize select options
 *
 * @param array $options Options array.
 * @return array Sanitized options.
 */
function clean_theme_sanitize_select_options( $options ) {
    if ( ! is_array( $options ) ) {
        return array();
    }
    
    $sanitized = array();
    
    foreach ( $options as $opt ) {
        if ( ! is_array( $opt ) ) {
            continue;
        }
        
        $sanitized[] = array(
            'value' => ! empty( $opt['value'] ) ? sanitize_text_field( $opt['value'] ) : '',
            'label' => ! empty( $opt['label'] ) ? sanitize_text_field( $opt['label'] ) : '',
        );
    }
    
    return $sanitized;
}

/**
 * Sanitize action buttons configuration
 *
 * @param array $buttons Action buttons array.
 * @return array Sanitized action buttons.
 */
function clean_theme_sanitize_action_buttons( $buttons ) {
    if ( ! is_array( $buttons ) ) {
        return array();
    }
    
    $sanitized = array();
    
    foreach ( $buttons as $btn ) {
        if ( ! is_array( $btn ) ) {
            continue;
        }
        
        $sanitized_btn = array(
            'text'        => ! empty( $btn['text'] ) ? sanitize_text_field( $btn['text'] ) : '',
            'type'        => ! empty( $btn['type'] ) && in_array( $btn['type'], array( 'submit', 'link', 'close', 'js' ), true ) ? $btn['type'] : 'close',
            'link'        => ! empty( $btn['link'] ) ? esc_url_raw( $btn['link'] ) : '#',
            'style'       => ! empty( $btn['style'] ) && in_array( $btn['style'], array( 'primary', 'secondary', 'outline', 'text' ), true ) ? $btn['style'] : 'primary',
            'icon'        => ! empty( $btn['icon'] ) ? wp_kses( $btn['icon'], array( 'svg' => array( 'viewBox' => array(), 'width' => array(), 'height' => array(), 'fill' => array(), 'stroke' => array(), 'stroke-width' => array(), 'line' => array( 'x1' => array(), 'y1' => array(), 'x2' => array(), 'y2' => array() ) ) ) ) : '',
            'position'    => ! empty( $btn['position'] ) && in_array( $btn['position'], array( 'left', 'right', 'center' ), true ) ? $btn['position'] : 'center',
            'js_function' => ! empty( $btn['js_function'] ) ? sanitize_text_field( $btn['js_function'] ) : '',
            'new_tab'     => ! empty( $btn['new_tab'] ),
        );
        
        $sanitized[] = $sanitized_btn;
    }
    
    return $sanitized;
}
