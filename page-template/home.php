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
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'cavatina' ); ?></a>
    <?php wp_body_open(); ?>
    <div class="o-preloader">
        <div class="o-preloader__loader">
            <span class="o-preloader__circle"></span>
        </div>
    </div>
    <header id="masthead" class="c-header c-header--home js-header">
        <div class="c-header__holder js-nav">
            <div class="c-header__logo js-logo">
                <?php  cavatina_handle_logo(); ?>
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

    <div id="page" class="o-page o-page--home js-page">
        <aside class="o-page__col c-aside c-aside--home js-aside">
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
                        ?>
                </div>
                <?php
                $loop = new WP_Query( array(
                        'post_type' => 'projects',
                        'posts_per_page' => 5
                ));
                ?>
                <div class="c-aside__carousel">
                    <div class="c-carousel c-carousel--aside">
                        <p class="c-carousel__title">Recent Projects</p>
                        <div class="c-carousel__post-titles js-carousel__post-titles">
                            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <?php the_title( '<a href="' . esc_url( get_permalink() ) . '" class="c-carousel__post-title"><span class="o-bullet-decimal-numeric"></span><p class="c-carousel__post-title__text js-carousel__post-title__text">', '</p></a>' ); ?>
                            <?php endwhile; wp_reset_query(); ?>
                        </div>
                    </div>
                    <a href="/projects" class="c-carousel__more">View All Projects</a>
                </div>
            </div>
        </aside>
        <main class="o-page__main js-page__main o-page__main--home">
            <div class="o-page__col c-content c-content--home">
                <div class="c-carousel">
                    <p class="c-carousel__title c-carousel__title--home">Recent Projects</p>
                    <div class="c-carousel__slider">
                        <div class="c-carousel__context js-carousel__context">
                            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <div class="c-carousel__cell">
                                <a href="<?php echo esc_html(get_permalink()); ?>">
                                    <?php //cavatina_get_home_carousel_thumbnail(); ?>
                                    <?php cavatina_get_thumbnail_with_preloader("c-carousel__image"); ?>
                                </a>
                            </div>
                            <?php endwhile; wp_reset_query(); ?>
                        </div>
                    </div>
                    <div
                        class="c-carousel__post-titles js-carousel__post-titles c-carousel__post-titles--mobile js-carousel__post-titles--mobile">
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <?php the_title( '<a href="' . esc_url( get_permalink() ) . '" class="c-carousel__post-title"><span class="o-bullet-decimal-numeric-small"></span><p class="c-carousel__post-title__text js-carousel__post-title__text-mobile">', '</p></a>' ); ?>
                        <?php endwhile; wp_reset_query(); ?>
                    </div>
                    <a href="/projects" class="c-carousel__more c-carousel__more--home">View All Projects</a>
                </div>
            </div>
        </main>
        <?php get_footer(); ?>
    </div>