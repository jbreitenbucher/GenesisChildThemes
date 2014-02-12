<?php
/**
 * Taxonomies
 *
 * This file registers any custom taxonomies
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
 * Create Role Taxonomy
 *
 * @link         http://codex.wordpress.org/Function_Reference/register_taxonomy
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function tech_create_role_taxonomy(){
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
		'itpeople',	 
		array(	
			'hierarchical' => false,  
			'labels' => $labels,  
			'query_var' => true,  
			'rewrite' => array( 'slug' => 'role', 'with_front' => false ),
		)  
	);
}
add_action( 'init', 'tech_create_role_taxonomy', 0 );

function tech_create_expertise_taxonomy(){
	$labels = array(
		'name' => _x( 'Areas of Expertise', 'taxonomy general name' ),
		'singular_name' => _x( 'Expertise', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Areas of Expertise' ),
		'popular_items' => __( 'Popular Areas of Expertise' ),
		'all_items' => __( 'All Areas of Expertise' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Expertise' ), 
		'update_item' => __( 'Update Expertise' ),
		'add_new_item' => __( 'Add New Expertise' ),
		'new_item_name' => __( 'New Expertise Name' ),
		'separate_items_with_commas' => __( 'Separate areas of expertise with commas' ),
		'add_or_remove_items' => __( 'Add or remove areas of expertise' ),
		'choose_from_most_used' => __( 'Choose from the most used areas of expertise' ),
		'menu_name' => __( 'Expertise' ),
	);

	register_taxonomy(	
		'expertise',  
		'itpeople',	 
		array(	
			'hierarchical' => false,  
			'labels' => $labels,  
			'query_var' => true,  
			'rewrite' => array( 'slug' => 'expertise', 'with_front' => false ),
		)  
	);
}
add_action( 'init', 'tech_create_expertise_taxonomy', 0 );