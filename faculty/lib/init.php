<?php
/**
 * This file controls all parts of the Faculty Child Theme Initialization.
 *
 * @package Faculty
 * @author StudioPress & Gary Jones
 */

/**
 * Add theme support for displaying menu item
 * @since 0.9.8
 */
add_theme_support('faculty-design-settings');

/**
 * The key the settings are stored under in the database.
 */
define('FACULTY_SETTINGS_FIELD', 'faculty_settings');

/**
 * The translation domain for __() and _e().
 */
define('FACULTY_DOMAIN', 'faculty');

// Functions
require_once( get_stylesheet_directory() . '/lib/functions/I18n.php');
require_once( get_stylesheet_directory() . '/lib/functions/design-settings.php');
require_once( get_stylesheet_directory() . '/lib/functions/widgets.php');

// Structure
require_once( get_stylesheet_directory() . '/lib/structure/stylesheets.php');
require_once( get_stylesheet_directory() . '/lib/structure/export.php');
require_once( get_stylesheet_directory() . '/lib/structure/import.php');

// Settings pages
require_once( get_stylesheet_directory() . '/lib/admin/design-settings.php');
//require_once( get_stylesheet_directory() . '/lib/admin/custom-header.php');