<?php
/**
 *
 * Template Name: Fullbredd
 *
 * Full width without a sidebar
 *
 */

get_header(); ?>
<div id="container" class="clearfix">
	<div id="content" role="main">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( is_front_page() ) { ?>
					<h2 class="entry-title"><?php the_title(); ?></h2>
				<?php } else { ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php } ?>

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'malmo' ), 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'malmo' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-## -->

      <?php  if ( is_active_sidebar( 'calendar-on-page-widget-area' ) ) : ?>
        <div id="calendar-on-page" class="widget-area" role="complementary">
          <ul>
            <?php dynamic_sidebar( 'calendar-on-page-widget-area' ); ?>
          </ul>
        </div>
      <?php endif; ?>
			<?php comments_template( '', true ); ?>
    <?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #container -->
<?php get_footer(); ?>
