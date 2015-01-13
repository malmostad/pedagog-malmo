<?php get_header(); ?>
<div class="wrapper">
	<main role="main">
		<section>
			<?php if (have_posts()): the_post(); ?>
			<div class="container">
				<div class="row">
					<div class="col-sm-3 blogger-info">
            <h3 class="label body-copy">Om mig</h3>
						<?php if ( get_the_author_meta('description')) : ?>
							<?php echo get_avatar(get_the_author_meta('user_email'), 512); ?>
							<div class="blog-details">
								<?php echo wpautop( get_the_author_meta('description') ); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-sm-9">
						<?php rewind_posts(); while (have_posts()) : the_post(); ?>
							<?php get_template_part( 'partials/loopitem', 'post' ); ?>
						<?php endwhile; ?>
						<?php if( !class_exists('AjaxLoadMore') ): ?>
              <?php get_template_part('pagination'); ?>
            <?php endif; ?>
            <?php $autorID = get_the_author_meta('ID')?>
            <?php echo do_shortcode('[ajax_load_more seo="true" post_type="post" author="' . $autorID .'" offset="8" posts_per_page="8" max_pages="none" pause="true" scroll="false" button_label="Ladda mer"]'); ?>
					</div>
				</div>
			</div>
			<?php else: ?>
				<article class="loop-item">
					<h2>Det finns inga poster</h2>
				</article>
			<?php endif; ?>
		</section>
	</main>
	<?php get_footer(); ?>