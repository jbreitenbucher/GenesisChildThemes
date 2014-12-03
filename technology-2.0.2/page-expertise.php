<?php
/**
 * Template Name: Expertise Listing
 *
 * This template should be used for the Areas of Expertise listing page.
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

add_action('genesis_before','it_areas_of_expertise_loop_setup');
function it_areas_of_expertise_loop_setup() {
	
	if ( ! genesis_html5() ) {
		// Customize Before Loop
		remove_action('genesis_before_loop','genesis_do_before_loop' );
		add_action('genesis_before_loop','it_areas_of_expertise_before_loop');
	
		// Customize Loop
		//remove_action('genesis_loop', 'genesis_do_loop');
		//add_action('genesis_loop', 'gsl_areas_of_expertise_loop');
	
		// Remove Post Info
		remove_action('genesis_before_post_content', 'genesis_post_info');
	
		// Customize Post Content
		remove_action('genesis_post_content','genesis_do_post_content');
		add_action('genesis_post_content','it_areas_of_expertise_post_content');
	
		// Remove Title, After Title, and Post Image
		remove_action('genesis_post_title', 'genesis_do_post_title');
		remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
		remove_action('genesis_post_content', 'genesis_do_post_image');
	
		// Remove Post Meta
		remove_action('genesis_after_post_content', 'genesis_post_meta');
	} else {
	    	// Customize Before Loop
	   	 remove_action('genesis_before_loop','genesis_do_before_loop' );
	  	  add_action('genesis_before_loop','it_areas_of_expertise_before_loop');
    
	    	// Remove Post Info
	    	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
    
	    	// Customize Post Content
	  	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
	  	add_action( 'genesis_entry_content', 'it_areas_of_expertise_post_content' );
    
	   	 // Remove Title, After Title, and Post Image
   		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
   		remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
   	    	remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
    
	  	  // Remove Post Meta
	   	 remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	}
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
	echo '<h1>' . get_the_title() . '</h1>';
	global $post;
	echo '<div class="page-content">' . apply_filters('the_content', $post->post_content) . '</div>';
}

/**
 * Customize Post Content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_areas_of_expertise_post_content () {
	$taxonomy     = 'expertise';
	$orderby      = 'name'; 
	$show_count   = 0; // 1 for yes, 0 for no
	$pad_counts   = 0; // 1 for yes, 0 for no
	$hierarchical = 0; // 1 for yes, 0 for no
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