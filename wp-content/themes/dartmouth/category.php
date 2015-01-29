<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Dartmouth
 * @since Dartmouth 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content row" role="main">

			<div class="ad">
				<?php show_oncampus_web_ad("728", "90", "536871729", "a33db12fcb") ?>
			</div>
		<div class="special-issue container">
				<div class="text-center special-issue-header">Moving Dartmouth Forward</div>
				<nav role="navigation" class="navigation site-navigation extra-navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'extra', 'menu_class' => 'nav-menu col-md-12' ) ); ?>
				</nav>
			</div>
			<?php if ( have_posts() ) : ?>
			<div class="col-md-8">
				<header class="archive-header">
					<h1 class="green"><?php printf( __( '%s', 'dartmouth' ), single_cat_title( '', false ) ); ?></h1>

					<?php
						// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>
				</header><!-- .archive-header -->

				<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						?>
						<div class="row">
							<div class="col-md-4 archive-thumbnail">
								<?php the_post_thumbnail( 'dartmouth-full-width' ) ?>
							</div>

							<div class="col-md-8">
								<?php get_template_part( 'excerpt', get_post_format() ); ?>
							</div>
						</div>


						
						<?php

						endwhile;
						// Previous/next page navigation.
						dartmouth_paging_nav();

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );

					endif;
				?>
			</div>

			<div class="col-md-4">
				<?php get_sidebar('custom'); ?>
			</div>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_footer();
