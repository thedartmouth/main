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

<div class="ad">
	<?php show_oncampus_web_ad("300", "250", "537085606", "2173acf7ab"); ?>
</div>

<div class="ad">
	<?php show_oncampus_web_ad("160", "600", "536871731", "3e60c52c4c"); ?>
</div>