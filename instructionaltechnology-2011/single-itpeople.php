<?php
remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'staff_member_loop');//add our loop

function staff_member_loop() {
?>

<div id="post-<?php the_ID(); ?>" class="person">
<?php//use the genesis_get_custom_field template tag to display each custom field value ?>
	<h2 class="name"><?php the_title(); ?>, <span class="title"><?php echo genesis_get_custom_field('it_title_text'); ?></span></h2>
	<div class="contact clear">
		<?php
		if( genesis_get_custom_field('it_phone_number_text') != '') { ?>
			<span class="phone">phone: 
				<?php echo genesis_get_custom_field('it_phone_number_text');?>
			</span>
		<?php }
		if( genesis_get_custom_field('it_email_address_text') != '') { ?>
			<span class="email"> | e-mail: <a href="mailto:
				<?php echo genesis_get_custom_field('it_email_address_text'); ?>">
				<?php echo genesis_get_custom_field('it_email_address_text'); ?>
			</a></p>
		<?php } ?>
	</div><!--#end contact-->
	<div class="about">
		<?php the_post_thumbnail('profile-picture-single',array('class' => 'alignleft profile-image')); ?>
		<?php echo genesis_get_custom_field('it_about_me_wysiwyg'); ?>
	</div><!--end #about -->
</div><!--end #person -->
<?php
}

genesis();