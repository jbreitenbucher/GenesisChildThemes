<?php
/** Start the engine */
require_once( get_template_directory() . '/lib/init.php' );
require_once( get_stylesheet_directory() . '/lib/load-js.php');

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'The Pedestal Group Theme' );
define( 'CHILD_THEME_URL', 'http://thepedestalgroup.com' );

/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'add_viewport_meta_tag' );
function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100 ) );

genesis_register_sidebar(array(
	'name'=>'Homepage Widgets',
   	'id' => 'homepage-widgets',
	'description' => 'This shows up at the bottom of the homepage.',
));

/** Add after post ad section */
add_action( 'genesis_after_content_sidebar_wrap', 'homepage_after_content_widget', 9 );
function homepage_after_content_widget() {
	if ( is_home() && !is_paged() && is_active_sidebar( 'homepage-widgets' ) ) {
		echo '<div id="testemonials">';
		echo '<h1>What people are saying about us</h1>';
		dynamic_sidebar( 'homepage-widgets' );
		echo '</div><!-- end .homepage-widgets-->';
	}
}

/** Customize the post info function */
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
if ( !is_page() ) {
    $post_info = '[post_comments] [post_edit]';
    return $post_info;
}}
remove_action('genesis_before_post_content', 'genesis_post_info');

/** Add Jetpack share buttons above post */
remove_filter( 'the_content', 'sharing_display', 19 );
remove_filter( 'the_excerpt', 'sharing_display', 19 );
 
add_filter( 'the_content', 'share_buttons_above_post', 19 );
add_filter( 'the_excerpt', 'share_buttons_above_post', 19 );
 
function share_buttons_above_post( $content = '' ) {
	if ( function_exists( 'sharing_display' ) ) {
		return sharing_display() . $content;
	}
	else {
		return $content;
	}
}

add_action('genesis_after_post_content', 'tpg_related_posts');
function tpg_related_posts() {
	if(function_exists('echo_ald_crp') && !is_page() ) echo_ald_crp();
}

/** Modify the length of post excerpts */
add_filter( 'excerpt_length', 'tpg_custom_excerpt_length' );
function tpg_custom_excerpt_length($length) {
    return 100; // pull first 100 words
}

/** Customize Read More Link */
function tpg_more_link($more_link) {
	return sprintf(' [&hellip;] <a href="%s" class="more-link">%s</a></span>', get_permalink(), 'Continue reading');
}
add_filter( 'excerpt_more', 'tpg_more_link' );
add_filter( 'get_the_content_more_link', 'tpg_more_link' );
add_filter( 'the_content_more_link', 'tpg_more_link' );

/** Change default comment text */
function tpg_change_default_comment_text($args) {
    $args['title_reply'] = 'Leave a Comment';
    return $args;
}
add_filter( 'genesis_comment_form_args', 'tpg_change_default_comment_text' );

/** Reposition the primary navigation menu */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

/** Remove the secondary navigation menu */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Force layout on category */
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

// Structural Wrap
add_theme_support( 'genesis-structural-wraps', array( 'inner','header','footer','footer-widgets','menu-primary' , 'nav') );


/** Unregister layout settings */
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );