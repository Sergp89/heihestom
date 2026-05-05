<?php
/**
 * Modal Renderer
 *
 * Handles rendering of modal windows based on Customizer settings.
 *
 * @package Clean_Theme
 * @since Clean Theme 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Get all modals from Customizer settings
 *
 * @return array Array of modal configurations.
 */
function clean_theme_get_modals() {
    $modals = get_theme_mod( 'clean_theme_modals', array() );
    
    if ( empty( $modals ) ) {
        return array();
    }
    
    $active_modals = array();
    foreach ( $modals as $modal ) {
        if ( ! empty( $modal['enabled'] ) ) {
            $active_modals[] = $modal;
        }
    }
    
    return $active_modals;
}

/**
 * Render all active modals
 *
 * @return void
 */
function clean_theme_render_modals() {
    $modals = clean_theme_get_modals();
    
    if ( empty( $modals ) ) {
        return;
    }
    
    foreach ( $modals as $modal ) {
        clean_theme_render_single_modal( $modal );
    }
}
add_action( 'theme_modals_render', 'clean_theme_render_modals' );

/**
 * Render a single modal window
 *
 * @param array $modal Modal configuration array.
 * @return void
 */
function clean_theme_render_single_modal( $modal ) {
    if ( empty( $modal['id'] ) ) {
        return;
    }
    
    $modal_id = sanitize_title( $modal['id'] );
    $title    = ! empty( $modal['title'] ) ? $modal['title'] : '';
    
    // Size classes
    $size_classes = array(
        'narrow'   => 'modal-narrow',
        'medium'   => 'modal-medium',
        'wide'     => 'modal-wide',
        'fullscreen' => 'modal-fullscreen',
    );
    $size_class = ! empty( $modal['size'] ) && isset( $size_classes[ $modal['size'] ] ) 
        ? $size_classes[ $modal['size'] ] 
        : 'modal-medium';
    
    // Position classes
    $position_classes = array(
        'center' => 'modal-center',
        'right'  => 'modal-right',
        'left'   => 'modal-left',
        'bottom' => 'modal-bottom',
    );
    $position_class = ! empty( $modal['position'] ) && isset( $position_classes[ $modal['position'] ] )
        ? $position_classes[ $modal['position'] ]
        : 'modal-center';
    
    // Animation classes
    $animation_open = ! empty( $modal['animation_open'] ) ? $modal['animation_open'] : 'fade';
    $animation_duration = ! empty( $modal['animation_duration'] ) ? absint( $modal['animation_duration'] ) : 300;
    
    // Overlay type
    $overlay_type = ! empty( $modal['overlay_type'] ) ? $modal['overlay_type'] : 'solid';
    $overlay_opacity = ! empty( $modal['overlay_opacity'] ) ? floatval( $modal['overlay_opacity'] ) : 0.5;
    
    // Border radius
    $border_radius = ! empty( $modal['border_radius'] ) ? absint( $modal['border_radius'] ) : 8;
    
    // Shadow preset
    $shadow_presets = array(
        'none'   => 'none',
        'light'  => '0 2px 10px rgba(0,0,0,0.1)',
        'medium' => '0 4px 20px rgba(0,0,0,0.15)',
        'heavy'  => '0 8px 40px rgba(0,0,0,0.2)',
    );
    $shadow = ! empty( $modal['shadow'] ) && isset( $shadow_presets[ $modal['shadow'] ] )
        ? $shadow_presets[ $modal['shadow'] ]
        : $shadow_presets['medium'];
    
    // Close button position
    $close_position = ! empty( $modal['close_position'] ) ? $modal['close_position'] : 'inside-top-right';
    $close_style = ! empty( $modal['close_style'] ) ? $modal['close_style'] : 'icon';
    
    // Background
    $bg_color = ! empty( $modal['bg_color'] ) ? $modal['bg_color'] : '#ffffff';
    $bg_image = ! empty( $modal['bg_image'] ) ? $modal['bg_image'] : '';
    $bg_image_opacity = ! empty( $modal['bg_image_opacity'] ) ? floatval( $modal['bg_image_opacity'] ) : 1;
    
    // Padding
    $padding_desktop = ! empty( $modal['padding_desktop'] ) ? absint( $modal['padding_desktop'] ) : 30;
    $padding_mobile = ! empty( $modal['padding_mobile'] ) ? absint( $modal['padding_mobile'] ) : 20;
    
    // Form fields
    $has_form = ! empty( $modal['enable_form'] );
    $form_fields = ! empty( $modal['form_fields'] ) ? $modal['form_fields'] : array();
    $form_email = ! empty( $modal['form_email'] ) ? $modal['form_email'] : get_option( 'admin_email' );
    $form_subject = ! empty( $modal['form_subject'] ) ? $modal['form_subject'] : __( 'New Form Submission', 'clean-theme' );
    $form_submit_text = ! empty( $modal['form_submit_text'] ) ? $modal['form_submit_text'] : __( 'Submit', 'clean-theme' );
    $form_success_message = ! empty( $modal['form_success_message'] ) ? $modal['form_success_message'] : __( 'Thank you! Your submission has been received.', 'clean-theme' );
    
    // Buttons
    $action_buttons = ! empty( $modal['action_buttons'] ) ? $modal['action_buttons'] : array();
    
    // Triggers
    $auto_open_delay = ! empty( $modal['auto_open_delay'] ) ? absint( $modal['auto_open_delay'] ) : 0;
    $scroll_trigger = ! empty( $modal['scroll_trigger'] ) ? absint( $modal['scroll_trigger'] ) : 0;
    $exit_intent = ! empty( $modal['exit_intent'] ) ? true : false;
    
    // Conditions
    $show_condition = ! empty( $modal['show_condition'] ) ? $modal['show_condition'] : 'all';
    $show_pages = ! empty( $modal['show_pages'] ) ? $modal['show_pages'] : array();
    
    // Check display conditions
    if ( ! clean_theme_should_show_modal( $show_condition, $show_pages ) ) {
        return;
    }
    
    // Build inline styles
    $modal_styles = array(
        "border-radius: {$border_radius}px;",
        "box-shadow: {$shadow};",
        "background-color: {$bg_color};",
        "--modal-padding-desktop: {$padding_desktop}px;",
        "--modal-padding-mobile: {$padding_mobile}px;",
    );
    
    if ( ! empty( $bg_image ) ) {
        $modal_styles[] = "background-image: url('{$bg_image}');";
        $modal_styles[] = "background-size: cover;";
        $modal_styles[] = "background-position: center;";
        $modal_styles[] = "--bg-image-opacity: {$bg_image_opacity};";
    }
    
    $inline_styles = implode( ' ', $modal_styles );
    ?>
    <div class="ct-modal-overlay <?php echo esc_attr( 'overlay-' . $overlay_type ); ?>" 
         data-modal-id="<?php echo esc_attr( $modal_id ); ?>"
         data-animation-duration="<?php echo esc_attr( $animation_duration ); ?>"
         data-close-on-overlay="<?php echo ! empty( $modal['close_on_overlay'] ) ? 'true' : 'false'; ?>"
         style="--overlay-opacity: <?php echo esc_attr( $overlay_opacity ); ?>;"
         role="dialog"
         aria-modal="true"
         <?php if ( ! empty( $title ) ) : ?>aria-labelledby="<?php echo esc_attr( $modal_id . '-title' ); ?>"<?php endif; ?>
         <?php if ( ! empty( $modal['description'] ) ) : ?>aria-describedby="<?php echo esc_attr( $modal_id . '-desc' ); ?>"<?php endif; ?>>
        
        <div class="ct-modal <?php echo esc_attr( $size_class . ' ' . $position_class . ' ' . $animation_open ); ?>"
             style="<?php echo esc_attr( $inline_styles ); ?>">
            
            <!-- Close Button -->
            <?php clean_theme_render_modal_close_button( $close_position, $close_style, $modal_id ); ?>
            
            <!-- Modal Content -->
            <div class="ct-modal-content">
                <?php if ( ! empty( $title ) ) : ?>
                    <h2 id="<?php echo esc_attr( $modal_id . '-title' ); ?>" class="ct-modal-title">
                        <?php echo esc_html( $title ); ?>
                    </h2>
                <?php endif; ?>
                
                <?php if ( ! empty( $modal['description'] ) ) : ?>
                    <div id="<?php echo esc_attr( $modal_id . '-desc' ); ?>" class="ct-modal-description">
                        <?php echo wp_kses_post( $modal['description'] ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( ! empty( $modal['content'] ) ) : ?>
                    <div class="ct-modal-body">
                        <?php echo wp_kses_post( $modal['content'] ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( $has_form ) : ?>
                    <form class="ct-modal-form" data-modal-id="<?php echo esc_attr( $modal_id ); ?>" data-action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
                        <?php wp_nonce_field( 'clean_theme_modal_form_nonce', 'modal_form_nonce' ); ?>
                        <input type="hidden" name="action" value="clean_theme_handle_modal_form">
                        <input type="hidden" name="modal_id" value="<?php echo esc_attr( $modal_id ); ?>">
                        <input type="hidden" name="recipient_email" value="<?php echo esc_attr( $form_email ); ?>">
                        <input type="hidden" name="subject" value="<?php echo esc_attr( $form_subject ); ?>">
                        
                        <?php clean_theme_render_modal_form_fields( $form_fields ); ?>
                        
                        <div class="ct-modal-form-actions">
                            <button type="submit" class="ct-btn ct-btn-primary">
                                <?php echo esc_html( $form_submit_text ); ?>
                            </button>
                        </div>
                        
                        <div class="ct-form-response"></div>
                    </form>
                <?php endif; ?>
                
                <?php if ( ! empty( $action_buttons ) ) : ?>
                    <div class="ct-modal-actions">
                        <?php foreach ( $action_buttons as $btn ) : ?>
                            <?php clean_theme_render_modal_action_button( $btn, $modal_id ); ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Check if modal should be shown based on conditions
 *
 * @param string $condition Display condition.
 * @param array  $pages     Page IDs for display.
 * @return bool
 */
function clean_theme_should_show_modal( $condition, $pages ) {
    if ( 'all' === $condition ) {
        return true;
    }
    
    if ( 'only' === $condition ) {
        if ( is_singular( $pages ) ) {
            return true;
        }
        return false;
    }
    
    if ( 'except' === $condition ) {
        if ( is_singular( $pages ) ) {
            return false;
        }
        return true;
    }
    
    return true;
}

/**
 * Render modal close button
 *
 * @param string $position Button position.
 * @param string $style    Button style.
 * @param string $modal_id Modal ID.
 * @return void
 */
function clean_theme_render_modal_close_button( $position, $style, $modal_id ) {
    $position_class = 'close-' . $position;
    ?>
    <button type="button" 
            class="ct-modal-close <?php echo esc_attr( $position_class ); ?>" 
            data-modal-close="<?php echo esc_attr( $modal_id ); ?>"
            aria-label="<?php esc_attr_e( 'Close', 'clean-theme' ); ?>">
        <?php if ( 'icon' === $style || 'icon-text' === $style ) : ?>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        <?php endif; ?>
        <?php if ( 'text' === $style || 'icon-text' === $style ) : ?>
            <span><?php esc_html_e( 'Close', 'clean-theme' ); ?></span>
        <?php endif; ?>
    </button>
    <?php
}

/**
 * Render modal form fields
 *
 * @param array $fields Form fields configuration.
 * @return void
 */
function clean_theme_render_modal_form_fields( $fields ) {
    if ( empty( $fields ) ) {
        return;
    }
    
    foreach ( $fields as $field ) {
        $type      = ! empty( $field['type'] ) ? $field['type'] : 'text';
        $label     = ! empty( $field['label'] ) ? $field['label'] : '';
        $name      = ! empty( $field['name'] ) ? sanitize_title( $field['name'] ) : '';
        $required  = ! empty( $field['required'] ) ? 'required' : '';
        $placeholder = ! empty( $field['placeholder'] ) ? $field['placeholder'] : '';
        $width     = ! empty( $field['width'] ) ? $field['width'] : 'full';
        
        $field_class = 'ct-form-field field-' . $width;
        
        switch ( $type ) {
            case 'textarea':
                $rows = ! empty( $field['rows'] ) ? absint( $field['rows'] ) : 4;
                ?>
                <div class="<?php echo esc_attr( $field_class ); ?>">
                    <?php if ( ! empty( $label ) ) : ?>
                        <label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?><?php if ( $required ) : ?> <span class="required">*</span><?php endif; ?></label>
                    <?php endif; ?>
                    <textarea id="<?php echo esc_attr( $name ); ?>" 
                              name="<?php echo esc_attr( $name ); ?>" 
                              rows="<?php echo esc_attr( $rows ); ?>"
                              placeholder="<?php echo esc_attr( $placeholder ); ?>"
                              <?php echo esc_attr( $required ); ?>></textarea>
                </div>
                <?php
                break;
                
            case 'select':
                $options = ! empty( $field['options'] ) ? $field['options'] : array();
                $multiple = ! empty( $field['multiple'] ) ? 'multiple' : '';
                ?>
                <div class="<?php echo esc_attr( $field_class ); ?>">
                    <?php if ( ! empty( $label ) ) : ?>
                        <label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?><?php if ( $required ) : ?> <span class="required">*</span><?php endif; ?></label>
                    <?php endif; ?>
                    <select id="<?php echo esc_attr( $name ); ?>" 
                            name="<?php echo esc_attr( $name ); ?><?php if ( $multiple ) : ?>[]<?php endif; ?>"
                            <?php echo esc_attr( $multiple ); ?>
                            <?php echo esc_attr( $required ); ?>>
                        <?php foreach ( $options as $opt ) : ?>
                            <option value="<?php echo esc_attr( $opt['value'] ); ?>">
                                <?php echo esc_html( $opt['label'] ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php
                break;
                
            case 'checkbox':
            case 'radio':
                $options = ! empty( $field['options'] ) ? $field['options'] : array();
                $orientation = ! empty( $field['orientation'] ) ? $field['orientation'] : 'vertical';
                ?>
                <div class="<?php echo esc_attr( $field_class ); ?> field-<?php echo esc_attr( $type ); ?> orientation-<?php echo esc_attr( $orientation ); ?>">
                    <?php if ( ! empty( $label ) ) : ?>
                        <label class="field-group-label"><?php echo esc_html( $label ); ?><?php if ( $required ) : ?> <span class="required">*</span><?php endif; ?></label>
                    <?php endif; ?>
                    <?php foreach ( $options as $i => $opt ) : ?>
                        <label class="ct-option-label">
                            <input type="<?php echo esc_attr( $type ); ?>" 
                                   name="<?php echo esc_attr( $name ); ?><?php if ( 'checkbox' === $type ) : ?>[]<?php endif; ?>"
                                   value="<?php echo esc_attr( $opt['value'] ); ?>">
                            <span><?php echo esc_html( $opt['label'] ); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?php
                break;
                
            case 'file':
                $accept = ! empty( $field['accept'] ) ? $field['accept'] : '';
                $max_size = ! empty( $field['max_size'] ) ? absint( $field['max_size'] ) : 0;
                ?>
                <div class="<?php echo esc_attr( $field_class ); ?>">
                    <?php if ( ! empty( $label ) ) : ?>
                        <label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?><?php if ( $required ) : ?> <span class="required">*</span><?php endif; ?></label>
                    <?php endif; ?>
                    <input type="file" 
                           id="<?php echo esc_attr( $name ); ?>" 
                           name="<?php echo esc_attr( $name ); ?>"
                           accept="<?php echo esc_attr( $accept ); ?>"
                           data-max-size="<?php echo esc_attr( $max_size ); ?>"
                           <?php echo esc_attr( $required ); ?>>
                </div>
                <?php
                break;
                
            case 'html':
                ?>
                <div class="<?php echo esc_attr( $field_class ); ?> field-html">
                    <?php echo wp_kses_post( $field['html'] ); ?>
                </div>
                <?php
                break;
                
            case 'divider':
                $level = ! empty( $field['level'] ) ? $field['level'] : 'h3';
                ?>
                <div class="<?php echo esc_attr( $field_class ); ?> field-divider">
                    <<?php echo esc_attr( $level ); ?>><?php echo esc_html( $field['text'] ); ?></<?php echo esc_attr( $level ); ?>>
                </div>
                <?php
                break;
                
            default: // text, email, tel, url, number
                $input_type = in_array( $type, array( 'email', 'tel', 'url', 'number' ) ) ? $type : 'text';
                $min = isset( $field['min'] ) ? $field['min'] : '';
                $max = isset( $field['max'] ) ? $field['max'] : '';
                $pattern = ! empty( $field['pattern'] ) ? $field['pattern'] : '';
                ?>
                <div class="<?php echo esc_attr( $field_class ); ?>">
                    <?php if ( ! empty( $label ) ) : ?>
                        <label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?><?php if ( $required ) : ?> <span class="required">*</span><?php endif; ?></label>
                    <?php endif; ?>
                    <input type="<?php echo esc_attr( $input_type ); ?>" 
                           id="<?php echo esc_attr( $name ); ?>" 
                           name="<?php echo esc_attr( $name ); ?>"
                           placeholder="<?php echo esc_attr( $placeholder ); ?>"
                           <?php if ( $min !== '' ) : ?>min="<?php echo esc_attr( $min ); ?>"<?php endif; ?>
                           <?php if ( $max !== '' ) : ?>max="<?php echo esc_attr( $max ); ?>"<?php endif; ?>
                           <?php if ( ! empty( $pattern ) ) : ?>pattern="<?php echo esc_attr( $pattern ); ?>"<?php endif; ?>
                           <?php echo esc_attr( $required ); ?>>
                </div>
                <?php
        }
    }
}

/**
 * Render modal action button
 *
 * @param array  $button   Button configuration.
 * @param string $modal_id Modal ID.
 * @return void
 */
function clean_theme_render_modal_action_button( $button, $modal_id ) {
    $text       = ! empty( $button['text'] ) ? $button['text'] : '';
    $type       = ! empty( $button['type'] ) ? $button['type'] : 'close';
    $link       = ! empty( $button['link'] ) ? $button['link'] : '#';
    $style      = ! empty( $button['style'] ) ? $button['style'] : 'primary';
    $icon       = ! empty( $button['icon'] ) ? $button['icon'] : '';
    $position   = ! empty( $button['position'] ) ? $button['position'] : 'center';
    $js_function = ! empty( $button['js_function'] ) ? $button['js_function'] : '';
    
    $button_class = 'ct-btn ct-btn-' . $style . ' btn-position-' . $position;
    
    $attrs = array(
        'class' => $button_class,
    );
    
    if ( 'link' === $type ) {
        $attrs['href'] = esc_url( $link );
        $attrs['target'] = ! empty( $button['new_tab'] ) ? '_blank' : '_self';
    } elseif ( 'close' === $type ) {
        $attrs['data-modal-close'] = esc_attr( $modal_id );
    } elseif ( 'js' === $type ) {
        $attrs['onclick'] = esc_js( $js_function );
    } else { // submit
        $attrs['type'] = 'submit';
    }
    
    $attr_string = '';
    foreach ( $attrs as $key => $value ) {
        $attr_string .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
    }
    
    echo '<a' . $attr_string . '>';
    
    if ( ! empty( $icon ) ) {
        echo '<span class="btn-icon">' . wp_kses( $icon, array( 'svg' => array( 'viewBox' => array(), 'width' => array(), 'height' => array(), 'fill' => array(), 'stroke' => array(), 'stroke-width' => array(), 'line' => array( 'x1' => array(), 'y1' => array(), 'x2' => array(), 'y2' => array() ) ) ) ) . '</span>';
    }
    
    echo esc_html( $text );
    echo '</a>';
}

/**
 * Get modal trigger shortcode output
 *
 * @param array  $atts Shortcode attributes.
 * @param string $content Shortcode content.
 * @return string
 */
function clean_theme_modal_trigger_shortcode( $atts, $content = '' ) {
    $atts = shortcode_atts( array(
        'id'    => '',
        'text'  => '',
        'class' => '',
    ), $atts );
    
    if ( empty( $atts['id'] ) ) {
        return '';
    }
    
    $text = ! empty( $content ) ? $content : ( ! empty( $atts['text'] ) ? $atts['text'] : __( 'Open', 'clean-theme' ) );
    $class = ! empty( $atts['class'] ) ? ' ' . sanitize_html_class( $atts['class'] ) : '';
    
    return sprintf(
        '<button type="button" class="ct-modal-trigger%s" data-modal-trigger="%s">%s</button>',
        esc_attr( $class ),
        esc_attr( sanitize_title( $atts['id'] ) ),
        esc_html( $text )
    );
}
add_shortcode( 'modal_trigger', 'clean_theme_modal_trigger_shortcode' );

/**
 * PHP function to render modal trigger button
 *
 * @param string $modal_id Modal ID.
 * @param string $text     Button text.
 * @param string $class    Additional CSS classes.
 * @return void
 */
function render_modal_trigger( $modal_id, $text = '', $class = '' ) {
    if ( empty( $modal_id ) ) {
        return;
    }
    
    $text = ! empty( $text ) ? $text : __( 'Open', 'clean-theme' );
    $class = ! empty( $class ) ? ' ' . sanitize_html_class( $class ) : '';
    
    printf(
        '<button type="button" class="ct-modal-trigger%s" data-modal-trigger="%s">%s</button>',
        esc_attr( $class ),
        esc_attr( sanitize_title( $modal_id ) ),
        esc_html( $text )
    );
}
