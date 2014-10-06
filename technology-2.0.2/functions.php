<?php
/**
 * Functions
 *
 * @package      technology
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright    Copyright (c) 2012, The College of Wooster
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

/**
 * Theme Setup
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {
	
	// Start the engine
	require_once( get_template_directory() . '/lib/init.php' );
	require_once( get_stylesheet_directory() . '/lib/init.php' );
	
	// Child theme (do not remove)
	define( 'CHILD_THEME_NAME', 'Technology Theme' );
	define( 'CHILD_THEME_URL', 'http://instructionaltechnology.wooster.edu/' );

	$content_width = apply_filters( 'content_width', 580, 0, 910 );
	
	//* Add HTML5 markup structure
	add_theme_support( 'html5' );
	
	//* Add custom header support
	add_theme_support( 'custom-header' );
	
	// Add support for theme options
	add_action( 'admin_init', 'tech_reset' );
	add_action( 'admin_init', 'tech_register_settings' );
	add_action( 'admin_menu', 'tech_add_menu', 100);
	add_action( 'admin_notices', 'tech_notices' );
	add_action( 'genesis_settings_sanitizer_init', 'tech_staff_sanitization_filters' );
	
	// Unregister 3-column site layouts
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	
	// Unregister Genesis Sidebars
	add_action( 'widgets_init', 'tech_remove_sidebars' );
	
	// Customize Header
	remove_action( 'genesis_header', 'genesis_do_header' );
	add_action( 'genesis_header', 'tech_header' );
	
	// Add new featured image sizes
	add_image_size('home-bottom', 150, 130, TRUE);
	add_image_size('home-middle', 287, 120, TRUE);
	add_image_size('home-featured', 870, 320, TRUE);
	add_image_size('classroom-image', 600, 200, TRUE);
	add_image_size('classroom-square', 100, 100, TRUE);
	add_image_size('profile-picture-listing', 325, 183, TRUE);
	add_image_size('profile-picture-single', 325, 183, TRUE);

	// Add support for color styles (as of Genesis 1.8)
	add_theme_support( 'genesis-style-selector', array( 'it-wooster' => 'Wooster' ) );
	
	// Add support for structural wraps
	add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );
	//add_action( 'genesis_before_header', 'tech_structure_begin' );
	//add_action( 'genesis_after_footer', 'tech_structure_end' );

	// Add support for 3-column footer widgets
	add_theme_support( 'genesis-footer-widgets', 3 );

	// Customize breadcrumb display
	add_filter( 'genesis_breadcrumb_args', 'tech_breadcrumb_args' );
	
	// Register Sidebars
	genesis_register_sidebar( array(
		'id'			=> 'featured',
		'name'			=> __( 'Featured', 'informationtechnology' ),
		'description'	=> __( 'This is the featured section.', 'informationtechnology' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-1',
		'name'			=> __( 'Home Middle #1', 'informationtechnology' ),
		'description'	=> __( 'This is the first column of the home middle section.', 'informationtechnology' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-2',
		'name'			=> __( 'Home Middle #2', 'informationtechnology' ),
		'description'	=> __( 'This is the second column of the home middle section.', 'informationtechnology' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-3',
		'name'			=> __( 'Home Middle #3', 'informationtechnology' ),
		'description'	=> __( 'This is the third column of the home middle section.', 'informationtechnology' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-bottom-1',
		'name'			=> __( 'Home Bottom #1', 'informationtechnology' ),
		'description'	=> __( 'This is the first column of the home bottom section.', 'informationtechnology' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-bottom-2',
		'name'			=> __( 'Home Bottom #2', 'informationtechnology' ),
		'description'	=> __( 'This is the second column of the home bottom section.', 'informationtechnology' ),
	) );
	
	//* Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );
}