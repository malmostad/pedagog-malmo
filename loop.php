<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<?php get_template_part( 'partials/loopitem', 'post' ); ?>
<?php endwhile; ?>
<?php else: ?>
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'pedagog' ); ?></h2>
	</article>
<?php endif; ?>
