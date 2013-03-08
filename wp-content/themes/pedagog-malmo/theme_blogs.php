<?php
/**
 * Template Name: Temabloggar
 */
get_header(); ?>
<div id="container" class="clearfix">
  <h1 class="entry-title">Bloggar för Pedagog Malmö</h1>
  <?php if ( have_posts() ) the_post(); ?>
  <?php the_content(); ?>
  <div id="content" role="main">
    <?php wp_nav_menu( array( 'menu' => 'Bloggar', 'menu_id' => 'blog-menu', 'menu_class' => 'clearfix', 'container' => 'false',  'depth' => 1 ) ) ?>

    <div class="theme-blogs">
      <ul>
        <?php
          $theme_blogs = $wpdb->get_results("SELECT t.* , tt.* FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy = 'theme_blog' ORDER BY t.name");
          $i = 1;
          foreach ( $theme_blogs as $theme_blog ) {
            if ( $theme_blog->count !== "0" ) {
              $images = array_values(get_tax_meta( $theme_blog->term_id, 'profile_image'));
              if (!empty($images[0])) {
                $image = get_image_tag( $images[0] );
              } else {
                $image = false;
              }
              $class = "";
              if ( $i % 4 === 0 ) { $class ='last-on-row'; }
              elseif ( $i % 4 === 1 ) { $class ='first-on-row'; } ?>
              <li class="<?php echo $class ?>">
                <div class="theme-image">
                  <?php if ($image) { ?>
                  <a href="<?php echo get_bloginfo('url') ?>/theme_blog/<?php echo $theme_blog->slug ?>"><?php echo $image ?></a>
                  <?php } ?>
                  </div>
                <p><a href="<?php echo get_bloginfo('url') ?>/theme_blog/<?php echo $theme_blog->slug ?>"><?php echo $theme_blog->name ?></a> (<?php echo $theme_blog->count ?>)</p>
              </li>
        <?php $i++; } } ?>
      </ul>
    </div>
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
