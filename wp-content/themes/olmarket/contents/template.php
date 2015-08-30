<?php
 /**
 * This is regular php template file
 **/
?>

<div class="container">
    
    <div class="col-sm-3 col-md-3 col-lg-3">

    <div class="list-item">
         <div class="item-title">
         	 <?php echo $langs["feature"]?>
         </div>
         <div class="line"></div>
         <div class="item-description">

           <?php get_sidebar(); ?>
         </div>
    </div>
  
  </div>
  
  <div class="col-sm-9 col-md-9 col-lg-9">

    <div class="list-item pull-right">
    	 <div class="item-title">
    	 	<?php echo $langs["blog"]?>
    	 </div>
    	 <div class="line"></div>
    	 <div class="item-description">
    	 	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="blog-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
            <div class="blog-post-date">Posted on <?php the_time('F jS, Y') ?></div>
            <div class="blog-content">
                <?php the_content(__('(more...)')); ?>
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
   
</div>
