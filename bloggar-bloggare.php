<?php
/**
 * Template Name: Bloggare
 */
get_header(); ?>
<div class="wrapper">
  <main role="main">
    <?php get_template_part('partials/blogs', 'header');  ?>
    <section class="blogs-list">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <?php $authors = get_from_db('authors');
            foreach ($authors as $author): ?>
              <?php $number_of_posts = count_user_posts( $author->ID ); ?>
              <?php if($number_of_posts > 0 ) : ?>
              <article class="blog-item loop-item loop-item--themeblog <?php echo $class ?>">
                <div class="row">
                  <div class="col-xs-3 blog-image">
                    <a class="blogs-label" href="<?php echo get_bloginfo('url') ?>/author/<?php the_author_meta('user_nicename', $author->ID); ?>"><?php echo author_name($author->ID ) ?></a>
                    <a href="<?php echo get_bloginfo('url') ?>/author/<?php the_author_meta('user_nicename', $author->ID); ?>"><?php echo get_avatar($author->ID , 512) ?></a>
                  </div>
                  <div class="col-xs-9 theme-blog-info content body-copy">
                    <h2><a href="<?php echo get_bloginfo('url') ?>/author/<?php the_author_meta('user_nicename', $author->ID); ?>"><?php echo author_name($author->ID ) ?></a></h2>
                    <?php $the_description = wpautop( get_the_author_meta('description', $author->ID) ); ?>
                    <p>
                      <?php echo pedagog_custom_excerpt($the_description, false, 70); ?>
                    </p>
                    <div class="meta">
                      <p><?php echo $number_of_posts ?> inlägg</p>
                    </div>
                  </div>

                </div>
              </article>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php get_footer(); ?>