<?php
/*
Template Name: Classroom Archive
*/

remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'it_classroom_page_loop');//add our loop
 
function it_classroom_page_loop() {?>
<h1>Classroom Listing</h1>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="classroom clear">
			<?php//use the genesis_get_custom_field template tag to display each custom field value ?>
					<?php the_post_thumbnail('classroom-square',array('class' => 'classroom-square')); ?>
<!--end #thumbnail -->
			<div class="room alignright">
				<h1 class="name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<?php
				if( genesis_get_custom_field('it_notes_wysiwyg') != '') { ?>
					<span class="notes">
						<?php echo genesis_get_custom_field('it_notes_wysiwyg');?>
					</span>
				<?php }
				?>
			</div><!--#end room-->
		</div><!--end #classroom -->
	<?php endwhile;?>
	<?php endif;?>
<?php
}
 
genesis();