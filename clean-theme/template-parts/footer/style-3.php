<?php
/**
 * Footer Style 3: 4 Columns (Full Widget Grid)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class="footer-content footer-style-3">
    <div class="footer-column"><?php if ( is_active_sidebar( 'footer-1' ) ) { dynamic_sidebar( 'footer-1' ); } ?></div>
    <div class="footer-column"><?php if ( is_active_sidebar( 'footer-2' ) ) { dynamic_sidebar( 'footer-2' ); } ?></div>
    <div class="footer-column"><?php if ( is_active_sidebar( 'footer-3' ) ) { dynamic_sidebar( 'footer-3' ); } ?></div>
    <div class="footer-column"><?php if ( is_active_sidebar( 'footer-4' ) ) { dynamic_sidebar( 'footer-4' ); } ?></div>
</div>
