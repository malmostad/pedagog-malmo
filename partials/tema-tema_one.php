<?php $flexposts = get_sub_field('tema_post');
  foreach ($flexposts as $flexpost ) :
    $flexpost_id = $flexpost->ID;
    $flexpost_title = $flexpost->post_title;
    $flexpost_content = $flexpost->post_content;
    $flexpost_excerpt = $flexpost->post_excerpt;
    $flexpost_date = $flexpost->post_date;
    $flexpost_author = $flexpost->post_author;
    $flexpost_type = $flexpost->post_type;
    $theme_blog = theme_blog_meta($flexpost_id);
?>
<div class="row tema_one">
  <div class="col-sm-6">
    <?php if ( $flexpost_type == 'artiklar' ) {
      echo '<div class="post-label">Artikel</div>';
    }else {
      $blog_name = get_the_terms( $flexpost_id, 'theme_blog' );
      if (gettype($blog_name) == 'array' && !empty($blog_name)) {
        $blog_name = array_slice($blog_name, 0,1);
        $blog_name = $blog_name[0]->name;
      }else {
        $blog_name = get_the_author_meta( 'display_name', $flexpost_author );
      }
      echo '<div class="blogs-label">' . $blog_name . '</div>';
    }
    ?>
    <div class="front-tema-post-image">
      <a href="<?php echo get_permalink($flexpost_id); ?>">
        <?php echo get_the_post_thumbnail( $flexpost_id, 'tema-image-front' ); ?>
      </a>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="content body-copy">
      <h2><a href="<?php echo get_permalink($flexpost_id); ?>"><?php echo $flexpost_title; ?></a></h2>
      <p><?php echo pedagog_custom_excerpt($flexpost_content, $flexpost_excerpt); ?></p>

      <div class="meta">
        <p>
          <span class="article-date"><?php go_smartdate(); ?></span>
          <span class="categories bp-medium-up"> • 
            <?php echo get_the_term_list( $flexpost_id, 'artikelkategorier', '', ', ','' ); ?>
            <?php echo get_the_term_list( $flexpost_id, 'category', '', ', ','' ); ?>
          </span>
        </p>
        <?php if ( $flexpost_type == 'post' ) { ?>
          <p>
            <span class="meta-author">
              <a href="<?php echo get_bloginfo('url') ?>/author/<?php the_author_meta('user_nicename', $flexpost_author); ?>">
                <?php echo get_avatar($flexpost_author , 24) ?>
                <?php the_author_meta('first_name', $flexpost_author); ?> <?php the_author_meta('last_name', $flexpost_author); ?>
              </a>
            </span>
          </p>
        <?php } ?>
      </div>

    </div>
  </div>
</div>

<!-- <pre>
<?php var_dump($flexpost); ?>
</pre> -->

<?php endforeach; ?>
