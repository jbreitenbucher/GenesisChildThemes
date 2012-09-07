<?php
/*
Template Name: Sidebar Header Template
*/
?>
<ul id="headercolumn">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Header') ) : ?>
<?php endif; ?>
<li>
<h2>Subscribe to my blog</h2>
<div class="box subscribe">
	<p>You can subscribe by email to receive the latest posts:</p>
	<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=ThePedestalGroup', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" class="subscribe">
	<fieldset>
        <input type="text" class="feedinput" value="your email address ..." name="email" />
        <input type="submit" class="feedsubmit" value="Join" />
        <input type="hidden" class="feedhidden" value="ThePedestalGroup" name="uri"/>
        <input type="hidden" class="feedhidden" name="loc" value="en_US"/>
	</fieldset>
	</form>
	<p><strong>Subscribe</strong> through an RSS feed reader</p>
	<p><a href="<?php bloginfo('url'); ?>/?feed=rss2" class="feedlink">News Feed</a> <a href="<?php bloginfo('url'); ?>/?feed=comments-rss2" class="feedlink">Comments Feed</a></p>
        <p>Or choose from the options below<br />
        <!-- AddToAny BEGIN -->
        <a class="a2a_dd" href="http://www.addtoany.com/subscribe?linkurl=http%3A%2F%2Fthepedestalgroup.com%2Ffeed%2F&amp;linkname="><img src="http://static.addtoany.com/buttons/subscribe_171_16.gif" width="171" height="16" border="0" alt="Subscribe"/></a>
        <script type="text/javascript">
        var a2a_config = a2a_config || {};
        a2a_config.linkurl = "http://thepedestalgroup.com/feed/";
        a2a_config.num_services = 20;
        a2a_config.color_main = "febf7f";
        a2a_config.color_border = "fe9932";
        a2a_config.color_link_text = "0086b1";
        a2a_config.color_link_text_hover = "0086b1";
        </script>
        <script type="text/javascript" src="http://static.addtoany.com/menu/feed.js"></script>
        <!-- AddToAny END -->
<?php //if( class_exists('Add_to_Any_Subscribe_Widget') ) { Add_to_Any_Subscribe_Widget::display(); } ?></p>
</div>
</li>
<li id="search">
<h2><label for="s"><?php _e('search the blog'); ?></label></h2>	
<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" name="s" id="s" value="please enter a search term or phrase..."/>
<input type="submit" value="<?php _e('go'); ?>" />
</form>
</li>
</ul>

