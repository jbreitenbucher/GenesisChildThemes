<?php

add_action( 'genesis_meta', 'eos_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function eos_home_genesis_meta() {

	if ( is_active_sidebar( 'home-left' ) || is_active_sidebar( 'home-right' ) || is_active_sidebar( 'slider' )  ) {
		
		add_action( 'genesis_after_header', 'jb_home_slider' );
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'eos_home_loop_helper' );

	}
}

function eos_home_loop_helper() {
	
	echo '<div class="home-content">';
	
	if ( is_active_sidebar( 'home-left' ) ) {
		echo '<div class="home-left">';
		dynamic_sidebar( 'home-left' );
		echo '</div><!-- end .home-left -->';
	}
	
	if ( is_active_sidebar( 'home-right' ) ) {
		echo '<div class="home-right">';
		dynamic_sidebar( 'home-right' );
		echo '</div><!-- end .home-right -->';
	}
	
	echo '</div><!-- end .home-content -->';
	
}

remove_action('genesis_after_endwhile', 'genesis_posts_nav');

genesis();