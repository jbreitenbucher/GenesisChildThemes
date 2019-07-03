<?php
/**
 * Metaboxes
 *
 * This file registers any custom metaboxes
 *
 * @package technology
 * @author  Jon Breitenbucher
 * @license GPL-2.0-or-later
 * @link    https://github.com/jbreitenbucher/GenesisChildThemes/technology-3
 * @version SVN: $Id$
 * @since   1.0
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
        'title' => __('Information', 'technology'),
        'pages' => array('itpeople'), // post type
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('First Name', 'technology'),
                'desc' => '',
                'id' => $prefix . 'first_name_text',
                'type' => 'text'
            ),
            array(
                'name' => __('Last Name', 'technology'),
                'desc' => '',
                'id' => $prefix . 'last_name_text',
                'type' => 'text'
            ),
            array(
                'name' => __('Title', 'technology'),
                'desc' => __('Your position title.', 'technology'),
                'id' => $prefix . 'title_text',
                'type' => 'text'
            ),
            array(
                'name' => __('Office', 'technology'),
                'desc' => __('Your office number.', 'technology'),
                'id' => $prefix . 'office_text',
                'type' => 'text'
            ),
            array(
                'name' => __('Phone Number', 'technology'),
                'desc' => __('Your campus phone number.', 'technology'),
                'id' => $prefix . 'phone_number_text',
                'type' => 'text'
            ),
            array(
                'name' => __('e-mail Address', 'technology'),
                'desc' => __('Your campus e-mail.', 'technology'),
                'id' => $prefix . 'email_address_text',
                'type' => 'text'
            ),
            array(
                'name' => __('Address', 'technology'),
                'desc' => __('Your campus address.', 'technology'),
                'id' => $prefix . 'address_textarea',
                'type' => 'textarea'
            ),
            array(
                'name' => __('About Me', 'technology'),
                'desc' => __('Give a brief description about your technology interests and your duties.', 'technology'),
                'id' => $prefix . 'about_me_wysiwyg',
                'type' => 'wysiwyg',
                'options' => array(
                    'wpautop' => true, // use wpautop?
                    'media_buttons' => false, // show insert/upload button(s)
                    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                ),
            ),
            array(
                'name' => __('Role', 'technology'),
                'desc' => '',
                'id' => $prefix . 'role_taxonomy_select',
                'taxonomy' => 'role', //Enter Taxonomy Slug
                'type' => 'taxonomy_select',    
            ),
            array(
                'name' => __('Areas of Expertise', 'technology'),
                'desc' => __('What are your areas of expertise?', 'technology'),
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
