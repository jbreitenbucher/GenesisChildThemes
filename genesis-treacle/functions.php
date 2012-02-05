<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme (do not remove)
define('CHILD_THEME_VERSION', '1.0');
define('CHILD_THEME_NAME', 'Treacle');
define('CHILD_THEME_URL', 'http://orthogonalcreations.com/genesis-treacle/');

remove_action('wp_head', 'wp_generator');

// Remove Purchase Themes menu link from dashboard
remove_theme_support('genesis-purchase-menu');

add_theme_support( 'post-formats', array( 'aside', 'gallery', 'chat', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );
add_theme_support( 'menus' );

// Replaces homepage sidebar with Sidebar Home in widget area
add_action('genesis_after_content', 'treacle_include_sidebar', 5);
function treacle_include_sidebar() {
	if ( !is_page( 'no-signups')) {
		remove_action('genesis_after_content', 'genesis_get_sidebar'); 
    	get_sidebar('stack');
	} else { remove_action('genesis_after_content', 'genesis_get_sidebar'); }
}

// Register widget areas
genesis_register_sidebar(array(
    'name'=>'Top Sidebar',
    'description' => 'This is a custom area at the top of the sidebar'
));
genesis_register_sidebar(array(
    'name'=>'Left Sidebar',
    'description' => 'This is a custom area at the left of the sidebar'
));
genesis_register_sidebar(array(
    'name'=>'Right Sidebar',
    'description' => 'This is a custom area at the right of the sidebar'
));

/**
 * The Gallery shortcode.
 *
 * This alters the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 * This function also adds an aditional option to the gallery shortcode:
 *   exclude = excludes the list of post (image) ids from the gallery
 *
 * @since 2.5.0
 *
 * @param mixed $null space filler to take up empty string argument passed by WP
 * @param array $attr Attributes attributed to the shortcode.
 * @return string HTML content to display gallery.
 */
function my_gallery_shortcode($null, $attr = array( )) {
	global $post;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit',
	'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order,
	'orderby' => $orderby, 'exclude' => $exclude) );

	if ( empty($attachments) )
		return '';

	if ( is_feed( ) ) {
		$output = "\n";
		foreach ( $attachments as $id => $attachment )
			$output .= wp_get_attachment_link($id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;

	$output = apply_filters('gallery_style', "
	<div class='gallery'>");

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link']
			? wp_get_attachment_link($id, $size, false, false)
			: wp_get_attachment_link($id, $size, true, false);

		$output .= "";
		$output .= "

		$link
		";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "

			{$attachment->post_excerpt}
			";
		}
		$output .= "";
	}

	$output .= "
	</div>\n";

	return $output;
}
add_filter('post_gallery', 'my_gallery_shortcode', 10, 2);
add_filter('login_errors',create_function('$a', "return null;"));
?>