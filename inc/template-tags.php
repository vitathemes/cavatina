<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cavatina
 */

if ( ! function_exists( 'wp_cavatina_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function wp_cavatina_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'wp-cavatina' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wp_cavatina_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wp_cavatina_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'wp-cavatina' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wp_cavatina_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function wp_cavatina_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'wp-cavatina' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wp-cavatina' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'wp-cavatina' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wp-cavatina' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wp-cavatina' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-cavatina' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'wp_cavatina_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function wp_cavatina_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

<div class="post-thumbnail">
    <?php the_post_thumbnail(); ?>
</div><!-- .post-thumbnail -->

<?php else : ?>

<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
    <?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
	?>
</a>

<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


 
function cavatina_get_slider($postId){
 	/**
     * Display slider if plugin was activated
     *
     * @since 1.0.0
     *
     */
	if ( ! class_exists( 'acf_plugin_photo_gallery' ) ){	
		echo '<div class="c-carousel__single__cell">';
		
			the_post_thumbnail('large', ['class' => 'c-carousel__single__cell__image', 'title' => 'Feature image']);

		echo '</div>';
	}
	else {
		
		$images = acf_photo_gallery('gallery', $postId);
		
		if( count($images) ){
	
			foreach($images as $image) {
					
				$id = $image['id'];
				$title = $image['title'];
				$caption= $image['caption'];
				$full_image_url= $image['full_image_url'];
				$thumbnail_image_url= $image['thumbnail_image_url'];
				$url= $image['url'];
				$target= $image['target'];
				$alt = get_field('photo_gallery_alt', $id);
					
				echo '
					<div class="c-carousel__single__cell">
						<img class="c-carousel__single__cell__image" src="'.$full_image_url.'" alt="'. $title .'" />
					</div>';
			}

		}
		else{
						
			echo '<div class="c-carousel__single__cell">';
			
		    	the_post_thumbnail('large', ['class' => 'c-carousel__single__cell__image', 'title' => 'Feature image']);

			echo '</div>';			
		}
	}	
 } 



/**
 * Handle Logo - If logo doesn't exist show wordpress Site title name
 */
function cavatina_handle_logo(){

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

    if ( has_custom_logo() ) {

        $custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		
		echo '<a class="c-header__logo__anchor" href="'.esc_url( home_url() ).'">';
		echo '<img class="c-header__logo__image" src="' . $image[0] . '" alt="' . get_bloginfo( 'name' ) . '">';
		echo "</a>";

    } else {
        echo '<h1 class="c-header__logo__text">'. get_bloginfo( 'name' ) .'</h1>';
    }
}

/**
 * Render load more button
 */
function cavatina_load_more_button($query) { 
	if ( $query->max_num_pages > 1 ){
		echo '<div class="c-pagination c-pagination--load-more js-pagination__load-more"><button class="button--small js-pagination__load-more__btn">Load More</button></div>'; // you can use <a> as well
		}
}