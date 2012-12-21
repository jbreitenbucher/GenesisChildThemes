<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add new image sizes
add_image_size('Main Photo', 800, 533, TRUE);
add_image_size('Mini Landscape', 120, 75, TRUE);
add_image_size('Mini Portrait', 75, 120, TRUE);
add_image_size('Tiny Landscape', 75, 46, TRUE);
add_image_size('Tiny Portrait', 46, 75, TRUE);

/** Unregister layout setting */
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Add support for custom header */
add_theme_support( ‘genesis-custom-header’, array( ‘width’ => 850, ‘height’ => 80 ) );

/**
 * Remove Header Right Widget
 *
 * @author The Pedestal Group
 */

function landscape_remove_sidebars() {
    unregister_sidebar( 'header-right' );
    unregister_sidebar( 'sidebar-alt' );
    unregister_sidebar( 'sidebar' );
}
// Unregister Genesis Sidebars
add_action( 'widgets_init', 'landscape_remove_sidebars' );

// Add footer gallery
add_action('genesis_before_footer', 'landscape_include_footer_gallery',8); 
function landscape_include_footer_gallery() {
	dynamic_sidebar('Footer Gallery');
}

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// Add custom text for search button
add_filter('genesis_search_button_text', 'custom_search_button_text');
function custom_search_button_text($text) {
    return esc_attr('Go');
} 


// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'add_viewport_meta_tag' );
function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

// Register widget areas

if( !function_exists('wp_cycle') ) {
	genesis_register_sidebar(array(
		'name'=>'Homepage Image Area',
		'id' => 'homepage-image',
		'description' => 'This is the 800px by 533px area on the homepage for a large image or image slider.',
		'before_widget' => '<div id="rotator">','after_widget' => '</div>',
		'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
	));
}

genesis_register_sidebar(array(
	'name'=>'Footer Gallery',
	'id' => 'footer-gallery',
	'description' => 'This is the gallery of the footer section.',
	'before_widget' => '<div id="footer-gallery"><div class="wrap"><div id="%1$s" class="widget %2$s"><div class="widget-wrap">','after_widget' => '</div></div></div></div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));