<?php
		
// Add custom post type for Products 
add_action( 'init', 'bc_products_cpt' );
function bc_products_cpt() {
	register_post_type( 'products',
		array(
			'labels' 			=> array(
				'name' 			=> __( 'Products' ),
				'singular_name' => __( 'Product' )
			),
		'public' 				=> true,
		'has_archive' 			=> false,
		'rewrite'				=> array('slug' => 'product'),
		'menu_icon' 			=> 'dashicons-tag',
		'exclude_from_search' 	=> false,
		'supports' 				=> array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes' ), 
		'menu_position' 		=> 5,
		)
	);
}
/*
//* Create Locations Taxonomy for Case Studies
add_action( 'init', 'bc_case_studies_location' );

function bc_case_studies_location() {
	$labels = array(
		'name' => __( 'Locations' ),
		'singular_name' => __( 'Location' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_quick_edit' => true
	);
	register_taxonomy( 'case-loc', 'case-studies', $args );
}
*/

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