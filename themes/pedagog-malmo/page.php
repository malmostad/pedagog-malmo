<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div id="container" class="clearfix">
	<div id="content" role="main">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			  <?php partial('entry-meta') ?>
        <div class="entry-wrapper">
          <div class="entry-content">
    				<h1 class="entry-title"><?php the_title(); ?></h1>
            <dl class="post-info">
              <dt>Publicerad</dt>
              <dd class="date"><?php the_date() ?></dd>
              <dd> av </dd>
              <dd class="author vcard"><?php echo author_name() ?></dd>
            </dl>
            <div class="article">
              <?php the_content(); ?>
            </div>
					  <?php edit_post_link( __( 'Edit', 'malmo' ), '<span class="edit-link">', '</span>' ); ?>
  				</div>
  			</div>
			</div>

			<?php comments_template( '', true ); ?>
    <?php endwhile; ?>

	</div>
</div>
<?php get_sidebar(); ?>
<?php partial('page-sidebar', array('show_related' => true)) ?>
<?php get_footer(); ?>
