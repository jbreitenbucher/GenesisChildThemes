<?php
/**
 * @package WordPress
 * @subpackage Reunion 4
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '&laquo;', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="header">

	<div class="sleeve">
		<h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php if ( get_bloginfo( 'description' ) ) : ?>
			<small><?php bloginfo( 'description' ); ?></small>
		<?php endif; ?>
		<a class="secondary" href="<?php echo home_url( '/' ); ?>"></a>
	</div>

</div>

<div id="menu-container">
	<?php
		$locations = get_nav_menu_locations();
		if ($locations[ 'primary' ]) {
			wp_nav_menu( array( 'container' => 'div', 'container_id' => 'p2menu', 'theme_location' => 'primary' ) );
		} else { ?>
			<ul class='simplemenu'> <?php echo wp_list_pages('exclude=;&depth=1&sort_column=menu_order&title_li=' . ('') . '' ); ?> </ul>
		<?php }
	?>
</div>

<div id="wrapper">
	<?php get_sidebar(); ?>