<?php
/**
 * Template Name: Bloggindex
 */
  query_posts( array(
    'showposts' => 8,
    'post_type' => 'post',
    'post_status' => 'publish',
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
  ));
  rewind_posts();
?>
<?php get_header(); ?>
<div class="wrapper">
  <main role="main">
    <?php get_template_part('partials/blogs', 'header');  ?>
    <section class="blogs-list">
      <div class="container">
        <div class="row">
          <div class="filter-area col-sm-3 col-sm-push-9">
            <?php echo get_the_categories('category'); ?>
          </div>
          <div class="col-sm-9 col-sm-pull-3">
            <?php get_template_part('loop');?>
            <?php if( !class_exists('AjaxLoadMore') ): ?>
              <?php get_template_part('pagination'); ?>
            <?php endif; ?>
            <?php echo do_shortcode('[ajax_load_more seo="true" post_type="post" offset="8" posts_per_page="8" pause="true" max_pages="none" scroll="false" button_label="Ladda fler"]'); ?>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php get_footer(); ?>