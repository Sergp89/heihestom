<?php
/**
 * Footer Style 4: Minimal (Center, Copyright + Social)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class="footer-content footer-style-4">
    <div class="footer-minimal">
        <?php if ( has_custom_logo() ) : ?><div class="footer-logo"><?php the_custom_logo(); ?></div><?php endif; ?>
        <p class="footer-tagline"><?php bloginfo( 'description' ); ?></p>
        <?php if ( is_active_sidebar( 'footer-social' ) ) : ?><div class="footer-social"><?php dynamic_sidebar( 'footer-social' ); ?></div><?php endif; ?>
    </div>
</div>
