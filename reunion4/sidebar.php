<?php
/**
 * @package WordPress
 * @subpackage Reunion 4
 */
?>
<?php if ( !p2_get_hide_sidebar() ) : ?>
	<div id="sidebar">
		<div id="primary-sidebar">
	
			<ul>
				<?php 
					if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Primary Sidebar') ) {
						the_widget( 'P2_Recent_Comments', array(), array( 'before_widget' => '<li> ', 'after_widget' => '</li>', 'before_title' =>'<h2>', 'after_title' => '</h2>' ) );
					}
				?>
			</ul>
	
			<div class="clear"></div>
	
		</div> <!-- // primary-sidebar -->
		
		<div id="secondary-sidebar">
			<ul>
				<?php 
					if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Secondary Sidebar') ) {
							the_widget( 'P2_Recent_Tags', array(), array( 'before_widget' => '<li> ', 'after_widget' => '</li>', 'before_title' =>'<h2>', 'after_title' => '</h2>' ) );
					}
				?>
			</ul>

			<div class="clear"></div>

		</div> <!-- // secondary-sidebar -->
	</div> <!-- // sidebar -->
<?php endif; ?>