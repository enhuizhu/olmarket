<?php
 /**
 * This is regular php template file
 **/
?>

<div class="break"></div>
<div class="break"></div>
<div class="break"></div>
<div class="break"></div>

<div class="fix-size">
    <div class="list-item pull-left">
         <div class="item-title">
         	 part title
         </div>
         <div class="line"></div>
         <div class="item-description">

           <?php get_sidebar(); ?>
         </div>
    </div>

    <div class="list-item pull-right long">
    	 <div class="item-title">
    	 	template
    	 </div>
    	 <div class="line"></div>
    	 <div class="item-description">
    	 	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
            <h4>Posted on <?php the_time('F jS, Y') ?></h4>
            <p><?php the_content(__('(more...)')); ?></p>
            <div>
             <span><?php edit_post_link(); ?></span>
            

            </div>
            <hr> <?php endwhile; ?>
            
            <div class="navigation">
              <?php previous_post_link('%link') ?> <?php next_post_link(' %link') ?>
            </div>
           
           <?php else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
          <?php endif; ?>

    	 </div>
    </div>
   
    <div class="clear"></div>
</div>
