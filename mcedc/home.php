<?php
/**
 * Home - Used for the homepage
 *
 * @package     mcedc
 * @author      The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright   Copyright (c) 2012, Medina County Economic Development Corporation
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */

add_action( 'genesis_meta', 'mcedc_home_genesis_meta' );
function mcedc_home_genesis_meta() {

    // If any homepage widget area contains widgets use a custom loop
    //if ( is_active_sidebar( 'featured' ) ) {
        
        // Customize the loop
        remove_action( 'genesis_loop', 'genesis_do_loop' );
        add_action( 'genesis_loop', 'mcedc_home_loop_helper' );
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

    //}
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function mcedc_home_loop_helper() {

    echo '<div class="featured">';
       echo '<div class="featured-left">';
           do_shortcode( '[responsive_slider]' );
       echo '</div><!-- end .featured-left -->';

       echo '<div class="featured-right">';
           echo  '<img src="' . get_stylesheet_directory_uri() .'/images/map.png" alt="Medina County Map pull out" />';
       echo '</div><!-- end .featured-right -->';
    echo '</div><!-- end .featured -->';

    if ( is_active_sidebar( 'home-left' ) || is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-right' ) ) {
        echo '<div class="home-bottom">';
            echo '<div class="home-left">';
                dynamic_sidebar( 'home-left' );
            echo '</div><!-- end .home-left -->';

            echo '<div class="home-middle">';
                dynamic_sidebar( 'home-middle' );
            echo '</div><!-- end .home-middle -->';

            echo '<div class="home-right">';
                dynamic_sidebar( 'home-right' );
            echo '</div><!-- end .home-right -->';
        echo '</div><!-- end .home-bottom -->';
    }

}

add_action( 'genesis_before_footer', 'mcedc_before_footer' );
function mcedc_before_footer() {
    echo '<div class="logos">';
        echo '<div class="logo-one">';
            echo  '<a href="http://jobs-ohio.com/"><img src="' . get_stylesheet_directory_uri() .'/images/jobsohio.jpg" alt="Jobs Ohio" /></a>';
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
}


genesis();