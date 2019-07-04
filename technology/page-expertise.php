<?php
/**
 * Template Name: Expertise
 *
 * This template should be used for the Areas of Expertise listing page.
 *
 * @package technology
 * @author  Jon Breitenbucher
 * @license GPL-2.0-or-later
 * @link    https://github.com/jbreitenbucher/GenesisChildThemes/technology
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

add_action('genesis_before','it_areas_of_expertise_loop_setup');
function it_areas_of_expertise_loop_setup() {
    
    // Customize Before Loop
    remove_action('genesis_before_loop','genesis_do_before_loop' );
    add_action('genesis_before_loop','it_areas_of_expertise_before_loop');
    
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
    add_action('genesis_entry_content','it_areas_of_expertise_entry_content');
    
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

function it_areas_of_expertise_before_loop() {
    the_content();
}

/**
 * Customize Post Content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_areas_of_expertise_entry_content () {
    $taxonomy     = 'expertise';
    $orderby      = 'name'; 
    $show_count   = 0;      // 1 for yes, 0 for no
    $pad_counts   = 0;      // 1 for yes, 0 for no
    $hierarchical = 0;      // 1 for yes, 0 for no
    $title        = '';

    $args = array(
      'taxonomy'     => $taxonomy,
      'orderby'      => $orderby,
      'show_count'   => $show_count,
      'pad_counts'   => $pad_counts,
      'hierarchical' => $hierarchical,
      'title_li'     => $title
    );
    
    echo '<ul class="styles">';
    echo wp_list_categories( $args );
    echo '</ul>';
}

genesis();