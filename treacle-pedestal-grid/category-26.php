<?php
/*
Template Name: WoW Template
*/
?>
			<?php get_header(); ?>
		<div id="content" class="generic fivetwenty alpha">
                        <?php query_posts('p=541'); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); $do_not_duplicate = $post->ID; ?>

				<div class="post">
					<h2><?php echo date("F d, Y"); ?></h2>
					<h3 id="post-<?php the_ID(); ?>">
					<?php the_title(); ?> <span class="edit"><?php edit_post_link(__('edit this post')); ?></span>
					</h3>

					<div class="storycontent">
						<?php the_content(__('[continued...]')); ?>
					</div>

					<p class="meta">
						<?php _e("posted to"); ?> <?php the_category(',') ?>  @ <a href="<?php the_permalink() ?>" title="<?php _e('link to: ') ?><?php the_title() ?>"><?php the_time() ?></a>
					</p>	
					<p class="feedback">
						<?php wp_link_pages(); ?>
						<?php comments_popup_link(__('be the first to comment'), __('be the second to comment'), __('add to the % comments')); ?>
					</p>
					<p class="meta">
						<h3> Related posts</h3>
						<?php related_posts(); ?>
					</p>
					<!-- <?php trackback_rdf(); ?> -->
					<?php comments_template(); // Get comments.php template ?>
				</div><!--end .post-->

			<?php endwhile; else: ?>
			<?php include (TEMPLATEPATH . '/errormessage.php'); ?>
			<?php endif; ?>

                         
                        <?php query_posts('cat=26&showposts=10'); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); $do_not_duplicate = $post->ID; if ($post->ID == 541) continue; ?>

				<div class="post">
					<?php the_date('','<h2>','</h2>'); ?>
					<h3 id="post-<?php the_ID(); ?>">
					<?php the_title(); ?> <span class="edit"><?php edit_post_link(__('edit this post')); ?></span>
					</h3>

<?php if (p75GetVideo($post->ID)!=NULL) {
	echo "<div class=\"storycontent\">";
		the_content(__('[continued...]'));
                echo "<h3>Video for ";
                the_title();
                echo "</h3>";
		echo "<div class=\"storyvideo\">";
		    echo p75GetVideo($post->ID);
		echo "</div>";
	echo "</div>";
} else {
	echo "<div class=\"storycontent\">";
		the_content(__('[continued...]'));
	echo "</div>";
	}
?>

					<p class="meta">
						<?php _e("posted to"); ?> <?php the_category(',') ?>  @ <a href="<?php the_permalink() ?>" title="<?php _e('link to: ') ?><?php the_title() ?>"><?php the_time() ?></a>
					</p>	
					<p class="feedback">
						<?php wp_link_pages(); ?>
						<?php comments_popup_link(__('be the first to comment'), __('be the second to comment'), __('add to the % comments')); ?>
					</p>
					<p class="meta">
						<h3> Related posts</h3>
						<?php related_posts(); ?>
					</p>
					<!-- <?php trackback_rdf(); ?> -->
					<?php comments_template(); // Get comments.php template ?>
				</div><!--end .post-->

			<?php endwhile; else: ?>
			<?php include (TEMPLATEPATH . '/errormessage.php'); ?>
			<?php endif; ?>

			<h4>
				<?php posts_nav_link('','','previous page') ?> | <a href="<?php echo get_bloginfo ('url') ?>"><?php _e ('home') ?></a> | <?php posts_nav_link('','next page','') ?>
			</h4>
		</div><!--end #content-->
		<div id="leftbar" class="generic twotwenty menu">
			<?php include (TEMPLATEPATH . '/leftcolumn.php'); ?>
			<?php wp_meta(); ?>
		</div><!--end #leftbar-->
		<div id="rightbar" class="generic oneforty menu omega">
			<?php include (TEMPLATEPATH . '/rightcolumn.php'); ?>
		</div><!--end #rightbar-->
		<?php get_footer(); ?>