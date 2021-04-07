<!doctype html>
<html <?php language_attributes();?>>

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
    </div><!-- .o-preloader -->

    <header id="masthead" class="<?php cavatina_get_header_class()?>">
        <div class="c-header__holder js-nav">

            <button class="c-header__search js-header__search"></button><!-- Header__Search button -->

            <button class="c-header__menu js-menu" aria-label="<?php esc_attr( 'Menu Button', 'cavatina' ) ?>"
                aria-controls="primary-menu" aria-expanded="false" onClick="cavatina_blurToggle()">
            </button><!-- header__menu Burger -->

            <?php
               if ( has_nav_menu( 'primary-menu' ) ) {
                   wp_nav_menu(
                        array(
                            'theme_location'  => 'primary-menu',
                            'menu_id'         => 'primary-menu-registered',
                            'menu_class'      => 's-nav',
                            'container_class' => 'c-nav js-navigation',
                            'container'       => 'nav',
                        ));
                }
            ?>
            <!-- primary-menu -->

            <div class="c-header__logo js-logo">
                <?php cavatina_handle_logo(); ?>
            </div><!-- Header__Logo -->

        </div> <!-- header__holder-->
    </header> <!-- #masthead -->

    <div class="c-search__overlay js-search__overlay">
        <?php get_search_form(); ?>
    </div><!-- .c-search__overlay -->
    <div class="o-overlay js-overlay"></div><!-- .o-overlay -->

    <div id="page" class="<?php cavatina_get_page_class(); ?>">