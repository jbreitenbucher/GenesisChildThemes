<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Instructional Technology Theme' );
define( 'CHILD_THEME_URL', 'http://instructionaltechnology.wooster.edu/themes/instructionaltechnology' );

$content_width = apply_filters( 'content_width', 580, 0, 910 );

/** Unregister 3-column site layouts */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

add_action( 'widgets_init', 'remove_header_right_widget_area' );
function remove_header_right_widget_area() {

    // Unregister Genesis Header Right widget area
    unregister_sidebar( 'header-right' );
}

remove_action( 'genesis_header', 'genesis_do_header' );

add_action( 'genesis_header', 'it_header' );
function it_header() {
	echo '<div id="title-area">';
	echo '<h1 class="logo"><a href="http://wooster.edu">WOOSTER</a></h1>';
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	echo '</div><!-- end #title-area -->';
}

/** Add new featured image sizes */
add_image_size('home-bottom', 150, 130, TRUE);
add_image_size('home-middle', 287, 120, TRUE);
add_image_size('home-featured', 870, 320, TRUE);
add_image_size('classroom-image', 600, 200, TRUE);
add_image_size('classroom-square', 100, 100, TRUE);
add_image_size('profile-picture-listing', 325, 183, TRUE);
add_image_size('profile-picture-single', 325, 183, TRUE);

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 90, 'textcolor' => 'ffffff', 'admin_header_callback' => 'instructionaltechnology_admin_style' ) );

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 */
function instructionaltechnology_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Shanti, arial, serif; min-height: %spx; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-family: Shanti, arial, serif; font-size: 48px; font-weight: normal; line-height: 48px; margin: 10px 0 0; text-align: center; text-decoration: none; text-shadow: #fff 1px 1px; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { color: #%s; font-family: Arial, Helvetica, Tahoma, sans-serif; font-size: 14px; font-style: italic; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register a custom post type for Staff */
add_action( 'init', 'create_itpeople_post_type' );

function create_itpeople_post_type() {
	$labels = array(
		'name' => _x('Staff', 'post type general name'),
		    'singular_name' => _x('Staff Member', 'post type singular name'),
		    'add_new' => _x('Add New', 'person'),
		    'add_new_item' => __('Add New Staff Member'),
		    'edit_item' => __('Edit Staff Member'),
		    'new_item' => __('New Staff Memeber'),
		    'all_items' => __('All Staff'),
		    'view_item' => __('View Staff Member'),
		    'search_items' => __('Search Staff'),
		    'not_found' =>  __('No staff found'),
		    'not_found_in_trash' => __('No staff found in Trash'), 
		    'parent_item_colon' => '',
		    'menu_name' => 'Staff'
	);
	$args = array(
		'labels' => $labels,
		'description' => 'A post type for entering staff information.',
		'public' => true,
		'hierarchical' => false,
		'supports' => array('thumbnail','excerpt'),
		'rewrite' => array('slug' => 'people'),
		'has_archive' => 'people',
	);
	register_post_type('itpeople',$args);
}

/** Customize the icon for the itpeople post type */
add_action('admin_head', 'set_staff_icon');
function set_staff_icon() {
	global $post_type;
	?>
	<style>
	<?php if (($_GET['post_type'] == 'itpeople') || ($post_type == 'itpeople')) : ?>
	#icon-edit { background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/icons32.png') no-repeat -600px -5px; }
	<?php endif; ?>
 
	#adminmenu #menu-posts-itpeople div.wp-menu-image{background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/menu.png') no-repeat scroll -300px -33px;}
	#adminmenu #menu-posts-itpeople:hover div.wp-menu-image,#adminmenu #menu-posts-itpeople.wp-has-current-submenu div.wp-menu-image{background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/menu.png') no-repeat scroll -300px -1px;}		
        </style>
        <?php
}

/** Remove support for Title and WYSIWYG editor on itpeople post type */
add_action('init', 'itpeople_custom_init');
	function itpeople_custom_init() {
		remove_post_type_support('itpeople', 'editor');
		remove_post_type_support('itpeople', 'title');
	}

/** Remove the role taxonomy from the itpeople post type screen */
add_action( 'admin_menu', 'remove_custom_taxonomy' );	
	function remove_custom_taxonomy() {
		remove_meta_box( 'tagsdiv-role', 'itpeople', 'side' );
	}

/** Create a custom taxonomy for itpeople post type */
add_action( 'init', 'create_role_taxonomy', 0 );
function create_role_taxonomy(){
	$labels = array(
	    'name' => _x( 'Roles', 'taxonomy general name' ),
	    'singular_name' => _x( 'Role', 'taxonomy singular name' ),
	    'search_items' =>  __( 'Search Roles' ),
	    'popular_items' => __( 'Popular Roles' ),
	    'all_items' => __( 'All Roles' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Role' ), 
	    'update_item' => __( 'Update Role' ),
	    'add_new_item' => __( 'Add New Role' ),
	    'new_item_name' => __( 'New Role Name' ),
	    'separate_items_with_commas' => __( 'Separate roles with commas' ),
	    'add_or_remove_items' => __( 'Add or remove roles' ),
	    'choose_from_most_used' => __( 'Choose from the most used roles' ),
	    'menu_name' => __( 'Role' ),
	  );

	register_taxonomy(  
    	'role',  
    	'itpeople',  
    		array(  
        	'hierarchical' => false,  
        	'labels' => $labels,  
        	'query_var' => true,  
        	'rewrite' => array( 'slug' => 'role', 'with_front' => false ),
    		)  
	);
}

/**
 * Create a custom Metabox for the classroom post type
 *
 * @link http://www.billerickson.net/wordpress-metaboxes/
 *
 */
add_action( 'cmb_render_taxonomy_multicheck_inline', 'it_cmb_render_taxonomy_multicheck_inline', 10, 2 );
function it_cmb_render_taxonomy_multicheck_inline( $field, $meta ) {
	echo '<ul class="cmb_radio_inline">';
	$names = wp_get_object_terms( $post->ID, $field['taxonomy'] );
	$terms = get_terms( $field['taxonomy'], 'hide_empty=0' );
	foreach ($terms as $term) {
		echo '<li class="cmb_radio_inline_option"><input type="checkbox" name="', $field['id'], '[]" id="', $field['id'], '" value="', $term->name , '"'; 
		foreach ($names as $name) {
			if ( $term->slug == $name->slug ){ echo ' checked="checked" ';};
		}
		echo' /><label>', $term->name , '</label></li>';
	}
}

/**
 * Create a custom metaboxes for the itpeople and itclassroom post types
 *
 * @link http://www.billerickson.net/wordpress-metaboxes/
 *
 */
add_filter( 'cmb_meta_boxes' , 'it_create_metaboxes' );
function it_create_metaboxes( $meta_boxes ) {
	$prefix = 'it_'; // start with an underscore to hide fields from custom fields list
	$meta_boxes[] = array(
		'id' => 'staff_info_metabox',
		'title' => 'Information',
		'pages' => array('itpeople'), // post type
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'First Name',
				'desc' => '',
				'id' => $prefix . 'first_name_text',
				'type' => 'text'
			),
			array(
				'name' => 'Last Name',
				'desc' => '',
				'id' => $prefix . 'last_name_text',
				'type' => 'text'
			),
			array(
				'name' => 'Title',
				'desc' => 'Your position title.',
				'id' => $prefix . 'title_text',
				'type' => 'text'
			),
			array(
				'name' => 'Office',
				'desc' => 'Your office number.',
				'id' => $prefix . 'office_text',
				'type' => 'text'
			),
			array(
				'name' => 'Phone Number',
				'desc' => 'Your campus phone number.',
				'id' => $prefix . 'phone_number_text',
				'type' => 'text'
			),
			array(
				'name' => 'e-mail Address',
				'desc' => 'Your campus e-mail.',
				'id' => $prefix . 'email_address_text',
				'type' => 'text'
			),
			array(
				'name' => 'Address',
				'desc' => 'Your campus address.',
				'id' => $prefix . 'address_textarea',
				'type' => 'textarea'
			),
			array(
				'name' => 'About Me',
				'desc' => 'Give a brief description about your technology interests and your duties.',
				'id' => $prefix . 'about_me_wysiwyg',
				'type' => 'wysiwyg',
				'options' => array(
					'wpautop' => true, // use wpautop?
					'media_buttons' => false, // show insert/upload button(s)
					'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
				),
			),
			array(
				'name' => 'Role',
				'desc' => '',
				'id' => $prefix . 'role_taxonomy_select',
				'taxonomy' => 'role', //Enter Taxonomy Slug
				'type' => 'taxonomy_select',	
			),
		),
	);
	
	return $meta_boxes;
}

/**
 * Initialize Metabox Class
 * see /lib/metabox/example-functions.php for more information
 *
 */
add_action( 'init', 'it_initialize_cmb_meta_boxes', 9999 );
function it_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( CHILD_DIR . '/lib/metabox/init.php' );
    }
}

/** Set the title from the first and last name for itpeople post type */
add_filter('title_save_pre', 'save_new_title');
function save_new_title($people_title) {
      if ($_POST['post_type'] == 'itpeople') :
           $fname = $_POST['it_first_name_text'];
           $lname = $_POST['it_last_name_text'];
           $fnamelname	= $fname.' '.$lname;
           $people_title = $fnamelname;
      endif;
      return $people_title;
}

/** Customize breadcrumb display */
add_filter( 'genesis_breadcrumb_args', 'it_breadcrumb_args' );
/**
 * Amend breadcrumb arguments.
 *
 * @author Gary Jones
 * @link http://dev.studiopress.com/modify-breadcrumb-display.htm
 *
 * @param array $args Default breadcrumb arguments
 * @return array Amended breadcrumb arguments
 */
function it_breadcrumb_args( $args ) {
	if ( is_post_type_archive('itpeople') ) {
		$args['sep'] = ' &#8594; ';
		$args['labels']['author']        = 'Articles written by ';
    		$args['labels']['category']      = ''; // Genesis 1.6 and later
    		$args['labels']['tag']           = '';
    		$args['labels']['date']          = 'Archives for ';
    		$args['labels']['search']        = 'Search for ';
    		$args['labels']['tax']           = '';
    		$args['labels']['post_type']     = '';
    		return $args;
	}
	elseif ( is_taxonomy('role') ) {
		$args['sep'] = ' &#8594; ';
    		$args['labels']['author']        = 'Articles written by ';
    		$args['labels']['category']      = ''; // Genesis 1.6 and later
    		$args['labels']['tag']           = '';
    		$args['labels']['date']          = 'Archives for ';
    		$args['labels']['search']        = 'Search for ';
    		$args['labels']['tax']           = '';
    		$args['labels']['post_type']     = '';
    		return $args;
	}
	else {
		$args['sep'] = ' &#8594; ';
		$args['labels']['author']        = 'Articles written by ';
    		$args['labels']['category']      = ''; // Genesis 1.6 and later
    		$args['labels']['tag']           = '';
    		$args['labels']['date']          = 'Archives for ';
    		$args['labels']['search']        = 'Search for ';
    		$args['labels']['tax']           = '';
    		$args['labels']['post_type']     = '';
		return $args;
	}
}

/** Add filter to ensure the text Staff Member, or staff member, is displayed when user updates a staff member */
add_filter('post_updated_messages', 'itpeople_updated_messages');
function itpeople_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['itpeople'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Staff Memeber updated. <a href="%s">View Staff Member</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Staff Member updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Staff Member restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Staff Memeber published. <a href="%s">View staff member</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Staff Member saved.'),
    8 => sprintf( __('Staff Member submitted. <a target="_blank" href="%s">Preview staff member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Staff Member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview staff member</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Staff Member draft updated. <a target="_blank" href="%s">Preview staff member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

/** Do not display child, grandchild, etc. posts when viewing a parent category and order by title in ascending order unless on the home screen or it-blog page */
add_action('pre_get_posts', 'no_child_posts');
function no_child_posts( $query) {
	global $wp_query;
	$id = $wp_query->get_queried_object_id();
	if ( !is_home() && !is_category( 'it-blog' ) ) {
		if ( $query->is_category ) {
			$query->set( 'category__in', array( $id ) );
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'asc' );
		}
		return $query;
	}
}

/*
*	Re-usable RSS feed reader with shortcode
*/
if ( !function_exists('base_rss_feed') ) {
	function base_rss_feed($size = 5, $feed = 'http://wordpress.org/news/feed/', $date = false, $cache_time = 1800)
	{
		// Include SimplePie RSS parsing engine
		include_once ABSPATH . WPINC . '/feed.php';
 
		// Set the cache time for SimplePie
		add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', "return cache_time;" ) );
 
		// Build the SimplePie object
		$rss = fetch_feed($feed);
 
		// Check for errors in the RSS XML
		if (!is_wp_error( $rss ) ) {
 
			// Set a limit for the number of items to parse
			$maxitems = $rss->get_item_quantity($size);
			$rss_items = $rss->get_items(0, $maxitems);
 
			// Store the total number of items found in the feed
			$i = 0;
			$total_entries = count($rss_items);
 
			// Output HTML
			$html = "<ul class='feedlist'>";
			foreach ($rss_items as $item) {
				$i++;
 
				// Add a class of "last" to the last item in the list
				if( $total_entries == $i ) {
					$last = " class='last'";
				} else {
					$last = "";
				}
 
				// Store the data we need from the feed
				$title = $item->get_title();
				$link = $item->get_permalink();
				$desc = $item->get_description();
				$date_posted = $item->get_date('F j, Y');
 
				// Output
				$html .= "<li id='post-$i'$last>";
				$html .= "<h3><a href='$link'>$title</a></h3>";
				if( $date == true ) $html .= "<span class='date'>$date_posted</span>";
				$html .= "<div class='rss-entry'>$desc</div>";
				$html .= "</li>";
			}
			$html .= "</ul>";
 
		} else {
 
			$html = "An error occurred while parsing your RSS feed. Check that it's a valid XML file.";
 
		}
 
		return $html;
	}
}
/** Define [rss] shortcode */
if( function_exists('base_rss_feed') && !function_exists('base_rss_shortcode') ) {
	function base_rss_shortcode($atts) {
		extract(shortcode_atts(array(
			'size' => '10',
			'feed' => 'http://wordpress.org/news/feed/',
			'date' => false,
		), $atts));
 
		$content = base_rss_feed($size, $feed, $date);
		return $content;
	}
	add_shortcode("rss", "base_rss_shortcode");
}

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'featured',
	'name'			=> __( 'Featured', 'instructionaltechnology' ),
	'description'	=> __( 'This is the featured section.', 'instructionaltechnology' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-1',
	'name'			=> __( 'Home Middle #1', 'instructionaltechnology' ),
	'description'	=> __( 'This is the first column of the home middle section.', 'instructionaltechnology' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-2',
	'name'			=> __( 'Home Middle #2', 'instructionaltechnology' ),
	'description'	=> __( 'This is the second column of the home middle section.', 'instructionaltechnology' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-3',
	'name'			=> __( 'Home Middle #3', 'instructionaltechnology' ),
	'description'	=> __( 'This is the third column of the home middle section.', 'instructionaltechnology' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom-1',
	'name'			=> __( 'Home Bottom #1', 'instructionaltechnology' ),
	'description'	=> __( 'This is the first column of the home bottom section.', 'instructionaltechnology' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom-2',
	'name'			=> __( 'Home Bottom #2', 'instructionaltechnology' ),
	'description'	=> __( 'This is the second column of the home bottom section.', 'instructionaltechnology' ),
) );