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

<main class="o-page__main">





    <div class="c-blog">


        <?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content','blog' );

			// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.

			
			?>



    </div>


</main><!-- #main -->

<?php
get_sidebar();
get_footer();