<?php
	function show_category_preview( $category_name ){

		$args = array(
			'category_name' => $category_name,
			'posts_per_page' => 4
			);
		$query = new WP_Query($args);

		$featured_post = -1;

		// Store the first featured post
		if ( $query->have_posts() ):
			while( $query->have_posts() ) : $query->the_post();
				if ( has_post_thumbnail() ) {
					$featured_post = $query->current_post;
					break;
				}
			endwhile;
		endif;
		$query->rewind_posts();

		?>
		<div class="col-md-6">
			<?php 
			$articles_placed = array();
			if ( $query->have_posts() ):
				while ( $query->have_posts() ) : $query->the_post();
					if ( $featured_post >= 0 and $featured_post < 3 ) {
						if ($featured_post == $query->current_post) {
							get_template_part( 'thumbnail-excerpt', get_post_format() );
						}
					} else {
						get_template_part( 'excerpt', get_post_format() );
					}

					array_push($articles_placed, $query->current_post);

					if ( count($articles_placed) == 2) {
						break;
					}
				endwhile;
			endif;
			$query->rewind_posts();
			?>
		</div>

		<div class="col-md-6">
			<?php
			if ( $query->have_posts() ):
				while ( $query->have_posts() ) : $query->the_post();
					if (!in_array($query->current_post, $articles_placed)) {
						get_template_part( 'excerpt', get_post_format() );
						array_push($articles_placed, $query->current_post);
					}
				endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>
	<?php
	}
?>