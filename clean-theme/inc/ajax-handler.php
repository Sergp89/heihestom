<?php
/**
 * AJAX Handler for Contact Form
 *
 * @package Clean_Theme
 * @since Clean Theme 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Handle contact form submission
 */
function clean_theme_send_contact_form() {
    // Verify nonce
    if ( ! isset( $_POST['contact_form_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( $_POST['contact_form_nonce'] ), 'clean_theme_contact_form_nonce' ) ) {
        wp_send_json_error( array( 'message' => __( 'Security check failed. Please refresh and try again.', 'clean-theme' ) ) );
    }
    
    // Validate required fields
    $required_fields = array( 'contact_name', 'contact_email', 'contact_message' );
    foreach ( $required_fields as $field ) {
        if ( empty( $_POST[ $field ] ) ) {
            wp_send_json_error( array( 'message' => sprintf( __( 'Please fill in all required fields.', 'clean-theme' ) ) ) );
        }
    }
    
    // Sanitize input
    $name = sanitize_text_field( $_POST['contact_name'] );
    $email = sanitize_email( $_POST['contact_email'] );
    $phone = isset( $_POST['contact_phone'] ) ? sanitize_text_field( $_POST['contact_phone'] ) : '';
    $message = sanitize_textarea_field( $_POST['contact_message'] );
    $recipient_email = isset( $_POST['recipient_email'] ) ? sanitize_email( $_POST['recipient_email'] ) : get_option( 'admin_email' );
    
    // Validate email
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'clean-theme' ) ) );
    }
    
    // Prepare email
    $subject = sprintf( __( 'New Contact Form Submission from %s', 'clean-theme' ), $name );
    
    $email_body = sprintf( __( 'You have received a new message from your website contact form:', 'clean-theme' ) ) . "\n\n";
    $email_body .= sprintf( __( 'Name: %s', 'clean-theme' ), $name ) . "\n";
    $email_body .= sprintf( __( 'Email: %s', 'clean-theme' ), $email ) . "\n";
    if ( ! empty( $phone ) ) {
        $email_body .= sprintf( __( 'Phone: %s', 'clean-theme' ), $phone ) . "\n";
    }
    $email_body .= "\n" . sprintf( __( 'Message:', 'clean-theme' ) ) . "\n";
    $email_body .= $message . "\n\n";
    $email_body .= sprintf( __( 'This message was sent from the contact form on %s', 'clean-theme' ), get_bloginfo( 'name' ) ) . "\n";
    $email_body .= sprintf( __( 'IP Address: %s', 'clean-theme' ), sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ) ) . "\n";
    
    // Email headers
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $email,
        'X-Mailer: PHP/' . phpversion(),
    );
    
    // Send email
    $sent = wp_mail( $recipient_email, $subject, $email_body, $headers );
    
    if ( $sent ) {
        wp_send_json_success( array( 'message' => __( 'Thank you! Your message has been sent successfully.', 'clean-theme' ) ) );
    } else {
        wp_send_json_error( array( 'message' => __( 'There was an error sending your message. Please try again later.', 'clean-theme' ) ) );
    }
}
add_action( 'wp_ajax_clean_theme_send_contact_form', 'clean_theme_send_contact_form' );
add_action( 'wp_ajax_nopriv_clean_theme_send_contact_form', 'clean_theme_send_contact_form' );
