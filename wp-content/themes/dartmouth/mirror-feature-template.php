<?php
/*
Template Name: Mirror feature template
*/
get_header(); ?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

  <style>
  .backbutton {
    top: 0;
    left: 0;
    opacity: 0.4;
    z-index: 0;
    height: 50px;
  }
  h1{
    font-size: 32px;
  }
  .backbutton:hover {
    opacity: 1;
  }
  .backbutton a {
    color: black;
    font-weight: bold;
  }
  .backbutton span{
    margin-left:-4px;
  }
  .backbutton img {
    width: 80px;
    margin-right: -10px;
  }
  #site-header{
  	display:none;
  }
  #masthead{
  	display:none;
  }
  .entry-title{
  	text-align: center;
  }

  </style>
  <div class="backbutton">
   <a href="<?php bloginfo('url');?>"><img style="width:80px;vertical-align:middle" src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/d_isolated.png">
   <span style="">Back to The Dartmouth</span></a>
</div>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && dartmouth_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_footer();