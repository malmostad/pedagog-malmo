<?php
  $force_personal = isset($force_personal) && !empty($force_personal) ? true : false; 
  $theme_blog = theme_blog_meta( $post->ID );

  if ( $theme_blog && !$force_personal ) {
    $name = "Temabloggen " . $theme_blog[0]->name;
    $link = "/theme_blog/" . $theme_blog[0]->slug;
  }
  else {
    $name = author_name();
    $name .= substr($name, -1) == 's' ?  " blogg" : "s blogg";
    $link = '/author/' . get_the_author_meta('user_nicename');
  }
?>
<h1 class="page-title">
  <a class="feed-link" href="./feed">
    <img src="<?php echo get_template_directory_uri() . '/images/feed.png' ?>" alt="RSS-flöde" />
  </a>
  <a href="<?php echo get_bloginfo('url') . $link ?>">
    <?php echo $name ?>
  </a>
</h1>
