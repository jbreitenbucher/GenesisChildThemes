<?php
/**
 * Admin
 *
 * This file contains any functions related to the admin interface
 *
 * @package      dorman-farrell
 * @author       The Pedestal Group <kathy@thepedestalgroup.com>
 * @copyright    Copyright (c) 2012, Dorman Farrell
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Register Theme Settings
 *
 * @author The Pedestal Group
 */

function tpg_register_settings() {
	register_setting( TPG_SETTINGS_FIELD, TPG_SETTINGS_FIELD );
	add_option( TPG_SETTINGS_FIELD , tpg_option_defaults() );
	add_settings_section('tpg_staff','Staff Settings', 'tpg_staff_section_text', TPG_SETTINGS_FIELD );
	add_settings_field('tpg_num_posts', 'Staff Per Page', 'tpg_num_posts_setting', TPG_SETTINGS_FIELD , 'tpg_staff');
	add_settings_section('tpg_general','General Settings', 'tpg_general_section_text', TPG_SETTINGS_FIELD );
	add_settings_field('tpg_blog_cat', 'Blog Category', 'tpg_blog_cat_setting', TPG_SETTINGS_FIELD , 'tpg_general');
}

/**
 * Set Theme Options Defaults
 *
 * @author The Pedestal Group
 */

function tpg_option_defaults() {
	 	$arr = array(
		'tpg_staff_posts_per_page' => 15,
		'tpg_blog_cat' => 'articles'
	);
	return $arr;
}

/**
 * Options Description
 *
 * @author The Pedestal Group
 */

function tpg_section_text() {
	echo '<p>These options control various aspects of the display of staff content for the Dorman Farrell theme.</p>';
}

/**
 * Staff Posts Per Page
 *
 * @author The Pedestal Group
 */

function tpg_num_posts_setting() {
	echo '<p>' . _e( 'Enter the number of staff you would like to display in staff listings.', 'tpg' ) . '</p>';
	echo "<input type='text' name='" . TPG_SETTINGS_FIELD . "[tpg_staff_posts_per_page]' size='10' value='". genesis_get_option( 'tpg_staff_posts_per_page', TPG_SETTINGS_FIELD ). "' />";
}

/**
 * Blog Category
 *
 * @author The Pedestal Group
 */

function tpg_blog_cat_setting() {
	echo '<p>' . _e( 'Enter the name or slug used for the blog category.', 'tpg' ) . '</p>';
	echo "<input type='text' name='" . TPG_SETTINGS_FIELD . "[tpg_blog_cat]' size='20' value='" . genesis_get_option( 'tpg_blog_cat', TPG_SETTINGS_FIELD ) . "' />";
}

/**
 * Reset
 *
 * @author The Pedestal Group
 */

function tpg_reset() {
	if ( ! isset( $_REQUEST['page'] ) || 'dorman-farrell-settings' != $_REQUEST['page'] )
		return;

	if ( genesis_get_option( 'reset', TPG_SETTINGS_FIELD ) ) {
		update_option( TPG_SETTINGS_FIELD, tpg_option_defaults() );
		wp_redirect( admin_url( 'admin.php?page=dorman-farrell-settings&reset=true' ) );
		exit;
	}
}

/**
 * Admin Notices
 *
 * @author The Pedestal Group
 */

function tech_notices() {
	if ( ! isset( $_REQUEST['page'] ) || 'dorman-farrell-settings' != $_REQUEST['page'] )
		return;

	if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] ) {
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings Reset', 'df' ) . '</strong></p></div>';
	}
	elseif ( isset( $_REQUEST['settings-updated'] ) && 'true' == $_REQUEST['settings-updated'] ) {  
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings Saved', 'df' ) . '</strong></p></div>';
	}
}

/**
 * Add Theme Options Menu
 *
 * @author The Pedestal Group
 */

function tpg_add_menu() {
	add_submenu_page('genesis', __('Dorman Farrell','tpg'), __('Dorman Farrell Settings','tpg'), 'manage_options', 'dorman-farrell-settings', 'tpg_admin_page' );
}

/**
 * Theme Options Page
 *
 * @author The Pedestal Group
 */

function tpg_admin_page() { ?>
	
	<div class="wrap">
		<?php screen_icon( 'options-general' ); ?>	
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		
		<form method="post" action="options.php">
		<?php settings_fields( TPG_SETTINGS_FIELD ); // important! ?>
		<?php do_settings_sections( TPG_SETTINGS_FIELD ); ?>
		
			<div class="bottom-buttons">
				<input type="submit" class="button-primary" value="<?php _e('Save Settings', 'genesis') ?>" />
				<input type="submit" class="button-highlighted" name="<?php echo TPG_SETTINGS_FIELD; ?>[reset]" value="<?php _e('Reset Settings', 'genesis'); ?>" />
			</div>
			
		</form>
	</div>
	
<?php }

/**
 * Sanitize Theme Options
 *
 * @author The Pedestal Group
 */

function tpg_staff_sanitization_filters() {
	genesis_add_option_filter( 'no_html', TPG_SETTINGS_FIELD, array( 'tpg_staff_posts_per_page' ) );
	genesis_add_option_filter( 'no_html', TPG_SETTINGS_FIELD, array( 'tpg_blog_cat' ) );
}