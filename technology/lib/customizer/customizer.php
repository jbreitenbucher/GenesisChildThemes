<?php
/**
 * Customizer
 *
 * This file contains any functions related to options and settings being added to the Customizer API
 *
 * @package technology
 * @author  Jon Breitenbucher
 * @license GPL-2.0-or-later
 * @link    https://github.com/jbreitenbucher/GenesisChildThemes/technology
 * @version SVN: $Id$
 * @since   3.0
 *
 */

add_action( 'customize_register', 'tech_customizer_settings' );
function tech_customizer_settings( $wp_customize ) {
	$wp_customize->add_section( 'tech_settings' , array(
    	'title'			=> esc_html__('Technology Theme Specific', 'technology'),
    	'priority'		=> 30,
    	'capability'	=> 'edit_theme_options', //Capability needed to tweak
		'description'	=> esc_html__('Allows you to customize some settings specific to the Technology Theme.', 'technology'),
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
		'label'    => esc_html__( 'Staff Per Page', 'technology' ),
		'section'  => 'tech_settings',
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
		'label'    => esc_html__( 'Category used to identify STAs', 'technology' ),
		'section'  => 'tech_settings',
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
		'label'    => esc_html__( 'Category(ies) used to identify professional staff', 'technology' ),
		'section'  => 'tech_settings',
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
		'label'    => esc_html__( 'Heading to display on the Staff page. (optional)', 'technology' ),
		'section'  => 'tech_settings',
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
		'label'    => esc_html__( 'Category used to identify blog posts', 'technology' ),
		'section'  => 'tech_settings',
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