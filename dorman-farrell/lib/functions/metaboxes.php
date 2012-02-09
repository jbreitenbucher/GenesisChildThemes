<?php
/**
 * Metaboxes
 *
 * This file registers any custom metaboxes
 *
 * @package      dorman-farrell
 * @author       The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright    Copyright (c) 2012, Dorman Farrell
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Create Staff Metabox
 *
 * @link https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 * @author The Pedestal Group
 *
 */

function tpg_create_metaboxes( $meta_boxes ) {
	$prefix = 'tpg_'; // start with an underscore to hide fields from custom fields list
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
				'desc' => 'Position title.',
				'id' => $prefix . 'title_text',
				'type' => 'text'
			),
			array(
				'name' => 'Office',
				'desc' => 'Office number.',
				'id' => $prefix . 'office_text',
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
				'name' => 'Address',
				'desc' => 'Business mailing address.',
				'id' => $prefix . 'address_textarea',
				'type' => 'textarea'
			),
			array(
				'name' => 'About Me',
				'desc' => 'A short description about your experience.',
				'id' => $prefix . 'about_me_wysiwyg',
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
		),
	);
	
	return $meta_boxes;
}

add_filter( 'cmb_meta_boxes' , 'tpg_create_metaboxes' );
 
 
/**
 * Initialize Metabox Class
 * see /lib/metabox/example-functions.php for more information
 *
 */
function tpg_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( get_stylesheet_directory() . '/lib/metabox/init.php' );
    }
}

add_action( 'init', 'tpg_initialize_cmb_meta_boxes', 9999 );
