<?php 
echo '<div id="subsubnav"><div class="wrap">';
		wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_id' => 'menu-tertiary-navigation' , 'menu_class' => 'menu genesis-nav-menu menu-tertiary sf-js-enabled', 'theme_location' => 'tertiary') );
echo '</div></div>';
?>