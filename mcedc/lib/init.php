<?php
/**
 * This file controls the initialization of the theme
 *
 * @package     mcedc
 * @author      The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright   Copyright (c) 2012, Medina County Economic Development Corporation
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

// Define our theme settings
define( 'MCEDC_SETTINGS_FIELD', 'mcedc-settings' );

// Admin
require_once( get_stylesheet_directory() . '/lib/admin/admin.php' );

// Functions
require_once( get_stylesheet_directory() . '/lib/functions/general.php' );
// require_once( get_stylesheet_directory() . '/lib/functions/post-types.php' );
// require_once( get_stylesheet_directory() . '/lib/functions/taxonomies.php' );
// require_once( get_stylesheet_directory() . '/lib/functions/metaboxes.php' );
// require_once( get_stylesheet_directory() . '/lib/functions/shortcodes.php' );