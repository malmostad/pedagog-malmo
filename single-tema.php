<?php get_header(); pedagog_set_post_views(get_the_ID()); ?>
  <main role="main">
    <section>
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('wrapper'); ?>>
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
      </article>
    <?php endwhile; ?>
    <?php else: ?>
      <article>
        <h1><?php _e( 'Sorry, nothing to display.', 'pedagog' ); ?></h1>
      </article>
    <?php endif; ?>
    </section>
  </main>
  <?php get_footer(); ?>