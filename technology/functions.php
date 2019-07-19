<?php
/**
 * Functions
 *
 * @package technology
 * @author  Jon Breitenbucher
 * @license GPL-2.0-or-later
 * @link    https://github.com/jbreitenbucher/GenesisChildThemes/technology
 * @version SVN: $Id$
 * @since   1.0
 *
 */

/**
 * Theme Setup
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {

    // Start the engine
    require_once( get_template_directory() . '/lib/init.php' );
    require_once( get_stylesheet_directory() . '/lib/init.php' );

    //* Set Localization (do not remove)
    load_child_theme_textdomain( 'technology', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'technology' ) );
    
    // Child theme (do not remove)
    define( 'CHILD_THEME_NAME', 'Technology Theme' );
    define( 'CHILD_THEME_URL', 'https://github.com/jbreitenbucher/GenesisChildThemes/technology-3' );
    define( 'CHILD_THEME_VERSION', '3.0.0' );

    $content_width = apply_filters( 'content_width', 580, 0, 910 );
    
    // Remove footer widget are on all pages added seperately to Home
    remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
    
    // Unregister 3-column site layouts
    genesis_unregister_layout( 'content-sidebar-sidebar' );
    genesis_unregister_layout( 'sidebar-sidebar-content' );
    genesis_unregister_layout( 'sidebar-content-sidebar' );
    
    // Unregister Genesis Sidebars
    add_action( 'widgets_init', 'tech_remove_sidebars' );
    
    // Customize Header
    remove_action( 'genesis_header', 'genesis_do_header' );
    add_action( 'genesis_header', 'tech_header' );
    
    // Add new featured image sizes
    add_image_size('home-bottom', 150, 130, TRUE);
    add_image_size('home-middle', 287, 120, TRUE);
    add_image_size('home-featured', 870, 320, TRUE);
    add_image_size('post-heading-image', 572, 239, TRUE);
    add_image_size('classroom-image', 600, 200, TRUE);
    add_image_size('classroom-square', 100, 100, TRUE);
    add_image_size('profile-picture-listing', 325, 183, TRUE);
    add_image_size('profile-picture-single', 325, 183, TRUE);

    add_filter('image_size_names_choose', 'my_image_sizes');
    function my_image_sizes($sizes) {
        $addsizes = array(
            "home-bottom" => __( "Home Bottom", 'technology'),
            "home-middle" => __( "Home Middle", 'technology'),
            "home-featured" => __( "Home Featured", 'technology'),
            "post-heading-image" => __( "Post Heading Image", 'technology'),
            "classroom-image" => __( "Classroom Image", 'technology'),
            "classroom-square" => __( "Classroom Square", 'technology'),
            "profile-picture-listing" => __( "Profile Picture Listing, 'technology'"),
            "profile-picture-single" => __( "Profile Picture Single", 'technology'),
        );
        $newsizes = array_merge($sizes, $addsizes);
        return $newsizes;
     }

    add_filter( 'script_loader_src', '_remove_script_version', 15, 1 ); 
    add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
    function _remove_script_version( $src ){ 
        $parts = explode( '?', $src );  
        return $parts[0]; 
    } 
    
    // Add support for structural wraps
    add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );
    add_action( 'genesis_before_header', 'tech_structure_begin' );
    add_action( 'genesis_after_footer', 'tech_structure_end' );

    // Add support for 3-column footer widgets
    add_theme_support( 'genesis-footer-widgets', 3 );
    
    //* Enable Genesis Accessibility Components
    add_theme_support( 'genesis-accessibility', array(
    '404-page',
    'drop-down-menu',
    'headings',
    'rems',
    'search-form',
    'skip-links',
    ) );

    // Customize breadcrumb display
    add_filter( 'genesis_breadcrumb_args', 'tech_breadcrumb_args' );
    
    // Register Sidebars
    genesis_register_sidebar( array(
        'id'            => 'featured',
        'name'          => __( 'Featured', 'technology' ),
        'description'   => __( 'This is the featured section.', 'technology' ),
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
    genesis_register_sidebar( array(
        'id'            => 'home-middle-1',
        'name'          => __( 'Home Middle #1', 'technology' ),
        'description'   => __( 'This is the first column of the home middle section.', 'technology' ),
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
    genesis_register_sidebar( array(
        'id'            => 'home-middle-2',
        'name'          => __( 'Home Middle #2', 'technology' ),
        'description'   => __( 'This is the second column of the home middle section.', 'technology' ),
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
    genesis_register_sidebar( array(
        'id'            => 'home-middle-3',
        'name'          => __( 'Home Middle #3', 'technology' ),
        'description'   => __( 'This is the third column of the home middle section.', 'technology' ),
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
    genesis_register_sidebar( array(
        'id'            => 'home-bottom-1',
        'name'          => __( 'Home Bottom #1', 'technology' ),
        'description'   => __( 'This is the first column of the home bottom section.', 'technology' ),
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
    genesis_register_sidebar( array(
        'id'            => 'home-bottom-2',
        'name'          => __( 'Home Bottom #2', 'technology' ),
        'description'   => __( 'This is the second column of the home bottom section.', 'technology' ),
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );

    // Wrap entry titles in widgets in h3 tags and on posts in h2 tags
    add_filter( 'genesis_entry_title_wrap', 'tech_set_custom_entry_title_wrap' );
    function tech_set_custom_entry_title_wrap( $wrap ) {
        if ( is_singular( 'post' ) ) {
            $wrap = 'h2';
        }
        return $wrap;
    }

    include_once( get_stylesheet_directory() . '/lib/widgets/genesis-custom-featured-post-widget.php' );

    add_action( 'widgets_init', 'tech_custom_widget_init' );
    function tech_custom_widget_init() {
        register_widget('Genesis_Custom_Featured_Post');
    }

    // Load Flexbox Grid
    add_action( 'wp_enqueue_scripts', 'tech_enqueue_flexbox_grid' );
    function tech_enqueue_flexbox_grid() {
       wp_enqueue_style( 'flexboxgrid', CHILD_URL . '/css/flexboxgrid.min.css' );
    }

    add_filter( 'wp_nav_menu_items', 'theme_menu_extras', 10, 2 );
    /**
     * Filter menu items, appending either a search form or today's date.
     *
     * @param string   $menu HTML string of list items.
     * @param stdClass $args Menu arguments.
     *
     * @return string Amended HTML string of list items.
     */
    function theme_menu_extras( $menu, $args ) {
        //* Change 'primary' to 'secondary' to add extras to the secondary navigation menu
        if ( 'primary' !== $args->theme_location )
            return $menu;
        //* Uncomment this block to add a search form to the navigation menu

        ob_start();
        get_search_form();
        $search = ob_get_clean();
        $menu  .= '<li class="menu-item right search">' . $search . '</li>';
        //* Uncomment this block to add the date to the navigation menu
        /*
        $menu .= '<li class="right date">' . date_i18n( get_option( 'date_format' ) ) . '</li>';
        */
        return $menu;
    }

    // Registers the responsive menus.
    if ( function_exists( 'genesis_register_responsive_menus' ) ) {
        genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
    }
    
    // Add Viewport meta tag for mobile browsers
    add_action( 'genesis_meta', 'add_viewport_meta_tag' );
}