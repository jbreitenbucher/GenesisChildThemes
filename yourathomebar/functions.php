<?php
/** Start the engine **/
require_once(TEMPLATEPATH.'/lib/init.php');

/** Remove the right header widget area **/
remove_action ('genesis_do_header','header_right');

/**  Remove footer **/
remove_action('genesis_footer', 'genesis_do_footer'); 
remove_action('genesis_footer', 'genesis_footer_markup_open', 5); 
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

/** Remove post info and post meta **/
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );

/** Add support for post thumbnails **/
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 290, 179, true );
}

/** Add new image sizes for the Dynamic Content Gallery **/
add_image_size('Dynamic Content Gallery', 610, 225, TRUE);

/** Force layout on homepage **/
add_filter('genesis_pre_get_option_site_layout', 'yourathomebar_home_layout');
function yourathomebar_home_layout($opt) {
	if ( is_home() )
    $opt = 'content-sidebar';
	return $opt;
}

/** Replaces homepage sidebar with Sidebar Home in widget area **/
add_action('genesis_after_content', 'get_custom_sidebar', 5);
function get_custom_sidebar() {
    if( is_home() ) {
		remove_action('genesis_after_content', 'genesis_get_sidebar'); 
    	get_sidebar('home');
	}
}

/** Register widget areas **/
genesis_register_sidebar(array(
	'name'=>'Sidebar Home',
	'id' => 'sidebar-home',
	'description' => 'This is the right sidebar on the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Featured Top Left',
	'id' => 'featured-top-left',
	'description' => 'This is the featured top left column of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Featured Top Right',
	'id' => 'featured-top-right',
	'description' => 'This is the featured top right column of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Featured Bottom',
	'id' => 'featured-bottom',
	'description' => 'This is the featured bottom section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));

function remove_some_sidebars(){
	// Unregsiter some of the Genesis sidebars
	unregister_sidebar( 'header_right' );
}
add_action( 'widgets_init', 'remove_some_sidebars', 11 );

/** Create a custom taxonomy for drink ingredients **/
register_taxonomy("Ingredients", array("post"), array("hierarchical" => false, "label" => "Ingredients", "singular_label" => "Ingredient", "rewrite" => true));

/** Add support for asides to use for drinking facts **/
add_theme_support( 'post-formats', array( 'aside','video' ) );

/** Create a custom widget for displaying a tag cloud of Ingredients **/
add_action("widgets_init", array('Widget_Custom_tax_tag_cloud', 'register'));
class Widget_Custom_tax_tag_cloud {
    function control(){
        echo 'No control panel';
    }
    function widget($args){
        echo $args['before_widget'];
        echo $args['before_title'] . 'Drinks by Ingredient' . $args['after_title'];
        $cloud_args = array('taxonomy' => 'Ingredients');
        wp_tag_cloud( $cloud_args ); 
        echo $args['after_widget'];
    }
    function register(){
        register_sidebar_widget('Drinks by Ingredient', array('Widget_Custom_tax_tag_cloud', 'widget', 'before_widget' => '<li id="%1$s" class="widget %2$s">', 'after_widget'  => '</li>', 'before_title'  => '<h4 class="widgettitle">', 'after_title'   => '</h4>'));
        register_widget_control('Drinks by Ingredient', array('Widget_Custom_tax_tag_cloud', 'control'));
    }
}

/** Add Thumbnails in Manage Posts/Pages List **/
if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {
    // for post and page
    add_theme_support('post-thumbnails', array( 'post', 'page' ) );
    function AddThumbColumn($cols) {
        $cols['thumbnail'] = __('Thumbnail');
        return $cols;
    }
    function AddThumbValue($column_name, $post_id) {
            $width = (int) 60;
            $height = (int) 60;
            if ( 'thumbnail' == $column_name ) {
                // thumbnail of WP 2.9
                $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
                // image from gallery
                $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
                if ($thumbnail_id)
                    $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
                elseif ($attachments) {
                    foreach ( $attachments as $attachment_id => $attachment ) {
                        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
                    }
                }
                    if ( isset($thumb) && $thumb ) {
                        echo $thumb;
                    } else {
                        echo __('None');
                    }
            }
    }
    // for posts
    add_filter( 'manage_posts_columns', 'AddThumbColumn' );
    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );
    // for pages
    add_filter( 'manage_pages_columns', 'AddThumbColumn' );
    add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
}