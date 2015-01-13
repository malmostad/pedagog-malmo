<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('loop-item loop-item-small'); ?>>
  <!--TODO FALLBACK IMAGE IF NO THUMBNAIL EXISTS -->
  <?php echo get_the_label(); ?>
  <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
    <a class="post__featureimage" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_post_thumbnail('medium'); ?>
    </a>
  <?php endif; ?>
  <div class="content">
    <!-- post title -->
    <h3 class="body-copy">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </h3>
    <!-- /post title -->
  </div>

</article>
<!-- /article -->