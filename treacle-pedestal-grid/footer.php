				<div id="footer" class="generic footer end">
					<?php _e("a design inspired by");?> <a href="http://www.abctemplates.net/wpdetails/treacle-10/">treacle</a><?php _e(", created by"); ?> <a href="http://not-that-ugly.co.uk">not (that) ugly</a><?php _e(", modified by Jon Breitenbucher, and powered by"); ?> <a href="http://wordpress.org" rel="nofollow">wordpress<?php /*
		bloginfo('version'); */?></a> | <?php wp_loginout(); ?> | <?php wp_register('', ''); ?><br />
					<a href="http://www.dreamhost.com/green.cgi">
						<img border="0" alt="Green Web Hosting! This site hosted by DreamHost."
						src="http://www.thepedestalgroup.com/wp-content/uploads/2009/06/green3.gif" height="15" width="80" /></a>
					<!-- OpenDNS button -->
					<a title="Use OpenDNS to make your Internet faster, safer, and smarter." href="http://www.opendns.com/share/"><img src="http://www.thepedestalgroup.com/wp-content/uploads/2009/06/use_opendns_88x31.gif" width="88" height="31" style="border:0;" alt="Use OpenDNS" /></a>
					<!-- / end OpenDNS button -->
					<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/us/"><img alt="Creative Commons License" style="border-width:0" src="http://www.thepedestalgroup.com/wp-content/uploads/2009/06/80x15.png" /></a>
					<?php do_action('wp_footer'); ?>
				</div><!--end footer-->
				<script type="text/javascript">
					<?php
						global $userdata;
							if ($userdata) {
								echo "z_user_name=\"" . $userdata->display_name . "\";\n";
								echo "z_user_email=\"" . $userdata->user_email . "\";\n";
							}
					?>
					z_post_title="<?php the_title();?>";
					z_post_category="<?php $c=get_the_category();echo $c[0]->cat_name;?>";
				</script>
				<script type="text/javascript">
					var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
					document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
				</script>
				<script type="text/javascript">
					try {
						var pageTracker = _gat._getTracker("UA-5436258-4");
						pageTracker._trackPageview();
					} catch(err) {}
				</script>
			</div><!--end container -->
		</div><!--end page -->
	</body>
</html>