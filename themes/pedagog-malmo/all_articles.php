<?php
/**
 * Template Name: Artikelindex
 */

// Get all page_categories ID's
$terms = array();
foreach (get_terms("page_categories") as $term) {
  $terms[] = $term->term_id;
}

// Get all articles that has a page_categories term assigned
query_posts( array(
  'post_type' => 'page',
  'post_status' => 'publish',
  'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
  'tax_query' => array(
  	array(
    'taxonomy' => 'page_categories',
    'terms' => $terms,
    'field' => 'id'
	))
));
get_header(); ?>

<div id="container" class="clearfix">
  <div id="content" role="main">
  <?php
    if ( have_posts() ): the_post(); ?>
      <h1 class="page-title">
        <a class="feed-link"  href="<?php echo get_bloginfo('url') . '/?feed=pages-rss2' ?>">
          <img src="<?php echo get_template_directory_uri() . '/images/feed.png' ?>" alt="RSS-flöde" />
        </a>
        Alla artiklar
      </h1>
      <?php
        rewind_posts();
        get_template_part( 'loop', 'featured_image' );
      ?>
    </div>
  </div>
<?php endif; ?>

<?php get_sidebar(); ?>
<?php partial('page-sidebar', array('show_related' => false, 'show_categories' => true)) ?>
<?php get_footer(); ?>
