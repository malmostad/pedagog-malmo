<?php
  query_posts( array(
    'post_type' => 'artiklar',
    'post_status' => 'publish',
    'meta_key' => 'pedagog_post_views_count',
    'order' => 'DESC',
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
  ));
  rewind_posts();
?>
<?php /* Template Name: Mest lästa artiklar */ get_header(); ?>
<div class="wrapper">
  <main role="main">
    <?php get_template_part('partials/articles', 'header');  ?>
    <section class="articles-list">
      <div class="container">
        <div class="row">
          <div class="filter-area col-sm-3 col-sm-push-9">
            <?php get_template_part('partials/filter', 'articles');  ?>
          </div>
          <div id="articles-list" class="col-sm-9 col-sm-pull-3">
            <?php get_template_part('loop');  ?>
            <?php get_template_part('pagination'); ?>
          </div>
        </div>
      </div>
		</section>
	</main>
<?php get_footer(); ?>
