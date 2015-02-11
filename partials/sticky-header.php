<div id="sticky-header" class="sticky-header-wrapper sticky-header--hidden">
  <div class="sticky-header">
    <a href="<?php echo home_url(); ?>">
      <img class="logo-img" src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Pedagog Malmö">
    </a>
    <nav class="main-nav" role="navigation">
      <?php pedagog_nav(); ?>
    </nav>
    <div class="search-area">
      <?php get_template_part('searchform'); ?>
    </div>
  </div>
</div>