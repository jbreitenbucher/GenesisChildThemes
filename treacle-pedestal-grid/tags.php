<?php /*
Template Name: Tag Archive
This is an example tag archive page.  If you add this to your theme,  and create a page using the "Tag Archive" template (it'll be there in the list)
you'll get a tag cloud displaying on a page.

You might need to tinker with the header/sidebar/footer to match your theme!
*/ ?>

<?php get_header(); ?>

	<?php UTW_ShowWeightedTagSetAlphabetical("coloredsizedtagcloud","",0) ?>

<?php get_footer(); ?>