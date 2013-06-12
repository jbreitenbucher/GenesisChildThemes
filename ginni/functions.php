<?php
// Start the engine
require_once( get_template_directory() . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Ginni Child Theme' );
define( 'CHILD_THEME_URL', 'http://thepedestalgroup.com' );

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'sample_viewport_meta_tag' );
function sample_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

// Add support for custom background
add_theme_support( 'custom-background' );

// Customize the Genesis Custom Header to use the Featured Image
set_post_thumbnail_size( 1152, 120, true ); /*Set the size of thumbnails to that of our header */
function jb_custom_header_style() {
	global $post;
	if ( is_singular() &&
			has_post_thumbnail( $post->ID ) &&
			( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'interior-header' ) ) ):
			echo '<div id="featured-image"><img src="' . $image[0] . '" /></div>';
	else :
			return;
	endif;
}

// Add support for custom header
add_theme_support( 'genesis-custom-header', array( 'width' => 1152, 'height' => 120 ) );

add_action( 'genesis_after_header', 'jb_custom_header_style', 12 );

// Custom image sizes
add_image_size( 'slider', 1110, 300, TRUE );
add_image_size( 'home-posts', 350, 262, TRUE );
add_image_size( 'interior-header', 1152, 120, TRUE );

// Add Featured Image to Posts
add_action( 'genesis_after_post_content', 'child_do_single_post_image' );
function child_do_single_post_image() {

    if( is_home() )
        genesis_image( array( 'size' => 'home-posts', 'attr' => array( 'class' => 'aligncenter' ) ) );
}

// Remove Custom Menu support
remove_theme_support ( 'genesis-menus' );
// Default Menus: registers menus
add_theme_support ( 'genesis-menus' , array ( 'primary' => 'Primary Navigation Menu' , 'secondary' => 'Secondary Navigation Menu' ,'tertiary' => 'Tertiary Navigation Menu' ) );

// Move secondary nav menu */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav', 12 );

// Add new navbar
add_action('genesis_before_header', 'tertiary', 11);
function tertiary() {
require( get_stylesheet_directory() .'/tertiary.php');
}

// Add support for 5-column footer widgets
add_theme_support( 'genesis-footer-widgets', 5 );

// Remove the post info function
remove_action( 'genesis_before_post_content', 'genesis_post_info' );

// Remove the post meta function
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );

// Remove the pagination function
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav' );

/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function jb_home_genesis_meta() {

	if ( is_active_sidebar( 'slider' ) ) {
	
		add_action( 'genesis_after_header', 'jb_home_slider' );

	}
}

/**
 * Display widget content for homepage sections.
 *
 */
function jb_home_slider() {

		if ( is_active_sidebar( 'slider' ) ) {
		
		echo '<div class="slider">';
		
				echo '<div class="wrap">';
				dynamic_sidebar( 'slider' );
				echo '</div><!-- end .wrap -->';
				
		echo '</div><!-- end .slider -->';
		
		}

}

add_action( 'genesis_before_footer', 'jb_social', 8 );
/**
 * Display widget content for social widget area.
 *
 */
function jb_social() {

		if ( is_active_sidebar( 'social' ) ) {
		
		echo '<div class="social">';
		
				echo '<div class="wrap">';
				dynamic_sidebar( 'social' );
				echo '</div><!-- end .wrap -->';
				
		echo '</div><!-- end .social -->';
		
		}

}

/** Register Homepage Widget area */
genesis_register_sidebar(array(
	'name'=>'Slider',
	'id' => 'slider',
	'description' => 'This is the widget area on the homepage for a slider'
));

/** Register Social Widget area */
genesis_register_sidebar(array(
	'name'=>'Social',
	'id' => 'social',
	'description' => 'This is the widget area for social media'
));