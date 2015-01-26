<?php $tema_loop = new WP_Query( array('post_type' => 'tema' )); ?>
<div class="container">
  <?php if ( $tema_loop->have_posts() ) : ?>
    <?php while ( $tema_loop->have_posts() ) : $tema_loop->the_post(); ?>
      <?php $active = get_field('tema_active'); ?>
        <?php if ($active) : ?>
          <div class="theme">
            <div class="row">
              <?php $tema_image = get_field('tema_image'); ?>
              <div class="tema-image">
                <img src="<?php echo $tema_image['sizes']["tema-image-large"]; ?>" alt="">
                <div class="tema-description body-copy">
                  <a class="post-label" href="<?php echo get_permalink(); ?>"><span class="bold">Tema</span> <?php the_title(); ?></a>
                  <h1><?php echo get_field('tema_header'); ?></h1>
                  <p><?php echo get_field('tema_description'); ?></p>
                </div>
              </div>
              <div class="tema-posts">
                <?php
                if( have_rows('tema_posts') ):
                  while ( have_rows('tema_posts') ) : the_row();
                    get_template_part( 'partials/tema', get_row_layout() );
                  endwhile;
                endif;
                ?>
              </div>
            </div>
          </div>
        <div class="more-wrapper"><a href="/tema" class="more-button">Läs fler teman</a></div>
      <?php endif; ?>
    <?php endwhile;?>
  <?php else: ?>
  <?php endif; ?>
</div>