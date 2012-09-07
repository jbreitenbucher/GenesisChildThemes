<div id="sidebar" class="widget-area">
<?php
	genesis_before_sidebar_widget_area();
	echo "<div id='sidebar-top' class='widget-area'>";
		if (!dynamic_sidebar('Top Sidebar')) :
		endif;
?>
		<div class="box subscribe">
			<p><strong>Subscribe</strong> through an RSS feed reader</p>
			<p><a href="<?php bloginfo('url'); ?>/?feed=rss2" class="feedlink">News Feed</a> <a href="<?php bloginfo('url'); ?>/?feed=comments-rss2" class="feedlink">Comments Feed</a></p>
		        <p>Or one of the options below:</p>
		        <!-- AddToAny BEGIN -->
		        <a class="a2a_dd" href="http://www.addtoany.com/subscribe?linkurl=http%3A%2F%2Fjon.breitenbucher.net%2Ffeed%2F&amp;linkname="><img src="http://static.addtoany.com/buttons/subscribe_171_16.gif" width="171" height="16" border="0" alt="Subscribe"/></a>
		        <script type="text/javascript">
		        var a2a_config = a2a_config || {};
		        a2a_config.linkurl = "http://jon.breitenbucher.net/feed/";
		        a2a_config.color_main = "9e9071";
		        a2a_config.color_border = "9e9071";
		        a2a_config.color_link_text = "636873";
		        a2a_config.color_link_text_hover = "dee4e0";
		        a2a_config.color_bg = "e9e4d5";
		        </script>
		        <script type="text/javascript" src="http://static.addtoany.com/menu/feed.js"></script>
		        <!-- AddToAny END -->
		</div>
		<div id="search">
		<h4><label for="s"><?php _e('search the blog'); ?></label></h4>	
		<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="text" name="s" id="s" value="please enter a search term or phrase..." onfocus="if (this.value == 'please enter a search term or phrase...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'please enter a search term or phrase...';}"/>
		<input type="submit" class="searchblogsubmit" value="go" />
		</form>
	</div>
<div class='affilliate'><a target="_new" href="http://www.shareasale.com/r.cfm?b=255473&u=473004&m=28169&urllink=&afftrack="><img src="http://jon.breitenbucher.net/wp-content/uploads/2010/11/360x46.png"  alt="Genesis Framework for WordPress" class="affilliate" border="0"></a></div>
	</div>
	<div id='sidebar-left' class='widget-area'>
	<?php if (!dynamic_sidebar('Left Sidebar')) : ?>
		<h4 id="links">Links</h4>
		<ul>
		<?php get_links_list() ?>
		</ul>
		<?php endif; ?>
		<div id="songs">
		<h4><?php _e('Now Playing:'); ?></h4>
		<ul>
			<?php
		      $ch = curl_init();
		      $timeout = 5; // set to zero for no timeout
		      curl_setopt ($ch, CURLOPT_URL, 'http://jbreitenbuch.wooster.edu/~jonb/wordpress/currenttune.html');
		      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		      curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		      $current_song = curl_exec($ch);
		      curl_close($ch);

		      // display file
		      echo $current_song;
		  ?>
		</ul>
		<h4><?php _e('Recently Played:'); ?></h4>
		<ul>
			<?php
		      $ch = curl_init();
		      $timeout = 5; // set to zero for no timeout
		      curl_setopt ($ch, CURLOPT_URL, 'http://jbreitenbuch.wooster.edu/~jonb/wordpress/recenttunes.html');
		      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		      curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		      $current_song = curl_exec($ch);
		      curl_close($ch);

		      // display file
		      echo $current_song;
		  ?>
		</ul>
		</div>
	</div>
	<div id='sidebar-right' class='widget-area'>
		<h4><?php _e('pages'); ?></h4>
		<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-header' ) ); ?>
		<h4><?php _e('categories'); ?></h4>
		<ul>
		<?php wp_list_cats ('sort_column=name&optioncount=0&exclude=1,26&feed=rss') ?>
		</ul>
		<h4><?php _e('archives'); ?></h4>
		<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'> 
		  <option value=""><?php echo attribute_escape(__('Select Month')); ?></option> 
		  <?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>
		<h4><?php _e('Social network'); ?></h4>
		<ul>
		<li><a href="http://www.facebook.com/breitenbucher">Facebook</a></li>
		<li><a href="http://www.linkedin.com/in/jonbreitenbucher">Linked in</a></li>
		<li><a href="http://www.flickr.com/photos/breitenbucher">Flickr</a></li>
		</ul>
		<h4><?php _e('feed me'); ?></h4>
		<ul>
		<li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('RSS 2.0 feed'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
		<li><a href="feed:<?php bloginfo('atom_url'); ?>" title="<?php _e('Atom feed'); ?>"><?php _e('Atom'); ?></a></li>
		<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Comments feed in RSS 2.0'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
		</ul>
		<?php if(function_exists(wp_onlinecounter)) { wp_onlinecounter(); } ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : ?>
		<?php endif; ?>
		</div>
<?php
	genesis_after_sidebar_widget_area();
?>
</div>