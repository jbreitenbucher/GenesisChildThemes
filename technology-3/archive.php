<?php
/**
 * Template Name: Archive
 *
 * This template will be used to list the itpeople post type archive.
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

add_action('genesis_before','it_all_archive_loop_setup');
function it_all_archive_loop_setup() {
    
    // Customize Before Loop
    remove_action('genesis_before_loop','genesis_do_before_loop' );
    
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
    add_action('genesis_entry_content','it_all_archive_entry_content');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_entry_header', 'genesis_do_post_title');
    remove_action('genesis_entry_header', 'genesis_do_after_post_title');
    remove_action('genesis_entry_content', 'genesis_do_post_image');
}


/**
 * Customize Post Content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_all_archive_entry_content () {
    echo '<article class="post-summary">';
    	echo '<a class="entry-image-link" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . get_the_post_thumbnail( get_the_ID(), 'thumbnail' ) . '</a>';
    	echo '<header class="entry-header">';
        	echo '<h2 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
    	echo '</header>';
    	echo '<div class="entry-content">';
        	the_excerpt();
        	echo '<p><a class="read-more" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">Read More<span class="screen-reader-text"> of ' . get_the_title() . '</span></a></p>';
    	echo '</div>';
	echo '</article>';
}

genesis();