<?php
/*
Template Name: Left Column Template
*/
?>
<ul id="leftcolumn">
<li id="pages"><h2><?php _e('pages'); ?></h2>
<ul>
<?php wp_list_pages ('sort_column=post_name&title_li=') ?>
</ul>
</li>

<li id="categories"><h2><?php _e('categories'); ?></h2>
<ul>
<?php wp_list_cats ('sort_column=name&feed=rss') ?>
</ul>
</li>

<?php if(function_exists(wp_onlinecounter)) { wp_onlinecounter(); } ?>

		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Leftbar') ) : ?>

<li id="feeds">
<h2><?php _e('feed me'); ?></h2>
<ul>
<li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('RSS 2.0 feed'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
<li><a href="feed:<?php bloginfo('atom_url'); ?>" title="<?php _e('Atom feed'); ?>"><?php _e('Atom'); ?></a></li>
<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Comments feed in RSS 2.0'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
</ul>
</li>

<?php endif; ?>
</ul>

