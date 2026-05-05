<?php
/**
 * The footer for our theme
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clean_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
        </div><!-- .ct-container -->
    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <?php
        // Get footer style from Customizer
        $footer_style = get_theme_mod( 'footer_style', 'style-1' );
        
        // Load appropriate footer template part
        get_template_part( 'template-parts/footer/style', $footer_style );
        ?>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php
// Display floating buttons
clean_theme_float_buttons();
?>

<?php wp_footer(); ?>

</body>
</html>
