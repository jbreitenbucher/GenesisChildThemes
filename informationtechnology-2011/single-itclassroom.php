<?php
remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'classroom_loop');//add our loop

function classroom_loop() {
?>

<div id="post-<?php the_ID(); ?>" class="classroom">
<?php//use the genesis_get_custom_field template tag to display each custom field value ?>
	<h2 class="name"><?php the_title(); ?></h2>
	<div class="notes clear">
			<?php the_post_thumbnail('classroom-image',array('class' => 'aligncenter classroom-image')); ?>
		<?php echo genesis_get_custom_field('it_notes_wysiwyg'); ?>
	</div><!--end #notes -->
	<div class="room">
		<?php
		echo get_the_term_list($post->ID, 'building', '<strong>Building:</strong> ', ', ', '</br>');
		echo get_the_term_list($post->ID, 'seating', '<strong>Seating Capacity:</strong> ', ', ', '</br>');
		echo get_the_term_list($post->ID, 'style', '<strong>Classroom Style:</strong> ', ', ', '</br>');
		echo get_the_term_list($post->ID, 'hardware', '<strong>Installed Hardware:</strong> ', ', ', '</br>');
		echo get_the_term_list($post->ID, 'specialized', '<strong>Specialized Hardware:</strong> ', ', ', '</br>');
		echo get_the_term_list($post->ID, 'software', '<strong>Installed Software:</strong> ', ', ', '</br>');
		echo get_the_term_list($post->ID, 'other', '<strong>Other Features:</strong> ', ', ', '</br>');
		?>
	</div><!--#end room-->
</div><!--end #classroom -->
<?php
}

genesis();