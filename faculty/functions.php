<?php
/**
 * This file controls customizations to the Faculty Child Theme.
 *
 * @author Jon Breitenbucher & StudioPress
 * @package Faculty
 * @subpackage Customizations
 */

/** Start the engine */
require_once( get_template_directory() . '/lib/init.php');
require_once( get_stylesheet_directory() . '/lib/init.php');

/** Child theme (do not remove) */
define('CHILD_THEME_NAME', 'Faculty Theme');
define('CHILD_THEME_URL', 'http://voices.wooster.edu/themes/faculty');

/** Add new image sizes */
add_image_size( 'square', 100, 100, TRUE );
add_image_size( 'featured-top-bottom', 460, 288, TRUE );
add_image_size( 'featured-middle', 299, 187, TRUE );
add_image_size( 'featured-footer', 215, 134, TRUE );
add_image_size( 'slider', 590, 300, TRUE );
add_image_size( 'featured', 900, 300, TRUE );
add_image_size('discover-featured', 280, 150, TRUE);

add_theme_support( 'custom-background' );

/** Add support for custom header **/
add_theme_support( 'genesis-custom-header', array( 'header_image' => get_stylesheet_directory_uri() . '/images/headers/kauke_towers_940x198.jpg', 'width' => 940, 'height' => faculty_get_design_option('header_image_height'), 'no_header_text' => true, 'header_callback' => 'faculty_custom_header_style', 'admin_header_callback' => 'faculty_custom_header_admin_style' ) );

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'add_viewport_meta_tag' );
function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

register_default_headers( cms_theme_headers() );

/* Automatically add header options that you put in the images/header folder to the options users have */
function cms_theme_headers() {
	global $themename;
    $list = array();
	$imagepath = get_stylesheet_directory() .'/images/headers/';
	$imageurl = get_stylesheet_directory_uri();
    $dir_handle = @opendir($imagepath) or die("Unable to open $path"); 
    while($file = readdir($dir_handle)){ 
        if($file == "." || $file == ".."){continue;} 
        $filename = explode(".",$file); 
        $cnt = count($filename); $cnt--; $ext = $filename[$cnt]; 
        if(strtolower($ext) == ('png' || 'jpg')){ 
   	 	  if (!strpos($file, '-thumbnail') > 0) {	 
				$header = array(
					'url' => $imageurl .'/images/headers/' .$file,
					'thumbnail_url' => $imageurl .'/images/headers/' .$filename[0] .'-thumbnail.' .$ext,
					'description' => __( $filename[0], $themename )
				);
				array_push($list, $header);
		  }
        }
    }
    return $list;
}

/**
 * Styling included at the top of the site page for a custom header.
 * 
 * @author StudioPress
 */
function faculty_custom_header_style() { 
    if ( get_header_image() ) {?>
<!-- custom-header styling --><style type="text/css">
#header{background:url(<?php header_image(); ?>) scroll no-repeat 0 0; max-width:100%;}
<?php if ( get_theme_mod('header_textcolor') && get_theme_mod('header_textcolor') != 'blank' ){ ?>
#title-area #title a, #title-area #title a:hover{display:none;color:#<?php header_textcolor(); ?>;}
#title-area #description{display:none;color: #<?php header_textcolor(); ?>;}
<?php } ?>
</style>
<?php
    }
}

/**
 * Styling included at the top of the custom-header admin page.
 * 
 * @author StudioPress
 */
function faculty_custom_header_admin_style() {
    $background_color = ( 'hex' == faculty_get_design_option('header_background_color_select') ) ? faculty_get_design_option('header_background_color') : faculty_get_design_option('header_background_color_select');
?>
<style type="text/css">
#headimg {
    background-repeat:no-repeat;
    background-color: <?php echo $background_color; ?>;
    width: 940px;
    height: <?php echo faculty_get_design_option('header_image_height'); ?>px;
}
#headimg h1 {
    font-family: Georgia, serif;
    font-size: 30px;
    font-weight: normal;
    line-height: 36px;
    margin: 0; 
    padding: <?php echo faculty_get_design_option('header_top_padding'); ?>px 0 0 <?php echo faculty_get_design_option('header_left_padding'); ?>px;
}
#headimg h1 a {
    color:#333333;
    text-decoration:none;
}
#headimg #desc {
    color: #999999;
    font-family: Georgia, serif;
    font-size: 15px;
    font-style: italic;
    font-weight: normal;
    margin: 0; 
    padding: <?php echo faculty_get_design_option('header_tagline_top_padding'); ?>px 0 0 <?php echo faculty_get_design_option('header_tagline_left_padding'); ?>px;
}
</style>
<?php
}


/** Add branding section */
function wooster_include_branding() {
    require_once( get_stylesheet_directory() . '/branding.php');
}
add_action('genesis_before_header', 'wooster_include_branding');

/** Remove the Header Right widget area */
function remove_some_widgets() {
	unregister_sidebar('header-right');
}
add_action( 'widgets_init', 'remove_some_widgets', 11 ); 

/** Reposition the Primary Navigation */
//remove_action('genesis_after_header', 'genesis_do_nav');
//add_action('genesis_before_header', 'genesis_do_nav');

/**
 * Modify the size of the Gravatar in the author box
 * 
 * @param int $size
 */
function faculty_gravatar_size($size) {
    return '60'; 
}
add_filter('genesis_author_box_gravatar_size', 'faculty_gravatar_size');

/** Add support for 4 footer widgets */
add_theme_support( 'genesis-footer-widgets', 4 );

/**
 * Customize the footer section
 *
 * @param string $creds
 * @return string 
 */
function faculty_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', FACULTY_DOMAIN) .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
}
add_filter('genesis_footer_creds_text', 'faculty_footer_creds_text');

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'featured-top',
	'name'			=> __( 'Home First', FACULTY_DOMAIN ),
	'description'	=> __( 'This is a featured area under the header with a background.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-top-left',
	'name'			=> __( 'Home Top Left', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the top left section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-top-right',
	'name'			=> __( 'Home Top Right', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the top right section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-middle-left',
	'name'			=> __( 'Home Middle Left', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the middle left section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-middle-center',
	'name'			=> __( 'Home Middle Center', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the middle center section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-middle-right',
	'name'			=> __( 'Home Middle Right', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the middle right section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-bottom-left',
	'name'			=> __( 'Home Bottom Left', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the featured bottom left section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-bottom-right',
	'name'			=> __( 'Home Bottom Right', FACULTY_DOMAIN ),
	'description'	=> __( 'This is the featured bottom right section.', FACULTY_DOMAIN ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-bottom',
	'name'			=> __( 'Home Last', FACULTY_DOMAIN ),
	'description'	=> __( 'This is a featured area before the footer widgets with a background.', FACULTY_DOMAIN ),
) );