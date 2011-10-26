<?php
/**
 * This file controls customizations to the Faculty Child Theme.
 *
 * @author Jon Breitenbucher & StudioPress
 * @package Faculty
 * @subpackage Customizations
 */

/**
 * Include Genesis theme files
 */
require_once(TEMPLATEPATH.'/lib/init.php');

/**
 * Include Prose theme files
 */
require_once(STYLESHEETPATH.'/lib/init.php');

// Add support for custom background
if (function_exists('add_custom_background')) {
    add_custom_background();
}

/**
 * Defines child theme name (do not remove)
 */  
define('CHILD_THEME_NAME', 'Faculty Theme');

/**
 * Defines child theme URL (do not remove)
 */  
define('CHILD_THEME_URL', 'http://voices.wooster.edu/themes/faculty');

// Reposition the Primary Navigation
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

/**
 * Add widgeted footer section
 */
function faculty_include_footer_widgets() {
    require_once(CHILD_DIR . '/footer-widgeted.php');
}
add_action('genesis_before_footer', 'faculty_include_footer_widgets'); 

// Reposition the footer
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
add_action('genesis_after', 'genesis_footer_markup_open', 5);
add_action('genesis_after', 'genesis_do_footer');
add_action('genesis_after', 'genesis_footer_markup_close', 15);

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

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Footer #1',
	'description' => __('This is the first column of the footer section.', FACULTY_DOMAIN),
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Footer #2',
	'description' => __('This is the second column of the footer section.', FACULTY_DOMAIN),
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Footer #3',
	'description' => __('This is the third column of the footer section.', FACULTY_DOMAIN),
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));