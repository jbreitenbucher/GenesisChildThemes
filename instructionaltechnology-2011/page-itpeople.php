<?php
/*
Template Name: Staff
*/

remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop
add_action('genesis_loop', 'it_page_loop');//add our loop
 
function it_page_loop() {
$loop = new WP_Query( array( 'post_type' => 'itpeople', 'posts_per_page' => 20 ) ); ?>
<?php
	$c = 0; // set up a counter so we know which post we're currently showing
	$image_align = 'alignright'; // set up a variable to hold an extra CSS class
?>
<h1><?php the_title(); ?></h1>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php
			$c++; // increment the counter
			if( $c % 2 != 0) {
				// we're on an odd post
				$image_align = 'alignleft';
			} else {
				$image_align = 'alignright';
			}
		?>
		<div id="post-<?php the_ID(); ?>" class="person clear">
			<?php//use the genesis_get_custom_field template tag to display each custom field value ?>
			<h1 class="name"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>, <span class="title"><?php echo genesis_get_custom_field('it_title_text'); ?></span></h1>
			<div class="contact clear">
			<?php if( genesis_get_custom_field('it_phone_number_text') != '') { ?>
					<span class="phone">phone: 
						<?php echo genesis_get_custom_field('it_phone_number_text');?>
					</span>
			<?php } if( genesis_get_custom_field('it_email_address_text') != '') { ?>
					<span class="email"> | e-mail: <a href="mailto:
						<?php echo genesis_get_custom_field('it_email_address_text'); ?>">
						<?php echo genesis_get_custom_field('it_email_address_text'); ?>
					</a></span>
			<?php } ?>
			</div><!--#end contact-->
			<div <?php post_class('about'); ?>>
				<?php $arg = $image_align . ' profile-image'; ?>
				<?php the_post_thumbnail( 'profile-picture-listing',array( 'class' => $arg) ); ?>
				<?php the_excerpt() ?>
			</div><!--end #about -->
		</div><!--end #person -->
	<?php endwhile;?>
<?php
}
 
genesis();