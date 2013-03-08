<?php
/**
 * The template for displaying Search Results pages.
 */

get_header(); ?>

<div id="container" class="clearfix">
	<div id="content" role="main">
    <?php if ( have_posts() ) : ?>
      <div class="page-title clearfix">
		    <h1><?php printf( __( 'Search Results for: %s', 'malmo' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
      </div>

			<?php get_template_part( 'loop', 'search' ); ?>

    <?php else : ?>
      <div id="post-0" class="post no-results not-found">
      	<h2 class="entry-title"><?php _e( 'Nothing Found', 'malmo' ); ?></h2>
      	<div class="entry-content">
      		<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'malmo' ); ?></p>
      		<?php get_search_form(); ?>
      	</div>
      </div>
    <?php endif; ?>

	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
