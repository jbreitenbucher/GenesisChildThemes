<?php
/**
 * Template Name: Members
 *
 * @package     mcedc
 * @author      The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright   Copyright (c) 2012, Medina County Economic Development Corporation
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Loop Setup
 *
 * This setup function attaches all of the loop-specific functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */

add_action('genesis_before','mcedc_members_loop_setup');
function mcedc_members_loop_setup() {
    
    // Customize Before Loop
    //remove_action('genesis_before_loop','genesis_do_before_loop' );
    //add_action('genesis_before_loop','mcedc_page_before_loop');
    
    // Customize Loop
    remove_action('genesis_loop', 'genesis_do_loop');
    add_action('genesis_loop', 'mcedc_members_page_loop');
    
    // Remove Post Info
    remove_action('genesis_before_post_content', 'genesis_post_info');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_post_title', 'genesis_do_post_title');
    remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
    remove_action('genesis_post_content', 'genesis_do_post_image');
    
    // Remove Post Meta
    remove_action('genesis_after_post_content', 'genesis_post_meta');
}

function mcedc_members_page_loop() {
    $mcedc_members_args = array(
        'post_type' => 'staff',
        'meta_key' => 'mcedc_business_name_text',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'role',
                'field' => 'slug',
                'terms' => array('member'),
            ),
        )
    );
    
    query_posts( $mcedc_members_args );
    echo '<h1 class="role-members">Members</h1>';
    while (have_posts()) : the_post();
        mcedc_members_page_loop_content();
    endwhile;
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function mcedc_members_page_loop_content() {
    global $post;
    printf( '<div id="post-%s" class="person clear">', get_the_ID() );
        //use the genesis_get_custom_field template tag to display each custom field value
        echo '<div class="contact">';
        $default_attr = array(
               'class' => "alignleft profile-image-listing",
               'alt'   => $post->post_title,
               'title' => $post->post_title
           );
        echo genesis_get_image( array( 'size' => 'profile-picture-listing', 'attr' => $default_attr ) );
            if( genesis_get_custom_field('mcedc_business_name_text') != '') {
				if( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ){
					if( genesis_get_custom_field('mcedc_business_phone_text') != '' ){
						if(genesis_get_custom_field('mcedc_business_url_text') != ''){
							printf( '<h3 class="title">%s</h3><div class="info business"><span class="name">%s</span><br /><span class="address">%s</span><span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
						} else {
							printf( '<h3 class="title">%s</h3><div class="info business"><span class="name">%s</span><br /><span class="address">%s</span><span class="phone">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_phone_text') );
						}
					} else {
						if(genesis_get_custom_field('mcedc_business_url_text') != ''){
							printf( '<h3 class="title">%s</h3><div class="info business"><span class="name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
						} else {
							printf( '<h3 class="title">%s</h3><div class="info business"><span class="name">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig') );
						}
					}
				} else {
					if( genesis_get_custom_field('mcedc_business_phone_text') != '' ){
						if(genesis_get_custom_field('mcedc_business_url_text') != ''){
							printf( '<h3 class="title">%s</h3><div class="info business"><span class="name">%s</span><br /><span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );printf( '<div class="info"><span class="name">%s</span><br /><span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', the_title_attribute('echo=0'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
						} else {
							printf( '<h3 class="title">%s</h3><div class="info business"><span class="name">%s</span><br /><span class="phone">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_the_title(), genesis_get_custom_field('mcedc_business_phone_text') );
						}
					} else {
						if(genesis_get_custom_field('mcedc_business_url_text') != ''){
							printf( '<h3 class="title">%s</h3><div class="info business"><span class="name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_the_title(), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
						} else {
							printf( '<h3 class="title">%s</h3><div class="info business"><span class="name">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_the_title() );
						}
					}
				}
            } else {
			}
        echo '</div><!--#end contact-->';
    echo '</div><!--end #person -->';
}

function mcedc_page_after_loop(){
}

genesis();