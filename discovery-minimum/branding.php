<?php
/**
 * This file adds a branding section to the Faculty Child Theme.
 *
 * @author Jon Breitenbucher
 * @package Discovery Minimum
 * @subpackage Customizations
 * <img src="<?php echo $wordmark_url ?>">
**/
$wordmark_url = get_bloginfo('stylesheet_directory') .'/images/wordmark.gif';
?>

<div id="branding">
	<div class="wrap">
		<div class="alignleft wordmark">
			<a href="http://wooster.edu">WOOSTER</a>
		</div>
		<div class="alignright tagline">
			<p>Independent Minds, Working Together.</p> 
		</div>
	</div>
</div>