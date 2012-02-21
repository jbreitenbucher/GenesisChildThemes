<?php

add_action( 'genesis_meta', 'faculty_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function faculty_home_genesis_meta() {

	if ( is_active_sidebar( 'home-top-full-width' ) || is_active_sidebar( 'home-top-left' ) || is_active_sidebar( 'home-top-right' ) || is_active_sidebar( 'home-middle-left' ) || is_active_sidebar( 'home-middle-center' ) || is_active_sidebar( 'home-middle-right' ) || is_active_sidebar( 'home-bottom-left' ) || is_active_sidebar( 'home-bottom-right' ) ) {
	
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'faculty_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

/**
 * Display widget content for homepage sections.
 *
 */
function faculty_home_loop_helper() {

		if ( is_active_sidebar( 'home-top-full-width' ) ) {
		
		echo '<div class="widget-row clearfix">';
		
				echo '<div class="home-top-full-width">';
				dynamic_sidebar( 'home-top-full-width' );
				echo '</div><!-- end .home-top-full-width -->';
				
		echo '</div><!-- end .widget-row -->';
		
		}
		
		if ( is_active_sidebar( 'home-top-left' ) || is_active_sidebar( 'home-top-right' ) ) {
			
			echo '<div class="widget-row clearfix">';
			
				echo '<div class="home-top-left">';
				dynamic_sidebar( 'home-top-left' );
				echo '</div><!-- end .home-top-left -->';
			
				echo '<div class="home-top-right">';
				dynamic_sidebar( 'home-top-right' );
				echo '</div><!-- end .home-top-right -->';
				
			echo '</div><!-- end .widget-row -->';
			
		}
		
		if ( is_active_sidebar( 'home-middle-left' ) || is_active_sidebar( 'home-middle-center' ) || is_active_sidebar( 'home-middle-right' ) ) {
			
		echo '<div class="widget-row clearfix">';
			
			echo '<div class="home-middle-left">';
			dynamic_sidebar( 'home-middle-left' );
			echo '</div><!-- end .home-middle-left -->';
		
			echo '<div class="home-middle-center">';
			dynamic_sidebar( 'home-middle-center' );
			echo '</div><!-- end .home-middle-center -->';
		
			echo '<div class="home-middle-right">';
			dynamic_sidebar( 'home-middle-right' );
			echo '</div><!-- end .home-middle-right -->';
			
		echo '</div><!-- end .widget-row -->';
			
		}
		
		if ( is_active_sidebar( 'home-bottom-left' ) || is_active_sidebar( 'home-bottom-right' ) ) {
		
		echo '<div class="widget-row clearfix">';
		
			echo '<div class="home-bottom-left">';
			dynamic_sidebar( 'home-bottom-left' );
			echo '</div><!-- end .home-bottom-left -->';

			echo '<div class="home-bottom-right">';
			dynamic_sidebar( 'home-bottom-right' );
			echo '</div><!-- end .home-bottom-right -->';
			
		echo '</div><!-- end .widget-row -->';
		
		}
		
}

genesis();