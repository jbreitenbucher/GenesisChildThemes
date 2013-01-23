<?php
/**
 * General
 *
 * This file contains any general functions
 *
 * @package    apex
 * @author     Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright  Copyright (c) 2012, The College of Wooster
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version    SVN: $Id$
 * @since      1.0
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

function apex_remove_menus () {
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
add_action('admin_menu', 'apex_remove_menus');

/**
 * Customize Menu Order
 *
 * @param array $menu_ord. Current order.
 * @return array $menu_ord. New order.
 *
 */

function apex_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;
    return array(
        'index.php', // this represents the dashboard link
        'edit.php?post_type=page', //the page tab
        'edit.php', //the posts tab
        'edit-comments.php', // the comments tab
        'upload.php', // the media manager
    );
}
add_filter( 'custom_menu_order', 'apex_custom_menu_order' );
add_filter( 'menu_order', 'apex_custom_menu_order' );

/**
 * Do not display child, grandchild, etc. posts when viewing a parent category
 * and order by title in ascending order unless on the home screen or designated
 * blog page
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function apex_no_child_posts( $query) {
    global $wp_query;
    $id = $wp_query->get_queried_object_id();
    if ( !is_home() && !is_category( genesis_get_option( 'technology_blog_cat', APEX_SETTINGS_FIELD ) ) ) {
        if ( $query->is_category ) {
            $query->set( 'category__in', array( $id ) );
            $query->set( 'orderby', 'title' );
            $query->set( 'order', 'asc' );
        }
        return $query;
    }
}
add_action('pre_get_posts', 'apex_no_child_posts');

/**
 * Customize the post info function
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function post_info_filter($post_info) {
if (!is_page()) {
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

function apex_next_post_link_text(){
    $next = 'Next &rarr;';
    return $next;
}
add_filter('genesis_next_link_text','apex_next_post_link_text');

/**
 * Customize the previous post link text
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function apex_previous_post_link_text(){
    $previous = '&larr; Previous';
    return $previous;
}
add_filter('genesis_prev_link_text','apex_previous_post_link_text');

/**
 * Remove Genesis Widget Areas
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function apex_remove_sidebars() {
    unregister_sidebar( 'header-right' );
    unregister_sidebar( 'sidebar-alt' );
}

/**
 * APEX Header
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function apex_header() {
	echo '<div id="title-area">';
        echo '<a href="http://wooster.edu/Academics/apex"><img src="'. get_stylesheet_directory_uri() .'/images/apex_white.png" alt="APEX" /></a>';
        echo '<div id="title-wrap">';
            echo '<h1 id="title"><a href="' . get_home_url() . '/planning-portfolios/" title="Planning Portfolios">Planning Portfolios</a></h1>';
        echo '</div>';
    echo '</div><!-- end #title-area -->';
}

// Customize the credits
add_filter('genesis_footer_creds_text', 'custom_footer_creds_text');
function custom_footer_creds_text($creds) {
    $creds = '&copy; ' . date("Y") . '   <a href="http://wooster.edu">The College of Wooster</a>';
    return $creds;
}
// Customize the credits
add_filter('genesis_footer_backtotop_text', 'custom_footer_backtotop_text');
function custom_footer_backtotop_text($backtotop) {
    $backtotop = '<a href="' . home_url() . '">Home</a>';
    return $backtotop;
}