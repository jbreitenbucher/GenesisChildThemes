<?php
// Start the engine
require_once( get_template_directory() . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'sample_viewport_meta_tag' );
function sample_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for custom header
add_theme_support( 'genesis-custom-header', array(
	'width' => 1152,
	'height' => 120
) );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 5 );

/**
 * Grid Loop Pagination
 * Returns false if not grid loop.
 * Returns an array describing pagination if is grid loop
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/a-better-and-easier-grid-loop/
 *
 * @param object $query
 * @return bool is grid loop (true) or not (false)
 */
function be_grid_loop_pagination( $query = false ) {
 
	// If no query is specified, grab the main query
	global $wp_query;
	if( !isset( $query ) || empty( $query ) || !is_object( $query ) )
		$query = $wp_query;
		
	// Sections of site that should use grid loop	
	if( ! ( $query->is_home() || $query->is_archive() ) )
		return false;
		
	// Specify pagination
	return array(
		'features_on_front' => 5,
		'teasers_on_front' => 6,
		'features_inside' => 0,
		'teasers_inside' => 12,
	);
}
 
/**
 * Grid Loop Query Arguments
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/a-better-and-easier-grid-loop/
 *
 * @param object $query
 * @return null
 */
function be_grid_loop_query_args( $query ) {
	$grid_args = be_grid_loop_pagination( $query );
	if( $query->is_main_query() && !is_admin() && $grid_args ) {
 
		// First Page
		$page = $query->query_vars['paged'];
		if( ! $page ) {
			$query->set( 'posts_per_page', ( $grid_args['features_on_front'] + $grid_args['teasers_on_front'] ) );
			
		// Other Pages
		} else {
			$query->set( 'posts_per_page', ( $grid_args['features_inside'] + $grid_args['teasers_inside'] ) );
			$query->set( 'offset', ( $grid_args['features_on_front'] + $grid_args['teasers_on_front'] ) + ( $grid_args['features_inside'] + $grid_args['teasers_inside'] ) * ( $page - 2 ) );
			// Offset is posts on first page + posts on internal pages * ( current page - 2 )
		}
 
	}
}
add_action( 'pre_get_posts', 'be_grid_loop_query_args' );
 
/**
 * Grid Loop Post Classes
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/a-better-and-easier-grid-loop/
 *
 * @param array $classes
 * @return array $classes
 */
function be_grid_loop_post_classes( $classes ) {
	global $wp_query;
	$grid_args = be_grid_loop_pagination();
	if( ! $grid_args )
		return $classes;
		
	// First Page Classes
	if( ! $wp_query->query_vars['paged'] ) {
	
		// Features
		if( $wp_query->current_post < $grid_args['features_on_front'] ) {
			$classes[] = 'feature';
		
		// Teasers
		} else {
			$classes[] = 'one-third';
			if( 0 == ( $wp_query->current_post - $grid_args['features_on_front'] ) || 0 == ( $wp_query->current_post - $grid_args['features_on_front'] ) % 3 )
				$classes[] = 'first';
		}
		
	// Inner Pages
	} else {
 
		// Features
		if( $wp_query->current_post < $grid_args['features_inside'] ) {
			$classes[] = 'feature';
		
		// Teasers
		} else {
			$classes[] = 'one-third';
			if( 0 == ( $wp_query->current_post - $grid_args['features_inside'] ) || 0 == ( $wp_query->current_post - $grid_args['features_inside'] ) % 3 )
				$classes[] = 'first';
		}
	
	}
	
	return $classes;
}
add_filter( 'post_class', 'be_grid_loop_post_classes' );
 
/**
 * Grid Image Sizes 
 *
 */
function be_grid_image_sizes() {
	add_image_size( 'be_grid', 175, 120, true );
	add_image_size( 'be_feature', 570, 333, true );
}
add_action( 'genesis_setup', 'be_grid_image_sizes', 20 );
 
/**
 * Grid Loop Featured Image
 *
 * @param string image size
 * @return string
 */
function be_grid_loop_image( $image_size ) {
	global $wp_query;
	$grid_args = be_grid_loop_pagination();
	if( ! $grid_args )
		return $image_size;
		
	// Feature
	if( ( ! $wp_query->query_vars['paged'] && $wp_query->current_post < $grid_args['features_on_front'] ) || ( $wp_query->query_vars['paged'] && $wp_query->current_post < $grid_args['features_inside'] ) )
		$image_size = 'be_feature';
		
	if( ( ! $wp_query->query_vars['paged'] && $wp_query->current_post > ( $grid_args['features_on_front'] - 1 ) ) || ( $wp_query->query_vars['paged'] && $wp_query->current_post > ( $grid_args['features_inside'] - 1 ) ) )
		$image_size = 'be_grid';
		
	return $image_size;
}
add_filter( 'genesis_pre_get_option_image_size', 'be_grid_loop_image' );
 
/**
 * Fix Posts Nav
 *
 * The posts navigation uses the current posts-per-page to 
 * calculate how many pages there are. If your homepage
 * displays a different number than inner pages, there
 * will be more pages listed on the homepage. This fixes it.
 *
 */
function be_fix_posts_nav() {
	
	if( get_query_var( 'paged' ) )
		return;
		
	global $wp_query;
	$grid_args = be_grid_loop_pagination();
	if( ! $grid_args )
		return;
 
	$max = ceil ( ( $wp_query->found_posts - $grid_args['features_on_front'] - $grid_args['teasers_on_front'] ) / ( $grid_args['features_inside'] + $grid_args['teasers_inside'] ) ) + 1;
	$wp_query->max_num_pages = $max;
	
}
add_filter( 'genesis_after_endwhile', 'be_fix_posts_nav', 5 );