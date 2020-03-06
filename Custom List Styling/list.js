jQuery(document).ready(function($){
	// Adjust counter for "ol" tags that have a custom start
	$( "ol" ).each(function() {
		var   val=1;
		if ( $(this).attr("start")){
			val =  $(this).attr("start");
		}
		val=val-1;
		val= 'custom-counter '+ val;
		$(this).css('counter-increment',val );
	});
});