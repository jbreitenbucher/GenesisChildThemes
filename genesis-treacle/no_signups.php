<?php
/*
Template Name: No Signups
*/
?>

<?php get_header(); ?>

<?php genesis_before_content_sidebar_wrap(); ?>
<div id="content-sidebar-wrap">
	
	<?php genesis_before_content(); ?>
	<div id="content" class="no-signup">
	
		<?php genesis_before_loop(); ?>
		<div class="post">
			<div class="gate">
				&nbsp;
			</div>
			<h4>The way is shut!</h4>	
		</div><!-- end .post -->
	<?php genesis_after_loop(); ?>

</div><!-- end #content -->
<?php genesis_after_content(); ?>

</div><!-- end #content-sidebar-wrap -->
<?php genesis_after_content_sidebar_wrap(); ?>

<?php get_footer(); ?>