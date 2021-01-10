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
 * @package wp-cavatina
 */

get_header();
?>
<aside class="o-page__col c-aside">
    <div class="c-aside__content">
        <div class="c-aside__wrapper">
            <div class="c-aside__context">
                <span class="c-aside__title"><?php global $post; $post_slug=$post->post_name; echo $post_slug; ?></span>
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
<main id="primary" class="o-page__main js-page__main">
    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
        ?>
    <?php get_footer();?>
</main><!-- #main -->