<?php
/**
 * Index
 *
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
// Customize Post Content
add_action('genesis_before','tpg_index_loop_setup');
function tpg_index_loop_setup() {
    
    // Remove Before Loop
    remove_action('genesis_before_loop','genesis_do_before_loop' );
    
    // Remove Post Info
    remove_action('genesis_before_post_content', 'genesis_post_info');
    
    // Customize Post Content
    remove_action('genesis_post_content','genesis_do_post_content');
    add_action('genesis_post_content','tpg_index_content');
    
    // Remove Title, After Title, and Post Image
    remove_action('genesis_post_title', 'genesis_do_post_title');
    remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
    remove_action('genesis_post_content', 'genesis_do_post_image');
    
    // Remove Post Meta
    remove_action('genesis_after_post_content', 'genesis_post_meta');
    
    // Customize After Endwhile
    remove_action('genesis_after_endwhile','genesis_do_after_endwhile');
    remove_action('genesis_after_endwhile', 'genesis_posts_nav');
    add_action('genesis_after_endwhile', 'tpg_index_after_endwhile');
}

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

/**
 * Customize Post Content
 *
 * @author The Pedestal Group
 */

function tpg_index_content() {
    if ( has_post_thumbnail() ) {
        echo '<div class="post-image">';
            the_post_thumbnail('post_thumb');
        echo '</div>';
        echo '<div class="post-inner-image">';
            genesis_do_post_title();
            echo '<div class="post-content">';
                the_content();
            echo '</div>';
        echo '</div>';
    } else {
    echo '<div class="post-inner">';
        genesis_do_post_title();
        echo '<div class="post-content">';
            the_content();
        echo '</div>';
    echo '</div>';
    }
}

/**
 * Customize After Endwhile
 *
 * @author The Pedestal Group
 */

function tpg_index_after_endwhile() {
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