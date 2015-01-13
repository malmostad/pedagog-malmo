<?php if (have_posts()): while (have_posts()) : the_post(); ?>

  <?php get_template_part('partials/loopitem', 'blog');  ?>

<?php endwhile; ?>

<?php else: ?>

  <!-- article -->
  <article>
    <h2><?php _e( 'Sorry, nothing to display.', 'pedagog' ); ?></h2>
  </article>
  <!-- /article -->

<?php endif; ?>
