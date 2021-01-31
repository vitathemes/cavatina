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
 * Gallery metabox add input fields
 */
function gallery_meta_callback($post) {

    wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
	$ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
	
?>
<table class="form-table">
    <tr>
        <td>
            <a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery"
                data-uploader-button-text="Add image(s)">Add image(s)</a>
            <ul id="gallery-metabox-list">
                <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value);?>
                <li>
                    <input type="hidden" name="vdw_gallery_id[<?php printf(esc_html($key)); ?>]"
                        value="<?php printf(esc_html($value)); ?>">
                    <img class="image-preview" src="<?php printf(esc_html($image[0])); ?>">
                    <a class="change-image button button-small" href="#" data-uploader-title="Change image"
                        data-uploader-button-text="Change image">Change image</a><br>
                    <small><a class="remove-image" href="#">Remove image</a></small>
                </li>
                <?php endforeach; endif; ?>
            </ul>

        </td>
    </tr>
</table>
<?php }

/* Save Gallery meta  */
function gallery_meta_save($post_id) {

	$galleryMetaNonce = filter_input( INPUT_POST, 'gallery_meta_nonce', FILTER_SANITIZE_STRING );
	
    if (!isset($galleryMetaNonce) || !wp_verify_nonce($galleryMetaNonce, basename(__FILE__))) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	
    if( isset( $_POST['vdw_gallery_id']) ) {

		$gallerylength = count( $_POST[ 'vdw_gallery_id' ] );
		$currentId = 0 ;

		while ( $currentId <= $gallerylength){

			if ( !empty( $_POST['vdw_gallery_id'][$currentId] ) ) {

				$hidden_var[$currentId] = sanitize_text_field( wp_unslash( $_POST[ 'vdw_gallery_id' ][$currentId] ) );
				update_post_meta( $post_id , 'vdw_gallery_id' , $hidden_var );
				
			}
			$currentId++;
		}

	}
	else {  
		delete_post_meta($post_id, 'vdw_gallery_id');
	}
}
add_action('save_post', 'gallery_meta_save');



/**
 * Handle Slider from Meta box 
 */
function cavatina_get_slider($postId){
	$images = get_post_meta( $postId , 'vdw_gallery_id', true); 

	if($images > 0){
		foreach ($images as $image) {			
			echo '<div class="c-carousel__single__cell">'.
				 	wp_get_attachment_image($image, "large" , "" , ["class" => "c-carousel__single__cell__image" ,"alt"=>"some"] ).
				 '</div>';
	}
	}else{
		echo '<div class="c-carousel__single__cell">';
		    	the_post_thumbnail('large', ['class' => 'c-carousel__single__cell__image', 'title' => 'Feature image']);
		echo '</div>';	
	}
}
 


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

/**
 * Render load more button
 */
function cavatina_load_more_button($query) { 
	if ( $query->max_num_pages > 1 ){
		echo '<div class="c-pagination c-pagination--load-more js-pagination__load-more"><button class="button--small js-pagination__load-more__btn">Load More</button></div>'; // you can use <a> as well
	}
}


if ( ! function_exists( 'cavatina_get_category' ) ) :
	/**
	 * Prints HTML of the categories.
	 */
	function cavatina_get_category() {
	
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			return $categories[0]->name;   
		}
		
	}
endif;


if ( ! function_exists( 'cavatina_get_date' ) ) :
	/**
	 * Prints HTML of the date.
	 */
	function cavatina_get_date() {
	
		return get_the_date( "F j.Y" );
		
	}
endif;


if (! function_exists('cavatina_get_pagination')) :
	/**
	 * Show numeric pagination
	 */
	function cavatina_get_pagination() {

	 	echo esc_html(paginate_links( array(
			'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
			'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
		)));
		
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
		$post_slug=$post->post_name;		
		echo esc_html(esc_html($post_slug));

	}
endif;


if (! function_exists('cavatina_get_home_page_link')) :
	/**
	 * get home page link
	 */
	function cavatina_get_home_page_link() {

		echo esc_url(home_url( '/' ));
		
	}
endif;