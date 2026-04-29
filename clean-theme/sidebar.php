<?php
/**
 * Template for displaying sidebar
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
    <?php dynamic_sidebar( 'sidebar' ); ?>
</aside>
