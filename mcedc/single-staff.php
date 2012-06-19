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

add_action('genesis_before','mcedc_single_loop_setup');
function mcedc_single_loop_setup() {
    
    // Remove Before Loop
    remove_action('genesis_before_loop','genesis_do_before_loop' );
    
    // Remove Post Info
    remove_action('genesis_before_post_content', 'genesis_post_info');
    
    // Customize Post Content
    remove_action('genesis_post_content','genesis_do_post_content');
    add_action('genesis_post_content','mcedc_person_post_content');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_post_title', 'genesis_do_post_title');
    remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
    remove_action('genesis_post_content', 'genesis_do_post_image');
    
    // Remove Post Meta
    remove_action('genesis_after_post_content', 'genesis_post_meta');
    
    // Customize After Endwhile
    remove_action('genesis_after_endwhile','genesis_do_after_endwhile');
    remove_action('genesis_after_endwhile', 'genesis_posts_nav');
    add_action('genesis_after_endwhile', 'mcedc_person_after_endwhile');
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function mcedc_person_post_content() {
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
				if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
					if ( genesis_get_custom_field('mcedc_business_title_text') != '' ) {
						if ( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="business-title">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="business-title">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="business-title">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="business-title">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text') );
								}
							}
						}
					} else {
						if ( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_phone_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-name">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_name_text') );
								}
							}
						}
					}
				} else {
					if ( genesis_get_custom_field('mcedc_business_title_text') != '' ) {
						if ( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-title">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-title">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-title">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="business-title">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_title_text') );
								}
							}
						}
					} else {
						if ( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_phone_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="name">Role at MCEDC: %s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_title_text') );
								}
							}
						}
					}
				}
			} else {
				if ( genesis_get_custom_field('mcedc_business_name_text') != '' ) {
					if ( genesis_get_custom_field('mcedc_business_title_text') != '' ) {
						if ( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="business-title">%s</span> &middot; <span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="business-title">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="business-title">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="business-title">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="business-title">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_title_text') );
								}
							}
						}
					} else {
						if ( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_phone_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-name">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_name_text') );
								}
							}
						}
					}
				} else {
					if ( genesis_get_custom_field('mcedc_business_title_text') != '' ) {
						if ( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-title">%s</span> &middot; <span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-title">%s</span> &middot; <span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_phone_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-title">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-title">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-title">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="business-title">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_title_text') );
								}
							}
						}
					} else {
						if ( genesis_get_custom_field('mcedc_business_phone_text') != '' ) {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="phone">%s</span><br /><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="phone">%s</span><br /><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="phone">%s</span><br /><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_phone_text'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="phone">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_phone_text') );
								}
							}
						} else {
							if ( genesis_get_custom_field('mcedc_business_address_wysiwig') != '' ) {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="address">%s</span><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig'), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="address">%s</span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_address_wysiwig') );
								}
							} else {
								if ( genesis_get_custom_field('mcedc_business_url_text') != '' ) {
									printf( '<h3 class="title">%s</h3><div class="info"><span class="url"><a href="%s">%s</a></span></div>', get_the_title(), genesis_get_custom_field('mcedc_business_url_text'), genesis_get_custom_field('mcedc_business_url_text') );
								} else {
									printf( '<h3 class="title">%s</h3><div class="info"></div>', get_the_title() );
								}
							}
						}
					}
				}
			}
        echo '</div><!--#end contact-->';
		if ( genesis_get_custom_field('mcedc_bio_wysiwig') != '' ) {
			echo '<div class="bio">';
				echo genesis_get_custom_field('mcedc_bio_wysiwig');
			echo '</div><!--.end bio-->';
		}
    echo '</div><!--end #person -->';
}

/**
 * Customize After Endwhile
 *
 * @author The Pedestal Group
 */

function mcedc_person_after_endwhile() {
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