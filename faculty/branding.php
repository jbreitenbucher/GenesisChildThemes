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
			<a href="http://wooster.edu"><img src="<?php echo $wordmark_url ?>"></a>
		</div>
		<div class="alignright tagline">
			<p>Independent Minds, Working Together.</p> 
		</div>
	</div>
</div>