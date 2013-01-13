<?php
/**
 * Home - Used for the homepage
 *
 * @package     landscape
 * @author      Jon Breitenbucher <jon@breitenbucher.net>
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */

add_action( 'genesis_meta', 'landscape_home_genesis_meta' );
function landscape_home_genesis_meta() {
        // Customize the loop
        remove_action( 'genesis_loop', 'genesis_do_loop' );
        add_action( 'genesis_loop', 'landscape_home_loop_helper' );
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
}

/**
 * Customize Post Content
 *
 * @author Jon Breitenbucher
 */

function landscape_home_loop_helper() {
	echo '<div id="homepage">';
		if( function_exists('wp_cycle') ) {
			wp_cycle();
		} else {
			if ( is_active_sidebar( 'homepage-image' ) ) {
				dynamic_sidebar( 'homepage-image' );
			}
		}
	echo '</div>';
}

genesis();