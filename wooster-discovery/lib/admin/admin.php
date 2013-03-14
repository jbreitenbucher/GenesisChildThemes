<?php
/**
 * Admin
 *
 * This file contains any functions related to the admin interface
 *
 * @package      expose
 * @author       Jon Breitenbucher <jon@breitenbucher.net>
 * @copyright    Copyright (c) 2012, The College of Wooster
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Register Theme Settings
 *
 * @author Jon Breitenbucher
 */

function jb_register_settings() {
	register_setting( JB_SETTINGS_FIELD, JB_SETTINGS_FIELD );
	add_option( JB_SETTINGS_FIELD , jb_option_defaults() );
	add_settings_section('jb_main','Main Settings', 'jb_main_section_text', JB_SETTINGS_FIELD );
	add_settings_field('jb_featured_cat_slug', 'Featured Category', 'jb_featured_cat_slug_setting', JB_SETTINGS_FIELD , 'jb_main');
	add_settings_field('jb_featured_content_limit', 'Homepage Featured Post Word Count Limit', 'jb_featured_content_limit_setting', JB_SETTINGS_FIELD , 'jb_main');
	add_settings_field('jb_post_content_limit', 'Post Word Count Limit', 'jb_post_content_limit_setting', JB_SETTINGS_FIELD , 'jb_main');
}

/**
 * Set Theme Options Defaults
 *
 * @author The Pedestal Group
 */

function jb_option_defaults() {
	 	$arr = array(
		'jb_featured_cat_slug' => 'home',
		'jb_featured_content_limit' => 55,
		'jb_post_content_limit' => 40
	);
	return $arr;
}

/**
 * Options Description
 *
 * @author Jon Breitenbucher
 */

function jb_main_section_text() {
	echo '<p>Main options for the theme.</p>';
}

/**
 * Featured category
 *
 * @author Jon Breitenbucher
 */

function jb_featured_cat_slug_setting() {
	echo '<p>' . _e( 'Enter the slug for the category of the posts to feature.', 'jb' ) . '</p>';
	echo "<input type='text' name='" . JB_SETTINGS_FIELD . "[jb_featured_cat_slug]' size='10' value='". genesis_get_option( 'jb_featured_cat_slug', JB_SETTINGS_FIELD ). "' />";
}

/**
 * Homepage Featured Post Word Count Limit
 *
 * @author Jon Breitenbucher
 */

function jb_featured_content_limit_setting() {
	echo '<p>' . _e( 'Enter the number of words to display in homepage featured posts.', 'jb' ) . '</p>';
	echo "<input type='text' name='" . JB_SETTINGS_FIELD . "[jb_featured_content_limit]' size='10' value='". genesis_get_option( 'jb_featured_content_limit', JB_SETTINGS_FIELD ). "' />";
}

/**
 * Post Word Count Limit
 *
 * @author Jon Breitenbucher
 */

function jb_post_content_limit_setting() {
	echo '<p>' . _e( 'Enter the number of words to display in non featured posts.', 'jb' ) . '</p>';
	echo "<input type='text' name='" . JB_SETTINGS_FIELD . "[jb_post_content_limit]' size='10' value='". genesis_get_option( 'jb_post_content_limit', JB_SETTINGS_FIELD ). "' />";
}

/**
 * Reset
 *
 * @author Jon Breitenbucher
 */

function jb_reset() {
	if ( ! isset( $_REQUEST['page'] ) || 'expose-settings' != $_REQUEST['page'] )
		return;

	if ( genesis_get_option( 'reset', JB_SETTINGS_FIELD ) ) {
		update_option( JB_SETTINGS_FIELD, jb_option_defaults() );
		wp_redirect( admin_url( 'admin.php?page=expose-settings&reset=true' ) );
		exit;
	}
}

/**
 * Admin Notices
 *
 * @author Jon Breitenbucher
 */

function jb_notices() {
	if ( ! isset( $_REQUEST['page'] ) || 'expose-settings' != $_REQUEST['page'] )
		return;

	if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] ) {
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings Reset', 'jb' ) . '</strong></p></div>';
	}
	elseif ( isset( $_REQUEST['settings-updated'] ) && 'true' == $_REQUEST['settings-updated'] ) {  
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings Saved', 'jb' ) . '</strong></p></div>';
	}
}

/**
 * Add Theme Options Menu
 *
 * @author Jon Breitenbucher
 */

function jb_add_menu() {
	add_submenu_page('genesis', __('Expose', 'jb'), __('Expose Settings', 'jb'), 'manage_options', 'expose-settings', 'jb_admin_page' );
}

/**
 * Theme Options Page
 *
 * @author Jon Breitenbucher
 */

function jb_admin_page() { ?>
	
	<div class="wrap">
		<?php screen_icon( 'options-general' ); ?>	
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		
		<form method="post" action="options.php">
		<?php settings_fields( JB_SETTINGS_FIELD ); // important! ?>
		<?php do_settings_sections( JB_SETTINGS_FIELD ); ?>
		
			<div class="bottom-buttons">
				<input type="submit" class="button-primary" value="<?php _e('Save Settings', 'jb') ?>" />
				<input type="submit" class="button-highlighted" name="<?php echo JB_SETTINGS_FIELD; ?>[reset]" value="<?php _e('Reset Settings', 'jb'); ?>" />
			</div>
			
		</form>
	</div>
	
<?php }

/**
 * Sanitize Theme Options
 *
 * @author Jon Breitenbucher
 */

function jb_sanitization_filters() {
	genesis_add_option_filter( 'no_html', JB_SETTINGS_FIELD, array( 'jb_featured_cat_slug' ) );
	genesis_add_option_filter( 'no_html', JB_SETTINGS_FIELD, array( 'jb_featured_content_limit' ) );
	genesis_add_option_filter( 'no_html', JB_SETTINGS_FIELD, array( 'jb_post_content_limit' ) );
}