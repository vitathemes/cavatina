<?php
/**
 * * Template Name: Content No Aside
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

<?php
    // Mobile searchbar
    get_template_part( 'template-parts/searchbar'); 
?>

<!-- Main content-->
<main id="primary" class="o-page__main js-page__main o-page__main--page-single o-page__main--privacy">
    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'no-sidebar' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->
<?php get_footer();?>