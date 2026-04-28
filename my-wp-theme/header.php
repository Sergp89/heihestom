<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'dental-clinic'); ?></a>

<header id="masthead" class="site-header">
    <div class="container header-content">
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
            <?php endif; ?>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'depth'          => 2,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>

        <button class="hamburger-menu" id="hamburger-menu" aria-label="<?php esc_attr_e('Toggle menu', 'dental-clinic'); ?>">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<div class="menu-overlay" id="menu-overlay"></div>

<div class="mobile-menu-panel" id="mobile-menu-panel">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'mobile-menu',
        'container'      => false,
        'depth'          => 2,
        'fallback_cb'    => false,
    ));
    ?>
</div>

<div id="content" class="site-content">