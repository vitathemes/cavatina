<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package cavatina
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#wrapper"><?php esc_html_e( 'Skip to content', 'cavatina' ); ?></a>
    <?php wp_body_open(); ?>
    <div class="o-preloader">
        <div class="o-preloader__loader">
            <span class="o-preloader__circle"></span>
        </div>
    </div>
    <header id="masthead" class="c-header c-header--home c-header--404 js-header">
        <div class="c-header__holder js-nav">
            <div class="c-header__logo js-logo">

                <?php cavatina_handle_logo(); ?>
                <?php  cavatina_handle_description(); ?>

            </div>
            <button class="c-header__menu" aria-controls="primary-menu" aria-expanded="false" onClick="blurToggle()">
            </button>
            <div class="c-header__search js-header__search"></div>
            <?php
        if ( has_nav_menu( 'menu-1' ) ) {
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu-registered',
                    "menu_class" => "s-nav",
                    "container_class" => "c-nav js-navigation",
                    "container" => "nav",
                )
            );
        }

        ?>
        </div>
    </header> <!-- #masthead -->
    <div class="c-search__overlay js-search__overlay">
        <?php get_search_form(); ?>
    </div>
    <div class="o-overlay js-overlay"></div>

    <div id="page" class="o-page js-page o-page--404">

        <main class="o-page__main js-page__main o-page__main--404" id="wrapper">
            <section class="o-page__main__error-404 not-found">
                <header class="o-page__main__header">
                    <h1 class="o-page__main__error">404 ERROR</h1>
                    <h2 class="o-page__main__error-desc"> This page not found; <br /> back to home and start again </h2>
                </header><!-- .page-header -->
                <div class="o-page__main__content">
                    <div class="c-social-media c-social-media--404">
                        <?php cavatina_get_social_media(); ?>
                    </div>
                    <a href=<?php echo esc_url( home_url() ); ?>><button class="button--small">Back to Home</button></a>
                </div><!-- .page-content -->
            </section><!-- .error-404 -->
            <?php get_footer(); ?>
        </main><!-- #main -->
    </div>