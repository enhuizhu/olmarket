<?php
/**
* template for single post
**/
get_header();
?>


<?php
 /**
 * This is regular php template file
 **/
?>

<div class="container">
    
    <div class="col-sm-3 col-md-3 col-lg-3">

        <?php

           include "contents/portfoliosSideBar.php";

        ?>
  
  </div>
  
  <div class="col-sm-9 col-md-9 col-lg-9">

    <div class="list-item pull-right">
    	 
         <div class="item-title">
              <span class="glyphicon glyphicon-star"></span>
    	 </div>
    	 <div class="line"></div>
    	 <div class="item-description">
    	 	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="blog-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
            <div class="blog-post-date">Posted on <?php the_time('F jS, Y') ?></div>
            <div class="blog-content single">
                <?php 
                  $feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_id()) );
                  
                  if ($feat_image) {
                      echo '
                        <img src="'.$feat_image.'"><br> 
                      ';      
                  }


                    the_content(__('(more...)')); 
                ?>
            </div>
             

            <?php endwhile; ?>
            
            <?php if(!is_home()):?>
            <div class="navigation">
              <span class="pull-left"><?php previous_post_link('%link') ?></span> 
              <span class="pull-right"><?php next_post_link(' %link') ?></span>
              </div class="clear"></div>
            </div>
            <?php endif;?>
           
           <?php else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
          <?php endif; ?>
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
