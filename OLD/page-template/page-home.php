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


    <div id="page" class="o-page">

        <div class="u-header-space"></div>

        <header id="masthead" class="c-header c-header--home">

            <div class="c-header__holder c-header__holder--home js-nav">


                <div class="c-header__item c-header__logo c-header__logo--home">
                    <img class="o-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg"
                        alt="logo" />
                </div>

                <p class="c-header__item c-header__desc c-header__desc--home">digital creativity</p>

                <button class="c-header__item c-header__item--menu-icon c-header__toggle--home"
                    aria-controls="primary-menu" aria-expanded="false">
                    <img class="o-image"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/hamburger-menu.svg"
                        alt="hamburger" />
                </button>

                <div class="c-header__item c-header__item--search c-header__search--home">
                    <img class="o-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg"
                        alt="hamburger" />
                </div>

                <?php
                if ( has_nav_menu( 'menu-1' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu-registered',
                            "menu_class" => "s-nav", // nesting
                            "container_class" => "c-nav",
                            "container" => "nav",
                        )
                    );
                }
                else{

                }
                ?>

            </div>
        </header>

        <section class="o-page__main">

            <div class="o-page__col o-page__col--left">

                <div class="c-aside">

                    <div class="c-aside__nav">
                        <p class="c-aside__nav-title">Navigation</p>


                        <?php
                        if ( has_nav_menu( 'menu-1' ) ) {
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'primary-menu-registered',
                                    "menu_class" => "s-nav", // nesting
                                    "container_class" => "c-nav",
                                    "container" => "nav",
                                )
                            );
                        }
                        else{

                        }
                        ?>
                    </div>


                    <div class="c-aside__carousel">

                        <div class="c-carousel">

                            <p class="c-carousel__title">Recent Projects</p>

                            <div class="c-carousel__post-titles">
                                <a href="#" class="c-carousel__post-title">01 . Advertisement Poster</a>
                                <a href="#" class="c-carousel__post-title">02 . special event or exhibit poster
                                    concept</a>
                                <a href="#" class="c-carousel__post-title">03 . Advertisement Poster</a>
                                <a href="#" class="c-carousel__post-title">04 . Advertisement Poster</a>
                                <a href="#" class="c-carousel__post-title">05 . Advertisement Poster</a>
                            </div>

                        </div>

                        <a href="#" class="c-carousel__more">View All Projects</a>

                    </div>

                </div>

            </div>

            <div class="o-page__col o-page__col--right">


                <div class="c-carousel">

                    <div class="c-carousel__title">
                        <p class="c-carousel__title c-carousel__title--home">Recent Projects</p>
                    </div>

                    <div class="c-carousel__slider">

                        <div class="c-carousel__context">
                            <div class="c-carousel__cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />

                            </div>
                            <div class="c-carousel__cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />

                            </div>
                            <div class="c-carousel__cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />

                            </div>
                            <div class="c-carousel__cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />

                            </div>
                            <div class="c-carousel__cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/carousel.jpg"
                                    alt="Advertisment poster" />

                            </div>
                        </div>
                    </div>



                    <div class="c-carousel__post-titles c-carousel__post-titles--mobile">
                        <h3 class="c-carousel__post-title">01 . Advertisement Poster</h3>
                        <h3 class="c-carousel__post-title">02 . Advertisement Poster</h3>
                        <h3 class="c-carousel__post-title">03 . Advertisement Poster</h3>
                        <h3 class="c-carousel__post-title">04 . Advertisement Poster</h3>
                        <h3 class="c-carousel__post-title">05 . Advertisement Poster</h3>
                    </div>


                    <a href="#" class="c-carousel__more c-carousel__more--home">View All Projects</a>

                </div>

            </div>
        </section>

        <!-- #masthead -->

        <?php get_footer(); ?>
    </div>
