<?php
/*
Template Name: Class Memories Page
*/
/**
 * @package WordPress
 * @subpackage P2
 */
?>
<?php get_header(); ?>

<div class="sleeve_main">
	<?php if ( p2_user_can_post() && !is_archive() ) : ?>
		<?php locate_template( array( 'memories-form.php' ), true ); ?>
	<?php endif; ?>
	<div id="main">
		<h2>
			Class Memories
			<span class="controls">
				<a href="#" id="togglecomments"> <?php _e( 'Toggle Comment Threads', 'p2' ); ?></a> | <a href="#directions" id="directions-keyboard"><?php _e( 'Keyboard Shortcuts', 'p2' ); ?></a>
			</span>
		</h2>
		<?php query_posts('category_name=memories&post_status=publish,future'); ?>
		<ul id="postlist">
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
	    		<?php p2_load_entry(); ?>
			<?php endwhile; ?>

		<?php else : ?>

			<li class="no-posts">
		    	<h3><?php _e( 'No posts yet!', 'p2' ); ?></h3>
			</li>

		<?php endif; ?>
		</ul>

		<div class="navigation">
			<p class="nav-older"><?php next_posts_link( __( '&larr; Older posts', 'p2' ) ); ?></p>
			<p class="nav-newer"><?php previous_posts_link( __( 'Newer posts &rarr;', 'p2' ) ); ?></p>
		</div>

	</div> <!-- main -->

</div> <!-- sleeve -->

<?php get_footer(); ?>