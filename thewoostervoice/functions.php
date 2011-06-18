<?php
/** Start the engine **/
require_once(TEMPLATEPATH.'/lib/init.php');

/** Add support for custom background **/
add_custom_background();

/** Add support for custom header **/
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 115 ) );

// Provides markup for the #topnav section
register_nav_menu('topnav' , __('Top Navigation Menu', 'thewoostervoice'));
add_action('genesis_before_header', 'thewoostervoice_do_topnav');
function thewoostervoice_do_topnav() { ?>
	<div id="topnav">
	<div class="topnav-left">
		<?php if ( function_exists('wp_nav_menu') ) { 
		$topnav = wp_nav_menu(array(
		'theme_location' => 'topnav',
		'container' => '',
		'menu_class' => 'topnav superfish',
		'echo' => 0,
		'fallback_cb' => false
		));
		echo $topnav;
		} ?>
	</div><!-- end .topnav-left -->
	<div class="topnav-right">
		<p><?php echo date_i18n(get_option('date_format')); ?></p>
	</div><!-- end .topnav-right -->
	</div><!-- end #topnav -->
<?php }

// Replaces homepage sidebar with Sidebar Home in widget area
add_action('genesis_after_content', 'thewoostervoice_include_sidebar', 5);
function thewoostervoice_include_sidebar() {
	if( is_home() )  {
		remove_action('genesis_after_content', 'genesis_get_sidebar'); 
    	get_sidebar('home');
	} else { genesis_get_sidebar(); }
}

// Add new image sizes
add_image_size('Mini Square', 68, 68, TRUE);
add_image_size('Square', 83, 83, TRUE);
add_image_size('X-Large Square (Full page story)', 332, 332, TRUE);
add_image_size('Featured Stories (Image Only)', 568, 351, TRUE);
add_image_size('Featured Stories (Landscape Image & Text)', 568, 83, TRUE);
add_image_size('Bottom Features (Landscape)', 455, 68, TRUE);


// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'thewoostervoice_home_layout');
function thewoostervoice_home_layout($opt) {
	if ( is_home() )
    $opt = 'content-sidebar';
	return $opt;
}

// Add widgeted footer section
add_action('genesis_before_footer', 'thewoostervoice_include_footer_widgets'); 
function thewoostervoice_include_footer_widgets() {
	if( is_home() ) require(CHILD_DIR.'/home-bottom-widgets.php');
}

// Register aditional widget areas
genesis_register_sidebar(array(
	'name'=>'Home Featured Top',
	'id' => 'home-featured-top',
	'description' => 'This is the featured top section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>'
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom Left',
	'id' => 'home-bottom-left',
	'description' => 'This is the featured bottom left area of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>'
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom Right',
	'id' => 'home-bottom-right',
	'description' => 'This is the featured bottom right area of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>'
));
genesis_register_sidebar(array(
	'name'=>'Home Sidebar Left',
	'id' => 'home-sidebar-left',
	'description' => 'This is the small sidebar of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>'
));
genesis_register_sidebar(array(
	'name'=>'Home Sidebar Right',
	'id' => 'home-sidebar-right',
	'description' => 'This is the large sidebar of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>'
));
?>