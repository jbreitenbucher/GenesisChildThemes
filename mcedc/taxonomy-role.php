<?php
/**
 * @package     mcedc
 * @author      The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright   Copyright (c) 2012, Medina County Economic Development Corporation
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
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

add_action('genesis_before','mcedc_role_loop_setup');
function mcedc_role_loop_setup() {
    
    // Customize Before Loop
    remove_action('genesis_before_loop','genesis_do_before_loop' );
	add_action('genesis_before_loop', 'mcedc_role_do_before_loop');
	
	// Customize Loop
    remove_action('genesis_loop', 'genesis_do_loop');
    add_action('genesis_loop', 'mcedc_role_page_loop');
    
    // Remove Post Info
    remove_action('genesis_before_post_content', 'genesis_post_info');
    
    // Customize Post Content
    remove_action('genesis_post_content','genesis_do_post_content');
    //add_action('genesis_post_content','mcedc_role_post_content');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_post_title', 'genesis_do_post_title');
    remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
    remove_action('genesis_post_content', 'genesis_do_post_image');
    
    // Remove Post Meta
    remove_action('genesis_after_post_content', 'genesis_post_meta');
    
    // Customize After Endwhile
    remove_action('genesis_after_endwhile','genesis_do_after_endwhile');
    remove_action('genesis_after_endwhile', 'genesis_posts_nav');
    add_action('genesis_after_endwhile', 'mcedc_role_after_endwhile');
}

function mcedc_role_page_loop() {
	global $wp_query;
	$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$mcedc_role_args = array(
        'post_type' => 'staff',
        'meta_key' => 'mcedc_order_text',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'posts_per_page' => 8,
		'paged' => $page
    );
    $args = array_merge( $wp_query->query, $mcedc_role_args );

    query_posts( $args );

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	if ( $term->name = 'Executive Officers' || $term->name = 'Executive Committee' ) {
		if( have_posts() ): 
	    	while( have_posts() ): the_post();
	        	mcedc_executive_post_content();
	    	endwhile;
			mcedc_role_after_endwhile();
		endif;
		wp_reset_query();
	} elseif ( $term->name = 'MCEDC Staff' ) {
		if( have_posts() ): 
	    	while( have_posts() ): the_post();
	        	mcedc_staff_post_content();
	    	endwhile;
			mcedc_role_after_endwhile();
		endif;
		wp_reset_query();
	} else {
		echo 'No post found.';
	}
}

/**
 * Customize Before Content
 *
 * @author The Pedestal Group
 */
function mcedc_role_do_before_loop() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	printf('<h1 class="mcedc-role">%s</h1>', $term->name );
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function mcedc_executive_post_content() {
    global $post;
    printf( '<div id="post-%s" class="person clear">', get_the_ID() );
        //use the genesis_get_custom_field template tag to display each custom field value
        echo '<div class="contact">';
        $default_attr = array(
               'class' => "alignleft profile-image",
               'alt'   => $post->post_title,
               'title' => $post->post_title
           );
        if( has_post_thumbnail() ) {
        	echo  the_post_thumbnail( 'profile-image', array('class' => 'alignleft') );
		} elseif ( genesis_get_custom_field('mcedc_business_logo_image_id') != '' ) {
			$imageUrl = wp_get_attachment_image_src( genesis_get_custom_field('mcedc_business_logo_image_id'), 'member-logo' );
			echo '<img class="member-logo" src="'; echo $imageUrl[0]; echo '"/>';
		} else {
		}
			if ( genesis_get_custom_field('mcedc_title_text') != '' ) {
				if ( genesis_get_custom_field('mcedc_business_title_text') != '' ) {
					if ( genesis_get_custom_field('mcedc_phone_number_text') != '' ) {
						if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="business-name">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text') );
								}
							}
						}
					} else {
						if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="business-title">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text') );
								}
							}
						}
					}
				} else {
					if ( genesis_get_custom_field('mcedc_phone_number_text') != '' ) {
						if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="business-name">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_phone_number_text') );
								}
							}
						}
					} else {
						if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="business-name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="business-name">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name"><a href="%s" title="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_title_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						}
					}
				}
			} else {
				if ( genesis_get_custom_field('mcedc_business_title_text') != '' ) {
					if ( genesis_get_custom_field('mcedc_phone_number_text') != '' ) {
						if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="business-name">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s  &middot; </span><span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text') );
								}
							}
						}
					} else {
						if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="business-title">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text') );
								}
							}
						}
					}
				} else {
					if ( genesis_get_custom_field('mcedc_phone_number_text') != '' ) {
						if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="phone">%s</span><br /><span class="business-name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="phone">%s</span><br /><span class="business-name">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span> &middot; <span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_phone_number_text') );
								}
							}
						}
					} else {
						if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span><br /><span class="business-name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span><br /><span class="business-name">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<div class="info"><span class="name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<div class="info"><span class="name">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_phone_number_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						}
					}
				}
			}
        echo '</div><!--#end contact-->';
    echo '</div><!--end #person -->';
}

function mcedc_staff_post_content() {
    global $post;
    printf( '<div id="post-%s" class="person clear">', get_the_ID() );
        //use the genesis_get_custom_field template tag to display each custom field value
        echo '<div class="contact">';
        $default_attr = array(
               'class' => "alignleft profile-image",
               'alt'   => $post->post_title,
               'title' => $post->post_title
           );
        if( has_post_thumbnail() ) {
        	echo  the_post_thumbnail( 'profile-image', array('class' => 'alignleft') );
		} elseif ( genesis_get_custom_field('mcedc_business_logo_image_id') != '' ) {
			$imageUrl = wp_get_attachment_image_src( genesis_get_custom_field('mcedc_business_logo_image_id'), 'member-logo' );
			echo '<img class="member-logo" src="'; echo $imageUrl[0]; echo '"/>';
		} else {
		}
            if( genesis_get_custom_field('mcedc_title_text') != '') { 
                printf( '<h3 class="title">%s</h3>', genesis_get_custom_field('mcedc_title_text') );
            }
        echo '</div><!--#end contact-->';
            if( genesis_get_custom_field('mcedc_phone_number_text') != '') {
                if( genesis_get_custom_field('mcedc_email_address_text') != '') {
                    printf( '<div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="email"><a href="mailto:%s">%s</a></span></div>', get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), antispambot(genesis_get_custom_field('mcedc_email_address_text')), antispambot(genesis_get_custom_field('mcedc_email_address_text')) );
                } else {
                    printf( '<div class="info"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span></div>', get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_phone_number_text') );
                }
            } 	else {
					if( genesis_get_custom_field('mcedc_email_address_text') != '') {
	                    printf( '<div class="info"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="email"><a href="mailto:%s">%s</a></span></div>', get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), antispambot(genesis_get_custom_field('mcedc_email_address_text')), antispambot(genesis_get_custom_field('mcedc_email_address_text')) );
	                } else {
	                    printf( '<div class="info"><span class="name"><a href="%s" title="%s">%s</a></span></div>', get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title() );
	                }
				}
    echo '</div><!--end #person -->';
}

function mcedc_role_post_content () {
    global $post;
    printf( '<div id="post-%s" class="person clear">', get_the_ID() );
        //use the genesis_get_custom_field template tag to display each custom field value
        echo '<div class="contact">';
        $default_attr = array(
               'class' => "alignleft profile-image",
               'alt'   => $post->post_title,
               'title' => $post->post_title
           );
        echo genesis_get_image( array( 'size' => 'profile-image', 'attr' => $default_attr ) );
            if( genesis_get_custom_field('mcedc_title_text') != '') { 
                printf( '<span class="title">%s</span>', genesis_get_custom_field('mcedc_title_text') );
            }
        echo '</div><!--#end contact-->';
        if ( genesis_get_custom_field('mcedc_cert_text') != '' ) {
            if( genesis_get_custom_field('mcedc_phone_number_text') != '') {
                if( genesis_get_custom_field('mcedc_email_address_text') != '') {
                    printf( '<div class="info"><h2 class="name">%s, <span class="cert">%s</span></h2><span class="phone">%s</span><span class="email"><a href="mailto:%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_cert_text'), genesis_get_custom_field('mcedc_phone_number_text'), antispambot(genesis_get_custom_field('mcedc_email_address_text')), antispambot(genesis_get_custom_field('mcedc_email_address_text')) );
                } else {
                    printf( '<div class="info"><h2 class="name">%s, <span class="cert">%s</span></h2><span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_cert_text'), genesis_get_custom_field('mcedc_phone_number_text') );
                }
            } else {
                    printf( '<div class="info"><h2 class="name">%s, <span class="cert">%s</span></h2></div>', get_the_title(), genesis_get_custom_field('mcedc_cert_text') );
            }
        } else {
            if( genesis_get_custom_field('mcedc_phone_number_text') != '') {
                if( genesis_get_custom_field('mcedc_email_address_text') != '') {
                    printf( '<div class="info"><h2 class="name">%s</h2><span class="phone">%s</span><span class="email"><a href="mailto:%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_phone_number_text'), antispambot(genesis_get_custom_field('mcedc_email_address_text')), antispambot(genesis_get_custom_field('mcedc_email_address_text')) );
                } else {
                    printf( '<div class="info"><h2 class="name">%s</h2><span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_phone_number_text') );
                }
            }
        }
    echo '</div><!--end #person -->';
}

/**
 * Customize After Endwhile
 *
 * @author The Pedestal Group
 */

function mcedc_role_after_endwhile() {
    echo '<div class="navigation">';
        echo '<div class="alignright">';
            next_posts_link('More &rarr;');
        echo '</div>';
        echo '<div class="alignleft">';
            previous_posts_link('&larr; Previous');
        echo '</div>';
    echo '</div>';
}

genesis();