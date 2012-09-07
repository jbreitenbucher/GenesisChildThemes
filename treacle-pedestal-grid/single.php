<?php get_header(); ?>

<div id="content" class="generic content alpha">
<div class="post">
				
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h4>
<?php previous_post('%','','yes') ?> | 
<a href="<?php echo get_bloginfo ('url') ?>"><?php _e ('home') ?></a> | 
<?php next_post(' % ','','yes') ?>
</h4>

<?php if (function_exists('tweetmeme')) echo tweetmeme(); ?><h2><?php the_date () ?></h2>
<h3 id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>><?php the_title(); ?>
 <span class="edit"><?php edit_post_link(__('edit this post')); ?></span>
</h3>

<?php
	if (p75GetVideo($post->ID)!=NULL) {
		echo "<div class=\"storycontent clearfix\">";
			the_content(__('[continued...]'));
			echo "<h3>Video for ";
				the_title();
			echo "</h3>";
			echo "<div class=\"storyvideo\">";
				echo p75GetVideo($post->ID);
			echo "</div>";
		echo "</div>";
	} else {
		echo "<div class=\"storycontent clearfix\">";
			the_content(__('[continued...]'));
		echo "</div>";
	}
?>
<div class="postfooter">
	<p class="meta">
		<?php _e("posted to"); ?> <?php the_category(',') ?>  @ <a href="<?php the_permalink() ?>" title="<?php _e('link to: ') ?><?php the_title() ?>"><?php the_time() ?></a>
	</p>	
	<p class="feedback">
		<?php wp_link_pages(); ?>
		<?php comments_popup_link(__('be the first to comment'), __('be the second to comment'), __('add to the % comments')); ?>
	</p>
	<p class="meta">
		<?php the_tags('Tagged with: ','  ','<br />'); ?>
	</p>
</div>						
		
	<?php comments_template(); ?>
	
	<?php endwhile; else: ?>
	
			<?php include (TEMPLATEPATH . '/errormessage.php'); ?>
	
<?php endif; ?>

<h4>
<?php previous_post('%','','yes') ?> | 
<a href="<?php echo get_bloginfo ('url') ?>"><?php _e ('home') ?></a> | 
<?php next_post(' % ','','yes') ?>
</h4>

</div><!--end .post -->
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