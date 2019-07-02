<?php
/**
 * Template Name: Staff
 *
 * This template should be used for the Staff listing page.
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
 * Loop Setup
 *
 * This setup function attaches all of the loop-specific functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

add_action('genesis_before','it_staff_loop_setup');
function it_staff_loop_setup() {
    
    // Customize Before Loop
    remove_action('genesis_before_loop','genesis_do_before_loop' );
    add_action('genesis_before_loop','it_page_before_loop');
    
    // Customize Loop
    remove_action('genesis_loop', 'genesis_do_loop');
    add_action('genesis_loop', 'it_page_loop');
    
    // Remove Post Info
    //* Remove the entry header markup (requires HTML5 theme support)
    remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
    remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

    //* Remove the entry title (requires HTML5 theme support)
    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

    //* Remove the entry meta in the entry header (requires HTML5 theme support)
    remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

    //* Remove the post format image (requires HTML5 theme support)
    remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
    
    // Customize Post Content
    remove_action('genesis_entry_content','genesis_do_post_content');
    add_action('genesis_entry_content','it_page_entry_content');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_entry_header', 'genesis_do_post_title');
    remove_action('genesis_entry_header', 'genesis_do_after_post_title');
    remove_action('genesis_entry_content', 'genesis_do_post_image');
    
    // Remove Post Meta
    remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
    remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
    remove_action('genesis_entry_footer', 'genesis_post_meta');
}

/**
 * Customize Before Loop
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_page_before_loop() {
    echo '<h1>Information and Planning Staff</h1>';
    $c = 0; // set up a counter so we know which post we're currently showing
    $image_align = 'alignright'; // set up a variable to hold an extra CSS class
    the_content();
}

/**
 * Customize Loop
 *
 * Query the itpeople post type using the role taxonomy for terms set in the
 * theme options for the professional staff roles.
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_page_loop() {
    global $paged;
        $args = array(
            'post_type' => 'itpeople',
            'paged' => $paged,
            'meta_key' => 'it_last_name_text',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'posts_per_page' => get_option('technology_staff_posts_per_page', 4 ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'role',
                    'field' => 'slug',
                    'terms' => preg_split("/[,]+/", get_option('technology_staff_professional_roles', '' ) ),
                ),
            )
        );

        genesis_custom_loop( $args );
}

/**
 * Customize Post Content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_page_entry_content () {
    global $post, $c;
    $c++; // increment the counter
    if( $c % 2 != 0) {
        // we're on an odd post
        $image_align = 'alignleft';
    } else {
        $image_align = 'alignright';
    }
    $expertise = get_the_term_list($post->ID, 'expertise', '', ', ', '');
    genesis_entry_header_markup_open();
    if (genesis_get_custom_field('it_title_text') != '') {
            printf( '<h2 class="name"><a href="%s" title="%s">%s</a>, <span class="title">%s</span></h2>', get_permalink(), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('it_title_text') );
        } else {
            printf( '<h2 class="name"><a href="%s" title="%s">%s</a></h2>', get_permalink(), the_title_attribute('echo=0'), get_the_title() );
        }
    echo '<p class="contact clear">';
        if( genesis_get_custom_field('it_phone_number_text') != '' && genesis_get_custom_field('it_email_address_text') == '') {                     
            printf( '<span class="phone">phone: %s</span>', genesis_get_custom_field('it_phone_number_text') );
        }
        if( genesis_get_custom_field('it_email_address_text') != '' && genesis_get_custom_field('it_phone_number_text') == '') {                    
            printf('<span class="email">e-mail: <a href="mailto:%s">%s</a></span>', antispambot(genesis_get_custom_field('it_email_address_text')), antispambot(genesis_get_custom_field('it_email_address_text')) );
        }
        if( genesis_get_custom_field('it_email_address_text') != '' && genesis_get_custom_field('it_phone_number_text') != '') {                    
            printf('<span class="phone">phone: %s</span> | <span class="email">e-mail: <a href="mailto:%s">%s</a></span>', genesis_get_custom_field('it_phone_number_text'), antispambot(genesis_get_custom_field('it_email_address_text')), antispambot(genesis_get_custom_field('it_email_address_text')) );
        }
    echo '</p><!--#end contact-->';
                
    if($expertise != ''){
        echo '<p class="expertise">';
            echo '<h3>Can help with</h3>';
            echo $expertise;
        echo '</p><!--#end expertise-->';
    }
    genesis_post_info();
    genesis_entry_header_markup_close();
    echo '<div class="about" itemprop="text">';
        $default_attr = array(
            'class' => "profile-image",
            'alt'   => $post->post_title,
            'title' => $post->post_title
            );
        if ( has_post_thumbnail() ) {
            echo '<p class="picture ' . $image_align . '">' . genesis_get_image( array( 'size' => 'profile-picture-listing', 'attr' => $default_attr ) ) . '</p>';
        }
        the_excerpt();
    echo '</div><!--end #about -->';
}

function it_person_entry_class( $attributes ) {
  
  $attributes['class'] = $attributes['class'].' person';
    return $attributes;

}
add_filter( 'genesis_attr_entry', 'it_person_entry_class' );

genesis();