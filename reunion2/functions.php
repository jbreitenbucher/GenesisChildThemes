<?php
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'primary', 'Primary Navigation Menu' );
}

unregister_sidebar( 'Sidebar' );

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'p2' ),
		'name' => __( 'Secondary Sidebar', 'p2' ),
	) );
}
?>