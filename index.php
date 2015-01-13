<?php get_header(); ?>
<div class="wrapper">
	<main role="main">
		<section class="front-articles">
      <?php get_template_part( 'partials/loop', 'articles-start' ); ?>
		</section>
    <section class="front-themes">
      <?php get_template_part( 'partials/loop', 'themes-start' ); ?>
    </section>
    <section class="front-blog-and-sidebar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 front-blog-posts">
            <?php get_template_part( 'partials/loop', 'blog-posts-start' ); ?>
          </div>
          <div class="col-sm-4">
            <?php get_sidebar(); ?>
          </div>
        </div>
      </div>
    </section>
	</main>
<?php get_footer(); ?>