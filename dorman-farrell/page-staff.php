<?php
/**
 * Template Name: Staff
 *
 * @package       dorman-farrell
 * @author          The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright      Copyright (c) 2012, Dorman Farrell
 * @license          http://opensource.org/licenses/gpl-2.0.php GNU Public License
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

add_action('genesis_before','tpg_staff_loop_setup');
function tpg_staff_loop_setup() {
    
    // Customize Before Loop
    //remove_action('genesis_before_loop','genesis_do_before_loop' );
    //add_action('genesis_before_loop','tpg_page_before_loop');
    
    // Customize Loop
    remove_action('genesis_loop', 'genesis_do_loop');
    add_action('genesis_loop', 'tpg_staff_page_loop');
    
    // Remove Post Info
    remove_action('genesis_before_post_content', 'genesis_post_info');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_post_title', 'genesis_do_post_title');
    remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
    remove_action('genesis_post_content', 'genesis_do_post_image');
    
    // Remove Post Meta
    remove_action('genesis_after_post_content', 'genesis_post_meta');
}

function tpg_staff_page_loop() {
    $consulting_professionals_args = array(
        'post_type' => 'staff',
        'meta_key' => 'tpg_order_text',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'role',
                'field' => 'slug',
                'terms' => array('consulting-professionals'),
            ),
        )
    );
    
    query_posts( $consulting_professionals_args );
    echo '<h2 class="role-consulting">Consulting Professionals</h2>';
    while (have_posts()) : the_post();
        tpg_consulting_page_loop_content();
    endwhile;
    
    $service_professionals_args = array(
        'post_type' => 'staff',
        'meta_key' => 'tpg_last_name_text',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'role',
                'field' => 'slug',
                'terms' => array('service-professionals'),
            ),
        )
    );
    
    query_posts( $service_professionals_args );
    echo '<h2 class="role-service">Service Professionals</h2>';
    while (have_posts()) : the_post();
        tpg_nonconsulting_page_loop_content();
    endwhile;
    
    $administrative_staff_args = array(
        'post_type' => 'staff',
        'meta_key' => 'tpg_last_name_text',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'role',
                'field' => 'slug',
                'terms' => array('administrative-staff'),
            ),
        )
    );
    
    query_posts( $administrative_staff_args );
    echo '<h2 class="role-admin">Administrative Staff</h2>';
        while (have_posts()) : the_post();
            tpg_nonconsulting_page_loop_content();
        endwhile;
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function tpg_consulting_page_loop_content() {
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
            if( genesis_get_custom_field('tpg_title_text') != '') { 
                printf( '<span class="title">%s</span>', genesis_get_custom_field('tpg_title_text') );
            }
        echo '</div><!--#end contact-->';
        if ( genesis_get_custom_field('tpg_cert_text') != '' ) {
            if( genesis_get_custom_field('tpg_phone_number_text') != '') {
                if( genesis_get_custom_field('tpg_email_address_text') != '') {
                    printf( '<div class="info"><h2 class="name"><a href="%s" title="%s">%s</a>, <span class="cert">%s</span></h2><span class="phone">%s</span><span class="email"><a href="mailto:%s">%s</a></span></div>', get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('tpg_cert_text'), genesis_get_custom_field('tpg_phone_number_text'), antispambot(genesis_get_custom_field('tpg_email_address_text')), antispambot(genesis_get_custom_field('tpg_email_address_text')) );
                } else {
                    printf( '<div class="info"><h2 class="name"><a href="%s" title="%s">%s</a>, <span class="cert">%s</span></h2><span class="phone">%s</span></div>', get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('tpg_cert_text'), genesis_get_custom_field('tpg_phone_number_text') );
                }
            } else {
                    printf( '<div class="info"><h2 class="name"><a href="%s" title="%s">%s</a>, <span class="cert">%s</span></h2></div>', get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('tpg_cert_text') );
            }
        } else {
            if( genesis_get_custom_field('tpg_phone_number_text') != '') {
                if( genesis_get_custom_field('tpg_email_address_text') != '') {
                    printf( '<div class="info"><h2 class="name"><a href="%s" title="%s">%s</a></h2><span class="phone">%s</span><span class="email"><a href="mailto:%s">%s</a></span></div>', get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('tpg_phone_number_text'), antispambot(genesis_get_custom_field('tpg_email_address_text')), antispambot(genesis_get_custom_field('tpg_email_address_text')) );
                } else {
                    printf( '<div class="info"><h2 class="name"><a href="%s" title="%s">%s</a></h2><span class="phone">%s</span></div>', get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('tpg_phone_number_text') );
                }
            }
        }
    echo '</div><!--end #person -->';
}

function tpg_nonconsulting_page_loop_content() {
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
            if( genesis_get_custom_field('tpg_title_text') != '') { 
                printf( '<span class="title">%s</span>', genesis_get_custom_field('tpg_title_text') );
            }
        echo '</div><!--#end contact-->';
        if ( genesis_get_custom_field('tpg_cert_text') != '' ) {
            if( genesis_get_custom_field('tpg_phone_number_text') != '') {
                if( genesis_get_custom_field('tpg_email_address_text') != '') {
                    printf( '<div class="info"><h2 class="name">%s, <span class="cert">%s</span></h2><span class="phone">%s</span><span class="email"><a href="mailto:%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('tpg_cert_text'), genesis_get_custom_field('tpg_phone_number_text'), antispambot(genesis_get_custom_field('tpg_email_address_text')), antispambot(genesis_get_custom_field('tpg_email_address_text')) );
                } else {
                    printf( '<div class="info"><h2 class="name">%s, <span class="cert">%s</span></h2><span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('tpg_cert_text'), genesis_get_custom_field('tpg_phone_number_text') );
                }
            } else {
                    printf( '<div class="info"><h2 class="name">%s, <span class="cert">%s</span></h2></div>', get_the_title(), genesis_get_custom_field('tpg_cert_text') );
            }
        } else {
            if( genesis_get_custom_field('tpg_phone_number_text') != '') {
                if( genesis_get_custom_field('tpg_email_address_text') != '') {
                    printf( '<div class="info"><h2 class="name">%s</h2><span class="phone">%s</span><span class="email"><a href="mailto:%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('tpg_phone_number_text'), antispambot(genesis_get_custom_field('tpg_email_address_text')), antispambot(genesis_get_custom_field('tpg_email_address_text')) );
                } else {
                    printf( '<div class="info"><h2 class="name">%s</h2><span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('tpg_phone_number_text') );
                }
            }
        }
    echo '</div><!--end #person -->';
}

function tpg_page_after_loop(){
}

genesis();