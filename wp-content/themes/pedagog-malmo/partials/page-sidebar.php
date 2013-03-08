<?php
  $show_related = isset($show_related) ? $show_related : true;
  $show_categories = isset($show_categories) ? $show_categories : true;
?>
<div class="page-sidebar widget-area" role="complementary">
  <ul>
    <?php
    if ($show_related) :
      // Get some articles in the same categories
      // Page Categpries the page belongs to
      $catsIds = array();
      $cats = get_the_terms( $post->ID, 'page_categories' );
      if (count($cats) > 1) {
        foreach ($cats as $cat) {
          $catsIds[] = $cat->term_id;
          $plural = 'er';
        }
      } else {
        $catsIds[] = $cats[0]->term_id;
        $plural = '';
      }
      // Get the articles
      $limit = 11;
      $inSameCat = query_posts(array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'orderby'   => 'post_date',
        'order' => 'DESC',
        'post__not_in' => array($post->ID),
        'posts_per_page' => $limit,
      	'tax_query' => array(
      		array(
            'taxonomy' => 'page_categories',
            'terms' => $catsIds,
            'field' => 'term_id'
      		)
      	)
      ));
      // Hack to see if we have even more articles
      if (count($inSameCat) > $limit + 1) :
        $more = array_pop($inSameCat);
      endif;
      if ($inSameCat): ?>
        <li class="related-categories">
          <h2 class="widget-title">Artiklar i samma kategori<?php echo $plural ?></h2>
          <ul>
            <?php foreach ($inSameCat as $item) : ?>
              <li>
                <a href="<?php echo get_permalink($item->ID) ?>">
                  <?php echo $item->post_title; ?>
                </a>
                <span class="date">(<?php echo substr($item->post_date, 0, 10) ?>)</span>
              </li>
            <?php endforeach; ?>
            <?php if(!empty($more)): ?>
              <li class="show-more">
                <a href="#">Visa fler</a>
              </li>
            <?php endif; ?>
          </ul>
        </li>
      <?php endif;
      endif; ?>

    <?php if ($show_categories) : ?>
      <li class="article-categories">
        <h2 class="widget-title">Artikelkategorier</h2>
        <ul>
        <?php 
          foreach (get_terms("page_categories") as $term) {
            printf('<li><a href="%1$s/page_categories/%2$s">%3$s</a> (%4$s)</li>',
              get_bloginfo('url'),
              $term->slug,
              $term->name,
              $term->count);
          } 
        ?>
        </ul>
      </li>
    <?php endif; ?>
  </ul>
</div>
