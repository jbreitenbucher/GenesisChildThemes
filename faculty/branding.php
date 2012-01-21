<?php
/**
 * This file adds a branding section to the Faculty Child Theme.
 *
 * @author Jon Breitenbucher
 * @package Faculty
 * @subpackage Customizations
 *
**/
$wordmark_url = get_stylesheet_directory_uri() .'/images/wordmark.gif';
?>

<div id="branding">
	<div class="wrap">
		<div class="alignleft wordmark">
			<h2><a href="http://wooster.edu">W<span style="font-stretch:condensed">oo</span>ster</a><span style="vertical-align:top;">Discovery</span></h2>
		</div>
		<div class="alignright tagline">
			<h1><?php bloginfo('name'); ?></h1>
			<p><?php bloginfo('description'); ?></p> 
		</div>
	</div>
</div>