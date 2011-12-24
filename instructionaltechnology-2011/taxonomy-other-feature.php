<?php
remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'it_classroom_taxonomy_loop');//add our loop

function it_classroom_taxonomy_loop() {?> 
<h1><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h1>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="classroom clear">
				<?php//use the genesis_get_custom_field template tag to display each custom field value ?>
				<h1 class="name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<div class="notes clear">
						<?php the_post_thumbnail('classroom-image',array('class' => 'aligncenter classroom-image')); ?>
					<?php echo genesis_get_custom_field('it_notes_wysiwyg'); ?>
				</div><!--end #notes -->
				<div class="room">
					<?php
					if( genesis_get_custom_field('it_seating_capacity_taxonomy') != '') { ?>
						<span class="seating">Seating Capacity: 
							<?php echo genesis_get_custom_field('it_seating_capacity_taxonomy');?>
						</span>
					<?php }
					if( genesis_get_custom_field('it_classroom_style_taxonomy') != '') { ?>
						<span class="email"> | Classroom Style: 
							<?php echo genesis_get_custom_field('it_classroom_style_taxonomy'); ?></p>
					<?php } 
					if( genesis_get_custom_field('it_installed_hardware_taxonomy') != '') { ?>
						<span class="seating">Installed Hardware: 
							<?php echo genesis_get_custom_field('it_installed_hardware_taxonomy');?>
						</span>
					<?php }
					if( genesis_get_custom_field('it_specialized_hardware_taxonomy') != '') { ?>
						<span class="seating">Specialized Hardware: 
							<?php echo genesis_get_custom_field('it_specialized_hardware_taxonomy');?>
						</span>
					<?php }
					if( genesis_get_custom_field('it_other_features_taxonomy') != '') { ?>
						<span class="seating">Other Features: 
							<?php echo genesis_get_custom_field('it_other_features_taxonomy');?>
						</span>
					<?php }
					if( genesis_get_custom_field('it_installed_software_taxonomy') != '') { ?>
						<span class="seating">Installed Software: 
							<?php echo genesis_get_custom_field('it_installed_software_taxonomy');?>
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