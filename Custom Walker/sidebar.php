<?php if( ! ( get_field('disable_sidebar') && get_field('disable_newsletter') ) ): ?>
<aside class="sidebar sticky">
	<?php if( ! get_field('disable_sidebar') ): ?>
	<div class="block">
		<h3 class="sidebar-title">
			<?php if( get_field('custom_sidebar') ) {
				the_field('sidebar_title');				
			} elseif (is_singular('jobs')) {
				echo 'Recent Job Listings';
			} elseif (is_single()) { /* single post */
				echo 'Recent Posts';
			} elseif (is_home() || is_archive()) { /* blog page */
				echo 'Categories';
			} elseif (is_page_template('page-careers.php')) {
				echo 'Recent Job Listings';
			} elseif (is_page_template('page-contact.php')) {
				echo 'Locations';
			} elseif (is_search() || is_404()) {
				echo 'Site Map';
			} else {
				echo 'Quick Links';
			}
			?>	
		</h3>
		<div class="sidebar-content">
			<?php
			if ( get_field('custom_sidebar') ) {
				echo '<div class="custom-list">' . get_field('sidebar_content') . '</div>';
			} elseif (is_home() || is_archive()) { /* blog page */
					$args = array(
						'show_count' => true,
						'title_li' => '',
					);
				wp_list_categories( $args );
			} elseif (is_singular('jobs')) {
				global $post;
				$post_ID = $post->ID;
				echo '<ul>';
					$args = array(
						'numberposts' => '5',
						'post_type'			=> 'jobs',
						'post_status'		=> 'publish',
						'orderby'			=> 'menu_order',
						'order'				=> 'ASC',

					);
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
						$link_ID = $recent["ID"];
						if ($post_ID == $link_ID) {
							echo '<li class="current-menu-item"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
						} else {
						echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
						}
					}
					wp_reset_query();
				echo '</ul>';
			} elseif (is_page_template('page-careers.php')) { /* careers page */
				global $post;
				$post_ID = $post->ID;
				echo '<ul>';
					$args = array(
						'numberposts' => '5',
						'post_type'			=> 'jobs',
						'post_status'		=> 'publish',
						'orderby'			=> 'menu_order',
						'order'				=> 'ASC',

					);
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
						$link_ID = $recent["ID"];
						if ($post_ID == $link_ID) {
							echo '<li class="current-menu-item"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
						} else {
						echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
						}
					}
					wp_reset_query();
				echo '</ul>';
			} elseif (is_page_template('page-contact.php')) { // contact page 
				?>
				<div class="sidebar-content">
					<em class="small">Click a location below to update the map</em><br><br>
					<ul class="locations-list"></ul>
				</div>
				<?php
			} elseif (is_single()) { /* single post */
				/*
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 5,
				);
				$the_query = new WP_Query( $args );
				if ( $the_query->have_posts() ) :
					echo '<ul>';
					while ( $the_query->have_posts() ) : $the_query->the_post();
						echo '<li><a href="">'. get_the_title() . '</a></li>';
					endwhile;
					echo '</ul>';
					wp_reset_postdata();
				endif;
				*/
				global $post;
				$post_ID = $post->ID;
				echo '<ul>';
					$args = array(
						'numberposts' => '5',
						'post_status' => 'publish',

					);
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
						$link_ID = $recent["ID"];
						if ($post_ID == $link_ID) {
							echo '<li class="current-menu-item"><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
						} else {
						echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
						}
					}
					wp_reset_query();
				echo '</ul>';

			} elseif (is_search() || is_404()) {
				echo '<ul class=pre-nav><li><a href="' . home_url() . '">Home</a></li></ul>';
				wp_nav_menu( 
					array(
						'menu' => 'primary-navigation', 
						'echo' => true,
						'menu_class' => 'sitemap'
					)
				);
			} else { 
				wp_nav_menu( 
					array(
						'menu' => 'primary-navigation', 
						'walker' => new Selective_Walker(),
						'echo' => true
					)
				);
			}
			?>
		</div>
	</div><!-- .block -->
	<?php endif; ?>
	<?php if(!get_field('disable_newsletter') && (is_page() || is_singular('post') || is_home())): ?>
			<div id="newsletter-signup" class="block">
				<h3 class="sidebar-title">Sign up for our newsletter</h3>
				<?php gravity_form( 'Newsletter Sign-up', false, false, false, null, true, 2, true ); ?>
			</div>
	<?php endif; ?>
</aside>
<?php endif; ?>