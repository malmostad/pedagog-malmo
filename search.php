<?php get_header(); ?>
<div class="wrapper">
	<main role="main">
		<section>
			<h2 class="body-copy search-results-header"><?php echo sprintf( __( '%s träffar på ', 'pedagog' ), $wp_query->found_posts ); echo get_search_query(); ?></h2>
      <div class="meta meta--center">Sida <?php echo intval(get_query_var('paged')); ?> av <?php echo  intval($wp_query->max_num_pages);
      ?></div>
      <div class="results">
			 <?php get_template_part('loop'); ?>
      </div>
			<?php get_template_part('pagination'); ?>
		</section>
	</main>
<?php get_footer(); ?>