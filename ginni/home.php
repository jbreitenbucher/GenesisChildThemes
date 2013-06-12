<?php

add_action( 'genesis_meta', 'jb_home_genesis_meta' );

/**
 * Home Post Class
 * @since 1.0.0
 *
 * Breaks the posts into three columns
 * @link http://www.billerickson.net/code/grid-loop-using-post-class
 *
 * @param array $classes
 * @return array
 */
function be_home_post_class( $classes ) {
	$classes[] = 'one-half';
	global $wp_query;
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 2 )
		$classes[] = 'first';
	return $classes;
}
add_filter( 'post_class', 'be_home_post_class' );

function eight_posts_on_homepage( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'posts_per_page', '8' );
    }
}
add_action( 'pre_get_posts', 'eight_posts_on_homepage' );

genesis();