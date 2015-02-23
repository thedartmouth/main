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
 <style>
  .backbutton {
    top: 0;
    left: 0;
    opacity: 0.4;
    z-index: 0;
    height: 50px;
  }
  #site-header{
    display:none;
  }
  .site-footer{
    display:none;
  }
  #masthead{
    display:none;
  }
  .entry-title{
    text-align: center;
    margin-bottom:15px;
  }
  .backbutton:hover {
    opacity: 1;
    cursor: pointer;
  }
  .backbutton img {
    width: 80px;
    margin-right: -10px;
    vertical-align:middle;
  }
  #footer {
    right:0px;
    margin: auto 1em 1em auto;
    font-size: 12px;
}

  </style>
  <a href="<?php bloginfo('url');?>"><div class="backbutton">
   <img src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/d_isolated.png">
   <span style="color: black;">Back to <b>The Dartmouth</b></span>
</div></a>
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
/*          if ( comments_open() || get_comments_number() ) {
            comments_template();
          }*/
        endwhile;
      ?>

    </div><!-- #content -->
  </div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_footer();
