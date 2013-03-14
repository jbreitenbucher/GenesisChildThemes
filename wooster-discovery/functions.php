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

/**
 * Possibly amend the loop.
 * 
 * Specify the conditions under which the grid loop should be used.
 *
 * @author Bill Erickson
 * @author Gary Jones
 * @link   http://code.garyjones.co.uk/genesis-grid-loop-advanced/
 *
 * @return boolean Return true of doing the grid loop, false if not. 
 */
function child_is_doing_grid_loop() {

	// Amend this conditional to pick where this grid looping occurs.
	// This says to use the grid loop everywhere except single posts,
	// single pages and single attachments.
	return ( ! is_singular() );

}

/**
 * Grid Loop Arguments
 * 
 * Specify all the desired grid loop and query arguments
 *
 * @author Bill Erickson
 * @author Gary Jones
 * @link   http://code.garyjones.co.uk/genesis-grid-loop-advanced/
 *
 * @return array $arguments
 */
function child_grid_loop_arguments() {

	$grid_args = array(
		'features'              => 3,
		'feature_content_limit' => genesis_get_option( 'jb_featured_content_limit', JB_SETTINGS_FIELD ),
		'feature_image_size'    => 'grid-thumbnail',
		'feature_image_class'   => 'alignleft post-image',
		'grid_content_limit'    => genesis_get_option( 'jb_post_content_limit', JB_SETTINGS_FIELD ),
		'grid_image_size'       => 'grid-thumbnail',
		'grid_image_class'      => 'alignleft post-image',
		'more'                  => __( 'Continue reading &#x2192;', 'genesis' ),
	);

	$query_args = array(
		'posts_per_page'        => 6
	);
	
	$tax_args = array(
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => genesis_get_option( 'jb_featured_cat_slug', JB_SETTINGS_FIELD )
			),
		)
	);

	return array(
		'grid_args'  => $grid_args,
		'query_args' => $query_args,
		'tax_args' => $tax_args,
	);
}

add_action('genesis_before', 'home_feature');
add_action( 'genesis_before_loop', 'child_prepare_grid_loop' );
/**
 * Prepare Grid Loop.
 * 
 * Swap out the standard loop with the grid and apply classes.
 *
 * @author Gary Jones
 * @author Bill Erickson
 * @link   http://code.garyjones.co.uk/genesis-grid-loop-advanced/
 */
function child_prepare_grid_loop() {

	if ( child_is_doing_grid_loop() ) {
		
		// Remove the standard loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );
	
		// Use the prepared grid loop
		add_action( 'genesis_loop', 'child_do_grid_loop' );
	
		// Add some extra post classes to the grid loop so we can style the columns
		add_filter( 'genesis_grid_loop_post_class', 'child_grid_loop_post_class' );
		
		// Remove the archive thumbnail from the home page
		remove_action('genesis_post_content', 'genesis_do_post_image');
		
		//	Add featured image above title on teasers
		add_action('genesis_before_post_title', 'expose_homepage_teaser_image');
		
		add_action('genesis_before_post', 'child_switch_content');
	}
	
}

function child_switch_content() {
	remove_action('genesis_post_content', 'genesis_grid_loop_content');
	add_action('genesis_post_content', 'child_grid_loop_content');
}

function child_grid_loop_content() {

	global $_genesis_loop_args;
	$content = get_the_content('');
	$featured_limit = (int) $_genesis_loop_args['feature_content_limit'];
	$limit = (int) $_genesis_loop_args['grid_content_limit'];
	$cont = '&hellip; <div class="more-link"><a href="'. get_permalink() . '">'. esc_html( $_genesis_loop_args['more'] )  .'</a></div>';

	if ( in_array( 'genesis-feature', get_post_class() ) ) {
		if ( $_genesis_loop_args['feature_image_size'] )
			printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), genesis_get_image( array( 'size' => $_genesis_loop_args['feature_image_size'], 'attr' => array( 'class' => esc_attr( $_genesis_loop_args['feature_image_class'] ) ) ) ) );

		if ( $_genesis_loop_args['feature_content_limit'] )
		echo wp_trim_words( $content , $num_words = $featured_limit, $more = $cont );
			//the_content_limit( (int) $_genesis_loop_args['feature_content_limit'], esc_html( $_genesis_loop_args['more'] ) );
		else
		echo wp_trim_words( $content , $num_words = $featured_limit, $more = $cont );
			//the_content( esc_html( $_genesis_loop_args['more'] ) );
	}
	else {
		if ( $_genesis_loop_args['grid_image_size'] )
			printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), genesis_get_image( array( 'size' => $_genesis_loop_args['grid_image_size'], 'attr' => array( 'class' => esc_attr( $_genesis_loop_args['grid_image_class'] ) ) ) ) );

		if ( $_genesis_loop_args['grid_content_limit'] ) {
			echo wp_trim_words( $content , $num_words = $limit, $more = $cont );
			//the_content_limit( (int) $_genesis_loop_args['grid_content_limit'], esc_html( $_genesis_loop_args['more'] ) );
		} else {
			echo wp_trim_words( $content , $num_words = $limit, $more = $cont );
			//the_excerpt();
			//printf( '<br /> <a href="%s" class="more-link">%s</a>', get_permalink(), esc_html( $_genesis_loop_args['more'] ) );
		}
	}

}

function expose_homepage_teaser_image() {
	printf( '<p><a href="%s">%s</a></p>', get_permalink(), the_post_thumbnail( 'swt-discover-featured' ) );
}

function home_feature() {
	$paged = get_query_var('paged');
	if ( $paged < 2 && child_is_doing_grid_loop() ) {
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

add_action( 'pre_get_posts', 'child_grid_query' );
/**
 * Grid query to get the posts that will appear in the grid.
 * 
 * Any changes to the actual query (posts per page, category…) should be here.
 *
 * @author Bill Erickson
 * @author Gary Jones
 * @link   http://code.garyjones.co.uk/genesis-grid-loop-advanced/
 *
 * @param WP_Query $query
 */
function child_grid_query( $query ) {
	
	// Only apply to main query, if this matches our grid query conditional, and if it isn't in the back-end
	if ( $query->is_main_query() && child_is_doing_grid_loop() && ! is_admin() ) {


		// Get all arguments
		$args = child_grid_loop_arguments();
		
		// Don't edit below, this does the logic to figure out how many posts on each page
		$posts_per_page = $args['query_args']['posts_per_page'];
		$features = $args['grid_args']['features'];
		$offset = 0;
		$paged = $query->query_vars['paged'];
		if ( 0 == $paged )
			// If first page, add number of features to grid posts, so balance is maintained
			//$posts_per_page += $features;
			$posts_per_page = $features;
		else
			// Keep the offset maintained from our page 1 adjustment
			//$offset = ( $paged - 1 ) * $posts_per_page + $features;
			$offset = ( $paged - 2 ) * $posts_per_page + $features;
		
		$query->set( 'posts_per_page', $posts_per_page );
		$query->set( 'offset', $offset );
	}
	
}

/**
 * Prepare the grid loop.
 * 
 * Only use grid-specific arguments. All query args should be done in the
 * child_grid_query() function.
 *  
 * @author Gary Jones
 * @author Bill Erickson
 * @link   http://code.garyjones.co.uk/genesis-grid-loop-advanced/
 *
 * @uses genesis_grid_loop() Requires Genesis 1.5
 *
 * @global WP_Query $wp_query Post query object.
 */
function child_do_grid_loop() {

	global $wp_query;

	// Grid specific arguments
	$all_args = child_grid_loop_arguments();
	$grid_args = $all_args['grid_args'];
	$tax_args = $all_args['tax_args'];

	// Combine with original query
	$args = array_merge( $wp_query->query_vars, $grid_args, $tax_args );

	// Create the Grid Loop
	genesis_grid_loop( $args );

}

/**
 * Add some extra body classes to grid posts.
 * 
 * Change the $columns value to alter how many columns wide the grid uses.
 *
 * @author Gary Jones
 * @author Bill Erickson
 * @link   http://code.garyjones.co.uk/genesis-grid-loop-advanced/
 * 
 * @global array   $_genesis_loop_args
 * @global integer $loop_counter
 *
 * @param array $grid_classes 
 */
function child_grid_loop_post_class( $grid_classes ) {

	global $_genesis_loop_args, $loop_counter;

	// Alter this number to change the number of columns - used to add class names
	$columns = 3;
	
	// Be able to convert the number of columns to the class name in Genesis
	$fractions = array( '', 'half', 'third', 'quarter', 'fifth', 'sixth' );

	// Only want extra classes on grid posts, not feature posts
	if ( $loop_counter >= $_genesis_loop_args['features'] ) {
		// Make a note of which column we're in
		$column_number = ( ( $loop_counter - $_genesis_loop_args['features'] ) % $columns ) + 1;
		
		// Add genesis-grid-column-? class to know how many columns across we are
		$grid_classes[] = sprintf( 'genesis-grid-column-%d', $column_number );

		// Add one-* class to make it correct width
		$grid_classes[] = sprintf( 'one-' . $fractions[$columns - 1], $columns );
		
		// Add a class to the first column, so we're sure of starting a new row with no padding-left
		switch ($column_number) {
				case 1:
						$grid_classes[] = 'first';
						break;
		    case 2:
		        $grid_classes[] = 'second';
		        break;
		    case 3:
		        $grid_classes[] = 'third';
		        break;
		}
	} 

	return $grid_classes;

}