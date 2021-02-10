<?php 
	
// Make Gravity Forms available to Editors
add_action('admin_init','bc_gravity_capabilities');
function bc_gravity_capabilities(){
	$role = get_role('editor');
	$role->add_cap('gform_full_access');
}

// Make Gravity Forms Entries available to Authors
add_action('admin_init','bc_gravity_author_capabilities');
function bc_gravity_author_capabilities(){
	$role = get_role('author');
	$role->add_cap('gravityforms_view_entries');
}