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
				'name' => 'Personal Information',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . 'personal_information_title'
			),
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
                'name' => 'Bio',
                'desc' => 'Some information about the person.',
                'id' => $prefix . 'bio_wysiwig',
                'type' => 'wysiwyg',
				'options' => array(
                    'wpautop' => false, // use wpautop?
                    'media_buttons' => false, // show insert/upload button(s)
					'tinymce' => true,
                    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                ),
            ),
			array(
				'name' => 'MCEDC Information',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . 'mcedc_information_title'
			),
            array(
                'name' => 'Title',
                'desc' => 'MCEDC Position title.',
                'id' => $prefix . 'title_text',
                'type' => 'text'
            ),
			array(
                'name' => 'Role at MCEDC',
                'desc' => '',
                'id' => $prefix . 'role_taxonomy_select',
                'taxonomy' => 'role', //Enter Taxonomy Slug
                'type' => 'taxonomy_select',    
            ),
			array(
				'name' => 'Contact Information',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . 'contact_information_title'
			),
            array(
                'name' => 'Phone Number',
                'desc' => 'Preferred phone number.',
                'id' => $prefix . 'phone_number_text',
                'type' => 'text'
            ),
            array(
                'name' => 'e-mail Address',
                'desc' => 'Preferred e-mail address.',
                'id' => $prefix . 'email_address_text',
                'type' => 'text'
            ),
			array(
				'name' => 'Business Information',
				'desc' => '',
				'type' => 'title',
				'id' => $prefix . 'business_information_title'
			),
			array(
                'name' => 'Business Name',
                'desc' => '',
                'id' => $prefix . 'business_name_text',
                'type' => 'text'
            ),
			array(
                'name' => 'Business Title',
                'desc' => '',
                'id' => $prefix . 'business_title_text',
                'type' => 'text'
            ),
            array(
                'name' => 'Business Address',
                'desc' => '',
                'id' => $prefix . 'business_address_wysiwig',
                'type' => 'wysiwyg',
				'options' => array(
                    'wpautop' => false, // use wpautop?
                    'media_buttons' => true, // show insert/upload button(s)
					'tinymce' => true,
                    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                ),
            ),
			array(
                'name' => 'Business Phone',
                'desc' => '',
                'id' => $prefix . 'business_phone_text',
                'type' => 'text'
            ),
			array(
                'name' => 'Business Homepage',
                'desc' => 'Please enter the address as http://company.com',
                'id' => $prefix . 'business_url_text',
                'type' => 'text'
            ),
			//array(
				//'name' => 'Business Logo',
				//'desc' => 'Upload the business logo.',
				//'id' => $prefix . 'business_logo_image',
				//'type' => 'file',
				//'save_id' => true, // save ID using true
				//'allow' => array( 'attachment' )
			//),
			array(
                'name' => 'Industry',
                'desc' => '',
                'id' => $prefix . 'industry_taxonomy_select',
                'taxonomy' => 'industry', //Enter Taxonomy Slug
                'type' => 'taxonomy_select',    
            ),
			array(
                'name' => 'Internal Use',
                'desc' => '',
                'id' => $prefix . 'internal_use_text',
                'type' => 'title'
            ),
            array(
                'name' => 'Display Order',
                'desc' => 'Used to order the list of officers, committee members, and staff.',
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
