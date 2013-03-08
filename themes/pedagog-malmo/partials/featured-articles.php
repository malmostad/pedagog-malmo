<?php
  function non_featured_excerpt_length() { return 35; }
  add_filter( 'excerpt_length', 'non_featured_excerpt_length' );

  query_posts( array(
    'post_type' => 'page',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'orderby'   => 'date',
    'order' => 'DESC'
  ));
  if ( have_posts() ):
    while ( have_posts() ): the_post();
?>

<div class="featured-content clearfix">
  <a class="featured-image" href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail') ?></a>
  <div class="text">
    <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
    <p class="date"><?php echo get_the_date() . ' ' . get_the_time() ?></p>
    <div class="excerpt"><?php the_excerpt() ?></div>
  </div>
</div>

<?php
  endwhile;
endif;
?>