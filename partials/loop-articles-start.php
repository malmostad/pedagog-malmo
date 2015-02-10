<?php $articles_loop = new WP_Query( array('post_type' => 'artiklar', 'posts_per_page' => 4, )); ?>
<div class="container">

    <?php if ( $articles_loop->have_posts() ) : ?>

    <?php $first_article = true; ?>

    <?php while ( $articles_loop->have_posts() ) : $articles_loop->the_post(); ?>

    <?php if ($first_article == true): ?>
      <div class="row">
        <article class="front-article-big">
        <div class="post-label">Senaste artikeln</div>
          <div class="front-article-image col-sm-5">
            <?php if ( has_post_thumbnail() ): //TODO: FALLBACK IF NO IMAGE?>
              <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('article-front') ?></a>
            <?php endif; ?>
          </div>
          <div class="front-article-big-text col-sm-7 body-copy">
            <h1><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h1>
            <p><a href="<?php echo get_permalink(); ?>"><?php the_excerpt(); ?></a></p>
            <div class="meta">
              <span class="article-date"><?php go_smartdate(); ?></span>
              <span class="categories bp-medium-up"> •
                <?php echo get_the_term_list( $articles_loop->post->ID, 'artikelkategorier', '', ', ','' ); ?>
              </span>
            </div>
          </div>
          <div class="clear"></div>
        </article>
      </div>
      <?php $first_article = false; ?>
      <div class="row front-article-small-wrapper"><!-- row 2 -->
    <?php else: ?>
      <article class="col-sm-4 front-article-small">
        <?php if ( has_post_thumbnail() ): //TODO: FALLBACK IF NO IMAGE?>
          <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('loop-image-large') ?></a>
        <?php endif; ?>
        <div class="body-copy content">
          <div class="post-label">Artikel</div>
          <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="meta">
            <span class="article-date"><?php go_smartdate(); ?></span>
            <!-- <span class="categories bp-medium-up"> •
              <?php echo get_the_term_list( $articles_loop->post->ID, 'artikelkategorier', '', ', ','' ); ?>
            </span> -->
          </div>
        </div>
      </article>
    <?php endif; ?>

    <?php endwhile;?>
    </div><!-- /row 2 -->
    <div class="more-wrapper"><a href="/artiklar" class="more-button">Läs fler artiklar</a></div>
  </div><!-- /container -->
<?php else: ?>
  <h1>Nä, nu har något blivit väldigt fel</h1>
<?php endif; ?>
<?php
?>