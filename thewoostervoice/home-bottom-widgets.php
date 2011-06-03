<?php
/**
 * This file adds footer widgets to the The Wooster Voice Child Theme.
 *
 * @author Jon Breitenbucher
 * @package The Wooster Voice
 * @subpackage Customizations
 */

if ( is_active_sidebar('Home Bottom Left') || is_active_sidebar('Home Bottom Right')) : ?>
<div id="footer-widgeted">
	<div class="wrap">
    	<div class="home-bottom-left">
        	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom Left') ) : ?>
						<div class="widget">
							<h4><?php _e("Home Featured Top", 'genesis'); ?></h4>
							<div class="wrap">
								<p><?php _e("This is a widgeted area which is called Home Bottom Left. It is using the Genesis - Featured Posts widget to display what you see on the demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Posts widget into the Featured Top widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit page screen and publish your page. The Featured Posts widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
							</div><!-- end .wrap -->
						</div><!-- end .widget -->
	    	<?php endif; ?> 
   		</div><!-- end .home-bottom-left -->
    	<div class="home-bottom-right">
        	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom Right') ) : ?>
						<div class="widget">
							<h4><?php _e("Home Featured Top", 'genesis'); ?></h4>
							<div class="wrap">
								<p><?php _e("This is a widgeted area which is called Home Bottom Right. It is using the Genesis - Featured Posts widget to display what you see on the demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Posts widget into the Featured Top widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit page screen and publish your page. The Featured Posts widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
							</div><!-- end .wrap -->
						</div><!-- end .widget -->
   	    	<?php endif; ?> 
    	</div><!-- end .home-bottom-right -->
	</div><!-- end .wrap -->
</div><!-- end #footer-widgeted -->
<?php endif; ?>