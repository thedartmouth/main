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

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php
		// Output the featured image.
		if ( has_post_thumbnail() ) :
			$image_id = get_post_thumbnail_id( get_the_ID() );

			$img = wp_get_attachment_image_src( $image_id, 'dartmouth-full-width');
			$width = $img[1];
			$height = $img[2];

			if ($width > $height) {
				the_post_thumbnail( 'dartmouth-full-width' );
			} else {
				the_post_thumbnail();
			}
		endif;
	?>
	</a>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h4 class="entry-title">', '</h4>' );
			else :
				the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			endif;
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

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->