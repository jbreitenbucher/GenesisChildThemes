<?php
/*
Template Name: Right Column Template
*/
?>

<ul id="rightcolumn">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Rightbar') ) : ?>
<?php if ( get_option('users_can register') && !$user_ID ) : ?>
<?php wp_register('<li id="register">', '</li>'); ?>
<?php endif; ?>

<li id="search">
<h2><label for="s"><?php _e('search'); ?></label></h2>	
<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" name="s" id="s"/>
<input type="submit" value="<?php _e('go'); ?>" />
</form>
</li>

<li id="links">
<ul>
<?php get_links_list() ?>
</ul>
</li>
<?php endif; ?>
</ul>



