<?php
/* The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( !is_active_sidebar( 'homepage-bottom'  ) )
	return;
// If we get this far, we have widgets. Let do this.

?>

<div id="footer-widgets">
	<?php if ( is_active_sidebar( 'homepage-bottom' ) ) : ?>
		<div id="first" class="widget-area footer-widgets-1">
				<?php dynamic_sidebar( 'homepage-bottom' ); ?>
		</div><!-- #first .widget-area -->
	<?php endif; ?>
	
</div>