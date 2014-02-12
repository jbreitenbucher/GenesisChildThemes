<?php
/**
 * Template Name: People Archive
 *
 * This template will be used to list the itpeople post type archive.
 *
 * @package      technology
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright    Copyright (c) 2012, The College of Wooster
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

/**
 * Loop Setup
 *
 * This setup function attaches all of the loop-specific functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

add_action('genesis_before','it_archive_loop_setup');
function it_archive_loop_setup() {
	
	// Customize Before Loop
	remove_action('genesis_before_loop','genesis_do_before_loop' );
	add_action('genesis_before_loop','it_archive_before_loop');
	
	// Remove Post Info
	remove_action('genesis_before_post_content', 'genesis_post_info');
	
	// Customize Post Content
	remove_action('genesis_post_content','genesis_do_post_content');
	add_action('genesis_post_content','it_archive_post_content');
	
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
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_archive_before_loop() {
	$c = 0; // set up a counter so we know which post we're currently showing
	$image_align = 'alignright'; // set up a variable to hold an extra CSS class
}

/**
 * Customize Post Content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_archive_post_content () {
	global $post, $c;
	$c++; // increment the counter
	if( $c % 2 != 0) {
		// we're on an odd post
		$image_align = 'alignleft';
	} else {
		$image_align = 'alignright';
	}
	$expertise = get_the_term_list($post->ID, 'expertise', '', ', ', '');
	printf( '<div id="post-%s" class="person clear">', get_the_ID() );
		//use the genesis_get_custom_field template tag to display each custom field value
		if (genesis_get_custom_field('it_title_text') != '') {
			printf( '<h1 class="name"><a href="%s" title="%s">%s</a>, <span class="title">%s</span></h1>', get_permalink(), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('it_title_text') );
		} else {
			printf( '<h1 class="name"><a href="%s" title="%s">%s</a></h1>', get_permalink(), the_title_attribute('echo=0'), get_the_title() );
		}
				echo '<div class="contact clear">';
					if( genesis_get_custom_field('it_phone_number_text') != '' && genesis_get_custom_field('it_email_address_text') == '') {					 
						printf( '<span class="phone">phone: %s</span>', genesis_get_custom_field('it_phone_number_text') );
					}
					if( genesis_get_custom_field('it_email_address_text') != '' && genesis_get_custom_field('it_phone_number_text') == '') {					
						printf('<span class="email">e-mail: <a href="mailto:%s">%s</a></span>', antispambot(genesis_get_custom_field('it_email_address_text')), antispambot(genesis_get_custom_field('it_email_address_text')) );
					}
					if( genesis_get_custom_field('it_email_address_text') != '' && genesis_get_custom_field('it_phone_number_text') != '') {					
						printf('<span class="phone">phone: %s</span> | <span class="email">e-mail: <a href="mailto:%s">%s</a></span>', genesis_get_custom_field('it_phone_number_text'), antispambot(genesis_get_custom_field('it_email_address_text')), antispambot(genesis_get_custom_field('it_email_address_text')) );
					}
				echo '</div><!--#end contact-->';
				
				if($expertise != ''){
					echo '<div class="expertise">';
						echo '<h3>Can help with</h3>';
						echo $expertise;
					echo '</div><!--#end expertise-->';
				}

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