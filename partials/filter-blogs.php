<?php /* echo get_the_categories('category'); */ ?>
      <ul class="archive-categories">
        <?php
          $theme_blogs = $wpdb->get_results("SELECT t.* , tt.* FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy = 'theme_blog' ORDER BY t.name");
          $i = 1;
          foreach ( $theme_blogs as $theme_blog ): ?>
            <li>
              <a href="<?php echo get_bloginfo('url') ?>/theme_blog/<?php echo $theme_blog->slug ?>"><?php echo $theme_blog->name ?> (<?php echo $theme_blog->count ?>)</a>
            </li>
          <?php $i++; endforeach; ?>
      </ul>