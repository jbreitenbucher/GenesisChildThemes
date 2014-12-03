<?php
/**
 * Post Types
 *
 * This file registers any custom post types
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
 * Create Staff post type
 *
 * @link      http://codex.wordpress.org/Function_Reference/register_post_type
 * @author    Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version   SVN: $Id$
 * @since     1.0
 *
 */

function tech_create_itpeople_post_type() {
	$labels = array(
		'name' => _x('Staff', 'post type general name'),
		'singular_name' => _x('Staff Member', 'post type singular name'),
		'add_new' => _x('Add New', 'person'),
		'add_new_item' => __('Add New Staff Member'),
		'edit_item' => __('Edit Staff Member'),
		'new_item' => __('New Staff Memeber'),
		'all_items' => __('All Staff'),
		'view_item' => __('View Staff Member'),
		'search_items' => __('Search Staff'),
		'not_found' =>	__('No staff found'),
		'not_found_in_trash' => __('No staff found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => 'Staff'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'A post type for entering staff information.',
		'public' => true,
		'menu_icon' => 'dashicons-groups',
		'hierarchical' => false,
		'supports' => array('thumbnail','excerpt','author'),
		'rewrite' => array('slug' => 'people'),
		'has_archive' => 'people',
	);
	register_post_type('itpeople',$args);
}
add_action( 'init', 'tech_create_itpeople_post_type' );
