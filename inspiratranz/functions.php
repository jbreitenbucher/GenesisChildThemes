<?php
/** Start the engine */
require_once(TEMPLATEPATH.'/lib/init.php');

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 800, 'height' => 258 ) );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register default site layout option */
genesis_set_default_layout( 'sidebar-content' );

/** Unregister other site layouts */
genesis_unregister_layout( 'full-width-content' );
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );