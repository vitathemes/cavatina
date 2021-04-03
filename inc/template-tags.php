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

if ( ! function_exists( 'cavatina_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function cavatina_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'cavatina' ),
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
 * Handle Description
 */
function cavatina_handle_description(){
    echo '<span class="c-header__text">'. esc_html(get_bloginfo('description')) .'</span>';
}



function cavatina_handle_logo(){
	/**
  	  * Handle Logo - If logo doesn't exist show WordPress Site title name
  	  */
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	
    if ( has_custom_logo() ) {

        $custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		
		echo '<a class="c-header__logo__anchor" href="'.esc_url( home_url() ).'">';
		echo '<img class="c-header__logo__image" src="' . esc_url($image[0]) . '" alt="' . esc_attr(get_bloginfo( 'name' )) . '">';
		echo "</a>";

    }
	else {

		echo '<a class="c-header__logo__anchor" href="'.esc_url( home_url() ).'">';
        echo '<h1 class="c-header__logo__text">'. esc_html( get_bloginfo( 'name' ) ) .'</h1>';
		echo "</a>";
		
    }

	if( is_page_template( 'page-template/home.php' ) ||  is_404() ){
		return cavatina_handle_description();
	}
	

}


if ( ! function_exists( 'cavatina_get_category' ) ) :
	/**
	 * Return category based on post-type 
	 */
	function cavatina_get_category( $cavatina_isLimited = false) {

		if( ! empty( get_the_category() ) ){
			/* get category */
			$categories = get_the_category();
			$separator = ', ';
			$output = '';
			$category_counter = 0;
			if ( ! empty( $categories ) ) {
			
				foreach( $categories as $category ) {

					if( $cavatina_isLimited === true && $category_counter === 3){
						break;
					}

					$category_counter++;
					/* translators: used between list items, there is a space after the comma */
					$output .= '<a class="c-post__meta__link" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'cavatina' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				}
				echo  wp_kses_post(trim( $output, $separator ));
			}
		}
	
		if ( function_exists( 'libwp' ) ) {
			if( ! empty(get_the_terms(0, 'project_category')) ){
				/* get taxonomy  */
				$custom_taxonomy = get_the_terms(0, 'project_category');
				$separate = ', ';
				$output = '';
				$category_counter = 0;
				if ($custom_taxonomy) {
					foreach ($custom_taxonomy as $custom_tax) {
						
						if( $cavatina_isLimited === true && $category_counter === 3){
							break;
						}

						$category_counter++;
						/* translators: used between list items, there is a space after the comma */
						$output .= '<a class="c-post__meta__link" href="' . esc_url( get_term_link( $custom_tax->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'cavatina' ), $custom_tax->name ) ) . '">' . esc_html( $custom_tax->name ) . '</a>' . $separate;
					}
					echo  wp_kses_post(trim( $output , $separate ));
				}	
			}
		}
		
	}

endif;


if ( ! function_exists( 'cavatina_taxonomy_filter' ) ) :
	/**
	 *  Return taxonomy filter
	 */
	function cavatina_taxonomy_filter( $className = "" ,  $getSeparator = ", ") {
		
		$taxonomies = get_terms( array(
			'taxonomy' => 'project_category',
			'hide_empty' => false
		) );
		 
		$separator = $getSeparator;
		if ( !empty($taxonomies) ) {
			$output = '';
			foreach( $taxonomies as $category ) {
			
				if ($category->count != 0) {
					/* translators: return poject_category items for filtering */
					$output .= '<a class="c-aside__category__link" href="'. site_url() . '/'. get_post_type().'/?project_category=' . esc_html( $category->name ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'cavatina' ), $category->name ) ) . '"><h4>' . esc_html( $category->name ) . '</h4></a>' . $separator;
				}
			}
			echo wp_kses_post(trim( $output ));
		}
	}

endif;


if ( ! function_exists( 'cavatina_get_thumbnail_with_preloader' ) ) :
	/**
	  * Return thumbnail with preloader
	  */
	function cavatina_get_thumbnail_with_preloader( $className = "" ) {
	
		if(!empty($className)){
			$className = $className;
		}

		if ( has_post_thumbnail() ) {
			
			$image_id     = get_post_thumbnail_id();
			$image_url    = get_the_post_thumbnail_url( get_the_ID() , 'large' );
			$image_alt 	  = get_post_meta( $image_id, '_wp_attachment_image_alt', TRUE);
			$image_srcset = wp_get_attachment_image_srcset($image_id , 'medium' , null);
			
			echo '<img class="'. esc_attr( $className ) .'" data-sizes="100w" data-src="'. esc_url( $image_url ) .'"  src="'. esc_url( get_stylesheet_directory_uri() ). '/assets/images/preloader.svg" alt="' . esc_attr( $image_alt ) . '"/>';
		}
		else {
			echo '<img class="'. esc_attr( $className ) .'" src="'. esc_url( get_stylesheet_directory_uri() ). '/assets/images/preloader.svg" data-src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/no-thumbnail.png" alt="'.  esc_attr__('No thumbnail' , 'cavatina')  .'"  />';
		}
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
			echo '<a href="'.esc_url($post_url).'" >'; 
				 the_post_thumbnail('large', array('class' => 'c-post__thumbnail__image' )) ;
			echo '</a>';
			
		}
		else {
			
			$post_url = get_permalink(get_the_ID());
			echo '<a href="'.esc_url($post_url).'" >'; 
			echo '<img class="c-post__thumbnail__image" src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/no-thumbnail.png" alt="'. esc_attr__('No thumbnail' , 'cavatina').'" />';
			echo '</a>';
			
		}
	}
endif;


if (! function_exists('cavatina_get_header_class')) :
	/**
	 * Add header class depend on page
	 */
	function cavatina_get_header_class() {
		if ( is_page_template( 'page-template/home.php' ) ) {
			echo "c-header js-header c-header--home";
		} 
		else if( is_404() ){
			echo "c-header js-header c-header--home c-header--404";
		}
		else{
			echo "c-header js-header";
		}
	}
endif;


if (! function_exists('cavatina_get_page_class')) :
	/**
	 * Add page class depend on page
	 */
	function cavatina_get_page_class() {
		if ( is_page_template( 'page-template/home.php' ) ) {
			echo "o-page o-page--home js-page";
		} 
		else if( is_404() ){
			echo "o-page o-page--404 js-page";
		}
		else{
			echo "o-page js-page";
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

			echo '<img class="c-carousel__image" src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/no-thumbnail.png" alt="'. esc_attr__('No thumbnail' , 'cavatina').'"  />';
			
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
			<button class="button--small js-pagination__load-more__btn">' . esc_html( 'Load More' , 'cavatina' ) . '</button>
		</div>'; // you can use <a> as well
	}
}


if (! function_exists('cavatina_get_default_pagination')) :
	/**
	  * Show numeric Pagination
	  */
	function cavatina_get_default_pagination() {
		echo'  <div class="c-pagination">' . wp_kses_post(paginate_links(
				array(
				'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
				'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
				)
			)) .'</div>';
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


if ( ! function_exists('cavatina_get_current_page_name')) :
	/**
	  * Get current page name (slug)
	  */
	function cavatina_get_current_page_name() {

		global $post;
		$post_slug = $post->post_name;
		$post_slug = str_replace("-", " ", $post_slug);
		$page_name = esc_html(esc_html($post_slug));
		echo esc_html_e( $page_name , 'cavatina' );
		
	}
endif;


if ( ! function_exists('cavatina_get_post_tags')) :
	/**
	  * Get current page name (slug)
	  */
	function cavatina_get_post_tags() {
		$post_tags = get_the_tags();
            if ($post_tags) {
            foreach($post_tags as $post_tag) {
                echo '<li><a href="'.  esc_url( get_tag_link( $post_tag->term_id ) ) .'" title="'.  esc_attr( $post_tag->name ) .'">#'. esc_html( $post_tag->name ). '</a></li>';
            }
        }
	}
endif;


if (! function_exists('cavatina_page_thumbnail_class')) :
	/**
	* remove thumnail block if thumbnail didnt exist in pages
	*/
	function cavatina_page_thumbnail_class() {

		if ( ! has_post_thumbnail() ) {
			echo esc_html("c-single__carousel--remove");
		}
		
	}
endif;


if (! function_exists('cavatina_get_social_media')) :
	/**
	* get social media 
	*/
	function cavatina_get_social_media( $have_social_title = false) {

		if($have_social_title === true){
			if( get_theme_mod('linkedin_link') || get_theme_mod('facebook_link') || get_theme_mod('github_link') || get_theme_mod('twitter_link')){

				echo '<span class="c-social-media__title">Share:</span>';

			}
		}

		if ( get_theme_mod('linkedin_link') != null) { 
			
			echo '
			<a href="'. esc_url(get_theme_mod('linkedin_link')) .'" class="c-social-media__item">
				<span class="c-social-media__icon dashicons dashicons-linkedin"></span>	
			</a>';
			
		}
		
		if ( get_theme_mod('facebook_link') != null) { 
			
			echo '      
			<a href="'. esc_url(get_theme_mod('facebook_link')) .'" class="c-social-media__item">
				<span class="c-social-media__icon dashicons dashicons-facebook-alt"></span>
			</a>';
			
		}

		if ( get_theme_mod('github_link') != null) { 
			
			echo '      
			<a href="'. esc_url(get_theme_mod('github_link')) .'" class="c-social-media__item">
			<svg width="14pt" height="14pt" viewBox="0 0 14 14" version="1.1">
				<g id="surface1">
					<path class="c-social-media__icon" style=" stroke:none;fill-rule:nonzero;fill-opacity:1;"
						d="M 13.046875 3.652344 C 12.421875 2.582031 11.574219 1.734375 10.503906 1.109375 C 9.429688 0.484375 8.261719 0.171875 6.992188 0.171875 C 5.722656 0.171875 4.554688 0.484375 3.484375 1.109375 C 2.410156 1.734375 1.5625 2.582031 0.9375 3.652344 C 0.3125 4.726562 0 5.894531 0 7.164062 C 0 8.6875 0.445312 10.058594 1.332031 11.273438 C 2.222656 12.492188 3.371094 13.332031 4.78125 13.800781 C 4.945312 13.832031 5.066406 13.808594 5.144531 13.738281 C 5.222656 13.664062 5.261719 13.574219 5.261719 13.464844 C 5.261719 13.445312 5.261719 13.28125 5.257812 12.972656 C 5.253906 12.664062 5.253906 12.394531 5.253906 12.164062 L 5.042969 12.199219 C 4.910156 12.222656 4.742188 12.234375 4.539062 12.230469 C 4.335938 12.226562 4.125 12.207031 3.90625 12.167969 C 3.6875 12.128906 3.484375 12.035156 3.296875 11.894531 C 3.109375 11.75 2.972656 11.566406 2.894531 11.335938 L 2.804688 11.125 C 2.742188 10.984375 2.648438 10.832031 2.515625 10.660156 C 2.386719 10.492188 2.253906 10.375 2.121094 10.3125 L 2.058594 10.269531 C 2.015625 10.238281 1.976562 10.203125 1.9375 10.160156 C 1.902344 10.117188 1.875 10.074219 1.855469 10.03125 C 1.839844 9.988281 1.855469 9.953125 1.902344 9.925781 C 1.953125 9.898438 2.039062 9.886719 2.167969 9.886719 L 2.347656 9.914062 C 2.46875 9.9375 2.621094 10.011719 2.800781 10.132812 C 2.980469 10.253906 3.125 10.410156 3.242188 10.605469 C 3.382812 10.855469 3.550781 11.042969 3.746094 11.175781 C 3.945312 11.304688 4.144531 11.371094 4.34375 11.371094 C 4.542969 11.371094 4.714844 11.355469 4.863281 11.324219 C 5.007812 11.292969 5.144531 11.25 5.273438 11.1875 C 5.328125 10.78125 5.476562 10.46875 5.71875 10.25 C 5.371094 10.214844 5.0625 10.160156 4.785156 10.085938 C 4.507812 10.011719 4.222656 9.894531 3.929688 9.730469 C 3.632812 9.566406 3.390625 9.363281 3.195312 9.121094 C 3 8.878906 2.84375 8.558594 2.71875 8.164062 C 2.59375 7.769531 2.53125 7.316406 2.53125 6.800781 C 2.53125 6.066406 2.769531 5.441406 3.25 4.921875 C 3.027344 4.371094 3.046875 3.753906 3.3125 3.066406 C 3.488281 3.011719 3.75 3.050781 4.097656 3.1875 C 4.441406 3.324219 4.695312 3.441406 4.859375 3.539062 C 5.019531 3.636719 5.148438 3.71875 5.246094 3.785156 C 5.808594 3.628906 6.390625 3.550781 6.992188 3.550781 C 7.59375 3.550781 8.175781 3.628906 8.742188 3.785156 L 9.085938 3.566406 C 9.324219 3.421875 9.601562 3.289062 9.925781 3.167969 C 10.246094 3.046875 10.492188 3.011719 10.664062 3.066406 C 10.933594 3.753906 10.960938 4.371094 10.734375 4.921875 C 11.214844 5.441406 11.453125 6.066406 11.453125 6.800781 C 11.453125 7.316406 11.390625 7.773438 11.269531 8.167969 C 11.144531 8.566406 10.984375 8.886719 10.785156 9.125 C 10.589844 9.367188 10.34375 9.566406 10.046875 9.730469 C 9.753906 9.894531 9.46875 10.011719 9.191406 10.085938 C 8.914062 10.160156 8.605469 10.214844 8.257812 10.25 C 8.574219 10.523438 8.730469 10.953125 8.730469 11.542969 L 8.730469 13.464844 C 8.730469 13.574219 8.769531 13.664062 8.847656 13.738281 C 8.921875 13.808594 9.042969 13.832031 9.207031 13.800781 C 10.613281 13.332031 11.761719 12.492188 12.652344 11.273438 C 13.539062 10.058594 13.984375 8.6875 13.984375 7.164062 C 13.984375 5.894531 13.671875 4.726562 13.046875 3.652344 Z M 13.046875 3.652344 " />
				</g>
			</svg>

			</a>';

		}

		if ( get_theme_mod('twitter_link') != null) {

			echo '
			<a href="'. esc_url(get_theme_mod('twitter_link')) .'" class="c-social-media__item">
				<span class="c-social-media__icon dashicons dashicons-twitter"></span>
			</a>';

			}
		}


endif;




if (! function_exists('cavatina_get_social_media')) :
	/**
	* get social media 
	*/
	function cavatina_get_social_media( $have_social_title = false) {

		if($have_social_title === true){
			if( get_theme_mod('linkedin_link') || get_theme_mod('facebook_link') || get_theme_mod('github_link') || get_theme_mod('twitter_link')){

				echo '<span class="c-social-media__title">Share:</span>';

			}
		}

		if ( get_theme_mod('linkedin_link') != null) { 
			
			echo '
			<a href="'. esc_url(get_theme_mod('linkedin_link')) .'" class="c-social-media__item">
				<span class="c-social-media__icon dashicons dashicons-linkedin"></span>	
			</a>';
			
		}
		
		if ( get_theme_mod('facebook_link') != null) { 
			
			echo '      
			<a href="'. esc_url(get_theme_mod('facebook_link')) .'" class="c-social-media__item">
				<span class="c-social-media__icon dashicons dashicons-facebook-alt"></span>
			</a>';
			
		}

		if ( get_theme_mod('github_link') != null) { 
			
			echo '      
			<a href="'. esc_url(get_theme_mod('github_link')) .'" class="c-social-media__item">
			<svg width="14pt" height="14pt" viewBox="0 0 14 14" version="1.1">
				<g id="surface1">
					<path class="c-social-media__icon" style=" stroke:none;fill-rule:nonzero;fill-opacity:1;"
						d="M 13.046875 3.652344 C 12.421875 2.582031 11.574219 1.734375 10.503906 1.109375 C 9.429688 0.484375 8.261719 0.171875 6.992188 0.171875 C 5.722656 0.171875 4.554688 0.484375 3.484375 1.109375 C 2.410156 1.734375 1.5625 2.582031 0.9375 3.652344 C 0.3125 4.726562 0 5.894531 0 7.164062 C 0 8.6875 0.445312 10.058594 1.332031 11.273438 C 2.222656 12.492188 3.371094 13.332031 4.78125 13.800781 C 4.945312 13.832031 5.066406 13.808594 5.144531 13.738281 C 5.222656 13.664062 5.261719 13.574219 5.261719 13.464844 C 5.261719 13.445312 5.261719 13.28125 5.257812 12.972656 C 5.253906 12.664062 5.253906 12.394531 5.253906 12.164062 L 5.042969 12.199219 C 4.910156 12.222656 4.742188 12.234375 4.539062 12.230469 C 4.335938 12.226562 4.125 12.207031 3.90625 12.167969 C 3.6875 12.128906 3.484375 12.035156 3.296875 11.894531 C 3.109375 11.75 2.972656 11.566406 2.894531 11.335938 L 2.804688 11.125 C 2.742188 10.984375 2.648438 10.832031 2.515625 10.660156 C 2.386719 10.492188 2.253906 10.375 2.121094 10.3125 L 2.058594 10.269531 C 2.015625 10.238281 1.976562 10.203125 1.9375 10.160156 C 1.902344 10.117188 1.875 10.074219 1.855469 10.03125 C 1.839844 9.988281 1.855469 9.953125 1.902344 9.925781 C 1.953125 9.898438 2.039062 9.886719 2.167969 9.886719 L 2.347656 9.914062 C 2.46875 9.9375 2.621094 10.011719 2.800781 10.132812 C 2.980469 10.253906 3.125 10.410156 3.242188 10.605469 C 3.382812 10.855469 3.550781 11.042969 3.746094 11.175781 C 3.945312 11.304688 4.144531 11.371094 4.34375 11.371094 C 4.542969 11.371094 4.714844 11.355469 4.863281 11.324219 C 5.007812 11.292969 5.144531 11.25 5.273438 11.1875 C 5.328125 10.78125 5.476562 10.46875 5.71875 10.25 C 5.371094 10.214844 5.0625 10.160156 4.785156 10.085938 C 4.507812 10.011719 4.222656 9.894531 3.929688 9.730469 C 3.632812 9.566406 3.390625 9.363281 3.195312 9.121094 C 3 8.878906 2.84375 8.558594 2.71875 8.164062 C 2.59375 7.769531 2.53125 7.316406 2.53125 6.800781 C 2.53125 6.066406 2.769531 5.441406 3.25 4.921875 C 3.027344 4.371094 3.046875 3.753906 3.3125 3.066406 C 3.488281 3.011719 3.75 3.050781 4.097656 3.1875 C 4.441406 3.324219 4.695312 3.441406 4.859375 3.539062 C 5.019531 3.636719 5.148438 3.71875 5.246094 3.785156 C 5.808594 3.628906 6.390625 3.550781 6.992188 3.550781 C 7.59375 3.550781 8.175781 3.628906 8.742188 3.785156 L 9.085938 3.566406 C 9.324219 3.421875 9.601562 3.289062 9.925781 3.167969 C 10.246094 3.046875 10.492188 3.011719 10.664062 3.066406 C 10.933594 3.753906 10.960938 4.371094 10.734375 4.921875 C 11.214844 5.441406 11.453125 6.066406 11.453125 6.800781 C 11.453125 7.316406 11.390625 7.773438 11.269531 8.167969 C 11.144531 8.566406 10.984375 8.886719 10.785156 9.125 C 10.589844 9.367188 10.34375 9.566406 10.046875 9.730469 C 9.753906 9.894531 9.46875 10.011719 9.191406 10.085938 C 8.914062 10.160156 8.605469 10.214844 8.257812 10.25 C 8.574219 10.523438 8.730469 10.953125 8.730469 11.542969 L 8.730469 13.464844 C 8.730469 13.574219 8.769531 13.664062 8.847656 13.738281 C 8.921875 13.808594 9.042969 13.832031 9.207031 13.800781 C 10.613281 13.332031 11.761719 12.492188 12.652344 11.273438 C 13.539062 10.058594 13.984375 8.6875 13.984375 7.164062 C 13.984375 5.894531 13.671875 4.726562 13.046875 3.652344 Z M 13.046875 3.652344 " />
				</g>
			</svg>

			</a>';

		}

		if ( get_theme_mod('twitter_link') != null) {

			echo '
			<a href="'. esc_url(get_theme_mod('twitter_link')) .'" class="c-social-media__item">
				<span class="c-social-media__icon dashicons dashicons-twitter"></span>
			</a>';

			}
		}

		
endif;




if (! function_exists('cavatina_social_media_share_post')) :
	/**
	* Share post on social media ( single page )
	*/
	function cavatina_social_media_share_post( $have_social_title = false) {


		$cavatina_linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
		$cavatina_twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
		$cavatina_facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();




		if($have_social_title === true){
			if( get_theme_mod('linkedin_link') || get_theme_mod('facebook_link') || get_theme_mod('github_link') || get_theme_mod('twitter_link')){

				echo '<span class="c-social-media__title">Share:</span>';

			}
		}

		if ( get_theme_mod('linkedin_link') != null) { 
			
			echo '
			<a href="'. esc_url( $cavatina_linkedin_url ) .'" class="c-social-media__item">
				<span class="c-social-media__icon dashicons dashicons-linkedin"></span>	
			</a>';
			
		}
		
		if ( get_theme_mod('facebook_link') != null) { 
			
			echo '      
			<a href="'. esc_url($cavatina_facebook_url) .'" class="c-social-media__item">
				<span class="c-social-media__icon dashicons dashicons-facebook-alt"></span>
			</a>';
			
		}

		if ( get_theme_mod('twitter_link') != null) {

			echo '
			<a href="'. esc_url($cavatina_twitter_url) .'" class="c-social-media__item">
				<span class="c-social-media__icon dashicons dashicons-twitter"></span>
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

				$id = $image['id'];
				$title = $image['title'];
				$caption = $image['caption'];
				$full_image_url = $image['full_image_url'];
				$thumbnail_image_url = $image['thumbnail_image_url'];
				$url = $image['url'];
				$target = $image['target'];
				$alt = get_field('photo_gallery_alt', $id);

				echo
				'<div class="c-carousel__single__cell">
					<img class="c-carousel__single__cell__image js-carousel__single__cell__image" src="'. esc_url($full_image_url).'"
						alt="'. esc_attr($title) .'" />
				</div>';

			}
		}	
		else{

			if ( has_post_thumbnail() ) {

				echo '<div class="c-carousel__single__cell">';
				the_post_thumbnail('large', ['class' => 'c-carousel__single__cell__image js-carousel__single__cell__image', 'alt' =>
				esc_html( get_the_title() ) ]);
				echo '</div>';

			}
			else{

				echo '<div class="c-carousel__single__cell">';
				echo '<img class="c-carousel__single__cell__image js-carousel__single__cell__image"
					src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/no-thumbnail.png" alt="'. esc_attr__('No thumbnail' , 'cavatina') .'" />';
				echo '</div>';

			}

		}
	}
}