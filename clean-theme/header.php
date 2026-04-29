<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php _e( 'Skip to content', 'clean-theme' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="container header-container">
            
            <!-- Site Branding / Logo -->
            <div class="site-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="custom-logo-link">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </h1>
                    <?php
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) :
                    ?>
                        <p class="site-description"><?php echo $description; ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <!-- Desktop Navigation -->
            <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'clean-theme' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'primary-menu',
                    'container'      => false,
                    'depth'          => 0,
                ) );
                ?>
            </nav><!-- #site-navigation -->

            <!-- Header Widgets (Desktop) -->
            <?php if ( is_active_sidebar( 'header-widgets' ) ) : ?>
                <div class="header-widgets">
                    <?php dynamic_sidebar( 'header-widgets' ); ?>
                </div>
            <?php endif; ?>

            <!-- Mobile Menu Toggle -->
            <button class="menu-toggle" aria-controls="mobile-menu-panel" aria-expanded="false">
                <span class="screen-reader-text"><?php _e( 'Menu', 'clean-theme' ); ?></span>
                <span class="hamburger"></span>
            </button>

        </div><!-- .header-container -->
    </header><!-- #masthead -->

    <!-- Mobile Menu Panel -->
    <div id="mobile-menu-panel" class="mobile-menu-panel" aria-label="<?php esc_attr_e( 'Mobile Menu', 'clean-theme' ); ?>">
        <nav class="mobile-navigation" aria-label="<?php esc_attr_e( 'Mobile Primary Menu', 'clean-theme' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'mobile-primary-menu',
                'menu_class'     => 'mobile-menu',
                'container'      => false,
                'depth'          => 0,
            ) );
            ?>
        </nav>

        <!-- Mobile Contact Widget -->
        <?php if ( is_active_sidebar( 'mobile-contact' ) ) : ?>
            <div class="mobile-contact">
                <?php dynamic_sidebar( 'mobile-contact' ); ?>
            </div>
        <?php endif; ?>
    </div><!-- #mobile-menu-panel -->

    <!-- Menu Overlay -->
    <div class="menu-overlay"></div>
