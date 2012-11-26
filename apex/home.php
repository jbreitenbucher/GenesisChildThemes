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

add_action( 'genesis_meta', 'apex_home_genesis_meta' );
function apex_home_genesis_meta() {

	
		// Customize the loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'apex_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

}

/**
 * Customize the homepage content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version 	SVN: $Id$
 * @since 	1.0
 *
 */

function apex_home_loop_helper() {

		if ( !is_user_logged_in() ) {

			wp_login_form( );
		
	}

}


genesis();