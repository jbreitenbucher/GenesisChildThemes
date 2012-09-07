<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?> " />
		<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> 
		<meta name="verify-v1" content="heq3wn7rQUHtqbRhBCGuFKEWAPLn9TjItANtgFYxvtM=" />
		<link rel="shortcut icon" href="<?php bloginfo('siteurl'); ?>/wp-content/themes/treacle-pedestal-grid/images/favicon.ico"/>
		<style type="text/css" media="screen">
			@import url( <?php bloginfo('stylesheet_url'); ?> );
		</style>
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> : Blog Archive <?php } ?> <?php wp_title(':'); ?></title>
			<?php // comments_popup_script(); // off by default ?>
			<?php wp_head(); ?>
	</head>
	<body>
		<?php if(function_exists('wp_admin_bar')) wp_admin_bar(); ?>
		<div class="page">
			<div class="generic container">
				<div id="header">
					<h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a></h1>
					<h2><?php bloginfo('description'); ?> </h2>
				</div><!--end #header-->
				<div id="pagenav">
					<ul>
						<li<?php if(!is_page() ) { ?> class="current_page_item"<?php } ?>><a href="<?php bloginfo('home'); ?>">Home</a></li>
						<?php wp_list_pages('sort_column=menu_order&depth=0&include=2,37,58,142,230&exclude=3&title_li='); ?>
					</ul>
				</div><!--end #pagenav-->
