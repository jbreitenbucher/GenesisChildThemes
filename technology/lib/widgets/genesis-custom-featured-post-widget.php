<?php
/**
 * Technology Theme
 *
 * @package technology
 * @author  Jon Breitenbucher
 * @license GPL-2.0-or-later
 * @link    https://github.com/jbreitenbucher/GenesisChildThemes/technology
 * @version SVN: $Id$
 * @since   
 */

/**
 * Genesis Featured Post widget class.
 *
 * @since 1.0.0
 *
 * @package Genesis\Widgets
 */
class Genesis_Custom_Featured_Post extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->defaults = array(
			'title'                   => '',
			'posts_cat'               => '',
			'posts_num'               => '',
			'posts_offset'            => 0,
			'orderby'                 => '',
			'order'                   => '',
			'exclude_displayed'       => 0,
			'exclude_sticky'          => 0,
			'show_image'              => 0,
			'image_alignment'         => '',
			'image_size'              => '',
			'show_gravatar'           => 0,
			'gravatar_alignment'      => '',
			'gravatar_size'           => '',
			'show_title'              => 0,
			'show_byline'             => 0,
			'post_info'               => '[post_date] ' . __( 'By', 'technology' ) . ' [post_author_posts_link] [post_comments]',
			'show_content'            => 'excerpt',
			'content_limit'           => '',
			'more_text'               => __( '[Read More...]', 'technology' ),
			'extra_num'               => '',
			'extra_title'             => '',
			'more_from_category'      => '',
			'more_from_category_text' => __( 'More Posts from this Category', 'technology' ),
		);

		$widget_ops = array(
			'classname'   => 'custom-featured-content customfeaturedpost',
			'description' => __( 'Custom Genesis featured posts with thumbnails', 'technology' ),
		);

		$control_ops = array(
			'id_base' => 'custom-featured-post',
			'width'   => 505,
			'height'  => 350,
		);

		parent::__construct( 'custom-featured-post', __( 'Genesis - Custom Featured Posts', 'technology' ), $widget_ops, $control_ops );

	}

	/**
	 * Echo the widget content.
	 *
	 * @since 1.0.0
	 *
	 * @global WP_Query $wp_query               Query object.
	 * @global array    $_genesis_displayed_ids Array of displayed post IDs.
	 * @global int      $more
	 *
	 * @param array $args     Display arguments including `before_title`, `after_title`,
	 *                        `before_widget`, and `after_widget`.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {

		global $wp_query, $_genesis_displayed_ids;

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
		}

		$query_args = array(
			'post_type'           => 'post',
			'cat'                 => $instance['posts_cat'],
			'showposts'           => $instance['posts_num'],
			'offset'              => $instance['posts_offset'],
			'orderby'             => $instance['orderby'],
			'order'               => $instance['order'],
			'ignore_sticky_posts' => $instance['exclude_sticky'],
		);

		// Exclude displayed IDs from this loop?
		if ( $instance['exclude_displayed'] ) {
			$query_args['post__not_in'] = (array) $_genesis_displayed_ids;
		}

		$wp_query = new WP_Query( $query_args ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited -- Reset later.

		if ( have_posts() ) {

			while ( have_posts() ) {

				the_post();

				$_genesis_displayed_ids[] = get_the_ID();

				genesis_markup(
					array(
						'open'    => '<article %s>',
						'context' => 'entry',
						'params'  => array(
							'is_widget' => true,
						),
					)
				);

				$image = genesis_get_image(
					array(
						'format'  => 'html',
						'size'    => $instance['image_size'],
						'context' => 'featured-post-widget',
						'attr'    => genesis_parse_attr( 'entry-image-widget', array() ),
					)
				);

				if ( $image && $instance['show_image'] ) {
					$role = empty( $instance['show_title'] ) ? '' : ' aria-hidden="true" tabindex="-1"';
					printf(
						'<a href="%s" class="%s"%s>%s</a>',
						esc_url( get_permalink() ),
						esc_attr( $instance['image_alignment'] ),
						$role, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaping breaks output here
						wp_make_content_images_responsive( $image )
					);
				}

				if ( ! empty( $instance['show_gravatar'] ) ) {
					echo '<span class="' . esc_attr( $instance['gravatar_alignment'] ) . '">';
					echo get_avatar( get_the_author_meta( 'ID' ), $instance['gravatar_size'] );
					echo '</span>';
				}

				if ( $instance['show_title'] || $instance['show_byline'] ) {

					$header = '';

					if ( ! empty( $instance['show_title'] ) ) {

						$title = get_the_title() ? get_the_title() : __( '(no title)', 'technology' );

						/**
						 * Filter the featured post widget title.
						 *
						 * @since 2.2.0
						 *
						 * @param string $title    Featured post title.
						 * @param array  $instance {
						 *     Widget settings for this instance.
						 *
						 *     @type string $title                   Widget title.
						 *     @type int    $posts_cat               ID of the post category.
						 *     @type int    $posts_num               Number of posts to show.
						 *     @type int    $posts_offset            Number of posts to skip when
						 *                                           retrieving.
						 *     @type string $orderby                 Field to order posts by.
						 *     @type string $order                   ASC fr ascending order, DESC for
						 *                                           descending order of posts.
						 *     @type bool   $exclude_displayed       True if posts shown in main output
						 *                                           should be excluded from this widget
						 *                                           output.
						 *     @type bool   $show_image              True if featured image should be
						 *                                           shown, false otherwise.
						 *     @type string $image_alignment         Image alignment: `alignnone`,
						 *                                           `alignleft`, `aligncenter` or `alignright`.
						 *     @type string $image_size              Name of the image size.
						 *     @type bool   $show_gravatar           True if author avatar should be
						 *                                           shown, false otherwise.
						 *     @type string $gravatar_alignment      Author avatar alignment: `alignnone`,
						 *                                           `alignleft` or `aligncenter`.
						 *     @type int    $gravatar_size           Dimension of the author avatar.
						 *     @type bool   $show_title              True if featured page title should
						 *                                           be shown, false otherwise.
						 *     @type bool   $show_byline             True if post info should be shown,
						 *                                           false otherwise.
						 *     @type string $post_info               Post info contents to show.
						 *     @type bool   $show_content            True if featured page content
						 *                                           should be shown, false otherwise.
						 *     @type int    $content_limit           Amount of content to show, in
						 *                                           characters.
						 *     @type int    $more_text               Text to use for More link.
						 *     @type int    $extra_num               Number of extra post titles to show.
						 *     @type string $extra_title             Heading for extra posts.
						 *     @type bool   $more_from_category      True if showing category archive
						 *                                           link, false otherwise.
						 *     @type string $more_from_category_text Category archive link text.
						 * }
						 * @param array  $args     {
						 *     Widget display arguments.
						 *
						 *     @type string $before_widget Markup or content to display before the widget.
						 *     @type string $before_title  Markup or content to display before the widget title.
						 *     @type string $after_title   Markup or content to display after the widget title.
						 *     @type string $after_widget  Markup or content to display after the widget.
						 * }
						 */
						$title   = apply_filters( 'genesis_featured_post_title', $title, $instance, $args );
						$heading = genesis_a11y( 'headings' ) ? 'h3' : 'h4';

						$header .= genesis_markup(
							array(
								'open'    => "<{$heading} %s>",
								'close'   => "</{$heading}>",
								'context' => 'entry-title',
								'content' => sprintf( '<a href="%s">%s</a>', get_permalink(), $title ),
								'params'  => array(
									'is_widget' => true,
									'wrap'      => $heading,
								),
								'echo'    => false,
							)
						);

					}

					if ( ! empty( $instance['show_byline'] ) && ! empty( $instance['post_info'] ) ) {
						$header .= genesis_markup(
							array(
								'open'    => '<p %s>',
								'close'   => '</p>',
								'context' => 'entry-meta',
								'content' => genesis_strip_p_tags( do_shortcode( $instance['post_info'] ) ),
								'params'  => array(
									'is_widget' => true,
								),
								'echo'    => false,
							)
						);
					}

					genesis_markup(
						array(
							'open'    => '<header %s>',
							'close'   => '</header>',
							'context' => 'entry-header',
							'params'  => array(
								'is_widget' => true,
							),
							'content' => $header,
						)
					);

				}

				if ( ! empty( $instance['show_content'] ) ) {

					genesis_markup(
						array(
							'open'    => '<div %s>',
							'context' => 'entry-content',
							'params'  => array(
								'is_widget' => true,
							),
						)
					);

					if ( 'excerpt' === $instance['show_content'] ) {
						the_excerpt();
					} elseif ( 'content-limit' === $instance['show_content'] ) {
						the_content_limit( (int) $instance['content_limit'], genesis_a11y_more_link( esc_html( $instance['more_text'] ) ) );
					} else {
						global $more;

						$orig_more = $more;
						$more      = 0; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited -- Temporary change.

						the_content( genesis_a11y_more_link( esc_html( $instance['more_text'] ) ) );

						$more = $orig_more; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited -- Global is being restored.
					}

					genesis_markup(
						array(
							'close'   => '</div>',
							'context' => 'entry-content',
							'params'  => array(
								'is_widget' => true,
							),
						)
					);

				}

				genesis_markup(
					array(
						'close'   => '</article>',
						'context' => 'entry',
						'params'  => array(
							'is_widget' => true,
						),
					)
				);

			}
		}

		// Restore original query.
		wp_reset_query(); // phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query -- Making sure the query is really reset.

		// The EXTRA Posts (list).
		if ( ! empty( $instance['extra_num'] ) ) {
			if ( ! empty( $instance['extra_title'] ) ) {
				echo $args['before_title'] . '<span class="more-posts-title">' . esc_html( $instance['extra_title'] ) . '</span>' . $args['after_title'];
			}

			$offset = (int) $instance['posts_num'] + (int) $instance['posts_offset'];

			$query_args = array(
				'cat'       => $instance['posts_cat'],
				'showposts' => $instance['extra_num'],
				'offset'    => $offset,
			);

			$wp_query = new WP_Query( $query_args ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited -- Reset later.

			$listitems = '';

			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					$_genesis_displayed_ids[] = get_the_ID();

					$listitems .= sprintf( '<li><a href="%s">%s</a></li>', esc_url( get_permalink() ), esc_html( get_the_title() ) );
				}

				if ( mb_strlen( $listitems ) > 0 ) {
					printf( '<ul class="more-posts">%s</ul>', $listitems ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped before.
				}
			}

			// Restore original query.
			wp_reset_query(); // phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query -- Making sure the query is really reset.
		}

		if ( ! empty( $instance['more_from_category'] ) && ! empty( $instance['posts_cat'] ) ) {
			printf(
				'<p class="more-from-category"><a href="%1$s" title="%2$s">%3$s</a></p>',
				esc_url( get_category_link( $instance['posts_cat'] ) ),
				esc_attr( get_cat_name( $instance['posts_cat'] ) ),
				esc_html( $instance['more_from_category_text'] )
			);
		}

		echo $args['after_widget'];

	}

	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via `form()`.
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {

		$post_num = (int) $new_instance['posts_num'];

		$new_instance['posts_num'] = $post_num > 0 && $post_num < 100 ? $post_num : 1;
		$new_instance['title']     = wp_strip_all_tags( $new_instance['title'] );
		$new_instance['more_text'] = wp_strip_all_tags( $new_instance['more_text'] );
		$new_instance['post_info'] = wp_kses_post( $new_instance['post_info'] );

		return $new_instance;

	}

	/**
	 * Echo the settings update form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 * @return void
	 */
	public function form( $instance ) {

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'technology' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<div class="genesis-widget-column">

			<div class="genesis-widget-column-box genesis-widget-column-box-top">

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'posts_cat' ) ); ?>"><?php esc_html_e( 'Category', 'technology' ); ?>:</label>
					<?php
					$categories_args = array(
						'name'            => $this->get_field_name( 'posts_cat' ),
						'id'              => $this->get_field_id( 'posts_cat' ),
						'selected'        => $instance['posts_cat'],
						'orderby'         => 'Name',
						'hierarchical'    => 1,
						'show_option_all' => __( 'All Categories', 'technology' ),
						'hide_empty'      => '0',
					);
					wp_dropdown_categories( $categories_args );
					?>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'posts_num' ) ); ?>"><?php esc_html_e( 'Number of Posts to Show', 'technology' ); ?>:</label>
					<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'posts_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_num' ) ); ?>" value="<?php echo esc_attr( $instance['posts_num'] ); ?>" size="2" placeholder="1" />
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'posts_offset' ) ); ?>"><?php esc_html_e( 'Number of Posts to Offset', 'technology' ); ?>:</label>
					<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'posts_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_offset' ) ); ?>" value="<?php echo esc_attr( $instance['posts_offset'] ); ?>" size="2" />
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By', 'technology' ); ?>:</label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
						<option value="date" <?php selected( 'date', $instance['orderby'] ); ?>><?php esc_html_e( 'Date Published', 'technology' ); ?></option>
						<option value="modified" <?php selected( 'modified', $instance['orderby'] ); ?>><?php esc_html_e( 'Date Modified', 'technology' ); ?></option>
						<option value="title" <?php selected( 'title', $instance['orderby'] ); ?>><?php esc_html_e( 'Title', 'technology' ); ?></option>
						<option value="parent" <?php selected( 'parent', $instance['orderby'] ); ?>><?php esc_html_e( 'Parent', 'technology' ); ?></option>
						<option value="ID" <?php selected( 'ID', $instance['orderby'] ); ?>><?php esc_html_e( 'ID', 'technology' ); ?></option>
						<option value="comment_count" <?php selected( 'comment_count', $instance['orderby'] ); ?>><?php esc_html_e( 'Comment Count', 'technology' ); ?></option>
						<option value="rand" <?php selected( 'rand', $instance['orderby'] ); ?>><?php esc_html_e( 'Random', 'technology' ); ?></option>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Sort Order', 'technology' ); ?>:</label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
						<option value="DESC" <?php selected( 'DESC', $instance['order'] ); ?>><?php esc_html_e( 'Descending (3, 2, 1)', 'technology' ); ?></option>
						<option value="ASC" <?php selected( 'ASC', $instance['order'] ); ?>><?php esc_html_e( 'Ascending (1, 2, 3)', 'technology' ); ?></option>
					</select>
				</p>

				<p>
					<input id="<?php echo esc_attr( $this->get_field_id( 'exclude_displayed' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'exclude_displayed' ) ); ?>" value="1" <?php checked( $instance['exclude_displayed'] ); ?>/>
					<label for="<?php echo esc_attr( $this->get_field_id( 'exclude_displayed' ) ); ?>"><?php esc_html_e( 'Exclude Previously Displayed Posts?', 'technology' ); ?></label>
				</p>

				<p>
					<input id="<?php echo esc_attr( $this->get_field_id( 'exclude_sticky' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'exclude_sticky' ) ); ?>" value="1" <?php checked( $instance['exclude_sticky'] ); ?>/>
					<label for="<?php echo esc_attr( $this->get_field_id( 'exclude_sticky' ) ); ?>"><?php esc_html_e( 'Exclude Sticky Posts?', 'technology' ); ?></label>
				</p>

			</div>

			<div class="genesis-widget-column-box">

				<p>
					<input id="<?php echo esc_attr( $this->get_field_id( 'show_gravatar' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'show_gravatar' ) ); ?>" value="1" <?php checked( $instance['show_gravatar'] ); ?>/>
					<label for="<?php echo esc_attr( $this->get_field_id( 'show_gravatar' ) ); ?>"><?php esc_html_e( 'Show Author Gravatar', 'technology' ); ?></label>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'gravatar_size' ) ); ?>"><?php esc_html_e( 'Gravatar Size', 'technology' ); ?>:</label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'gravatar_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gravatar_size' ) ); ?>">
						<option value="45" <?php selected( 45, $instance['gravatar_size'] ); ?>><?php esc_html_e( 'Small (45px)', 'technology' ); ?></option>
						<option value="65" <?php selected( 65, $instance['gravatar_size'] ); ?>><?php esc_html_e( 'Medium (65px)', 'technology' ); ?></option>
						<option value="85" <?php selected( 85, $instance['gravatar_size'] ); ?>><?php esc_html_e( 'Large (85px)', 'technology' ); ?></option>
						<option value="125" <?php selected( 125, $instance['gravatar_size'] ); ?>><?php esc_html_e( 'Extra Large (125px)', 'technology' ); ?></option>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'gravatar_alignment' ) ); ?>"><?php esc_html_e( 'Gravatar Alignment', 'technology' ); ?>:</label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'gravatar_alignment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gravatar_alignment' ) ); ?>">
						<option value="alignnone">- <?php esc_html_e( 'None', 'technology' ); ?> -</option>
						<option value="alignleft" <?php selected( 'alignleft', $instance['gravatar_alignment'] ); ?>><?php esc_html_e( 'Left', 'technology' ); ?></option>
						<option value="alignright" <?php selected( 'alignright', $instance['gravatar_alignment'] ); ?>><?php esc_html_e( 'Right', 'technology' ); ?></option>
					</select>
				</p>

			</div>

			<div class="genesis-widget-column-box">

				<p>
					<input id="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'show_image' ) ); ?>" value="1" <?php checked( $instance['show_image'] ); ?>/>
					<label for="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>"><?php esc_html_e( 'Show Featured Image', 'technology' ); ?></label>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>"><?php esc_html_e( 'Image Size', 'technology' ); ?>:</label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>" class="genesis-image-size-selector" name="<?php echo esc_attr( $this->get_field_name( 'image_size' ) ); ?>">
						<?php
						$sizes = genesis_get_image_sizes();
						foreach ( (array) $sizes as $name => $size ) {
							printf( '<option value="%s" %s>%s (%sx%s)</option>', esc_attr( $name ), selected( $name, $instance['image_size'], false ), esc_html( $name ), esc_html( $size['width'] ), esc_html( $size['height'] ) );
						}
						?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'image_alignment' ) ); ?>"><?php esc_html_e( 'Image Alignment', 'technology' ); ?>:</label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'image_alignment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_alignment' ) ); ?>">
						<option value="alignnone">- <?php esc_html_e( 'None', 'technology' ); ?> -</option>
						<option value="alignleft" <?php selected( 'alignleft', $instance['image_alignment'] ); ?>><?php esc_html_e( 'Left', 'technology' ); ?></option>
						<option value="alignright" <?php selected( 'alignright', $instance['image_alignment'] ); ?>><?php esc_html_e( 'Right', 'technology' ); ?></option>
						<option value="aligncenter" <?php selected( 'aligncenter', $instance['image_alignment'] ); ?>><?php esc_html_e( 'Center', 'technology' ); ?></option>
					</select>
				</p>

			</div>

		</div>

		<div class="genesis-widget-column genesis-widget-column-right">

			<div class="genesis-widget-column-box genesis-widget-column-box-top">

				<p>
					<input id="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'show_title' ) ); ?>" value="1" <?php checked( $instance['show_title'] ); ?>/>
					<label for="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>"><?php esc_html_e( 'Show Post Title', 'technology' ); ?></label>
				</p>

				<p>
					<input id="<?php echo esc_attr( $this->get_field_id( 'show_byline' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'show_byline' ) ); ?>" value="1" <?php checked( $instance['show_byline'] ); ?>/>
					<label for="<?php echo esc_attr( $this->get_field_id( 'show_byline' ) ); ?>"><?php esc_html_e( 'Show Post Info', 'technology' ); ?></label>

					<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'post_info' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_info' ) ); ?>" value="<?php echo esc_attr( $instance['post_info'] ); ?>" class="widefat" />
					<label for="<?php echo esc_attr( $this->get_field_id( 'post_info' ) ); ?>" class="screen-reader-text"><?php esc_html_e( 'Content Post Info', 'technology' ); ?></label>

				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>"><?php esc_html_e( 'Content Type', 'technology' ); ?>:</label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_content' ) ); ?>">
						<option value="content" <?php selected( 'content', $instance['show_content'] ); ?>><?php esc_html_e( 'Show Content', 'technology' ); ?></option>
						<option value="excerpt" <?php selected( 'excerpt', $instance['show_content'] ); ?>><?php esc_html_e( 'Show Excerpt', 'technology' ); ?></option>
						<option value="content-limit" <?php selected( 'content-limit', $instance['show_content'] ); ?>><?php esc_html_e( 'Show Content Limit', 'technology' ); ?></option>
						<option value="" <?php selected( '', $instance['show_content'] ); ?>><?php esc_html_e( 'No Content', 'technology' ); ?></option>
					</select>
					<br />
					<label for="<?php echo esc_attr( $this->get_field_id( 'content_limit' ) ); ?>"><?php esc_html_e( 'Limit content to', 'technology' ); ?>
						<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'content_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content_limit' ) ); ?>" value="<?php echo esc_attr( (int) $instance['content_limit'] ); ?>" size="3" />
						<?php esc_html_e( 'characters', 'technology' ); ?>
					</label>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'more_text' ) ); ?>"><?php esc_html_e( 'More Text (if applicable)', 'technology' ); ?>:</label>
					<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'more_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'more_text' ) ); ?>" value="<?php echo esc_attr( $instance['more_text'] ); ?>" />
				</p>

			</div>

			<div class="genesis-widget-column-box">

				<p id="<?php echo esc_attr( $this->get_field_id( 'extra_title' ) ); ?>-descr"><?php esc_html_e( 'To display an unordered list of more posts from this category, please fill out the information below', 'technology' ); ?>:</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'extra_title' ) ); ?>"><?php esc_html_e( 'Title', 'technology' ); ?>:</label>
					<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'extra_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'extra_title' ) ); ?>" value="<?php echo esc_attr( $instance['extra_title'] ); ?>" class="widefat" aria-describedby="<?php echo esc_attr( $this->get_field_id( 'extra_title' ) ); ?>-descr" />
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'extra_num' ) ); ?>"><?php esc_html_e( 'Number of Posts to Show', 'technology' ); ?>:</label>
					<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'extra_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'extra_num' ) ); ?>" value="<?php echo esc_attr( $instance['extra_num'] ); ?>" size="2" />
				</p>

			</div>

			<div class="genesis-widget-column-box">

				<p>
					<input id="<?php echo esc_attr( $this->get_field_id( 'more_from_category' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'more_from_category' ) ); ?>" value="1" <?php checked( $instance['more_from_category'] ); ?>/>
					<label for="<?php echo esc_attr( $this->get_field_id( 'more_from_category' ) ); ?>"><?php esc_html_e( 'Show Category Archive Link', 'technology' ); ?></label>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'more_from_category_text' ) ); ?>"><?php esc_html_e( 'Link Text', 'technology' ); ?>:</label>
					<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'more_from_category_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'more_from_category_text' ) ); ?>" value="<?php echo esc_attr( $instance['more_from_category_text'] ); ?>" class="widefat" />
				</p>

			</div>

		</div>
		<?php

	}

}