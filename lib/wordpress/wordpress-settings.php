<?php
	
// Add titles to images (for SEO)
add_filter( 'wp_get_attachment_image_attributes','bc_add_img_title', 10, 2 );
function bc_add_img_title( $attr, $attachment = null ) {
	$attr['title'] = trim( strip_tags( $attachment->post_title ) );
	return $attr;
}

// Customize read more link
add_filter('excerpt_more', 'get_read_more_link');
function get_read_more_link() {
   return '...';
}

// Customize excerpt length
add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_length($length) {
	return 50; // Or whatever you want the length to be.
}

// Allow shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

/*
add_filter( 'admin_post_thumbnail_html', 'custom_admin_post_thumbnail_html' );
function custom_admin_post_thumbnail_html( $content ) {
    return $content = str_replace( __( 'Set featured image' ), __( 'Set default image' ), $content); 
}


// 1
add_filter( 'admin_post_thumbnail_html', 'custom_admin_post_thumbnail_html' );
function custom_admin_post_thumbnail_html( $content ) {
	return $content = str_replace( __( 'Set featured image' ), __( 'Set featured image (315w x 190h)' ), $content);
}

// 2
add_filter(  'gettext',  'change_featuredimage_txt'  );
add_filter(  'ngettext',  'change_featuredimage_txt'  );
function change_featuredimage_txt( $translated ) {
	$translated = str_ireplace(  'Featured Image',  'Featured image (315w x 190h)',  $translated );
	return $translated;
}
*/

//* Add New Image Sizes
add_image_size( 'profile', 500, 500, true );