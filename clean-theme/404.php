<?php
/**
 * Template for displaying 404 error page
 *
 * @package Clean_Theme
 * @since 1.0.0
 */

get_header(); ?>

<div class="content-area" id="primary">
    <main id="main" class="site-main">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'clean-theme' ); ?></h1>
            </header>

            <div class="page-content">
                <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'clean-theme' ); ?></p>

                <?php get_search_form(); ?>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
