<?php
/**
 * General
 *
 * This file contains any general functions
 *
 * @package      technology
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright    Copyright (c) 2012, The College of Wooster
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

/**
 * Remove Menu Items
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_remove_menus () {
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
add_action('admin_menu', 'tech_remove_menus');

/**
 * Customize Menu Order
 *
 * @author      Bill Erickson
 * @param       array $menu_ord. Current order.
 * @return      array $menu_ord. New order.
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		'index.php', // this represents the dashboard link
		'edit.php?post_type=page', //the page tab
		'edit.php', //the posts tab
		'edit-comments.php', // the comments tab
		'upload.php', // the media manager
	);
}
add_filter( 'custom_menu_order', 'tech_custom_menu_order' );
add_filter( 'menu_order', 'tech_custom_menu_order' );

/**
 * Customize columns on itpeople post type
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       array $defualts default columns
 * @return      array $defaults modified columns
 * @version     SVN: $Id$
 * @since       2.0
 *
 */

function tech_itpeople_columns($defaults) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Name' ),
		'role' => __( 'Role' ),
		'date' => __( 'Date' )
	);

	return $columns;
}

/**
 * Add the terms for the role taxonomy to the Role column
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       $column_name
 * @param       $post_id
 * @return      html
 * @version     SVN: $Id$
 * @since       2.0
 *
 */
 
function tech_manage_itpeople_columns( $column_name, $post_id ) {
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

/**
 * Designate the Name column as sortable
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       array $columns
 * @return      array $columns
 * @version     SVN: $Id$
 * @since       2.0
 *
 */
 
function tech_itpeople_sortable_columns( $columns ) {

	$columns['title'] = 'title';
	return $columns;
}

/**
 * Make the Name column sortable
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       array $query
 * @return      array $query
 * @version     SVN: $Id$
 * @since       2.0
 *
 */
 
function tech_name_column_orderby( $query ) {
	if( is_admin() ) {
		if (isset($query->query_vars['post_type'])) {
			if ($query->query_vars['post_type'] == 'itpeople') {

				$query->set('meta_key', 'it_last_name_text');
				$query->set('orderby', 'meta_value');
			}
		}
	}
}
add_filter( 'manage_itpeople_posts_columns', 'tech_itpeople_columns' );
add_action( 'manage_itpeople_posts_custom_column', 'tech_manage_itpeople_columns', 10, 2 );
add_filter( 'manage_edit-movie_sortable_columns', 'tech_itpeople_sortable_columns' );
add_filter( 'parse_query', 'tech_name_column_orderby' );

/*
 * Description: Adds a taxonomy filter in the admin list page for a custom post type.
 * Written for: http://yoast.com/custom-post-type-snippets/
 * By: Joost de Valk - http://yoast.com/about-me/
*/

/**
 * Filter the request to just give posts for the given taxonomy, if applicable.
 *
 * @author      yoast
 * @version     SVN: $Id$
 * @since       2.0
 *
 */

function tech_taxonomy_filter_restrict_manage_posts() {
	global $typenow;

	// If you only want this to work for your specific post type,
	// check for that $type here and then return.
	// This function, if unmodified, will add the dropdown for each
	// post type / taxonomy combination.

	$post_types = get_post_types( array( '_builtin' => false ) );

	if ( in_array( $typenow, $post_types ) ) {
		$filters = get_object_taxonomies( $typenow );

		foreach ( $filters as $tax_slug ) {
			$tax_obj = get_taxonomy( $tax_slug );
			wp_dropdown_categories( array(
				'show_option_all' => __('Show All '.$tax_obj->label ),
				'taxonomy'	  => $tax_slug,
				'name'		  => $tax_obj->name,
				'orderby'	  => 'name',
				'selected'	  => $_GET[$tax_slug],
				'hierarchical'	  => $tax_obj->hierarchical,
				'show_count'	  => false,
				'hide_empty'	  => true
			) );
		}
	}
}
add_action( 'restrict_manage_posts', 'tech_taxonomy_filter_restrict_manage_posts' );

/**
 * Add a filter to the query so the dropdown will actually work.
 *
 * @author      yoast
 * @version     SVN: $Id$
 * @since       2.0
 *
 */

function tech_taxonomy_filter_post_type_request( $query ) {
  global $pagenow, $typenow;

  if ( 'edit.php' == $pagenow ) {
	$filters = get_object_taxonomies( $typenow );
	foreach ( $filters as $tax_slug ) {
	  $var = &$query->query_vars[$tax_slug];
	  if ( isset( $var ) ) {
		$term = get_term_by( 'id', $var, $tax_slug );
		$var = $term->slug;
	  }
	}
  }
}
add_filter( 'parse_query', 'tech_taxonomy_filter_post_type_request' );

/**
 * Customize posts_per_page on itpeople archive pages
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       array $query
 * @return      array $query
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function change_tech_itpeople_size( $query ) {
	if ( $query->is_main_query() && !is_admin() && is_post_type_archive( 'itpeople' ) ) { // Make sure it is a archive page
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$query->set( 'posts_per_page', genesis_get_option( 'technology_staff_posts_per_page', IT_SETTINGS_FIELD ) );
		$query->set( 'paged', $paged ); // Set the post archive to be paged
	}
}
add_filter( 'pre_get_posts', 'change_tech_itpeople_size' ); // Hook our custom function onto the request filter

/**
 * Customize posts_per_page on role taxonomy pages
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       int $value
 * @return      int $value
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_tax_filter_posts_per_page( $value ) {
	if ( !is_admin() ) {
		return ( is_tax( 'role' ) ) ? genesis_get_option( 'technology_staff_posts_per_page', IT_SETTINGS_FIELD ) : $value;
	}
}
add_filter( 'option_posts_per_page', 'tech_tax_filter_posts_per_page' );

/**
 * Customize itpeople post type icon
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function set_staff_icon() {
	global $post_type;
	?>
	<style>
	<?php if ((isset($_GET['post_type']) && $_GET['post_type'] == 'itpeople') || ($post_type == 'itpeople')) : ?>
	#icon-edit { background:transparent url('<?php echo home_url('url');?>/wp-admin/images/icons32.png') no-repeat -600px -5px; }
	<?php endif; ?>
 
	#adminmenu #menu-posts-itpeople div.wp-menu-image{background:transparent url('<?php echo home_url('url');?>/wp-admin/images/menu.png') no-repeat scroll -300px -33px;}
	#adminmenu #menu-posts-itpeople:hover div.wp-menu-image,#adminmenu #menu-posts-itpeople.wp-has-current-submenu div.wp-menu-image{background:transparent url('<?php echo home_url('url');?>/wp-admin/images/menu.png') no-repeat scroll -300px -1px;}		
		</style>
		<?php
}
add_action( 'admin_head', 'set_staff_icon' );

/**
 * Remove support for Title and WYSIWYG editor on itpeople post type
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_itpeople_custom_init() {
	remove_post_type_support( 'itpeople', 'editor' );
	remove_post_type_support( 'itpeople', 'title' );
}
add_action( 'init', 'tech_itpeople_custom_init' );

/**
 * Remove the role and expertise taxonomies from the itpeople post type screen
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_remove_custom_taxonomy() {
	remove_meta_box( 'tagsdiv-role', 'itpeople', 'side' );
	remove_meta_box( 'tagsdiv-expertise', 'itpeople', 'side' );
}
add_action( 'admin_menu', 'tech_remove_custom_taxonomy' );

/**
 * Set the title from the first and last name for itpeople post type
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       string $people_title
 * @return      string $people_title
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_save_new_title( $people_title ) {
	  if ($_POST['post_type'] == 'itpeople') :
		   $fname = $_POST['it_first_name_text'];
		   $lname = $_POST['it_last_name_text'];
		   $fnamelname	= $fname.' '.$lname;
		   $people_title = $fnamelname;
	  endif;
	  return $people_title;
}
add_filter( 'title_save_pre', 'tech_save_new_title' );

/**
 * Add filter to ensure the text Staff Member, or staff member, is displayed
 * when user updates a staff member
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       array $messages
 * @return      array $messages
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_itpeople_updated_messages( $messages ) {
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
add_filter( 'post_updated_messages', 'tech_itpeople_updated_messages' );

/**
 * Do not display child, grandchild, etc. posts when viewing a parent category
 * and order by title in ascending order unless on the home screen or designated
 * blog page
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       array $query default query arguments
 * @return      array modified query arguments
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_no_child_posts( $query ) {
	global $wp_query;
	$id = $wp_query->get_queried_object_id();
	if ( !is_home() && !is_category( genesis_get_option( 'technology_blog_cat', IT_SETTINGS_FIELD ) ) ) {
		if ( $query->is_category ) {
			$query->set( 'category__in', array( $id ) );
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'asc' );
		}
		return $query;
	}
}
add_action( 'pre_get_posts', 'tech_no_child_posts' );

/**
 * Make sure to order staff on role term pages alphabetically by last name
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       array $query default query arguments
 * @return      array modified query arguments
 * @version     SVN: $Id$
 * @since       2.0
 *
 */

function tech_staff_alpha_order_posts( $query ) {

	if ( $query->is_main_query() && !is_admin() && is_tax( 'role' ) && !is_page_template( 'page-itpeople.php' ) ) {
		$query->set( 'meta_key', 'it_last_name_text' );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'ASC' );
		return $query;
	}
}
add_action('pre_get_posts', 'tech_staff_alpha_order_posts');

/**
 * Customize the post info function
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @param       string $post_info
 * @return      string $post_info
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function post_info_filter( $post_info ) {
if ( !is_page() ) {
	$post_info = '[post_date] [post_edit]';
	return $post_info;
}}
add_filter( 'genesis_post_info', 'post_info_filter' );

/**
 * Customize the next post link text
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_next_post_link_text() {
	$next = 'Next &rarr;';
	return $next;
}
add_filter( 'genesis_next_link_text','tech_next_post_link_text' );

/**
 * Customize the previous post link text
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_previous_post_link_text() {
	$previous = '&larr; Previous';
	return $previous;
}
add_filter('genesis_prev_link_text','tech_previous_post_link_text');

/**
 * Remove Header Right Widget
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_remove_sidebars() {
	unregister_sidebar( 'header-right' );
	unregister_sidebar( 'sidebar-alt' );
}

/**
 * Technology Header
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_header() {
	echo '<div class="title-area">';
		echo '<div class="logo">';
		echo '<a href="http://wooster.edu"><img src="'. get_stylesheet_directory_uri() .'/images/wooster/logotype_gold.gif" alt="Wooster" /></a>';
		echo '</div><!-- end .logo -->';
		echo '<div class="title-wrap">';
			do_action( 'genesis_site_title' );
			do_action( 'genesis_site_description' );
		echo '</div><!-- end .title-wrap -->';
	echo '</div><!-- end .title-area -->';
}

/**
 * Technology Structure Begin
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       2.0
 *
 */

function tech_structure_begin() {
	echo '<div id="structure">';
}

/**
 * Technology Structure End
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       2.0
 *
 */

function tech_structure_end() {
	echo '</div>';
}

/**
 * Amend breadcrumb arguments.
 *
 * @author      Gary Jones
 * @link        http://dev.studiopress.com/modify-breadcrumb-display.htm
 * @param       array $args Default breadcrumb arguments
 * @return      array Amended breadcrumb arguments
 * @version     SVN: $Id$
 * @since       1.0
 *
 */
function tech_breadcrumb_args( $args ) {
	if ( is_post_type_archive('itpeople') ) {
		$args['sep'] = ' &#8594; ';
		$args['labels']['author']		 = 'Articles written by ';
			$args['labels']['category']		 = ''; // Genesis 1.6 and later
			$args['labels']['tag']			 = '';
			$args['labels']['date']			 = 'Archives for ';
			$args['labels']['search']		 = 'Search for ';
			$args['labels']['tax']			 = '';
			$args['labels']['post_type']	 = '';
			return $args;
	}
	elseif ( is_tax('role') ) {
		$args['sep'] = ' &#8594; ';
			$args['labels']['author']		 = 'Articles written by ';
			$args['labels']['category']		 = ''; // Genesis 1.6 and later
			$args['labels']['tag']			 = '';
			$args['labels']['date']			 = 'Archives for ';
			$args['labels']['search']		 = 'Search for ';
			$args['labels']['tax']			 = '';
			$args['labels']['post_type']	 = '';
			return $args;
	}
	else {
		$args['sep'] = ' &#8594; ';
		$args['labels']['author']		 = 'Articles written by ';
			$args['labels']['category']		 = ''; // Genesis 1.6 and later
			$args['labels']['tag']			 = '';
			$args['labels']['date']			 = 'Archives for ';
			$args['labels']['search']		 = 'Search for ';
			$args['labels']['tax']			 = '';
			$args['labels']['post_type']	 = '';
		return $args;
	}
}

function add_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

/** Customize the entire footer
*/
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'it_custom_footer' );
function it_custom_footer() {
	?>
	<div class="footerimages">
	<div class="logotype">
		<?php echo '<img src="'. get_stylesheet_directory_uri() .'/images/wooster/wordmark.gif" alt="The College of Wooster - Independent Minds. Working Together" width="200" height="70" />'?>
	</div>
</div>
<div class="footernav">
	<ul>
		<li><a href="http://wooster.edu/about/visit/">Maps &amp; Directions</a>&nbsp;|&nbsp;</li>
		<li><a href="http://wooster.edu/offices/hr/opportunities/">Employment</a>&nbsp;|&nbsp;</li>
		<li><a href="http://wooster.edu/about/contact/">Contact Us</a>&nbsp;|&nbsp;</li>
		<li><a href="http://wooster.edu/offices/web/terms/">Terms &amp; Conditions</a>&nbsp;|&nbsp;</li>
		<li><a href="http://email.wooster.edu">Email</a>&nbsp;|&nbsp;</li>
		<li><a href="http://scotweb.wooster.edu">ScotWeb</a>&nbsp;|&nbsp;</li>
		<li><a href="http://scotblogs.wooster.edu">ScotBlogs</a>&nbsp;|&nbsp;</li>
		<li><a href="http://wooster.edu/academics/libraries/">Libraries</a>&nbsp;|&nbsp;</li>
		<li><a href="http://whn.sites.wooster.edu">WHN</a></li>
	</ul>
</div>
<div class=​"footercontact">
	1189 Beall Avenue, Wooster, Ohio 44691. (330) 263-2000 &copy;<?php echo date("Y") ?> The College of Wooster. All Rights Reserved.
<div>
	<?php
}

/**
 * YouTube Video page template.
 *
 * @author      Tammy Hart
 * @link        http://wp.tutsplus.com/tutorials/theme-development/create-a-youtube-videos-page-template-from-an-rss-feed/
 * @param       string $uri Feed URL
 * @return      string YouTube video ID
 * @version     SVN: $Id$
 * @since       2.01
 *
 */
function wptuts_get_yt_ID( $uri ) {
 
    // how long YT ID's are
    $id_len = 11;
 
    // where to start looking
    $id_begin = strpos( $uri, '?v=' );
    // if the id isn't at the beginning of the uri for some reason
    if( $id_begin === FALSE )
        $id_begin = strpos( $uri, "&v=" );
    // all else fails
    if( $id_begin === FALSE )
        wp_die( 'YouTube video ID not found. Please double-check your URL.' );
    // now go to the proper start
    $id_begin +=3;
 
    // get the ID
    $yt_ID = substr( $uri, $id_begin, $id_len);
 
    return $yt_ID;
}
add_action( 'wp_enqueue_scripts', 'wptuts_enqueue_video_js' );
function wptuts_enqueue_video_js() {
    if ( is_page_template( 'page-videos.php' ) )
        wp_enqueue_script( 'video_js', get_template_directory_uri() . 'lib/js/video.js', array( 'jquery' ) );
}

function cat_desc (){
if(is_category('Microsoft Office 365')){
?>
<div class="office-365-description"><?php echo category_description( $category ); ?></div>
<?php } }
add_action('genesis_before_loop', 'cat_desc');