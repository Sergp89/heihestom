<?php
/**
 * Modal AJAX Handler
 *
 * Handles form submissions from modal windows.
 *
 * @package Clean_Theme
 * @since Clean Theme 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Handle modal form submission
 */
function clean_theme_handle_modal_form() {
    // Verify nonce
    if ( ! isset( $_POST['modal_form_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( $_POST['modal_form_nonce'] ), 'clean_theme_modal_form_nonce' ) ) {
        wp_send_json_error( array( 'message' => __( 'Security check failed. Please refresh and try again.', 'clean-theme' ) ) );
    }

    // Get modal ID
    $modal_id = ! empty( $_POST['modal_id'] ) ? sanitize_title( $_POST['modal_id'] ) : '';
    
    if ( empty( $modal_id ) ) {
        wp_send_json_error( array( 'message' => __( 'Invalid modal ID.', 'clean-theme' ) ) );
    }

    // Get all modals and find the matching one
    $modals = get_theme_mod( 'clean_theme_modals', array() );
    $modal_config = null;
    
    foreach ( $modals as $modal ) {
        if ( sanitize_title( $modal['id'] ) === $modal_id ) {
            $modal_config = $modal;
            break;
        }
    }
    
    if ( ! $modal_config ) {
        wp_send_json_error( array( 'message' => __( 'Modal configuration not found.', 'clean-theme' ) ) );
    }

    // Get form fields configuration
    $form_fields = ! empty( $modal_config['form_fields'] ) ? $modal_config['form_fields'] : array();
    
    if ( empty( $form_fields ) ) {
        wp_send_json_error( array( 'message' => __( 'No form fields configured.', 'clean-theme' ) ) );
    }

    // Validate and sanitize submitted data
    $submitted_data = array();
    $errors = array();
    
    foreach ( $form_fields as $field ) {
        $name = ! empty( $field['name'] ) ? sanitize_title( $field['name'] ) : '';
        $type = ! empty( $field['type'] ) ? $field['type'] : 'text';
        $required = ! empty( $field['required'] );
        $label = ! empty( $field['label'] ) ? $field['label'] : $name;
        
        if ( empty( $name ) ) {
            continue;
        }
        
        // Check required fields
        if ( $required && empty( $_POST[ $name ] ) && 'file' !== $type ) {
            /* translators: %s: field label */
            $errors[] = sprintf( __( '%s is required.', 'clean-theme' ), $label );
            continue;
        }
        
        // Sanitize based on type
        switch ( $type ) {
            case 'email':
                $value = ! empty( $_POST[ $name ] ) ? sanitize_email( $_POST[ $name ] ) : '';
                if ( ! empty( $value ) && ! is_email( $value ) ) {
                    /* translators: %s: field label */
                    $errors[] = sprintf( __( 'Please enter a valid email for %s.', 'clean-theme' ), $label );
                }
                break;
                
            case 'url':
                $value = ! empty( $_POST[ $name ] ) ? esc_url_raw( $_POST[ $name ] ) : '';
                break;
                
            case 'number':
                $value = ! empty( $_POST[ $name ] ) ? floatval( $_POST[ $name ] ) : '';
                break;
                
            case 'textarea':
                $value = ! empty( $_POST[ $name ] ) ? sanitize_textarea_field( $_POST[ $name ] ) : '';
                break;
                
            case 'checkbox':
            case 'radio':
                $value = ! empty( $_POST[ $name ] ) ? array_map( 'sanitize_text_field', (array) $_POST[ $name ] ) : array();
                break;
                
            case 'select':
                $value = ! empty( $_POST[ $name ] ) ? sanitize_text_field( $_POST[ $name ] ) : '';
                break;
                
            case 'file':
                // Handle file upload separately
                $value = clean_theme_handle_modal_file_upload( $name, $field );
                break;
                
            default:
                $value = ! empty( $_POST[ $name ] ) ? sanitize_text_field( $_POST[ $name ] ) : '';
        }
        
        $submitted_data[ $label ] = $value;
    }

    // If there are validation errors, return them
    if ( ! empty( $errors ) ) {
        wp_send_json_error( array( 
            'message' => implode( ' ', $errors ),
            'errors' => $errors,
        ) );
    }

    // Prepare email
    $recipient_email = ! empty( $_POST['recipient_email'] ) ? sanitize_email( $_POST['recipient_email'] ) : get_option( 'admin_email' );
    $subject = ! empty( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : __( 'New Form Submission', 'clean-theme' );
    
    // Replace shortcodes in subject
    $subject = str_replace( '[site_name]', get_bloginfo( 'name' ), $subject );
    foreach ( $submitted_data as $key => $value ) {
        $subject = str_replace( '[' . sanitize_title( $key ) . ']', $value, $subject );
    }

    // Build email body
    $email_body = __( 'You have received a new form submission:', 'clean-theme' ) . "\n\n";
    $email_body .= sprintf( __( 'Form: %s', 'clean-theme' ), $modal_id ) . "\n";
    $email_body .= sprintf( __( 'Date: %s', 'clean-theme' ), date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ) ) ) . "\n";
    $email_body .= sprintf( __( 'IP: %s', 'clean-theme' ), sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ) ) . "\n\n";
    $email_body .= __( 'Submitted Data:', 'clean-theme' ) . "\n";
    $email_body .= str_repeat( '-', 30 ) . "\n";
    
    foreach ( $submitted_data as $label => $value ) {
        if ( is_array( $value ) ) {
            $value = implode( ', ', $value );
        }
        $email_body .= sprintf( "%s: %s\n", $label, $value );
    }
    
    $email_body .= "\n" . sprintf( __( 'This message was sent from %s', 'clean-theme' ), get_bloginfo( 'name' ) );

    // Email headers
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'X-Mailer: PHP/' . phpversion(),
    );

    // Add reply-to if email field exists
    foreach ( $form_fields as $field ) {
        if ( 'email' === $field['type'] && ! empty( $submitted_data[ $field['label'] ] ) ) {
            $headers[] = 'Reply-To: ' . sanitize_email( $submitted_data[ $field['label'] ] );
            break;
        }
    }

    // Send email
    $sent = wp_mail( $recipient_email, $subject, $email_body, $headers );

    // Fire action hook for custom handling
    do_action( 'modal_form_submitted', $submitted_data, $modal_id, $modal_config );

    if ( $sent ) {
        $success_message = ! empty( $modal_config['form_success_message'] ) 
            ? $modal_config['form_success_message'] 
            : __( 'Thank you! Your submission has been received.', 'clean-theme' );
        
        wp_send_json_success( array( 'message' => $success_message ) );
    } else {
        wp_send_json_error( array( 'message' => __( 'There was an error sending your submission. Please try again later.', 'clean-theme' ) ) );
    }
}
add_action( 'wp_ajax_clean_theme_handle_modal_form', 'clean_theme_handle_modal_form' );
add_action( 'wp_ajax_nopriv_clean_theme_handle_modal_form', 'clean_theme_handle_modal_form' );

/**
 * Handle file upload from modal form
 *
 * @param string $field_name Field name.
 * @param array  $field_config Field configuration.
 * @return string|array Uploaded file URL or error message.
 */
function clean_theme_handle_modal_file_upload( $field_name, $field_config ) {
    if ( empty( $_FILES[ $field_name ] ) || empty( $_FILES[ $field_name ]['name'] ) ) {
        return '';
    }

    // Check for upload errors
    if ( UPLOAD_ERR_OK !== $_FILES[ $field_name ]['error'] ) {
        return __( 'File upload error.', 'clean-theme' );
    }

    // Validate file type
    $allowed_types = ! empty( $field_config['accept'] ) 
        ? explode( ',', str_replace( '.', '', $field_config['accept'] ) )
        : array( 'jpg', 'jpeg', 'png', 'gif', 'pdf' );
    
    $file_ext = strtolower( pathinfo( $_FILES[ $field_name ]['name'], PATHINFO_EXTENSION ) );
    
    if ( ! in_array( $file_ext, $allowed_types, true ) ) {
        return __( 'Invalid file type.', 'clean-theme' );
    }

    // Validate file size
    $max_size = ! empty( $field_config['max_size'] ) 
        ? absint( $field_config['max_size'] ) * 1024 * 1024 
        : 2 * 1024 * 1024; // Default 2MB
    
    if ( $_FILES[ $field_name ]['size'] > $max_size ) {
        return __( 'File is too large.', 'clean-theme' );
    }

    // Upload file
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $attachment_id = media_handle_upload( $field_name, 0 );

    if ( is_wp_error( $attachment_id ) ) {
        return $attachment_id->get_error_message();
    }

    return wp_get_attachment_url( $attachment_id );
}
