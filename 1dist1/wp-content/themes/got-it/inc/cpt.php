<?php
// Register Custom Post Type
add_action('init', 'custom_post_type', 0);

function custom_post_type() {
    $team_labels = array(
        'name' => 'Team',
        'singular_name' => 'Team',
        'menu_name' => 'Team',
        'all_items' => 'All Members',
        'view_item' => 'View Member',
        'add_new_item' => 'Add Member',
        'add_new' => 'Add Member',
        'edit_item' => 'Edit',
        'update_item' => 'Update',
        'search_items' => 'Search'
    );
		$team_args = array(
        'labels' => $team_labels,
        'supports' => array('title','thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array(
            'with_front' => true
        )
    );
    register_post_type('team', $team_args);

		$services_labels = array(
			'name' => 'Services',
			'singular_name' => 'Services',
			'menu_name' => 'Services',
			'all_items' => 'All Services',
			'view_item' => 'View Service',
			'add_new_item' => 'Add Service',
			'add_new' => 'Add Service',
			'edit_item' => 'Edit',
			'update_item' => 'Update',
			'search_items' => 'Search'
		);
		$services_args = array(
			'labels' => $services_labels,
			'supports' => array('title','thumbnail', 'editor'),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'can_export' => true,
			'has_archive' => false,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'capability_type' => 'post',
			'rewrite' => array(
				'with_front' => true
			)
		);
		register_post_type('services', $services_args);

	$project_labels = array(
		'name' => 'Projects',
		'singular_name' => 'Projects',
		'menu_name' => 'Projects',
		'all_items' => 'All Projects',
		'view_item' => 'View Project',
		'add_new_item' => 'Add Project',
		'add_new' => 'Add Project',
		'edit_item' => 'Edit',
		'update_item' => 'Update',
		'search_items' => 'Search'
	);
	$project_args = array(
		'labels' => $project_labels,
		'supports' => array('title','thumbnail'),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'can_export' => true,
		'has_archive' => false,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'rewrite' => array(
			'with_front' => true
		)
	);
	register_post_type('project', $project_args);

}
