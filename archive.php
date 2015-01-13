<?php get_header(); ?>
<div class="wrapper">
	<main role="main">
		<section>
			<h1><?php _e( 'Archives', 'pedagog' ); ?></h1>
			<?php get_template_part('loop'); ?>
			<?php get_template_part('pagination'); ?>
		</section>
	</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
