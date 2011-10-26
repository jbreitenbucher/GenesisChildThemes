<?php
/*
Template Name: Featured, Left Middle, Right Middle
*/

add_action( 'genesis_meta', 'dm_home2_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function dm_home2_genesis_meta() {

	if ( is_active_sidebar( 'featured' ) || is_active_sidebar( 'middle_left' ) || is_active_sidebar( 'middle_right' ) ) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'dm_home2_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

/**
 * Display widget content for "featured", "middle_left"  and "middle_right" sections.
 *
 */
function dm_home2_loop_helper() {

		if ( is_active_sidebar( 'featured' ) ) {
			echo '<div class="featured">';
			dynamic_sidebar( 'featured' );
			echo '</div><!-- end .featured -->';
		}

		if ( is_active_sidebar( 'middle_left' ) ) {
			echo '<div class="middle_left">';
			dynamic_sidebar( 'middle_left' );
			echo '</div><!-- end .middle_left -->';
		}
				
		if ( is_active_sidebar( 'middle_right' ) ) {
			echo '<div class="middle_right">';
			dynamic_sidebar( 'middle_right' );
			echo '</div><!-- end .middle_right -->';
		}
		
}

genesis();