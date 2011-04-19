<?php
/**
 * This file controls customizations to the Wooster 2011 Child Theme.
 *
 * @author Jon Breitenbucher
 * @package Wooster 2011
 * @subpackage Customizations
**/

/** Include Genesis theme files **/
require_once(TEMPLATEPATH.'/lib/init.php');

/**
** Wooster TwentyEleven Child Theme functions file
**/
$themename = 'wooster_twentyeleven	';

// Customize the post info function
add_filter('genesis_post_info', 'post_info_filter');
function post_info_filter($post_info) {
if (!is_page()) {
    $post_info = '<span class="author-icon"><img src="' . get_bloginfo ( 'stylesheet_directory' ) . '/images/user.png"></span> [post_author_posts_link]  <span class="calendar-icon"><img src="' . get_bloginfo ( 'stylesheet_directory' ) . '/images/date.gif"></span> ' . sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		) . ' [post_edit]';
    return $post_info;
}}

// Customize the post meta function
add_filter('genesis_post_meta', 'post_meta_filter');
function post_meta_filter($post_meta) {
if (!is_page()) {
    $post_meta = '[post_categories sep=", " before="Posted in "] [post_comments zero="No Comments" one="1 Comment" more="% Comments"]';
    return $post_meta;
}}

// Customize the comments closed text
add_filter('genesis_comments_closed_text', 'comments_closed_text_filter');
function comments_closed_text_filter() {
	$comments_closed_text = 'Comments Off';
	return $comments_closed_text;
}

// Customize the older/newer posts text
remove_action('genesis_after_endwhile', 'genesis_posts_nav'); 
add_action('genesis_after_endwhile', 'wooster_twentyeleven_posts_nav');
function wooster_twentyeleven_posts_nav() {
	$older_link = get_next_posts_link( g_ent('&#8592; ') . __('Older posts', 'genesis') );
	    $newer_link = get_previous_posts_link( __('Newer posts', 'genesis') . g_ent(' &#8594;') );

	    $older = $older_link ? '<div class="alignleft">' . $older_link . '</div>' : '';
	    $newer = $newer_link ? '<div class="alignright">' . $newer_link . '</div>' : '';

	    $nav = '<div class="navigation">' . $older . $newer . '</div><!-- end .navigation -->';

	    if ( !empty( $older ) || !empty( $newer ) )
	        echo $nav;
}


add_filter( 'excerpt_more', 'child_read_more_link' );
add_filter( 'get_the_content_more_link', 'child_read_more_link' );
add_filter( 'the_content_more_link', 'child_read_more_link' );
/**
 *
 * Edit the read more link text.
 *
 * @author Laura Poston
 * @link http://dev.studiopress.com/customize-read-more.htm
 *
 * @return string HTML markup
 *
 */
function child_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '" rel="nofollow">Continue Reading &#8594;</a>';
}

/** Add support for custom header image. **/
add_theme_support( 'genesis-custom-header', array( 'textcolor' => '', 'header_image' => '%s/images/headers/kauke_towers_940x198.jpg', 'no_header_text' => true, 'width' => 940, 'height' => 198 ) );

/** Tell WordPress to run wooster_twentyeleven_setup() when the 'after_setup_theme' hook is run. **/
add_action( 'after_setup_theme', 'wooster_twentyeleven_setup' );

if ( !function_exists( 'wooster_twentyeleven_setup' ) ):
function wooster_twentyeleven_setup() {

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
	function wooster_twentyeleven_footer_creds_text($creds) {
		$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', 'genesis') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
		return $creds;
	}
	add_filter('genesis_footer_creds_text', 'wooster_twentyeleven_footer_creds_text');

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
?>
