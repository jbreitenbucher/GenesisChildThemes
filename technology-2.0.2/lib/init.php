<?php
/**
 *
 * Init
 *
 * This file controls the initialization of the theme
 *
 * @package      technology
 * @author       Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright    Copyright (c) 2012, The College of Wooster
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version      SVN: $Id$
 * @since        1.0
 *
 */

// Define our theme settings
define( 'IT_SETTINGS_FIELD', 'it-settings' );

// Admin
require_once( get_stylesheet_directory() . '/lib/admin/admin.php' );

// Functions
require_once( get_stylesheet_directory() . '/lib/functions/general.php' );
require_once( get_stylesheet_directory() . '/lib/functions/post-types.php' );
require_once( get_stylesheet_directory() . '/lib/functions/taxonomies.php' );
require_once( get_stylesheet_directory() . '/lib/functions/metaboxes.php' );
require_once( get_stylesheet_directory() . '/lib/functions/shortcodes.php' );