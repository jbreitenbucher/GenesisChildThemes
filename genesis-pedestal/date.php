<?php get_header(); ?>

<?php genesis_before_content_sidebar_wrap(); ?>
<div id="content-sidebar-wrap">
	
	<?php genesis_before_content(); ?>
	<div id="content">
	
		<?php genesis_before_loop(); ?>
		<div class="post">
		<h2><?php printf( __( 'You are browsing the archive for %1$s.', 'genesis' ), get_the_time( __( 'F, Y', 'genesis' ) ) ); ?></h2>

		<ul>
		<?php $posts = query_posts($query_string . '&nopaging=1'); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<li>
						<a href="<?php the_permalink() ?>">
						<strong><?php the_time('d.m.y'); ?></strong> | 
						<?php the_title(); ?> </a>
						<?php the_excerpt(); ?>
					</li>

		<?php endwhile; ?>
		</ul>
		<?php else : ?>
			<?php include ( CHILD_URL . '/errormessage.php'); ?>
		<?php endif; ?>
		</div><!-- end .post -->
		<?php genesis_after_loop(); ?>

	</div><!-- end #content -->
	<?php genesis_after_content(); ?>

</div><!-- end #content-sidebar-wrap -->
<?php genesis_after_content_sidebar_wrap(); ?>

<?php get_footer(); ?>