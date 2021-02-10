<?php
if( get_field('repeater') ) {
	while ( have_rows('repeater') ) : the_row();
		$array[] = get_sub_field('item'); 
	endwhile;
	$foo = implode(', ', $array);
	echo $foo;
}
?>