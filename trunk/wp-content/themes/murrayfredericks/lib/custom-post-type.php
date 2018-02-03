<?php

function team_post_types() {
	$labels = array(
		'name'               => 'Teams',
		'singular_name'      => 'Team',
		'menu_name'          => 'Team',
		'name_admin_bar'     => 'Team',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Team',
		'new_item'           => 'New Team',
		'edit_item'          => 'Edit Team',
		'view_item'          => 'View Teams',
		'all_items'          => 'All Teams',
		'search_items'       => 'Search Teams',
		'parent_item_colon'  => 'Parent Teams:',
		'not_found'          => 'No teams found.',
		'not_found_in_trash' => 'No teams found in Trash.'
	);

	$args = array( 
		'public'      => true, 
		'labels'      => $labels,
		'description' => 'Team will be published using this post type',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
	);
    	register_post_type( 'team', $args );
}
add_action( 'init', 'team_post_types' );

function work_post_types() {
	$labels = array(
		'name'               => 'Works',
		'singular_name'      => 'Work',
		'menu_name'          => 'Work',
		'name_admin_bar'     => 'Work',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Work',
		'new_item'           => 'New Work',
		'edit_item'          => 'Edit Work',
		'view_item'          => 'View Work',
		'all_items'          => 'All Work',
		'search_items'       => 'Search Work',
		'parent_item_colon'  => 'Parent Work:',
		'not_found'          => 'No work found.',
		'not_found_in_trash' => 'No work found in Trash.'
	);

	$args = array( 
		'public'      => true, 
		'labels'      => $labels,
		'description' => 'Work will be published using this post type',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
	);
    	register_post_type( 'work', $args );
}
add_action( 'init', 'work_post_types' );

function services_post_types() {
	$labels = array(
		'name'               => 'Services',
		'singular_name'      => 'Service',
		'menu_name'          => 'Services',
		'name_admin_bar'     => 'Services',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Service',
		'new_item'           => 'New Service',
		'edit_item'          => 'Edit Service',
		'view_item'          => 'View Service',
		'all_items'          => 'All Services',
		'search_items'       => 'Search Service',
		'parent_item_colon'  => 'Parent Service:',
		'not_found'          => 'No Service found.',
		'not_found_in_trash' => 'No Service found in Trash.'
	);

	$args = array( 
		'public'      => true, 
		'labels'      => $labels,
		'description' => 'Service will be published using this post type',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
	);
    	register_post_type( 'services', $args );
}
add_action( 'init', 'services_post_types' );

function testimonial_post_types() {
	$labels = array(
		'name'               => 'Testimonials',
		'singular_name'      => 'Testimonial',
		'menu_name'          => 'Testimonials',
		'name_admin_bar'     => 'Testimonial',
		'add_new'            => 'Add Testimonial',
		'add_new_item'       => 'Add New Testimonial',
		'new_item'           => 'New Testimonial',
		'edit_item'          => 'Edit Testimonial',
		'view_item'          => 'View Testimonial',
		'all_items'          => 'All Testimonial',
		'search_items'       => 'Search Testimonial',
		'parent_item_colon'  => 'Parent Testimonial:',
		'not_found'          => 'No Testimonial found.',
		'not_found_in_trash' => 'No Testimonial found in Trash.'
	);

	$args = array( 
		'public'      => true, 
		'labels'      => $labels,
		'description' => 'Testimonial will be published using this post type',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
	);
    	register_post_type( 'testimonial', $args );
}
add_action( 'init', 'testimonial_post_types' );

function industry_expertise_post_types() {
	$labels = array(
		'name'               => 'Industry Expertise',
		'singular_name'      => 'Industry Expertise',
		'menu_name'          => 'Industry Expertise',
		'name_admin_bar'     => 'Industry Expertise',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Industry Expertise',
		'new_item'           => 'New Industry Expertise',
		'edit_item'          => 'Edit Industry Expertise',
		'view_item'          => 'View Industry Expertise',
		'all_items'          => 'All Industry Expertise',
		'search_items'       => 'Search Industry Expertise',
		'parent_item_colon'  => 'Parent Industry Expertise:',
		'not_found'          => 'No Industry Expertise found.',
		'not_found_in_trash' => 'No Industry Expertise found in Trash.'
	);

	$args = array( 
		'public'      => true, 
		'labels'      => $labels,
		'description' => 'Industry Expertise will be published using this post type',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
	);
    	register_post_type( 'Industry Expertise', $args );
}
add_action( 'init', 'industry_expertise_post_types' );


?>