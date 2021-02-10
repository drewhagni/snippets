<?php
// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Test

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Example' );
define( 'CHILD_THEME_URL', 'http://example.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );

/* Load Add-ons for this child theme
---------------------------------------------------------------------------------------------------- */

// Required Add-ons
include_once( get_stylesheet_directory() . '/lib/genesis/genesis-settings.php' );
include_once( get_stylesheet_directory() . '/lib/gravity-forms/gravity-forms-settings.php' );
include_once( get_stylesheet_directory() . '/lib/wordpress/wordpress-settings.php' );
include_once( get_stylesheet_directory() . '/lib/wordpress/wordpress-cpt.php' );


/* Load theme scripts and fonts
---------------------------------------------------------------------------------------------------- */

// Enqueue front-end stylesheets
add_action( 'wp_enqueue_scripts', 'bc_enqueue_stylesheets' );
function bc_enqueue_stylesheets() {
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800&display=swap', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'fancybox', get_stylesheet_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'default', get_stylesheet_directory_uri() . '/assets/css/default.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/assets/css/style.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/assets/css/custom.css', array(), CHILD_THEME_VERSION );
}

// Enqueue admin stylesheets
add_action('admin_enqueue_scripts', 'bc_enqueue_admin_stylesheets');
function bc_enqueue_admin_stylesheets(){
	wp_register_style( 'custom_wp_admin_css', get_bloginfo('stylesheet_directory') . '/assets/css/admin.css', false, '1.0.0' );
	wp_enqueue_style( 'custom_wp_admin_css' );
}

// Add CSS styles to TinyMCE
add_action( 'admin_init', 'custom_editor_styles' );
function custom_editor_styles() {
	add_editor_style( get_stylesheet_directory_uri() . '/assets/css/tinymce.css' );
}

// Enqueue front-end scripts
add_action( 'wp_enqueue_scripts', 'bc_enqueue_scripts' );
function bc_enqueue_scripts() {
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), null );
	wp_enqueue_script( 'fancybox', get_stylesheet_directory_uri() . '/assets/js/jquery.fancybox.min.js', array('jquery'), null );
	wp_enqueue_script( 'enquire', get_stylesheet_directory_uri() . '/assets/js/enquire.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'search', get_stylesheet_directory_uri() . '/assets/js/search.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'hamburgler', get_stylesheet_directory_uri() . '/assets/js/hamburgler.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'auto-linker', get_stylesheet_directory_uri() . '/assets/js/autolinker.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'scrollmagic', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'scrollmagic-indicators', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'gsap-tweenmax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'gsap-animation', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/animation.gsap.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'gsap-cssplugin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/plugins/CSSPlugin.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'gsap-easepack', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/easing/EasePack.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), CHILD_THEME_VERSION, true );
}

// Enqueue front-end init.js last
add_action( 'wp_enqueue_scripts', 'bc_end_enqueue_scripts', PHP_INT_MAX );
function bc_end_enqueue_scripts() {
	wp_enqueue_script( 'init', get_stylesheet_directory_uri() . '/assets/js/init.js', array('jquery'), CHILD_THEME_VERSION, true );
}

// Enqueue admin scripts
add_action( 'admin_enqueue_scripts', 'bc_enqueue_admin_scripts' ); 
function bc_enqueue_admin_scripts() {
	wp_enqueue_script( 'admin-js', get_stylesheet_directory_uri() . '/assets/js/admin.js', array('jquery')
	);
}

//* Sanitize copy pasted into content editor
add_filter('tiny_mce_before_init','configure_tinymce');
function configure_tinymce($in) {
	$in['paste_preprocess'] = "function(plugin, args){
		// Strip all HTML tags except those we have whitelisted
		var whitelist = 'p,b,strong,i,em,h1,h2,h3,h4,h5,h6,ul,li,ol,a,blockquote,br,table,tbody,th,tr,td';
		var stripped = jQuery('<div>' + args.content + '</div>');
		var els = stripped.find('*').not(whitelist);
		for (var i = els.length - 1; i >= 0; i--) {
			var e = els[i];
			jQuery(e).replaceWith(e.innerHTML);
		}
		// Strip all class and id attributes
		stripped.find('*').removeAttr('id').removeAttr('class').removeAttr('style');
		// Return the clean HTML
		args.content = stripped.html();
	}";
	return $in;
}