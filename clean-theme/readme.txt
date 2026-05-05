=== Clean Theme ===
Contributors: your-name
Tags: responsive, custom-background, custom-logo, custom-menu, editor-style, featured-images, flexible-header, footer-widgets, full-width-template, theme-options, threaded-comments, translation-ready, blog, accessibility-ready
Requires at least: 5.9
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A clean, modular WordPress theme with full Customizer support and advanced modal window functionality.

== Description ==

Clean Theme is a universal, multipurpose WordPress theme built with modern best practices. It features:

* **Full Customizer Integration** - Configure colors, typography, layouts, headers, footers, and more without touching code
* **Modal Window System** - Create unlimited popup modals with customizable forms, animations, and triggers
* **Floating Action Buttons** - Back-to-top, contact buttons, and quick action menus
* **Gutenberg Ready** - Full support for the block editor
* **Accessibility Ready** - WCAG compliant with proper ARIA attributes and keyboard navigation
* **Performance Optimized** - Minimal dependencies, no jQuery required for core functionality
* **Translation Ready** - All strings use WordPress i18n functions

== Features ==

=== Customizer Options ===

1. **General Settings**
   - Logo and site icon upload
   - Container width (fluid, boxed, wide)
   - Smooth scroll toggle

2. **Color Scheme**
   - Primary accent color
   - Text and heading colors
   - Header and footer background colors
   - Style presets (light, dark, minimal)

3. **Typography**
   - Font selection for body and headings
   - Adjustable font sizes (base, H1-H6)

4. **Header Settings**
   - Logo position (left, center, right)
   - Menu layout options
   - Widget area support

5. **Footer Settings**
   - 4 layout styles (2-4 columns, minimal)
   - Copyright toggle
   - Social menu integration

6. **Floating Buttons**
   - Back-to-top button customization
   - Contact button group (phone, messenger, form)
   - Position and styling controls

7. **Modal Windows**
   - Unlimited modal creation via JSON configuration
   - Form builder with multiple field types
   - Animation effects (fade, slide, zoom, bounce)
   - Trigger options (click, scroll, exit-intent, auto-delay)
   - Display conditions (all pages, specific pages, exclusions)

== Modal Window Configuration ==

Modals are configured using JSON in the Customizer. Example:

```json
[
  {
    "id": "contact-form",
    "title": "Contact Us",
    "enabled": true,
    "size": "medium",
    "position": "center",
    "animation_open": "fade",
    "overlay_type": "solid",
    "enable_form": true,
    "form_email": "your@email.com",
    "form_fields": [
      {
        "type": "text",
        "label": "Name",
        "name": "name",
        "required": true
      },
      {
        "type": "email",
        "label": "Email",
        "name": "email",
        "required": true
      },
      {
        "type": "textarea",
        "label": "Message",
        "name": "message",
        "required": true
      }
    ]
  }
]
```

=== Usage ===

**Shortcode:**
`[modal_trigger id="contact-form" text="Open Contact Form"]`

**PHP Function:**
`<?php render_modal_trigger('contact-form', 'Open Form'); ?>`

**Data Attribute:**
`<button data-modal-trigger="contact-form">Click Me</button>`

**JavaScript API:**
`window.CleanThemeModals.open('contact-form');`

== Installation ==

1. Upload the theme folder to `/wp-content/themes/`
2. Activate through WordPress Admin > Appearance > Themes
3. Navigate to Appearance > Customize to configure settings

== Changelog ==

= 1.0.0 =
* Initial release
* Full Customizer integration
* Modal window system
* Floating action buttons
* Responsive design
* Accessibility features

== Credits ==

* Built on WordPress Theme Boilerplate best practices
* Icons from inline SVG (no external dependencies)
* JavaScript uses vanilla JS with optional jQuery for AJAX

== License ==

This theme is licensed under the GPL v2 or later.

== Support ==

For support and documentation, visit [your website].
