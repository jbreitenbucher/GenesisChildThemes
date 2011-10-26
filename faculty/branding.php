<?php
/**
 * This file adds a branding section to the Faculty Child Theme.
 *
 * @author Jon Breitenbucher
 * @package Faculty
 * @subpackage Customizations
 *
**/
$wordmark_url = get_bloginfo('stylesheet_directory') .'/images/wordmark.gif';
?>

<div id="branding">
	<div class="wrap">
		<div class="alignleft">
			<a href="http://wooster.edu"><img src="<?php echo $wordmark_url ?>"></a>
		</div>
		<div class="alignright">
			<p>Independent Minds, Working Together.</p> 
		</div>
	</div>
</div>