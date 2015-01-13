<p id="filter-categories" class="filter-categories">Filtrera</p>
<ul class="archive-categories">
  <?php
    $authors = $wpdb->get_results("SELECT users.ID, users.user_login FROM users WHERE users.user_login != 'admin' ORDER BY users.display_name");
    $i = 1;
    foreach ($authors as $author) {
      $number_of_posts = count_user_posts( $author->ID );
      if ($number_of_posts !== "0") {
  ?>
  <li <?php if ( $i % 4 === 0 ) { echo "class='last-on-row'"; } ?>>
    <!--<a href="<?php echo get_bloginfo('url') ?>/?author=<?php echo $author->ID  ?>"><?php echo get_avatar($author->ID , 150) ?></a> -->
    <a href="<?php echo get_bloginfo('url') ?>/?author=<?php echo $author->ID  ?>"><?php echo author_name($author->ID ) ?> (<?php echo $number_of_posts ?>)</a>
  </li>
  <?php $i++; } } ?>
</ul>