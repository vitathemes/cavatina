<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-cavatina
 */

get_header();
?>
<aside class="o-page__col c-aside">
    <div class="c-aside__content">
        <div class="c-aside__wrapper">
            <div class="c-aside__context">
                <span class="c-aside__title"><?php cavatina_post_type_name();  ?></span>
                <span class="c-aside__counter"><?php cavatina_total_post_types(); ?> Portfolios</span>
            </div>
            <div class="c-search__icon js-search__icon"></div>
        </div>
        <div class="c-search js-search">
            <div class="c-search__holder">
                <?php get_search_form(); ?>
            </div>
        </div>

    </div>
</aside>
<main class="o-page__main js-page__main">
    <div class="o-page__col c-content c-content--max-height">
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
                        the_posts_navigation();
                    else :
                        get_template_part('template-parts/content', 'none');
                    endif;
                    ?>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
</main><!-- #main -->
