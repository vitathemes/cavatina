<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp-cavatina
 */

get_header();
?>

<aside class="o-page__col c-aside c-aside--blog">
    <div class="c-aside__content">
        <div class="c-aside__context">
            <span class="c-aside__title">Blog</span>
        </div>
        <div class="c-search__icon"></div>
        <div class="c-search">
            <div class="c-search__holder">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</aside>
<main class="o-page__main o-page__main--blog">
    <div class="c-blog">
        <?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'blog' );
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; // End of the loop.
			?>
    </div>

    <?php get_footer();?>
</main><!-- #main -->