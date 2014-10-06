<?php
/**
 * Home - Used for the homepage
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
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */

add_action( 'genesis_meta', 'it_home_genesis_meta' );
function it_home_genesis_meta() {

	// If any homepage widget area contains widgets use a custom loop
	if ( is_active_sidebar( 'featured' ) || is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) || is_active_sidebar( 'home-bottom-1' ) || is_active_sidebar( 'home-bottom-2' ) ) {
		
		// Customize the loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'it_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

/**
 * Customize the homepage content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_home_loop_helper() {

	if ( is_active_sidebar( 'featured' ) ) {
		echo '<div class="featured">';
		dynamic_sidebar( 'featured' );
		echo '</div><!-- end .featured -->';
	}
	
	echo '<div class="home-middle">';
	
	if ( is_active_sidebar( 'home-middle-1' ) ) {
		echo '<div class="home-middle-1 first one-third">';
		dynamic_sidebar( 'home-middle-1' );
		echo '</div><!-- end .home-middle-1 -->';
	}
	
	if ( is_active_sidebar( 'home-middle-2' ) ) {
		echo '<div class="home-middle-2 one-third">';
		dynamic_sidebar( 'home-middle-2' );
		echo '</div><!-- end .home-middle-2 -->';
	}
	
	if ( is_active_sidebar( 'home-middle-3' ) ) {
		echo '<div class="home-middle-3 one-third">';
		dynamic_sidebar( 'home-middle-3' );
		echo '</div><!-- end .home-middle-3 -->';
	}
	
	echo '</div><!-- end .home-middle -->';
	
	echo '<div class="home-bottom">';
	
	if ( is_active_sidebar( 'home-bottom-1' ) ) {
		echo '<div class="home-bottom-1 first one-half">';
		dynamic_sidebar( 'home-bottom-1' );
		echo '</div><!-- end .home-bottom-1 -->';
	}
	
	if ( is_active_sidebar( 'home-bottom-2' ) ) {
		echo '<div class="home-bottom-2 one-half">';
		dynamic_sidebar( 'home-bottom-2' );
		echo '</div><!-- end .home-bottom-2 -->';
	}
	
	echo '</div><!-- end .home-bottom -->';
	
}

genesis();