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

add_action('genesis_before','mcedc_industry_loop_setup');
function mcedc_industry_loop_setup() {
    
    // Customize Before Loop
    remove_action('genesis_before_loop','genesis_do_before_loop' );
	add_action('genesis_before_loop', 'mcedc_industry_do_before_loop');
	
	// Customize Loop
    remove_action('genesis_loop', 'genesis_do_loop');
    add_action('genesis_loop', 'mcedc_industry_page_loop');
    
    // Remove Post Info
    remove_action('genesis_before_post_content', 'genesis_post_info');
    
    // Customize Post Content
    remove_action('genesis_post_content','genesis_do_post_content');
    add_action('genesis_post_content','mcedc_industry_post_content');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_post_title', 'genesis_do_post_title');
    remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
    remove_action('genesis_post_content', 'genesis_do_post_image');
    
    // Remove Post Meta
    remove_action('genesis_after_post_content', 'genesis_post_meta');
    
    // Customize After Endwhile
    remove_action('genesis_after_endwhile','genesis_do_after_endwhile');
    remove_action('genesis_after_endwhile', 'genesis_posts_nav');
    add_action('genesis_after_endwhile', 'mcedc_industry_after_endwhile');
}

function mcedc_industry_page_loop() {
	global $wp_query;
	$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $mcedc_industry_args = array(
        'post_type' => 'staff',
        'meta_key' => 'mcedc_business_name_text',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'posts_per_page' => 8,
		'paged' => $page
    );
    $args = array_merge( $wp_query->query, $mcedc_industry_args );

    query_posts( $args );

	if( have_posts() ): 
    	while( have_posts() ): the_post();
        	mcedc_industry_post_content();
    	endwhile;
		mcedc_industry_after_endwhile();
	endif;
	wp_reset_query();
}

/**
 * Customize Before Content
 *
 * @author The Pedestal Group
 */
function mcedc_industry_do_before_loop() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	printf('<h1 class="industry-members">%s</h1>', $term->name );
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function mcedc_industry_post_content() {
    global $post;
    printf( '<div id="post-%s" class="person clear">', get_the_ID() );
        //use the genesis_get_custom_field template tag to display each custom field value
        echo '<div class="contact">';
        $default_attr = array(
               'class' => "alignleft member-logo",
               'alt'   => $post->post_title,
               'title' => $post->post_title
           );
        if ( genesis_get_custom_field('mcedc_business_logo_image_id') != '' ) {
			$imageUrl = wp_get_attachment_image_src( genesis_get_custom_field('mcedc_business_logo_image_id'), 'member-logo' );
			//echo '<img class="member-logo" src="'; echo $imageUrl[0]; echo '"/>';
		} else {
		}
            if( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
				if( genesis_get_custom_field('mcedc_business_title_text') != '' ) {
					if( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
						if( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
							if( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								}
							} else {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						} else {
							if( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								}
							} else {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span> &middot; <span class="phone">%s</span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span> &middot; <span class="phone">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text') );
								}
							}
						}
					} else {
						if( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
							if( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								}
							} else {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span><br /><span class="address">%s</span><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						} else {
							if( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span><br /><span class="url"><a href="%s">%s</a></span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								}
							} else {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="title">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text') );
								}
							}
						}
					}
				} else {
					if( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
						if( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
							if( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								}
							} else {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						} else {
							if( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								}
							} else {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span> &middot; <span class="phone">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_title_text') );
								}
							}
						}
					} else {
						if( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
							if( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								}
							} else {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="address">%s</span><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="address">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							}
						} else {
							if( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="url"><a href="%s">%s</a></span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text'), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="url"><a href="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								}
							} else {
								if ( get_the_terms( $post->ID, 'industry' ) != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span><br /><span class="industry">%s</span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title(), get_the_term_list($post->ID, 'industry', 'Industry: ', ', ', '') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info business"><span class="name"><a href="%s" title="%s">%s</a></span></div>', genesis_get_custom_field('mcedc_business_name_text'), get_permalink( get_the_ID() ), the_title_attribute('echo=0'), get_the_title() );
								}
							}
						}
					}
				}
			} else {
			}
        echo '</div><!--#end contact-->';
    echo '</div><!--end #person -->';
}

/**
 * Customize After Endwhile
 *
 * @author The Pedestal Group
 */

function mcedc_industry_after_endwhile() {
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