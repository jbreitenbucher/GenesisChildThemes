<?php

add_action( 'genesis_meta', 'wooster_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function wooster_home_genesis_meta() {

	if ( is_active_sidebar( 'featured-top' ) || is_active_sidebar( 'featured-top-left' ) || is_active_sidebar( 'featured-top-right' ) || is_active_sidebar( 'featured-middle-left' ) || is_active_sidebar( 'featured-middle-center' ) || is_active_sidebar( 'featured-middle-right' ) || is_active_sidebar( 'featured-bottom-left' ) || is_active_sidebar( 'featured-bottom-right' ) ) {
	
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'wooster_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

/**
 * Display widget content for homepage sections.
 *
 */
function wooster_home_loop_helper() {

		if ( is_active_sidebar( 'featured-top' ) ) {
		
		echo '<div class="featured">';
		
				echo '<div class="featured-top">';
				dynamic_sidebar( 'featured-top' );
				echo '</div><!-- end .featured-top -->';
				
		echo '</div><!-- end .featured -->';
		
		}
		
		if ( is_active_sidebar( 'featured-top-left' ) || is_active_sidebar( 'featured-top-right' ) ) {
			
			echo '<div class="featured">';
			
				echo '<div class="featured-top-left">';
				dynamic_sidebar( 'featured-top-left' );
				echo '</div><!-- end .featured-top-left -->';
			
				echo '<div class="featured-top-right">';
				dynamic_sidebar( 'featured-top-right' );
				echo '</div><!-- end .featured-top-right -->';
				
			echo '</div><!-- end .featured -->';
			
		}
		
		if ( is_active_sidebar( 'featured-middle-left' ) || is_active_sidebar( 'featured-middle-center' ) || is_active_sidebar( 'featured-middle-right' ) ) {
			
		echo '<div class="featured">';
			
			echo '<div class="featured-middle">';
			
				echo '<div class="featured-middle-left">';
				dynamic_sidebar( 'featured-middle-left' );
				echo '</div><!-- end .featured-middle-left -->';
			
				echo '<div class="featured-middle-center">';
				dynamic_sidebar( 'featured-middle-center' );
				echo '</div><!-- end .featured-middle-center -->';
			
				echo '<div class="featured-middle-right">';
				dynamic_sidebar( 'featured-middle-right' );
				echo '</div><!-- end .featured-middle-right -->';
			
			echo '</div><!-- end .featured-middle -->';
			
		echo '</div><!-- end .featured -->';
			
		}
		
		if ( is_active_sidebar( 'featured-bottom-left' ) || is_active_sidebar( 'featured-bottom-right' ) ) {
		
		echo '<div class="featured">';
		
			echo '<div class="featured-bottom">';
		
				echo '<div class="featured-bottom-left">';
				dynamic_sidebar( 'featured-bottom-left' );
				echo '</div><!-- end .featured-bottom-left -->';

				echo '<div class="featured-bottom-right">';
				dynamic_sidebar( 'featured-bottom-right' );
				echo '</div><!-- end .featured-bottom-right -->';

			echo '</div><!-- end .featured-bottom -->';
			
		echo '</div><!-- end .featured -->';
		
		}
		
		if ( is_active_sidebar( 'featured-bottom' ) ) {
		
		echo '<div class="featured">';
		
				echo '<div class="featured-last">';
				dynamic_sidebar( 'featured-bottom' );
				echo '</div><!-- end .featured-last -->';
				
		echo '</div><!-- end .featured -->';
		
		}
		
}

genesis();