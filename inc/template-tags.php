<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cavatina
 */

if ( ! function_exists( 'cavatina_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function cavatina_posted_on() {
		
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

if ( ! function_exists( 'cavatina_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function cavatina_entry_footer() {
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



if ( ! function_exists( 'cavatina_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function cavatina_post_thumbnail() {
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


if ( ! function_exists( 'cavatina_handle_description' ) ) :
/**
 * Handle Description
 */
function cavatina_handle_description(){
    echo '<span class="c-header__text">'. esc_html(get_bloginfo('description')) .'</span>';
}
endif;


if ( ! function_exists( 'cavatina_handle_logo' ) ) :
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
        echo '<h1 class="c-header__logo__text h2">'. esc_html( get_bloginfo( 'name' ) ) .'</h1>';
		echo "</a>";
		
    }

	if( is_page_template( 'page-template/home.php' ) ||  is_404() ){
		return cavatina_handle_description();
	}
}
endif;


if ( ! function_exists( 'cavatina_get_category' ) ) :
	/**
	 * Return category based on post-type 
	 */
	function cavatina_get_category( $cavatina_isLimited = false) {

		
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
	
		
	}

endif;


if ( ! function_exists( 'cavatina_taxonomy_filter' ) ) :
	/**
	 *  Return taxonomy filter
	 */
	function cavatina_taxonomy_filter($cavatina_className = "" ,  $cavatina_getSeparator = ", " , $cavatina_is_limited = false ,  $cavatina_taxonomy = "category" , $cavatina_hard_limit = false) {
	

		global $wp_query;
		
		$taxonomies = get_terms( array(
			'taxonomy' 	 => $cavatina_taxonomy,
			'hide_empty' => true
		) );
		
		$taxonomny_counter = 0;
		$separator = $cavatina_getSeparator;
			
		$cavatina_all_active_class = "";
		if(empty($wp_query->query['project_category'])){
			$cavatina_all_active_class = "active";
		}		

		echo sprintf('<a class="c-aside__category__link  %s %s" href="%s"><h4>%s</h4></a>' , 
		esc_attr( $cavatina_className ),
		esc_attr( $cavatina_all_active_class ),
		esc_url(site_url().'/'.get_post_type()),
		esc_html__( 'All ', 'cavatina' )
	);



		if ( !empty($taxonomies) ) {
			$output = '';

			foreach( $taxonomies as $category ) {

				if($cavatina_is_limited === true && $taxonomny_counter === 4 || $cavatina_hard_limit === true && $taxonomny_counter === 1){
					break;
				}

				if(!empty($wp_query->query['portfolio_category'])){
					$current_category = $wp_query->query['portfolio_category'];
				}			
				if($category != null && !empty($wp_query->query['portfolio_category'])  && $category->slug  === $current_category){
					$classactive = "active";
				}
				else{
					$classactive = "";
				}

				$taxonomny_counter++;

				if ($category->count != 0) {
					/* translators: return poject_category items for filtering */
					$output .= '<a class="c-aside__category__link '.esc_attr($cavatina_className). ' ' .esc_attr( $classactive ).'" href="'. esc_url( site_url() . '/'. get_post_type().'/?'.$cavatina_taxonomy.'=' . esc_html( $category->slug ) ). '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'cavatina' ), $category->name ) ) . '"><h4>' . esc_html( $category->name ) . '</h4></a>' . esc_html($separator);
				}
			}
			echo wp_kses_post(trim( $output , $separator ));
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
		if ( has_post_thumbnail() && get_theme_mod('post_thumbnail' , true) == true ) {
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


if (! function_exists('cavatina_get_footer_class')) :
	/**
	 * Add header class depend on page
	 */
	function cavatina_get_footer_class() {
		if ( is_page_template( 'page-template/home.php' ) ) {
			echo "c-footer c-footer--home";
		} 
		else if( is_404() ){
			echo "c-footer c-footer--404";
		}
		else{
			echo "c-footer c-footer--normal";
		}
	}
endif;


if (! function_exists('cavatina_get_page_class')) :
	/**
	 * Add page class depend on page
	 */
	function cavatina_get_page_class() {
		if ( is_page_template( 'page-template/home.php' ) ) {
			echo esc_attr( "o-page o-page--home js-page" );
		} 
		else if( is_404() ){
			echo esc_attr( "o-page o-page--404 js-page" );
		}
		else{
			echo esc_attr( "o-page js-page" );
		}
	}
endif;



if (! function_exists('cavatina_get_wrapper_component')) :
	/**
	 * Add page wrapper depend on page
	 */
	function cavatina_get_wrapper_component($cavatina_component_wrapper) {
		if ( is_page_template( 'page-template/home.php' ) || is_404() ) {
			if($cavatina_component_wrapper === true){
				echo sprintf('<div class="o-wrapper">');
			}
			else{
				echo sprintf('</div>');
			}
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

if (! function_exists('cavatina_get_loadmore')) :
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
endif;


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
		$page_name = esc_html($post_slug);
		echo esc_html($post_slug);
			
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


if ( ! function_exists( 'cavatina_get_social_media' ) ) :
	/**
	  * Display Social Networks
	  */
	function cavatina_get_social_media() {
		
		$cavatina_facebook  		=  get_theme_mod( 'facebook', "" );
		$cavatina_twitter   		=  get_theme_mod( 'twitter', "" );
		$cavatina_instagram 		=  get_theme_mod( 'instagram', "" );
		$cavatina_linkedin  		=  get_theme_mod( 'linkedin', "" );
		$cavatina_github    		=  get_theme_mod( 'github', "" );
		$cavatina_mail   			=  get_theme_mod( 'mail', "" );
		$cavatina_pinterest    		=  get_theme_mod( 'pinterest', "" );
		$cavatina_youtube    		=  get_theme_mod( 'youtube', "" );
		$cavatina_spotify    		=  get_theme_mod( 'spotify', "" );
		$cavatina_gitlab    		=  get_theme_mod( 'gitlab', "" );
		$cavatina_lastfm    		=  get_theme_mod( 'lastfm', "" );
		$cavatina_stackoverflow     =  get_theme_mod( 'stackoverflow', "" );
		$cavatina_quora    			=  get_theme_mod( 'quora', "" );
		$cavatina_reddit    		=  get_theme_mod( 'reddit', "" );
		$cavatina_medium    		=  get_theme_mod( 'medium', "" );
		$cavatina_vimeo    			=  get_theme_mod( 'vimeo', "" );
		$cavatina_lanyrd    		=  get_theme_mod( 'lanyrd', "" );
		$cavatina_dribbble    		=  get_theme_mod( 'dribbble', "" );
		$cavatina_behance    		=  get_theme_mod( 'behance', "" );
		$cavatina_codepen    		=  get_theme_mod( 'codepen', "" );
		$cavatina_telegram    		=  get_theme_mod( 'telegram', "" );
		$cavatina_phone_number    	=  get_theme_mod( 'phone_number', "" );


		// If variable was not empty will display the icons
		$cavatina_social_variables  = array($cavatina_facebook,$cavatina_twitter,$cavatina_instagram,$cavatina_linkedin,$cavatina_github,
		$cavatina_mail, $cavatina_pinterest ,$cavatina_youtube ,$cavatina_spotify , $cavatina_gitlab,$cavatina_lastfm ,$cavatina_stackoverflow ,$cavatina_quora ,$cavatina_reddit ,$cavatina_medium ,
		$cavatina_vimeo, $cavatina_lanyrd,$cavatina_dribbble ,$cavatina_behance,$cavatina_codepen,$cavatina_telegram,$cavatina_phone_number
		);

		// Check if one of the variables are not empty 
		$cavatina_social_variable_flag = 0;		
		foreach($cavatina_social_variables as $cavatina_social){
			if( !empty($cavatina_social)){
				$cavatina_social_variable_flag = 1;
				break;
			}
		}

		// Display the icons here 
		if( $cavatina_social_variable_flag === 1 ) {

			echo '<div class="c-social-share c-social-share--footer">';

			if ( $cavatina_facebook ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon dashicons dashicons-facebook-alt"></span></a>', esc_url( $cavatina_facebook ), esc_html__( 'Facebook', 'cavatina' ) );
			}

			if ( $cavatina_twitter ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon dashicons dashicons-twitter"></span></a>', esc_url( $cavatina_twitter ), esc_html__( 'Twitter', 'cavatina' ) );
			}

			if ( $cavatina_instagram ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon dashicons dashicons-instagram"></span></a>', esc_url( $cavatina_instagram ), esc_html__( 'Instagram', 'cavatina' ) );
			}

			if ( $cavatina_linkedin ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon dashicons dashicons-linkedin"></span></a>', esc_url( $cavatina_linkedin ), esc_html__( 'Linkedin', 'cavatina' ) );
			}

			if ( $cavatina_github ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="ant-design:github-filled" data-inline="false"></span></a>', esc_url( $cavatina_github ), esc_html__( 'Github', 'cavatina' ) );
			}

			if ( $cavatina_mail ) {
				echo sprintf( '<a href="mailto:%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="ant-design:mail-outlined" data-inline="false"></span></a>', esc_attr(sanitize_email( $cavatina_mail)), esc_html__( 'Mail', 'cavatina' ) );
			}
			
			if ( $cavatina_pinterest ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="bx:bxl-pinterest" data-inline="false"></span></a>', esc_url( $cavatina_pinterest ), esc_html__( 'pinterest', 'cavatina' ) );
			}

			if ( $cavatina_youtube ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="akar-icons:youtube-fill" data-inline="false"></span></a>', esc_url( $cavatina_youtube ), esc_html__( 'youtube', 'cavatina' ) );
			}
			
			if ( $cavatina_spotify ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="bx:bxl-spotify" data-inline="false"></span></a>', esc_url( $cavatina_spotify ), esc_html__( 'spotify', 'cavatina' ) );
			}
			
			if ( $cavatina_lastfm ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="brandico:lastfm-rect" data-inline="false"></span></a>', esc_url( $cavatina_lastfm ), esc_html__( 'lastfm', 'cavatina' ) );
			}

			if ( $cavatina_gitlab ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="ion:logo-gitlab" data-inline="false"></span></a>', esc_url( $cavatina_gitlab ), esc_html__( 'gitlab', 'cavatina' ) );
			}
			
			if ( $cavatina_stackoverflow ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="cib:stackoverflow" data-inline="false"></span></a>', esc_url( $cavatina_stackoverflow ), esc_html__( 'stackoverflow', 'cavatina' ) );
			}

			if ( $cavatina_reddit ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="akar-icons:reddit-fill" data-inline="false"></span></a>', esc_url( $cavatina_reddit ), esc_html__( 'reddit', 'cavatina' ) );
			}
			
			if ( $cavatina_quora ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="bx:bxl-quora" data-inline="false"></span></a>', esc_url( $cavatina_quora ), esc_html__( 'quora', 'cavatina' ) );
			}

			if ( $cavatina_medium ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="ant-design:medium-circle-filled" data-inline="false"></span></a>', esc_url( $cavatina_medium ), esc_html__( 'medium', 'cavatina' ) );
			}			

			if ( $cavatina_vimeo ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="brandico:vimeo-rect" data-inline="false"></span></a>', esc_url( $cavatina_vimeo ), esc_html__( 'vimeo', 'cavatina' ) );
			}

			if ( $cavatina_dribbble ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="akar-icons:dribbble-fill" data-inline="false"></span></a>', esc_url( $cavatina_dribbble ), esc_html__( 'dribbble', 'cavatina' ) );
			}

			if ( $cavatina_behance ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="ant-design:behance-outlined" data-inline="false"></span></a>', esc_url( $cavatina_behance ), esc_html__( 'behance', 'cavatina' ) );
			}

			if ( $cavatina_lanyrd ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="cib:lanyrd" data-inline="false"></span></a>', esc_url( $cavatina_lanyrd ), esc_html__( 'lanyrd', 'cavatina' ) );
			}

			if ( $cavatina_codepen ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify" data-icon="bx:bxl-codepen"></span></a>', esc_url( $cavatina_codepen ), esc_html__( 'codepen', 'cavatina' ) );
			}
			
			if ( $cavatina_telegram ) {
				echo sprintf( '<a href="%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify"  data-icon="akar-icons:telegram-fill" ></span></a>', esc_url( $cavatina_telegram ), esc_html__( 'codepen', 'cavatina' ) );
			}

			if ( $cavatina_phone_number ) {
				echo sprintf( '<a href="tel:%s" aria-label="%s" class="c-social-media__item" target="_blank"><span class="c-social-media__icon iconify"  data-icon="bx:bxs-phone" ></span></a>', esc_html( $cavatina_phone_number ), esc_html__( 'Phone Number', 'cavatina' ) );
			}

			echo '</div>';
		}
	}
endif;


if (! function_exists('cavatina_social_media_share_post')) :
	/**
	* Share post on social media ( single page )
	*/
	function cavatina_social_media_share_post( $cavatina_share_title = false) {

		$cavatina_linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
		$cavatina_twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
		$cavatina_facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();


		if($cavatina_share_title){
			echo sprintf('<span class="c-social-media__title">%s</span>', esc_html__( 'Share on:' , 'cavatina' ));
		}
		
		echo sprintf( '<a class="c-social-media__item" target="_blank" href="%s"><span class="c-social-media__icon dashicons dashicons-facebook-alt"></span></a>', esc_url( $cavatina_facebook_url ) );
		echo sprintf( '<a class="c-social-media__item" target="_blank" href="%s"><span class="c-social-media__icon dashicons dashicons-twitter"></span></a>', esc_url( $cavatina_twitter_url ) );
		echo sprintf( '<a class="c-social-media__item" target="_blank" href="%s"><span class="c-social-media__icon dashicons dashicons-linkedin"></span></a>', esc_url( $cavatina_linkedin_url ) );
	
	}	
endif;

if( ! function_exists('cavatina_get_slider') ): 
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
endif;