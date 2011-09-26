<?php
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'primary', __( 'Primary Navigation Menu' ) );
	}
}
add_theme_support( 'menus' );


unregister_sidebar( 'Sidebar' );

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'p2' )
	) );
//	register_sidebar( array(
//		'name' => __( 'Secondary Sidebar', 'p2' )
//	) );
}
?>
