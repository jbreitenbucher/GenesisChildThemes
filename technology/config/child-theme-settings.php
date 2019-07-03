<?php
/**
 * Technology theme settings.
 *
 * Genesis 2.9+ updates these settings when themes are activated.
 *
 * @package technology
 * @author  Jon Breitenbucher
 * @license GPL-2.0-or-later
 * @link    https://github.com/jbreitenbucher/GenesisChildThemes/technology-3
 * @version SVN: $Id$
 * @since   3.0
 *
 */

return array(
	GENESIS_SETTINGS_FIELD => array(
		'breadcrumb_home'           => 0,
		'breadcrumb_front_page'     => 0,
		'breadcrumb_posts_page'     => 0,
		'breadcrumb_single'         => 1,
		'breadcrumb_page'           => 1,
		'breadcrumb_archive'        => 1,
		'breadcrumb_404'            => 0,
		'breadcrumb_attachment'     => 0,
		'comments_posts'            => 0,  // bool
		'comments_pages'            => 0,  // bool
		'trackbacks_posts'          => 0,  // bool
		'trackbacks_pages'          => 0,  // bool
		'content_archive'           => 'excerpt',
		'content_archive_limit'     => 0,
		'content_archive_thumbnail' => 0,
		'image_size'                => 'thumbnail',
		'image_alignment'           => 'alignleft',
		'posts_nav'                 => 'numeric',
		'site_layout'               => 'content-sidebar',
	),
	'posts_per_page'       => 10,
);
