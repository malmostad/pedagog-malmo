<?php $theme_blog_meta = theme_blog_meta( $post->ID ); ?>

<div class="post-sidebar widget-area" role="complementary">
  <ul>
    <?php if ( !$theme_blog_meta ) { ?>
      <li class="author-meta">
        <h3 class="widget-title"><?php echo author_name(); ?></h3>
        <div class="author-avatar">
          <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'malmo_author_bio_avatar_size', 130 ) ); ?>
          </a>
        </div>
        <?php if ( get_the_author_meta( 'description' ) ): ?>
          <p><?php the_author_meta( 'description' ); ?></p>
        <?php endif; ?>
      </li>
    <?php } ?>

    <?php $related = get_related_posts(get_the_category(), get_the_author_meta( 'ID' ), $post->ID, 10, true); ?>

    <?php if ($related['by_author']): ?>
      <li class="related-author">
        <h3 class="widget-title">Mer av samma bloggare</h3>
        <ul>
          <?php foreach ($related['by_author'] as $item ): ?>
            <li>
              <a href="<?php echo get_permalink($item->ID) ?>">
                <?php echo $item->post_title; ?>
              </a>
              <span class="date">(<?php echo substr($item->post_date, 0, 10) ?>)</span>
            </li>
        <?php endforeach; ?>
        </ul>
      </li>

      <?php if ($related['in_categories']): ?>
        <li class="related-categories">
          <h3 class="widget-title">Mer i samma kategorier</h3>
          <ul>
            <?php foreach ($related['in_categories'] as $item ): ?>
              <li>
                <a href="<?php echo get_permalink($item->ID) ?>">
                  <?php echo $item->post_title; ?>
                </a>
                <span class="date">(<?php echo substr($item->post_date, 0, 10) ?>)</span>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ( $theme_blog_meta  ) : // Only if it is a "theme blog" ?>
      <li class="theme-categories">
        <h3 class="widget-title">Temabloggar</h3>
        <ul>
          <?php wp_list_categories( 'taxonomy=theme_blog&title_li=&show_count=1' ) ?>
        </ul>
      </li>
    <?php endif; ?>

  </ul>
</div>
