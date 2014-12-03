<?php
/**
 * Functions
 *
 * This file registers any custom functions
 *
 * @package     mcedc
 * @author      The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright   Copyright (c) 2012, Medina County Economic Development Corporation
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Remove Menu Items
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 *
 */

function mcedc_remove_menus () {
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
add_action('admin_menu', 'mcedc_remove_menus');

/**
 * Customize Menu Order
 *
 * @param array $menu_ord. Current order.
 * @return array $menu_ord. New order.
 *
 */

function mcedc_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;
    return array(
        'index.php', // this represents the dashboard link
        'edit.php?post_type=page', //the page tab
        'edit.php', //the posts tab
        'edit-comments.php', // the comments tab
        'upload.php', // the media manager
    );
}
add_filter( 'custom_menu_order', 'mcedc_custom_menu_order' );
add_filter( 'menu_order', 'mcedc_custom_menu_order' );

/**
 * Add a Role column on the Staff admin page
 *
 * @param array $posts_columns
 * @return array $new_posts_columns
 *
 * @author The Pedestal Group
 *
 */

function mcedc_add_roles_column_to_staff_list( $posts_columns ) {
    if (!isset($posts_columns['author'])) {
        $new_posts_columns = $posts_columns;
    } else {
        $new_posts_columns = array();
        $index = 0;
        foreach($posts_columns as $key => $posts_column) {
            if ($key=='author') {
            $new_posts_columns['role'] = null;
            }
            $new_posts_columns[$key] = $posts_column;
        }
    }
    $new_posts_columns['role'] = 'Roles';
    $new_posts_columns['author'] = __('Author');
    return $new_posts_columns;
}

/**
 * Display roles for a staff member in the Roles column
 *
 * @param $column_id, $post_id
 * @return $roles
 *
 * @author The Pedestal Group
 *
 */

function mcedc_show_role_column_for_staff_list( $column_id,$post_id ) {
    global $typenow;
    if ($typenow=='staff') {
        $taxonomy = 'role';
        switch ($column_id) {
        case 'role':
            $roles = get_the_terms($post_id,$taxonomy);
            if (is_array($roles)) {
                foreach($roles as $key => $role) {
                    $edit_link = get_term_link($role,$taxonomy);
                    $roles[$key] = '<a href="'.$edit_link.'">' . $role->name . '</a>';
                }
                echo implode(' | ',$roles);
            }
            break;
        }
    }
}
add_filter( 'manage_staff_posts_columns', 'mcedc_add_roles_column_to_staff_list' );
add_filter('manage_staff_posts_custom_column', 'mcedc_show_role_column_for_staff_list', 10, 2);

/*
Description: Adds a taxonomy filter in the admin list page for a custom post type.
Written for: http://wordpress.stackexchange.com/posts/582/
By: Mike Schinkel - http://mikeschinkel.com/custom-workpress-plugins
*/

/**
 * Setup drop down for filtering according to role.
 *
 * @author chodorowicz
 *
 */
function mcedc_restrict_staff_by_role() {
global $typenow;
    $args=array( 'public' => true, '_builtin' => false ); 
    $post_types = get_post_types($args);
    if ( in_array($typenow, $post_types) ) {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            wp_dropdown_categories(array(
                'show_option_all' => __('Show All '.$tax_obj->label ),
                'taxonomy' => $tax_slug,
                'name' => $tax_obj->name,
                'orderby' => 'term_order',
                'selected' => $_GET[$tax_obj->query_var],
                'hierarchical' => $tax_obj->hierarchical,
                'show_count' => false,
                'hide_empty' => true
                )
            );
        }
    }
}
add_action('restrict_manage_posts','mcedc_restrict_staff_by_role');

/**
 * Convert taxonomy ID to slug
 *
 * @param array $query
 * @return array $var
 * @author chodorowicz
 *
 */
function mcedc_convert_role_id_to_taxonomy_term_in_query($query) {
global $pagenow;
    global $typenow;
        if ($pagenow=='edit.php') {
            $filters = get_object_taxonomies($typenow);
                foreach ($filters as $tax_slug) {
                    $var = &$query->query_vars[$tax_slug];
                        if ( isset($var) ) {
                            $term = get_term_by('id',$var,$tax_slug);
                            $var = $term->slug;
                        }
                }
        }
}
add_filter('parse_query','mcedc_convert_role_id_to_taxonomy_term_in_query');

/**
 * Register the Role column as sortable
 *
 * @param array $columns
 * @return array $columns
 * @author The Pedestal Group
 *
 */
function mcedc_role_column_register_sortable( $columns ) {
    $columns['role'] = 'role';
 
    return $columns;
}
add_filter( 'manage_edit-staff_sortable_columns', 'mcedc_role_column_register_sortable' );

/**
 * Set up orderby role
 *
 * @param array $vars
 * @return array $vars
 * @author The Pedestal Group
 *
 */
function mcedc_role_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'role' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'mcedc_role_taxonomy_select',
            'orderby' => 'meta_value'
        ) );
    }
 
    return $vars;
}
add_filter( 'request', 'mcedc_role_column_orderby' );

/**
 * Customize posts_per_page on staff archive pages
 *
 * @param array $query
 * @return array $query
 *
 * @author The Pedestal Group
 *
 */

function mcedc_change_staff_size($query) {
    if ( $query->is_main_query() && !is_admin() && is_post_type_archive('staff') ){ // Make sure it is a archive page
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query->set( 'posts_per_page', genesis_get_option('mcedc_staff_posts_per_page', MCEDC_SETTINGS_FIELD ) );
        $query->set('paged', $paged); // Set the post archive to be paged
    }
}
add_filter('pre_get_posts', 'mcedc_change_staff_size'); // Hook our custom function onto the request filter

/**
 * Customize posts_per_page on role taxonomy pages
 *
 * @param $value
 *
 * @author The Pedestal Group
 *
 */

function mcedc_tax_filter_posts_per_page( $value ) {
    if (!is_admin()) {
        return (is_tax('role')) ? genesis_get_option('mcedc_staff_posts_per_page', MCEDC_SETTINGS_FIELD ) : $value;
    }
}
add_filter( 'option_posts_per_page', 'mcedc_tax_filter_posts_per_page' );

/**
 * Customize staff post type icon
 *
 * @author The Pedestal Group
 *
 */

function set_staff_icon() {
    global $post_type;
    ?>
    <style>
    <?php if ((isset($_GET['post_type']) && $_GET['post_type'] == 'staff') || ($post_type == 'staff')) : ?>
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

function mcedc_staff_custom_init() {
    remove_post_type_support('staff', 'editor');
    remove_post_type_support('staff', 'title');
}
add_action('init', 'mcedc_staff_custom_init');

/**
 * Remove the role taxonomy from the staff post type screen
 *
 * @author The Pedestal Group
 *
 */

function mcedc_remove_custom_taxonomy() {
    remove_meta_box( 'tagsdiv-role', 'staff', 'side' );
	remove_meta_box( 'tagsdiv-industry', 'staff', 'side' );
}
add_action( 'admin_menu', 'mcedc_remove_custom_taxonomy' );

/**
 * Set the title from the first and last name for staff post type
 *
 * @param $people_title
 * @return $people_title
 *
 * @author The Pedestal Group
 *
 */

function mcedc_save_new_title($people_title) {
      if ($_POST['post_type'] == 'staff') :
           $fname = $_POST['mcedc_first_name_text'];
           $lname = $_POST['mcedc_last_name_text'];
           $fnamelname  = $fname.' '.$lname;
           $people_title = $fnamelname;
      endif;
      return $people_title;
}
add_filter('title_save_pre', 'mcedc_save_new_title');

/**
 * Add filter to ensure the text Staff Member, or staff member, is displayed
 * when user updates a staff member
 *
 * @param array $messages
 * @return array $messages
 *
 * @author The Pedestal Group
 *
 */

function mcedc_staff_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['staff'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Person updated. <a href="%s">View Person</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Person updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Person restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Person published. <a href="%s">View person</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Person saved.'),
    8 => sprintf( __('Person submitted. <a target="_blank" href="%s">Preview person</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Person scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview person</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Person draft updated. <a target="_blank" href="%s">Preview person</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}
add_filter('post_updated_messages', 'mcedc_staff_updated_messages');

/**
 * Do not display child, grandchild, etc. posts when viewing a parent category
 * and order by title in ascending order unless on the home screen or designated
 * blog page
 *
 * @param array $query
 * @return modified $query
 *
 * @author The Pedestal Group
 *
 */

function mcedc_no_child_posts( $query) {
    global $wp_query;
    $id = $wp_query->get_queried_object_id();
    if ( !is_home() && !is_category( genesis_get_option( 'mcedc_blog_cat', MCEDC_SETTINGS_FIELD ) ) ) {
        if ( $query->is_category ) {
            $query->set( 'category__in', array( $id ) );
            $query->set( 'orderby', 'title' );
            $query->set( 'order', 'asc' );
        }
        return $query;
    }
}
add_action('pre_get_posts', 'mcedc_no_child_posts');

/**
 * Customize the post info function
 *
 * @param $post_info
 * @return modified $post_info
 *
 * @author The Pedestal Group
 *
 */

function mcedc_post_info_filter($post_info) {
if (!is_page()) {
    $post_info = '[post_date] [post_edit]';
    return $post_info;
}}
add_filter( 'genesis_post_info', 'mcedc_post_info_filter' );

/**
 * Customize the next post link text
 *
 * @author The Pedestal Group
 *
 */

function mcedc_next_post_link_text(){
    $next = 'Next &rarr;';
    return $next;
}
add_filter('genesis_next_link_text','mcedc_next_post_link_text');

/**
 * Customize the previous post link text
 *
 * @author The Pedestal Group
 *
 */

function mcedc_previous_post_link_text(){
    $previous = '&larr; Previous';
    return $previous;
}
add_filter('genesis_prev_link_text','mcedc_previous_post_link_text');

/**
 * Remove Header Right Widget
 *
 * @author The Pedestal Group
 */

function mcedc_remove_sidebars() {
    unregister_sidebar( 'header-right' );
    unregister_sidebar( 'sidebar-alt' );
}

/**
 * Technology Header
 *
 * @author The Pedestal Group
 */

function mcedc_header() {
    echo '<div id="header-left">';
        echo '<div id="title-area">';
            printf('<a id="box-link" href="%s"></a>', get_bloginfo('url'));
            echo '</div><!-- end #title-area -->';
    echo '</div><!-- end #header-left -->';

    echo '<div id="header-right">';
        //echo '<div id="news" class="ribbon">';
            //printf('<a href="%s/category/%s"><img src="%s/images/news.png" /></a>', get_bloginfo('url'), genesis_get_option('mcedc_blog_cat', MCEDC_SETTINGS_FIELD ), get_stylesheet_directory_uri());
        //echo '</div><!-- end #news -->';
    
        echo '<div id="search" class="widget widget_search">';
            echo '<div class="widget-wrap">';
                echo '<form method="get" class="searchform" action="'. get_bloginfo('url') . '/" >';
                    echo '<input type="text" value="" name="s" class="s" onfocus="if (this.value == \'\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'\';}" />';
                    echo '<input type="submit" class="searchsubmit" value="Search" />';
                echo '</form>';
                //echo '<p class="contact"><a href="/contact" alt="contact">contact</a></p>';
            echo '</div>';
        echo '</div><!-- end #search -->';
    
        echo '<div id="social" class="social">';
            echo '<a href="http://www.linkedin.com/in/' . genesis_get_option('mcedc_linkedin', MCEDC_SETTINGS_FIELD ) . '" alt="Linked In" class="linkedin"><img src="' . get_stylesheet_directory_uri() . '/images/linkedin-icon.png" /></a>';
            echo '<a href="https://twitter.com/' . genesis_get_option('mcedc_twitter', MCEDC_SETTINGS_FIELD ) . '" alt="Twitter" class="twitter"><img src="' . get_stylesheet_directory_uri() . '/images/twitter-icon.png" /></a>';
        echo '</div><!-- end #social -->';
    echo '</div><!-- end #header-right -->';
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
    $creds = '&copy; ' . date("Y") . '   <a href="'. get_bloginfo( 'url' ) .'">Medina County Economic Development Corporation</a>   |   Content management systems by <a href="http://thepedestalgroup.com">The Pedestal Group</a>';
    return $creds;
}
// Customize the credits
add_filter('genesis_footer_backtotop_text', 'custom_footer_backtotop_text');
function custom_footer_backtotop_text($backtotop) {
    $backtotop = '144 N. Broadway Street, Medina, OH 44256   |   330.722.9215   | ';
    return $backtotop;
}

function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

function mcedc_admin_head() {
        echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/css/wp-admin.css">';
}

function mcedc_sidebar_bottom() {
	echo '<div id="partners" class="widget widget_text">';
		echo '<div class="widget-wrap">';
			echo '<h4 class="widgettitle">Our Partners</h4>';
				echo '<div class="logos">';
        			echo '<div class="logo-one">';
            			echo  '<a href="http://jobs-ohio.com/"><img src="' . get_stylesheet_directory_uri() .'/images/jobs_ohio.png" alt="Jobs Ohio" /></a>';
        			echo '</div><!-- end .logo-one -->';

					echo '<div class="logo-two">';
            			echo  '<a href="http://www.neotec.org/"><img src="' . get_stylesheet_directory_uri() .'/images/neotec.png" alt="Northeast Ohio Trade & Economic Consortium" /></a>';
        			echo '</div><!-- end .logo-two -->';

        			echo '<div class="logo-three">';
            			echo  '<a href="http://www.clevelandplusbusiness.com/About-Team-NEO.aspx"><img src="' . get_stylesheet_directory_uri() .'/images/teamneo.png" alt="Team NEO" /></a>';
        			echo '</div><!-- end .logo-three -->';

        			echo '<div class="logo-four">';
						echo  '<a href="http://www.medinacountyportauthority.com/"><img src="' . get_stylesheet_directory_uri() .'/images/mcpa.png" alt="Medina County Port Authority" /></a>';
        			echo '</div><!-- end .logo-four -->';

        			echo '<div class="logo-five">';
						echo  '<a href="http://www.ohioeda.com/"><img src="' . get_stylesheet_directory_uri() .'/images/oeda.png" alt="Ohio Economic Development Association" /></a>';
        			echo '</div><!-- end .logo-five -->';

        			echo '<div class="logo-six">';
            			echo  '<a href="http://www.toolsforbusiness.info/"><img src="' . get_stylesheet_directory_uri() .'/images/tools_for_business_logo.png" alt="Tools for Business" /></a>';
        			echo '</div><!-- end .logo-six -->';
				echo'</div><!-- end .logos -->';
		echo '</div><!-- end .widget-wrap -->';
	echo '</div><!-- end .widget -->';
}