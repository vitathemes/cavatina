<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package cavatina
 */

if( ! function_exists('cavatina_body_classes') ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function cavatina_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}
		return $classes;
	}
endif;
add_filter( 'body_class', 'cavatina_body_classes' );


if ( ! function_exists( 'cavatina_pingback_header' ) ) :
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cavatina_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
endif;
add_action( 'wp_head', 'cavatina_pingback_header' );


if ( ! function_exists( 'cavatina_get_pagination' ) ) :
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
endif;

if ( ! function_exists( 'cavatina_typography' ) ) :
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
		if ( get_theme_mod( 'typography_accent_color' ) == "" ) {
			$cavatina_accent_color = "#ff3636";
		} else {
			$cavatina_accent_color = get_theme_mod( 'typography_accent_color' );
		}
	
		$html = ':root {	
					--cavatina_primary-color: '. $cavatina_primary_color .';
					--cavatina_secondary-color: ' . $cavatina_secondary_color . ';
					--cavatina_accent-color: ' . $cavatina_accent_color . ';
				}';
						
		return $html;
	}

	function cavatina_theme_settings() {
		$cavatina_theme_typography = cavatina_typography();
		echo sprintf( '<style>%s</style>' , esc_html( $cavatina_theme_typography ));
	}
	
endif;
add_action( 'admin_head', 'cavatina_theme_settings' );
add_action( 'wp_head', 'cavatina_theme_settings' );