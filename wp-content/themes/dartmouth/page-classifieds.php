<?php
/**
 * The template for the classifieds page.
 *
 * @package WordPress
 * @subpackage Dartmouth
 * @since Dartmouth 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div id="Partner_API_CampusAve" partnerid="2424" partnerdomain="http://thedartmouth.campusave.com/" style="margin: auto !important;">
loading classifieds...
</div>
<script type="text/javascript" src="http://thedartmouth.campusave.com/includes/api.js"></script>
<div id="Partner_API_CampusAve_BI" style="margin: auto auto 10px !important;">
	<a href="http://dartmouth.uloop.com" target="_blank">
		<img src="http://thedartmouth.campusave.com/images/powered-by-uloop3.gif" alt="Dartmouth College Classifieds in Hanover, New Hampshire" title="Dartmouth College Classifieds in Hanover, New Hampshire"/>
	</a>
</div>
		

			</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->


<?php
get_footer();
