<? get_header(); ?>	
<!-- /header -->	
<div class="clearfix" > 			
  <div id="slide-news">
    <? // include("slideshow.php"); ?>
    <? #include (ABSPATH . '/wp-content/plugins/coin-slider-4-wp/coinslider.php'); ?>
    <?php putKBSlider( "home"); ?>
  </div>	
</div>	
<!-- content -->
<div class="clearfix">
  <div id="content">
    <h3>Not&iacute;cias</h3>
    <!-- Start the Loop. -->

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class('clearfix post-list home-posts'); ?>>
        <!-- Thumb -->	
        <div class="post-thumb clearfix">	
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php
            if ( has_post_thumbnail() ) { 
              the_post_thumbnail(array('290', '290'));
            }
            ?>
          </a>
        </div>
        <!-- /Thumb -->
        <div class="excerpt">
          <!-- Display a comma separated list of the Post's Categories. -->
          <h3 class="postmetadata post-category">>> _<?php the_category(', _'); ?></h3>	
          <!-- Display the Title as a link to the Post's permalink. -->
          <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>	
          <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->

          <datetime><?php the_time('d'); echo " de "; the_time('F Y'); ?></datetime>

          <div class="entry home-entry">
            <?php the_excerpt(); ?>
          </div>
        </div>
      </div>
      <div class="navigation">
        <p><?php #posts_nav_link(); ?></p>
      </div>	
    <?php endwhile; else: ?>
      <p>Desculpe mas o que você procura não está aqui</p>		
      <!-- REALLY stop The Loop. -->			 
    <?php endif; ?>	
    <?php if (  $wp_query->max_num_pages > 1 ) : ?>			
      <div id="nav-below" class="navigation clear">			
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Posts Antigos', 'twentyten' ) ); ?></div>			
        <div class="nav-next"><?php previous_posts_link( __( 'Posts Novos <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>	
      </div>
      <!-- #nav-below -->
    <?php endif; ?>		
  
  </div>		
  <?php /* Display navigation to next/previous pages when applicable */ ?>

  <!-- sidebar -->		
  <? get_sidebar(); ?>
  <!-- /sidebar -->		

</div>
<!-- /content -->	

<? get_footer(); ?>