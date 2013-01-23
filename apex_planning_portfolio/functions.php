<?php
/**
 * Functions
 *
 * @package    apex_port
 * @author     Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright  Copyright (c) 2012, The College of Wooster
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version    SVN: $Id$
 * @since      1.0
 *
 */

/**
 * Theme Setup
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 * @author  Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version SVN: $Id$
 * @since   1.0
 *
 */

add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {
	
	// Start the engine
	require_once( get_template_directory() . '/lib/init.php' );
	require_once( get_stylesheet_directory() . '/lib/init.php' );
	
	// Child theme (do not remove)
	define( 'CHILD_THEME_NAME', 'APEX Planning Portfolio Theme' );
	define( 'CHILD_THEME_URL', 'http://apex.wooster.edu/' );

	$content_width = apply_filters( 'content_width', 580, 0, 910 );
	
	// Unregister 3-column site layouts
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	genesis_unregister_layout( 'sidebar-content' );
	
	// Unregister Genesis Sidebars
	add_action( 'widgets_init', 'apex_port_remove_sidebars' );
	
	// Customize Header
	remove_action( 'genesis_header', 'genesis_do_header' );
	add_action( 'genesis_header', 'apex_port_header' );
	
	// Add support for structural wraps
	add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

}