<?php get_header(); ?>
<div class="wrapper">
  <main role="main">
    <?php get_template_part('partials/articles', 'header');  ?>
    <section class="articles-list">
      <div class="container">
        <div class="row">
          <div class="filter-area col-sm-3 col-sm-push-9 ">
            <?php get_template_part('partials/filter', 'articles');  ?>
          </div>
          <div id="articles-list" class="col-sm-9 col-sm-pull-3">
              <?php get_template_part('loop');?>
              <?php if( !class_exists('AjaxLoadMore') ): ?>
                <?php get_template_part('pagination'); ?>
              <?php endif; ?>
              <?php echo do_shortcode('[ajax_load_more seo="true" post_type="artiklar" offset="8" pause="true" posts_per_page="8" max_pages="none" scroll="false" button_label="Ladda mer"]'); ?>
          </div>
        </div>
      </div>
		</section>
	</main>
<?php get_footer(); ?>
