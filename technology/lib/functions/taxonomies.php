<?php
/**
 * Taxonomies
 *
 * This file registers any custom taxonomies
 *
 * @package technology
 * @author  Jon Breitenbucher
 * @license GPL-2.0-or-later
 * @link    https://github.com/jbreitenbucher/GenesisChildThemes/technology-3
 * @version SVN: $Id$
 * @since   
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
        'name' => _x( 'Roles', 'taxonomy general name', 'technology' ),
        'singular_name' => _x( 'Role', 'taxonomy singular name', 'technology' ),
        'search_items' =>  __( 'Search Roles', 'technology' ),
        'popular_items' => __( 'Popular Roles', 'technology' ),
        'all_items' => __( 'All Roles', 'technology' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Role', 'technology' ), 
        'update_item' => __( 'Update Role', 'technology' ),
        'add_new_item' => __( 'Add New Role', 'technology' ),
        'new_item_name' => __( 'New Role Name', 'technology' ),
        'separate_items_with_commas' => __( 'Separate roles with commas', 'technology' ),
        'add_or_remove_items' => __( 'Add or remove roles', 'technology' ),
        'choose_from_most_used' => __( 'Choose from the most used roles', 'technology' ),
        'menu_name' => __( 'Role', 'technology' ),
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
        'name' => _x( 'Areas of Expertise', 'taxonomy general name', 'technology' ),
        'singular_name' => _x( 'Expertise', 'taxonomy singular name', 'technology' ),
        'search_items' =>  __( 'Search Areas of Expertise', 'technology' ),
        'popular_items' => __( 'Popular Areas of Expertise', 'technology' ),
        'all_items' => __( 'All Areas of Expertise', 'technology' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Expertise', 'technology' ), 
        'update_item' => __( 'Update Expertise', 'technology' ),
        'add_new_item' => __( 'Add New Expertise', 'technology' ),
        'new_item_name' => __( 'New Expertise Name', 'technology' ),
        'separate_items_with_commas' => __( 'Separate areas of expertise with commas', 'technology' ),
        'add_or_remove_items' => __( 'Add or remove areas of expertise', 'technology' ),
        'choose_from_most_used' => __( 'Choose from the most used areas of expertise', 'technology' ),
        'menu_name' => __( 'Expertise', 'technology' ),
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