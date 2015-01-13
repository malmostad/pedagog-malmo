<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('loop-item'); ?>>
  <!--TODO FALLBACK IMAGE IF NO THUMBNAIL EXISTS -->
  <?php if ( !is_search() && has_post_thumbnail()) : // Check if thumbnail exists 
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'loop-image-large');
    ?>
    <a class="post__featureimage" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_post_thumbnail('loop-image-large'); ?>
    </a><?php
  endif; ?>
  <?php echo get_the_label(); ?>
  <div class="content body-copy">
    <!-- post title -->
    <h2>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </h2>
    <!-- /post title -->

    <?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
    <!-- post details -->
    <div class="meta"> 
      <p>
        <?php go_smartdate(); ?>
        <!-- TODO SHOW ONLY FOR ARTICLES, OTHERWISE SHOW BLOG CATEGORIES -->
        <?php if(!is_search()){ ?>
        <span class="categories bp-medium-up"> • 
          <?php echo get_the_term_list( $articles_loop->post->ID, 'artikelkategorier', '', ', ','' ); ?>
          <?php echo get_the_term_list( $articles_loop->post->ID, 'category', '', ', ','' ); ?>
        </span>
        <?php } ?>
      </p>
      <?php
      if(get_post_type() == 'post'){ ?>
        <p>
          <?php go_author(); ?>
        </p>
      <?php } ?>
    </div>
    <!-- /post details -->
    <?php edit_post_link(); ?>
  </div>

</article>
<!-- /article -->