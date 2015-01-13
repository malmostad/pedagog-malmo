<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
    <?php global $mconfig; ?>
    <link rel="icon" type="image/x-icon" href="<?php echo $mconfig['asset_host'] ?>favicon.ico"/>
    <!--[if lte IE 7]><link href="<?php echo $mconfig['asset_host'] ?>legacy/ie7.css" rel="stylesheet" type="text/css"/><![endif]-->
    <script>var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";</script>
    <?php wp_head(); ?>
    <!--[if lte IE 8]>
      <script src="<?php echo $mconfig['asset_host'] ?>html5shiv-printshiv.js" type="text/javascript"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//platform.twitter.com/widgets.js"></script>
    <!-- <script src="//apis.google.com/js/plusone.js">{lang: 'sv', parsetags: 'explicit'}</script> -->
    <script src="https://apis.google.com/js/platform.js" async defer>{lang: 'sv'}</script>
	</head>
	<body <?php body_class(); ?>>
		<header class="header clear" role="banner">
      <div class="wrapper-inner container">
        <div class="row">
					<div class="logo col-md-4">
						<a href="<?php echo home_url(); ?>">
							<img class="logo-img" src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Pedagog Malmö">
						</a>
					</div>
					<nav class="main-nav col-md-8" role="navigation">
						<?php pedagog_nav(); ?>
					</nav>
        </div>
      </div>
    </header>
      <div class="sub-header">
        <div class="wrapper-inner container">
          <div class="row">
            <div class="site-slogan col-sm-8">
              <h3><?php get_sub_header_text(); ?></h3>
            </div>
            <div class="search-area col-sm-4">
              <?php get_template_part('searchform'); ?>
            </div>
          </div>
        </div>
      </div>