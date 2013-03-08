<?php
/**
 * Template Name: Utan delning
 * Wide main column w/out social sharing
 */
get_header(); ?>
<div id="container" class="clearfix">
	<div id="content" role="main">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-wrapper wide">
          <div class="entry-content">
    				<h1 class="entry-title"><?php the_title(); ?></h1>
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
<?php get_footer(); ?>
