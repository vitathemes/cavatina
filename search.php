<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-cavatina
 */

get_header();
global $wp_query;
?>


<!-- Aside -->
<aside class="o-page__col c-aside js-aside">
    <div class="c-aside__content">
        <div class="c-aside__wrapper">
            <div class="c-aside__context">
                <span class="c-aside__title">Result</span>
            </div>
        </div>

    </div>
</aside>

<!-- Searchbar Mobile -->
<section class="c-search">
    <div class="c-search__content">
        <div class="c-search__wrapper">
            <div class="c-search__context">
                <span class="c-search__title">Search</span>
            </div>
            <div class="c-search__icon js-search__icon"></div>
        </div>
        <div class="c-search__form js-search__form">
            <div class="c-search__holder">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</section>

<!-- Main content-->
<main class="o-page__main js-page__main o-page__main--search">
    <div class="o-page__col c-content c-content--max-height c-content--search">
        <div class="c-container site-main__container">
            <div class="c-container__content site-main__content">
                <?php if (have_posts()) : ?>
                <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();
                            /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                            get_template_part('template-parts/content', 'search');
                        endwhile;
                            cavatina_get_default_pagination();
                    else :
                        get_template_part('template-parts/content', 'none');
                    
                    endif;
                    ?>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
</main><!-- #main -->