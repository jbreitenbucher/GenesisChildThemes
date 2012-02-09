<?php
/**
 * Functions
 *
 * @package      dorman-farrell
 * @author       The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright    Copyright (c) 2012, Dorman Farrell
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Theme Setup
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */

add_action('genesis_setup', 'df_theme_setup', 15);
function df_theme_setup() {
	
	/** Start the engine */
	require_once( get_template_directory() . '/lib/init.php' );
	require_once( get_stylesheet_directory() . '/lib/init.php' );
	
	/** Child theme (do not remove) */
	define( 'CHILD_THEME_NAME', 'Dorman Farrell Theme' );
	define( 'CHILD_THEME_URL', 'http://dormanfarrell.com' );
	
	// Add support for theme options
	add_action( 'admin_init', 'tpg_reset' );
	add_action( 'admin_init', 'tpg_register_settings' );
	add_action( 'admin_menu', 'tpg_add_menu', 100);
	add_action( 'admin_notices', 'tpg_notices' );
	add_action( 'genesis_settings_sanitizer_init', 'tpg_staff_sanitization_filters' );
	
	/** Unregister layout setting */
	genesis_unregister_layout( 'content-sidebar' );
	genesis_unregister_layout( 'sidebar-content' );
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	
	// Unregister Genesis Sidebars
	add_action( 'widgets_init', 'tpg_remove_sidebars' );
	
	// Customize Header
	//remove_action( 'genesis_header', 'genesis_do_header' );
	//add_action( 'genesis_header', 'tpg_header' );
	
	// Add new featured image sizes
	add_image_size('post_thumb', 390, 426, TRUE);
	add_image_size('profile-picture-single',150,146, TRUE);
	
	// Add support for 3-column footer widgets
	//add_theme_support( 'genesis-footer-widgets', 3 );
	
	// Customize breadcrumb display
	add_filter( 'genesis_breadcrumb_args', 'tpg_breadcrumb_args' );
	
	// Register Sidebars
	genesis_register_sidebar( array(
		'id'			=> 'featured',
		'name'			=> __( 'Featured' ),
		'description'	=> __( 'This is the featured section on the homepage.' ),
	) );
}