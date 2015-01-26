<?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('loop-item loop-item--tema'); ?>>
    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php echo get_the_label(); ?>
        <?php the_post_thumbnail('loop-image-large'); ?>
      </a>
    <?php endif; ?>
      <?php $tema_image = get_field('tema_image'); ?>
      <div class="tema-image">
        <img src="<?php echo $tema_image['sizes']["tema-image-large"]; ?>" alt="">
        <div class="tema-description body-copy">
          <a class="post-label" href="<?php echo get_permalink(); ?>"><span class="bold">Tema</span> <?php the_title(); ?></a>
          <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_field('tema_header'); ?></a></h2>
          <p><?php echo get_field('tema_description'); ?></p>
          <div class="meta"><p class="date"><?php the_time('F j, Y'); ?></p></div>
        </div>
      </div>
  </article>
<?php endwhile; ?>
<?php else: ?>
  <article>
    <h2 class="meta--center"><?php _e( 'Det finns inga teman ännu.', 'pedagog' ); ?></h2>
  </article>
<?php endif; ?>
