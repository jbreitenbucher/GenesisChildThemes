<?php
// Force the excerpt
remove_action('genesis_post_content', 'genesis_do_post_content');
add_action('genesis_post_content', 'the_excerpt');

// Remove the archive thumbnail from the home page
remove_action('genesis_post_content', 'genesis_do_post_image');

//	Add featured image above title on teasers
add_action('genesis_before_post_title', 'expose_homepage_teaser_image');
function expose_homepage_teaser_image() {
	global $loop_counter;
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	
	printf( '<p><a href="%s">%s</a></p>', get_permalink(), the_post_thumbnail( 'swt-discover-featured' ) );

}

// Add .portfolio-posts class to every post, except first 2
add_filter('post_class', 'expose_homepage_post_class');
function expose_homepage_post_class( $classes ) {
	global $loop_counter;
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		
	$classes[] = 'portfolio-posts';
	$classes[] = 'clearfix';
        $classes[] = 'portfolio-posts-' . $loop_counter % 3;
		
	return $classes;
}

add_filter('the_excerpt', 'expose_homepage_excerpt_filter');
function expose_homepage_excerpt_filter( $text ) {
	return sprintf( '%s<p><a class="alignright" href="%s">Read More &rarr;</a></p>', $text, get_permalink() );
}

add_action( 'genesis_before', 'home_feature' );
function home_feature() {
	$paged = get_query_var('paged');
	if ( $paged < 2  ) {
		add_action('genesis_before_content','expose_feature');
	}
}

function expose_feature() {
	if ( is_active_sidebar( 'featured' ) ) {
		
		echo '<div class="featured clearfix">';
		
			dynamic_sidebar( 'featured' );
				
		echo '</div><!-- end .featured -->';
		
	}
}

remove_action('genesis_loop', 'genesis_do_loop');
add_action( 'genesis_loop', 'custom_do_loop' , 5 );
 
function custom_do_loop() {
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	if ($paged < 2 ) {
    		$args = array(
			'paged' => $paged,
			'posts_per_page' => 3,
			'tax_query' => array(
            			array(
                			'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => 'home'
				),
			)
		);
	} else {
		$args = array(
			'paged' => $paged,
			'offset' => 3,
			'posts_per_page' => 6,
			'tax_query' => array(
            			array(
                			'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => 'home'
				),
			)
		);
	}
    genesis_custom_loop( $args );
}

require_once(PARENT_DIR . '/index.php');
