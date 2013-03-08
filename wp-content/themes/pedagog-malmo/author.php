<?php
/**
 * The template for displaying Author Archive pages.
 */
get_header(); ?>

<div id="container" class="clearfix">
  <div id="content" role="main">
    <?php
      if ( have_posts() ) the_post();
      partial( 'blog-header', array( 'force_personal' => true ) );

      // If a user has filled out their description, show a bio on their entries.
      if ( get_the_author_meta( 'description' ) ) : ?>
        <div id="entry-author-info">
          <div class="author-image">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'malmo_author_bio_avatar_size', 130 ) ); ?>
          </div>

          <div class="author-description">
            <h2>Om <?php echo author_name() ?></h2>
            <p><?php the_author_meta( 'description'); ?></p>
          </div>
        </div>
        <?php
      endif;
      rewind_posts();
      get_template_part( 'loop', 'featured_image' );
    ?>
  </div>
</div>
<?php get_sidebar(); ?>
<?php partial('subscribe') ?>
<?php get_footer(); ?>
