<?php
/**
 * cavatina Theme Customizer
 *
 * @package cavatina
 */
 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cavatina_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'cavatina_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'cavatina_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'cavatina_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cavatina_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cavatina_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cavatina_customize_preview_js() {
	wp_enqueue_script( 'wp-cavatina-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), CAVATINA_VERSION, true );
}
add_action( 'customize_preview_init', 'cavatina_customize_preview_js' );



if( function_exists( 'kirki' ) ) {

	/*
	 *	Kirki - Config
	 */
	Kirki::add_config( 'cavatina_theme', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );
	
	/*
	 *	Kirki -> Sections
	 */

	// typography settings  
	Kirki::add_section( 'typography_headings', array(
		'title'          => esc_html__( 'Typography Setting', 'cavatina' ),
		'description'    => esc_html__( 'Change Typography color and customize them.', 'cavatina' ),
		'panel'          => '',
		'priority'       => 160,
	) );

	/* Load more selection */
	Kirki::add_section( 'loadmore_pagination', array(
		'title'          => esc_html__( 'Pagination', 'cavatina' ),
		'description'    => esc_html__( 'You can add load more button to page that you want.', 'cavatina' ),
		'panel'          => '',
		'priority'       => 160,
	) );

	/*  */
	Kirki::add_section( 'social_media', array(
		'title'          => esc_html__( 'Social Media', 'cavatina' ),
		'description'    => esc_html__( 'Add social media links.', 'cavatina' ),
		'panel'          => '',
		'priority'       => 160,
	) );
	/*
	 *	Kirki -> fields
	 */
	Kirki::add_field( 'cavatina', [
		'type'        => 'checkbox',
		'settings'    => 'projects_loadmore',
		'label'       => esc_html__( 'Projects Page Load more', 'cavatina' ),
		'description' => esc_html__( 'Add load more button to Project archives page', 'cavatina' ),
		'section'     => 'loadmore_pagination',
		'default'     => true,
	] );

	
	Kirki::add_field( 'cavatina', [
		'type'        => 'checkbox',
		'settings'    => 'blog_loadmore',
		'label'       => esc_html__( 'Blog Page Load more', 'cavatina' ),
		'description' => esc_html__( 'Add load more button to Blog archives page', 'cavatina' ),
		'section'     => 'loadmore_pagination',
		'default'     => false,
	] );

	Kirki::add_field( 'cavatina', [
		'type'        => 'checkbox',
		'settings'    => 'archive_loadmore',
		'label'       => esc_html__( 'Archives Page Load more', 'cavatina' ),
		'description' => esc_html__( 'Add load more button to archives page', 'cavatina' ),
		'section'     => 'loadmore_pagination',
		'default'     => false,
	] );
	

	/* Typography Settings */
	Kirki::add_field( 'cavatina', [
		'type'     => 'color',
		'settings' => 'typography_primary_color',
		'label'    => __( 'Primary Color', 'cavatina' ),
		'section'  => 'typography_headings',
		'default'  => '#000000',
		'priority'    => 9,
		
	] );

	
	Kirki::add_field( 'cavatina', [
		'type'     => 'color',
		'settings' => 'typography_secondary_color',
		'label'    => __( 'Secondary Color', 'cavatina' ),
		'section'  => 'typography_headings',
		'default'  => '#767676',
		'priority'    => 9,
		
	] );


	// Headings typography h1
	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h1',
		'label'       => esc_html__( 'H1', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '24px',
			'variant'         	 => '600',
			'color'         	 => '#000000',
			'line-height'     	 => '30px',
		],
		'priority'    => 10,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h1' ),
			],
		],
	] );

	
	// Headings typography h2
	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h2',
		'label'       => esc_html__( 'H2', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '19px',
			'line-height'     	 => '30px',
			'variant'         	 => '400',
			'color'         	 => '#000000',
		],
		'priority'    => 11,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h2' ),
			],
		],
	] );

	
	// Headings typography h3
	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h3',
		'label'       => esc_html__( 'H3', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '14px',
			'variant'         	 => '600',
			'color'         	 => '#000000',
			'line-height'     	 => '20px',
		],
		'priority'    => 12,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h3' ),
			],
		],
	] );


	// Headings typography h4
	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h4',
		'label'       => esc_html__( 'H4', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '12px',
			'variant'         	 => '400',
			'color'         	 => '#000000',
		],
		'priority'    => 13,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h4'),
			],
		],
	] );


	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h5',
		'label'       => esc_html__( 'H5', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '12px',
			'variant'         	 => '400',
			'color'         	 => '#000000',
		],
		'priority'    => 13,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h5'),
			],
		],
	] );


	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h6',
		'label'       => esc_html__( 'H6', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '12px',
			'variant'         	 => '400',
			'color'         	 => '#000000',
		],
		'priority'    => 13,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h6'),
			],
		],
	] );


	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h4',
		'label'       => esc_html__( 'H4, H5, H6', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '12px',
			'variant'         	 => '400',
			'color'         	 => '#000000',
		],
		'priority'    => 13,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h4' , 'h5' , 'h6'),
			],
		],
	] );


	
	// Paragraph typography
	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_paragraph',
		'label'       => esc_html__( 'Paragraph', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '14px',
			'line-height'        => '28px',
			'variant'         	 => 'regular',
			'color'         	 => '#000000',
		],
		'priority'    => 14,
		'transport'   => 'auto',
		
		'output'      => [
			[
				'element' => array( 'p' , 'ul' , ".menu-item a" ),
			],
		],
	] );


	// Social Media
	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'linkedin_link',
		'label'    => __( 'Linkedin', 'cavatina' ),
		'section'  => 'social_media',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'facebook_link',
		'label'    => __( 'Facebook', 'cavatina' ),
		'section'  => 'social_media',
		'default'  => '',
		'priority' => 11,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'github_link',
		'label'    => __( 'Github', 'cavatina' ),
		'section'  => 'social_media',
		'default'  => '',
		'priority' => 12,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'twitter_link',
		'label'    => __( 'Twitter', 'cavatina' ),
		'section'  => 'social_media',
		'default'  => '',
		'priority' => 13,
	] );
}