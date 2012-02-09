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

add_action('genesis_before','tpg_single_loop_setup');
function tpg_single_loop_setup() {
	
	// Remove Before Loop
	remove_action('genesis_before_loop','genesis_do_before_loop' );
	
	// Remove Post Info
	remove_action('genesis_before_post_content', 'genesis_post_info');
	
	// Customize Post Content
	remove_action('genesis_post_content','genesis_do_post_content');
	add_action('genesis_post_content','tpg_person_post_content');
	
	// Remove Title, After Title, and Post Image
	remove_action('genesis_post_title', 'genesis_do_post_title');
	remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
	remove_action('genesis_post_content', 'genesis_do_post_image');
	
	// Remove Post Meta
	remove_action('genesis_after_post_content', 'genesis_post_meta');
	
	// Customize After Endwhile
	remove_action('genesis_after_endwhile','genesis_do_after_endwhile');
	remove_action('genesis_after_endwhile', 'genesis_posts_nav');
	add_action('genesis_after_endwhile', 'tpg_person_after_endwhile');
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function tpg_person_post_content() {
	printf( '<div id="post-%s" class="person">', get_the_ID() );
	if (genesis_get_custom_field('tpg_title_text') != '') {
		printf( '<h2 class="name">%s, <span class="title">%s</span></h2>', get_the_title(), genesis_get_custom_field('tpg_title_text') );
	} else {
		printf('<h2 class="name">%s</h2>', get_the_title() );
	}
	echo '<div class="contact clear">';
		if( genesis_get_custom_field('tpg_phone_number_text') != '') { 
			echo '<span class="phone">phone:'; 
				echo genesis_get_custom_field('tpg_phone_number_text');
			echo '</span>';
		}
		if( genesis_get_custom_field('tpg_email_address_text') != '') { 
			echo '<span class="email"> | e-mail: <a href="mailto:';
				echo antispambot(genesis_get_custom_field('tpg_email_address_text')) . '">';
				echo antispambot(genesis_get_custom_field('tpg_email_address_text'));
			echo '</a></p>';
		}
	echo '</div><!--#end contact-->';
	echo '<div class="about">';
		the_post_thumbnail('profile-picture-single',array('class' => 'alignleft profile-image'));
		echo genesis_get_custom_field('tpg_about_me_wysiwyg');
	echo '</div><!--end #about -->';
echo '</div><!--end #person -->';
}

/**
 * Customize After Endwhile
 *
 * @author The Pedestal Group
 */

function tpg_person_after_endwhile() {
	echo '<div class="navigation">';
		echo '<div class="alignleft">';
			previous_posts_link('&larr; Previous');
		echo '</div>';
		echo '<div class="alignright">';
			next_posts_link('More &rarr;');
		echo '</div>';
	echo '</div>';
}

genesis();