<?php
/**
 * Contact Form Modal Template
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$title    = get_theme_mod( 'feedback_modal_title', __( 'Request a Call', 'clean-theme' ) );
$subtitle = get_theme_mod( 'feedback_modal_subtitle', __( 'Leave your details and we will call you back shortly.', 'clean-theme' ) );
$btn_text = get_theme_mod( 'contact_form_submit_text', __( 'Send Message', 'clean-theme' ) );
?>
<div id="contact-form-modal" class="contact-form-modal" aria-hidden="true" role="dialog">
    <div class="contact-form-modal__overlay" tabindex="-1"></div>
    <div class="contact-form-modal__content">
        <button class="contact-form-modal__close" aria-label="<?php esc_attr_e( 'Close modal', 'clean-theme' ); ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
        <div class="contact-form-modal__header">
            <h2><?php echo esc_html( $title ); ?></h2>
            <?php if ( ! empty( $subtitle ) ) : ?><p><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
        </div>
        <form id="contact-form" class="contact-form" method="post">
            <?php wp_nonce_field( 'clean_theme_contact_form', 'contact_form_nonce' ); ?>
            <div class="contact-form__field">
                <label for="contact-name"><?php esc_html_e( 'Your Name', 'clean-theme' ); ?> <span class="required">*</span></label>
                <input type="text" id="contact-name" name="name" required autocomplete="name">
            </div>
            <div class="contact-form__field">
                <label for="contact-email"><?php esc_html_e( 'Email Address', 'clean-theme' ); ?> <span class="required">*</span></label>
                <input type="email" id="contact-email" name="email" required autocomplete="email">
            </div>
            <div class="contact-form__field">
                <label for="contact-phone"><?php esc_html_e( 'Phone Number', 'clean-theme' ); ?></label>
                <input type="tel" id="contact-phone" name="phone" autocomplete="tel">
            </div>
            <div class="contact-form__field">
                <label for="contact-message"><?php esc_html_e( 'Message', 'clean-theme' ); ?> <span class="required">*</span></label>
                <textarea id="contact-message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="contact-form__submit">
                <span class="contact-form__submit-text"><?php echo esc_html( $btn_text ); ?></span>
                <span class="contact-form__submit-loading" style="display:none;"><?php esc_html_e( 'Sending...', 'clean-theme' ); ?></span>
            </button>
            <div class="contact-form__response" style="display:none;"></div>
        </form>
    </div>
</div>
