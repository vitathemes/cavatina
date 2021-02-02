<?php
/**
 * * Template Name: Content nosidebar
 * 
 * * The template for displaying pages with sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cavatina
 */

get_header();
?>

<!-- Aside -->
<aside class="o-page__col c-aside js-aside">
    <div class="c-aside__content">
        <div class="c-aside__wrapper c-aside__wrapper--full-width">
            <div class="c-aside__context">
                <span class="c-aside__title"><?php cavatina_get_current_page_name(); ?></span>
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
<main id="primary" class="o-page__main js-page__main o-page__main--page-single o-page__main--privacy">
    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'no-sidebar' );
        
    endwhile; // End of the loop.
    ?>
    <?php get_footer();?>
</main><!-- #main -->