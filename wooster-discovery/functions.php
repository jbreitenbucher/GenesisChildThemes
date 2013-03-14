<?php
// Start the engine
require_once( get_template_directory() . '/lib/init.php');
require_once( get_stylesheet_directory() . '/lib/init.php' );

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Expose Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/expose');

// Add support for theme options
add_action( 'admin_init', 'jb_reset' );
add_action( 'admin_init', 'jb_register_settings' );
add_action( 'admin_menu', 'jb_add_menu', 100);
add_action( 'admin_notices', 'jb_notices' );
add_action( 'genesis_settings_sanitizer_init', 'jb_sanitization_filters' );

// Add new image sizes 
add_image_size('grid-thumbnail', 280, 150, TRUE);

// Unregister 3-column site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'expose_home_layout');
function expose_home_layout($opt) {
	if ( is_home() )
    $opt = 'full-width-content';
	return $opt;
}

// Remove the Secondary Navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

// Remove post info and post meta sections on home page
add_action('get_header', 'remove_post_info');
function remove_post_info() {
    if ( is_front_page() )
	remove_action('genesis_before_post_content', 'genesis_post_info');
}
add_action('get_header', 'remove_post_meta');
function remove_post_meta() {
    if ( is_front_page() )
	remove_action('genesis_after_post_content', 'genesis_post_meta');
}

// Unregister Genesis widget area
add_action( 'widgets_init', 'remove_widget_area' );

/**
 * Remove Widgets
 *
 * @author Jon Breitenbucher
 */

function remove_widget_area() {
	unregister_sidebar( 'header-right' );
	unregister_sidebar( 'sidebar-alt' );
}

// Customize the footer section
add_filter('genesis_footer_creds_text', 'expose_footer_creds_text');
function expose_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] <a href="http://wooster.edu">The College of Wooster</a> &middot; [footer_loginout]';
	return $creds;
}

// Custom text to display when no comments exist on a post
add_filter('genesis_no_comments_text', 'expose_no_comments_text');
function expose_no_comments_text() {
	return '<h3>Comments</h3><div class="no-comments">There are currently no comments on this post, be the first by filling out the form below.</div>';
}

/**
 * Customize the posts_nav
 *
 * @author Jon Breitenbucher
 *
 */

function expose_after_endwhile() {
	echo '<div class="navigation">';
		echo '<div class="alignleft">';
			previous_posts_link('&larr; Previous');
		echo '</div>';
		echo '<div class="alignright">';
			next_posts_link('More &rarr;');
		echo '</div>';
	echo '</div>';
}
// Customize After Endwhile
	remove_action('genesis_after_endwhile','genesis_do_after_endwhile');
	remove_action('genesis_after_endwhile', 'genesis_posts_nav');
	add_action('genesis_after_endwhile', 'expose_after_endwhile');

/**
 * Header
 *
 * @author Jon Breitenbucher
 */

function discover_header() {
	echo '<div id="title-area">';
		echo '<a href="http://wooster.edu"><img src="'. get_stylesheet_directory_uri() .'/images/wordmark-white-on-tr-black.gif" alt="Wooster" /></a>';
		echo '<div id="title-wrap">';
			do_action( 'genesis_site_title' );
			do_action( 'genesis_site_description' );
		echo '</div>';
	echo '</div><!-- end #title-area -->';
}
// Customize Header
	remove_action( 'genesis_header', 'genesis_do_header' );
	add_action( 'genesis_header', 'discover_header' );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'featured',
	'name'			=> __( 'Featured' ),
	'description'	=> __( 'This is a featured area under the header.' ),
) );

add_action('genesis_before', 'home_feature');

function home_feature() {
	$paged = get_query_var('paged');
	if ( $paged < 2 ) {
		add_action('genesis_before_content','expose_feature');
	}
}

function expose_feature() {
	if ( is_active_sidebar( 'featured' ) ) {

		echo '<div class="featured clearfix">';

			dynamic_sidebar( 'featured' );

		echo '</div><!-- end .featured -->';

	}
}

/**
 * Archive Post Class
 * @since 1.0.0
 *
 * Breaks the posts into three columns
 * @link http://www.billerickson.net/code/grid-loop-using-post-class
 *
 * @param array $classes
 * @return array
 */
function be_archive_post_class( $classes ) {
 
	// Don't run on single posts or pages
	if( is_singular() )
		return $classes;
 
	$classes[] = 'one-third';
	global $wp_query;
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 3 )
		$classes[] = 'first';
	return $classes;
}
add_filter( 'post_class', 'be_archive_post_class' );

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
		'features_on_front' => 3,
		'teasers_on_front' => 0,
		'features_inside' => 0,
		'teasers_inside' => 6,
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

		// All Grid Loops
		$query->set( 'category_name',  genesis_get_option( 'jb_featured_cat_slug', JB_SETTINGS_FIELD ) );

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
	add_image_size( 'be_grid', 280, 150, true );
	add_image_size( 'be_feature', 280, 150, true );
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

/**
 * Grid Content
 * Change the number of words in excerpt if in the grid loop
 */
function be_grid_content() {
 
  // First, we make sure we're in the grid loop.
	if( ! be_grid_loop_pagination() )
		return;
 
	// Change length if teaser
	if( in_array( 'teaser', get_post_class() ) )
		$length = genesis_get_option( 'jb_post_content_limit', JB_SETTINGS_FIELD );
	else
		$length = genesis_get_option( 'jb_featured_content_limit', JB_SETTINGS_FIELD );
 
	echo '<p>' . wp_trim_words( get_the_excerpt(), $length ) . '</p>';
}
add_action( 'genesis_post_content', 'be_grid_content' );
remove_action( 'genesis_post_content', 'genesis_do_post_content' );