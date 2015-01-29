<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Dartmouth
 * @since Dartmouth 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
	<div class="special-issue container">
			<div class="text-center special-issue-header">Moving Dartmouth Forward</div>
			<nav role="navigation" class="navigation site-navigation extra-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'extra', 'menu_class' => 'nav-menu col-md-12' ) ); ?>
			</nav>
		</div>
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

				endwhile;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_footer();
