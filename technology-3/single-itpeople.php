<?php
/**
 *
 * Single Staff
 *
 * This template is called to display the page for a single staff member. 
 *
 * @package      technology
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright    Copyright (c) 2012, The College of Wooster
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
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

add_action('genesis_before','it_single_loop_setup');
function it_single_loop_setup() {
    
    // Remove Before Loop
    remove_action('genesis_before_loop','genesis_do_before_loop' );
    
    // Remove Post Info
    remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
    remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
    remove_action('genesis_entry_header', 'genesis_post_info', 12);
    remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
    
    // Customize Post Content
    remove_action('genesis_entry_content','genesis_do_post_content');
    add_action('genesis_entry_content','it_person_post_content');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_entry_header', 'genesis_do_post_title');
    remove_action('genesis_entry_header', 'genesis_do_after_post_title');
    remove_action('genesis_entry_content', 'genesis_do_post_image');
    add_action('genesis_entry_header', 'it_person_header');
    
    // Remove Post Meta
    remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
    remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
    remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
    add_action('genesis_entry_footer', 'it_person_footer');
    
    // Customize After Endwhile
    remove_action('genesis_after_endwhile','genesis_do_after_endwhile');
    remove_action('genesis_after_endwhile', 'genesis_posts_nav');
    add_action('genesis_after_endwhile', 'it_person_after_endwhile');
}

/**
 * Customize Post Content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_person_header() {
    genesis_entry_header_markup_open();
    if (genesis_get_custom_field('it_title_text') != '') {
        printf( '<h1 class="name entry-title" itemprop="headline">%s, <span class="title">%s</span></h1>', get_the_title(), genesis_get_custom_field('it_title_text') );
    } else {
        printf('<h1 class="name entry-title" itemprop="headline">%s</h1>', get_the_title() );
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
    genesis_post_info();
    genesis_entry_header_markup_close();
}

function it_person_post_content() {
    echo '<div class="about entry-content" itemprop="text">';
        if ( has_post_thumbnail() ) {
            the_post_thumbnail('profile-picture-single',array('class' => 'picture alignleft profile-image'));
        }
        echo genesis_get_custom_field('it_about_me_wysiwyg');
    echo '</div><!--end #about entry-content -->';
}

function it_person_footer() {
    echo '</article><!--end #person -->';
}

/**
 * Customize After Endwhile
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_person_after_endwhile() {
    echo '<div class="navigation">';
        echo '<div class="alignleft">';
            previous_posts_link('&larr; Previous');
        echo '</div>';
        echo '<div class="alignright">';
            next_posts_link('More &rarr;');
        echo '</div>';
    echo '</div>';
}

function it_person_entry_class( $attributes ) {
  
  $attributes['class'] = $attributes['class'].' person';
    return $attributes;

}
add_filter( 'genesis_attr_entry', 'it_person_entry_class' );

genesis();