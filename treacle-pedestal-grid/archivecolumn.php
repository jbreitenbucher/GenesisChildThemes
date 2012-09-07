<?php
/*
Template Name: Archive Column Template
*/
?>
<ul id="leftcolumn">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Archive') ) : ?>

<li id="archives"><h2><?php _e('archives'); ?></h2>
<ul>
<?php wp_get_archives () ?>
</ul>
</li>
<?php endif; ?>
</ul>

