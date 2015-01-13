<?php
/*
YARPP Template: Fyra stycken
Author: Daniel
*/
?>
<?php if (have_posts()):?>
  <div class="related-posts">
    <h2 class="body-copy">Fortsatt läsning</h2>
    <div class="related-posts-inner row">
      <?php while (have_posts()) : the_post(); ?>
        <div class="col-sm-3">
          <?php get_template_part( 'partials/loopitem', 'relatedpost' ); ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
<?php else: ?>
<?php endif; ?>