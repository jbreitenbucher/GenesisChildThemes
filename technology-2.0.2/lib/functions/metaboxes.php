<?php
/**
 * Metaboxes
 *
 * This file registers any custom metaboxes
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
 * Create Staff Metabox
 *
 * @link        https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_create_metaboxes( $meta_boxes ) {
	$prefix = 'it_'; // start with an underscore to hide fields from custom fields list
	$meta_boxes[] = array(
		'id' => 'staff_info_metabox',
		'title' => 'Information',
		'pages' => array('itpeople'), // post type
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
				'desc' => 'Your position title.',
				'id' => $prefix . 'title_text',
				'type' => 'text'
			),
			array(
				'name' => 'Office',
				'desc' => 'Your office number.',
				'id' => $prefix . 'office_text',
				'type' => 'text'
			),
			array(
				'name' => 'Phone Number',
				'desc' => 'Your campus phone number.',
				'id' => $prefix . 'phone_number_text',
				'type' => 'text'
			),
			array(
				'name' => 'e-mail Address',
				'desc' => 'Your campus e-mail.',
				'id' => $prefix . 'email_address_text',
				'type' => 'text'
			),
			array(
				'name' => 'Address',
				'desc' => 'Your campus address.',
				'id' => $prefix . 'address_textarea',
				'type' => 'textarea'
			),
			array(
				'name' => 'About Me',
				'desc' => 'Give a brief description about your technology interests and your duties.',
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
			array(
				'name' => 'Areas of Expertise',
				'desc' => 'What are your areas of expertise?',
				'id' => $prefix . 'expertise_taxonomy_multicheck',
				'taxonomy' => 'expertise', //Enter Taxonomy Slug
				'type' => 'taxonomy_multicheck',	
			),
		),
	);
	
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes' , 'tech_create_metaboxes' );
 
 
/**
 * Initialize Metabox Class
 * see /lib/metabox/example-functions.php for more information
 *
 */

function tech_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( get_stylesheet_directory() . '/lib/metabox/init.php' );
	}
}
add_action( 'init', 'tech_initialize_cmb_meta_boxes', 9999 );
