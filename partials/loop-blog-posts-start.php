<?php $blog_posts_loop = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 8, )); ?>

<?php if ( $blog_posts_loop->have_posts() ) : ?>
  <div class="front-blog-header">
    <h3>Senaste blogginläggen</h3>
  </div>
  <?php while ( $blog_posts_loop->have_posts() ) : $blog_posts_loop->the_post(); ?>
    <article class="loop-item loop-item--compact">
      <?php echo get_the_label(); ?>
      <div class="body-copy loop-item__inner">
        <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="meta">
          <?php go_author(); ?> • 
          <?php go_smartdate(); ?>
        </div>
      </div>
    </article>
  <?php endwhile;?>
  <div class="more-wrapper"><a href="/bloggar" class="more-button">Läs fler inlägg</a></div>
<?php else: ?>

<?php endif; ?>
<?php wp_reset_query(); ?>
