<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Dartmouth
 * @since Dartmouth 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

	<div class="row" id="belownav">
		<div class="col-md-9">
			<div class="ad">
				<!-- Leaderboard Homepage -->
				<?php show_oncampus_web_ad("728", "90", "536874059", "79fa82c8bb"); ?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="ad">
				<!-- Custom Ad Size -->
				<?php show_oncampus_web_ad("240", "90", "537108126", "9588c066a9"); ?>
			</div>
		</div>
	</div>

	<div class="row" id="abovefold">
		<!-- Application banners -->

		<div class="col-md-6"><div class='text-center alert alert-success' role="alert">Apply to write for the D <a target="_blank" href="https://docs.google.com/forms/d/1UWlz5oondNnjgkGvGFbyItjpb4U6AuMY1kMtOnPHy_E/viewform">here</a>!</div></div>
		<div class="col-md-6"><div class='text-center alert alert-success' role="alert">Interested in Business? Apply to our Business staff <a target="_blank" href="https://docs.google.com/forms/d/1DAX1PhfHP_5s7BoDO04ln_q7TxnnWGrkRGoRe2jzkGI/viewform?usp=send_form">here</a>!</div></div>
<!-- 		<div class='col-md-4'><div class='text-center alert alert-success application-alert' role="alert">Want to work on Dartmouth's most visited student site? <a target="_blank" href="https://docs.google.com/forms/d/1qVb3n_bpGLYZFRkCyyX5iNP0UewP1b5-mhG4JxIENqE/viewform">Join our tech team</a>!</div></div>
 -->	
 <div class='col-md-3' id="dailynews">
			<?php
			$args = array(
						'category_name' => 'news',
						'posts_per_page' => 5
						);
			$query = new WP_Query($args);

			if ( $query->have_posts() ):
				while( $query->have_posts() ) : $query->the_post();
					if ($query->current_post == 0) {
						get_template_part( 'excerpt', get_post_format() );
					} else {
						get_template_part( 'preview', get_post_format() );
					}
				endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>
		<div class='col-md-6'>
			<?php get_template_part( 'featured-slider' ); ?>
		</div>
		<div class="col-md-3 tweets" id="rightcol">
			<h2>Twitter</h2>
			<div id="twitter" class="up">
				<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/thedartmouth" data-widget-id="291269316375093248">Tweets by @thedartmouth</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<br />
			</div>
		</div>		
	</div>

	<div class="row"><div class="line"></div></div>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row" role="main">
			<div class="col-md-4 pull-right" id="rightcol">
				<h2 class="green"><a>Top Stories</a></h2>
				<?php
				$args = array(
							'meta_key' => 'wpb_post_views_count',
							'orderby' => 'meta_value_num',
							'order' => 'DESC',
							'date_query' => array(
								array(
										'column' => 'post_modified_gmt',
										'after' => '1 week ago'
									)
							),
							'posts_per_page' => 5
							);
				$query = new WP_Query($args);

				if ( $query->have_posts() ):
					while( $query->have_posts() ) : $query->the_post();
						get_template_part( 'preview', get_post_format() );
					endwhile;
				endif;
				wp_reset_postdata();
				?>

				<div class="row"><div class="line"></div></div>

				<?php
				    $category_id = get_cat_ID( 'opinion' );
				    $category_link = get_category_link( $category_id );
				?>

				<h2 class="green"><a href="<?php echo esc_url( $category_link ); ?>">Opinion</a></h2>
				<?php
				$args = array( 
							'category_name' => 'opinion',
							'posts_per_page' => 5 
							);
				$query = new WP_Query($args);

				if ( $query->have_posts() ):
					while( $query->have_posts() ) : $query->the_post();
						get_template_part( 'preview', get_post_format() );
					endwhile;
				endif;
				wp_reset_postdata();
				?>

				<div class="row"><div class="line"></div></div>

				<!-- RightRect-BTF -->
				<div class="ad">
					<?php show_oncampus_web_ad("300", "250", "536871734", "a88ae7e74b"); ?>
				</div>

				<div class="ad">
					<?php show_oncampus_web_ad("160", "600", "536871731", "3e60c52c4c"); ?>
				</div>

				<div class="ad">
					<?php show_oncampus_web_ad("160", "600", "536875765", "023db01b3b"); ?>
				</div>
			</div>
			<div class="col-md-8" id="leftcol">
				<div class="section-preview row">
					<?php
					    $category_id = get_cat_ID( 'sports' );
					    $category_link = get_category_link( $category_id );
					?>

					<h2 class="green"><a href="<?php echo esc_url( $category_link ); ?>">Sports</a></h2>
					<?php show_category_preview('sports') ?>
				</div>

				<div class="row"><div class="line"></div></div>

				<div class="section-preview row">
					<?php
					    $category_id = get_cat_ID( 'arts' );
					    $category_link = get_category_link( $category_id );
					?>

					<h2 class="green"><a href="<?php echo esc_url( $category_link ); ?>">Arts</a></h2>
					<?php show_category_preview('arts') ?>
				</div>

				<div class="row"><div class="line"></div></div>

				<div class="section-preview row">
					<?php
					    $category_id = get_cat_ID( 'mirror' );
					    $category_link = get_category_link( $category_id );
					?>

					<h2 class="green"><a href="<?php echo esc_url( $category_link ); ?>">The Mirror</a></h2>
					<?php show_category_preview('mirror') ?>
				</div>

				<div class="row"><div class="line"></div></div>
				
				<div class="section-preview row">
					<?php
					    $category_id = get_cat_ID( 'media' );
					    $category_link = get_category_link( $category_id );
					?>

					<h2 class="green"><a href="<?php echo esc_url( $category_link ); ?>">Media</a></h2>
					<?php
						$args = array(
							'category_name' => 'media',
							'posts_per_page' => 6
							);
						$query = new WP_Query($args);

						if ( $query->have_posts() ):
							while ( $query->have_posts() ) : $query->the_post();
					?>
								<div class="col-md-4"><a href="<?php the_permalink(); ?>">
									<div><?php the_post_thumbnail();  ?></div>
									<div><?php the_title( '<h4 class="entry-title">', '</h4>' ); ?></div>
								</a></div>
					<?php
							endwhile;
						endif;
					?>
				</div>

				<div class="row"><div class="line"></div></div>

				<div class="section-preview row">
					<div class="col-md-6">
						<h2 class="green"><a>Today's Paper</a></h2>
						<div>
						<?php 
							$page = get_page_by_path('d-issuu-url');
							echo apply_filters('the_content', $page->post_content);
						?>
						</div>
					</div>
					<div class="col-md-6">
						<h2 class="green"><a>Insert</a></h2>
						<div>
						<?php 
							$page = get_page_by_path('insert-issuu-url');
							echo apply_filters('the_content', $page->post_content);
						?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_footer(); ?>
<nav role="navigation" class="navigation site-navigation links-navigation">
	<div class="row text-center"><big>Links</big></div>
	<div class="container">
		<?php wp_nav_menu( array( 'theme_location' => 'ad-links', 'menu_class' => 'row text-center' ) ); ?>
	</div>
</nav>
