<?php
/**
 * This file adds the tab template to your theme.
 *
 * @author Mike Hemberger - @JiveDig
 * @link http://thestizmedia.com/tabbed-content-page-template-genesis
 * @package Genesis child theme
 * @license GPL-2.0-or-later
 * @version SVN: $Id$
 * @since   2.0
 */

/*
Template Name: Tabs
Template Post Type: project
*/

//* Enqueue tab js including jQuery UI Tabs
add_action( 'wp_enqueue_scripts', 'tsm_load_tab_script' );
function tsm_load_tab_script() {

	wp_enqueue_script( 'tsm-tabs', get_stylesheet_directory_uri() . '/lib/js/tsm-tabs.js', array( 'jquery-ui-tabs' ), '1.0.0', true );

}

// vars

//* Remove the post content and add our tabbed content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'tsm_do_tabbed_content' );
function tsm_do_tabbed_content() {
?>
	<div id="tsm-tab-wrap">

		<!-- Tab links -->
		<ul class="tsm-tabs">
			<li><a href="#tab_0">Overview</a></li>
			<li><a href="#tab_1">Goals</a></li>
			<li><a href="#tab_2">Resources</a></li>
			<li><a href="#tab_3">Tutorials</a></li>
			<li><a href="#tab_4">Assessment</a></li>
		</ul>

		<div class="tsm-tab-content">
			<!-- Tab content - id must match the href from the tab link -->
			<div id="tab_0">
				<h2>Overview</h2>
				<?php the_field('overview'); ?>
			</div>

			<div id="tab_1">
				<h2>Goals</h2>
				<?php the_field('goals'); ?>
			</div>
			
			<div id="tab_2">
				<h2>Resources</h2>
				<?php the_field('resources'); ?>
			</div>

			<div id="tab_3">
				<h2>Tutorials</h2>
				<?php the_field('tutorials'); ?>
			</div>
			
			<div id="tab_4">
				<h2>Assessment</h2>
				<?php the_field('assessment'); ?>
			</div>

		</div>

	</div>
<?php
}

//* Run the Genesis loop
genesis();