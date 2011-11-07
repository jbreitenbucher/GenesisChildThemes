<?php
/**
 * This file deals with making the Faculty child theme translatable.
 *
 * @package Faculty
 * @author Gary Jones
 * @since 1.0
 */
// used for theme localization
load_child_theme_textdomain('faculty', get_stylesheet_directory() . '/lib/languages');
$locale = get_locale();
$locale_file = get_stylesheet_directory() . '/lib/languages' . "/$locale.php";
if ( is_readable( $locale_file ) )
    require_once( $locale_file );