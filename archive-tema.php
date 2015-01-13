<?php get_header(); ?>
<div class="wrapper">
  <main role="main">
    <?php get_template_part('partials/articles', 'header');  ?>
    <section class="articles-list">
      <div class="container">
        <div class="row">
          <div id="articles-list" class="col-sm-12">
              <?php get_template_part('partials/loop', 'teman');  ?>
              <?php if( !class_exists('AjaxLoadMore') ): ?>
                <?php get_template_part('pagination'); ?>
              <?php endif; ?>
              <?php echo do_shortcode('[ajax_load_more seo="true" post_type="tema" offset="8" pause="true" posts_per_page="8" max_pages="none" scroll="false" button_label="Ladda mer"]'); ?>
          </div>
        </div>
      </div>
		</section>
	</main>
<?php get_footer(); ?>
