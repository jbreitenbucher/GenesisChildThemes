<?php
/*
* Wooster Research Child Theme functions file
*/
$themename = 'wooster_research';
//add_custom_image_header( '', 'twentyten_admin_header_style' );
//remove_theme_support('custom-header-uploads');

function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

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
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', get_bloginfo('stylesheet_directory') .'/images/headers/kauke_towers_940x198.jpg' );

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
add_action( 'after_setup_theme', 'wooster_research_setup' );

if ( !function_exists( 'wooster_research_setup' ) ):
function wooster_research_setup() {
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

/* Modify the text that displays at the end of an excerpt */
function wooster_research_excerpt_more($more){
	return '&nbsp;… <a href="'. get_permalink() . '">' . __('finish reading '.get_the_title() .'', 'twentyten') . '</a>';
}
remove_filter( 'excerpt_more', 'twentyten_excerpt_more' );
add_filter ('excerpt_more', 'wooster_research_excerpt_more' );

/* Modify the text in the footer */
class Wooster_Research_Text_Wrangler {
  function site_generator($translation, $text, $domain) {
  $translations = &get_translations_for_domain( $domain );
  if ( $text == 'Proudly powered by <span id="generator-link">%s</span>.' ) {
   return $translations->translate( 'Proudly powered by <span id="WordPress"><a href="http://wordpress.org">WordPress</a></span>' );
  }
  return $translation;
 }
}
add_filter('gettext', array('Wooster_Research_Text_Wrangler', 'site_generator'), 10, 4);

add_action( 'admin_menu', 'my_create_post_meta_box' );
add_action( 'save_post', 'my_save_post_meta_box', 10, 2 );

function my_create_post_meta_box() {
	add_meta_box( 'my-meta-box', 'Order', 'my_post_meta_box', 'post', 'normal', 'high' );
}

function my_post_meta_box( $object, $box ) { ?>
	<p>
		<label for="position">Position</label>
		<br />
		<textarea name="position" id="position" cols="60" rows="1" tabindex="30" style="width: 97%;"><?php echo wp_specialchars( get_post_meta( $object->ID, 'Position', true ), 1 ); ?></textarea>
		<input type="hidden" name="my_meta_box_nonce" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function my_save_post_meta_box( $post_id, $post ) {

	if ( !wp_verify_nonce( $_POST['my_meta_box_nonce'], plugin_basename( __FILE__ ) ) )
		return $post_id;

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Position', true );
	$new_meta_value = stripslashes( $_POST['position'] );

	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'Position', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'Position', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'Position', $meta_value );
}

if ( function_exists('register_sidebar') )
    register_sidebar(array(
				'name'=> 'Widgetized Page Content',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '',
				'after_title' => '',
			));
?>