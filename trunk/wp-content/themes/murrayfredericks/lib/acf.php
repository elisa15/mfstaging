<?php 
//** Set save location of ACF **/
add_filter( 'acf/settings/save_json', 'acf_json_save' );

function acf_json_save( $path ) {
  $path = get_stylesheet_directory( ) . '/lib/acf_json';
  return $path;
}

add_filter( 'acf/settings/load_json', 'acf_json_load' );

function acf_json_load( $paths ) {
  unset( $paths[0] );

  $paths[ ] = get_stylesheet_directory( ) . '/lib/acf_json';
  return $paths;
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

function my_acf_add_local_field_groups() {
	acf_add_local_field_group(array(
		'key' => 'group_59434b5abb716',
		'title' => 'Theme Settings',
		'fields' => array (
			array (
				'key' => 'field_59434b63d96ea',
				'label' => 'Google Analytics Key',
				'name' => 'google_analytics_key',
				'type' => 'text',
			)
		),
		'location' => array (
			array (
				array (
 					'param'		=>	'options_page',
                	'operator'	=> 	'==',
                	'value'		=> 	'acf-options-footer'
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active'	=> 1,

	));
}

add_action('acf/init', 'my_acf_add_local_field_groups');