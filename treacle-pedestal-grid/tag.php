<?php get_header(); ?>
		<div id="content" class="generic content alpha">
			<h2><?php echo single_tag_title('Currently browsing '); ?></h2>
			<?php if (have_posts()) : while (have_posts()) : the_post(); $do_not_duplicate = $post->ID; ?>
			<div class="post">
						<?php the_date('','<h2>','</h2>'); ?>
						<h3 id="post-<?php the_ID(); ?>">
							<a href="<?php the_permalink() ?>"><?php the_title(); ?></a> <span class="edit"><?php edit_post_link(__('edit this post')); ?></span>
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
					<p class="meta">
						<h3> Related posts</h3>
						<?php if(function_exists('echo_ald_crp')) echo_ald_crp(); ?>
					</p>
					<p class="meta">
						<?php echo '<ul class="addtoany_list">'; if(function_exists('ADDTOANY_SHARE_SAVE_ICONS') ) ADDTOANY_SHARE_SAVE_ICONS( array("html_wrap_open" => "<li>", "html_wrap_close" => "</li>") ); if(function_exists('ADDTOANY_SHARE_SAVE_BUTTON') ) ADDTOANY_SHARE_SAVE_BUTTON( array("html_wrap_open" => "<li>", "html_wrap_close" => "</li>") ); echo '</ul>';
						?>
					</p>
					<!-- <?php trackback_rdf(); ?> -->
					<?php comments_template(); // Get comments.php template ?>
				</div><!--end .postfooter-->
			</div><!--end .post-->
			<?php endwhile; else: ?>
			<?php include (TEMPLATEPATH . '/errormessage.php'); ?>
			<?php endif; ?>
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
<?php get_footer(); ?>