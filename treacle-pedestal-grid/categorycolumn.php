<?php
/*
Template Name: Category Column Template
*/
?>
<ul id="leftcolumn">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Category') ) : ?>

<li id="categories"><h2><?php _e('categories'); ?></h2>
<ul>
<?php wp_list_cats ('sort_column=name&optioncount=1&exclude=1&feed=rss') ?>
</ul>
</li>
<?php endif; ?>
</ul>

