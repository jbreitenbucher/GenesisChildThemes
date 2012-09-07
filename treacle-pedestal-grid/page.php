<?php get_header(); ?>
<div id="content" class="generic content alpha">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
<div class="post">
<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?>
 <span class="edit"><?php edit_post_link(__('edit this page')); ?></span>
</h2>

<div class="storycontent">
<?php the_content(__('[continued...]')); ?>
</div>
<p class="meta"><?php link_pages(); ?></p>	

<?php endwhile; else: ?>
	
<?php include (TEMPLATEPATH . '/errormessage.php'); ?>
	
<?php endif; ?>

</div> <!--end .post -->

<div style="text-align:center;">
| <a href="<?php echo get_bloginfo ('url') ?>"><?php _e ('home') ?></a> |
</div>
</div><!--end #content-->
<div id="sidebar" class="generic sidebar omega">
	<div id="topbar" class="generic topbar menu end">
		<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
	</div><!--end #column-top-->
	<div id="leftbar" class="generic leftbar menu alpha">
		<?php include (TEMPLATEPATH . '/column-one.php'); ?>
		<?php wp_meta(); ?>
	</div><!--end #column-one-->
	<div id="rightbar" class="generic rightbar menu omega">
		<?php include (TEMPLATEPATH . '/column-two.php'); ?>
	</div><!--end #column-two-->
</div><!--end #sidebar-->
<?php get_footer(); ?>
