<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

<?php genesis_before_content_sidebar_wrap(); ?>
<div id="content-sidebar-wrap">
	
	<?php get_sidebar(); ?>
	
	<?php genesis_before_content(); ?>
	<div id="content" class="hfeed">

		<div id="homepage-widgets">
			<?php if (!dynamic_sidebar('Homepage Widgets')) : ?>
					<div class="widget">
						<h4><?php _e("Homepage Widgets", 'genesis'); ?></h4>
						<div class="wrap">
							<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it.", 'genesis'); ?></p>
						</div><!-- end .wrap -->
					</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .homepage-widgets -->
		
	</div><!-- end #content -->
	<?php genesis_after_content(); ?>

</div><!-- end #content-sidebar-wrap -->
<?php genesis_after_content_sidebar_wrap(); ?>

<?php get_footer(); ?>