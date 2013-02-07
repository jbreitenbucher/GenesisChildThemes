<?php
/** Start the engine */
require_once(TEMPLATEPATH.'/lib/init.php');

/** Add support for custom background */
add_theme_support( 'custom-background' );

/** Customize the Genesis Custom Header to use the Featured Image */
set_post_thumbnail_size( 800, 258, true ); /*Set the size of thumbnaails to that of our header */
function inspiratranz_custom_header_style() {
	global $post;
	if ( is_singular() &&
			has_post_thumbnail( $post->ID ) &&
			( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
			$image[1] >= HEADER_IMAGE_WIDTH ):
			echo '<style type="text/css">#header { background: url(' . $image[0] . ' ) no-repeat; } #title a, #title a:hover, #description { color: #' . esc_html( get_header_textcolor() ) . '</style>';
	else :
			echo '<style type="text/css">#header { background: url(' . esc_url( get_header_image() ) . ' ) no-repeat; } #title a, #title a:hover, #description { color: #' . esc_html( get_header_textcolor() ) . '</style>';
	endif;
}

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 800, 'height' => 258, 'header_callback' => 'inspiratranz_custom_header_style' ) );

/** Register default site layout option */
genesis_set_default_layout( 'sidebar-content' );

/** Unregister other site layouts */
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Register Homepage Widget area */
genesis_register_sidebar(array(
	'name'=>'Homepage Widgets',
	'id' => 'homepage-widgets',
	'description' => 'This is the widget area on the right of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Homepage Bottom',
	'id' => 'homepage-bottom',
	'description' => 'This is the widget area on the bottom of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Sustainability Bottom',
	'id' => 'sustainability-bottom',
	'description' => 'This is the widget area on the bottom of the sustainability page.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

/** Add a widget area above the footer */
add_action('genesis_before_footer', 'include_bottom_widgets');
function include_bottom_widgets() {
	if(is_front_page()) {
		require(CHILD_DIR.'/home-bottom-widgets.php');
	}
	elseif(is_page('sustainability')) {
		require(CHILD_DIR.'/sustainability-bottom-widgets.php');
	}
	else
		return;
}

// Modify back to top text
add_filter('genesis_footer_backtotop_text', 'custom_footer_backtotop_text');
function custom_footer_backtotop_text($backtotop) {
    $backtotop = '';
    return $backtotop;
}
// Modify credits section
add_filter('genesis_footer_creds_text', 'custom_footer_creds_text');
function custom_footer_creds_text($creds) {
    $creds = '[footer_copyright] ' . get_bloginfo('name');
    return $creds;
}

/** Add the Saftey and Sustainability links */
function include_under_nav() {
    require(CHILD_DIR.'/under-nav.php');
}

add_action('genesis_before_content_sidebar_wrap','include_under_nav');

/** Add the Top matter */
function include_top() {
    require(CHILD_DIR.'/top.php');
}

add_action('genesis_before_header','include_top');

/** Customize the header-right content */
remove_action( 'genesis_header', 'genesis_do_header' );

function inspiratranz_do_header() {
	echo '<div id="title-area">';
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	echo '</div><!-- end #title-area -->';

       if ( is_front_page() ) {
		echo '<div class="widget-area">';
		do_action( 'genesis_header_right' );
		dynamic_sidebar( 'homepage-header' );
		echo '</div><!-- end .widget_area -->';
	}

       if ( is_page( 'Services' ) ) {
		echo '<div class="widget-area">';
		do_action( 'genesis_header_right' );
		dynamic_sidebar( 'services-header' );
		echo '</div><!-- end .widget_area -->';
	}

       if ( is_page( 'Careers' ) ) {
		echo '<div class="widget-area">';
		do_action( 'genesis_header_right' );
		dynamic_sidebar( 'careers-header' );
		echo '</div><!-- end .widget_area -->';
	}

       if ( is_page( 'News' ) ) {
		echo '<div class="widget-area">';
		do_action( 'genesis_header_right' );
		dynamic_sidebar( 'news-header' );
		echo '</div><!-- end .widget_area -->';
	}

       if ( is_page( 'Company' ) ) {
		echo '<div class="widget-area">';
		do_action( 'genesis_header_right' );
		dynamic_sidebar( 'company-header' );
		echo '</div><!-- end .widget_area -->';
	}

       if ( is_page( 'Safety' ) ) {
		echo '<div class="widget-area">';
		do_action( 'genesis_header_right' );
		dynamic_sidebar( 'safety-header' );
		echo '</div><!-- end .widget_area -->';
	}

       if ( is_page( 'Sustainability' ) ) {
		echo '<div class="widget-area">';
		do_action( 'genesis_header_right' );
		dynamic_sidebar( 'sustainability-header' );
		echo '</div><!-- end .widget_area -->';
	}

       if ( is_page( 'Customers' ) ) {
		echo '<div class="widget-area">';
		do_action( 'genesis_header_right' );
		dynamic_sidebar( 'customers-header' );
		echo '</div><!-- end .widget_area -->';
	}
}

add_action( 'genesis_header', 'inspiratranz_do_header' );

/** Add custom CSS for IE */
add_action( 'genesis_meta', 'inspiratranz_meta');

function inspiratranz_meta() {
        $iestyle = CHILD_URL . '/ie-only.css';
	echo '<!--[if IE]>';
	     echo '<link rel="stylesheet" type="text/css" href="' . esc_url( $iestyle ) . '" />' . "\n";
	echo '<![endif]-->';
}

?>