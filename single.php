<? get_header() ?>
<!-- /header -->
<div class="clearfix" > 			
  <div id="slide-news">
    <? // include("slideshow.php"); ?>
    <?include (ABSPATH . '/wp-content/plugins/coin-slider-4-wp/coinslider.php'); ?>
  </div>	
</div>	

<!-- content -->
<div class="clearfix" > 	
  <div id="content" >
    <h3><? is_home() ? "Not&iacute;cias" : single_cat_title() ?></h3>
    <!-- Start the Loop. -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <!-- The following tests if the current post is in category 3. -->
      <!-- If it is, the div box is given the CSS class "post-cat-three". -->
      <!-- Otherwise, the div box will be given the CSS class "post". -->

      <div id="post-<?php the_ID(); ?>" <?php post_class('clearfix post-list'); ?>>
        <div class="comment-square"><?php comments_popup_link('0', '1', '%'); ?></div>					
        
        <!-- Display a comma separated list of the Post's Categories. -->
        <h3 class="postmetadata post-category"><?php the_category(', '); ?></h3>
        
        <!-- Display the Title as a link to the Post's permalink. -->
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

        <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
        <datetime><?php the_time('d'); echo " de "; the_time('F Y') ?></datetime>

        <!-- Display the Post's Content in a div box. -->
        <div class="entry">
          <?php the_content(); ?>
        </div>

      </div> <!-- closes the first div box -->
      <div class="navigation"><p><?php posts_nav_link(); ?></p></div>
      <!-- Stop The Loop (but note the "else:" - see next line). -->
    <?php endwhile; else: ?>

      <!-- The very first "if" tested to see if there were any Posts to -->
      <!-- display.  This "else" part tells what do if there weren't any. -->
      <p>Desculpe mas o que você procura não está aqui!.</p>

      <!-- REALLY stop The Loop. -->
    <?php endif; ?>


    <nav id="nav-single">
      <span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Anterior', 'twentyeleven' ) ); ?></span>
      <span class="nav-next"><?php next_post_link( '%link', __( 'Pr&oacute;ximo <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
    </nav><!-- #nav-single -->

  </div>				
  <!-- sidebar -->
  <? get_sidebar(); ?>
  <!-- /sidebar -->
</div>
<!-- /content -->


<? get_footer(); ?>