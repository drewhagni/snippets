<?php 

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'bc_page_loop' );
function bc_page_loop() { ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-header page-header <?php if( has_post_thumbnail() ) { echo 'has-featured-image'; } ?>" <?php if( has_post_thumbnail() ) { echo 'style="background-image: url(' . wp_get_attachment_url( get_post_thumbnail_id($post->ID), "full" ) . ');"'; } ?>>
				<div class="wrap">
					<?php the_title('<h1 class="entry-title page-title">', '</h1>'); ?>
				</div>
				<!-- for parallaxing -->
				<?php if( has_post_thumbnail() ): ?>
				<div class="bg"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), "full" ); ?>"></div>
				<?php endif; ?>
			</div><!-- .entry-header.page-header -->
			<div class="entry-content page-content">
				<div class="wrap">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div><!-- .wrap -->
			</div><!-- .entry-content.page-content -->
		</article>
	<?php endwhile; ?>
<?php }

genesis();