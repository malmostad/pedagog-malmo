<?php get_header(); pedagog_set_post_views(get_the_ID()); ?>
	<main role="main">
    <section>
  	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
  		<article id="post-<?php the_ID(); ?>" <?php post_class('wrapper'); ?>>
        <header class="single-header">
    			<h1><?php the_title(); ?></h1>
    			<div class="meta single-meta">
    				<span class="date"><?php go_smartdate(); ?></span>
    			  <span class="article-categories">
              <?php echo get_the_term_list( $articles_loop->post->ID, 'artikelkategorier', '', ', ','' ); ?>
            </span>
            <?php if(is_singular('post')) go_author(); ?>
    			</div>
    			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
    				<div class="article-featureimage"><?php the_post_thumbnail('tema-image-large'); ?></div>
    			<?php endif; ?>
        </header>
  			<div class="single-content">
  				<div class="single-content-inner">
            <div class="body-copy">
    					<?php the_content(); ?>
            </div>
            <?php if(is_single()) go_author('Skrivet av'); ?>
            <?php echo do_shortcode('[ssba]'); ?>
            <?php comments_template(); ?>
  				</div>
  				<?php if( have_rows('tema_posts') ): ?>
  					<?php $tema_image = get_field('tema_image'); ?>
    				<div class="tema-image">
                <img src="<?php echo $tema_image['sizes']["tema-image-large"]; ?>" alt="">
                <div class="tema-description">
                  <a class="post-label" href="<?php echo get_permalink(); ?>"><span class="bold">Tema</span> <?php the_title(); ?></a>
                  <h2><?php echo get_field('tema_header'); ?></h2>
                  <p><?php echo get_field('tema_description'); ?></p>
                </div>
              </div>
              <?php while ( have_rows('tema_posts') ) : the_row();
                get_template_part( 'partials/tema', get_row_layout() );
              endwhile;
              endif;
            ?>
  			</div>
        <?php yarpp_related(); ?>
  		</article>
  	<?php endwhile; ?>
  	<?php else: ?>
  		<article>
  			<h1><?php _e( 'Sorry, nothing to display.', 'pedagog' ); ?></h1>
  		</article>
  	<?php endif; ?>
  	</section>
	</main>
<?php get_footer(); ?>
