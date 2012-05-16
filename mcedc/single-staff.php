<?php
/**
 * @package       dorman-farrell
 * @author          The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright      Copyright (c) 2012, Dorman Farrell
 * @license          http://opensource.org/licenses/gpl-2.0.php GNU Public License
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
    $about = get_post_meta($post->ID, 'mcedc_about_me_wysiwyg', TRUE);
    if (genesis_get_custom_field('mcedc_cert_text') != '') {
        printf( '<h2 class="name">%s, <span class="cert">%s</span></h2>', get_the_title(), genesis_get_custom_field('mcedc_cert_text') );
    } else {
        printf('<h2 class="name">%s</h2>', get_the_title() );
    }
    echo '<div class="post-inner">';
        if ( has_post_thumbnail() ) {
            echo '<div class="profile-image">';
                the_post_thumbnail('profile-picture-single');
            echo '</div> <!--end .profile-image -->';
                echo '<div class="person-content">';
                    echo $about;
                    //genesis_get_custom_field('mcedc_about_me_wysiwyg');
                echo '</div> <!--end .person-content -->';
            echo '</div> <!--end .post-inner -->';
        } else {
            echo '<div class="person-content">';
                echo $about;
                //genesis_get_custom_field('mcedc_about_me_wysiwyg');
            echo '</div><!--end .person-content -->';
        }
	echo '</div><!-- end .post-inner -->';
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