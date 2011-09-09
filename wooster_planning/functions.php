<?php
/*
* Educational Planning Child Theme functions file
*/
$themename = 'wooster_planning';
/* Tell WordPress to run wooster_twentyten_setup() when the 'after_setup_theme' hook is run. */

add_action( 'after_setup_theme', 'wooster_planning_setup' );

if ( !function_exists( 'wooster_planning_setup' ) ):
function wooster_planning_setup() {
	// Header Images are now in Child Themes Directory 
		define( 'HEADER_IMAGE', get_bloginfo('stylesheet_directory') .'/images/headers/kauke_940x198.jpg' );
		
add_action('init', 'wooster_remove_custom_header_uploads', 11);

function wooster_remove_custom_header_uploads(){
    remove_theme_support( 'custom-header-uploads' );
}
		
	/* From Aaron Jorbin http://aaron.jorb.in/ */
	/* Remove the default header images from the Twenty Ten theme */
	function wooster_remove_twentyten_headers(){
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

	add_action( 'after_setup_theme', 'wooster_remove_twentyten_headers', 11 );

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
function wooster_planning_excerpt_more($more){
	return '&nbsp;… <a href="'. get_permalink() . '">' . __('finish reading '.get_the_title() .'', 'twentyten') . '</a>';
}
remove_filter( 'excerpt_more', 'twentyten_excerpt_more' );
add_filter ('excerpt_more', 'wooster_planning_excerpt_more' );

/* Modify the text in the footer */
/*class Wooster_Twenty_Ten_Text_Wrangler {
  function site_generator($translation, $text, $domain) {
  $translations = &get_translations_for_domain( $domain );
  if ( $text == 'Proudly powered by <span id="generator-link">%s</span>.' ) {
   return $translations->translate( 'Proudly powered by <span id="WordPress"><a href="http://wordpress.org">WordPress</a></span>, <span id="hockley-link"><a href="http://www.flickr.com/photos/ahockley">Aaron Hockley / Hockley Photography</a>, and <span id="generator-link"> </span>' );
  }
  return $translation;
 }
}
add_filter('gettext', array('Wooster_Twenty_Ten_Text_Wrangler', 'site_generator'), 10, 4);*/
?>