<?php

/**
 * Shortcodes
 *
 * This file creates all the shortcodes used throughout the site.
 *
 * @package      technology
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright    Copyright (c) 2012, The College of Wooster
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version      SVN: $Id$
 * @since        1.0
 *
 */
 
 
/**
 * Use shortcodes in widgets
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Re-usable RSS feed reader with shortcode
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

if ( !function_exists('base_rss_feed') ) {
	function base_rss_feed($size = 5, $feed = 'http://wordpress.org/news/feed/', $date = false, $cache_time = 1800)
	{
		// Include SimplePie RSS parsing engine
		include_once ABSPATH . WPINC . '/feed.php';
 
		// Set the cache time for SimplePie
		add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', "return cache_time;" ) );
 
		// Build the SimplePie object
		$rss = fetch_feed($feed);
 
		// Check for errors in the RSS XML
		if (!is_wp_error( $rss ) ) {
 
			// Set a limit for the number of items to parse
			$maxitems = $rss->get_item_quantity($size);
			$rss_items = $rss->get_items(0, $maxitems);
 
			// Store the total number of items found in the feed
			$i = 0;
			$total_entries = count($rss_items);
 
			// Output HTML
			$html = "<ul class='feedlist'>";
			foreach ($rss_items as $item) {
				$i++;
 
				// Add a class of "last" to the last item in the list
				if( $total_entries == $i ) {
					$last = " class='last'";
				} else {
					$last = "";
				}
 
				// Store the data we need from the feed
				$title = $item->get_title();
				$link = $item->get_permalink();
				$desc = $item->get_description();
				$date_posted = $item->get_date('F j, Y');
 
				// Output
				$html .= "<li id='post-$i'$last>";
				$html .= "<h3><a href='$link'>$title</a></h3>";
				if( $date == true ) $html .= "<span class='date'>$date_posted</span>";
				$html .= "<div class='rss-entry'>$desc</div>";
				$html .= "</li>";
			}
			$html .= "</ul>";
 
		} else {
 
			$html = "An error occurred while parsing your RSS feed. Check that it's a valid XML file.";
 
		}
 
		return $html;
	}
}

/**
 * Define [rss] shortcode
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

if( function_exists('base_rss_feed') && !function_exists('base_rss_shortcode') ) {
	function base_rss_shortcode($atts) {
		extract(shortcode_atts(array(
			'size' => '10',
			'feed' => 'http://wordpress.org/news/feed/',
			'date' => false,
		), $atts));
 
		$content = base_rss_feed($size, $feed, $date);
		return $content;
	}
	add_shortcode("rss", "base_rss_shortcode");
}