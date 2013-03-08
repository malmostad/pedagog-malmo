<?php
/**
 * The Template for displaying single posts
 */
get_header(); ?>

<div id="container" class="clearfix">
  <div id="content" role="main">
  <?php if ( have_posts() )  the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php
        partial('blog-header', array('post' => $post));
        partial('entry-meta') 
      ?>

      <div class="entry-wrapper">
        <div class="entry-content">
          <h2 class="entry-title"><?php the_title(); ?></h2>
          <dl class="post-info">
            <dt>Publicerad av</dt>
            <dd class="author vcard"><?php posted_by(); ?></dd>
            <dd class="date"><?php the_date() ?></dd>
          </dl>
          <?php the_content(); ?>
          <div class="taxonomy">
            <p>Kategorier: <?php posted_categories(); ?></p>
            <p>Etiketter: <?php posted_tags(); ?></p>
          </div>
          <div class="entry-edit">
            <?php edit_post_link( __( 'Edit', 'malmo' ) ); ?>
          </div>
          <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'malmo' ), 'after' => '</div>' ) ); ?>
        </div>
      </div>
    </div>

    <div id="nav-below" class="navigation">
      <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'malmo' ) . '</span> %title' ); ?></div>
      <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'malmo' ) . '</span>' ); ?></div>
    </div>

    <?php comments_template( '', true ); ?>

  </div>
</div>

<?php get_sidebar(); ?>
<?php partial('subscribe') ?>
<?php partial('post-sidebar', array('post' => $post )) ?>
<?php get_footer(); ?>

