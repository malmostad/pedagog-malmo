<?php
/**
 * Template Name: Bloggare
 */
get_header(); ?>
<div id="container" class="clearfix">
  <div id="content" role="main">
    <?php if ( have_posts() ) the_post(); ?>
    <h1 class="entry-title">Bloggar för Pedagog Malmö</h1>
    <?php if ( have_posts() ) the_post(); ?>
    <?php the_content(); ?>
    <?php wp_nav_menu( array( 'menu' => 'Bloggar', 'menu_id' => 'blog-menu', 'menu_class' => 'clearfix', 'container' => 'false',  'depth' => 1 ) ) ?>   
    <div class="bloggers">

      <ul>
        <?php
          $authors = $wpdb->get_results("SELECT users.ID, users.user_login FROM users WHERE users.user_login != 'admin' ORDER BY users.display_name");
          $i = 1;
          foreach ($authors as $author) {
            $number_of_posts = count_user_posts( $author->ID );
            if ($number_of_posts !== "0") {
        ?>
          <li <?php if ( $i % 4 === 0 ) { echo "class='last-on-row'"; } ?>>
            <a href="<?php echo get_bloginfo('url') ?>/?author=<?php echo $author->ID  ?>"><?php echo get_avatar($author->ID , 150) ?></a>
            <p><a href="<?php echo get_bloginfo('url') ?>/?author=<?php echo $author->ID  ?>"><?php echo author_name($author->ID ) ?></a> (<?php echo $number_of_posts ?>)</p>
          </li>
        <?php $i++; } } ?>
      </ul>
    </div>

  </div>
</div>
<?php get_sidebar(); ?>
<?php partial('subscribe') ?>
<?php if ( is_active_sidebar( 'latest-post-page' ) ) : ?>
  <div id="latest-post-page" class="post-sidebar widget-area" role="complementary">
    <ul>
      <li class="theme-categories">
        <ul>
        <?php dynamic_sidebar( 'latest-post-page' ); ?>
        </ul>
      </li>
    </ul>
  </div>
<?php endif; ?>
<?php get_footer(); ?>
