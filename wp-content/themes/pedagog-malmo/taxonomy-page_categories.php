<?php
/**
 * The template for displaying Articles loop for a category.
 */
get_header(); ?>

<div id="container" class="clearfix">
  <div id="content" role="main">
    <?php if ( have_posts() ) the_post(); ?>
    <h1 class="page-title">
      Alla artiklar i kategorin <?php single_cat_title() ?>
    </h1>

    <?php
      rewind_posts();
      get_template_part( 'loop', 'featured_image' );
    ?>
  </div>
</div>
<?php get_sidebar(); ?>
<?php partial('page-sidebar', array('show_related' => false)) ?>
<?php get_footer(); ?>
