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
			esc_html_x( 'Posted on %s', 'post date', 'cavatina' ),
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
			esc_html_x( 'by %s', 'post author', 'cavatina' ),
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
			$categories_list = get_the_category_list( esc_html__( ', ', 'cavatina' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'cavatina' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'cavatina' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'cavatina' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'cavatina' ),
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
					__( 'Edit <span class="screen-reader-text">%s</span>', 'cavatina' ),
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
				array( 'alt' => the_title_attribute( array( 'echo' => false ) ) , )
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


/**
  * Handle Logo - If logo doesn't exist show WordPress Site title name
  */
function cavatina_handle_logo(){

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

    if ( has_custom_logo() ) {

        $custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		echo '<a class="c-header__logo__anchor" href="'.esc_url( home_url() ).'">';
		echo '<img class="c-header__logo__image" src="' . esc_html($image[0]) . '" alt="' . esc_html(get_bloginfo( 'name' )) . '">';
		echo "</a>";


    }else {
        echo '<h1 class="c-header__logo__text">'. esc_html( get_bloginfo( 'name' ) ) .'</h1>';
    }
}


if ( ! function_exists( 'cavatina_get_category' ) ) :
	/**
	 * Prints HTML of the categories.
	 */
	function cavatina_get_category() {

		$categories = get_the_category();
		$separator = ', ';
		$output = '';
		if ( ! empty( $categories ) ) {
			foreach( $categories as $category ) {
				/* translators: used between list items, there is a space after the comma */
				$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'cavatina' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
			}
			echo  wp_kses_post(trim( $output, $separator ));
		}
	}


endif;




if ( ! function_exists( 'cavatina_category_filter' ) ) :
	/**
	 * Prints HTML of the categories.
	 */
	function cavatina_category_filter( $className = "" ,  $getSeparator = ", ") {

		$categories = get_the_category();
		$separator = $getSeparator;
		$output = '';
		if( ! empty($className)){
			$className = 'class="'. $className.'"';
		}
		if ( ! empty( $categories ) ) {
			foreach( $categories as $category ) {
				/* translators: used between list items, there is a space after the comma */
				$output .= '<a '. $className .' href="/'.get_post_type().'/?cat=' . esc_html( $category->cat_ID  ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'cavatina' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
			}
			echo  wp_kses_post(trim( $output, $separator ));
		}
	}


endif;




if ( ! function_exists( 'cavatina_get_date' ) ) :
	/**
	 * Prints HTML of the date.
	 */
	function cavatina_get_date() {
	
		return get_the_date( "F j.y" );
		
	}
endif;


if ( ! function_exists( 'cavatina_get_date_my' ) ) :
	/**
	 * Prints HTML of the date.
	 */
	function cavatina_get_date_my() {
	
		return get_the_date( "M Y" );
		
	}
endif;


if ( ! function_exists( 'cavatina_get_date_tertiary' ) ) :
	/**
	 * Prints HTML of the date.
	 */
	function cavatina_get_date_tertiary() {
		
		return get_the_date( "M d.y" );
		
	}
endif;


if (! function_exists('cavatina_get_thumbnail')) :
	/**
	 * return thumbnail for single blog 
	 */
	function cavatina_get_thumbnail() {
		if ( has_post_thumbnail() ) {
			echo '<div class="c-single__blog__thumbnail">';
			the_post_thumbnail('large', array('class' => 'c-single__blog__thumbnail__image' )); 
			echo '</div>';
		}
		else {
			echo '<div class="c-single__blog__no-thumbnail"></div>';
		}
	}
endif;


if (! function_exists('cavatina_get_posts_archive_thumbnail')) :
	/**
	 * Return thumbnail for archives
	 */
	function cavatina_get_posts_archive_thumbnail() {
		if ( has_post_thumbnail() ) {
			
			$post_url = get_permalink(get_the_ID()); 
			echo '<div class="c-post__thumbnail"><a href="'.esc_url($post_url).'" >'; 
				 the_post_thumbnail('large', array('class' => 'c-post__thumbnail__image' )) ;
			echo '</a></div>';
			
		}
		else {
			
			$post_url = get_permalink(get_the_ID());
			echo '<div class="c-post__thumbnail"><a href="'.esc_url($post_url).'" >'; 
			echo '<img class="c-post__thumbnail__image" src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/no-thumbnail.png" alt="no thumbnail" />';
			echo '</a></div>';
			
		}
	}
endif;


if (! function_exists('cavatina_get_home_carousel_thumbnail')) :
	/**
	 * Return thumbnail for home carousel
	 */
	function cavatina_get_home_carousel_thumbnail() {
		if ( has_post_thumbnail() ) {

			the_post_thumbnail( 'large', array( 'class' => 'c-carousel__image' ));

		}
		else {
			echo '<img class="c-carousel__image" src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/no-thumbnail.png" alt="no thumbnail"  />';
		}
	}
endif;


function cavatina_get_loadmore( $query ) { 
	/**
	 * Render load more button
	 */
	if ( $query->max_num_pages > 1 ){
		echo '
		<div class="c-pagination c-pagination--load-more js-pagination__load-more">
			<button class="button--small js-pagination__load-more__btn">Load More</button>
		</div>'; // you can use <a> as well
	}
}


if (! function_exists('cavatina_get_default_pagination')) :
	/**
	* Show numeric pagination
	*/
	function cavatina_get_default_pagination() {

		echo'  <div class="c-pagination">' . wp_kses_post(paginate_links(
				array(
				'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
				'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
				)
			)) . '</div>';
	}
endif;


if (! function_exists('cavatina_get_site_name')) :
	/**
	* Show site name
	*/
	function cavatina_get_site_name() {

	echo esc_html( get_bloginfo());

	}
endif;


if (! function_exists('cavatina_get_privacy_policy')) :
	/**
	 * get privacy policy link
	 */
	function cavatina_get_privacy_policy() {

		echo esc_url( get_privacy_policy_url());
		
	}
endif;



if (! function_exists('cavatina_get_current_page_name')) :
	/**
	 * get current page name (slug)
	 */
	function cavatina_get_current_page_name() {

		global $post;
		$post_slug = $post->post_name;
		$post_slug = str_replace("-", " ", $post_slug);
		echo esc_html(esc_html($post_slug));
		
	}
endif;


if (! function_exists('cavatina_get_home_page_link')) :
	/**
	* get home page link
	*/
	function cavatina_get_home_page_link() {

		echo esc_url( home_url( '/' ) );

	}
endif;


if (! function_exists('cavatina_get_social_media')) :
	/**
	* get social media 
	*/
	function cavatina_get_social_media() {


		if ( get_theme_mod('linkedin_link') != null) { 
			
			echo '      
			<a href="'. esc_url(get_theme_mod('linkedin_link')) .'" class="c-social-media__item">
				<svg width="16" height="15" viewBox="0 0 16 15" xmlns="http://www.w3.org/2000/svg">
					<path class="c-social-media__icon" fill-rule="evenodd" clip-rule="evenodd"
						d="M0 1.76471C0 0.790086 0.790086 0 1.76471 0C2.23273 0 2.68159 0.185924 3.01254 0.51687C3.34349 0.847817 3.52941 1.29668 3.52941 1.76471C3.52941 2.73933 2.73933 3.52941 1.76471 3.52941C0.790086 3.52941 0 2.73933 0 1.76471ZM15.4412 9.18529C15.4716 7.27491 14.1683 5.60084 12.3088 5.16176C11.0627 4.89344 9.76383 5.24529 8.82353 6.10588V5.73529C8.82353 5.49163 8.62601 5.29411 8.38235 5.29411H6.17647C5.93282 5.29411 5.73529 5.49163 5.73529 5.73529V14.5588C5.73529 14.8025 5.93282 15 6.17647 15H8.38235C8.62601 15 8.82353 14.8025 8.82353 14.5588V9.58235C8.80174 8.69621 9.41934 7.92235 10.2882 7.74705C10.8056 7.65774 11.3359 7.80344 11.735 8.14456C12.1341 8.48568 12.3606 8.98679 12.3529 9.51176V14.5588C12.3529 14.8025 12.5505 15 12.7941 15H15C15.2437 15 15.4412 14.8025 15.4412 14.5588V9.18529ZM3.52941 5.73529V14.5588C3.52941 14.8025 3.33189 15 3.08824 15H0.882353C0.638698 15 0.441176 14.8025 0.441176 14.5588V5.73529C0.441176 5.49164 0.638698 5.29412 0.882353 5.29412H3.08824C3.33189 5.29412 3.52941 5.49164 3.52941 5.73529Z"
						fill="#8A8A8A" />
					</svg>
			</a>';
			
		}
		
		if ( get_theme_mod('facebook_link') != null) { 
			
			echo '      
			<a href="'. esc_url(get_theme_mod('facebook_link')) .'" class="c-social-media__item">
				<svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="c-social-media__icon"
						d="M7.91667 2.5H5.41667C4.95643 2.5 4.58333 2.8731 4.58333 3.33333V5.83333H7.91667C8.01145 5.83123 8.10134 5.87533 8.15769 5.95156C8.21404 6.0278 8.22982 6.12667 8.2 6.21667L7.58333 8.05C7.52651 8.21827 7.36926 8.33201 7.19167 8.33333H4.58333V14.5833C4.58333 14.8135 4.39679 15 4.16667 15H2.08333C1.85321 15 1.66667 14.8135 1.66667 14.5833V8.33333H0.416667C0.186548 8.33333 0 8.14678 0 7.91667V6.25C0 6.01988 0.186548 5.83333 0.416667 5.83333H1.66667V3.33333C1.66667 1.49238 3.15905 0 5 0H7.91667C8.14678 0 8.33333 0.186548 8.33333 0.416667V2.08333C8.33333 2.31345 8.14678 2.5 7.91667 2.5Z"
						fill="#8A8A8A" />
				</svg>
			</a>';
			
		}

		if ( get_theme_mod('github_link') != null) { 
			
			echo '      
			<a href="'. esc_url(get_theme_mod('github_link')) .'" class="c-social-media__item">
				<svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="c-social-media__icon"
						d="M15.3769 7.69418C15.3743 11.0018 13.2565 13.9371 10.1184 14.9823C10.0009 15.0185 9.87332 14.9986 9.7724 14.9285C9.6715 14.8551 9.61156 14.738 9.61096 14.6132V12.5606C9.62759 12.0077 9.49479 11.4606 9.22657 10.9769C9.18599 10.9136 9.18599 10.8326 9.22657 10.7693C9.25775 10.711 9.31485 10.671 9.38032 10.6617C11.2562 10.4695 12.3017 9.72377 12.3017 7.69418C12.3469 6.74653 12.0184 5.819 11.3869 5.11105C11.479 4.812 11.5281 4.50139 11.5329 4.18851C11.5296 3.90799 11.4909 3.62902 11.4176 3.35822C11.3693 3.17765 11.1958 3.05984 11.0101 3.08146C10.3058 3.18144 9.65005 3.49854 9.13431 3.98863C8.17959 3.80416 7.19839 3.80416 6.24368 3.98863C5.72794 3.49854 5.07223 3.18144 4.36784 3.08146C4.18216 3.05984 4.00872 3.17765 3.96038 3.35822C3.88711 3.62902 3.84836 3.90799 3.84506 4.18851C3.84984 4.50139 3.89903 4.812 3.99113 5.11105C3.35956 5.819 3.03106 6.74653 3.07628 7.69418C3.07628 9.8314 4.23714 10.5464 6.36668 10.7232C6.10233 11.0696 5.92087 11.472 5.83622 11.8994C5.83622 11.8994 5.83622 11.9532 5.83622 11.9917C5.83252 12.0275 5.83252 12.0635 5.83622 12.0993C5.80423 12.341 5.58692 12.5142 5.3442 12.4914C5.22846 12.486 5.11545 12.4544 5.01362 12.3991C4.59479 12.1441 4.22506 11.816 3.92194 11.4305C3.72881 11.2115 3.52348 11.0036 3.30691 10.8078C3.16931 10.6886 3.01684 10.5879 2.85333 10.5079C2.73874 10.4436 2.59889 10.4436 2.48431 10.5079C2.37431 10.5785 2.30771 10.7001 2.30749 10.8308V10.8769C2.30771 11.0076 2.37431 11.1293 2.48431 11.1998C2.76028 11.4308 2.99886 11.7031 3.19159 12.0071C3.51708 12.5171 3.93104 12.9649 4.41396 13.3294C4.73215 13.5427 5.10721 13.6552 5.49026 13.6523H5.76703V14.6132C5.76643 14.738 5.70649 14.8551 5.60558 14.9285C5.50467 14.9986 5.37709 15.0185 5.25963 14.9823C1.53259 13.7409 -0.659069 9.88943 0.17747 6.05121C1.01401 2.21298 4.60962 -0.37717 8.5152 0.0450015C12.4208 0.467173 15.3798 3.76584 15.3769 7.69418Z"
						fill="#8A8A8A" />
				</svg>
			</a>';
			
		}

		if ( get_theme_mod('twitter_link') != null) { 
			
			echo '      
			<a href="'. esc_url(get_theme_mod('twitter_link')) .'" class="c-social-media__item">
				<svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="c-social-media__icon"
						d="M17.6205 2.17393C17.1651 2.78129 16.6147 3.3111 15.9906 3.7429C15.9906 3.90156 15.9906 4.06022 15.9906 4.22769C15.9956 7.10894 14.8447 9.87169 12.7959 11.8966C10.7471 13.9215 7.97186 15.0391 5.09225 14.999C3.42748 15.0045 1.78404 14.6244 0.290649 13.8883C0.210126 13.8532 0.158189 13.7735 0.158495 13.6856V13.5886C0.158495 13.4621 0.261052 13.3595 0.387562 13.3595C2.02398 13.3055 3.60203 12.7382 4.89842 11.7376C3.41723 11.7078 2.08454 10.8303 1.47123 9.48111C1.44025 9.40741 1.44989 9.32289 1.49668 9.25808C1.54346 9.19327 1.62063 9.15753 1.70029 9.16379C2.15046 9.20904 2.60512 9.16714 3.03945 9.04039C1.40434 8.70096 0.175742 7.34352 -9.00902e-05 5.68208C-0.00633942 5.60238 0.029378 5.52518 0.0941588 5.47837C0.15894 5.43156 0.24342 5.42191 0.31708 5.4529C0.755872 5.64652 1.22955 5.7485 1.7091 5.75259C0.276359 4.81221 -0.342491 3.02358 0.202546 1.39825C0.258807 1.24032 0.393973 1.12365 0.558374 1.09111C0.722774 1.05858 0.892158 1.11498 1.00428 1.23959C2.93768 3.29731 5.5942 4.52349 8.41372 4.6596C8.3415 4.37142 8.30598 4.07525 8.308 3.77816C8.33437 2.22032 9.29826 0.832559 10.7484 0.264583C12.1986 -0.303393 13.848 0.0608181 14.9245 1.18671C15.6583 1.04692 16.3677 0.800439 17.0302 0.455108C17.0787 0.424812 17.1402 0.424812 17.1888 0.455108C17.219 0.503656 17.219 0.56522 17.1888 0.613768C16.8679 1.34854 16.3258 1.96482 15.6381 2.37666C16.2403 2.30683 16.8319 2.16477 17.4002 1.95357C17.448 1.921 17.5109 1.921 17.5588 1.95357C17.5989 1.9719 17.6288 2.00697 17.6407 2.04943C17.6526 2.09189 17.6452 2.13743 17.6205 2.17393Z"
						fill="#8A8A8A" />
				</svg>
			</a>';
			
		}
	}
endif;


function cavatina_get_slider( $postId ) {
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

			$id 				 = $image['id'];
			$title 			     = $image['title'];
			$caption	 		 = $image['caption'];
			$full_image_url	 	 = $image['full_image_url'];
			$thumbnail_image_url = $image['thumbnail_image_url'];
			$url				 = $image['url'];
			$target				 = $image['target'];
			$alt 				 = get_field('photo_gallery_alt', $id);
			
			echo 
			'<div class="c-carousel__single__cell">
				<img class="c-carousel__single__cell__image js-carousel__single__cell__image" src="'. esc_url($full_image_url).'" alt="'. esc_html($title) .'" />
			</div>';
			
			}
		}
		else{

			if ( has_post_thumbnail() ) {

				echo '<div class="c-carousel__single__cell">';
					the_post_thumbnail('large', ['class' => 'c-carousel__single__cell__image js-carousel__single__cell__image', 'alt' => esc_html( get_the_title() ) ]);
				echo '</div>';
				
			}
			else{
				
				echo '<div class="c-carousel__single__cell">';
				echo 	'<img class="c-carousel__single__cell__image js-carousel__single__cell__image" src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/no-thumbnail.png" alt="no thumbnail" />';
				echo '</div>';

			}

	
		
		}
	}
}