=== Clean Theme ===
Contributors: your-name
Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready, blog, e-commerce, flexible-header, footer-widgets, full-width-template, theme-options
Requires at least: 5.9
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A clean, modular WordPress theme with full Customizer support and floating action buttons.

== Description ==

Clean Theme is a universal, minimalist WordPress theme built according to official WordPress development standards. It features:

* Full customization via the WordPress Customizer (no code required)
* Gutenberg block editor support
* Responsive, mobile-first design
* Floating action buttons for contact (scroll-to-top, phone, messenger, contact form)
* Multiple footer layout styles
* Typography and color controls
* Widget areas for header and footer
* Translation ready

== Installation ==

1. Upload the theme folder to `/wp-content/themes/`
2. Activate the theme via Appearance > Themes in WordPress admin
3. Go to Appearance > Customize to configure all settings

== Frequently Asked Questions ==

= How do I configure the floating buttons? =
Go to Appearance > Customize > Floating Action Buttons to enable and configure each button type.

= Can I change the footer style? =
Yes! Go to Appearance > Customize > Footer Settings and choose from 4 different layout styles.

= How do I add widgets to the header? =
Enable header widgets in Appearance > Customize > Header Settings, then go to Appearance > Widgets.

== Changelog ==

= 1.0.0 =
* Initial release

== Credits ==

* Built according to WordPress Theme Handbook and Coding Standards
* Uses vanilla JavaScript (no jQuery dependency)
* Mobile-first responsive design

================================================================================
CHILD THEME SUPPORT / ПОДДЕРЖКА ДОЧЕРНИХ ТЕМ
================================================================================

This theme fully supports WordPress child themes.

Key features for child theme developers:

1. CONSTANTS FOR PATHS:
   - CLEAN_THEME_PARENT_DIR - Parent theme directory path
   - CLEAN_THEME_PARENT_URI - Parent theme directory URL
   - CLEAN_THEME_DIR - Child theme directory (or parent if no child)
   - CLEAN_THEME_URI - Child theme URL (or parent if no child)

2. TEMPLATE OVERRIDE SYSTEM:
   - Template parts can be overridden by placing files with same path in child theme
   - Files in /inc/ can be overridden in child theme's /inc/ directory
   - Uses locate_template() filter for automatic override detection

3. FILTERS FOR CUSTOMIZATION:
   - clean_theme_customizer_defaults - Modify default customizer values
   - clean_theme_body_classes - Add custom body classes
   - get_template_part_{slug} - Action before template part loads

4. BODY CLASSES:
   - 'using-child-theme' class added when child theme is active

5. SCRIPT/STYLE LOADING:
   - Parent styles loaded from parent directory
   - Child theme style.css loaded after parent (proper cascade)
   - All JS/CSS assets load from parent theme

See readme-child-theme.md for detailed child theme creation guide.

================================================================================
