<?php get_header(); ?>

<?php genesis_before_content_sidebar_wrap(); ?>
<div id="content-sidebar-wrap">

	<?php genesis_before_content(); ?>
	<div id="content" class="hfeed">
	
		<?php if( function_exists('dynamic_content_gallery') ) : ?>
            <div class="dcg">
				<?php dynamic_content_gallery(); ?>
			</div><!-- end .dcg -->
		<?php endif; ?>
				
		<div id="featured-top">
			<div class="featured-top-left">
				<?php if (!dynamic_sidebar('Featured Top Left')) : ?>
					<div class="widget">
						<h4><?php _e("Featured Top Left", 'genesis'); ?></h4>
						<div class="wrap">
							<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it. This is an example of a text widget that you can use for various things.", 'genesis'); ?></p>
						</div><!-- end .wrap -->
					</div><!-- end .widget -->
				<?php endif; ?>
			</div><!-- end .featured-top-left -->
			<div class="featured-top-right">
				<?php if (!dynamic_sidebar('Featured Top Right')) : ?>
					<div class="widget">
						<h4><?php _e("Featured Top Right", 'genesis'); ?></h4>
						<div class="wrap">
							<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it. This is an example of a text widget that you can use for various things.", 'genesis'); ?></p>
						</div><!-- end .wrap -->
					</div><!-- end .widget -->
				<?php endif; ?>
			</div><!-- end .featured-top-right -->
		</div><!-- end #featured-top -->		
		
		<div id="featured-bottom">
			<?php if (!dynamic_sidebar('Featured Bottom')) : ?>
				<div class="widget">
					<h4><?php _e("Featured Bottom", 'genesis'); ?></h4>
					<div class="wrap">
						<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it. This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it. This is an example of a text widget that you can place to describe a particular product or service. ", 'genesis'); ?></p>
					</div><!-- end .wrap -->
				</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end #featured-bottom -->	
		
	</div><!-- end #content -->
	<?php genesis_after_content(); ?>

</div><!-- end #content-sidebar-wrap -->
<?php genesis_after_content_sidebar_wrap(); ?>

<?php get_footer(); ?>