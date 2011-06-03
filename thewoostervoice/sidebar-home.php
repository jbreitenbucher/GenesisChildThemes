<div id="sidebar" class="sidebar widget-area">
<?php
	genesis_before_sidebar_widget_area();
?>
	<div id='home-sidebar-left' class='widget-area'>
	<?php if (!dynamic_sidebar('Home Sidebar Left')) : ?>
		<div class="widget">
			<h4><?php _e("Home Sidebar Left", 'genesis'); ?></h4>
			<div class="wrap">
				<p><?php _e("This is a widgeted area which is called Home Sidebar Left. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen.", 'genesis'); ?></p>
			</div><!-- end .wrap -->
		</div><!-- end .widget -->
		<?php endif; ?> 
	</div><!-- end #home-sidebar-left -->
	<div id='home-sidebar-right' class='widget-area'>
	<?php if (!dynamic_sidebar('Home Sidebar Right')) : ?>
		<div class="widget">
			<h4><?php _e("Home Sidebar Right", 'genesis'); ?></h4>
			<div class="wrap">
				<p><?php _e("This is a widgeted area which is called Home Sidebar Right. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen.", 'genesis'); ?></p>
			</div><!-- end .wrap -->
		</div><!-- end .widget -->
		<?php endif; ?> 
	</div><!-- end #home-sidebar-right -->
<?php
	genesis_after_sidebar_widget_area();
?>
</div>