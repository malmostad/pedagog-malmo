<?php
/**
 * The template for displaying Category Archive pages.
 */
get_header(); ?>

<div id="container" class="clearfix">
  <div id="content" role="main">

    <h1 class="page-title">
      <a class="feed-link"  href="./feed">
        <img src="<?php echo get_template_directory_uri() . '/images/feed.png' ?>" alt="RSS-flöde" />
      </a>
      Bloggkategori: <?php single_term_title() ?>
    </h1>

    <?php
      if ( have_posts() ) the_post();
      rewind_posts();
      get_template_part( 'loop', 'author' );
    ?>
  </div>
</div>
<?php get_sidebar(); ?>
<?php partial('subscribe') ?>
<?php get_footer(); ?>
