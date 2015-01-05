<?php
/*
Template Name: Archives
*/
get_header(); ?>

<div id="container">
	<div id="content" role="main">

		<?php the_post(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<div class="col-md-4"><?php get_search_form(); ?></div>
		
		<h2>Archives by Day:</h2>
		<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
			<?php wp_get_archives( array( 'type' => 'daily', 'format' => 'option')); ?>
		</select>

		<h2>Archives by Year:</h2>
		<ul>
			<?php wp_get_archives( array( 'type' => 'yearly', 'format' => 'html')); ?>
		</ul>

	</div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>