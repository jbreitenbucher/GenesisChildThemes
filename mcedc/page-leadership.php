<?php
/**
 * Template Name: Leadership
 *
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

add_action('genesis_before','mcedc_leadership_loop_setup');
function mcedc_leadership_loop_setup() {
    
    // Customize Before Loop
    //remove_action('genesis_before_loop','genesis_do_before_loop' );
    //add_action('genesis_before_loop','mcedc_page_before_loop');
    
    // Customize Loop
    remove_action('genesis_loop', 'genesis_do_loop');
    add_action('genesis_loop', 'mcedc_leadership_page_loop');
    
    // Remove Post Info
    remove_action('genesis_before_post_content', 'genesis_post_info');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_post_title', 'genesis_do_post_title');
    remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
    remove_action('genesis_post_content', 'genesis_do_post_image');
    
    // Remove Post Meta
    remove_action('genesis_after_post_content', 'genesis_post_meta');
}

function mcedc_leadership_page_loop() {
    $mcedc_leadership_args = array(
        'post_type' => 'staff',
        'meta_key' => 'mcedc_order_text',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'role',
                'field' => 'slug',
                'terms' => array('executive-officers', 'executive-committee'),
            ),
        )
    );
    
    query_posts( $mcedc_leadership_args );
    echo '<h1 class="role-executive-officers">Executive Officers</h1>';
    while (have_posts()) : the_post();
        mcedc_leadership_page_loop_content();
    endwhile;
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function mcedc_leadership_page_loop_content() {
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

function mcedc_page_after_loop(){
}

genesis();