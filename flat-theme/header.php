<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/html5shiv.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/respond.min.js"></script>
<![endif]-->       
<?php zee_favicon();?>
<?php wp_head(); ?>
</head><!--/head-->

<body <?php body_class() ?>>
  <?php if(zee_option('zee_theme_layout')=='boxed'){ ?>
    <div id="boxed">
  <?php } ?>

  <header id="header" class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only"><?php _e('Toggle navigation', ZEETEXTDOMAIN); ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php logo();?>
      </div>

      <div class="hidden-xs">
        <?php 
        if ( has_nav_menu( 'primary' ) ) {
          wp_nav_menu( array(
            'theme_location'  => 'primary',
            'container'       => false,
            'menu_class'      => 'nav navbar-nav navbar-main',
            'fallback_cb'     => 'wp_page_menu',
            'walker'          => new wp_bootstrap_navwalker()
            )
          ); 
        }
        ?>
      </div>

      <div id="mobile-menu" class="visible-xs">
        <div class="collapse navbar-collapse">
          <?php 
          if ( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array(
              'theme_location'  => 'primary',
              'container'       => false,
              'menu_class'      => 'nav navbar-nav',
              'fallback_cb'     => 'wp_page_menu',
              'walker'          => new wp_bootstrap_mobile_navwalker()
              )
            ); 
          }
          ?>
        </div>
      </div><!--/.visible-xs-->
    </div>
  </header><!--/#header-->

  <?php get_template_part( 'sub', 'title' ); ?>

  <?php if( ! is_page() ) { ?>
  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div id="primary" class="content-area">
            <?php } ?>

