<?php
/** Start the engine **/
require_once(TEMPLATEPATH.'/lib/init.php');

/** Remove the right header widget area **/
remove_action ('genesis_do_header','header_right');

/** Remove the navigation area **/
// remove_action('genesis_after_header', 'genesis_do_nav');

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

// Add new image sizes
add_image_size('Dynamic Content Gallery', 610, 225, TRUE);

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'yourathomebar_home_layout');
function yourathomebar_home_layout($opt) {
	if ( is_home() )
    $opt = 'content-sidebar';
	return $opt;
}

// Replaces homepage sidebar with Sidebar Home in widget area
add_action('genesis_after_content', 'get_custom_sidebar', 5);
function get_custom_sidebar() {
    if( is_home() ) {
		remove_action('genesis_after_content', 'genesis_get_sidebar'); 
    	get_sidebar('home');
	}
}

// Register widget areas
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

/** Create a Drink Receipes Post Type 
add_action( 'init', 'drink_recipes_register' );
function drink_recipes_register() {
	
	$labels = array(
			'name' => _x('Drink Recipes', 'post type general name'),
			'singular_name' => _x('Drink Recipe', 'post type singular name'),
			'add_new' => _x('Add New', 'portfolio item'),
			'add_new_item' => __('Add New Recipe'),
			'edit_item' => __('Edit Recipe'),
			'new_item' => __('New Recipe'),
			'view_item' => __('View Recipe'),
			'search_items' => __('Search Recipes'),
			'not_found' =>  __('Nothing found'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => ''
		);
		
	$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'has_archive' => 'drink-recipes',
			'menu_position' => 5,
			'supports' => array('title','editor','thumbnail'),
			'taxonomies' => array( 'category')
		  );
		
	register_post_type( 'drinkrecipes', $args);
} **/

register_taxonomy("Ingredients", array("post"), array("hierarchical" => false, "label" => "Ingredients", "singular_label" => "Ingredient", "rewrite" => true));

/** Add support for asides to use for drinking facts **/
add_theme_support( 'post-formats', array( 'aside','video' ) );

/** Create a Drinking Facts Post Type 
add_action( 'init', 'drinking_facts_register' );
function drinking_facts_register() {
	
	$labels = array(
			'name' => _x('Drinking Facts', 'post type general name'),
			'singular_name' => _x('Drinking Fact', 'post type singular name'),
			'add_new' => _x('Add New', 'portfolio item'),
			'add_new_item' => __('Add New Drinking Fact'),
			'edit_item' => __('Edit Drinking Fact'),
			'new_item' => __('New Drinking Fact'),
			'view_item' => __('View Drinking Facts'),
			'search_items' => __('Search Drinking Facts'),
			'not_found' =>  __('Nothing found'),
			'not_found_in_trash' => __('Nothing found in Trash'),
			'parent_item_colon' => ''
		);
		
	$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'has_archive' => 'drinking-facts',
			'menu_position' => 6,
			'supports' => array('title','editor')
		  );
		
	register_post_type( 'drinkingfacts', $args);
}

add_post_type_support( 'drinkingfacts', 'post-formats', array( 'aside' ) );

add_action( 'admin_head', 'cpt_icons' );
function cpt_icons() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-drinkrecipes .wp-menu-image {
            background: url(<?php bloginfo('stylesheet_directory') ?>/images/address-book-open.png) no-repeat 6px -17px !important;
        }
	#menu-posts-drinkrecipes:hover .wp-menu-image, #menu-posts-drinkrecipes.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
				#menu-posts-drinkingfacts .wp-menu-image {
            background: url(<?php bloginfo('stylesheet_directory') ?>/images/glass.png) no-repeat 6px -17px !important;
        }
	#menu-posts-drinkingfacts:hover .wp-menu-image, #menu-posts-drinkingfacts.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
<?php } **/

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