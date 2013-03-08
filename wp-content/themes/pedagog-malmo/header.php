<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Malmo_Theme
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->
<title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $page, $paged, $mconfig;

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
      echo "$site_description - ";

  // Add a page number if necessary:
  // if ( $paged >= 2 || $page >= 2 )
  //     echo ' - ' . sprintf( __( 'Page %s', 'malmo' ), max( $paged, $page ) );

  wp_title( '-', true, 'right' );

  // Add the blog name.
  bloginfo( 'name' );

  ?></title>
<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href="<?php echo $mconfig['asset_host'] ?>css/external-core.css" rel="stylesheet" media="all" />
<link href="<?php echo $mconfig['asset_host'] ?>css/malmo-print.css" rel="stylesheet" media="print" />
<link href="<?php echo $mconfig['asset_host'] ?>jquery/malmo-theme.css" rel="stylesheet" media="all" />
<!--[if IE 7]><link href="<?php echo $mconfig['asset_host'] ?>css/malmo-ie7-css-fix.css" rel="stylesheet"media="all" /><![endif]-->
<link rel="shortcut icon" href="<?php echo $mconfig['asset_host'] ?>img/malmo-favicon.ico" type="image/x-icon" />
<script src="<?php echo $mconfig['asset_host'] ?>jquery/jquery.js"></script>
<script src="<?php echo $mconfig['asset_host'] ?>js/malmo.js"></script>
<script src="<?php echo $mconfig['asset_host'] ?>js/external.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/scripts.js"></script>
<script src="//apis.google.com/js/plusone.js">{lang: 'sv', parsetags: 'explicit'}</script>
<script src="//platform.twitter.com/widgets.js"></script>
<?php
  /* We add some JavaScript to pages with the comment form
   * to support sites with threaded comments (when in use).
   */
  if ( is_singular() && get_option( 'thread_comments' ) )
      wp_enqueue_script( 'comment-reply' );

  wp_head();
?>
</head>
<body <?php body_class(); ?>>
<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'malmo' ); ?>"><?php _e( 'Skip to content', 'malmo' ); ?></a></div>
<div class="wrap-all wp komin">
<?php echo Malmo::getRemoteContent('remote/external-masthead/?node=blogg'); ?>
<div class="main">
<div class="columns-1">
<div class="content-wrapper">
<div class="content-wrapper-1">
<div class="content-wrapper-2">
<div class="content-wrapper-3">
<div class="content-wrapper-4">
<div class="content-wrapper-5">
<div class="content-wrapper-6">
<div class="pagecontent">

<div id="sub-masthead" class="clearfix">
  <div id="main-title">
    <a href="<?php bloginfo('url'); ?>">
      <img src="<?php echo get_template_directory_uri() . '/images/logo.png' ?>"  height="34" width="274"  alt="Pedagog Malmö" />
    </a>
  </div>
  <?php 
    wp_nav_menu( array( 'menu' => 'Top Menu', 'menu_id' => 'top-menu', 'menu_class' => 'clearfix', 'container' => 'false',  'depth' => 1 ) ); 
  ?>
</div>
