<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Dartmouth
 * @since Dartmouth 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row" role="main">

			<div class="ad">
				<?php show_oncampus_web_ad("728", "90", "536871729", "a33db12fcb") ?>
			</div>

			<div class="col-md-8">
			<?php

				// Start the Loop.
				while ( have_posts() ) : the_post();
					wpb_set_post_views(get_the_ID());

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
			</div>

			<div class="col-md-4">
				<?php get_sidebar('custom'); ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
