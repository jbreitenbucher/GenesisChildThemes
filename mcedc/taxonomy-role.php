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
    
    // Remove Post Info
    remove_action('genesis_before_post_content', 'genesis_post_info');
    
    // Customize Post Content
    remove_action('genesis_post_content','genesis_do_post_content');
    add_action('genesis_post_content','mcedc_role_post_content');
    
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

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function mcedc_role_post_content () {
    global $post;
    printf( '<div id="post-%s" class="person clear">', get_the_ID() );
        //use the genesis_get_custom_field template tag to display each custom field value
        echo '<div class="contact">';
        $default_attr = array(
               'class' => "alignleft profile-image-listing",
               'alt'   => $post->post_title,
               'title' => $post->post_title
           );
        echo genesis_get_image( array( 'size' => 'profile-picture-listing', 'attr' => $default_attr ) );
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
            previous_posts_link('Previous &rarr;');
        echo '</div>';
        echo '<div class="alignleft">';
            next_posts_link('&larr; More');
        echo '</div>';
    echo '</div>';
}

genesis();