<?php
/**
 * This file controls all parts of the Faculty Child Theme Settings.
 *
 * @package Faculty
 * @author StudioPress & Gary Jones
 */
 
/**
 * This function registers the default values for the Genesis child theme design settings.
 *
 * @author StudioPress
 * @return array Array of default settings
 * @version 1.0
 */
function faculty_settings_defaults() {
	$defaults = array( // define our defaults
		
		##################### globals
		'body_font_color' => '#222222',
		'body_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'body_font_size' => '15',
		'body_line_height' => '24',
		
		##################### global links
		'body_link_color' => '#222222',
		'body_link_decoration' => 'underline',
		'body_link_hover' => '#222222',
		'body_link_hover_decoration' => 'none',
		
		##################### wrap
		'wrap_background_color' => '#FFFFFF',
		'wrap_background_color_select' => 'hex',
		'wrap_margin_top' => "15",
		'wrap_margin_bottom' => "0",
		'wrap_padding' => "10",
		'wrap_border' => "5",
		'wrap_border_color' => '#EDEDED',
		'wrap_border_style' => 'solid',
		'wrap_corner_radius' => "1em 3em 1em 3em",
		'wrap_background_shadow' => "none",
		
		##################### branding
		'branding_background_color' => '#F3F3F3',
		'branding_background_color_select' => 'hex',
		'branding_font_color' => '#666666',
		'branding_font_size' => '13',
		'branding_border' => "1",
		'branding_border_color' => '#DDDDDD',
		'branding_border_style' => 'solid',
		'branding_corner_radius' => "1em 3em 0em 0em",
		
		##################### branding wordmark
		'branding_wordmark_top_padding' => "25",
		'branding_wordmark_left_padding' => "25",
		'branding_wordmark_font_color' => '#666666',
		'branding_wordmark_font_size' => '36',
		'branding_wordmark_link_decoration' => 'none',
		
		##################### branding tagline
		'branding_tagline_top_padding' => "25",
		'branding_tagline_right_padding' => "10",
		'branding_tagline_font_color' => '#666666',
		'branding_tagline_font_size' => '13',
		
		##################### header
		'header_image_height' => '150',
		'header_title_area_width' => '450',
		'header_widget_area_width' => '478',
		'header_background_color' => '#FFFFFF',
		'header_background_color_select' => 'hex',
		
		##################### header title
		'header_top_padding' => "40",
		'header_left_padding' => "20",
		'header_title_font_color' => '#222222',
		'header_title_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'header_title_font_size' => '36',
		'header_title_line_height' => '42',
		
		##################### header tagline
		'header_tagline_top_padding' => "0",
		'header_tagline_left_padding' => "20",
		'header_tagline_font_color' => '#999999',
		'header_tagline_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'header_tagline_font_size' => '15',
		'header_tagline_font_style' => 'italic',
		
		##################### primary nav
		'primary_nav_background_color' => '#F3F3F3',
		'primary_nav_background_color_select' => 'hex',
		'primary_nav_border' => "1",
		'primary_nav_border_color' => '#DDDDDD',
		'primary_nav_border_style' => 'solid',
		'primary_nav_inner_border' => "1",
		'primary_nav_inner_border_color' => '#FFFFFF',
		'primary_nav_inner_border_style' => 'solid',
		'primary_nav_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'primary_nav_font_size' => '13',
		'primary_nav_link_color' => '#666666',
		'primary_nav_link_background' => '#F3F3F3',
		'primary_nav_link_background_select' => 'hex',
		'primary_nav_link_decoration' => 'none',
		'primary_nav_link_hover' => '#FFFFFF',
		'primary_nav_link_hover_background' => '#444444',
		'primary_nav_link_hover_background_select' => 'hex',
		'primary_nav_link_hover_decoration' => 'none',
		
		##################### secondary nav
		'secondary_nav_background_color' => '#F3F3F3',
		'secondary_nav_background_color_select' => 'hex',
		'secondary_nav_border' => "1",
		'secondary_nav_border_color' => '#DDDDDD',
		'secondary_nav_border_style' => 'solid',
		'secondary_nav_inner_border' => "1",
		'secondary_nav_inner_border_color' => '#FFFFFF',
		'secondary_nav_inner_border_style' => 'solid',
		'secondary_nav_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'secondary_nav_font_size' => '13',
		'secondary_nav_link_color' => '#666666',
		'secondary_nav_link_background' => '#F3F3F3',
		'secondary_nav_link_decoration' => 'none',
		'secondary_nav_link_background_select' => 'hex',
		'secondary_nav_link_hover' => '#FFFFFF',
		'secondary_nav_link_hover_background' => '#444444',
		'secondary_nav_link_hover_background_select' => 'hex',
		'secondary_nav_link_hover_decoration' => 'none',
		
		##################### breadcrumb navigation
		'breadcrumb_font_color' => '#222222',
		'breadcrumb_border' => "1",
		'breadcrumb_border_color' => '#AAAAAA',
		'breadcrumb_border_style' => 'dotted',
		'breadcrumb_font_size' => '13',
		'breadcrumb_text_transform' => 'none',
		
		##################### post info
		'post_info_background_color' => '#F9F9F9',
		'post_info_background_color_select' => 'hex',
		'post_info_font_color' => '#666666',
		'post_info_font_size' => '13',
		'post_info_text_transform' => 'none',
		
		##################### post meta
		'post_meta_background_color' => '#F9F9F9',
		'post_meta_background_color_select' => 'hex',
		'post_meta_font_color' => '#666666',
		'post_meta_font_size' => '13',
		'post_meta_text_transform' => 'none',
		
		##################### blockquotes
		'blockquotes_background_color' => '#F3F3F3',
		'blockquotes_background_color_select' => 'hex',
		'blockquotes_font_color' => '#222222',
		'blockquotes_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'blockquotes_font_style' => 'normal',
		'blockquotes_border' => "1",
		'blockquotes_border_color' => '#DDDDDD',
		'blockquotes_border_style' => 'solid',
		
		##################### notice box
		'notice_background_color' => '#F5F8FA',
		'notice_background_color_select' => 'hex',
		'notice_font_color' => '#222222',
		'notice_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'notice_font_style' => 'normal',
		'notice_border' => "1",
		'notice_border_color' => '#D7E8F0',
		'notice_border_style' => 'solid',
		
		##################### headlines
		'headline_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'h1_font_size' => '26',
		'h2_font_size' => '26',
		'h3_font_size' => '20',
		'h4_font_size' => '18',
		'h5_font_size' => '16',
		'h6_font_size' => '14',
		'h1_font_color' => '#222222',
		'h2_font_color' => '#222222',
		'h3_font_color' => '#222222',
		'h4_font_color' => '#222222',
		'h5_font_color' => '#222222',
		'h6_font_color' => '#222222',
		'headline_font_style' => 'normal',
		'headline_font_weight' => 'bold',
		'headline_text_transform' => 'none',
		
		##################### headline links
		'h2_link_color' => '#222222',
		'h2_link_decoration' => 'none',
		'h2_link_hover' => '#444444',
		'h2_link_hover_decoration' => 'none',

		##################### sidebar widget headlines
		'sidebar_headline_border' => "1",
		'sidebar_headline_border_color' => '#AAAAAA',
		'sidebar_headline_border_style' => 'dotted',
		'sidebar_headline_font_color' => '#222222',
		'sidebar_headline_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'sidebar_headline_font_size' => '16',
		'sidebar_headline_font_style' => 'normal',
		'sidebar_headline_font_weight' => 'normal',
		'sidebar_headline_text_transform' => 'none',
		
		##################### footer widget area
		'footer_widget_background_color' => '#F3F3F3',
		'footer_widget_background_color_select' => 'hex',
		'footer_widget_border' => "1",
		'footer_widget_border_color' => '#DDDDDD',
		'footer_widget_border_style' => 'solid',
		
		##################### footer widgets widget background
		'footer_widgets_widget_background_color' => '#999999',
		'footer_widgets_widget_background_color_select' => 'hex',
		'footer_widgets_widget_border' => "1",
		'footer_widgets_widget_border_color' => '#DDDDDD',
		'footer_widgets_widget_border_style' => 'solid',
		'footer_widgets_widget_corner_radius' => "1em",
		'footer_widgets_widget_background_shadow' => "0 1px 3px #F3F3F3",
		
		##################### footer widget headlines
		'footer_headline_border' => "1",
		'footer_headline_border_color' => '#AAAAAA',
		'footer_headline_border_style' => 'dotted',
		'footer_headline_font_color' => '#222222',
		'footer_headline_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'footer_headline_font_size' => '16',
		'footer_headline_font_style' => 'normal',
		'footer_headline_font_weight' => 'normal',
		'footer_headline_text_transform' => 'none',
            
    ##################### footer widget links
		'footer_widget_link_color' => '#222222',
		'footer_widget_link_decoration' => 'none',
		'footer_widget_link_hover' => '#222222',
		'footer_widget_link_hover_decoration' => 'underline',
				
		##################### footer
		'footer_background_color' => '#666666',
		'footer_font_color' => '#222222',
		'footer_font_size' => '13',
		'footer_font_weight' => 'normal',
		'footer_text_transform' => 'uppercase',
		'footer_border' => "1",
		'footer_border_color' => '#DDDDDD',
		'footer_border_style' => 'solid',
		'footer_corner_radius' => "0em 0em 1em 3em",
		
		##################### footer links
		'footer_link_color' => '#222222',
		'footer_link_decoration' => 'none',
		'footer_link_hover' => '#222222',
		'footer_link_hover_decoration' => 'underline',
		
		##################### input box
		'input_background_color' => '#F3F3F3',
		'input_background_color_select' => 'hex',
		'input_font_color' => '#666666',
		'input_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'input_font_style' => 'normal',
		'input_border' => "1",
		'input_border_color' => '#DDDDDD',
		'input_border_style' => 'solid',
	
		##################### buttons
		'button_background_color' => '#444444',
		'button_background_color_select' => 'hex',
		'button_background_hover_color' => '#222222',
		'button_background_hover_color_select' => 'hex',
		'button_font_color' => '#FFFFFF',
		'button_font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		'button_font_size' => '13',
		'button_text_transform' => 'uppercase',

		##################### install flag (do not edit)
		'installed' => 'true',
		
		##################### general settings
		'minify_css' => 'true'
	
	);
	
	return apply_filters('faculty_settings_defaults', $defaults);
}


/**
 * Maps the stored values, to the output formats.
 *
 * @author Gary Jones
 * @since 0.9.5
 * @version 1.0
 * @return array Multi-dimensional array mapping CSS selectors to the settings
 */
function faculty_get_mapping() {
    // Format:
    // '#selector' => array(
    //      'property1' => 'value1',
    //      'property2' => 'value2',
    //      'property-with-multiple-values-or-units' => array(
    //          array('value', 'unit'),
    //          array('value', 'string'),
    //          array('value', 'unit')
    //      ),
    //      'property4' => 'value4'
    // ),

    $mapping = array (
        'body' => array(
            'color' => 'body_font_color',
            'font-family' => 'body_font_family',
            'font-size' => array(
                array('body_font_size', 'px')
            ),
            'line-height' => array(
                array('body_line_height', 'px')
            )
        ),
        'a, a:visited' => array(
            'color' => 'body_link_color',
            'text-decoration' => 'body_link_decoration'
        ),
        'a:hover' => array(
            'color' => 'body_link_hover',
            'text-decoration' => 'body_link_hover_decoration'
        ),
        '#wrap' => array(
            'background-color' => 'wrap_background_color',
            'background-color_select' => 'wrap_background_color_select',
            'margin' => array(
                array('wrap_margin_top', 'px'),
                array('auto', 'fixed_string'),
                array('wrap_margin_bottom', 'px')
            ),
            'padding' => array(
                array('wrap_padding','px')
            ),
            'border' => array(
                array('wrap_border','px'),
                array('wrap_border_style', 'string'),
                array('wrap_border_color', 'string')
            ),
            '-moz-border-radius' => 'wrap_corner_radius',
            '-khtml-border-radius' => 'wrap_corner_radius',
            '-webkit-border-radius' => 'wrap_corner_radius',
            'border-radius' => 'wrap_corner_radius',
            '-moz-box-shadow' => 'wrap_background_shadow',
            '-webkit-box-shadow' => 'wrap_background_shadow'
        ),
				'#branding' => array(
						'color' => 'branding_font_color',
						'font-size' => array(
				        array('branding_font_size','px')
				    ),
				    'background-color' => 'branding_background_color',
				    'background-color_select' => 'branding_background_color_select',
				    'border' => array(
				        array('branding_border','px'),
				        array('branding_border_style', 'string'),
				        array('branding_border_color', 'string')
				    ),
				    '-moz-border-radius' => 'branding_corner_radius',
				    '-khtml-border-radius' => 'branding_corner_radius',
				    '-webkit-border-radius' => 'branding_corner_radius',
				    'border-radius' => 'branding_corner_radius',
				),
				'.wordmark' => array(
            'padding-top' => array(
                array('branding_wordmark_top_padding','px')
            ),
            'padding-left' => array(
                array('branding_wordmark_left_padding','px')
            )
        ),
				'.wordmark a, .wordmark a:hover' => array(
            'color' => 'branding_wordmark_font_color',
						'text-decoration' => 'branding_wordmark_link_decoration',
            'font-size' => array(
                array('branding_wordmark_font_size','px')
            )
        ),
				'.tagline' => array(
						'color' => 'branding_tagline_font_color',
						'font-size' => array(
                array('branding_tagline_font_size','px')
            ),
            'padding-top' => array(
                array('branding_tagline_top_padding','px')
            ),
            'padding-right' => array(
                array('branding_tagline_right_padding','px')
            )
        ),
        '#header' => array(
				            'height' => array(
				                array('header_image_height','px')
				            ),
				            'background-color' => 'header_background_color',
				            'background-color_select' => 'header_background_color_select'
				        ),
        '#title-area' => array(
            'width' => array(
                array('header_title_area_width','px')
            )
        ),
        
        '#title-area #title ' => array(
            'padding-top' => array(
                array('header_top_padding','px')
            ),
            'padding-left' => array(
                array('header_left_padding','px')
            )
        ),
        '.header-image #title-area, .header-image #title-area #title, .header-image #title-area #title a' => array(
            'width' => array(
                array('header_title_area_width','px')
            ),
            'height' => array(
                array('header_image_height','px')
            )
        ),
        '#title-area #title a, #title-area #title a:hover' => array(
            'color' => 'header_title_font_color',
            'font-family' => 'header_title_font_family',
            'font-size' => array(
                array('header_title_font_size','px')
            ),
            'line-height' => array(
                array('header_title_line_height','px')
            )
        ),
        '#title-area #description' => array(
            'color' => 'header_tagline_font_color',
            'font-family' => 'header_tagline_font_family',
            'font-size' => array(
                array('header_tagline_font_size','px')
            ),
            'padding-left' => array(
                array('header_tagline_left_padding','px')
            ),
            'padding-top' => array(
                array('header_tagline_top_padding','px')
            ),
            'font-style' => 'header_tagline_font_style'
        ),
        '#header .widget-area' => array(
            'width' => array(
                array('header_widget_area_width','px')
            )
        ),
        '#nav' => array(
            'background-color' => 'primary_nav_background_color',
            'background-color_select' => 'primary_nav_background_color_select',
            'font-family' => 'primary_nav_font_family',
            'font-size' => array(
                array('primary_nav_font_size','px')
            ),
            'border' => array(
                array('primary_nav_border','px'),
                array('primary_nav_border_style','string'),
                array('primary_nav_border_color','string')
            ),
            'width' => '#nav_width_calc'
        ),
        '#nav ul' => array(
            'width' => '#nav_ul_width_calc',
			'border' => array(
                array('primary_nav_inner_border','px'),
                array('primary_nav_inner_border_style','string'),
                array('primary_nav_inner_border_color','string')
            )
        ),
        '#nav li a' => array(
            'background-color' => 'primary_nav_link_background',
            'background-color_select' => 'primary_nav_link_background_select',
            'color' => 'primary_nav_link_color',
            'text-decoration' => 'primary_nav_link_decoration'
        ),
        '#nav li.right a, #nav li.rss a, #nav li.twitter a' => array(
            'color' => 'primary_nav_link_color',
        ),
        '#nav li a:hover, #nav li a:active, #nav .current_page_item a, #nav .current-cat a, #nav .current-menu-item a' => array(
            'background-color' => 'primary_nav_link_hover_background',
            'background-color_select' => 'primary_nav_link_hover_background_select',
            'color' => 'primary_nav_link_hover',
            'text-decoration' => 'primary_nav_link_hover_decoration'
        ),
        '#nav li.right a:hover, #nav li.rss a:hover, #nav li.twitter a:hover' => array(
            'color' => 'primary_nav_link_color',
        ),        
        '#nav li li a, #nav li li a:link, #nav li li a:visited' => array(
            'background-color' => 'primary_nav_link_background',
            'background-color_select' => 'primary_nav_link_background_select',
            'color' => 'primary_nav_link_color'
        ),
        '#nav li li a:hover, #nav li li a:active' => array(
            'background-color' => 'primary_nav_link_hover_background',
            'background-color_select' => 'primary_nav_link_hover_background_select',
            'color' => 'primary_nav_link_hover'
        ),
        '#subnav' => array(
            'background-color' => 'secondary_nav_background_color',
            'background-color_select' => 'secondary_nav_background_color_select',
            'font-family' => 'secondary_nav_font_family',
            'font-size' => array(
                array('secondary_nav_font_size','px')
            ),            
            'border' => array(
                array('secondary_nav_border','px'),
                array('secondary_nav_border_style','string'),
                array('secondary_nav_border_color','string')
            ),
            'width' => '#subnav_width_calc'
        ),
        '#subnav ul' => array(
            'width' => '#subnav_ul_width_calc',
            'border' => array(
                array('secondary_nav_inner_border','px'),
                array('secondary_nav_inner_border_style','string'),
                array('secondary_nav_inner_border_color','string')
            ),
        ),
        '#subnav li a' => array(
            'background-color' => 'secondary_nav_link_background',
            'background-color_select' => 'secondary_nav_link_background_select',
            'color' => 'secondary_nav_link_color',
            'text-decoration' => 'secondary_nav_link_decoration'
        ),
        '#subnav li a:hover, #subnav li a:active, #subnav .current_page_item a, #subnav .current-cat a, #subnav .current-menu-item a' => array(
            'background-color' => 'secondary_nav_link_hover_background',
            'background-color_select' => 'secondary_nav_link_hover_background_select',
            'color' => 'secondary_nav_link_hover',
            'text-decoration' => 'secondary_nav_link_hover_decoration'
        ),
        '#subnav li li a, #subnav li li a:link, #subnav li li a:visited' => array(
            'background-color' => 'secondary_nav_link_background',
            'background-color_select' => 'secondary_nav_link_background_select',
            'color' => 'secondary_nav_link_color'
        ),
        '#subnav li li a:hover, #subnav li li a:active' => array(
            'background-color' => 'secondary_nav_link_hover_background',
            'background-color_select' => 'secondary_nav_link_hover_background_select',
            'color' => 'secondary_nav_link_hover'
        ),
        '.breadcrumb' => array(
            'color' => 'breadcrumb_font_color',
            'text-transform' => 'breadcrumb_text_transform',
            'font-size' => array(
                array('breadcrumb_font_size','px')
            ),
            'border-bottom' => array(
                array('breadcrumb_border','px'),
                array('breadcrumb_border_style','string'),
                array('breadcrumb_border_color','string')
            ),
        ),
        '.post-info' => array(
            'background-color' => 'post_info_background_color',
            'background-color_select' => 'post_info_background_color_select',
            'color' => 'post_info_font_color',
            'text-transform' => 'post_info_text_transform',
            'font-size' => array(
                array('post_info_font_size','px')
            ),
        ),
        '.post-meta' => array(
            'background-color' => 'post_meta_background_color',
            'background-color_select' => 'post_meta_background_color_select',
            'color' => 'post_meta_font_color',
            'text-transform' => 'post_meta_text_transform',
            'font-size' => array(
                array('post_meta_font_size','px')
            ),
        ),
        '#content blockquote' => array(
            'color' => 'blockquotes_font_color',
            'font-family' => 'blockquotes_font_family',
            'font-style' => 'blockquotes_font_style',
            'background-color' => 'blockquotes_background_color',
            'background-color_select' => 'blockquotes_background_color_select',
            'border' => array(
                array('blockquotes_border','px'),
                array('blockquotes_border_style','string'),
                array('blockquotes_border_color','string')
            ),
        ),      
        '#content p.notice' => array(
            'color' => 'notice_font_color',
            'font-family' => 'notice_font_family',
            'font-style' => 'notice_font_style',
            'background-color' => 'notice_background_color',
            'background-color_select' => 'notice_background_color_select',
            'border' => array(
                array('notice_border','px'),
                array('notice_border_style','string'),
                array('notice_border_color','string')
            ),
        ),              
        '#content h1, #content h2, #content h3, #content h4, #content h5, #content h6' => array(
            'font-family' => 'headline_font_family',
            'font-style' => 'headline_font_style',
            'font-weight' => 'headline_font_weight',
            'text-transform' => 'headline_text_transform'
        ),
        '#content h1' => array(
            'font-size' => array(
                array('h1_font_size','px')
            ),
            'color' => 'h1_font_color'
        ),
        '#content h2' => array(
            'font-size' => array(
                array('h2_font_size','px')
            ),
            'color' => 'h2_font_color'
        ),
        '#content h2 a, #content h2 a:visited' => array(
            'color' => 'h2_link_color',
            'text-decoration' => 'h2_link_decoration'
        ),
        '#content h2 a:hover' => array(
            'color' => 'h2_link_hover',
            'text-decoration' => 'h2_link_hover_decoration'
        ),
        '#content h3' => array(
            'font-size' => array(
                array('h3_font_size','px')
            ),
            'color' => 'h3_font_color'
        ),
        '#content h4' => array(
            'font-size' => array(
                array('h4_font_size','px')
            ),
            'color' => 'h4_font_color'
        ),
        '#content h5' => array(
            'font-size' => array(
                array('h5_font_size','px')
            ),
            'color' => 'h5_font_color'
        ),
        '#content h6' => array(
            'font-size' => array(
                array('h6_font_size','px')
            ),
            'color' => 'h6_font_color'
        ),
        '#sidebar h4, #sidebar-alt h4' => array(
            'color' => 'sidebar_headline_font_color',
            'font-family' => 'sidebar_headline_font_family',
            'font-size' => array(
                array('sidebar_headline_font_size', 'px')
            ),
            'font-style' => 'sidebar_headline_font_style',
            'font-weight' => 'sidebar_headline_font_weight',
            'border-bottom' => array(
                array('sidebar_headline_border','px'),
                array('sidebar_headline_border_style','string'),
                array('sidebar_headline_border_color','string')
            ),
            'text-transform' => 'sidebar_headline_text_transform'
        ),
        '#footer-widgets' => array(
            'background-color' => 'footer_widget_background_color',
            'background-color_select' => 'footer_widget_background_color_select',
            'border' => array(
                array('footer_widget_border','px'),
                array('footer_widget_border_style','string'),
                array('footer_widget_border_color','string')
            )
        ),
				'#footer-widgets .widget' => array(
            'background-color' => 'footer_widgets_widget_background_color',
            'background-color_select' => 'footer_widgets_widget_background_color_select',
            'border' => array(
                array('footer_widgets_widget_border','px'),
                array('footer_widgets_widget_border_style','string'),
                array('footer_widgets_widget_border_color','string')
            ),
						'-moz-border-radius' => 'footer_widgets_widet_corner_radius',
				    '-khtml-border-radius' => 'footer_widgets_widet_corner_radius',
				    '-webkit-border-radius' => 'footer_widgets_widet_corner_radius',
				    'border-radius' => 'footer_widgets_widet_corner_radius',
						'-moz-box-shadow' => 'footer_widgets_widget_background_shadow',
            '-webkit-box-shadow' => 'footer_widgets_widget_background_shadow'
        ),
        '#footer-widgets h4' => array(
            'color' => 'footer_headline_font_color',
            'font-family' => 'footer_headline_font_family',
            'font-size' => array(
                array('footer_headline_font_size', 'px')
            ),
            'font-style' => 'footer_headline_font_style',
            'font-weight' => 'footer_headline_font_weight',
            'border-bottom' => array(
                array('footer_headline_border','px'),
                array('footer_headline_border_style','string'),
                array('footer_headline_border_color','string')
            ),
            'text-transform' => 'footer_headline_text_transform'
        ),
        '#footer-widgets a, #footer-widgets a:visited, #footer-widgets li a, #footer-widgets li a:visited' => array(
            'color' => 'footer_widget_link_color',
            'text-decoration' => 'footer_widget_link_decoration'
        ),
        '#footer-widgets a:hover, #footer-widgets li a:hover' => array(
            'color' => 'footer_widget_link_hover',
            'text-decoration' => 'footer_widget_link_hover_decoration'
        ),
        '#footer' => array(
            'color' => 'footer_font_color',
						'background-color' => 'footer_background_color',
	          'background-color_select' => 'footer_background_color_select',
            'font-size' => array(
                array('footer_font_size', 'px')
            ),
            'font-weight' => 'footer_font_weight',
            'text-transform' => 'footer_text_transform',
						'border' => array(
				        array('footer_border','px'),
				        array('footer_border_style', 'string'),
				        array('footer_border_color', 'string')
				    ),
				    '-moz-border-radius' => 'footer_corner_radius',
				    '-khtml-border-radius' => 'footer_corner_radius',
				    '-webkit-border-radius' => 'footer_corner_radius',
				    'border-radius' => 'footer_corner_radius',
        ),
        '#footer a, #footer a:visited' => array(
            'color' => 'footer_link_color',
            'text-decoration' => 'footer_link_decoration'
        ),
        '#footer a:hover' => array(
            'color' => 'footer_link_hover',
            'text-decoration' => 'footer_link_hover_decoration'
        ),
        '.s, #author, #email, #url, #comment, .enews #subbox, .faculty-input' => array(
            'color' => 'input_font_color',
            'font-family' => 'input_font_family',
            'font-style' => 'input_font_style',
            'background-color' => 'input_background_color',
            'background-color_select' => 'input_background_color_select',
            'border' => array(
                array('input_border','px'),
                array('input_border_style','string'),
                array('input_border_color','string')
            ),
        ),                
        '#submit, .searchsubmit, .enews #subbutton, #content .gform_footer .button, .reply a, .reply a:visited, .faculty-button' => array(
            'background-color' => 'button_background_color',
            'background-color_select' => 'button_background_color_select',
            'color' => 'button_font_color',
            'text-transform' => 'button_text_transform',
            'font-family' => 'button_font_family',
            'font-size' => array(
                array('button_font_size','px')
            )
        ),
        '#submit:hover, .searchsubmit:hover, .enews #subbutton:hover, .gform_footer .button:hover, .reply a:hover, .faculty-button:hover' => array(
            'background-color' => 'button_background_hover_color',
            'background-color_select' => 'button_background_hover_color_select',
        ),         
        'minify_css' => 'minify_css'
    );
    return apply_filters('faculty_get_mapping',$mapping);
}



/**
 * Used to create the actual markup of options.
 *
 * @author Gary Jones
 * @param string Used as comparison to see which option should be selected.
 * @param string $type One of 'border', 'family', 'style', 'variant', 'weight', 'align', 'decoration', 'transform'.
 * @since 0.9.5
 * @return string HTML markup of dropdown options
 * @version 1.0
 */
function faculty_create_options($compare, $type) {
    
    switch($type) {
        case "border":
            // border styles
            $options = array(
                array('None', 'none'),
                array('Solid', 'solid'),
                array('Dashed', 'dashed'),
                array('Dotted', 'dotted'),
                array('Double', 'double'),
                array('Groove', 'groove'),
                array('Ridge', 'ridge'),
                array('Inset', 'inset'),
                array('Outset', 'outset')
            );
            break;
        case "family":
            //font-family sets
            $options = array(
                array('Arial', 'Arial, Helvetica, sans-serif'),
                array('Arial Black', "'Arial Black', Gadget, sans-serif"),
                array('Century Gothic', "'Century Gothic', sans-serif"),
                array('Courier New', "'Courier New', Courier, monospace"),
                array('Georgia', 'Georgia, serif'),
                array('Lucida Console', "'Lucida Console', Monaco, monospace"),
                array('Lucida Sans Unicode', "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"),
                array('Palatino Linotype', "'Palatino Linotype', 'Book Antiqua', Palatino, serif"),
                array('Tahoma', 'Tahoma, Geneva, sans-serif'),
                array('Times New Roman', "'Times New Roman', serif"),
                array('Trebuchet MS', "'Trebuchet MS', Helvetica, sans-serif"),
                array('Verdana', 'Verdana, Geneva, sans-serif')
            );
            $options = apply_filters('faculty_font_family_options', $options);
            sort($options);
            array_unshift($options, array('Inherit', 'inherit')); // Adds Inherit option as first option.
            break;
        case "style":
            // font-style options
            $options = array(
                array('Normal', 'normal'),
                array('Italic', 'italic')
            );
            break;
        case "variant":
            // font-variant options
            $options = array(
                array('Normal', 'normal'),
                array('Small-Caps', 'small-caps')
            );
            break;
        case "weight":
            // font-weight options
            $options = array(
                array('Normal', 'normal'),
                array('Bold', 'bold')
            );
            break;
        case "align":
            // text-align options
            $options = array(
                array('Left', 'left'),
                array('Center', 'center'),
                array('Right', 'right'),
                array('Justify', 'justify')
            );
            break;
        case "decoration":
            // text-decoration options
            $options = array(
                array('None', 'none'),
                array('Underline', 'underline'),
                array('Overline', 'overline')
                // Include line-through?
            );
            break;
        case "transform":
            // text-transform options
            $options = array(
                array('None', 'none'),
                array('Capitalize', 'capitalize'),
                array('Lowercase', 'lowercase'),
                array('Uppercase', 'uppercase')
            );
            break;
        case "background":
            // background color options
            $options = array(
                array('Color (Hex)', 'hex'),
                array('Inherit', 'inherit'),
                array('Transparent', 'transparent')
            );
            break;
        case "color":
            // font color options
            $options = array(
                array('Color (Hex)', 'hex'),
                array('Inherit', 'inherit')
            );
            break;
        default:
            $options = '';
    }
    if ( is_array($options) ) {
        $output = '';
        foreach ($options as $option) {
            $output .= '<option value="'. esc_attr($option[1]) . '" title="' . esc_attr($option[1]) . '" ' . selected(esc_attr($option[1]), esc_attr($compare), false) . '>' . __($option[0], FACULTY_DOMAIN) . '</option>';
        }
    } else {
        $output = '<option>'.__('Select type was not valid.', FACULTY_DOMAIN).'</option>';
    }
    return $output;
}


/**
 * This registers the settings field and adds defaults to the options table.
 *
 * @author StudioPress
 */
add_action('admin_init', 'faculty_register_settings');
function faculty_register_settings() {
	register_setting(FACULTY_SETTINGS_FIELD, FACULTY_SETTINGS_FIELD);
	add_option(FACULTY_SETTINGS_FIELD, faculty_settings_defaults(), '', 'yes');
	
	if ( !isset($_REQUEST['page']) || $_REQUEST['page'] != 'design-settings' )
		return;
		
	if ( faculty_get_design_option('reset') ) {
		update_option(FACULTY_SETTINGS_FIELD, faculty_settings_defaults());
		wp_redirect( admin_url( 'admin.php?page=design-settings&reset=true' ) );
		exit;
	}
}

/**
 * This is the notice that displays when you successfully save or reset
 * the theme settings.
 *
 * @author StudioPress
 * @version 1.0
 */
add_action('admin_notices', 'faculty_settings_notice');
function faculty_settings_notice() {
	
	if ( !isset($_REQUEST['page']) || $_REQUEST['page'] != 'design-settings' )
		return;
	
	if ( isset( $_REQUEST['reset'] ) && $_REQUEST['reset'] == 'true' ) {
		echo '<div id="message" class="updated"><p>'.__('Design Settings Reset', FACULTY_DOMAIN).'</p></div>';
	}
	elseif ( isset($_REQUEST['updated']) && $_REQUEST['updated'] == 'true') {  
		echo '<div id="message" class="updated"><p>'.__('Design Settings Saved', FACULTY_DOMAIN).'</p></div>';
	}
        elseif ( isset($_REQUEST['faculty']) && 'import' == $_REQUEST['faculty']) {
	    echo '<div id="message" class="updated"><p>'.__('Design Settings Imported', FACULTY_DOMAIN).'</p></div>';
	}
        elseif ( isset($_REQUEST['faculty']) && 'wrongfile' == $_REQUEST['faculty']) {
	    echo '<div id="message" class="error"><p><strong>'.sprintf(__('You tried to import an incorrect file. The filename should start with "%s".', FACULTY_DOMAIN), faculty_get_export_filename_prefix()).'</strong></p></div>';
	}
        elseif ( isset($_REQUEST['faculty']) && 'file' == $_REQUEST['faculty']) {
	    echo '<div id="message" class="error"><p><strong>'.__('There was a problem with the file you uploaded.', FACULTY_DOMAIN).'</strong></p></div>';
	}
        
        if (faculty_make_stylesheet_path_writable()) {
            echo '<div id="message-unwritable" class="error"><p><strong>'. sprintf( __('The %s folder does not exist or is not writeable. Please create it or <a href="http://codex.wordpress.org/Changing_File_Permissions">change file permissions</a> to 777.', FACULTY_DOMAIN), _get_template_edit_filename(faculty_get_stylesheet_location('path'), dirname(faculty_get_stylesheet_location('path'))) ) . '</strong></p></div>';
        }
	
}

/**
 * This is a necessary go-between to get our scripts and boxes loaded
 * on the theme settings page only, and not the rest of the admin.
 *
 * @author StudioPress
 * @global string $_faculty_settings_pagehook value set in this function
 */
add_action('admin_menu', 'faculty_settings_init');
function faculty_settings_init() {
	global $_faculty_settings_pagehook;
        
	// Add "Design Settings" submenu
	$_faculty_settings_pagehook = current_theme_supports('faculty-design-settings') ? add_submenu_page('genesis', __('Design Settings', FACULTY_DOMAIN), __('Design Settings',FACULTY_DOMAIN), 'manage_options', 'design-settings', 'faculty_settings_admin') : null;
	
	add_action('load-'.$_faculty_settings_pagehook, 'faculty_settings_styles');
	add_action('load-'.$_faculty_settings_pagehook, 'faculty_settings_scripts');
	add_action('load-'.$_faculty_settings_pagehook, 'faculty_settings_boxes');
	add_filter('pre_update_option_'.FACULTY_SETTINGS_FIELD, 'faculty_save_settings',10,2);
        
}

/**
 * Validate submitted setting values and replace with defaults.
 * 
 * Checks if the value is empty, is an invalid color hex code or is a value
 * requiring a numerical answer but submitted value contained anything other
 * than 0-9.
 * @author Gary Jones
 * @param array $newvalue Values submitted from the design settings page.
 * @param array $oldvalue Unused
 * @return array
 * @since 1.0
 */
function faculty_save_settings($newvalue, $oldvalue) {
    $defaults = faculty_settings_defaults();
    foreach ($newvalue as $key => $value) {
        if ( '' == $value // Empty
            || (preg_match('/_color$/', $key) && 0 == preg_match('/^#(([a-fA-F0-9]{3}$)|([a-fA-F0-9]{6}$))/', $value)) // Invalid color code
            || ((strpos($key, '_size') || strpos($key, '_height') || strpos($key, '_margin') || strpos($key, '_padding') || strpos($key, '_radius') || strpos($key, '_width') || preg_match('/_border$/', $key))
                && !ctype_digit($value)) // Not a digit
         ) {
            $newvalue[$key] = $defaults[$key]; // Save default value instead.
         }
    }
    return $newvalue;
}

/**
 * Adds color picker style and admin.css
 *
 * @author Gary Jones
 * @since 1.0
 */
function faculty_settings_styles() {
        wp_enqueue_style('farbtastic');
        wp_enqueue_style('faculty-admin', get_stylesheet_directory_uri() . '/lib/css/admin.css', array(), faculty_get_version());
}

/**
 * Adds common WP functionality scripts, color picker script, and the
 * Prose script, with some variables passed in from PHP.
 *
 * @author StudioPress & Gary Jones
 * @global string $_faculty_settings_pagehook
 * @version 1.0
 */
function faculty_settings_scripts() {
        global $_faculty_settings_pagehook;
				wp_enqueue_script('common');
				wp_enqueue_script('wp-lists');
				wp_enqueue_script('postbox');
        wp_enqueue_script('farbtastic');
        wp_enqueue_script('faculty-admin', get_stylesheet_directory_uri() . '/lib/js/admin.js', array('farbtastic', 'jquery'), faculty_get_version(), true);
        $params = array(
            'pageHook'      => $_faculty_settings_pagehook,
            'firstTime'     => !is_array(get_user_option('closedpostboxes_'.$_faculty_settings_pagehook)), // Delete closedpostboxes_genesis_page_design-settings in usermeta table to test
            'toggleAll'     => __('Toggle All', FACULTY_DOMAIN),
            'warnUnsaved'   => __('The changes you made will be lost if you navigate away from this page.', FACULTY_DOMAIN),
            'warnReset'     => __('Are you sure you want to reset?', FACULTY_DOMAIN)
        );
        wp_localize_script('faculty-admin', 'faculty', $params);
}

/**
 * Tell WordPress that we want only 2 columns available for our meta-boxes.
 *
 * @author StudioPress
 * @global string $_faculty_settings_pagehook
 * @param array $columns WordPress array containing column settings for each page.
 * @param string $screen Name of the design settings page.
 * @return array
 */
add_filter('screen_layout_columns', 'faculty_settings_layout_columns', 10, 2);
function faculty_settings_layout_columns($columns, $screen) {
	global $_faculty_settings_pagehook;
	if ($screen == $_faculty_settings_pagehook) {
		// This page should have 3 column options
		$columns[$_faculty_settings_pagehook] = 2;
	}
	return $columns;
}

/**
 * This function is what actually gets output to the page. It handles the markup,
 * builds the form, fires do_meta_boxes().
 *
 * @author StudioPress
 * @global string $_faculty_settings_pagehook
 * @global integer $screen_layout_columns
 * @version 1.0
 */
function faculty_settings_admin() { 
global $_faculty_settings_pagehook, $screen_layout_columns;
if( $screen_layout_columns == 3 ) {
	$width = "width: 32.67%";
}
elseif( $screen_layout_columns == 2 ) {
	$width = "width: 49%;";
	$hide3 = " display: none;";
}
else {
	$width = "width: 99%;";
	$hide2 = $hide3 = " display: none;";
}
?>	
	<div id="design-settings" class="wrap genesis-metaboxes">
	<form method="post" action="options.php">
		
		<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
		<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
		<?php settings_fields(FACULTY_SETTINGS_FIELD); // important! ?>
		
		<?php screen_icon('themes'); ?>
		<h2 id="top-buttons">
		            <?php _e('Design Settings', FACULTY_DOMAIN); ?>
		            <input type="submit" class="button-primary" value="<?php _e('Save Settings', FACULTY_DOMAIN) ?>" />
		            <input type="submit" class="button-highlighted button-reset" name="<?php echo FACULTY_SETTINGS_FIELD; ?>[reset]" value="<?php _e('Reset Settings', FACULTY_DOMAIN); ?>" />
		        </h2>
		
		<div class="metabox-holder">
			<div class="postbox-container" style="<?php echo $width; ?>">
				<?php do_meta_boxes($_faculty_settings_pagehook, 'column1', null); ?>
			</div>
			<div class="postbox-container" style="<?php echo $width; ?>">
				<?php do_meta_boxes($_faculty_settings_pagehook, 'column2', null); ?>
			</div>
		</div>
		
		<div class="bottom-buttons">
			<input type="submit" class="button-primary" value="<?php _e('Save Settings', FACULTY_DOMAIN) ?>" />
			<input type="submit" class="button-highlighted button-reset" name="<?php echo FACULTY_SETTINGS_FIELD; ?>[reset]" value="<?php _e('Reset Settings', FACULTY_DOMAIN); ?>" />
		</div>
	</form>
	</div>
<?php
}


/**
 * Adds all the settings boxes to the design settings page.
 *
 * @author StudioPress
 * @global string $_faculty_settings_pagehook
 * @version 1.0
 */
function faculty_settings_boxes() {
	global $_faculty_settings_pagehook;
	
	add_meta_box('faculty-settings-global', __('Global Styles', FACULTY_DOMAIN), 'faculty_settings_global', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-global-links', __('Global Links', FACULTY_DOMAIN), 'faculty_settings_global_links', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-wrap', __('Wrap (content area)', FACULTY_DOMAIN), 'faculty_settings_wrap', $_faculty_settings_pagehook, 'column1');
		add_meta_box('faculty-settings-branding', __('Branding', FACULTY_DOMAIN), 'faculty_settings_branding', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-branding-wordmark', __('Branding Wordmark', FACULTY_DOMAIN), 'faculty_settings_branding_wordmark', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-branding-tagline', __('Faculty Information', FACULTY_DOMAIN), 'faculty_settings_branding_tagline', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-header', __('Header', FACULTY_DOMAIN), 'faculty_settings_header', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-header-title', __('Header Title', FACULTY_DOMAIN), 'faculty_settings_header_title', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-header-tagline', __('Header Tagline', FACULTY_DOMAIN), 'faculty_settings_header_tagline', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-primary-nav', __('Primary Navigation', FACULTY_DOMAIN), 'faculty_settings_primary_nav', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-secondary-nav', __('Secondary Navigation', FACULTY_DOMAIN), 'faculty_settings_secondary_nav', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-breadcrumb', __('Breadcrumb Navigation', FACULTY_DOMAIN), 'faculty_settings_breadcrumb', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-post-info', __('Post Info (before post)', FACULTY_DOMAIN), 'faculty_settings_post_info', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-post-meta', __('Post Meta (after post)', FACULTY_DOMAIN), 'faculty_settings_post_meta', $_faculty_settings_pagehook, 'column1');
	add_meta_box('faculty-settings-blockquotes', __('Blockquotes', FACULTY_DOMAIN), 'faculty_settings_blockquotes', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-notice', __('Notice Box', FACULTY_DOMAIN), 'faculty_settings_notice_box', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-headline', __('Headlines', FACULTY_DOMAIN), 'faculty_settings_headline', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-headline-links', __('Post Title Links', FACULTY_DOMAIN), 'faculty_settings_headline_links', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-sidebar-headline', __('Sidebar Widget Headline', FACULTY_DOMAIN), 'faculty_settings_sidebar_headline', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-footer-widget', __('Footer Widget Area', FACULTY_DOMAIN), 'faculty_settings_footer_widget', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-footer-widgets-widget', __('Footer Widgets Background', FACULTY_DOMAIN), 'faculty_settings_footer_widgets_widget', $_faculty_settings_pagehook, 'column2');
    add_meta_box('faculty-settings-footer-headline', __('Footer Widget Headline', FACULTY_DOMAIN), 'faculty_settings_footer_headline', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-footer-widget-links', __('Footer Widget Links', FACULTY_DOMAIN), 'faculty_settings_footer_widget_links', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-footer', __('Footer', FACULTY_DOMAIN), 'faculty_settings_footer', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-footer-links', __('Footer Links', FACULTY_DOMAIN), 'faculty_settings_footer_links', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-input', __('Input Boxes', FACULTY_DOMAIN), 'faculty_settings_input_box', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-buttons', __('Submit Buttons', FACULTY_DOMAIN), 'faculty_settings_buttons', $_faculty_settings_pagehook, 'column2');
	add_meta_box('faculty-settings-general', __('General Settings', FACULTY_DOMAIN), 'faculty_settings_general', $_faculty_settings_pagehook, 'column2');
}

/**
 * This next section defines functions that contain the content of the "boxes" that will be
 * output by default on the "Design Settings" page. There's a bunch of them.
 */

/**
 * Add settings to the Global Styles box. Does faculty_settings_global action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_global() {
    faculty_setting_line(sprintf(__('Start by customizing your <a href="%s">background</a>.', FACULTY_DOMAIN), admin_url('themes.php?page=custom-background')));
    faculty_setting_line(faculty_add_color_setting('body_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('body_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_size_setting('body_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('body_line_height', __('Line Height', FACULTY_DOMAIN)));
    do_action('faculty_settings_global');
    faculty_setting_line(faculty_add_note(__('All fonts listed are considered web-safe', FACULTY_DOMAIN)));
}

/**
 * Add settings to the Global Links box. Does faculty_settings_global_links action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_global_links() {
    faculty_setting_line(faculty_add_color_setting('body_link_color', __('Link Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('body_link_decoration', __('Link Decoration', FACULTY_DOMAIN), 'decoration'));
    faculty_setting_line(faculty_add_color_setting('body_link_hover', __('Link Hover Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('body_link_hover_decoration', __('Link Hover Decoration', FACULTY_DOMAIN), 'decoration'));
    do_action('faculty_settings_global_links');
}

/**
 * Add settings to the Wrap box. Does faculty_settings_wrap action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_wrap() { 
    faculty_setting_line(faculty_add_background_color_setting('wrap_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('wrap_margin_top', __('Top Margin', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('wrap_margin_bottom', __('Bottom Margin', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('wrap_padding', __('Padding', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_border_setting('wrap_border', __('Border', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_text_setting('wrap_corner_radius', __('Rounded Corner Radius', FACULTY_DOMAIN)));
		faculty_setting_line(faculty_add_note(__('Sample for corner radius:', FACULTY_DOMAIN) . ' <code>1em 3em 1em 3em</code>'));
    faculty_setting_line(faculty_add_text_setting('wrap_background_shadow', __('Background Shadow', FACULTY_DOMAIN)));
    do_action('faculty_settings_wrap');
    faculty_setting_line(faculty_add_note(__('Sample for background shadow:', FACULTY_DOMAIN) . ' <code>0 1px 3px #333333</code>'));
}

/**
 * Add settings to the Branding box. Does faculty_settings_branding action hook.
 * 
 * @author Jon Breitenbucher
 * @version 1.0
 */
function faculty_settings_branding() { 
    faculty_setting_line(faculty_add_background_color_setting('branding_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('branding_font_color', __('Font Color', FACULTY_DOMAIN)));
faculty_setting_line(faculty_add_size_setting('branding_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_border_setting('branding_border', __('Border', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_text_setting('branding_corner_radius', __('Rounded Corner Radius', FACULTY_DOMAIN)));
		faculty_setting_line(faculty_add_note(__('Sample for corner radius:', FACULTY_DOMAIN) . ' <code>1em 3em 0em 0em</code>'));
    do_action('faculty_settings_branding');
}

/**
 * Add settings to the Branding Wordmark box. Does faculty_settings_header_title action hook.
 * 
 * @author Jon Breitenbucher
 * @version 1.0
 */
function faculty_settings_branding_wordmark() {
    faculty_setting_line(faculty_add_size_setting('branding_wordmark_top_padding', __('Top Padding', FACULTY_DOMAIN)));
 faculty_setting_line(faculty_add_size_setting('branding_wordmark_left_padding', __('Left Padding', FACULTY_DOMAIN)));
  faculty_setting_line(faculty_add_color_setting('branding_wordmark_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('branding_wordmark_font_size', __('Font Size', FACULTY_DOMAIN)));
faculty_setting_line(faculty_add_select_setting('branding_wordmark_link_decoration', __('Link Decoration', FACULTY_DOMAIN), 'decoration'));
    do_action('faculty_settings_branding_wordmark');
}

/**
 * Add settings to the Branding Tagline box. Does faculty_settings_header_title action hook.
 * 
 * @author Jon Breitenbucher
 * @version 1.0
 */
function faculty_settings_branding_tagline() {
    faculty_setting_line(faculty_add_size_setting('branding_tagline_top_padding', __('Top Padding', FACULTY_DOMAIN)));
 faculty_setting_line(faculty_add_size_setting('branding_tagline_right_padding', __('Right Padding', FACULTY_DOMAIN)));
  faculty_setting_line(faculty_add_color_setting('branding_tagline_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('branding_tagline_font_size', __('Font Size', FACULTY_DOMAIN)));
    do_action('faculty_settings_branding_tagline');
}

/**
 * Add settings to the Header box. Does faculty_settings_header action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_header() {
    faculty_setting_line(faculty_add_size_setting('header_image_height', __('Header Height', FACULTY_DOMAIN), 2));
    faculty_setting_line(faculty_add_size_setting('header_title_area_width', __('Header Title Area Width', FACULTY_DOMAIN), 2));
    faculty_setting_line(faculty_add_size_setting('header_widget_area_width', __('Header Widget Area Width', FACULTY_DOMAIN), 2));
    faculty_setting_line(faculty_add_background_color_setting('header_background_color', __('Background', FACULTY_DOMAIN)));
    do_action('faculty_settings_header');
    faculty_setting_line(faculty_add_note(sprintf(__('Save your settings before customizing your <a href="%s">header</a>.', FACULTY_DOMAIN), admin_url('themes.php?page=custom-header'))));
}

/**
 * Add settings to the Header Title box. Does faculty_settings_header_title action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_header_title() {
    faculty_setting_line(faculty_add_size_setting('header_top_padding', __('Top Padding', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('header_left_padding', __('Left Padding', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('header_title_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('header_title_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_size_setting('header_title_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('header_title_line_height', __('Line Height', FACULTY_DOMAIN)));
    do_action('faculty_settings_header_title');
}

/**
 * Add settings to the Header Tagline box. Does faculty_settings_tagline action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_header_tagline() {
    faculty_setting_line(faculty_add_size_setting('header_tagline_top_padding', __('Top Padding', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('header_tagline_left_padding', __('Left Padding', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('header_tagline_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('header_tagline_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_size_setting('header_tagline_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('header_tagline_font_style', __('Font', FACULTY_DOMAIN), 'style'));
    do_action('faculty_settings_tagline');
}

/**
 * Add settings to the Primary Navigation box. Does faculty_settings_primary_nav action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_primary_nav() { 
    faculty_setting_line(faculty_add_background_color_setting('primary_nav_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('primary_nav_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_size_setting('primary_nav_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_border_setting('primary_nav_border', __('Border', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_border_setting('primary_nav_inner_border', __('Inner Border', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('primary_nav_link_color', __('Link Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_background_color_setting('primary_nav_link_background', __('Link Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('primary_nav_link_decoration', __('Link Decoration', FACULTY_DOMAIN), 'decoration'));
    faculty_setting_line(faculty_add_color_setting('primary_nav_link_hover', __('Current/Link Hover', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_background_color_setting('primary_nav_link_hover_background', __('Current/Link Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('primary_nav_link_hover_decoration', __('Link Hover Decoration', FACULTY_DOMAIN), 'decoration'));
    do_action('faculty_settings_primary_nav');
}

/**
 * Add settings to the Secondary Navigation box. Does faculty_settings_secondary_nav action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_secondary_nav() { 
    faculty_setting_line(faculty_add_background_color_setting('secondary_nav_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('secondary_nav_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_size_setting('secondary_nav_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_border_setting('secondary_nav_border', __('Border', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_border_setting('secondary_nav_inner_border', __('Inner Border', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('secondary_nav_link_color', __('Link Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_background_color_setting('secondary_nav_link_background', __('Link Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('secondary_nav_link_decoration', __('Link Decoration', FACULTY_DOMAIN), 'decoration'));
    faculty_setting_line(faculty_add_color_setting('secondary_nav_link_hover', __('Current/Link Hover', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_background_color_setting('secondary_nav_link_hover_background', __('Current/Link Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('secondary_nav_link_hover_decoration', __('Link Hover Decoration', FACULTY_DOMAIN), 'decoration'));
    do_action('faculty_settings_secondary_nav');
}

/**
 * Add settings to the Breadcrumb Navigation box. Does faculty_settings_breadcrumb action hook.
 * 
 * @author Brian Gardner
 * @since 0.9.7.2
 * @version 1.0
 */
function faculty_settings_breadcrumb() { 
    faculty_setting_line(faculty_add_color_setting('breadcrumb_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('breadcrumb_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('breadcrumb_text_transform', __('Text Transform', FACULTY_DOMAIN), 'transform'));
    faculty_setting_line(faculty_add_border_setting('breadcrumb_border', __('Bottom Border', FACULTY_DOMAIN)));
    do_action('faculty_settings_breadcrumb');
}

/**
 * Add settings to the Post Info box. Does faculty_settings_post_info action hook.
 * 
 * @author Brian Gardner
 * @since 0.9.7.2
 * @version 1.0
 */
function faculty_settings_post_info() {
    faculty_setting_line(faculty_add_background_color_setting('post_info_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('post_info_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('post_info_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('post_info_text_transform', __('Text Transform', FACULTY_DOMAIN), 'transform'));
    do_action('faculty_settings_post_info');
}

/**
 * Add settings to the Post Meta box. Does faculty_settings_post_meta action hook.
 * 
 * @author Brian Gardner
 * @since 0.9.7.2
 * @version 1.0
 */
function faculty_settings_post_meta() {
    faculty_setting_line(faculty_add_background_color_setting('post_meta_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('post_meta_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('post_meta_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('post_meta_text_transform', __('Text Transform', FACULTY_DOMAIN), 'transform'));
    do_action('faculty_settings_post_meta');
}

/**
 * Add settings to the Blockquotes box. Does faculty_settings_blockquotes action hook.
 * 
 * @author Brian Gardner
 * @version 1.0
 */
function faculty_settings_blockquotes() { 
    faculty_setting_line(faculty_add_background_color_setting('blockquotes_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('blockquotes_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('blockquotes_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_select_setting('blockquotes_font_style', __('Font Style', FACULTY_DOMAIN), 'style'));
    faculty_setting_line(faculty_add_border_setting('blockquotes_border', __('Border', FACULTY_DOMAIN)));
    do_action('faculty_settings_blockquotes');
}

/**
 * Add settings to the Notice box. Does faculty_settings_notices_box action hook.
 * 
 * @author Brian Gardner
 * @version 1.0
 */
function faculty_settings_notice_box() { 
    faculty_setting_line(faculty_add_background_color_setting('notice_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('notice_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('notice_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_select_setting('notice_font_style', __('Font Style', FACULTY_DOMAIN), 'style'));
    faculty_setting_line(faculty_add_border_setting('notice_border', __('Border', FACULTY_DOMAIN)));
    do_action('faculty_settings_notice_box');
}

/**
 * Add settings to the Headlines box. Does faculty_settings_headline action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_headline() { 
    faculty_setting_line(faculty_add_select_setting('headline_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_select_setting('headline_font_style', __('Font Style', FACULTY_DOMAIN), 'style'));
    faculty_setting_line(faculty_add_select_setting('headline_font_weight', __('Font Weight', FACULTY_DOMAIN), 'weight'));
    faculty_setting_line(faculty_add_select_setting('headline_text_transform', __('Text Transform', FACULTY_DOMAIN), 'transform'));
    faculty_setting_line(array(faculty_add_size_setting('h1_font_size', __('H1 Font Size', FACULTY_DOMAIN)), faculty_add_color_setting('h1_font_color', __('Color', FACULTY_DOMAIN))));
    faculty_setting_line(array(faculty_add_size_setting('h2_font_size', __('H2 Font Size', FACULTY_DOMAIN)), faculty_add_color_setting('h2_font_color', __('Color', FACULTY_DOMAIN))));
    faculty_setting_line(array(faculty_add_size_setting('h3_font_size', __('H3 Font Size', FACULTY_DOMAIN)), faculty_add_color_setting('h3_font_color', __('Color', FACULTY_DOMAIN))));
    faculty_setting_line(array(faculty_add_size_setting('h4_font_size', __('H4 Font Size', FACULTY_DOMAIN)), faculty_add_color_setting('h4_font_color', __('Color', FACULTY_DOMAIN))));
    faculty_setting_line(array(faculty_add_size_setting('h5_font_size', __('H5 Font Size', FACULTY_DOMAIN)), faculty_add_color_setting('h5_font_color', __('Color', FACULTY_DOMAIN))));
    faculty_setting_line(array(faculty_add_size_setting('h6_font_size', __('H6 Font Size', FACULTY_DOMAIN)), faculty_add_color_setting('h6_font_color', __('Color', FACULTY_DOMAIN))));
    do_action('faculty_settings_headline');
}

/**
 * Add settings to the Headline Links box. Does faculty_settings_headline_links action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_headline_links() { 
    faculty_setting_line(faculty_add_color_setting('h2_link_color', __('H2 Link Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('h2_link_decoration', __('H2 Link Decoration', FACULTY_DOMAIN), 'decoration'));
    faculty_setting_line(faculty_add_color_setting('h2_link_hover', __('H2 Link Hover', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('h2_link_hover_decoration', __('H2 Link Hover Decoration', FACULTY_DOMAIN), 'decoration'));
    do_action('faculty_settings_headline_links');
}

/**
 * Add settings to the Sidebar Widget Headline box. Does faculty_settings_sidebar_headline action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_sidebar_headline() { 
    faculty_setting_line(faculty_add_color_setting('sidebar_headline_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('sidebar_headline_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_size_setting('sidebar_headline_font_size', __('H4 Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('sidebar_headline_font_style', __('Font Style', FACULTY_DOMAIN), 'style'));
    faculty_setting_line(faculty_add_select_setting('sidebar_headline_font_weight', __('Font Weight', FACULTY_DOMAIN), 'weight'));
    faculty_setting_line(faculty_add_select_setting('sidebar_headline_text_transform', __('Text Transform', FACULTY_DOMAIN), 'transform'));
    faculty_setting_line(faculty_add_border_setting('sidebar_headline_border', __('Bottom Border', FACULTY_DOMAIN)));
    do_action('faculty_settings_sidebar_headline');
}

/**
 * Add settings to the Footer Widget Area box. Does faculty_settings_footer_widget action hook.
 * 
 * @author Brian Gardner
 * @version 1.0
 */
function faculty_settings_footer_widget() { 
    faculty_setting_line(faculty_add_background_color_setting('footer_widget_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_border_setting('footer_widget_border', __('Border', FACULTY_DOMAIN)));
    do_action('faculty_settings_footer_widget');
}

/**
 * Add settings to the Footer Widgets Background box. Does faculty_settings_footer_widgets_widget action hook.
 * 
 * @author Jon Breitenbucher
 * @version 1.0
 */
function faculty_settings_footer_widgets_widget() { 
    faculty_setting_line(faculty_add_background_color_setting('footer_widgets_widget_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_border_setting('footer_widgets_widget_border', __('Border', FACULTY_DOMAIN)));
		faculty_setting_line(faculty_add_text_setting('footer_widgets_widget_corner_radius', __('Rounded Corner Radius', FACULTY_DOMAIN)));
		faculty_setting_line(faculty_add_note(__('Sample for corner radius:', FACULTY_DOMAIN) . ' <code>1em</code>'));
		faculty_setting_line(faculty_add_text_setting('footer_widgets_widget_background_shadow', __('Background Shadow', FACULTY_DOMAIN)));
		faculty_setting_line(faculty_add_note(__('Sample for background shadow:', FACULTY_DOMAIN) . ' <code>0 1px 3px #333333</code>'));
    do_action('faculty_settings_footer_widgets_widget');
}

/**
 * Add settings to the Footer Widget Headline box. Does faculty_settings_footer_headline action hook.
 * 
 * @author Brian Gardner
 * @since 0.9.7.2
 * @version 1.0
 */
function faculty_settings_footer_headline() { 
    faculty_setting_line(faculty_add_color_setting('footer_headline_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('footer_headline_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_size_setting('footer_headline_font_size', __('H4 Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('footer_headline_font_style', __('Font Style', FACULTY_DOMAIN), 'style'));
    faculty_setting_line(faculty_add_select_setting('footer_headline_font_weight', __('Font Weight', FACULTY_DOMAIN), 'weight'));
    faculty_setting_line(faculty_add_select_setting('footer_headline_text_transform', __('Text Transform', FACULTY_DOMAIN), 'transform'));
    faculty_setting_line(faculty_add_border_setting('footer_headline_border', __('Bottom Border', FACULTY_DOMAIN)));
    do_action('faculty_settings_footer_headline');
}

/**
 * Add settings to the Footer Widget Links box. Does faculty_settings_footer_widget_links action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_footer_widget_links() {
    faculty_setting_line(faculty_add_color_setting('footer_widget_link_color', __('Link Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('footer_widget_link_decoration', __('Link Decoration', FACULTY_DOMAIN), 'decoration'));
    faculty_setting_line(faculty_add_color_setting('footer_widget_link_hover', __('Link Hover Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('footer_widget_link_hover_decoration', __('Link Hover Decoration', FACULTY_DOMAIN), 'decoration'));
    do_action('faculty_settings_footer_widget_links');
}

/**
 * Add settings to the Footer box. Does faculty_settings_footer action hook.
 * 
 * @author Gary Jones
 * @version 1.0
 */
function faculty_settings_footer() {
	faculty_setting_line(faculty_add_background_color_setting('footer_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('footer_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_size_setting('footer_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('footer_font_weight', __('Font Weight', FACULTY_DOMAIN), 'weight'));
    faculty_setting_line(faculty_add_select_setting('footer_text_transform', __('Text Transform', FACULTY_DOMAIN), 'transform'));
		faculty_setting_line(faculty_add_border_setting('footer_border', __('Border', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_text_setting('footer_corner_radius', __('Rounded Corner Radius', FACULTY_DOMAIN)));
		faculty_setting_line(faculty_add_note(__('Sample for corner radius:', FACULTY_DOMAIN) . ' <code>0em 0em 1em 3em</code>'));
    do_action('faculty_settings_footer');
}

/**
 * Add settings to the Footer Links box. Does faculty_settings_footer_links action hook.
 * 
 * @author Brian Gardner
 * @version 1.0
 */
function faculty_settings_footer_links() {
    faculty_setting_line(faculty_add_color_setting('footer_link_color', __('Link Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('footer_link_decoration', __('Link Decoration', FACULTY_DOMAIN), 'decoration'));
    faculty_setting_line(faculty_add_color_setting('footer_link_hover', __('Link Hover Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('footer_link_hover_decoration', __('Link Hover Decoration', FACULTY_DOMAIN), 'decoration'));
    do_action('faculty_settings_footer_links');
}

/**
 * Add settings to the Input box. Does faculty_settings_input_box action hook.
 * 
 * @author Brian Gardner
 * @version 1.0
 */
function faculty_settings_input_box() { 
    faculty_setting_line(faculty_add_background_color_setting('input_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('input_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('input_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_select_setting('input_font_style', __('Font Style', FACULTY_DOMAIN), 'style'));
    faculty_setting_line(faculty_add_border_setting('input_border', __('Border', FACULTY_DOMAIN)));
    do_action('faculty_settings_input_box');
}

/**
 * Add settings to the Submit Buttons box. Does faculty_settings_buttons action hook.
 * 
 * @author Brian Gardner
 * @since 0.9.7.2
 * @version 1.0
 */
function faculty_settings_buttons() { 
    faculty_setting_line(faculty_add_background_color_setting('button_background_color', __('Background', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_background_color_setting('button_background_hover_color', __('Background Hover', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_color_setting('button_font_color', __('Font Color', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('button_font_family', __('Font', FACULTY_DOMAIN), 'family'));
    faculty_setting_line(faculty_add_size_setting('button_font_size', __('Font Size', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_select_setting('button_text_transform', __('Text Transform', FACULTY_DOMAIN), 'transform'));
    do_action('faculty_settings_buttons');
}

/**
 * Add settings to the General Settings box. Does faculty_settings_general action hook.
 * 
 * @author Gary Jones
 * @since 0.9.6
 * @version 1.0
 */
function faculty_settings_general() { 
    global $theme, $blog_id;
    faculty_setting_line(faculty_add_checkbox_setting('minify_css', __('Minify CSS?', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_note(__('Check this box for a live site, uncheck for testing.', FACULTY_DOMAIN)));
    faculty_setting_line(faculty_add_note(sprintf(__('Use the Editor to <a href="%s">add/edit custom CSS</a>.', FACULTY_DOMAIN), admin_url('theme-editor.php?' . faculty_get_custom_stylesheet_editor_querystring()))));
    echo '<hr />';
    faculty_setting_line('<a class="button" href="' . wp_nonce_url(admin_url('admin.php?page=design-settings&amp;faculty=export'), 'faculty-export') . '">'.__('Export Prose Settings', FACULTY_DOMAIN) . '</a>');
    faculty_setting_line('</form><form method="post" enctype="multipart/form-data" action="">' . wp_nonce_field('faculty-import', '_wpnonce-faculty-import') . faculty_add_label('import-file', __('Import Prose Settings File', FACULTY_DOMAIN)) . '<br /><input type="hidden" name="faculty" value="import" /><input type="file" class="text_input" name="file" id="import-file" /><input class="button" type="submit" value="' . esc_attr(__('Upload', FACULTY_DOMAIN)) . '" /></form>');
    do_action('faculty_settings_general');
}