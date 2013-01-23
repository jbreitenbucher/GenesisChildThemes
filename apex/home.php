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
 * Add login form to the homepage if user is not logged in otherwise just display example portfolios.
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
 * @author  Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version SVN: $Id$
 * @since   1.0
 *
 */

function apex_home_loop_helper() {

	if ( !is_user_logged_in() ) {
		wp_login_form( );	
	}
	echo '<div id="examples" class="gallery">';
		echo '<figure id="first-example">';
			echo '<a href="http://apex.wooster.edu/first-example"><img src="' . get_stylesheet_directory_uri() . '/images/apartika14.png" alt="First example portfolio by Anne Partika."/></a>';
			echo "<figcaption>Anne Partika's Portfolio</figcaption>";
		echo '</figure>';
		echo '<figure id="second-example">';
			echo '<a href="http://apex.wooster.edu/second-example"><img src="' . get_stylesheet_directory_uri() . '/images/mndiaye14.png" alt="First example portfolio by Mamoudou N\'Diaye."/></a>';
			echo "<figcaption>Mamoudou N'Diaye's Portfolio</figcaption>";
		echo '</figure>';
		echo '<figure id="third-example">';
			echo '<a href="http://apex.wooster.edu/third-example"><img src="' . get_stylesheet_directory_uri() . '/images/kcarpenter.png" alt="First example portfolio by Kevin Carpenter."/></a>';
			echo "<figcaption>Kevin Carpenter's Portfolio</figcaption>";
		echo '</figure>';
	echo '</div>';

}


genesis();