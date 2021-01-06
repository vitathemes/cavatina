<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wp-cavatina
 */

get_header();
?>


<aside class="o-page__col c-aside">
    <div class="c-aside__content">
        <div class="c-aside__context">
            <span class="c-aside__title c-aside__title--mobile-hide">404 Page</span>
        </div>
        <div class="c-search__icon js-search__icon"></div>
        <div class="c-search js-search">
            <div class="c-search__holder">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</aside>
<main class="o-page__main js-page__main o-page__main--404">
    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="o-page__main__error">404</h1>
            <h2 class="o-page__main__title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wp-cavatina' ); ?></h2>
        </header><!-- .page-header -->

        <div class="page-content">
            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp-cavatina' ); ?>
            </p>
            <?php get_search_form(); ?>
        </div><!-- .page-content -->
    </section><!-- .error-404 -->
    <?php get_footer();?>
</main><!-- #main -->
