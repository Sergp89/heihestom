<?php
/**
 * AJAX handler for contact form submission
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handle contact form submission via AJAX
 */
function clean_theme_handle_contact_form() {
    // Verify nonce
    if ( ! isset( $_POST['contact_form_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['contact_form_nonce'] ) ), 'clean_theme_contact_form' ) ) {
        wp_send_json_error( array( 'message' => __( 'Security check failed.', 'clean-theme' ) ) );
    }

    // Validate required fields
    $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    $errors = array();

    if ( empty( $name ) ) {
        $errors[] = __( 'Please enter your name.', 'clean-theme' );
    }

    if ( empty( $email ) || ! is_email( $email ) ) {
        $errors[] = __( 'Please enter a valid email address.', 'clean-theme' );
    }

    if ( empty( $message ) ) {
        $errors[] = __( 'Please enter your message.', 'clean-theme' );
    }

    if ( ! empty( $errors ) ) {
        wp_send_json_error( array( 'message' => implode( ' ', $errors ) ) );
    }

    // Get recipient email from options
    $recipient_email = get_option( 'clean_theme_contact_email', get_option( 'admin_email' ) );

    // Prepare email
    $subject = sprintf( 
        /* translators: %s: Site name */
        __( '[%s] Contact Form Submission', 'clean-theme' ),
        wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES )
    );

    $body = sprintf(
        /* translators: 1: Name, 2: Email, 3: Phone, 4: Message */
        __( "New contact form submission:\n\nName: %1\$s\nEmail: %2\$s\nPhone: %3\$s\nMessage:\n%4\$s", 'clean-theme' ),
        $name,
        $email,
        $phone,
        $message
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $email,
    );

    // Add additional headers if phone is provided
    if ( ! empty( $phone ) ) {
        $headers[] = 'X-Phone: ' . $phone;
    }

    // Send email
    $sent = wp_mail( $recipient_email, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array(
            'message' => __( 'Thank you! Your message has been sent successfully.', 'clean-theme' ),
        ) );
    } else {
        wp_send_json_error( array(
            'message' => __( 'Sorry, there was an error sending your message. Please try again later.', 'clean-theme' ),
        ) );
    }
}
add_action( 'wp_ajax_clean_theme_contact_form', 'clean_theme_handle_contact_form' );
add_action( 'wp_ajax_nopriv_clean_theme_contact_form', 'clean_theme_handle_contact_form' );

/**
 * Save contact form email option in Customizer
 */
function clean_theme_customize_contact_email_register( $wp_customize ) {
    $wp_customize->add_setting( 'clean_theme_contact_email', array(
        'default'           => get_option( 'admin_email' ),
        'sanitize_callback' => 'sanitize_email',
        'type'              => 'option',
    ) );

    $wp_customize->add_control( 'clean_theme_contact_email', array(
        'label'       => __( 'Contact Form Recipient Email', 'clean-theme' ),
        'description' => __( 'Email address where contact form submissions will be sent', 'clean-theme' ),
        'section'     => 'clean_floating_buttons_section',
        'type'        => 'email',
        'priority'    => 42,
    ) );
}
add_action( 'customize_register', 'clean_theme_customize_contact_email_register' );
