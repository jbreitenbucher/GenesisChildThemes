<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
add_action( 'wp_enqueue_scripts', 'tpg_add_javascript' );
 
if ( ! function_exists( 'tpg_add_javascript' ) ) {
	function tpg_add_javascript() {
		wp_register_script( 'menu', get_stylesheet_directory_uri() . '/lib/js/menu.js', array( 'jquery' ) );
		do_action( 'tpg_add_javascript' );
	} // End tpg_add_javascript()
}
 
add_action( 'tpg_add_javascript' , 'tpg_load_the_js' );
 
function tpg_load_the_js() {
	wp_enqueue_script( 'menu' );
}
?>