<?php
/**
 * cavatina functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cavatina
 */


if ( ! defined( 'CAVATINA_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'CAVATINA_VERSION', '1.0.0' );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_cavatina_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_cavatina_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_cavatina_content_width', 0 );



/**
 * Register widget area for contact page.
 *
 * @link https://codex.wordpress.org/Widgetizing_Themes
 */
function contact_widget_init() {
 
    register_sidebar( array(
        'name'          => 'Contact Page Sidebar Area',
        'id'            => 'custom-contact-widget',
        'before_widget' => '<div class="c-widget__content">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="c-widget__title">',
        'after_title'   => '</h6>',
    ) );
 
}
add_action( 'widgets_init', 'contact_widget_init' );

/**
 * Enqueue scripts and styles.
 */
function wp_cavatina_scripts() {
	wp_enqueue_style( 'wp-cavatina-style', get_stylesheet_uri(), array(), CAVATINA_VERSION );
	wp_style_add_data( 'wp-cavatina-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wp-cavatina-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), CAVATINA_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_cavatina_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Enqueue scripts and styles.
 */
function cavatina_scripts() {

	wp_enqueue_style( 'cavatina-style', get_template_directory_uri() . '/assets/css/main.css', array(), CAVATINA_VERSION );

	wp_enqueue_script( 'cavatina-main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( ), CAVATINA_VERSION, true );

}

add_action( 'wp_enqueue_scripts', 'cavatina_scripts' );

/**
 * Remove admin bar bump space (* Not whole admin bar, just space from the top)
 */
add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );


/**
 * change submit button text in WordPress comment form
 */
function cavatina_change_submit_button_text( $defaults ) {
    $defaults['label_submit'] = 'Send';
    return $defaults;
}
add_filter( 'comment_form_defaults', 'cavatina_change_submit_button_text' );


/**
 * change comment date format
 */
function cavatina_change_comment_date_format( $comment_date ) {
    
	$comment_date = date("M d.y");
    return $comment_date;

}
add_filter( 'get_comment_date', 'cavatina_change_comment_date_format' );

 
// Remove comment time
function wpb_remove_comment_time($date, $d, $comment) { 
    if ( !is_admin() ) {
            return;
    } else { 
            return $date;
    }
}
add_filter( 'get_comment_time', 'wpb_remove_comment_time', 10, 3);


/**
 * count number of posts in a page
 */
function cavatina_total_posts() {
	$total = wp_count_posts()->publish;
	echo  esc_html($total);
}

/**
 * count number of posts in a page
 */
function cavatina_post_type_name() {
	echo esc_html( get_post_type( get_the_ID() ));
}

/**
 * count number of posts types (project) in a page
 */
function cavatina_total_post_types( $isText = true ) {

	if($isText === true){
		printf(esc_html($count_posts = wp_count_posts( 'projects' )->publish));
	}
	else{
		return $count_posts = wp_count_posts( 'projects' )->publish;
	}
	
}


/**
 * Change comment form textarea placeholder
 */
function cavatina_change_textarea_placeholder( $args ) {
	$args['comment_field'] = str_replace( 'textarea', 'textarea placeholder="Your Comment*"', $args['comment_field'] );
	return $args;
}
add_filter( 'comment_form_defaults', 'cavatina_change_textarea_placeholder' );

/**
 * change Comment Form Fields Placeholder
 *
 */
function cavatina_comments_placeholders( $fields ) {
	foreach( $fields as &$field ) {
		$field = str_replace( 'id="author"', 'id="author" placeholder="Name*"', $field );
		$field = str_replace( 'id="email"', 'id="email" placeholder="Email*"', $field );
		$field = str_replace( 'id="url"', 'id="url" placeholder="Website"', $field );
	}
	return $fields;
}
add_filter( 'comment_form_default_fields', 'cavatina_comments_placeholders' );



/**
 * change excerpt length
 */
function cavatina_custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'cavatina_custom_excerpt_length', 999 );



/**
 * Add numerical pagination
 */
$args = array(
    'base'               => '%_%',
    'format'             => '?paged=%#%',
    'total'              => 1,
    'current'            => 0,
    'show_all'           => false,
    'end_size'           => 1,
    'mid_size'           => 2,
    'add_args'           => false,
    'add_fragment'       => '',
    'before_page_number' => '',
    'after_page_number'  => '');

	
function cavatina_dashicons(){
	/**
	 * Enable Dashicons
	 */
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'cavatina_dashicons', 999);


function cavatina_contact_page_require_shortcode( $the_content ) {
	/**
	 * Return all shortcodes from the post 
	 */
    $shortcode = "";
    $pattern = get_shortcode_regex();
    preg_match_all('/'.$pattern.'/uis', $the_content, $matches);
    for ( $i=0; $i < 40; $i++ ) {
        if ( isset( $matches[0][$i] ) ) {
           $shortcode .= $matches[0][$i];
        }
    }
    return $shortcode;
}



function cavatina_get_post_number(){
	/**
	 * Auto increment number per posts ( in pages like archive-projects... )
	 */
    global $wp_query;
    $posts_per_page = get_option('posts_per_page');
    $paged          = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $offset         = ($paged - 1) * $posts_per_page;
    $loop           = $wp_query->current_post + 1;
    return $offset + $loop;
}


function cavatina_get_inverse_post_number(){
	/**
	 * Auto decrement number per posts ( in pages like archive-projects... )
	 */
	global $wp_query;
    $posts_per_page 	= get_option('posts_per_page');
	$paged          	= (get_query_var('paged')) ? get_query_var('paged') : 1;
	$offset         	= ($paged - 1) * $posts_per_page;
	$loop           	= $wp_query->current_post + 1;
	$posts_in_page	    = $offset + $loop;
	$total_post_numbers = cavatina_total_post_types(false) + 1;
	$posts_counter 	    = $total_post_numbers - $posts_in_page;

	return $posts_counter;
}


function cavatina_deciaml_post_number(){
	/**
	 * Add zero to the post numbers
	 */
	
    // get post number (auto increment)
    $decimalCounter = "0";
    $postNumber = cavatina_get_inverse_post_number();
    // Remove zero when reaching 10
    if($postNumber >= 10){
        $decimalCounter = "";
		$postNumber = $postNumber;
		return $postNumber;
    }
    else{
		$postNumber = $decimalCounter.$postNumber;
		return $postNumber;
	}
}


/**
 * Add your custom logo to the login page
 */
function cavatina_filter_login_head() {
    if ( has_custom_logo() ) :
        $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
	?>
<style type="text/css">
.login h1 a {
    background-image: url(<?php echo esc_url($image[0]);
    ?>);
    -webkit-background-size: <?php echo absint($image[1]) ?>px;
    background-size: <?php echo absint($image[1]) ?>px;
    height: <?php echo absint($image[2]) ?>px;
    width: <?php echo absint($image[1]) ?>px;
}
</style>
<?php
    endif;
}

add_action( 'login_head', 'cavatina_filter_login_head', 100 );


/**
 *	Load More
 */
function cavatina_load_more_script() {

	global $wp_query;
	wp_enqueue_script('jquery');
	wp_localize_script( 'cavatina-main-scripts', 'loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 	wp_enqueue_script( 'cavatina-main-scripts' );
	 
}
add_action( 'wp_enqueue_scripts', 'cavatina_load_more_script' );


/* Handle Load more loop  */
function cavatina_loadmore_ajax_handler(){
	
	$argsquery = filter_input( INPUT_POST, 'query', FILTER_SANITIZE_STRING );

	if ( !empty( $_POST['query'] ||  $_POST['page'] )) {
		
		$args = json_decode( sanitize_text_field( wp_unslash( $_POST['query'] ) ) , true );
		$args['paged'] = sanitize_text_field( wp_unslash( $_POST['page'] )) + 1; 
		$args['post_status'] = 'publish';
		query_posts( $args );
		$post_type = get_post_type( $post->ID );
		
		if( have_posts() ) :

			// run the loop
			while( have_posts() ) : the_post();
			get_template_part( 'template-parts/content',  get_post_type() );
			endwhile;

		endif;
		die; 
	}
}

add_action('wp_ajax_loadmore', 'cavatina_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'cavatina_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}










/**
 * Load Setup file
 */
require_once get_template_directory() . '/inc/setup.php';


/**
  * Customizer additions.
  */
require get_template_directory() . '/inc/customizer.php';


/**
  * Load TGMPA file
  */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgmpa/tgmpa-config.php';