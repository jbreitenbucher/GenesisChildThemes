<?php
/**
 *
 * Init
 *
 * This file controls the initialization of the theme
 *
 * @package technology
 * @author  Jon Breitenbucher
 * @license GPL-2.0-or-later
 * @link    https://github.com/jbreitenbucher/GenesisChildThemes/technology
 * @version SVN: $Id$
 * @since   1.0
 *
 */

// Customizer settings
require_once( get_stylesheet_directory() . '/lib/customizer/customizer.php' );

// Functions
require_once( get_stylesheet_directory() . '/lib/functions/general.php' );
require_once( get_stylesheet_directory() . '/lib/functions/post-types.php' );
require_once( get_stylesheet_directory() . '/lib/functions/taxonomies.php' );
require_once( get_stylesheet_directory() . '/lib/functions/metaboxes.php' );
require_once( get_stylesheet_directory() . '/lib/functions/shortcodes.php' );