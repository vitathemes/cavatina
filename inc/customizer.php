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
	 *	Kirki - Panels
	 */
	// Typography
	Kirki::add_panel( 'elements', array(
		'priority' => 75,
		'title'    => esc_html__( 'Elements', 'cavatina' ),
	));
	
	
	/*
	 *	Kirki -> Sections
	 */

	/* Single Options */
	Kirki::add_section( 'single_options', array(
		'title'          => esc_html__( 'Single Options', 'cavatina' ),
		'panel'          => 'elements',
		'priority'       => 200,
	));

	/* Archive Options */
	Kirki::add_section( 'archive_options', array(
		'title'          => esc_html__( 'Archive Options', 'cavatina' ),
		'panel'          => 'elements',
		'priority'       => 210,
	));

	/* Projects Options */
	Kirki::add_section( 'projects_options', array(
		'title'          => esc_html__( 'Projects Options', 'cavatina' ),
		'panel'          => 'elements',
		'priority'       => 220,
	));

	// typography settings  
	Kirki::add_section( 'typography_headings', array(
		'title'          => esc_html__( 'Typography Setting', 'cavatina' ),
		'description'    => esc_html__( 'Change typography color and customize them.', 'cavatina' ),
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

	/* Social Media  */
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
	

	Kirki::add_field( 'cavatina', [
		'type'     => 'color',
		'settings' => 'typography_accent_color',
		'label'    => __( 'Accent Color', 'cavatina' ),
		'section'  => 'typography_headings',
		'default'  => '#ff3636',
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
			'color'         	  => '#000000',
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
			'font-size'          => '14px',
			'line-height'     	 => '30px',
			'variant'         	 => 'regular',
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




	// Headings typography h5
	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h5',
		'label'       => esc_html__( 'H5', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '12px',
			'line-height'     	 => '30px',
			'variant'         	 => 'regular',
			'color'         	 => '#000000',
		],
		'priority'    => 14,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h5'),
			],
		],
	] );

	
	// Headings typography h6
	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'typography_h6',
		'label'       => esc_html__( 'H6', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '10px',
			'line-height'     	 => '30px',
			'variant'         	 => 'regular',
			'color'         	 => '#000000',
		],
		'priority'    => 15,
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => array( 'h6'),
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
		'priority'    => 17,
		'transport'   => 'auto',
		
		'output'      => [
			[
				'element' => array( 'p' , 'ul' , 'ol', ".menu-item a" ),
			],
		],
	] );


	// Secondary Links
	Kirki::add_field( 'cavatina_theme', [
		'type'        => 'typography',
		'settings'    => 'secondary_links',
		'label'       => esc_html__( 'Secondary Links', 'cavatina' ),
		'section'     => 'typography_headings',
		'default'     => [
			'font-family'   	 => 'Montserrat',
			'font-size'          => '14px',
			'line-height'        => '17px',
			'variant'         	 => 'regular',
			'color'         	 => '#000000',
		],
		'priority'    => 18,
		'transport'   => 'auto',
		
		'output'      => [
			[
				'element' => array( '.h4-lh--sm' , ".s-nav > .menu-item a", ".c-aside__category__link h4" ),
			],
		],
	] );
	
	

	// -- Socials --
	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'linkedin',
		'label'    => __( 'Linkedin', 'cavatina' ),
		'section'  => 'social_media',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'facebook',
		'label'    => __( 'Facebook', 'cavatina' ),
		'section'  => 'social_media',
		'default'  => '',
		'priority' => 5,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'github',
		'label'    => __( 'Github', 'cavatina' ),
		'section'  => 'social_media',
		'default'  => '',
		'priority' => 12,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'twitter',
		'label'    => __( 'Twitter', 'cavatina' ),
		'section'  => 'social_media',
		'default'  => '',
		'priority' => 13,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'instagram',
		'label'    => esc_html__( 'Instagram', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 14,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'text',
		'settings' => 'mail',
		'label'    => __( 'Email', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 15,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'pinterest',
		'label'    => __( 'Pinterest', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 16,
	] );


	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'youtube',
		'label'    => __( 'Youtube', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 17,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'spotify',
		'label'    => __( 'Spotify', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 18,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'gitlab',
		'label'    => __( 'Gitlab', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 19,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'lastfm',
		'label'    => __( 'Lastfm', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 20,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'stackoverflow',
		'label'    => __( 'Stackoverflow', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 21,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'quora',
		'label'    => __( 'Quora', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 22,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'reddit',
		'label'    => __( 'Reddit', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 23,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'medium',
		'label'    => __( 'Medium', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 24,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'vimeo',
		'label'    => __( 'Vimeo', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 25,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'lanyrd',
		'label'    => __( 'Lanyrd', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 25.5,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'dribbble',
		'label'    => __( 'Dribbble', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 26,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'behance',
		'label'    => __( 'Behance', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 27,
	] );
	

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'codepen',
		'label'    => __( 'Codepen', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 28,
	] );

	Kirki::add_field( 'cavatina', [
		'type'     => 'link',
		'settings' => 'telegram',
		'label'    => __( 'Telegram', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 29,
	] );
	
	Kirki::add_field( 'cavatina', [
		'type'     => 'text',
		'settings' => 'phone_number',
		'label'    => __( 'Phone Number', 'cavatina' ),
		'section'  => 'social_media',
		'priority' => 30,
	] );
	
	/*------------------------------------*\
	  #Single Options
	\*------------------------------------*/
	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'publish_date',
		'label'       => esc_html__( 'Show Publish Date', 'cavatina' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'show_single_cat',
		'label'       => esc_html__( 'Display Posts Category', 'cavatina' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 11,
	] );
	
	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'show_author',
		'label'       => esc_html__( 'Show Author', 'cavatina' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 20,
	] );
	
	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'post_tags',
		'label'       => esc_html__( 'Show Posts Tags', 'cavatina' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 50,
	] );

	// Post Share icons Checkbox
	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'post_share_icons',
		'label'       => esc_html__( 'Display Share icons for posts', 'cavatina' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 60,
	] );

	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'post_thumbnail',
		'label'       => esc_html__( 'Show Post Thumbnail', 'cavatina' ),
		'section'     => 'single_options',
		'default'     => '1',
		'priority'    => 70,
	] );

	/*------------------------------------*\
		#Archive Options
	\*------------------------------------*/
	// Show Archives Posts Categories
	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'archives_posts_category',
		'label'       => esc_html__( 'Show Archives Posts Categories', 'cavatina' ),
		'section'     => 'archive_options',
		'default'     => '1',
		'priority'    => 20,
	] );

	// Display Date
	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'archives_posts_date',
		'label'       => esc_html__( 'Show Posts Date', 'cavatina' ),
		'section'     => 'archive_options',
		'default'     => '1',
		'priority'    => 30,
	] );
	

	/*------------------------------------*\
	  #Projects Options
	\*------------------------------------*/
	// Enable Portfolios (Custom Post type) Category
	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'projects_category',
		'label'       => esc_html__( 'Display Project Category', 'cavatina' ),
		'section'     => 'projects_options',
		'default'     => '1',
		'priority'    => 30,
	] );
	

	// Enable Portfolios (Custom Post type) Category
	Kirki::add_field( 'cavatina', [
		'type'        => 'toggle',
		'settings'    => 'projects_excerpt',
		'label'       => esc_html__( 'Display Projects Excerpt', 'cavatina' ),
		'section'     => 'projects_options',
		'default'     => '1',
		'priority'    => 30,
	] );
	
}