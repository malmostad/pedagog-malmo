<?php
/**
 * Template Name: Senate blogginlägg
 */
get_header(); ?>
<div id="container" class="clearfix">
  <h1 class="entry-title">Bloggar för Pedagog Malmö</h1>
  <?php if ( have_posts() ) the_post(); ?>
  <?php the_content(); ?>
  <div id="content" role="main">
    <?php wp_nav_menu( array( 'menu' => 'Bloggar', 'menu_id' => 'blog-menu', 'menu_class' => 'clearfix', 'container' => 'false',  'depth' => 1 ) ) ?>
    <?php
      query_posts( array(
          'showposts' => 10,
          'post_type' => 'post',
          'post_status' => 'publish',
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
      ));
      rewind_posts();
      get_template_part( 'loop', 'featured_image' );
    ?>
  </div>
</div>

<?php get_sidebar(); ?>
<?php partial('subscribe') ?>
<?php if ( is_active_sidebar( 'latest-post-page' ) ) : ?>
  <div id="latest-post-page" class="post-sidebar widget-area" role="complementary">
    <ul>
      <li class="theme-categories">
        <ul>
        <?php dynamic_sidebar( 'latest-post-page' ); ?>
        </ul>
      </li>
    </ul>
  </div>
<?php endif; ?>
<?php get_footer(); ?>
