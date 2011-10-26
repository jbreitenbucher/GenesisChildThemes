<?php
/*
* Wooster Research Child Theme functions file
*/
$themename = 'wooster2011';

function twentyten_posted_on() {
	printf( __( '<span class="meta-sep"><img src="' . get_bloginfo ( 'stylesheet_directory' ) . '/images/user.png"></span> %3$s <span class="%1$s"><img src="' . get_bloginfo ( 'stylesheet_directory' ) . '/images/date.gif"></span> %2$s', 'twentyten' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
				get_the_author()
			)
	);
}

function wooster2011_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

function twentyten_setup() {

	//Remove twentyten widgets and initialize new widgets. No footer widget regions, only sidebar.
	remove_action( 'widgets_init', 'twentyten_widgets_init' );
	add_action( 'widgets_init', 'wooster2011_widgets_init' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	//add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	//add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	// This theme allows users to set a custom background
	//add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', get_bloginfo ( 'stylesheet_directory' ) . '/images/headers/kauke_towers_940x198.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( '', 'twentyten_admin_header_style' );

	// ... and thus ends the changeable header business.
}

/* Tell WordPress to run wooster_research_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'wooster2011_setup' );

if ( !function_exists( 'wooster2011_setup' ) ):
function wooster2011_setup() {
	/* From Aaron Jorbin http://aaron.jorb.in/ */
	/* Remove the default header images from the Twenty Ten theme */
	function remove_twentyten_headers(){
		unregister_default_headers( array(
			'berries',
			'cherryblossom',
			'concave',
			'fern',
			'forestfloor',
			'inkwell',
			'path' ,
			'sunset')
		);
	}

	add_action( 'after_setup_theme', 'remove_twentyten_headers', 11 );

// Add our own custom headers packaged with the theme. in the theme template directory 'images/headers/'
	register_default_headers( cms_theme_headers() );
}
endif;

/* Automatically add header options that you put in the images/header folder to the options users have */
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