<?php get_header(); ?>
<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
			<main role="main">
				<section class="single-page body-copy">
					<h1><?php the_title(); ?></h1>
					<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
						<br class="clear">
						<?php edit_post_link(); ?>
					</article>
					<?php endwhile; ?>
					<?php else: ?>
					<article>
						<h2><?php _e( 'Sorry, nothing to display.', 'pedagog' ); ?></h2>
					</article>
				<?php endif; ?>
				</section>
			</main>
			</div>
			<div class="col-sm-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
