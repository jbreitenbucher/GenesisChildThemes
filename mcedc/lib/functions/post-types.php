<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package     mcedc
 * @author      The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright   Copyright (c) 2012, Medina County Economic Development Corporation
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Create Staff post type
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 * @author The Pedestal Group
 *
 */

function mcedc_create_staff_post_type() {
    $labels = array(
        'name' => _x('People', 'post type general name'),
        'singular_name' => _x('Person', 'post type singular name'),
        'add_new' => _x('Add New', 'person'),
        'add_new_item' => __('Add New Person'),
        'edit_item' => __('Edit Person'),
        'new_item' => __('New Person'),
        'all_items' => __('All People'),
        'view_item' => __('View Person'),
        'search_items' => __('Search People'),
        'not_found' =>  __('No people found'),
        'not_found_in_trash' => __('No people found in Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'People'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'A post type for entering information about MCEDC staff and members.',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'hierarchical' => false,
        'supports' => array('thumbnail'),
        'rewrite' => array('slug' => 'people'),
        'has_archive' => 'false',
    );
    register_post_type('staff',$args);
}
add_action( 'init', 'mcedc_create_staff_post_type' );
