<?php get_header() ?>
<div id="content" class="generic content alpha">
<div class="post">

<h2><?php echo single_cat_title(); ?></h2>

<ul style="padding-left:2em;">
<?php $posts = query_posts($query_string . '&nopaging=1'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<li>
			<a href="<?php the_permalink() ?>">
			<strong><?php the_time('d.m.y'); ?></strong> | 
			<?php the_title(); ?> </a>
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