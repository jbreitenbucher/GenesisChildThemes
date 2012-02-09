<?php
/**
 * Template Name: Staff
 *
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

add_action('genesis_before','tpg_staff_loop_setup');
function tpg_staff_loop_setup() {
	
	// Customize Before Loop
	remove_action('genesis_before_loop','genesis_do_before_loop' );
	//add_action('genesis_before_loop','tpg_page_before_loop');
	
	// Customize Loop
	remove_action('genesis_loop', 'genesis_do_loop');
	add_action('genesis_loop', 'tpg_grid_loop_helper');
	
	add_action('genesis_before_post', 'tpg_custom_grid');
	function tpg_custom_grid() {
		// Customize Post Content
		remove_action('genesis_post_content', 'genesis_grid_loop_content');
		add_action('genesis_post_content', 'tpg_grid_loop_content');
		// Remove Post Info
		remove_action('genesis_before_post_content', 'genesis_post_info');
	}
	
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

function tpg_page_before_loop() {
	$c = 0; // set up a counter so we know which post we're currently showing
	$image_align = 'alignright'; // set up a variable to hold an extra CSS class
}

function tpg_grid_loop_helper() {
    global $grid_args, $post;
    $taxonomy = 'role'; //change me
    $term = get_query_var( 'term' );
    $term_obj = get_term_by( 'slug' , $term , $taxonomy );
    $cpt = 'staff'; //change me
 
    if ( function_exists( 'genesis_grid_loop' ) ) {
        $grid_args_tax = array(
            'features' => 0,
            'feature_image_size' => 0,
            'feature_image_class' => 'alignleft profile-picture-single',
            'feature_content_limit' => 0,
            'grid_image_size' => 0,
            'grid_image_class' => 0,
            'grid_content_limit' => 0,
            'more' => '',
            'posts_per_page' => genesis_get_option('tpg_staff_posts_per_page', TPG_SETTINGS_FIELD ),
            'post_type' => $cpt,
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => array( $term_obj->slug ),
                )
            )
        );
 
            printf('<h2 class="role-type">%s</h2>' , $term_obj->name );
            genesis_grid_loop($grid_args_tax);
    } else {
        genesis_standard_loop();
    }
}

/**
 * Customize Loop
 *
 * @author The Pedestal Group
 */

function tpg_consulting_professionals_loop() {
	global $paged;
		$args = array(
			'post_type' => 'staff',
			'paged' => $paged,
			'posts_per_page' => genesis_get_option('tpg_staff_posts_per_page', TPG_SETTINGS_FIELD )
		);

	    //genesis_custom_loop( $args );
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function tpg_grid_loop_content () {
	global $_genesis_loop_args, $wp_query;

	printf( '<div id="post-%s" class="person clear">', get_the_ID() );
		//use the genesis_get_custom_field template tag to display each custom field value
		if (genesis_get_custom_field('tpg_title_text') != '') {
			printf( '<h1 class="name"><a href="%s" title="%s">%s</a>, <span class="title">%s</span></h1>', get_permalink(), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('tpg_title_text') );
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

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function tpg_page_post_content () {
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
			printf( '<h1 class="name"><a href="%s" title="%s">%s</a>, <span class="title">%s</span></h1>', get_permalink(), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('tpg_title_text') );
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