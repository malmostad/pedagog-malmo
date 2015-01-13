  <!-- article -->
  <article id="post-<?php the_ID(); ?>" <?php post_class('loop-item'); ?>>
    <!-- post thumbnail -->
    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
      </a>
    <?php endif; ?>
    <!-- /post thumbnail -->

    <!-- post title -->
    <h2>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </h2>
    <!-- /post title -->

    <!-- post details -->
    <span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
    <span class="author"><?php _e( 'Published by', 'pedagog' ); ?> <?php the_author_posts_link(); ?></span>
    <span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'pedagog' ), __( '1 Comment', 'pedagog' ), __( '% Comments', 'pedagog' )); ?></span>
    <!-- /post details -->

    <?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

    <?php edit_post_link(); ?>

  </article>
  <!-- /article -->