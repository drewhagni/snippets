<?php
	
// Modifications to Genesis for this Child Theme

// Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// Remove the copyright footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Disable the superfish script
add_action( 'wp_enqueue_scripts', 'sp_disable_superfish' );
function sp_disable_superfish() {
	wp_deregister_script( 'superfish' );
	wp_deregister_script( 'superfish-args' );
}

// Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
//	'header',
//	'menu-primary',
//	'menu-secondary',
//	'site-inner',
	'footer-widgets',
	'footer'
) );

// Remove secondary nav and add all custom secondary header elements
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header', 'bc_secondary_header_area' );
function bc_secondary_header_area() {
	include_once get_stylesheet_directory() . '/assets/template-parts/secondary-header.php';
}

// Remove default header & primary nav and add all custom primary header elements
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'bc_primary_header_area' );
function bc_primary_header_area() {
	include_once get_stylesheet_directory() . '/assets/template-parts/primary-header.php';
}

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

// Unregister layout settings
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove Genesis Layout Settings
remove_theme_support( 'genesis-inpost-layouts' );

// Remove Genesis SEO Settings menu link
remove_theme_support( 'genesis-seo-settings-menu' );

// Remove Genesis in-post SEO Settings
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

// Remove the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove parent page templates
add_filter( 'theme_page_templates', 'bc_remove_genesis_page_templates' );
function bc_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}

// Remove scripts metabox from posts/pages
add_action( 'admin_menu' , 'remove_genesis_page_scripts_box' );
function remove_genesis_page_scripts_box() {
	remove_meta_box( 'genesis_inpost_scripts_box', array('post', 'page'), 'normal' ); 
}

//* Customize the next page link
add_filter ( 'genesis_next_link_text' , 'bc_next_page_link' );
function bc_next_page_link ( $text ) {
    return '<span class="mobile-hide">Next</span> <i class="fa fa-angle-right" aria-hidden="true"></i>';
}

//* Customize the previous page link
add_filter ( 'genesis_prev_link_text' , 'bc_prev_page_link' );
function bc_prev_page_link ( $text ) {
    return '<i class="fa fa-angle-left" aria-hidden="true"></i> <span class="mobile-hide">Previous</span>';
}