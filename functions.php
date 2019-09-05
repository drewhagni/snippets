<?php
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