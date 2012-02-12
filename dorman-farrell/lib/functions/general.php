<?php
/**
 * General
 *
 * This file contains any general functions
 *
 * @package      dorman-farrell
 * @author       The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright    Copyright (c) 2012, Dorman Farrell
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Remove Menu Items
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 *
 */

function tpg_remove_menus () {
	global $menu;
	$restricted = array(__(''));
	// Example:
	//$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'tpg_remove_menus');

/**
 * Customize Menu Order
 *
 * @param array $menu_ord. Current order.
 * @return array $menu_ord. New order.
 *
 */

function tpg_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		'index.php', // this represents the dashboard link
		'edit.php?post_type=page', //the page tab
		'edit.php', //the posts tab
		'edit-comments.php', // the comments tab
		'upload.php', // the media manager
    );
}
add_filter( 'custom_menu_order', 'tpg_custom_menu_order' );
add_filter( 'menu_order', 'tpg_custom_menu_order' );

/**
 * Customize columns on staff post type
 *
 * @author Jon Breitenbuhcer
 *
 */

function tpg_staff_columns($defaults) {
    $defaults['role'] = 'Role';
    return $defaults;
}
function tpg_staff_custom_column($column_name, $post_id) {
    $taxonomy = $column_name;
    $post_type = get_post_type($post_id);
    $terms = get_the_terms($post_id, $taxonomy);
 
    if ( !empty($terms) ) {
        foreach ( $terms as $term )
            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
        echo join( ', ', $post_terms );
    }
    else echo '<i>No terms.</i>';
}
add_filter( 'manage_staff_posts_columns', 'tpg_staff_columns' );
add_action('manage_staff_posts_custom_column', 'tpg_staff_custom_column', 10, 2);

/**
 * Customize posts_per_page on staff archive pages
 *
 * @author Jon Breitenbuhcer
 *
 */

function tpg_change_staff_size($query) {
	if ( $query->is_main_query() && !is_admin() && is_post_type_archive('staff') ){ // Make sure it is a archive page
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$query->set( 'posts_per_page', genesis_get_option('tpg_staff_posts_per_page', TPG_SETTINGS_FIELD ) );
		$query->set('paged', $paged); // Set the post archive to be paged
	}
}
add_filter('pre_get_posts', 'tpg_change_staff_size'); // Hook our custom function onto the request filter

/**
 * Customize posts_per_page on role taxonomy pages
 *
 * @author Jon Breitenbuhcer
 *
 */

function tpg_tax_filter_posts_per_page( $value ) {
	if (!is_admin()) {
		return (is_tax('role')) ? genesis_get_option('tpg_staff_posts_per_page', TPG_SETTINGS_FIELD ) : $value;
	}
}
add_filter( 'option_posts_per_page', 'tpg_tax_filter_posts_per_page' );

/**
 * Customize staff post type icon
 *
 * @author Jon Breitenbuhcer
 *
 */

function set_staff_icon() {
	global $post_type;
	?>
	<style>
	<?php if (($_GET['post_type'] == 'staff') || ($post_type == 'staff')) : ?>
	#icon-edit { background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/icons32.png') no-repeat -600px -5px; }
	<?php endif; ?>
 
	#adminmenu #menu-posts-staff div.wp-menu-image{background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/menu.png') no-repeat scroll -300px -33px;}
	#adminmenu #menu-posts-staff:hover div.wp-menu-image,#adminmenu #menu-posts-staff.wp-has-current-submenu div.wp-menu-image{background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/menu.png') no-repeat scroll -300px -1px;}		
        </style>
        <?php
}
add_action('admin_head', 'set_staff_icon');

/**
 * Remove support for Title and WYSIWYG editor on staff post type
 *
 * @author The Pedestal Group
 *
 */

function tpg_staff_custom_init() {
	remove_post_type_support('staff', 'editor');
	remove_post_type_support('staff', 'title');
}
add_action('init', 'tpg_staff_custom_init');

/**
 * Remove the role taxonomy from the staff post type screen
 *
 * @author The Pedestal Group
 *
 */

function tpg_remove_custom_taxonomy() {
	remove_meta_box( 'tagsdiv-role', 'staff', 'side' );
}
add_action( 'admin_menu', 'tpg_remove_custom_taxonomy' );

/**
 * Set the title from the first and last name for staff post type
 *
 * @author The Pedestal Group
 *
 */

function tpg_save_new_title($people_title) {
      if ($_POST['post_type'] == 'staff') :
           $fname = $_POST['tpg_first_name_text'];
           $lname = $_POST['tpg_last_name_text'];
           $fnamelname	= $fname.' '.$lname;
           $people_title = $fnamelname;
      endif;
      return $people_title;
}
add_filter('title_save_pre', 'tpg_save_new_title');

/**
 * Add filter to ensure the text Staff Member, or staff member, is displayed
 * when user updates a staff member
 *
 * @author The Pedestal Group
 *
 */

function tpg_staff_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['staff'] = array(
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
add_filter('post_updated_messages', 'tpg_staff_updated_messages');

/**
 * Do not display child, grandchild, etc. posts when viewing a parent category
 * and order by title in ascending order unless on the home screen or designated
 * blog page
 *
 * @author The Pedestal Group
 *
 */

function tpg_no_child_posts( $query) {
	global $wp_query;
	$id = $wp_query->get_queried_object_id();
	if ( !is_home() && !is_category( genesis_get_option( 'tpg_blog_cat', TPG_SETTINGS_FIELD ) ) ) {
		if ( $query->is_category ) {
			$query->set( 'category__in', array( $id ) );
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'asc' );
		}
		return $query;
	}
}
add_action('pre_get_posts', 'tpg_no_child_posts');

/**
 * Customize the post info function
 *
 * @author The Pedestal Group
 *
 */

function tpg_post_info_filter($post_info) {
if (!is_page()) {
    $post_info = '[post_date] [post_edit]';
    return $post_info;
}}
add_filter( 'genesis_post_info', 'tpg_post_info_filter' );

/**
 * Customize the next post link text
 *
 * @author The Pedestal Group
 *
 */

function tpg_next_post_link_text(){
	$next = 'Next &rarr;';
	return $next;
}
add_filter('genesis_next_link_text','tpg_next_post_link_text');

/**
 * Customize the previous post link text
 *
 * @author The Pedestal Group
 *
 */

function tpg_previous_post_link_text(){
	$previous = '&larr; Previous';
	return $previous;
}
add_filter('genesis_prev_link_text','tpg_previous_post_link_text');

/**
 * Remove Header Right Widget
 *
 * @author The Pedestal Group
 */

function tpg_remove_sidebars() {
	unregister_sidebar( 'header-right' );
	unregister_sidebar( 'sidebar-alt' );
	unregister_sidebar( 'sidebar' );
}

/**
 * Technology Header
 *
 * @author The Pedestal Group
 */

function tpg_header() {
	echo '<div id="title-area">';
	printf('<a id="box-link" href="%s"></a>', get_bloginfo('url'));
	echo '</div><!-- end #title-area -->';
}

/**
 * Amend breadcrumb arguments.
 *
 * @author Gary Jones
 * @link http://dev.studiopress.com/modify-breadcrumb-display.htm
 *
 * @param array $args Default breadcrumb arguments
 * @return array Amended breadcrumb arguments
 */
function tech_breadcrumb_args( $args ) {
	if ( is_post_type_archive('staff') ) {
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

// Customize the credits
add_filter('genesis_footer_creds_text', 'custom_footer_creds_text');
function custom_footer_creds_text($creds) {
    $creds = '&copy; ' . date("Y") . '. All Rights Reserved. Dorman Farrell, LLC | <a href="' . get_bloginfo( 'url' ) . '/about/licenses/">Licenses</a>';
    return $creds;
}

// Add Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'add_viewport_meta_tag' );
function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}