<?php
/**
 * Template Name: Temabloggar
 */
get_header(); ?>
<div class="wrapper">
  <main role="main">
    <?php get_template_part('partials/blogs', 'header');  ?>
    <section class="blogs-list">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
           <?php $theme_blogs = get_from_db('blogs');
            foreach ( $theme_blogs as $theme_blog ) :
              $images = get_tax_meta( $theme_blog->term_id, 'profile_image');
              if (!empty($images[id])) {
                $image = get_image_tag( $images[id], false, false, false, 'article-front');
              }else {
                $image = false;
              }
              ?>
              <article class="blog-item loop-item loop-item--themeblog <?php echo $class ?>">
                <div class="row">
                  <div class="col-xs-3 blog-image">
                    <a class="blogs-label" href="<?php echo get_bloginfo('url') . '/' . $theme_blog->taxonomy . '/' . $theme_blog->slug ?>"> <?php echo  $theme_blog->name ?></a>
                    <a href="<?php echo get_bloginfo('url') ?>/theme_blog/<?php echo $theme_blog->slug ?>"><?php echo $image ?></a>
                  </div>
                  <div class="col-xs-9 theme-blog-info content body-copy">
                    <h2><a href="<?php echo get_bloginfo('url') ?>/theme_blog/<?php echo $theme_blog->slug ?>"><?php echo $theme_blog->name ?></a></h2>
                    <p><?php echo $theme_blog->description ?></p>
                    <div class="meta">
                      <p><?php echo $theme_blog->count ?> inlägg</p>
                    </div>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
