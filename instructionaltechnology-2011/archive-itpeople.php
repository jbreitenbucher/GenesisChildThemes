<?php
/*
Template Name: People Archive
*/

remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'it_page_loop');//add our loop
 
function it_page_loop() {?>
<h1>Listing of Instructional Technology Staff</h1>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?> 
		<div id="post-<?php the_ID(); ?>" class="person clear">
			<?php//use the genesis_get_custom_field template tag to display each custom field value ?>
			<img src="<?php echo genesis_get_custom_field('it_profile_image'); ?>" class="alignleft profile-image"/>
			<div class="alignleft contact">
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<p class="title">Title:&nbsp;<?php echo genesis_get_custom_field('it_title_text'); ?></p>
				<p class="office">Office:&nbsp;<?php echo genesis_get_custom_field('it_office_text'); ?></p>
				<p class="address">Address:&nbsp;<?php echo genesis_get_custom_field('it_address_textarea'); ?></p>
				<p class="phone">P:&nbsp;<?php echo genesis_get_custom_field('it_phone_number_text'); ?></p>
				<p class="email">E:&nbsp;<a href="mailto:<?php echo genesis_get_custom_field('it_email_address_text'); ?>"><?php echo genesis_get_custom_field('it_email_address_text'); ?></a></p>
			</div><!--#end contact-->
		</div><!--end #person -->
	<?php endwhile;?>
	<?php endif;?>
<?php
}
 
genesis();