<?php
function loop_home_excerpt_length() { return 25; }
add_filter( 'excerpt_length', 'loop_home_excerpt_length' );


query_posts('showposts=5');

if (have_posts()): 
  while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

      <div class="author-avatar">
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ),
            apply_filters( 'malmo_author_bio_avatar_size', 80 ) ); ?></a>
      </div>

      <div class="entry-contents">
        <h3 class="entry-title">
          <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'malmo' ),
              the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_title(); ?>
          </a>
        </h3>
        <div class="entry-meta">

          <?php 
            $theme_blog = theme_blog_meta($post->ID);
            if (gettype($theme_blog) == 'array' && $theme_blog = $theme_blog[0]) { ?>
              <div class="entry-part-of">
                <a href="<?php echo get_bloginfo('url') . '/' . $theme_blog->taxonomy . '/' . $theme_blog->slug ?>">Temabloggen <?php echo  $theme_blog->name ?></a>
              </div>
          <?php } ?>
          <div class="published clearfix">
            <?php loop_posted_on(true); ?>
          </div>
        </div>

        <div class="entry-summary">
          <?php the_excerpt(); ?>
        </div>
      </div>

    </div>
    <?php 
    comments_template( '', true );
  endwhile;
endif;
