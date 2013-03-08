<?php get_header(); ?>
<div id="container" class="clearfix">
  <div id="content" role="main">

    <div class="col-1">
      <div class="new-contents clearfix">
        <h2>
          <a href="<?php echo get_bloginfo('url') . '/artiklar' ?>">Aktuella artiklar</a>
        </h2>
        <?php partial('featured-articles', array('post' => $post)) ?>
        <p class="read-more"><a href="<?php echo get_bloginfo('url') . '/artiklar/' ?>">Alla artiklar</a></p>
      </div>

      <div class="calendar clearfix">
        <h2>Kalendarium</h2>
        <?php if ( is_active_sidebar( 'home-calendar-widget-area' ) ) : ?>
          <div id="home-calendar-widget-area" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'home-calendar-widget-area' ); ?>
          </div>
        <?php endif; ?>
        <p class="read-more"><a href="<?php echo get_bloginfo('url') . '/kalendarium/' ?>">Alla händelser</a></p>
      </div>
    </div>

    <div class="col-2">
      <?php if ( is_active_sidebar( 'home-top-1-widget-area' ) ) : ?>
        <div id="home-top-1-widget-area" class="widget-area" role="complementary">
          <ul class="clearfix">
            <?php dynamic_sidebar( 'home-top-1-widget-area' ); ?>
            <li><p  class="read-more"><a href="http://webapps2.malmo.se/pedagogmalmo/filmer/">Alla filmer</a></p></li>
          </ul>
        </div>
      <?php endif; ?>
      <?php if ( is_active_sidebar( 'home-top-2-widget-area' ) ) : ?>
        <div id="home-top-2-widget-area" class="widget-area" role="complementary">
          <ul>
            <?php dynamic_sidebar( 'home-top-2-widget-area' ); ?>
          </ul>
        </div>
      <?php endif; ?>

      <div class="blogs">
        <div class="loop">
          <h2>
            <a class="blog-feed" href="<?php bloginfo('rss2_url') ?>">
              <img src="<?php echo get_template_directory_uri() . '/images/feed-18.png' ?>" alt="RSS-flöde" />
            </a>
            <a href="<?php echo get_bloginfo('url') . '/bloggar' ?>">Bloggar för Pedagog Malmö</a>
          </h2>
          <?php get_template_part( 'loop', 'home' ); ?>
          <p class="read-more"><a href="<?php echo get_bloginfo('url') . '/bloggar/' ?>">Alla bloggar</a></p>
        </div>

        <?php if ( is_active_sidebar( 'home-blogs-1-widget-area' ) ) : ?>
          <div id="home-blogs-1-widget-area" class="widget-area" role="complementary">
            <ul>
              <?php dynamic_sidebar( 'home-blogs-1-widget-area' ); ?>
            </ul>
          </div>
        <?php endif; ?>
        <?php if ( is_active_sidebar( 'home-blogs-2-widget-area' ) ) : ?>
          <div id="home-blogs-2-widget-area" class="widget-area" role="complementary">
            <ul>
              <li>
                <?php dynamic_sidebar( 'home-blogs-2-widget-area' ); ?>
              </li>
            </ul>
          </div>
        <?php endif; ?>
      </div>

      <div class="recommended">
        <?php if ( is_active_sidebar( 'home-links-widget-area' ) ) : ?>
          <div id="home-links-widget-area" class="widget-area" role="complementary">
            <ul>
              <?php dynamic_sidebar( 'home-links-widget-area' ); ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
