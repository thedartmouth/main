<?php
/**
 * The default template for displaying a preview.
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Dartmouth
 * @since Dartmouth 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
			the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
		?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					dartmouth_posted_on();
			?>
			<?php
				edit_post_link( __( 'Edit', 'dartmouth' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php endif; ?>
</article><!-- #post-## -->
