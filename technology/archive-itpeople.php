<?php
/**
 * Template Name: People Archive
 *
 * This template will be used to list the itpeople post type archive.
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

add_action('genesis_before','it_archive_loop_setup');
function it_archive_loop_setup() {
    
    // Customize Before Loop
    remove_action('genesis_before_loop','genesis_do_before_loop' );
    add_action('genesis_before_loop','it_archive_before_loop');
    
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
    add_action('genesis_entry_content','it_archive_entry_content');
    
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

function it_archive_before_loop() {
    $c = 0; // set up a counter so we know which post we're currently showing
    $image_align = 'alignright'; // set up a variable to hold an extra CSS class
}

/**
 * Customize Post Content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_archive_entry_content () {
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

genesis();