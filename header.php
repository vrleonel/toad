<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <title><?php 
    if (is_home () ) { 
      bloginfo('name'); 
    } elseif (is_category() || is_tag()) { 
      single_cat_title(); 
      echo ' &bull; ' ; bloginfo('name'); 
    } elseif (is_single() || is_page()) { 
      single_post_title(); 
    } else { 
      wp_title('',true); 
    } ?>
  </title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_enqueue_script('jquery'); ?>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/modernizr.js"></script>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="wrapper">
    <div id="container">
      <div	id="header" class="clearfix">
        <h1 class="align-left">
          <a href="/" alt="Home - toad.com.br" title="Home - toad.com.br">
            <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" width="350" alt="toad.com.br"/>
          </a>
        </h1>

        <div class="text align-left" >
          Seu checkpoint informativo com novidades tecnol&oacute;gicas, internet, universo geek e curiosidades!
        </div>


        <div class="align-right">
          <?php get_search_form( $echo ); ?>
        </div>
      </div>	

      <div id="nav">
        <?php wp_nav_menu( array('menu' => 'nav' )); ?>
      </div>

