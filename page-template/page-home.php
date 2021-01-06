<?php /* Template Name: Home */ ?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> onload="mainPageCarousels()">

    <?php wp_body_open(); ?>
    <header id="masthead" class="c-header c-header--home">
        <div class="c-header__holder js-nav">
            <div class="c-header__logo">
                <img class="c-header__logo__image" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg"
                    alt="logo" />
                <!-- <h1>Cavatina</h1> -->
                <p class="c-header__text ">digital creativity</p>
            </div>

            <button class="c-header__menu" aria-controls="primary-menu" aria-expanded="false" onClick="blurToggle()">
            </button>
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

    <div class="c-search__overlay">
        <?php get_search_form(); ?>
    </div>

    <div id="page" class="o-page o-page--home js-page">

        <aside class="o-page__col c-aside c-aside--home">
            <div class="c-aside__content">
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
                        <div class="c-carousel__post-titles js-carousel__post-titles">
                            <a href="#" class="c-carousel__post-title"><span
                                    class="o-bullet-numeric"></span>Advertisement
                                Poster</a>
                            <a href="#" class="c-carousel__post-title"><span class="o-bullet-numeric"></span>special
                                event or
                                exhibit poster
                                concept</a>
                            <a href="#" class="c-carousel__post-title"><span
                                    class="o-bullet-numeric"></span>Advertisement
                                Poster</a>
                            <a href="#" class="c-carousel__post-title"><span
                                    class="o-bullet-numeric"></span>Advertisement
                                Poster</a>
                            <a href="#" class="c-carousel__post-title"><span
                                    class="o-bullet-numeric"></span>Advertisement
                                Poster</a>
                        </div>
                    </div>
                    <a href="#" class="c-carousel__more">View All Projects</a>
                </div>
            </div>
        </aside>
        <main class="o-page__main js-page__main">
            <div class="o-page__col c-content c-content--home">
                <div class="c-carousel">
                    <div class="c-carousel__title">
                        <p class="c-carousel__title c-carousel__title--home">Recent Projects</p>
                    </div>
                    <div class="c-carousel__slider">
                        <div class="c-carousel__context js-carousel__context">
                            <div class="c-carousel__cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/static-samples/img(1).png"
                                    alt="Advertisment poster" />
                            </div>
                            <div class="c-carousel__cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/static-samples/img(1).jpg"
                                    alt="Advertisment poster" />
                            </div>
                            <div class="c-carousel__cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/static-samples/img(2).jpg"
                                    alt="Advertisment poster" />
                            </div>
                            <div class="c-carousel__cell">
                                <img class="c-carousel__image"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/static-samples/img(2).png"
                                    alt="Advertisment poster" />
                            </div>
                        </div>
                    </div>
                    <div class="c-carousel__post-titles js-carousel__post-titles c-carousel__post-titles--mobile js-carousel__post-titles--mobile">
                        <h3 class="c-carousel__post-title"><span class="o-bullet-numeric"></span>Advertisement Poster
                        </h3>
                        <h3 class="c-carousel__post-title"><span class="o-bullet-numeric"></span>Advertisement Poster
                        </h3>
                        <h3 class="c-carousel__post-title"><span class="o-bullet-numeric"></span>Advertisement Poster
                        </h3>
                        <h3 class="c-carousel__post-title"><span class="o-bullet-numeric"></span>Advertisement Poster
                        </h3>
                        <h3 class="c-carousel__post-title"><span class="o-bullet-numeric"></span>Advertisement Poster
                        </h3>
                    </div>
                    <a href="#" class="c-carousel__more c-carousel__more--home">View All Projects</a>
                </div>
            </div>
        </main>
        <!-- #masthead -->
        <?php get_footer(); ?>
    </div>
