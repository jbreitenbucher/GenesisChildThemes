<?php
/**
 * This file adds a branding section to the Faculty Child Theme.
 *
 * @author Jon Breitenbucher
 * @package Faculty
 * @subpackage Customizations
 *
**/
$logotype_url = get_stylesheet_directory_uri() .'/images/logotype_177x65.png';
?>

<div id="branding">
	<div class="wrap">
		<div class="alignleft logotype">
			<a href="http://wooster.edu"><img src="<?php  echo $logotype_url; ?>" /></a>
		</div>
		<div class="alignright tagline">
			<h1><?php bloginfo('name'); ?></h1>
			<p><?php bloginfo('description'); ?></p> 
		</div>
	</div>
</div>
