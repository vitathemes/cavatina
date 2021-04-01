<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package cavatina
 */
 get_header();
?>
<main class="o-page__main js-page__main o-page__main--404" id="wrapper">
    <section class="o-page__main__error-404 not-found">
        <header class="o-page__main__header">
            <h1 class="o-page__main__error"><?php esc_html_e( '404 ERROR', 'cavatina' ); ?></h1>
            <h2 class="o-page__main__error-desc"><?php esc_html_e( ' This page not found; ', 'cavatina' ); ?>
                <br />
                <?php esc_html_e( 'back to home and start again ', 'cavatina' ); ?>
            </h2>
        </header><!-- .o-page__main__header -->
        <div class="o-page__main__content">
            <div class="c-social-media c-social-media--404">
                <?php cavatina_get_social_media(); ?>
            </div>
            <a href=<?php echo esc_url( home_url() ); ?>>
                <button class="button--small">
                    <?php esc_html_e( 'Back to Home', 'cavatina' ); ?>
                </button>
            </a>
        </div><!-- .o-page__main__content -->
    </section><!-- .o-page__main__error-404 -->
    <?php get_footer(); ?>
</main><!-- #main -->
</div>