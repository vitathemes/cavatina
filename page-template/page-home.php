<?php /* Template Name: Home */ ?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>


    <div id="page" class="c-site">

        <div class="u-header-space"></div>

        <header id="masthead" class="c-header c-header--home">

            <div class="c-header__holder c-header__holder--home js-nav">


                <div class="c-logo--block c-logo--home">
                    <img class="o-logo c-logo__image--rotateless"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="logo" />
                </div>

                <p class="o-descripttion o-description--home">digital creativity</p>

                <button class="o-toggle c-toggle--block c-toggle--home" aria-controls="primary-menu"
                    aria-expanded="false">
                    <img class="o-header__image"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/hamburger-menu.svg"
                        alt="hamburger" />
                </button>

                <div class="o-search--block c-search--home">
                    <img class="o-search " src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg"
                        alt="hamburger" />
                </div>

                <?php
                                wp_nav_menu(
                                    array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'primary-menu',
                                    "menu_class" => "c-nav", // nesting 
                                    "container_class" => "c-nav",
                                    "container" => "nav",
                                    )
                                );
                ?>

            </div>
        </header>

        <section class="c-home">

            <div class="c-home__context c-home__context--left">

                <!-- <div class="c-context__item c-context__item--top">
                </div> -->

                <div class="c-context__item c-context__item--bottom">

                    <div class="c-context__navigation">
                        <p class="o-navigation_title">Navigation</p>
                        <?php
                            wp_nav_menu(
                                array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu',
                                "menu_class" => "c-nav", // nesting 
                                "container_class" => "c-nav",
                                "container" => "nav",
                                )
                            );
                        ?>
                    </div>


                    <div class="c-carousel__text">

                        <p class="o-carousel__title">Recent Projects</p>

                        <h3 class="o-home-carousel__post-title">01 . Advertisement Poster</h3>

                        <a href="#" class="o-carousel__more">View All Projects</a>
                    </div>

                </div>

            </div>

            <div class="c-home__context home__context--right">


                <div class="c-carousel">

                    <div class="c-carousel__title">
                        <p class="o-carousel__title">Recent Projects</p>
                    </div>

                    <div class="c-carousel__slider">

                        <div class="carousel">
                            <div class="carousel-cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />




                            </div>
                            <div class="carousel-cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />

                            </div>
                            <div class="carousel-cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />

                            </div>
                            <div class="carousel-cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />

                            </div>
                            <div class="carousel-cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />

                            </div>
                        </div>


                    </div>

                    <h3 class="c-carousel__post-title">01 . Advertisement Poster</h3>

                </div>

            </div>
        </section>

        <!-- #masthead -->

        <?php get_footer(); ?>
    </div>