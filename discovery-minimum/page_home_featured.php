<?php
/*
Template Name: Featured
*/

add_action( 'genesis_meta', 'dm_home3_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function dm_home3_genesis_meta() {

	if ( is_active_sidebar( 'featured' ) ) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'dm_home3_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

/**
 * Display widget content for "featured" section.
 *
 */
function dm_home3_loop_helper() {

		if ( is_active_sidebar( 'featured' ) ) {
			echo '<div class="featured">';
			dynamic_sidebar( 'featured' );
			echo '</div><!-- end .featured -->';
		}
		
}

genesis();