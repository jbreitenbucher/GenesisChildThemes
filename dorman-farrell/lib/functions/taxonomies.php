<?php
/**
 * Taxonomies
 *
 * This file registers any custom taxonomies
 *
 * @package      dorman-farrell
 * @author       The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright    Copyright (c) 2012, Dorman Farrell
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */


/**
 * Create Role Taxonomy
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 * @author The Pedestal Group
 *
 */

function tpg_create_role_taxonomy(){
	$labels = array(
		'name' => _x( 'Roles', 'taxonomy general name' ),
		'singular_name' => _x( 'Role', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Roles' ),
		'popular_items' => __( 'Popular Roles' ),
		'all_items' => __( 'All Roles' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Role' ), 
		'update_item' => __( 'Update Role' ),
		'add_new_item' => __( 'Add New Role' ),
		'new_item_name' => __( 'New Role Name' ),
		'separate_items_with_commas' => __( 'Separate roles with commas' ),
		'add_or_remove_items' => __( 'Add or remove roles' ),
		'choose_from_most_used' => __( 'Choose from the most used roles' ),
		'menu_name' => __( 'Role' ),
	);

	register_taxonomy(  
		'role',  
		'staff',  
		array(  
			'hierarchical' => false,  
			'labels' => $labels,  
			'query_var' => true,  
			'rewrite' => array( 'slug' => 'role', 'with_front' => false ),
		)  
	);
}
add_action( 'init', 'tpg_create_role_taxonomy', 0 );