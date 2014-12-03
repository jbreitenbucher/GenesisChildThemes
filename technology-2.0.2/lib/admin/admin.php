<?php
/**
 * Admin
 *
 * This file contains any functions related to the admin interface
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
 * Register Theme Settings
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_register_settings() {
	register_setting( IT_SETTINGS_FIELD, IT_SETTINGS_FIELD );
	add_option( IT_SETTINGS_FIELD , tech_option_defaults() );
	add_settings_section('it_staff','Staff Settings', 'tech_section_text', IT_SETTINGS_FIELD );
	add_settings_field('num_posts', 'Staff Per Page', 'tech_num_posts_setting', IT_SETTINGS_FIELD , 'it_staff');
	add_settings_field('student_slug', 'Student Worker Info', 'tech_student_slug_setting', IT_SETTINGS_FIELD , 'it_staff');
	add_settings_field('staff_slug', 'Professional Staff Slugs', 'tech_staff_slug_setting', IT_SETTINGS_FIELD , 'it_staff');
	add_settings_section('it_general','General Settings', 'general_section_text', IT_SETTINGS_FIELD );
	add_settings_field('blog_cat', 'Blog Category', 'tech_blog_cat_setting', IT_SETTINGS_FIELD , 'it_general');
}

/**
 * Set Theme Options Defaults
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_option_defaults() {
		$arr = array(
		'technology_staff_posts_per_page' => 4,
		'technology_staff_student_role' => 'sta',
		'technology_staff_professional_roles' => '',
		'technology_student_schedule' => '',
		'technology_blog_cat' => 'it-blog'
	);
	return $arr;
}

/**
 * Options Description
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_section_text() {
	echo '<p>These options control various aspects of the display of content for the Technology theme.</p>';
}

/**
 * Staff Posts Per Page
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_num_posts_setting() {
	echo '<p>' . _e( 'Enter the number of staff you would like to display in staff listings.', 'it' ) . '</p>';
	echo "<input type='text' name='" . IT_SETTINGS_FIELD . "[technology_staff_posts_per_page]' size='10' value='". genesis_get_option( 'technology_staff_posts_per_page', IT_SETTINGS_FIELD ). "' />";
}

/**
 * Student Related settings
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_student_slug_setting() {
	echo '<p>' . _e( 'Enter the slug of the term used for student workers. (Controls display of the Google spreadsheet for the student worker schedule.)', 'it' ) . '</p>';
	echo "<input type='text' name='" . IT_SETTINGS_FIELD . "[technology_staff_student_role]' size='10' value='" . genesis_get_option( 'technology_staff_student_role', IT_SETTINGS_FIELD ) . "' /><br /><br />";
	echo '<p>' . _e( 'Enter the key for the Google spreadsheet of the student schedule. The corresponding spreadsheet will be displayed on the student worker page.', 'it' ) . '</p>';
	echo "<input type='text' name='" . IT_SETTINGS_FIELD . "[technology_student_schedule]' size='50' value='" . genesis_get_option( 'technology_student_schedule', IT_SETTINGS_FIELD ) . "' />";
}

/**
 * Staff Slug(s)
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_staff_slug_setting() {
	echo '<p>' . _e( 'Enter a comma separated list of the slugs used for professional staff. (like user-services,applications-development) This controls which staff are displayed on the Staff page template.', 'it' ) . '</p>';
	echo "<input type='text' name='" . IT_SETTINGS_FIELD . "[technology_staff_professional_roles]' size='50' value='" . genesis_get_option( 'technology_staff_professional_roles', IT_SETTINGS_FIELD ) . "' />";
}

/**
 * Blog Category
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_blog_cat_setting() {
	echo '<p>' . _e( 'Enter the name or slug used for the blog category.', 'it' ) . '</p>';
	echo "<input type='text' name='" . IT_SETTINGS_FIELD . "[technology_blog_cat]' size='20' value='" . genesis_get_option( 'technology_blog_cat', IT_SETTINGS_FIELD ) . "' />";
}

/**
 * Reset
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_reset() {
	if ( ! isset( $_REQUEST['page'] ) || 'technology-settings' != $_REQUEST['page'] )
		return;

	if ( genesis_get_option( 'reset', IT_SETTINGS_FIELD ) ) {
		update_option( IT_SETTINGS_FIELD, tech_option_defaults() );
		wp_redirect( admin_url( 'admin.php?page=technology-settings&reset=true' ) );
		exit;
	}
}

/**
 * Admin Notices
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_notices() {
	if ( ! isset( $_REQUEST['page'] ) || 'technology-settings' != $_REQUEST['page'] )
		return;

	if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] ) {
		echo '<div id="message" class="updated"><p><strong>' . __( 'Technology Settings Reset', 'technology' ) . '</strong></p></div>';
	}
	elseif ( isset( $_REQUEST['settings-updated'] ) && 'true' == $_REQUEST['settings-updated'] ) {	
		echo '<div id="message" class="updated"><p><strong>' . __( 'Technology Settings Saved', 'technology' ) . '</strong></p></div>';
	}
}

/**
 * Add Theme Options Menu
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_add_menu() {
	add_submenu_page('genesis', __('Technology Settings','it'), __('Technology Settings','it'), 'manage_options', 'technology-settings', 'tech_admin_page' );
}

/**
 * Theme Options Page
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_admin_page() { ?>
	
	<div class="wrap">
		<?php //screen_icon( 'options-general' ); ?>	
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		
		<form method="post" action="options.php">
		<?php settings_fields( IT_SETTINGS_FIELD ); // important! ?>
		<?php do_settings_sections( IT_SETTINGS_FIELD ); ?>
		
			<div class="bottom-buttons">
				<input type="submit" class="button-primary" value="<?php _e('Save Settings', 'genesis') ?>" />
				<input type="submit" class="button-highlighted" name="<?php echo IT_SETTINGS_FIELD; ?>[reset]" value="<?php _e('Reset Settings', 'genesis'); ?>" />
			</div>
			
		</form>
	</div>
	
<?php }

/**
 * Sanitize Theme Options
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_staff_sanitization_filters() {
	genesis_add_option_filter( 'no_html', IT_SETTINGS_FIELD, array( 'technology_staff_posts_per_page' ) );
	genesis_add_option_filter( 'no_html', IT_SETTINGS_FIELD, array( 'technology_staff_student_role' ) );
	genesis_add_option_filter( 'no_html', IT_SETTINGS_FIELD, array( 'technology_student_schedule' ) );
	genesis_add_option_filter( 'no_html', IT_SETTINGS_FIELD, array( 'technology_staff_professional_roles' ) );
	genesis_add_option_filter( 'no_html', IT_SETTINGS_FIELD, array( 'technology_blog_cat' ) );
}

/**
 * Admin Header Callback
 *
 * Register a custom admin callback to display the custom header preview with
 * the same style as is shown on the front end.
 *
 * @author      Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @version     SVN: $Id$
 * @since       1.0
 *
 */

function tech_admin_style() {
	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Shanti, arial, serif; min-height: %spx; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-family: Shanti, arial, serif; font-size: 48px; font-weight: normal; line-height: 48px; margin: 10px 0 0; text-align: center; text-decoration: none; text-shadow: #fff 1px 1px; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { color: #%s; font-family: Arial, Helvetica, Tahoma, sans-serif; font-size: 14px; font-style: italic; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}