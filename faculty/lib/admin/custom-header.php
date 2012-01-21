<?php
/**
 * This file controls inclusion of a Custom Header within the site.
 *
 * @package Faculty
 * @author StudioPress & Gary Jones
 */

/**
 * Defines a value used by WordPress, as empty.
 */
define('HEADER_TEXTCOLOR', '');

// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
define( 'HEADER_IMAGE', get_stylesheet_directory_uri() . '/images/headers/kauke_towers_940x198.jpg' );

/**
 * Defines a value used by WordPress. 940 is the default width of the layout.
 */
define('HEADER_IMAGE_WIDTH', 940);

/**
 * Defines a value used by WordPress. Set to the design setting value.
 */
define('HEADER_IMAGE_HEIGHT', faculty_get_design_option('header_image_height'));
add_custom_image_header('faculty_custom_header_style', 'faculty_custom_header_admin_style');

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
#title-area #title a, #title-area #title a:hover{color:#<?php header_textcolor(); ?>;}
#title-area #description{color: #<?php header_textcolor(); ?>;}
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