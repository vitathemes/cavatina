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
function cavatina_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cavatina_content_width', 640 );
}
add_action( 'after_setup_theme', 'cavatina_content_width', 0 );



/**
 * Register widget area for contact page.
 *
 * @link https://codex.wordpress.org/Widgetizing_Themes
 */
function cavatina_contact_widget_init() {
 
    register_sidebar( array(
        'name'          => esc_html__( 'Contact Page Sidebar Area', 'cavatina' ),
        'id'            => 'custom-contact-widget',
        'before_widget' => '<div class="c-widget__content">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="c-widget__title">',
        'after_title'   => '</h6>',
    ) );
 
}
add_action( 'widgets_init', 'cavatina_contact_widget_init' );

/**
 * Enqueue default scripts and styles.
 */
function cavatina_default_scripts() {
	wp_enqueue_style( 'cavatina-default-style', get_stylesheet_uri(), array(), CAVATINA_VERSION );
	wp_style_add_data( 'cavatina-default-style', 'rtl', 'replace' );

	wp_enqueue_script( 'cavatina-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), CAVATINA_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cavatina_default_scripts' );

/**
 * Enqueue scripts and styles.
 */
function cavatina_scripts() {
  
	wp_enqueue_style( 'cavatina-style', get_template_directory_uri() . '/assets/css/main.css', array(), CAVATINA_VERSION );

  wp_enqueue_script( 'cavatina-vendor-scripts', get_template_directory_uri() . '/assets/js/vendor.min.js', array( ), CAVATINA_VERSION, true );
	wp_enqueue_script( 'cavatina-main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( ), CAVATINA_VERSION, true );

}

add_action( 'wp_enqueue_scripts', 'cavatina_scripts' );


/**
 * change comment date format
 */
function cavatina_change_comment_date_format( $cavatina_comment_date ) {
    
	$cavatina_comment_date = date("M d.y");
    return $cavatina_comment_date;

}
add_filter( 'get_comment_date', 'cavatina_change_comment_date_format' );


/**
 * Remove Comment time
 */
function cavatina_remove_comment_time($cavatina_date, $cavatina_d, $cavatina_comment) { 
    if ( !is_admin() ) {
            return;
    } else { 
            return $cavatina_date;
    }
}
add_filter( 'get_comment_time', 'cavatina_remove_comment_time', 10, 3);


/**
 * count number of posts in a page
 */
function cavatina_total_posts() {
	$cavatina_total = wp_count_posts()->publish;
	echo  esc_html($cavatina_total);
}

/**
 * Count number of posts in a Page
 */
function cavatina_post_type_name() {
	echo esc_html( get_post_type( get_the_ID() ), 'cavatina');
}

/**
 * Count number of posts types (project) in a page
 */
function cavatina_total_post_types( $cavatina_isText = true ) {

	if($cavatina_isText === true){
		printf(esc_html($cavatina_count_posts = wp_count_posts( 'projects' )->publish));
	}
	else{
		return $cavatina_count_posts = wp_count_posts( 'projects' )->publish;
	}
	
}

/**
 * Change Comment Form Fields Placeholder
 */
function cavatina_comments_placeholders( $cavatina_fields ) {
	foreach( $cavatina_fields as &$cavatina_field ) {
		$cavatina_field = str_replace( 'id="author"', 'id="author" placeholder="'.__('Name*' , 'cavatina').'"', $cavatina_field );
		$cavatina_field = str_replace( 'id="email"', 'id="email" placeholder="'.__('Email*' , 'cavatina').'"', $cavatina_field );
		$cavatina_field = str_replace( 'id="url"', 'id="url" placeholder="'.__('Website' , 'cavatina').'"', $cavatina_field );
	}
	return $cavatina_fields;
}
add_filter( 'comment_form_default_fields', 'cavatina_comments_placeholders' );

	
function cavatina_dashicons(){
	/**
	 * Enable Dashicons
	 */
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'cavatina_dashicons', 999);


function cavatina_contact_page_require_shortcode( $cavatina_the_content ) {
	/**
	 * Return all shortcodes from the post 
	 */
    $cavatina_shortcode = "";
    $cavatina_pattern = get_shortcode_regex();
    preg_match_all('/'.$cavatina_pattern.'/uis', $cavatina_the_content, $matches);
    for ( $i=0; $i < 40; $i++ ) {
        if ( isset( $matches[0][$i] ) ) {
           $cavatina_shortcode .= $matches[0][$i];
        }
    }
    return $cavatina_shortcode;
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
    $cavatina_decimalCounter = "0";
    $cavatina_postNumber = cavatina_get_inverse_post_number();
    // Remove zero when reaching 10
    if($cavatina_postNumber >= 10){
        $cavatina_decimalCounter = "";
		    $cavatina_postNumber = $cavatina_postNumber;
		    return $cavatina_postNumber;
    }
    else{
		    $cavatina_postNumber = $cavatina_decimalCounter.$cavatina_postNumber;
		    return $cavatina_postNumber;
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
 *	Load More button
 */
function cavatina_load_more_script() {
	global $wp_query;
	wp_enqueue_script('jquery');
	wp_localize_script( 'cavatina-main-scripts', 'loadmore_params', array(
		'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 	wp_enqueue_script( 'cavatina-main-scripts' );
}
add_action( 'wp_enqueue_scripts', 'cavatina_load_more_script' );


/* Handle Load more button loop  */
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
  * Modify LibWP post type name (If libwp plugin exist)
  */
function cavatina_modify_libwp_post_type($postTypeName){
  $postTypeName = 'projects';
  return $postTypeName;
}  

add_filter('libwp_post_type_1_name', 'cavatina_modify_libwp_post_type');


/**
  * Modify LibWP post type arguments (If libwp plugin exist)
  */
function cavatina_modify_libwp_post_type_argument($postTypeArguments){
  
  $postTypeArguments['labels'] = [
      'name'          => _x('Projects', 'Post type general name', 'cavatina'),
      'singular_name' => _x('Project', 'Post type singular name', 'cavatina'),
      'menu_name'     => _x('Projects', 'Admin Menu text', 'cavatina'),
      'add_new'       => __('Add New', 'cavatina'),
      'edit_item'     => __('Edit Project', 'cavatina'),
      'view_item'     => __('View Project', 'cavatina'),
      'all_items'     => __('All Projects', 'cavatina'),
  ];
  
  $postTypeArguments['rewrite']['slug'] = 'projects';
  $postTypeArguments['public'] = true;
  $postTypeArguments['show_ui'] = true;
  $postTypeArguments['menu_position'] = 5;
  $postTypeArguments['show_in_nav_menus'] = true;
  $postTypeArguments['show_in_admin_bar'] = true;
  $postTypeArguments['hierarchical'] = true;
  $postTypeArguments['can_export'] = true;
  $postTypeArguments['has_archive'] = true;
  $postTypeArguments['exclude_from_search'] = false;
  $postTypeArguments['publicly_queryable'] = true;
  $postTypeArguments['capability_type'] = 'post';
  $postTypeArguments['show_in_rest'] = true;
  $postTypeArguments['supports'] = array('title', 'editor' , 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields');

  return $postTypeArguments;
}  
add_filter('libwp_post_type_1_arguments', 'cavatina_modify_libwp_post_type_argument');


/**
  * Modify LibWP taxonomy name (If libwp plugin exist)
  */
function cavatina_modify_libwp_taxonomy_name($taxonomyName){

  $taxonomyName = 'project_category';
  return $taxonomyName;
  
}
add_filter('libwp_taxonomy_1_name', 'cavatina_modify_libwp_taxonomy_name');


/**
  * Modify LibWP taxonomy post type name (If libwp plugin exist)
  */
function cavatina_modify_libwp_taxonomy_post_type_name($taxonomyPostTypeName){
  $taxonomyPostTypeName = 'projects';
  return $taxonomyPostTypeName;
}
add_filter('libwp_taxonomy_1_post_type', 'cavatina_modify_libwp_taxonomy_post_type_name');


/**
  * Modify LibWP taxonomy name (If libwp plugin exist)
  */
function cavatina_modify_libwp_taxonomy_argument($taxonomyArguments){

    $taxonomyArguments['labels'] = [
      'name'          => _x('Project Categories', 'taxonomy general name', 'cavatina'),
      'singular_name' => _x('Project Category', 'taxonomy singular name', 'cavatina'),
      'search_items'  => __('Search Project Categories', 'cavatina'),
      'all_items'     => __('All Project Categories', 'cavatina'),
      'edit_item'     => __('Edit Project Category', 'cavatina'),
      'add_new_item'  => __('Add New Project Category', 'cavatina'),
      'new_item_name' => __('New Project Category Name', 'cavatina'),
      'menu_name'     => __('Project Categories', 'cavatina'),
  ];
  $taxonomyArguments['rewrite']['slug'] = 'project_category';
  $taxonomyArguments['show_in_rest'] = true;

  return $taxonomyArguments;
  
}

add_filter('libwp_taxonomy_1_arguments', 'cavatina_modify_libwp_taxonomy_argument');




/**
  * Load Setup file
  */
require_once get_template_directory() . '/inc/setup.php';

/**
  * Custom template tags for this theme.
  */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
  * Customizer additions.
  */
require get_template_directory() . '/inc/customizer.php';


/**
  * Load TGMPA file
  */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgmpa/tgmpa-config.php';