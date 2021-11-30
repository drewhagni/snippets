<?php

$args = array(
	'post_type'			=> 'post',
	'post_status'		=> 'publish',
	'posts_per_page'	=> $posts_per_page,
);

$posts = new WP_Query( $args );

if($posts->have_posts()) :
	while($posts->have_posts()) : $posts->the_post(); ?>

	<?php
	$classes = 'post-tile home-news__post-tile';
	if( has_post_thumbnail() ) {
		$classes .= ' has-featured-image';
	}
	?>

	<div class="home-news__slide slide anim-child">
		<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
			<a href="<?php echo get_permalink(); ?>"><div class="post-tile__featured-image home-news__featured-image featured-image" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), "full" ); ?>);"></div></a>
			<div class="entry-content post-content post-tile__content home-news__content">
				<h3 class="entry-title post-title post-tile__title home-news__title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="entry-meta post-meta post-tile__meta home-news__meta">
					<div class="entry-date post-date post-tile__date home-news__date" itemprop="datePublished">
						<p><?php echo get_the_date('Y.m.d'); ?></p>
					</div><!-- .entry-date -->
				</div><!-- .entry-meta -->
				<p class="entry-excerpt post-excerpt post-tile__excerpt home-news__excerpt"><?php echo get_the_excerpt(); ?></p>
				<a href="<?php echo get_permalink(); ?>" class="more-link post-tile__more-link home-news__more-link">Read More</a>
			</div>
		</article>
	</div>

<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>