<?php
remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'it_classroom_taxonomy_loop');//add our loop
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
add_action('genesis_before_loop', 'tax_breadcrumbs');
 
function tax_breadcrumbs() {
    if (is_tax()):
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        echo '<div class="breadcrumb"><a href="'.get_bloginfo('url').'">Home</a> &#8594; <a href="'.get_bloginfo('url').'/buildings">Buildings</a> &#8594; '.$term->name.'</div>';
    endif;
}

function it_classroom_taxonomy_loop() {?> 
<h1><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h1>
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