<?php
/**
 * Customizer
 *
 * This file contains any functions related to options and settings being added to the Customizer API
 *
 * @package       technology
 * @author        Jon Breitenbucher <jbreitenbucher@wooster.edu>
 * @copyright     Copyright (c) 2019, The College of Wooster
 * @license       http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version       SVN: $Id$
 * @since         3.0
 *
 */

add_action( 'customize_register', 'it_customizer_settings' );
function it_customizer_settings( $wp_customize ) {
	$wp_customize->add_section( 'it_settings' , array(
    	'title'			=> 'Technology Theme Specific',
    	'priority'		=> 30,
    	'capability'	=> 'edit_theme_options', //Capability needed to tweak
		'description'	=> __('Allows you to customize some settings specific to the Technology Theme.', 'it-theme'),
		'panel'			=> 'genesis',
		)
	);

	$wp_customize->add_setting( 'technology_staff_posts_per_page' , array(
		'type'			=> 'option',
    	'default'		=> 6,
		'transport'		=> 'refresh',
		'sanitize_callback' => 'sanitize_number',
		) 
	);

	$wp_customize->add_control( 'technology_staff_posts_per_page_contol', array(
		'label'    => __( 'Staff Per Page', 'it-theme' ),
		'section'  => 'it_settings',
		'settings' => 'technology_staff_posts_per_page',
		'type'     => 'number',
		)
	);

	$wp_customize->add_setting( 'technology_staff_student_role' , array(
		'type'			=> 'option',
    	'default'		=> 'sta',
		'transport'		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
		) 
	);

	$wp_customize->add_control( 'technology_staff_student_role_contol', array(
		'label'    => __( 'Category used to identify STAs', 'it-theme' ),
		'section'  => 'it_settings',
		'settings' => 'technology_staff_student_role',
		'type'     => 'text',
		)
	);

	$wp_customize->add_setting( 'technology_staff_professional_roles' , array(
		'type'			=> 'option',
    	'default'		=> '',
		'transport'		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
		) 
	);

	$wp_customize->add_control( 'technology_staff_professional_roles_contol', array(
		'label'    => __( 'Category(ies) used to identify professional staff', 'it-theme' ),
		'section'  => 'it_settings',
		'settings' => 'technology_staff_professional_roles',
		'type'     => 'text',
		)
	);

	$wp_customize->add_setting( 'technology_staff_page_heading' , array(
		'type'			=> 'option',
    	'default'		=> '',
		'transport'		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
		) 
	);

	$wp_customize->add_control( 'technology_staff_page_heading_contol', array(
		'label'    => __( 'Heading to display on the Staff page. (optional)', 'it-theme' ),
		'section'  => 'it_settings',
		'settings' => 'technology_staff_page_heading',
		'type'     => 'text',
		)
	);

	$wp_customize->add_setting( 'tech_blog_cat_setting' , array(
		'type'			=> 'option',
    	'default'		=> 'it-blog',
		'transport'		=> 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
		) 
	);

	$wp_customize->add_control( 'tech_blog_cat_setting_contol', array(
		'label'    => __( 'Category used to identify blog posts', 'it-theme' ),
		'section'  => 'it_settings',
		'settings' => 'tech_blog_cat_setting',
		'type'     => 'text',
		)
	);
}

function sanitize_number( $input, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = filter_var($input, FILTER_SANITIZE_NUMBER_INT);

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $input ? $number : $setting->default );
}