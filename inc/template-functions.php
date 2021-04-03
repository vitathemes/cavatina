<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package cavatina
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wp_cavatina_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}


	return $classes;
}
add_filter( 'body_class', 'wp_cavatina_body_classes' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wp_cavatina_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wp_cavatina_pingback_header' );


function cavatina_get_pagination( $page , $query ) { 
	if($page === "projects"){
		if ( true == get_theme_mod( 'projects_loadmore', true ) ){
			return cavatina_get_loadmore( $query );
		} else {
			return cavatina_get_default_pagination();
		}
	}

	if( $page === "blog"){
		if ( true == get_theme_mod( 'blog_loadmore' ) ){
			return cavatina_get_loadmore( $query );
		} else {
			return cavatina_get_default_pagination();
		}
	}

	if( $page === "archive"){
		if ( true == get_theme_mod( 'archive_loadmore' ) ){
			return cavatina_get_loadmore( $query );
		} else {
			return cavatina_get_default_pagination();
		}
	}
}


function cavatina_typography() {
	
	if ( get_theme_mod( 'typography_primary_color' ) == "" ) {
		$cavatina_primary_color = "#000000";
	} else {
		$cavatina_primary_color = get_theme_mod( 'typography_primary_color' );
	}
	if ( get_theme_mod( 'typography_secondary_color' ) == "" ) {
		$cavatina_secondary_color = "#767676";
	} else {
		$cavatina_secondary_color = get_theme_mod( 'typography_secondary_color' );
	}
	
	$html = ':root {	
	            --cavatina_primary-color: '. $cavatina_primary_color .';
	            --cavatina_secondary-color: ' . $cavatina_secondary_color . ';
			}';
						
	return $html;
	
}

add_action( 'admin_head', 'cavatina_theme_settings' );
add_action( 'wp_head', 'cavatina_theme_settings' );

function cavatina_theme_settings() {
	$cavatina_theme_typography = cavatina_typography();

	?>
<style>
<?php echo esc_html($cavatina_theme_typography);
?>
</style>
<?php
}