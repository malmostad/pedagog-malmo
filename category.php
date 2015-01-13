<?php get_header(); ?>
<div class="wrapper">
  <main role="main">
    <?php get_template_part('partials/blogs', 'header');  ?>
    <section class="articles-list">
      <div class="container">
        <div class="row">
          <div class="filter-area col-sm-3 col-sm-push-9">
            <?php echo get_the_categories('category'); ?>
          </div>
          <div id="articles-list" class="col-sm-9 col-sm-pull-3">
            <?php $blog_category =  $wp_query->query['category_name']; ?>
            <?php get_template_part('loop');?>
            <?php if( !class_exists('AjaxLoadMore') ): ?>
              <?php get_template_part('pagination'); ?>
            <?php endif; ?>
            <?php echo do_shortcode('[ajax_load_more seo="true" post_type="post" category="' . $blog_category . '" offset="8" posts_per_page="8" pause="true" max_pages="none" scroll="false" button_label="Ladda mer"]'); ?>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php get_footer(); ?>