<?php
/**
 * @package WordPress
 * @subpackage P2
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

<div id="access" role="navigation">

    <?php /*

    Allow screen readers / text browsers to skip the navigation menu and
    get right to the good stuff. */ ?>

    <div class="skip-link screen-reader-text">
        <a href="#content" title="<?php esc_attr_e( 'Skip to content', 'p2' ); ?>">
        <?php _e( 'Skip to content', 'p2' ); ?></a>
    </div>

    <?php /*

    Our navigation menu.  If one isn't filled out, wp_nav_menu falls
    back to wp_page_menu.  The menu assigned to the primary position is
    the one used.  If none is assigned, the menu with the lowest ID is
    used. */

    wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>

</div><!-- #access -->

<div id="wrapper">
	<?php get_sidebar(); ?>