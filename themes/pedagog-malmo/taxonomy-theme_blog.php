<?php
/**
 * The template for displaying archive of theme_blog posts
 */
get_header(); ?>

<div id="container" class="clearfix">
  <div id="content" role="main">
  <?php if ( have_posts() ) the_post(); ?>

  <h1 class="page-title">
    <a class="feed-link"  href="./feed">
      <img src="<?php echo get_template_directory_uri() . '/images/feed.png' ?>" alt="RSS-flöde" />
    </a>
    Temabloggen <?php single_cat_title() ?>
  </h1>

  <?php
    // If the theme category has a description, show it
    $theme_blog = theme_blog_meta($post->ID);
    if ( $theme_blog[0]->description ) : ?>
    <div id="entry-author-info">
      <div class="author-image">
        <?php
          $images = array_values(get_tax_meta( $theme_blog[0]->term_id, 'profile_image'));
          if (!empty($images[0])) {
            echo get_image_tag( $images[0] );
          }
        ?>
      </div>

      <div class="author-description">
        <h2>Om <em><?php echo $theme_blog[0]->name ?></em></h2>
        <p><?php echo $theme_blog[0]->description ?></p>
      </div>
    </div>
  <?php endif; ?>

  <?php
    rewind_posts();
    get_template_part( 'loop', 'featured_image' );
  ?>
  </div>
</div>

<?php get_sidebar(); ?>
<?php partial('subscribe') ?>
<?php get_footer(); ?>
