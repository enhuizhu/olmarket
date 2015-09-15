<?php
/**
*Template Name: Portfolios
**/
get_header();
?>

<div class="container">
    
  <div class="col-sm-3 col-md-3 col-lg-3">
  
   <?php include "contents/portfoliosSideBar.php"; ?>
  
  </div>
  
  <div class="col-sm-9 col-md-9 col-lg-9">

    <div class="list-item">
       
       <div class="item-title">

          <span class="glyphicon glyphicon-star"></span>

       </div>
       <div class="line"></div>
       <div class="item-description">

        <?php
          $type = 'portfolio';
          $args=array(
            'post_type' => $type,
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'caller_get_posts'=> 1
          );

          $my_query = null;
          $my_query = new WP_Query($args);
          if( $my_query->have_posts() ) {
            while ($my_query->have_posts()) {
                $my_query->the_post();
          ?>
            <div class="blog-title">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </div>
            <div class="blog-post-date">Posted on <?php the_time('F jS, Y') ?></div>
            <div class="blog-content">
                
                <?php 
                  $feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_id()) );
                  
                  if ($feat_image) {
                      echo '
                        <img src="'.$feat_image.'" align="left"> 
                      ';      
                  }
                  
                  the_content(__('(more...)')); 
                ?>
            </div>

          <?php      
            }
          }

          wp_reset_query();  // Restore global post data stomped by the_post().
        ?>

       </div>

    </div>

</div>
   
</div>

<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/uiTree.js"></script>
<script type="text/javascript">
    jQuery(".ui-tree").uiTree();      
</script>

<?php
get_footer();
?>

