// Haven't tried this yet, but here's a simpler(?) script: https://dev.to/luisaugusto/how-to-convert-image-tags-with-svg-files-into-inline-svg-tags-3jfl

// Replace SVG images with inline SVG
$('img[src$=".svg"]').each(function(){

	var $img = $(this);
	var imgID = $img.attr('id');
	var imgClass = $img.attr('class');
	var imgURL = $img.attr('src');

	var imgWidth = ($img.width() > 0) ? $img.width() : $img.attr('width');
	var imgHeight = ($img.height() > 0) ? $img.height() : $img.attr('height');
	if($img.attr('title')) {
		var imgTitle = $img.attr('title').replace(/\-/g, ' '); // get the title, replace dashes with spaces
	}
	var imgAlt = $img.attr('alt');

	$(this).wrap( '<div class="svg-wrapper '+imgTitle+'"></div>' );
	
	$.get(imgURL, function(data) {
		// Get the SVG tag, ignore the rest
		var $svg = $(data).find('svg');

		// Add replaced image's ID to the new SVG
		if(typeof imgID !== 'undefined') {
			$svg = $svg.attr('id', imgID);
		}
		// Add replaced image's classes to the new SVG
		if(typeof imgClass !== 'undefined') {
			$svg = $svg.attr('class', imgClass+ ' replaced-svg');
		}

		$svg = $svg.attr('width', imgWidth);
		$svg = $svg.attr('height', imgHeight);

		// Remove any invalid XML tags as per http://validator.w3.org
		$svg = $svg.removeAttr('xmlns:a');

		// Replace image with new SVG
		$img.replaceWith($svg);

	}, 'xml');

});

// Remove link to SVG images
$('a[href$=".svg"]').each(function() {
	$(this).removeAttr('href');
});