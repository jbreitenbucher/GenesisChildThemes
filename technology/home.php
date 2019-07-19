<?php
/**
 * Home - Used for the homepage
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
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */

add_action( 'genesis_meta', 'tech_home_genesis_meta' );
function tech_home_genesis_meta() {

    // If any homepage widget area contains widgets use a custom loop
    if ( is_active_sidebar( 'featured' ) || is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) || is_active_sidebar( 'home-bottom-1' ) || is_active_sidebar( 'home-bottom-2' ) ) {
        
        // Customize the loop
        remove_action( 'genesis_loop', 'genesis_do_loop' );
        add_action( 'genesis_loop', 'tech_home_loop_helper' );
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

    }
}

/**
 * Customize the homepage content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function tech_home_loop_helper() {

    if ( is_active_sidebar( 'featured' ) ) {
        echo '<div class="col-xs featured">';
        dynamic_sidebar( 'featured' );
        echo '</div><!-- end .featured -->';
    }
    
    echo '<div class=" row home-middle">';
    
    if ( is_active_sidebar( 'home-middle-1' ) ) {
        echo '<div class=" col-xs-12 col-sm-12 col-md-6 col-lg-4 home-middle-1">';
        dynamic_sidebar( 'home-middle-1' );
        echo '</div><!-- end .home-middle-1 -->';
    }
    
    if ( is_active_sidebar( 'home-middle-2' ) ) {
        echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 home-middle-2">';
        dynamic_sidebar( 'home-middle-2' );
        echo '</div><!-- end .home-middle-2 -->';
    }
    
    if ( is_active_sidebar( 'home-middle-3' ) ) {
        echo '<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-4 home-middle-3">';
        dynamic_sidebar( 'home-middle-3' );
        echo '</div><!-- end .home-middle-3 -->';
    }
    
    echo '</div><!-- end .home-middle -->';
    
    echo '<div class="row home-bottom">';
    
    if ( is_active_sidebar( 'home-bottom-1' ) ) {
        echo '<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 home-bottom-1">';
        dynamic_sidebar( 'home-bottom-1' );
        echo '</div><!-- end .home-bottom-1 -->';
    }
    
    if ( is_active_sidebar( 'home-bottom-2' ) ) {
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 home-bottom-2">';
        dynamic_sidebar( 'home-bottom-2' );
        echo '</div><!-- end .home-bottom-2 -->';
    }
    
    echo '</div><!-- end .home-bottom -->';
}

if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') ) {
    add_action('genesis_after_content', 'genesis_footer_widget_areas');
}

genesis();