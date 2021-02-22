<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
        <div class="c-aside__wrapper">
            <div class="c-aside__context">
                <span class="c-aside__title"><?php cavatina_get_current_page_name(); ?></span>
            </div>
        </div>

    </div>
</aside>

<?php
    // get mobile search bar
    get_template_part( 'template-parts/searchbar');
?>

<!-- Main content-->
<main id="primary" class="o-page__main js-page__main o-page__main--page-single">
    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		
		endwhile; // End of the loop.
        ?>
    <?php get_footer();?>
</main><!-- #main -->