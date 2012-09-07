<?php
/*
Template Name: Column One Template
*/
?>
<ul id="leftcolumn">
	<!--<li id="tags">
	<h2><?php _e('Tags'); ?></h2>
	<?php wp_tag_cloud( 'smallest = 8&largest = 22&unit =pt&number = 45&format = flat&orderby = name&order = ASC&link = view&taxonomy = post_tag&echo = true' ); ?>
	</li>-->
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Column One') ) : ?>

<li id="feeds">
<h2><?php _e('feed me'); ?></h2>
<ul>
<li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('RSS 2.0 feed'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
<li><a href="feed:<?php bloginfo('atom_url'); ?>" title="<?php _e('Atom feed'); ?>"><?php _e('Atom'); ?></a></li>
<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Comments feed in RSS 2.0'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
</ul>
</li>
<?php endif; ?>

<li>
<?php if(function_exists(wp_onlinecounter)) { wp_onlinecounter(); } ?>
</li>
</ul>

