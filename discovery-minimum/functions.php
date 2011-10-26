<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Discovery Minimum Theme' );
define( 'CHILD_THEME_URL', 'http://instructionaltechnology.wooster.edu' );

$content_width = apply_filters( 'content_width', 640, 470, 740, 940 );

/** Add new image sizes */
add_image_size( 'slider', 940, 588, TRUE );
add_image_size( 'featured', 500, 313, TRUE );
add_image_size( 'portfolio', 160, 100, TRUE );
add_image_size( 'middle', 250, 156, TRUE );
add_image_size( 'footer', 156, 98, TRUE );

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 940, 'height' => 100, 'textcolor' => '444', 'admin_header_callback' => 'dm_admin_style' ) );

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 */
function dm_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Oswald, arial, serif; min-height: %spx; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-size: 48px; font-weight: normal; line-height: 48px; margin: 25px 0 0; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { color: #%s; display: none; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}

/** Tell WordPress to run dm_setup() when the 'after_setup_theme' hook is run. **/
add_action( 'after_setup_theme', 'dm_setup' );

if ( !function_exists( 'dm_setup' ) ):
function dm_setup() {

	/** Add default posts and comments RSS feed links to head **/
	add_theme_support( 'automatic-feed-links' );

	/** Make theme available for translation **/
	/** Translations can be filed in the /languages/ directory **/
	load_theme_textdomain( 'genesis', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/** ... and thus ends the changeable header business. **/
	
	/** Wordpress 3.1 support to remove header upload. **/
	/** remove_theme_support( 'custom-header-uploads' ); **/
	
	/**
	 * Customize the footer section
	 *
	 * @param string $creds
	 * @return string 
	 */
	function dm_footer_creds_text($creds) {
		$creds = __('Copyright', 'genesis') . ' [footer_copyright] ' .  ' [footer_childtheme_link] '. __('on', 'genesis') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
		return $creds;
	}
	add_filter('genesis_footer_creds_text', 'dm_footer_creds_text');

/** Add our own custom headers packaged with the theme. in the theme template directory 'images/headers/' **/
	register_default_headers( cms_theme_headers() );
}
endif;

/** Automatically add header options that you put in the images/header folder to the options users have **/
function cms_theme_headers() {
	global $themename;
    $list = array();
	$imagepath = STYLESHEETPATH .'/images/headers/';
	$imageurl = get_bloginfo('stylesheet_directory');
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
 * Add branding section
 */
function dm_include_branding() {
    require_once(CHILD_DIR . '/branding.php');
}
add_action('genesis_before_header', 'dm_include_branding');

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'welcome',
	'name'			=> __( 'Welcome', 'minimum' ),
	'description'	=> __( 'This is the welcome section.', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured',
	'name'			=> __( 'Featured', 'minimum' ),
	'description'	=> __( 'This is the featured section.', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'portfolio',
	'name'			=> __( 'Portfolio', 'minimum' ),
	'description'	=> __( 'This is the portfolio section.', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'middle_left',
	'name'			=> __( 'Middle Left', 'minimum' ),
	'description'	=> __( 'This is the middle left section.', 'minimum' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'middle_right',
	'name'			=> __( 'Middle Right', 'minimum' ),
	'description'	=> __( 'This is the middle section.', 'minimum' ),
) );