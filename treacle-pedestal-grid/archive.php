<?php get_header() ?>
<div id="content" class="generic content alpha">
<?php if (have_posts()) : ?>
<?php $post = $posts[0]; ?>
		 
<?php /* search results */ if (is_search()) { ?>				
		<h2>search results</h2>
		
	  <?php /* author archives */ } elseif (is_author()) { ?>
		<h2><?php the_author () ?></h2>

		<?php } ?>

<div class="post">

<?php if (have_posts()) : ?>
<?php $post = $posts[0]; ?>

<ul style="padding-left:2em;">
<?php while (have_posts()) : the_post(); ?>
<li>
<h3><a href="<?php the_permalink() ?>">
<?php the_time('d.m.y'); ?> : 
<?php the_title(); ?> </a></h3>
<?php the_excerpt(); ?>
</li>

      <?php endwhile; ?>

</ul>
     <?php else : ?>
<?php include (TEMPLATEPATH . '/errormessage.php'); ?>
    <?php endif; ?>
		
</div><!-- end .post -->

<h4>
<?php next_posts_link('previous page') ?> | <a href="<?php echo get_bloginfo ('url') ?>"><?php _e ('home') ?></a> | <?php previous_posts_link('next page') ?>
</h4>
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
<?php get_footer () ?>