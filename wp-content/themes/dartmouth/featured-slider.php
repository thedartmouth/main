<div id="featured-carousel" class="featured-slider carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#featured-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#featured-carousel" data-slide-to="1"></li>
    <li data-target="#featured-carousel" data-slide-to="2"></li>
    <li data-target="#featured-carousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php
      $args = array(
            'category_name' => 'featured',
            'posts_per_page' => 4
            );
      $query = new WP_Query($args);
      $c=0;

      if ( $query->have_posts() ):
        while( $query->have_posts() ) : $query->the_post();
          $thumbnail_id = get_post_thumbnail_id(get_the_id());
          ?>

          <div class="item <?php if ($c == 0) {echo 'active';} ?>">
            <a href="<?php the_permalink()?>">
              <div class="carousel-image">
                <img src='<?php echo wp_get_attachment_url($thumbnail_id); ?>' alt='<?php echo the_title(); ?>'>
              </div>
              <div class="carousel-caption">
                <h3><?php the_title() ?></h3>
                <?php the_excerpt()?>
              </div>
            </a>
          </div>

          <?php
          $c += 1;
        endwhile;
      endif;
      wp_reset_postdata();
    ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#featured-carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#featured-carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>