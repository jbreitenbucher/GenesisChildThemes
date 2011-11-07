<?php
/**
 * This file controls customizations to the Faculty Child Theme.
 *
 * @author Jon Breitenbucher & StudioPress
 * @package Faculty
 * @subpackage Customizations
 */

/** Start the engine */
require_once( get_template_directory() . '/lib/init.php');
require_once( get_stylesheet_directory() . '/lib/init.php');

/** Child theme (do not remove) */
define('CHILD_THEME_NAME', 'Faculty Theme');
define('CHILD_THEME_URL', 'http://voices.wooster.edu/themes/faculty');

/** Add new image sizes */
add_image_size( 'square', 100, 100, TRUE );
add_image_size( 'featured-top-bottom', 460, 288, TRUE );
add_image_size( 'featured-middle', 299, 187, TRUE );
add_image_size( 'featured-footer', 215, 134, TRUE );
add_image_size( 'slider', 590, 300, TRUE );

/** Add support for custom background */
if ( function_exists( 'add_custom_background' ) ) {
    add_custom_background();
}

/** Add branding section */
function wooster_include_branding() {
    require_once( get_stylesheet_directory() . '/branding.php');
}
add_action('genesis_before_header', 'wooster_include_branding');

/** Reposition the Primary Navigation */
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_before_header', 'genesis_do_nav');

/**
 * Modify the size of the Gravatar in the author box
 * 
 * @param int $size
 */
function faculty_gravatar_size($size) {
    return '60'; 
}
add_filter('genesis_author_box_gravatar_size', 'faculty_gravatar_size');

/** Add support for 4 footer widgets */
add_theme_support( 'genesis-footer-widgets', 4 );

/**
 * Customize the footer section
 *
 * @param string $creds
 * @return string 
 */
function faculty_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', FACULTY_DOMAIN) .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
}
add_filter('genesis_footer_creds_text', 'faculty_footer_creds_text');

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'slider',
	'name'			=> __( 'Slider', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the slider section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-top-left',
	'name'			=> __( 'Featured Top Left', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the top left section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-top-right',
	'name'			=> __( 'Featured Top Right', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the top right section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-middle-left',
	'name'			=> __( 'Featured Middle Left', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the middle left section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-middle-center',
	'name'			=> __( 'Featured Middle Center', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the middle center section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-middle-right',
	'name'			=> __( 'Featured Middle Right', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the middle right section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-bottom-left',
	'name'			=> __( 'Featured Bottom Left', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the featured bottom left section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-bottom-right',
	'name'			=> __( 'Featured Bottom Right', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the featured bottom right section.', FACULTY_DOMAIN ),
) );