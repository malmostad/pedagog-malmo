<?php
  function featured_image_length() { return 70; }
  add_filter( 'excerpt_length', 'featured_image_length' );
?>
<div class="loop  use-featured-image">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

      <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php 
            printf( esc_attr__( 'Permalink to %s', 'malmo' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
          <?php the_title(); ?>
        </a>
      </h2>

      <div class="featured-image">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail('thumbnail') ?>
        </a>
      </div>

      <div class="entry-contents">
        <div class="entry-meta">
          <?php loop_page_posted_on(); ?>
        </div>

        <?php 
          $theme_blog = theme_blog_meta($post->ID);
          if (gettype($theme_blog) == 'array' && $theme_blog = $theme_blog[0]) { ?>
            <div class="entry-part-of">
              <a href="<?php echo get_bloginfo('url') . '/' . $theme_blog->taxonomy . '/' . $theme_blog->slug ?>">Temabloggen <?php echo  $theme_blog->name ?></a>
            </div>
        <?php } ?>

        <div class="entry-summary">
          <?php the_excerpt(); ?>
        </div>

      </div>
    </div>

    <?php 
      endwhile;
    endif;
  ?>
  <div id="nav-below" class="navigation">
    <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'malmo' ) ); ?></div>
    <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'malmo' ) ); ?></div>
  </div>
</div>