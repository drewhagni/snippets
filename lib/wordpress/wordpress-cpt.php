<?php

// Add custom post type for Case Studies 
add_action( 'init', 'bc_case_studies_cpt' );
function bc_case_studies_cpt() {
	register_post_type( 'case-studies',
		array(
			'labels' 			=> array(
				'name' 			=> __( 'Case Studies' ),
				'singular_name' => __( 'Case Study' )
			),
		'public' 				=> true,
		'has_archive' 			=> false,
		'rewrite'				=> array('slug' => 'case-study'),
		'menu_icon' 			=> 'dashicons-category',
		'exclude_from_search' 	=> true,
		'supports' 				=> array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes' ), 
		'menu_position' 		=> 5,
		'taxonomies'			=> array(  'category', /*'category' => 'case-loc'*/ )
		)
	);
}


// Remove Categories Meta Box
add_action('admin_menu', 'remove_boxes', 20);
function remove_boxes() {
	remove_meta_box('categorydiv', 'case-studies', 'side');
}