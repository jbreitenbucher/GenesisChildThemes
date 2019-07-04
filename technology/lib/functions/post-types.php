<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package technology
 * @author  Jon Breitenbucher
 * @license GPL-2.0-or-later
 * @link    https://github.com/jbreitenbucher/GenesisChildThemes/technology
 * @version SVN: $Id$
 * @since   1.0
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
        'name' => esc_html_x('Staff', 'post type general name', 'technology'),
        'singular_name' => esc_html_x('Staff Member', 'post type singular name', 'technology'),
        'add_new' => esc_html_x('Add New', 'person', 'technology'),
        'add_new_item' => esc_html__('Add New Staff Member', 'technology'),
        'edit_item' => esc_html__('Edit Staff Member', 'technology'),
        'new_item' => esc_html__('New Staff Memeber', 'technology'),
        'all_items' => esc_html__('All Staff', 'technology'),
        'view_item' => esc_html__('View Staff Member', 'technology'),
        'search_items' => esc_html__('Search Staff', 'technology'),
        'not_found' =>  esc_html__('No staff found', 'technology'),
        'not_found_in_trash' => esc_html__('No staff found in Trash', 'technology'), 
        'parent_item_colon' => '',
        'menu_name' => esc_html__('Staff', 'technology')
    );
    $args = array(
        'labels' => $labels,
        'description' => esc_html__('A post type for entering staff information.', 'technology'),
        'public' => true,
        'hierarchical' => false,
        'supports' => array('thumbnail','excerpt','author'),
        'rewrite' => array('slug' => 'people'),
        'menu_icon' => 'dashicons-groups',
        'has_archive' => 'people',
    );
    register_post_type('itpeople',$args);
}
add_action( 'init', 'tech_create_itpeople_post_type' );
