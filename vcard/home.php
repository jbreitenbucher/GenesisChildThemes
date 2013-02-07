<?php
/**
 * Home - Used for the homepage
 *
 * @package    apex
 * @author     Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright  Copyright (c) 2012, The College of Wooster
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version    SVN: $Id$
 * @since      1.0
 *
 */

/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */

add_action( 'genesis_meta', 'vcard_home_genesis_meta' );
function vcard_home_genesis_meta() {

		//Remove the header
		remove_action( 'genesis_header', 'genesis_do_header' );
		
		//Remove the footer
		remove_action( 'genesis_footer', 'genesis_do_footer' );
		
		//Remove the subnav
		remove_action( 'genesis_after_header', 'genesis_do_subnav' );
		
		// Customize the loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'vcard_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

}

/**
 * Customize the homepage content
 *
 * @author    Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version   SVN: $Id$
 * @since     1.0
 *
 */

function vcard_home_loop_helper() {

	echo '<div class="profile-image"><img src="' . get_the_author_meta('profile-image') . '" /></div>';
	echo '<div class="user-description"><p>' . get_the_author_meta('user_description') . '</p></div>';

}


genesis();