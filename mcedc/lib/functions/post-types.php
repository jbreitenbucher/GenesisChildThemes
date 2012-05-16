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
        'name' => _x('Staff', 'post type general name'),
        'singular_name' => _x('Staff Member', 'post type singular name'),
        'add_new' => _x('Add New', 'person'),
        'add_new_item' => __('Add New Staff Member'),
        'edit_item' => __('Edit Staff Member'),
        'new_item' => __('New Staff Memeber'),
        'all_items' => __('All Staff'),
        'view_item' => __('View Staff Member'),
        'search_items' => __('Search Staff'),
        'not_found' =>  __('No staff found'),
        'not_found_in_trash' => __('No staff found in Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Staff'
    );
    $args = array(
        'labels' => $labels,
        'description' => 'A post type for entering staff information.',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'hierarchical' => false,
        'supports' => array('thumbnail'),
        'rewrite' => array('slug' => 'mcedc-staff'),
        'has_archive' => 'mcedc-staff',
    );
    register_post_type('staff',$args);
}
add_action( 'init', 'mcedc_create_staff_post_type' );
