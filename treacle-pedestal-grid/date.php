<?php
/*
Template Name: Date Archive Template
*/
?>

<?php get_header() ?>
<div id="content" class="generic content alpha">
<div class="post">
<?php if (have_posts()) :?>
<?php  $post = $posts[0]; ?>
<?php  /* show month and year at top of monthly archives */ 
			 if (is_month()) { ?>				
			<h2><?php the_time('F Y'); ?></h2>
					
	 <?php  /* show month, day and year at top of daily archives */ } 
	 		elseif (is_day()) { ?>
			<h2><?php the_time('F j, Y'); ?></h2>

		<?php /* show year at top of year archives */ } 
			elseif (is_year()) { ?>
			<h2><?php the_time('Y'); ?></h2>

		<?php } ?>
		<?php endif; ?>

<ul style="padding-left:2em;">
<?php $posts = query_posts($query_string . '&nopaging=1'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<li>
<?php if (is_month()) {
        /* for monthly archives */
        echo "<a href='";
        the_permalink();
        echo "'><strong>";
				the_time ('l j');
				echo "</strong> | ";
				the_title ();
				echo "</a>";
}  

elseif (is_day()) {
        /* for daily archives */ 
        echo "<h3>";
				the_title();
        echo "</h3>";
				the_content(__('[continued...]'));
				echo "<p class='meta'>";
				_e('posted to '); 
				the_category(','); 
				echo " @ <a href='";
				the_permalink;
				echo "'>";
				the_time();
				echo "</a></p><br/>";
}


elseif (is_year()) {
          /* for yearly archives */
        echo "<a href='";
        the_permalink();
        echo "'><strong>";
				the_time ('j F');
				echo "</strong> | ";
				the_title ();
				echo "</a>";	
} 
?>
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
<?php get_footer ()?>