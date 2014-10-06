<?php
/**
 * Template Name: Training Videos
 *
 * This template should be used to display Wooster Technology training videos placed on YouTube.
 *
 * @package      technology
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright    Copyright (c) 2012, The College of Wooster
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version      SVN: $Id$
 * @since        2.01
 *
 */

/**
 * Full width layout
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

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

add_action('genesis_before','it_training_videos_loop_setup');
function it_training_videos_loop_setup() {
	
	if ( ! genesis_html5() ) {
		// Customize Before Loop
		remove_action('genesis_before_loop','genesis_do_before_loop' );
		add_action('genesis_before_loop','it_training_videos_before_loop');
	
		// Remove Post Info
		remove_action('genesis_before_post_content', 'genesis_post_info');
	
		// Customize Post Content
		remove_action('genesis_post_content','genesis_do_post_content');
		add_action('genesis_post_content','it_training_videos_post_content');
	
		// Remove Title, After Title, and Post Image
		remove_action('genesis_post_title', 'genesis_do_post_title');
		//remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
		//remove_action('genesis_post_content', 'genesis_do_post_image');
	
		// Remove Post Meta
		remove_action('genesis_after_post_content', 'genesis_post_meta');
	} else {
    			// Customize Before Loop
   		remove_action('genesis_before_loop','genesis_do_before_loop' );
		add_action('genesis_before_loop','it_training_videos_before_loop');

		// Remove Post Info
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

		// Customize Post Content
		remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
		add_action( 'genesis_entry_content', 'it_training_videos_post_content' );

		// Remove Title, After Title, and Post Image
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		//remove_action('genesis_after_post_title', 'genesis_do_after_post_title');
		//remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );

		// Remove Post Meta
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	}
}

/**
 * Customize Before Loop
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

function it_training_videos_before_loop() {
	echo '<h1>' . get_the_title() . '</h1>';
	global $post;
	echo '<div class="page-content">' . apply_filters('the_content', $post->post_content) . '</div>';
}

/**
 * Customize the page content
 *
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version      SVN: $Id$
 * @since        2.01
 *
 */
function it_training_videos_post_content() {
$uri = 'http://gdata.youtube.com/feeds/api/videos?author=WoosterHelpdesk';
$feed = fetch_feed( $uri );

if ( is_wp_error( $feed ) ) {
    return false;
} else {
    $maxitems = $feed->get_item_quantity( 10 );
    $rss_items = $feed->get_items( 0, $maxitems );

    if ( $maxitems == 0 ) :
        return false;
    else :
        if ( is_array( $rss_items ) ) : ?>
        <div id="videos">
		    <div class="video_player">
		    <?php
		    $i = 0;
		    foreach ( $rss_items as $item ) :
		        if ( $i++ > 0 )
		            break;
		        $id = wptuts_get_yt_ID( $item->get_permalink() );
		    ?>
		        <iframe width="610" height="344" src="http://www.youtube.com/embed/<?php echo $id; ?>" frameborder="0" allowfullscreen></iframe>
		    <?php endforeach; ?>
		    </div>
		    <ul class="video_thumbs">
		    <?php
		    foreach ( $rss_items as $item ) :
		        $id = wptuts_get_yt_ID( $item->get_permalink() );
		        $enclosure = $item->get_enclosure();
		    ?>
		        <li>
		            <p><a href="http://www.youtube.com/embed/<?php echo $id; ?>"><img src="<?php echo esc_url( $enclosure->get_thumbnail() ); ?>" width="290" height="164" /></a></p>
		            <p><a href="http://www.youtube.com/embed/<?php echo $id; ?>"><?php esc_html_e( $item->get_title() ); ?></a></p>
		        </li>
		    <?php endforeach; ?>
		    </ul>
		</div>
        <?php endif;
    endif;
}
}

genesis();