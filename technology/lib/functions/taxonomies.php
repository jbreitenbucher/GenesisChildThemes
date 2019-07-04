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
        'name' => esc_html_x( 'Roles', 'taxonomy general name', 'technology' ),
        'singular_name' => esc_html_x( 'Role', 'taxonomy singular name', 'technology' ),
        'search_items' =>  esc_html__( 'Search Roles', 'technology' ),
        'popular_items' => esc_html__( 'Popular Roles', 'technology' ),
        'all_items' => esc_html__( 'All Roles', 'technology' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => esc_html__( 'Edit Role', 'technology' ), 
        'update_item' => esc_html__( 'Update Role', 'technology' ),
        'add_new_item' => esc_html__( 'Add New Role', 'technology' ),
        'new_item_name' => esc_html__( 'New Role Name', 'technology' ),
        'separate_items_with_commas' => esc_html__( 'Separate roles with commas', 'technology' ),
        'add_or_remove_items' => esc_html__( 'Add or remove roles', 'technology' ),
        'choose_from_most_used' => esc_html__( 'Choose from the most used roles', 'technology' ),
        'menu_name' => esc_html__( 'Role', 'technology' ),
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
        'name' => esc_html_x( 'Areas of Expertise', 'taxonomy general name', 'technology' ),
        'singular_name' => esc_html_x( 'Expertise', 'taxonomy singular name', 'technology' ),
        'search_items' =>  esc_html__( 'Search Areas of Expertise', 'technology' ),
        'popular_items' => esc_html__( 'Popular Areas of Expertise', 'technology' ),
        'all_items' => esc_html__( 'All Areas of Expertise', 'technology' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => esc_html__( 'Edit Expertise', 'technology' ), 
        'update_item' => esc_html__( 'Update Expertise', 'technology' ),
        'add_new_item' => esc_html__( 'Add New Expertise', 'technology' ),
        'new_item_name' => esc_html__( 'New Expertise Name', 'technology' ),
        'separate_items_with_commas' => esc_html__( 'Separate areas of expertise with commas', 'technology' ),
        'add_or_remove_items' => esc_html__( 'Add or remove areas of expertise', 'technology' ),
        'choose_from_most_used' => esc_html__( 'Choose from the most used areas of expertise', 'technology' ),
        'menu_name' => esc_html__( 'Expertise', 'technology' ),
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