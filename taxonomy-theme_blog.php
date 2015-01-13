<?php get_header(); ?>
<div class="wrapper">
  <main role="main">
    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-3 blogger-info">
            <?php $theme_blog = theme_blog_meta($post->ID);
            if ( $theme_blog[0]->description ) : ?>
              <div id="entry-author-info">
                <h3 class="label body-copy">Om bloggen</h3>
                <div class="author-image">
                  <?php $images = get_tax_meta( $theme_blog[0]->term_id, 'profile_image');
                  if (!empty($images[id])) {
                    echo get_image_tag( $images[id], false, false, false, 'article-front');
                  } ?>
                </div>
                <div class="blog-details">
                  <p><?php echo $theme_blog[0]->description ?></p>
                </div>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-sm-9">
            <?php get_template_part('loop');?>
            <?php if( !class_exists('AjaxLoadMore') ): ?>
              <?php get_template_part('pagination'); ?>
            <?php endif; ?>
            <?php $theme_blog =  $wp_query->query['theme_blog']; ?>
            <?php echo do_shortcode('[ajax_load_more seo="true" post_type="post" taxonomy="theme_blog" taxonomy_terms="' . $theme_blog . '" offset="8" posts_per_page="8" max_pages="none" pause="true" scroll="false" button_label="Ladda mer"]'); ?>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php get_footer(); ?>