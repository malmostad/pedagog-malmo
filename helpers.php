<?php
function articleCategories($ID){
  ?>
  <span class="article-categories">
    <?php echo get_the_term_list( $ID, 'artikelkategorier', '', ', ','' ); ?>
  </span>
  <?php
}
function go_smartdate(){
  ?>
  <span class="date">
  <?php
  $ageunix = get_the_time('U');
  $days_old_in_seconds = ((time() - $ageunix));
  $days_old = (($days_old_in_seconds/86400));
  if ($days_old > 60){
    the_time('F j, Y, G:i');
  }else{
    echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ', ' . get_the_time('G:i');
  }
  ?></span><?php
}
function go_author($text = ''){
  ?>
  <span class="meta-author">
    <?php echo $text; ?> 
    <a href="<?php echo get_bloginfo('url') ?>/author/<?php the_author_meta('user_nicename'); ?>">
      <?php echo get_avatar(get_the_author_ID() , 24) ?>
      <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?>
    </a>
  </span>
  <?php
}
/**
 * Fetch the correct label that's displayed on every article/blog post.
 * @return [type] [description]
 */
function get_the_label() {
  global $post;
  if ( $post->post_type == 'artiklar' ) {
    return '<div class="post-label">Artikel</div>';
  }else {
    $theme_blog = theme_blog_meta($post->ID);
    if (!empty($theme_blog[0]->name)){
      return '<div class="blogs-label"><a href="' . get_bloginfo('url') . '/theme_blog/' . $theme_blog[0]->slug . '">' . $theme_blog[0]->name . '</a></div>';
    }else {
      return '<div class="blogs-label"><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author_meta('display_name') . '</a></div>';
    }
  }
}
?>