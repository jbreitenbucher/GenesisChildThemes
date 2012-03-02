<?php
/**
 * Home - Used for the homepage
 *
 * @package       dorman-farrell
 * @author          The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright      Copyright (c) 2012, Dorman Farrell
 * @license          http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */

add_action( 'genesis_meta', 'df_home_genesis_meta' );
function df_home_genesis_meta() {

    // If any homepage widget area contains widgets use a custom loop
    if ( is_active_sidebar( 'featured' ) ) {
        
        // Customize the loop
        remove_action( 'genesis_loop', 'genesis_do_loop' );
        add_action( 'genesis_loop', 'df_home_loop_helper' );
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

    }
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function df_home_loop_helper() {

    if ( is_active_sidebar( 'featured' ) ) {
        echo '<div class="featured">';
            dynamic_sidebar( 'featured' );
        echo '</div><!-- end .featured -->';
    }
    
}

genesis();