<div class="row border-bottom">
    <?php $flexposts = get_sub_field('tema_post_three'); $i = 0;?>
    <?php
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
      <?php if ($i == 0): ?>
        <div class="border-right col-sm-6">
      <?php elseif ($i == 1): ?>
        <div class="front-tema-post col-sm-6">
      <?php elseif ($i == 2): ?>
        <div class="border-top front-tema-post col-sm-6 ">
      <?php endif; ?>

      <?php 
      if ( $flexpost_type == 'artiklar' ) {
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
 
      if ($i == 0) {
        ?><div class="front-tema-post-image"><?php
        echo get_the_post_thumbnail( $flexpost_id, 'tema-image-front' );
        ?></div><?php
      }

      if ($i == 0) { ?>
        <div class="front-tema-post">
      <?php } ?>

      <div class="body-copy">
        <h2><a href="<?php echo get_permalink($flexpost_id); ?>"><?php echo $flexpost_title; ?></a></h2>
        <p><?php echo pedagog_custom_excerpt($flexpost_content, $flexpost_excerpt); ?></p>
      </div>

      <?php if ( $flexpost_type == 'post' ) { ?>
      <div class="meta">
        <span class="author">
          <a href="<?php echo get_bloginfo('url') ?>/?author=<?php echo $authorID ?>">
            <?php echo get_avatar($flexpost_author , 24) ?>
            <?php echo author_name($flexpost_author) ?>
          </a>
        </span>
      </div>
      <?php } ?>
      
      <?php if ($i == 0): ?>
        </div>
      <?php endif ?>
      <!--COL -->
    </div>


      <?php $i++; ?>
    <?php endforeach; ?>
</div>
