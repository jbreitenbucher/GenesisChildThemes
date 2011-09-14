<?php
/* The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if (   ! is_active_sidebar( 'Homepage Bottom'  )
)
	return;
// If we get this far, we have widgets. Let do this.

?>

<div id="footer-widget-area">
	<?php if ( is_active_sidebar( 'Homepage Bottom' ) ) : ?>
		<div id="first" class="widget-area">
				<?php dynamic_sidebar( 'Homepage Bottom' ); ?>
		</div><!-- #first .widget-area -->
	<?php endif; ?>
	
</div>