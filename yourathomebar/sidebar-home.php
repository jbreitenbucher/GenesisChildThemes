<div id="sidebar-home" class="sidebar widget-area">
		
	<?php
	genesis_before_sidebar_widget_area();
	if (!dynamic_sidebar('Sidebar Home')) :
        $args = array('before_widget' => '<div class="widget"><div class="widget-wrap">','after_widget'  => "</div></div>\n",'before_title'  => '<h4 class="widgettitle">','after_title'   => "</h4>\n");
  		the_widget('WP_Widget_Search', array(), $args);
		the_widget('WP_Widget_Categories', array('dropdown' => 1, 'hierarchical' => 1), $args);
		the_widget('WP_Widget_Recent_Posts', array('number' => 5), $args);
		the_widget('WP_Widget_Archives', array(), $args);
		the_widget('WP_Widget_Links', array(), $args);
		the_widget('WP_Widget_Meta', array(), $args);			
	endif;
	genesis_after_sidebar_widget_area();
	?>
	
</div>