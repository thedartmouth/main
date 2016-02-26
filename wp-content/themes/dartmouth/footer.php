<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Dartmouth
 * @since Dartmouth 1.0
 */
?>

		</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'footer' ); ?>


			<nav role="navigation" class="navigation site-navigation secondary-navigation">
				<div class="col-md-1"></div>
				<div class="copyright col-md-2">© 2016 The Dartmouth, Inc.</div>
				<div class="col-md-8"><?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?></div>
				<div class="col-md-1"></div>
			</nav>
		</footer><!-- #colophon -->
	</div><!-- #page -->
    
	<?php wp_footer(); ?>
</body>
</html>