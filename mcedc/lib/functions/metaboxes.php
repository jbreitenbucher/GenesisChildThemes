<?php
/**
 * Metaboxes
 *
 * This file registers any custom metaboxes
 *
 * @package     mcedc
 * @author      The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright   Copyright (c) 2012, Medina County Economic Development Corporation
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Create Staff Metabox
 *
 * @link https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 * @author The Pedestal Group
 *
 */

function mcedc_create_metaboxes( $meta_boxes ) {
    $prefix = 'mcedc_'; // start with an underscore to hide fields from custom fields list
    $meta_boxes[] = array(
        'id' => 'staff_info_metabox',
        'title' => 'Information',
        'pages' => array('staff'), // post type
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'First Name',
                'desc' => '',
                'id' => $prefix . 'first_name_text',
                'type' => 'text'
            ),
            array(
                'name' => 'Last Name',
                'desc' => '',
                'id' => $prefix . 'last_name_text',
                'type' => 'text'
            ),
            array(
                'name' => 'Title',
                'desc' => 'MCEDC Position title.',
                'id' => $prefix . 'title_text',
                'type' => 'text'
            ),
            array(
                'name' => 'Phone Number',
                'desc' => 'Direct dial number.',
                'id' => $prefix . 'phone_number_text',
                'type' => 'text'
            ),
            array(
                'name' => 'e-mail Address',
                'desc' => 'Corporate e-mail address.',
                'id' => $prefix . 'email_address_text',
                'type' => 'text'
            ),
            array(
                'name' => 'Business Information',
                'desc' => 'Enter business information for Executive Officers and members of the Executive Committee.',
                'id' => $prefix . 'business_info_wysiwig',
                'type' => 'wysiwyg',
				'options' => array(
                    'wpautop' => true, // use wpautop?
                    'media_buttons' => false, // show insert/upload button(s)
                    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                ),
            ),
            array(
                'name' => 'Role',
                'desc' => '',
                'id' => $prefix . 'role_taxonomy_select',
                'taxonomy' => 'role', //Enter Taxonomy Slug
                'type' => 'taxonomy_select',    
            ),
            array(
                'name' => 'Order',
                'desc' => 'Used to order the list of staff.',
                'id' => $prefix . 'order_text',
                'type' => 'text'
            ),
        ),
    );
    
    return $meta_boxes;
}

add_filter( 'cmb_meta_boxes' , 'mcedc_create_metaboxes' );
 
 
/**
 * Initialize Metabox Class
 * see /lib/metabox/example-functions.php for more information
 *
 */
function mcedc_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( get_stylesheet_directory() . '/lib/metabox/init.php' );
    }
}

add_action( 'init', 'mcedc_initialize_cmb_meta_boxes', 9999 );
