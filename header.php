<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package cavatina
*/?>
<!doctype html>
<html <?php language_attributes();?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <noscript>
        <style>
        /*Reinstate scrolling for non-JS clients*/
        .simplebar-content-wrapper {
            overflow: auto;
        }
        </style>
    </noscript>
</head>

<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#wrapper"><?php esc_html_e( 'Skip to content', 'cavatina' ); ?></a>
    <?php wp_body_open(); ?>

    <div class="o-preloader">
        <div class="o-preloader__loader">
            <span class="o-preloader__circle"></span>
        </div>
    </div><!-- .preloader -->
    <header id="masthead" class="c-header js-header">
        <div class="c-header__holder js-nav">
            <div class="c-header__logo js-logo">

                <?php cavatina_handle_logo(); ?>

            </div>
            <button class="c-header__menu js-menu" aria-controls="primary-menu" aria-expanded="false"
                onClick="blurToggle()">
            </button>
            <div class="c-header__search js-header__search"></div>
            <?php
               if ( has_nav_menu( 'menu-1' ) ) {
                   wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu-registered',
                            "menu_class" => "s-nav ",
                            "container_class" => "c-nav js-navigation",
                            "container" => "nav",
                        ));
                }
            ?>
        </div>

    </header> <!-- #masthead -->
    <div class="c-search__overlay js-search__overlay">
        <?php get_search_form(); ?>
    </div>
    <div class="o-overlay js-overlay"></div>
    <div id="page" class="o-page js-page">