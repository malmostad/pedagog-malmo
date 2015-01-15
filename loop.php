<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<?php get_template_part( 'partials/loopitem', 'post' ); ?>
<?php endwhile; ?>
<?php endif; ?>
