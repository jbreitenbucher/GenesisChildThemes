<?php
/**
 * @package      dorman-farrell
 * @author       The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright    Copyright (c) 2012, Dorman Farrell
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Loop Setup
 *
 * This setup function attaches all of the loop-specific functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */

add_action('genesis_before','tpg_role_loop_setup');
function tpg_role_loop_setup() {
	
	// Customize Before Loop
	remove_action('genesis_before_loop','genesis_do_before_loop' );
	add_action('genesis_before_loop','tpg_role_before_loop');
	
	// Remove Post Info
	remove_action('genesis_before_post_content', 'genesis_post_info');
	
	// Customize Post Content
	remove_action('genesis_post_content','genesis_do_post_content');
	add_action('genesis_post_content','tpg_role_post_content');
	
	// Remove Title, After Title, and Post Image
	remove_action('genesis_post_title', 'genesis_do_post_title');
	remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
	remove_action('genesis_post_content', 'genesis_do_post_image');
	
	// Remove Post Meta
	remove_action('genesis_after_post_content', 'genesis_post_meta');
}

/**
 * Customize Before Loop
 *
 * @author The Pedestal Group
 */

function tpg_role_before_loop() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	echo '<h1>' . $term->name . 's</h1>';
	if( !is_paged() ) { 
		echo '<div>' . $term->description . '</div>';
	}
	
	$c = 0; // set up a counter so we know which post we're currently showing
	$image_align = 'alignright'; // set up a variable to hold an extra CSS class
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function tpg_role_post_content () {
	global $post, $c;
	$c++; // increment the counter
	if( $c % 2 != 0) {
		// we're on an odd post
		$image_align = 'alignleft';
	} else {
		$image_align = 'alignright';
	}
	printf( '<div id="post-%s" class="person clear">', get_the_ID() );
		//use the genesis_get_custom_field template tag to display each custom field value
		if (genesis_get_custom_field('tpg_title_text') != '') {
			printf( '<h2 class="name"><a href="%s" title="%s">%s</a>, <span class="title">%s</span></h2>', get_permalink(), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('tpg_title_text') );
		} else {
			printf( '<h1 class="name"><a href="%s" title="%s">%s</a></h1>', get_permalink(), the_title_attribute('echo=0'), get_the_title() );
		}
				echo '<div class="contact clear">';
					if( genesis_get_custom_field('tpg_phone_number_text') != '') { 
						printf( '<span class="phone">phone:%s</span>', genesis_get_custom_field('tpg_phone_number_text') );
					}
					if( genesis_get_custom_field('tpg_email_address_text') != '') {
						printf('<span class="email"> | e-mail: <a href="mailto:%s">%s</a></span>', antispambot(genesis_get_custom_field('tpg_email_address_text')), antispambot(genesis_get_custom_field('tpg_email_address_text')) );
				}
				echo '</div><!--#end contact-->';

				echo '<div ';
					post_class('about');
				echo '>';
			    $default_attr = array(
			               'class' => "$image_align profile-image",
			               'alt'   => $post->post_title,
			               'title' => $post->post_title
			           );
					echo genesis_get_image( array( 'size' => 'profile-picture-listing', 'attr' => $default_attr ) );
					the_excerpt();
				echo '</div><!--end #about -->';
			echo '</div><!--end #person -->';
}

genesis();