<?php
/**
 * Template Name: Widget area, no sidebar
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Wooster_Research
 * @since Wooster Research 1.0
 */

get_header(); ?>

		<div id="container" class="one-column">
			<div id="content" role="main">
				<?php dynamic_sidebar( 'Widgetized Page Content' ); ?>
				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
								<div id="nav-below" class="navigation">
									<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
									<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
								</div><!-- #nav-below -->
				<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
